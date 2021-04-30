<?php
/*
Plugin Name:  Live Stream Church
Plugin URI:   https://delreyagency.com/live-stream-church/
Description:  Live Stream Church inserts automatically your YouTube Live Streaming Service and chat into your website.
Version:      0.1
Author:       delreyagency.com
Author URI:   https://delreyagency.com
License:      GPL

DISCLAIMER

This SOFTWARE PRODUCT is provided "as is" and "with all faults."
THE PROVIDER makes no representations or warranties of any kind concerning the safety, 
suitability, lack of viruses, inaccuracies, typographical errors, or other harmful components of this SOFTWARE PRODUCT. There are inherent dangers in the use of any software, and you are solely responsible. You are also solely responsible for the protection of your website and backup of your data, and THE PROVIDER will not be liable for any damages you may suffer in connection with using, modifying, or distributing this SOFTWARE PRODUCT
*/

$videoid = '';

register_activation_hook( __FILE__ , 'livestreamchurch_install' );
add_action( 'init', 'livestreamchurch_textdomain' );
add_filter('plugin_action_links_' . plugin_basename( __FILE__ ), 'plugin_action_links' );
add_action( 'admin_menu', 'livestreamchurch_setup_menu' );
add_filter( 'template_include', 'livestreamchurch_overwrite_template' );
add_shortcode( 'livestreamchurch', 'livestreamchurch_shortcode' );

function livestreamchurch_install() {

    global $wpdb;
    $the_page_live_title = 'live';
    $the_page_live_name = 'live';
    $the_page = get_page_by_title( $the_page_live_title );

    if ( ! $the_page ) {

        $_p = array();
        $_p['post_title'] = $the_page_live_title;
        $_p['post_status'] = 'publish';
        $_p['post_type'] = 'page';
        $_p['comment_status'] = 'closed';
        $_p['ping_status'] = 'closed';
        $_p['post_category'] = array(1);
        $the_page_live_id = wp_insert_post( $_p );

    } else {

        $the_page_live_id = $the_page->ID;
        $the_page->post_status = 'publish';
        $the_page_live_id = wp_update_post( $the_page );

    }

    delete_option( 'livestreamchurch_page_live_id' );

    add_option( 'livestreamchurch_page_live_id', $the_page_live_id );

}

function plugin_action_links($links) {

  $settings_link = '<a href="' . admin_url('admin.php?page=livestreamchurch') . '" title="' . __('Click here to configure', '
  livestreamchurch') . '">' . __('Click here to configure', 'livestreamchurch') . '</a>';

  array_unshift($links, $settings_link);

  return $links;

}


function livestreamchurch_textdomain() {

  load_plugin_textdomain( 'livestreamchurch', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' ); 

}

function livestreamchurch_setup_menu() {

  livestreamchurch_register_settings();

  add_menu_page( 'livestreamchurch', 'Live Stream Church', 'manage_options', 'livestreamchurch', 'livestreamchurch_settings' );    

}

function livestreamchurch_settings() {?>

  <style>
  .livestreamchurch_note {
    border: solid 2px #bdbdbd;
    border-style: dotted;
    padding: 30px;
    border-radius: 17px;
  }
  </style>
  <div class="wrap">
     <h1>Live Stream Church</h1>
     <form method="post" action="options.php">
      <?php settings_fields( 'livestreamchurch-settings-group' ); ?>
      <?php do_settings_sections( 'livestreamchurch-settings-group' ); ?>      
        <h2><span id="general-settings">General Settings</span></h2>
        <table>
          <tr>
            <td width="50%" style="vertical-align: top">
              <table class="form-table">
                 <tbody>
                    <tr>
                       <td colspan="2" style="padding-top: 0px">
                          <div class="livestreamchurch_note" style="font-size: 20px; background: #ffffff">
                            1 - Add your Channel ID<br>
                            <a target="_blank" href="https://delreyagency.com/live-stream-church/documentation">How to find my Channel ID?</a>
                            <br><br>
                            2 - Live Page Done! You can check and share it: <a target="_blank" href="<?php echo get_site_url()?>/live"><?php echo get_site_url()?>/live</a>
                            <br><br>
                            Also you can insert the Shortcode at any page:<br>
                            [livestreamchurch]
                          </div>
                       </td>
                    </tr>
                    <tr>
                       <th scope="row"><label for="channelid">Channel ID</label></th>
                       <td>
                          <input name="livestreamchurch-channelid" type="text" id="channelid" aria-describedby="channelid" class="regular-text" value="<?php echo esc_attr( get_option( 'livestreamchurch-channelid' ) ); ?>">
                       </td>
                    </tr>
                    <tr>
                       <th scope="row"><label for="offlinevideo">Offline video ID</label></th>
                       <td>
                          <input name="livestreamchurch-offlinevideo" type="text" id="offlinevideo" aria-describedby="offlinevideo" class="regular-text" value="<?php echo esc_attr( get_option( 'livestreamchurch-offlinevideo' ) ); ?>">
                       </td>
                    </tr>            
                    <tr>
                       <th scope="row"><label for="logoimage">Logo URL</label></th>
                       <td>
                          <input name="livestreamchurch-logoimage" type="text" id="logoimage" aria-describedby="logoimage" class="regular-text" value="<?php echo esc_attr( get_option( 'livestreamchurch-logoimage' ) ); ?>">
                       </td>
                    </tr>
                    <tr>
                       <th scope="row"><label for="logoimageprofile">Logo mini URL</label></th>
                       <td>
                          <input name="livestreamchurch-logoimageprofile" type="text" id="logoimageprofile" aria-describedby="logoimageprofile" class="regular-text" value="<?php echo esc_attr( get_option( 'livestreamchurch-logoimageprofile' ) ); ?>">
                       </td>
                    </tr>
                    <tr>
                       <th scope="row"><label for="videotitle">Streaming Title</label></th>
                       <td>
                          <input name="livestreamchurch-videotitle" type="text" id="videotitle" aria-describedby="videotitle" class="regular-text" value="<?php echo esc_attr( get_option( 'livestreamchurch-videotitle' ) ); ?>">
                       </td>
                    </tr>
                     <tr>
                       <th scope="row"><label for="descriptiontext">General Description</label></th>
                       <td>
                          <input name="livestreamchurch-descriptiontext" type="text" id="descriptiontext" aria-describedby="descriptiontext" class="regular-text" value="<?php echo esc_attr( get_option( 'livestreamchurch-descriptiontext' ) ); ?>">
                       </td>
                    </tr>
                    <tr>
                       <th scope="row"><label for="offeringlink">Donate link</label>
                       </th>
                       <td>
                          <input name="livestreamchurch-offeringlink" type="text" id="offeringlink" aria-describedby="offeringlink" class="regular-text" value="<?php echo esc_attr( get_option( 'livestreamchurch-offeringlink' ) ); ?>">
                       </td>
                    </tr>
                    <tr>
                       <th scope="row"><?php submit_button(); ?>
                       </th>
                       <td></td>
                    </tr>
                 </tbody>
              </table>
            </td>
            <td style="text-align: center; vertical-align: top">
              <a target="_blank" href="https://delreyagency.com/live-stream-church-pro/"><img width="90%" src="<?php echo plugins_url( 'img/upgrade.png', __FILE__ );?>"></a><br><br>
              <a target="_blank" href="https://delreyagency.com/live-stream-church-pro/"><img width="90%" src="<?php echo plugins_url( 'img/upgrade2.png', __FILE__ );?>"></a>
            </td>            
          </tr>
        </table>
     </form>
  </div>
<?php
}

function livestreamchurch_register_settings() {

  register_setting( 'livestreamchurch-settings-group', 'livestreamchurch-channelid' );
  register_setting( 'livestreamchurch-settings-group', 'livestreamchurch-offlinevideo' );
  register_setting( 'livestreamchurch-settings-group', 'livestreamchurch-logoimage' );
  register_setting( 'livestreamchurch-settings-group', 'livestreamchurch-logoimageprofile' );
  register_setting( 'livestreamchurch-settings-group', 'livestreamchurch-videotitle' );
  register_setting( 'livestreamchurch-settings-group', 'livestreamchurch-offeringlink' );
  register_setting( 'livestreamchurch-settings-group', 'livestreamchurch-descriptiontext' );

}

function livestreamchurch_overwrite_template( $template ) {

  global $post;
  $pageid = get_option( 'livestreamchurch_page_live_id' );
  $post_slug = $post->post_name;
  $livestreamchurch_template = plugin_dir_path( __FILE__ ) . 'template-livestreamchurch.php';

  if($pageid == get_the_id()) {

    return $livestreamchurch_template;

  }

  return $template;

}

function livestreamchurch_islive(){

  global $videoid;
  $channelid = ( get_option( 'livestreamchurch-channelid' ) == '' ? "UC8NnosPOvXnm0O1u5YnLQiw" : get_option( 'livestreamchurch-channelid' ));
  $request = wp_remote_get("https://www.youtube.com/embed/live_stream?channel=".$channelid);
  $contents = wp_remote_retrieve_body( $request );
  $search   = 'www.youtube.com/watch';

  preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/\s]{11})%i', $contents, $match);

  $videoid = $match[1];

    if (strpos($contents, $search) === FALSE) {

      //streaming offline
      return false;

    } else {

      //streaming online
      return true;

    }
}

function livestreamchurch_shortcode(){

  global $videoid;
  $offlinevideo = ( get_option( 'livestreamchurch-offlinevideo' ) == '' ? "nQWFzMvCfLE" : get_option( 'livestreamchurch-offlinevideo' ));  

  if (livestreamchurch_islive() == true) {

    //streaming online
    $code = "<iframe width=\"720\" height=\"480\" src=\"https://www.youtube.com/embed/".$videoid."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";

  } else {

    //streaming offline
    $code = "<iframe width=\"720\" height=\"480\" src=\"https://www.youtube.com/embed/".$offlinevideo."\" frameborder=\"0\" allow=\"accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture\" allowfullscreen></iframe>";

  }

  return $code;

}

function livestreamchurch_get_domain() {

  $domain = $_SERVER['HTTP_HOST'];

  return $domain;

}