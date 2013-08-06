<?php
/**
 * Adjusts content_width value for video post formats and attachment templates.
 * @return void
 */

function dialog_content_width() {
  global $content_width;

  if ( is_attachment() )
    $content_width = 724;
  elseif ( has_post_format( 'audio' ) )
    $content_width = 484;
}
add_action( 'template_redirect', 'dialog_content_width' );
?>