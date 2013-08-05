<?php
/*
 *-------------------------------------------------------
 *
 *                    Additional Styles
 *
 *-------------------------------------------------------
*/

function theme_styles()  
{ 
  // Register the style like this for a theme:  
  // (First the unique name for the style (custom-style) then the src, 
  // then dependencies and ver no. and media type)
  wp_register_style( 'app-style', 
    get_bloginfo('template_url').'/css/main.min.css', 
    array(), 
    '0.1', 
    'all'
    //optionally screen, handheld, print
    );

  // enqueing the style:
  wp_enqueue_style( 'app-style' );
}
//adding the hook
add_action('wp_enqueue_scripts', 'theme_styles');
?>