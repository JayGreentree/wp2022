<?php get_header(); ?>

<div class="jumbotron">
   <div class="container for-<?php wp_title('-'); ?>">
   <div class="container">
  <div class="row align-items-center">
    <div class="col border border-primary">
      <?php if ( is_active_sidebar( 'header-left' ) ) { dynamic_sidebar( 'header-left' ); } ?>

      <?php 
   // the query
   $the_query = new WP_Query( array(
     'category_name' => 'sermons',
      'posts_per_page' => 1,
   )); 
?>

<?php if ( $the_query->have_posts() ) : ?>
  <?php while ( $the_query->have_posts() ) : $the_query->the_post(); ?>

    <a href="<?php get_permalink();?>"><?php the_title(); ?></a>
    <?php the_excerpt(); ?>

  <?php endwhile; ?>
  <?php wp_reset_postdata(); ?>

<?php else : ?>
  <h2 style="color: white;">No Sermons available</h2>
<?php endif; ?>
    </div>

    <div class="col border">
      <?php if ( is_active_sidebar( 'header-center' ) ) { dynamic_sidebar( 'header-center' ); } ?>
    </div>
    <div class="col border border-primary">
      <?php if ( is_active_sidebar( 'header-right' ) ) { dynamic_sidebar( 'header-right' ); } ?>
      </div>
    </div>
  </div>
</div>
</div>



    <main class="container">
      <div class="row">
        <div class="col-md-8 blog-main">
 <?php 
    if ( have_posts() ) { 
        while ( have_posts() ) : the_post();
    ?>
          <div class="blog-post">
            <h2 class="blog-post-title"><?php the_title(); ?></h2>
            <p class="blog-post-meta"><?php the_date(); ?> by <?php the_author(); ?></p>

           <?php the_content(); ?>
          </div><!-- /.blog-post -->
    <?php
        endwhile;
    } 
    ?>


          <nav class="blog-pagination">
            <?php next_posts_link('Older'); ?>
            <?php previous_posts_link('Newer'); ?>
            <!--<a class="btn btn-outline-primary" href="#">Older</a>
            <a class="btn btn-outline-secondary disabled" href="#">Newer</a>-->
          </nav>

        </div><!-- /.blog-main -->

        <aside class="col-md-4 blog-sidebar">
          <div class="p-3 mb-3 bg-light rounded">
          <?php if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' ); } ?>
          </div>

          

          <div class="p-3">
            <?php if ( is_active_sidebar( 'sidebar-2' ) ) { dynamic_sidebar( 'sidebar-2' ); } ?>
          </div>
        </aside><!-- /.blog-sidebar -->

      </div><!-- /.row -->

    </main><!-- /.container -->


</div><!-- /.blog-main -->


<?php get_footer(); ?>