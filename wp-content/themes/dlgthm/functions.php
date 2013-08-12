<?php
/*
* 
*               .-://:-`       `:+oso+-`       `-://:-.                
*             -+ooooooo+:`   `+hdddddddh/    `/+ooooooo+.              
*            .ooooooooooo/   oddddddddddd/   +ooooooooooo.             
*            /oooooooooooo`  ddddddddddddy  `oooooooooooo:             
*            -ooooooooooo/   sddddddddddd+   +ooooooooooo.             
*             -+ooooooo+/`   `oddddddddh+`   `/oooooooo+-              
*              `.:///:-`       ./osyso:.       `-:///:.`               
*                                                                                                                                            
*                                                                      
*                     
* `+/:::::::/-`     :/                 -+                              
* `o:       `-+:    ``                 :o                              
* `o:         .o-   -:    `-::::::.    :o     `-:::::-`     `.:::::.`:.
* `o:          ++   /+   `+/`   `-+.   :o    :+-`  ``:+.   `//.`  `-/o-
* `o:          /o   /+   `.`  ```.o-   :o   .o.       :o`  /+       -o-
* `o:          +/   /+    .::::---o-   :o   :o        .o-  o:       .o-
* `o:         :o.   /+   /+.`    `o-   :o   -o.       -o`  /+       :o-
* `o:```````-//.    /+   /+`   `.:o:`  :o    :+.`   `-+-   `//.```.:/o-
* `//:::::::-.      ::   `:/::::-`-/-  -/     .::::::-`      .-:::-..o.
*                                                         ./`      :+` 
*                                                          -/:----//.  
*                                                            `....`   
*/
$libfiles = array(
  'settings',
  'dialog-setup',
  'scripts-styles',
  'widgets',
  'paging-nav',
  'entry-meta-date',
  'attached-image',
  'get-link-url',
  'body-class',
  'content-width',
  'wrapper',
  'cpt-content-admin-menu'
  );
$libdir = "lib/";
//Must be loaded in order.
foreach($libfiles as $file) require_once(locate_template($libdir.$file.'.php'));

define('CPT_TEMPLATE_TAX_NAME', 'content_templates');

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

add_filter('acf/location/rule_types', 'acf_location_rules_types');
function acf_location_rules_types( $choices )
{
    $choices['Basic']['tax'] = 'Taxonomy Term';
    return $choices;
}
add_filter('acf/location/rule_values/tax', 'acf_location_rules_values_tax');
function acf_location_rules_values_tax( $choices )
{
    $terms = get_terms(CPT_TEMPLATE_TAX_NAME);
 
    if( $terms )
    {
        foreach( $terms as $term )
        {
          $choices[$term->term_id] = $term->name;
        }
    }
 
    return $choices;
}
add_filter('acf/location/rule_match/tax', 'acf_location_rules_match_tax', 10, 3);
function acf_location_rules_match_tax( $match, $rule, $options )
{
    $selected_term_id = (int)$rule['value'];
    $post_terms = wp_get_post_terms( (int)$_GET['post'], CPT_TEMPLATE_TAX_NAME );
    $match = false;
    if($rule['operator'] == "==")
    {
      $match = ( count($post_terms) == 1 && $post_terms[0]->term_id == $selected_term_id );
    }
    elseif($rule['operator'] == "!=")
    {
      $match = ( count($post_terms) == 1 && $post_terms[0]->term_id != $selected_term_id );
    }
    return $match;
}