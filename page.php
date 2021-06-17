<?php get_header(); ?>
<div class="jumbotron" style="background-image: url(http://www.californiafootgolfclub.com/static/img/footgolf-1.jpg); background-size: 100%;">
   <div class="container">
    <?php 
    if ( have_posts() ) { 
        while ( have_posts() ) : the_post();
    ?>
   <h1 class="text-center"><?php the_title(); ?></h1>
   </div>
</div>



    <main class="container">
      <div class="row">
        <div class="col-md-16 blog-main">

          <div class="blog-post">


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

        <aside class="col-md-4 blog-sidebar" style="display: none;">
          <div class="p-3 mb-3 bg-light rounded">
            <form action="/" method="get">
              <input type="text" name="s" id="search" value="<?php the_search_query(); ?>" placeholder="Search" />
            </form>
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