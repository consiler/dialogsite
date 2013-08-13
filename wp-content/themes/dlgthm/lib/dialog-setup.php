<?php
/**
 * Sets max width for page content like images, etc.
 * @see twentythirteen_content_width() for template-specific adjustments.
 */

if ( ! isset( $content_width ) )
  $content_width = CONTENT_WIDTH;

/**
 * Sets up theme defaults and registers the various WordPress features that
 * Dialog Theme supports.
 * @uses add_theme_support() To add support for automatic feed links, post
 * formats, and post thumbnails.
 * @uses register_nav_menu() To add support for a navigation menu.
 * @uses set_post_thumbnail_size() To set a custom post thumbnail size.
 * @since Dialog 0.1
 * @return void
 */
function dialog_setup() {
  // Adds RSS info in head
  add_theme_support('automatic-feed-links');

  // Switches default core markup for search form, comment form, and comments
  // to output valid HTML5.
  add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

  register_nav_menus( 
    array(
       'header-menu' => 'Header Menu',
       'footer-menu' => 'Footer Menu'
      )
    );
  
  //custom img size for featured img, disp. on std. posts/pages.
  //add_theme_support( 'post-thumbnails' );
  //set_post_thumbnail_size(THUMB_W, THUMB_H, CROP_THUMBS);
}
add_action('after_setup_theme', 'dialog_setup');
?>