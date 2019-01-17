<?php
get_header();

//For title and subtitle which helps to get the function pageBanner from function.php
pageBanner(array(
'title' => 'All Programs',
'subtitle' => 'Lets look at the programs around the campus'
));

?>


<div class="container container--narrow page-section">

<ul class="link-list min-list">
	<?php
    while(have_posts())
    {
    	the_post(); ?>

    	<li><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></li>
    
    <?php }

    //To get links to the next page
    echo paginate_links();
	?>

  </ul>



<?php
get_footer();
?>