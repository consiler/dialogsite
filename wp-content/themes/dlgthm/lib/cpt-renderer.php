<?php
$debug = false;

// Displaying a post
function the_cpt_post($template_name)
{
  $templates = CONTENT_TEMPLATE_PATH.'template-'.$template_name.'.php';
  require locate_template($templates);
}

// Display the entire CPT for the current page
function render_cpt_with_template($cpt_name, $template_name = NULL)
{
  global $post;
  if($cpt_name)
  {
    $query_args = array('post_type' => $cpt_name, 'orderby' => 'time', 'order' => 'ASC');
    $all_posts = get_posts($query_args);
    foreach($all_posts as $post)
    {
      setup_postdata($post);
      $tax = wp_get_post_terms(get_the_ID(), CPT_TEMPLATE_TAX_NAME);
      if(is_null($template_name))
        {
          the_cpt_post($tax[0]->slug);
        }
      else { the_cpt_post($template_name); }
    }
    wp_reset_postdata();
  }
}

// This matches an array of field names with the actual fields assigned to the post.
// If the assigned fieldset has all the fields we need for the template, we return them.
// Otherwise, we just return false to indicate that the fieldset is missing fields required by the template.
function verified_fieldset($expected_fieldset)
{
  $assigned_fieldset = get_fields();
  foreach($expected_fieldset as $expected_field)
  {
    if(!in_array($expected_field, array_keys($assigned_fieldset)))
    {
      return false;
    }
  }
  return $assigned_fieldset;
}

function page_get_cpt_list()
{
  $cpt_list = get_field('cpt_slug');
  if($cpt_list)
  {
    return explode(',', $cpt_list);
  } else return false;
}

function fieldset_mismatch_error($required_fields)
{
  $output = 'Assigned fieldset does not match template fieldset in CPT template slide-bigh1. Required Fields: ';
  foreach ($required_fields as $required_field) { 
    $output .= $required_field . '| ';
  }
  echo $output;
}
?>