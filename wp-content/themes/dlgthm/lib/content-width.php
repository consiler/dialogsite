<?php
/**
 * Adjusts content_width value for video post formats and attachment templates.
 * @return void
 */

function dialog_content_width() {
  global $content_width;
}
add_action( 'template_redirect', 'dialog_content_width' );
?>