<?php
/**
 * The template for displaying search forms in MVBlue
 *
 * Originally pulled from Twenty Eleven theme
 */
?>
	<form method="get" id="searchform" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<div class="form-group">
		<label for="s" class="assistive-text"><?php _e( 'Search', 'MVBlue' ); ?></label>
	</div>
	<div class="form-group">
		<input type="text" class="form-control" name="s" id="s" placeholder="<?php esc_attr_e( 'Search', 'MVBlue' ); ?>">
	</div>
	<div class="form-group">
		<input type="submit" class="btn btn-primary" name="submit" id="searchsubmit" value="<?php esc_attr_e( 'Search', 'MVBlue' ); ?>">
	</div>
	</form>
