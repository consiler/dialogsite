<?php
/**
 * Prints HTML with meta information for current post: categories, tags, permalink, author, and date.
 * @return void
 */

if ( ! function_exists( 'dialog_entry_meta' ) ) :

function dialog_entry_meta() {
  if ( is_sticky() && is_home() && ! is_paged() )
    echo '<span class="featured-post">Sticky</span>';

  if ( ! has_post_format( 'link' ) && 'post' == get_post_type() )
    dialog_entry_date();

  // Translators: used between list items, there is a space after the comma.
  $categories_list = get_the_category_list( __( ', ', 'twentythirteen' ) );
  if ( $categories_list ) {
    echo '<span class="categories-links">' . $categories_list . '</span>';
  }

  // Translators: used between list items, there is a space after the comma.
  $tag_list = get_the_tag_list( '', __( ', ', 'twentythirteen' ) );
  if ( $tag_list ) {
    echo '<span class="tags-links">' . $tag_list . '</span>';
  }

  // Post author
  if ( 'post' == get_post_type() ) {
    printf( '<span class="author vcard"><a class="url fn n" href="%1$s" title="%2$s" rel="author">%3$s</a></span>',
      esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
      esc_attr( sprintf( __( 'View all posts by %s', 'twentythirteen' ), get_the_author() ) ),
      get_the_author()
    );
  }
}
endif;

if ( ! function_exists( 'dialog_entry_date' ) ) :
/**
 * Prints HTML with date information for current post.
 * @param boolean $echo Whether to echo the date. Default true.
 * @return string The HTML-formatted post date.
 */
function dialog_entry_date( $echo = true ) {
  if ( has_post_format( array( 'chat', 'status' ) ) )
    $format_prefix = _x( '%1$s on %2$s', '1: post format name. 2: date', 'dialog' );
  else
    $format_prefix = '%2$s';

  $date = sprintf( '<span class="date"><a href="%1$s" title="%2$s" rel="bookmark"><time class="entry-date" datetime="%3$s">%4$s</time></a></span>',
    esc_url( get_permalink() ),
    esc_attr( sprintf('Permalink to %s', the_title_attribute( 'echo=0' ) ) ),
    esc_attr( get_the_date( 'c' ) ),
    esc_html( sprintf( $format_prefix, get_post_format_string( get_post_format() ), get_the_date() ) )
  );

  if ( $echo )
    echo $date;

  return $date;
}
endif;
?>