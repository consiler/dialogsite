<?php
/**
 * Widgets.
 * @return void
 */
function dialog_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Main Widget Area', 'twentythirteen' ),
    'id'            => 'sidebar-1',
    'description'   => __( 'Appears in the footer section of the site.', 'twentythirteen' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );

  register_sidebar( array(
    'name'          => __( 'Secondary Widget Area', 'twentythirteen' ),
    'id'            => 'sidebar-2',
    'description'   => __( 'Appears on posts and pages in the sidebar.', 'twentythirteen' ),
    'before_widget' => '<aside id="%1$s" class="widget %2$s">',
    'after_widget'  => '</aside>',
    'before_title'  => '<h3 class="widget-title">',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'dialog_widgets_init' );
?>