<?php
/*
Template Name: No Sidebar
*/
?>
<?php define('WP_USE_THEMES', false); get_header(); ?>
				

					<div id="onecolumn">
					
					
					
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


<?php get_footer(); ?>