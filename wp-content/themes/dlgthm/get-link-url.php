<?php
/**
 * Returns the URL from the post.
 * @uses get_url_in_content() to get the URL in the post meta (if it exists) or
 * the first link found in the post content.
 * Falls back to the post permalink if no URL is found in the post.
 * @return string The Link format URL.
 */

function dialog_get_link_url() {
  $content = get_the_content();
  $has_url = get_url_in_content( $content );

  return ( $has_url ) ? $has_url : apply_filters( 'the_permalink', get_permalink() );
}
?>