<?php
/**
 * Extends the default WordPress body classes.
 * Adds body classes to denote:
 * 1. Single or multiple authors.
 * 2. Active widgets in the sidebar to change the layout and spacing.
 * 3. When avatars are disabled in discussion settings.
 * @param array $classes A list of existing body class values.
 * @return array The filtered body class list.
 */
function dialog_body_class( $classes ) {
  if ( ! is_multi_author() )
    $classes[] = 'single-author';

  if ( is_active_sidebar( 'sidebar-2' ) && ! is_attachment() && ! is_404() )
    $classes[] = 'sidebar';

  if ( ! get_option( 'show_avatars' ) )
    $classes[] = 'no-avatars';

  return $classes;
}
add_filter( 'body_class', 'dialog_body_class' );
?>