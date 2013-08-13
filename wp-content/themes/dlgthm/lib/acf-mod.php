<?php
add_filter('acf/location/rule_types', 'acf_location_rules_types');
function acf_location_rules_types( $choices )
{
    $choices['Basic']['tax'] = 'Content Template Taxonomy Term';
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
?>