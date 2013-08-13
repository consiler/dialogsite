<?php
function content_templates_taxonomy_init() {
  // get the names of all the CPTs so we can assign the content_templates taxonomy to them
  $pt = get_post_types(array('show_ui' => true));
  // list of post types we won't consider for this tax, i.e. utility CPTs like acf, post, attachment, and page
  $pt_ignores = array('post', 'page', 'acf', 'attachment');
  $pt_to_assign_our_tax_to = array_diff($pt, $pt_ignores);
  // create a new taxonomy
  $labels = array(
    'name'              => _x( 'Content Templates', 'taxonomy general name' ),
    'singular_name'     => _x( 'Content Template', 'taxonomy singular name' ),
    'search_items'      => __( 'Search Templates' ),
    'all_items'         => __( 'All Templates' ),
    'parent_item'       => __( 'Parent Template' ),
    'parent_item_colon' => __( 'Parent Template:' ),
    'edit_item'         => __( 'Edit Template' ),
    'update_item'       => __( 'Update Template' ),
    'add_new_item'      => __( 'Add New Content Template' ),
    'new_item_name'     => __( 'New Content Template Name' ),
    'menu_name'         => __( 'CPT Templates' ),
  );

  $args = array(
    'hierarchical'      => false,
    'labels'            => $labels,
    'show_ui'           => true,
    'show_admin_column' => true,
    'query_var'         => true,
    'public'            => true
  );

  register_taxonomy( CPT_TEMPLATE_TAX_NAME, $pt_to_assign_our_tax_to, $args );
}
add_action( 'init', 'content_templates_taxonomy_init' );
?>