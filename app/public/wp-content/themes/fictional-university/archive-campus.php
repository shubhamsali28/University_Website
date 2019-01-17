<?php
get_header();

//For title and subtitle which helps to get the function pageBanner from function.php
pageBanner(array(
'title' => 'All Campuses',
'subtitle' => 'We have most convenient campuses compared to other universities'
));

?>


<div class="container container--narrow page-section">

<div class="acf-map">
	
    <?php
    while(have_posts())
    {
    	the_post(); 
        
        $mapLocation = get_field('map_location');
        ?>

        <div class="marker" data-lat=" <?php echo $mapLocation['lat'] ?>" data-lng="<?php echo $mapLocation['lng'] ?>">
            <h3><a href=" <?php the_permalink(); ?>"> <?php the_title(); ?></a></h3>
            <?php echo $mapLocation['address']; ?>
        </div>
    	
    
    <?php }

    //To get links to the next page
    // echo paginate_links();
	?>

  </div>



<?php
get_footer();
?>