<?php
/**
 * Displays navigation to next/previous set of posts when applicable.
 *
 * @since Twenty Thirteen 1.0
 *
 * @return void
 */

if ( ! function_exists( 'dialog_paging_nav' ) ) :

function dialog_paging_nav() {
  global $wp_query;

  // Don't print empty markup if there's only one page.
  if ( $wp_query->max_num_pages < 2 )
    return;
  ?>
  <nav class="navigation paging-navigation" role="navigation">
    <h1 class="screen-reader-text"><?php _e( 'Posts navigation', 'twentythirteen' ); ?></h1>
    <div class="nav-links">

      <?php if ( get_next_posts_link() ) : ?>
      <div class="nav-previous"><?php next_posts_link( __( '<span class="meta-nav">&larr;</span> Older posts', 'twentythirteen' ) ); ?></div>
      <?php endif; ?>

      <?php if ( get_previous_posts_link() ) : ?>
      <div class="nav-next"><?php previous_posts_link( __( 'Newer posts <span class="meta-nav">&rarr;</span>', 'twentythirteen' ) ); ?></div>
      <?php endif; ?>

    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}
endif;

if ( ! function_exists( 'dialog_post_nav' ) ) :
/**
 * Displays navigation to next/previous post when applicable.
* @return void
*/
function dialog_post_nav() {
  global $post;

  // Don't print empty markup if there's nowhere to navigate.
  $previous = ( is_attachment() ) ? get_post( $post->post_parent ) : get_adjacent_post( false, '', true );
  $next     = get_adjacent_post( false, '', false );

  if ( ! $next && ! $previous )
    return;
  ?>
  <nav class="navigation post-navigation" role="navigation">
    <h1 class="screen-reader-text"><?php _e( 'Post navigation', 'twentythirteen' ); ?></h1>
    <div class="nav-links">

      <?php previous_post_link( '%link', _x( '<span class="meta-nav">&larr;</span> %title', 'Previous post link', 'twentythirteen' ) ); ?>
      <?php next_post_link( '%link', _x( '%title <span class="meta-nav">&rarr;</span>', 'Next post link', 'twentythirteen' ) ); ?>

    </div><!-- .nav-links -->
  </nav><!-- .navigation -->
  <?php
}
endif;
?>