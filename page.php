<?php define('WP_USE_THEMES', false); get_header(); ?>
				
      <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!--
        <ol class="carousel-indicators">
          <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
          <li data-target="#myCarousel" data-slide-to="1"></li>
          <li data-target="#myCarousel" data-slide-to="2"></li>
        </ol>
      -->
        <div class="carousel-inner">

          <div class="carousel-item active">
            <img class="first-slide" src="https://mvcog.jaygreentree.net/wp-content/uploads/sites/2/2021/05/mvcog_web_bg01.png" alt="First slide">
            <div class="container">
              <div class="carousel-caption text-left">
                <h1>Example headline.</h1>
                <p>Cras justo odio, dapibus ac facilisis in, egestas eget quam. Donec id elit non mi porta gravida at eget metus. Nullam id dolor id nibh ultricies vehicula ut id elit.</p>
                <p><a class="btn btn-lg btn-primary" href="#" role="button">Sign up today</a></p>
              </div>
            </div>
          </div>

 
        </div>
        <!--
        <a class="carousel-control-prev" href="#myCarousel" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#myCarousel" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      -->
      </div>


					<div id="column1">
					
					
					
<!-- CONTENT COLUMN 1 BEGIN -->
					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
					
					<!-- Entry Title -->
					<header>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
						<?php the_title(); ?></a>
						
					</header>
					<!-- Entry Content -->
					<div class="entry-content">
						<?php the_content('Read the rest of this entry &raquo;'); ?>
					</div>

					<!-- <?php trackback_rdf(); ?> -->
					<?php endwhile; ?>

					 
					<?php else : ?>
					<h2 class="center">Not Found</h2>
					<p class="center">
					<?php _e("Sorry, but you are looking for something that isn't here."); ?></p>
					
					<?php endif; ?>
<!-- CONTENT COLUMN 1 END -->

					</div>
						<div id="vdivider">
						<div id="vdtop"></div>
						<div id="vdmid"></div>
						<div id="vdbot"></div>
						</div>
					<div id="column2">
					
<!-- CONTENT COLUMN 2 *RIGHT SIDEBAR* BEGIN -->
						<ul id="sidebar">
						<?php if ( !function_exists('dynamic_sidebar')
								|| !dynamic_sidebar() ) : ?>
						 <li id="about">
						  <h2>About</h2>
						  <p>This is my blog.</p>
						 </li>
						 <li id="links">
						  <h2>Links</h2>
						  <ul>
						   <li><a href="http://mvcog.org">mvcog.org</a></li>
						  </ul>
						 </li>
						<?php endif; ?>
						</ul>
<!-- CONTENT COLUMN 2 *RIGHT SIDEBAR* END -->

					</div>
<?php get_footer(); ?>