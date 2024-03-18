<?php get_header(); ?>
<!-- CONTENT COLUMN 1 BEGIN -->
<?php if (have_posts()) : ?>
<?php while (have_posts()) : the_post(); ?>

<!-- Entry Title -->
<div class="jumbotron">
	<h2 class="blog-post-title text-center"><?php the_title(); ?></h2>

</div>
<?php endwhile; ?>


<?php endif; ?>

<main role="main" class="container">
	<div class="row">
		<div class="col-md-8 blog-main">



			<!-- CONTENT COLUMN 1 BEGIN -->
			<?php if (have_posts()) : ?>
			<?php while (have_posts()) : the_post(); ?>

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
