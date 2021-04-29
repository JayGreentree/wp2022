<?php
header( "Cache-Control: no-store, no-cache, must-revalidate, max-age=0" );
header( "Cache-Control: post-check=0, pre-check=0", false );
header( "Pragma: no-cache" );

/**
* Template Name: livestreamchurch
*
*/

add_filter( 'show_admin_bar', '__return_false' );
wp_register_style( 'livestreamchurchcss', plugins_url( 'live.css', __FILE__ ) );

$logoimage = ( get_option( 'livestreamchurch-logoimage' ) == '' ? plugins_url( 'img/logo.png', __FILE__ ) : get_option( 'livestreamchurch-logoimage' ));
$logoimageprofile = ( get_option( 'livestreamchurch-logoimageprofile' ) == '' ? plugins_url( 'img/ico-profile.jpg', __FILE__ ) : get_option( 'livestreamchurch-logoimageprofile' ));
$videotitle = ( get_option( 'livestreamchurch-videotitle' ) == '' ? "Welcome to our online Service!" : get_option( 'livestreamchurch-videotitle' ));
$siteurl = livestreamchurch_get_domain();
$descriptiontext = ( get_option( 'livestreamchurch-descriptiontext' ) == '' ? "May The Lord bless you!" : get_option( 'livestreamchurch-descriptiontext' ));
$offeringlink = ( get_option( 'livestreamchurch-offeringlink' ) == '' ? "/donate" : get_option( 'livestreamchurch-offeringlink' ) );

?>

<!DOCTYPE html>
<html>
<head>
<meta http-equiv="Cache-Control" content="no-cache, no-store, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
wp_head();
wp_enqueue_style('livestreamchurchcss');
?>
</head>
<body>
  
<div id="content">
  <nav class="nav">
    <div class="nav-container">
      <div class="row align-center">
        <a class="menu-icon" href="#"><img src="<?php echo plugins_url( 'img/ico-menu.png', __FILE__ );?>"></a>
        <div class="logo-container">
          <a href="/"><img src="<?php echo $logoimage;?>" alt="Website"></a>
        </div>
      </div>
      <ul class="controls">
        <li class="nav-control-item nav-notification"><a target="_blank" href="<?php echo $offeringlink;?>"><?php _e( 'Donate', 'livestreamchurch' );?><img src="<?php echo plugins_url( 'img/ico-heart.png', __FILE__ );?>"></a></li>
      </ul>
    </div>
  </nav>
  <div class="page-content">
    <div class="row justify-content-center">
    <div id="primary" class="col">
      <div class="responsive-video">
        <?php echo do_shortcode('[livestreamchurch]');?>
      </div>
      <div id="info-contents">
        <h1><?php echo $videotitle;?></h1>
        <div id="info">
          <div class="info-text"><?php echo date("F j, Y");?></div>
          <div id="menu-container">
            <ul id="menu" class="controls">
              <li class="control-item hide-mobile"><a href="#"><img src="<?php echo plugins_url( 'img/ico-chat.png', __FILE__ );?>"><?php _e( 'Chat', 'livestreamchurch' );?></a></li>
              <li class="control-item"><a target="_blank" href="<?php echo $offeringlink;?>"><img src="<?php echo plugins_url( 'img/ico-heart.png', __FILE__ );?>"><?php _e( 'Donate', 'livestreamchurch' );?></a></li>                   
            </ul>
            <div id="like-bar-container" style="display: none;">
              <div id="like-bar"></div>
            </div>
          </div>
        </div>
      </div>
      <div id="meta">
        <div id="meta-contents">
          <div class="row align-center top-row">
            <div id="video-owner">
              <a id="uploader-avatar" href="#"><img src="<?php echo $logoimageprofile;?>"></a>
              <div id="channel-info">
                <a id="channel-name" href="#"><?php echo $siteurl;?></a>
                <span id="sub-count" class="info-text"><?php _e( 'Channel', 'livestreamchurch' );?></span>
              </div>
            </div>
          </div>
          <div id="description-container">
            <div id="description">
              <p><?php echo $descriptiontext;?></p>
            </div>
          </div>
        </div>
      </div>          
    </div>
    <aside id="secondary" class="col">
      <div class="secondary-inner">
        <div id="sidebar-chat" class="sidebar-content">
          <?php 
          if (livestreamchurch_islive() == true) :?>
          <iframe allowfullscreen="" frameborder="0" height="450" src="https://www.youtube.com/live_chat?v=<?php echo $videoid;?>&embed_domain=<?php echo livestreamchurch_get_domain();?>" width="400"></iframe><br />
          <?php endif;?>
        </div>
      </div>
    </aside>
    </div>
  </div>
<?php
wp_footer();
?>
</body>
</html>