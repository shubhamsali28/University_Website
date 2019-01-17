<?php

get_header();

while(have_posts())
{
the_post();

//For title and subtitle which helps to get the function pageBanner from function.php
pageBanner();
?>


<div class="container container--narrow page-section">

  <div class="metabox metabox--position-up metabox--with-home-link">
      <p><a class="metabox__blog-home-link" href="<?php echo get_post_type_archive_link('program'); ?>"><i class="fa fa-home" aria-hidden="true"></i> Back to All Programs Home</a> <span class="metabox__main"> <?php the_title(); ?></span></p>
    </div>

     <div class="generic-content">
      <?php the_field('main_body_content') ?>
    </div>
<!-- <h2> <?php the_title(); ?> </h2>
<?php the_content();?> -->

<?php

$relatedProfessor = new WP_Query(array(
        'post_type' => 'professor',
        'posts_per_page' => -1,
        'orderby' => 'title',
        'order' => 'ASC',
        'meta_query' => array(
          array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
          )
        )
        ));

        if($relatedProfessor->have_posts())
        {

        echo '<hr class="section-break">';
        echo '<h2 class="headline headline--medium"> '. get_the_title() .' Professors</h2>';

        echo '<ul class="professor-cards">';
        while($relatedProfessor -> have_posts())
        {
          $relatedProfessor ->the_post(); 
        ?>
       
        <li class="professor-card__list-item">
          <a class="professor-card" href=" <?php the_permalink(); ?>">
          <img class="professor-card__image" src="<?php the_post_thumbnail_url('professorLandscape'); ?>">
          <span class="professor-card__name"><?php the_title(); ?></span>
          </a>
        </li>

        <?php }
         
         echo '</ul>';
        }

//Very important function to reset the above professor's data
        wp_reset_postdata();

        $today = date('Ymd');
        $homepageEvents = new WP_Query(array(
        'post_type' => 'event',
        'posts_per_page' => -1,
        'meta_key' => 'event_date',
        'orderby' => 'meta_value_num',
        'order' => 'ASC',
        'meta_query' => array(
          array(
          'key' => 'event_date',
          'compare' => '>=',
          'value' => $today,
          'type' => 'numeric'
          ),
          array(
          'key' => 'related_programs',
          'compare' => 'LIKE',
          'value' => '"' . get_the_ID() . '"'
          )
        )
        ));

        if($homepageEvents->have_posts())
        {

        echo '<hr class="section-break">';
echo '<h2 class="headline headline--medium">Upcoming '. get_the_title() .' Events</h2>';

        while($homepageEvents -> have_posts())
        {
          $homepageEvents ->the_post(); 
        
      //To copy paste the code from content-event.php in template-parts folder
      get_template_part('template-parts/content-event');
        }
         
        }


      wp_reset_postdata();

      $relatedCampuses = get_field('related_campus');

      if($relatedCampuses)
      {

        echo '<hr class = "section-break">';
        echo '<h2 class = "headline headline--medium">' . get_the_title() . ' is available at these campuses</h2>';

        echo '<ul class ="min-list link-list">';
        foreach($relatedCampuses as $Campus)
        { ?>

          <li><a href=" <?php echo get_the_permalink($Campus); ?>"> <?php echo get_the_title($Campus); ?></a></li>

        <?php }

        echo '</ul>';

        
      }

        ?>

</div>
<?php }

get_footer();

?>