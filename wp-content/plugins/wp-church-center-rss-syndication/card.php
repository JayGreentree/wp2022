<?php

/******* Filter the card content ******/
  function wpccb_rss_card($card_content) {
    if( get_field('field_5994ca00ccd17', get_the_ID()) === 'rss'){

        $card_content ='<div class="wpccRSSfeed">';
        $card_content .='<ul>';

        //Set up which content to show
        $wpccFeed = get_field( 'wpcc_rss_feed_url');
        $cardColor = get_post_meta(get_the_ID(),'wpcc_color',true);
        $toDisplay = get_field( 'details_to_display');

        // Get RSS Feed(s)
        include_once( ABSPATH . WPINC . '/feed.php' );

        // Get a SimplePie feed object from the specified feed source.
        $rss = fetch_feed( $wpccFeed );

        $maxitems = 0;

        if ( ! is_wp_error( $rss ) ) : // Checks that the object is created correctly

            // Figure out how many total items there are, but limit it to 5. 
            $maxitems = $rss->get_item_quantity( 10 ); 

            // Build an array of all the items, starting with element 0 (first element).
            $rss_items = $rss->get_items( 0, $maxitems );

        endif;
        

        
            if ( $maxitems == 0 ) :
                $card_content .= 'No Items';
            else : 
                // Loop through each feed item and display each item as a hyperlink.
                $feedCount = 0;
                foreach( $rss_items as $item ) : 
                    $feedCount++;
                    $sermonAuthor = $item->get_author();

                    if($feedCount==1 && get_field('wpcc_rss_feature_latest') === true){

                      
                      $card_content .=  '<li class="rssFeature">';
                      if(in_array('title', $toDisplay )){
                        $card_content .= '<h2>';
                        if(in_array('link', $toDisplay )){
                          $card_content .= '<a href="' .  esc_url( $item->get_permalink() ) . '">';
                        }

                        $card_content .= esc_html( $item->get_title() );

                        if(in_array('link', $toDisplay )){
                          $card_content .= '</a>';
                        }

                        $card_content .= '</h2>';
                      }
                      $card_content .= '<p class="meta">';
                      if(in_array('author', $toDisplay )){
                        $card_content .= '<span class="feedAuthor"><i class="fa fa-user"></i> ' . esc_html( $sermonAuthor->get_name() ) . '</span>';
                      }
                      if(in_array('date', $toDisplay )){
                        $card_content .= '<span class="feedDate"><i class="fa fa-calendar"></i> ' . esc_html( $item->get_date(get_option( 'date_format' )) ) . '</span>';
                      }
                      $card_content .= '</p>';
                      if(in_array('summary', $toDisplay )){
                        $card_content .= '<p>';
                        $card_content .= $item->get_description();
                        $card_content .= '</p>';
                      }
                      $card_content .= '</li>';
 


                    }else{

                      $card_content .=  '<li>';
                      if(in_array('title', $toDisplay )){
                        $card_content .= '<h2>';
                        if(in_array('link', $toDisplay )){
                          $card_content .= '<a href="' .  esc_url( $item->get_permalink() ) . '">';
                        }

                        $card_content .= esc_html( $item->get_title() );

                        if(in_array('link', $toDisplay )){
                          $card_content .= '</a>';
                        }

                        $card_content .= '</h2>';
                      }
                      $card_content .= '<p class="meta">';
                      if(in_array('author', $toDisplay )){
                        $card_content .= '<span class="feedAuthor"><i class="fa fa-user"></i> ' . esc_html( $sermonAuthor->get_name() ) . '</span>';
                      }
                      if(in_array('date', $toDisplay )){
                        $card_content .= '<span class="feedDate"><i class="fa fa-calendar"></i> ' . esc_html( $item->get_date(get_option( 'date_format' )) ) . '</span>';
                      }
                      $card_content .= '</p>';
                      if(in_array('summary', $toDisplay )){
                        $card_content .= '<p>';
                        $card_content .= $item->get_description();
                        $card_content .= '</p>';
                      }
                      $card_content .= '</li>';

                    }
                    
                endforeach; 

            endif; 
        $card_content .= '</ul>';

        $card_content .= $sermonFeed;

       $card_content .= '</div>';
        return $card_content;

    }else{
        return $card_content;
    }

    
  }

  add_filter('wpcc_card_content', 'wpccb_rss_card');

