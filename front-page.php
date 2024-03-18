<?php
/*
Template Name: No Sidebar
*/
?>
<?php get_header(); ?>

<div class="jumbotron"
  <?php if(has_post_thumbnail()): ?>style="background-image: url('<?php the_post_thumbnail_url();?>');" <?php endif;?>>
  <!--  If today is sunday show countdown to service -->
  <div class=" entry-header row align-center">

    <div class="small-12  medium-10 large-8 columns text-center">


      <div id="featured-churchonline" class="hide header-featured-message">
        <h1 class="entry-title">Join us live</h1>
        <hr style="max-width: 100px;margin:0.667rem auto;" />
        <h3 style="line-height: 1.4;margin-bottom: 1rem;" class="hide-for-medium">
          Sundays<br /><small>10:00am</small></h3>
        <h4 style="line-height: 1.4;margin-bottom: 1rem;" class="show-for-medium">SUN | 10:00am</h4>
        <a id="btn-co-timer" href="/live/" class="button secondary">Visit Church Online</a>
        <!--<a id="btn-co-live" href="/live/" class="hide button secondary hollow">Watch Live Now!</a>-->
      </div>

      <!-- If today is not Sunday show main header or latest sermon -->

      <?php 
$args = array( 'post_type' => 'sermons', 'posts_per_page' => 10 );
$the_query = new WP_Query( $args ); 
?>
      <?php if ( $the_query->have_posts() ) : ?>
      <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>
      <div id="featured-message" class="header-featured-message hide">
        <h6 class="sub-title spread">Latest Message</h6>
        <h1 class="entry-title"><?php the_title(); ?></h1>
        <a href="<?php echo get_permalink();?>" class="button secondary hollow">Watch Now</a><br><br>
        <h5><small><a href="/sermons/" class="secondary allcaps link">View more
              messages</a></small></h5>
      </div>
      <?php endwhile;
wp_reset_postdata(); ?>
      <?php else:  ?>
      <p style="color:white;"><?php _e( 'Sorry, no sermon available at this time.' ); ?></p>
      <?php endif; ?>



    </div><!-- .columns -->

  </div><!-- .row -->

  <div id="churchonline-card" class="card hide">
    <i id="churchonline-card-close" class="fal fa-times"></i>
    <a href="https://live.cityfirst.church" target="_blank">
      <img src="https://cityfirstchurch.s3.amazonaws.com/wp/wp-content/uploads/watchonline-banner.jpg"
        class="card-image" alt="" />
      <div class="card-content">
        <h5 id="churchonline-card-title" class="card-title">First Wednesday with Kevin Gerald</h5>
        <p id="churchonline-card-timer">00:00:00</p>
      </div>
    </a>
  </div>
</div>
</div>




    <!-- CONTENT COLUMN 1 BEGIN -->
    <?php if (have_posts()) : ?>
    <?php while (have_posts()) : the_post(); ?>


    <!-- Entry Content -->
    <div class="entry-content">
      <?php the_content('Read the rest of this entry &raquo;'); ?>
    </div>

    <?php trackback_rdf(); ?>
    <?php endwhile; ?>
    <!-- Entry Navigation -->
    <div class="navigation">
      <div class="alignleft"><?php previous_posts_link('&laquo; Previous') ?></div>
      <div class="alignright"><?php next_posts_link('Next &raquo;','') ?></div>
    </div>

    <?php else : ?>
    <h2 class="center">Not Found</h2>
    <p class="center">
      <?php _e("Sorry, but you are looking for something that isn't here."); ?></p>

    <?php endif; ?>
    <!-- CONTENT COLUMN 1 END -->

  


  <?php get_footer(); ?>
