<?php 

require get_theme_file_path('/inc/like-route.php');
require get_theme_file_path('/inc/search-route.php');

function university_custom_rest()
{
	register_rest_field('post', 'authorName', array(
    'get_callback' => function() {return get_the_author();}
	));

	register_rest_field('note', 'userNoteCount', array(
    'get_callback' => function() {return count_user_posts(get_current_user_id(), 'note');}
	));
}

add_action('rest_api_init', 'university_custom_rest');

function pageBanner($args = NULL)
{

// //Acutal code will live here
if(!$args['title'])
{
	$args['title'] = get_the_title();
}

if(!$args['subtitle'])
{
	$args['subtitle'] = get_field('page_banner_subtitle');
}

if(!$args['photo'])
{
	if( get_field('page_banner_background_image'))
	{
		$args['photo'] = get_field('page_banner_background_image')['sizes']['pageBanner'];
	}

	else
	{
		$args['photo'] = get_theme_file_uri("images/ocean.jpg");
	}
}

 ?>

<!-- For page banner -->
<div class="page-banner">
    <div class="page-banner__bg-image" style="background-image: url(<?php echo $args['photo']; ?>);"></div>
    <div class="page-banner__content container container--narrow">
      <h1 class="page-banner__title"> 

      	<?php echo $args['title']; ?> 

      </h1>
      
      <div class="page-banner__intro">
        <p> <?php echo $args['subtitle']; ?></p>
      </div>
    </div>  
  </div>

<?php }


function university_files()
{
//To load Google Maps js files at the bottom
wp_enqueue_script('googleMap', '//maps.googleapis.com/maps/api/js?key=AIzaSyAVgqiYz_n6qH6B0c3jDgvCagTO61Qha10', NULL, '1.0', true);

//To load Javascript files at the bottom
wp_enqueue_script('main-university-js', get_theme_file_uri('/js/scripts-bundled.js'), NULL, '1.0', true);

//To load awesome fonts from font-awesome website
wp_enqueue_style('font-awesome', '//maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css');

// To load google fonts
wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');

// To load style.css
wp_enqueue_style('university_main_styles',get_stylesheet_uri(), NULL, microtime());

//To make sure that the url can be customized
wp_localize_script('main-university-js', 'universityData', array(
'root_url' => get_site_url(),
'nonce' => wp_create_nonce('wp_rest')
));
}

add_action('wp_enqueue_scripts', 'university_files');


function university_title()
{
// To add the title at the top of the each page which is different for different page
	add_theme_support('title-tag');

// To add or enable the thumbnail image support for the professor post type
    add_theme_support('post-thumbnails');

    add_image_size('professorLandscape', 400, 260, true);
    add_image_size('professorPortrait', 480, 650, true);
// For background image for each page or post
    add_image_size('pageBanner', 1500, 350, true);

// To add dynamic menu to the webpage MENUS in Apperance tab of ADMIN page
	// register_nav_menu('headerMenuLocation', 'Header Menu Location');


	// register_nav_menu('footerMenuLocation1', 'Footer Menu Location 1');

	// register_nav_menu('footerMenuLocation2', 'Footer Menu Location 2');
}

add_action('after_setup_theme','university_title');


function university_adjust_queries($query)
{
//Event Post type
	if(!is_admin() AND is_post_type_archive('event') AND $query-> is_main_query())
	{
		$today = date('Ymd');
		$query-> set('meta_key','event_date');
		$query-> set('orderby','meta_value_num');
		$query-> set('order','ASC');
		$query-> set('meta_query', array(
          array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
          )));

	}

//Program Post type

	if(!is_admin() AND is_post_type_archive('program') AND $query-> is_main_query())
	{
		$query-> set('orderby','title');
		$query-> set('order','ASC');
		$query-> set('posts_per_page', -1);

	}

	//Campus Post type

	if(!is_admin() AND is_post_type_archive('campus') AND $query-> is_main_query())
	{
		$query-> set('posts_per_page', -1);

	}

}
add_action('pre_get_posts', 'university_adjust_queries');

//For adding Google Maps to the campus
function universityMapKey($api)
{
	// $api['key'] = 'AIzaSyBh9b1rNCp6kOi5JeMHiRP4klDymBeoEWk';
	$api['key'] = 'AIzaSyAVgqiYz_n6qH6B0c3jDgvCagTO61Qha10';
	return $api;
}

add_filter('acf/fields/google_map/api', 'universityMapKey');


//Redirect subscriber accounts out of admin and onto homepage

add_action('admin_init', 'redirectSubstoFrontend');

function redirectSubstoFrontend()
{
	$ourCurrentUser = wp_get_current_user();

	if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber')
	{
		wp_redirect(site_url('/'));
		exit;
	}
}

//To not show top customize bar for subscriber
add_action('wp_loaded', 'noSubsAdminBar');

function noSubsAdminBar()
{
	$ourCurrentUser = wp_get_current_user();

	if(count($ourCurrentUser->roles) == 1 AND $ourCurrentUser->roles[0] == 'subscriber')
	{
    show_admin_bar(false);
	}
}

//To customize login screen and login of WORDPRESS

add_filter('login_headerurl', 'ourHeaderurl');

function ourHeaderurl()
{
	return esc_url(site_url('/'));
}

add_action('login_enqueue_scripts', 'ourLoginCss');

function ourLoginCss()
{
	wp_enqueue_style('university_main_styles', get_stylesheet_uri());
	wp_enqueue_style('google-fonts', '//fonts.googleapis.com/css?family=Roboto+Condensed:300,300i,400,400i,700,700i|Roboto:100,300,400,400i,700,700i');
 }

 add_filter('login_headertitle', 'ourLoginTitle');

 function ourLoginTitle()
 {
 	return get_bloginfo('name');
 }




// Force note posts to be private

 add_filter('wp_insert_post_data', 'makeNotePrivate', 10, 2);

 function makeNotePrivate($data, $postarr)
 {
    if($data['post_type'] == 'note')
    {
    	if(count_user_posts(get_current_user_id(), 'note') > 4 AND !$postarr['ID'])
    	{
         die("You have reached your note limit");
    	}
    	$data['post_content'] = sanitize_textarea_field($data['post_content']);
    	$data['post_title'] = sanitize_text_field($data['post_title']);
    }

 	if($data['post_type'] == 'note' AND $data['post_status'] != 'trash')
 	{
 		$data['post_status'] = "private";
 	}
 	return $data;
 }


?>


