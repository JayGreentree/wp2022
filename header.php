<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
    <?php wp_head(); ?>
    <meta charset="<?php bloginfo( 'charset' ); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <link rel="profile" href="http://gmpg.org/xfn/11" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php //bloginfo( 'stylesheet_url' ); ?>" />
    <link rel="stylesheet" type="text/css" media="all" href="<?php echo get_template_directory_uri(); ?>" />
        <!-- Bootstrap core CSS -->
    <link href="<?php echo get_template_directory_uri(); ?>/dist/css/bootstrap.min.css" rel="stylesheet">
    <meta name="description" content="<?php bloginfo('description'); ?>" />

    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
    <link rel="alternate" type="application/rss+xml" title="Mountain Valley Church of God Sermon Recordings" href="http://mvcog.org/rss/" />
    <link rel="shortcut icon" href="<?php echo get_template_directory_uri(); ?>/images/favicon.ico" />
    <style>
        .home .jumbotron{
            background: url("<?php echo get_template_directory_uri(); ?>/images/mvcog_web_bg01.png") no-repeat center center; 
            background-size: cover;
            height: 750px;
}
</style>
    
</head>

<body <?php body_class(); ?>>


    <header>
      <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark">
        <img style="width:50%" src="<?php echo get_template_directory_uri(); ?>/images/mvcog_logo_white.png" alt="Mountain Valley Church of God" class="navbar-brand">
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <?php
        wp_nav_menu( array(
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'div',
            'container_class'   => 'collapse navbar-collapse',
            'container_id'      => 'navbarCollapse',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'WP_Bootstrap_Navwalker::fallback',
            'walker'            => new WP_Bootstrap_Navwalker(),
        ) );
        ?>

      </nav>
      <br />
    </header>