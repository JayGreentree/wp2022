<?php get_header(); ?>
				

					<div id="column1">
					
					
					
<!-- CONTENT COLUMN 1 BEGIN -->
					<?php if (have_posts()) : ?>
					<?php while (have_posts()) : the_post(); ?>
					
					<!-- Entry Title -->
					<header>
						<a href="<?php the_permalink() ?>" rel="bookmark" title="Permanent Link to <?php the_title(); ?>">
						<?php the_title(); ?></a>
						
						<!-- Date & Author -->
						<div id="postmetadata"><h6><?php the_time('F jS, Y') ?></h6></div>
					</header>
					
				
					<!-- Entry Content -->
					<div class="entry-content">
						<?php the_content('Read the rest of this entry &raquo;'); ?>
					</div>

					<!-- <?php trackback_rdf(); ?> -->
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
