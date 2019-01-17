<?php
get_header();

//For title and subtitle which helps to get the function pageBanner from function.php
pageBanner(array(
'title' => 'All Events',
'subtitle' => 'See whats going on around the campus'));

?>


<div class="container container--narrow page-section">

	<?php
    while(have_posts())
    {
    	the_post(); 

      //To copy paste the code from content-event.php in template-parts folder
      get_template_part('template-parts/content-event');

     }

    //To get links to the next page
    echo paginate_links();
	?>
  <hr class="section-break">
  <p>Here is the recap of past events. <a href="<?php echo site_url('/past-events'); ?>">Click here to see the past events</a></p>


<?php
get_footer();
?>