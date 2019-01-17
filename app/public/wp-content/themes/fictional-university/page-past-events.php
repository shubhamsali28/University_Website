<?php
get_header();

//For title and subtitle which helps to get the function pageBanner from function.php
pageBanner(array(
'title' => 'Past Events',
'subtitle' => 'A recap of all the past events'
));

?>


<div class="container container--narrow page-section">

	<?php
    
    $today = date('Ymd');
        $pastEvents = new WP_Query(array(
        'paged' => get_query_var('paged', 1),
        'posts_per_page' => 1,
        'post_type' => 'event',
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
          'key' => 'event_date',
          'compare' => '<',
          'value' => $today,
          'type' => 'numeric'
          ))
        ));

    while($pastEvents -> have_posts())
    {
    	$pastEvents -> the_post(); 

      //To copy paste the code from content-event.php in template-parts folder
      get_template_part('template-parts/content-event');

       }

    //To get links to the next page
    echo paginate_links(array(
    	'total' => $pastEvents -> max_num_pages));
	?>


<?php
get_footer();
?>