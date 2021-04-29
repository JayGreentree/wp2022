<?php

/**
 *
 * @link              http://wpchurch.team
 * @since             1.0.0
 * @package           WP_Church_Center_RSS
 *
 * @wordpress-plugin
 * Plugin Name:       WP Church Center: RSS Syndication
 * Plugin URI:        http://wpchurch.center/addons
 * Description:       Adds a card to WP Church Sermon that syndicates RSS content from another source
 * Version:           1.0.0
 * Author:            Jordesign, WP Church Team
 * Author URI:        http://wpchurch.team/addons/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       WP_Church_Center_RSS
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}


/******* Add 'RSS' as an option  in the 'Card Type' field ******/
function wpcc_load_rss_card( $field ) {
             
    $field['choices'][ 'rss' ] = 'RSS Card';
    return $field;   
}
add_filter('acf/load_field/name=wpcc_card_type', 'wpcc_load_rss_card');

/******* Add Field for Church ID ******/
add_action( 'acf/init', 'wpcc_load_rss_fields',20 );

function wpcc_load_rss_fields() {
  acf_add_local_field(
    array(
      'key' => 'field_5aa66f32390e0',
      'label' => 'RSS Feed URL',
      'name' => 'wpcc_rss_feed_url',
      'type' => 'url',
      'instructions' => '',
      'required' => 1,
      'parent' => 'acf_card-content',
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_5994ca00ccd17',
            'operator' => '==',
            'value' => 'rss',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'default_value' => '',
      'placeholder' => '',
    ));


    acf_add_local_field(array(
      'key' => 'field_5ab196334df73',
      'label' => 'Details to Display',
      'name' => 'details_to_display',
      'type' => 'checkbox',
      'instructions' => '',
      'required' => 1,
      'parent' => 'acf_card-content',
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_5994ca00ccd17',
            'operator' => '==',
            'value' => 'rss',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'choices' => array(
        'title' => 'Title',
        'link' => 'Link to original item',
        'author' => 'Author',
        'date' => 'Published Date',
        'summary' => 'Summary Content',
      ),
      'allow_custom' => 0,
      'save_custom' => 0,
      'default_value' => array(
      ),
      'layout' => 'horizontal',
      'toggle' => 0,
      'return_format' => 'value',
    ));


    acf_add_local_field(array(
      'key' => 'field_5aa671b4450e2',
      'label' => 'Highlight most recent item',
      'name' => 'wpcc_rss_feature_latest',
      'type' => 'true_false',
      'instructions' => 'This will highlight the most recent feed item with a custom style (based on your card color)',
      'required' => 0,
      'parent' => 'acf_card-content',
      'conditional_logic' => array (
        array (
          array (
            'field' => 'field_5994ca00ccd17',
            'operator' => '==',
            'value' => 'rss',
          ),
        ),
      ),
      'wrapper' => array(
        'width' => '',
        'class' => '',
        'id' => '',
      ),
      'message' => 'Highlight the most recent item in the feed.',
      'default_value' => 0,
      'ui' => 0,
      'ui_on_text' => '',
      'ui_off_text' => '',
    ));



}

// Card Filters
require_once plugin_dir_path( __FILE__ ) . 'card.php';

//CSS
//load stylesheet for CCB Cards
function wpcc_rss_load_stylesheet() {
    // only enqueue on product-services page slug
    if ( get_post_type() == 'card' && get_field('field_5994ca00ccd17', get_the_ID()) === 'rss' ) {
        wp_enqueue_style( 'wpcc_rss-style', plugins_url( 'rss_styles.css', __FILE__  ) );
    }
}
add_action( 'wp_enqueue_scripts', 'wpcc_rss_load_stylesheet' );

//Adding CSS inline style to an existing CSS stylesheet
function wpcc_rss_add_inline_css() {

        //Get the Card's Colour Variable
    $cardColour = get_post_meta(get_the_ID(),'wpcc_color',true );
        //All the user input CSS settings as set in the plugin settings
        $wpcc_rss_custom_css = "
            .wpccRSSfeed p i {
                 color: $cardColour;
            }

            .wpccRSSfeed ul li.rssFeature {
              background: $cardColour;
            }
        ";
  //Add the above custom CSS via wp_add_inline_style
  wp_add_inline_style( 'wpcc_rss-style', $wpcc_rss_custom_css ); //Pass the variable into the main style sheet ID
}
add_action( 'wp_enqueue_scripts', 'wpcc_rss_add_inline_css' ); //Enqueue the CSS style

