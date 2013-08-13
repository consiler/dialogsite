<?php
// Displaying a post
function the_cpt_post()
{
  $template_id = get_field('template_term');
  if($template_id)
  {
    if(count($template_id) < 1)
    {
      die('You cannot have multiple templates or fieldsets assigned to a single post. Look in cpt-renderer to debug.');
    } else {
      $template_term = get_term($template_id[0], CPT_TEMPLATE_TAX_NAME);
      $templates = CONTENT_TEMPLATE_PATH.'template-'.$template_term->name.'.php';
      echo '<div class="content-template-wrap template-'.$template_term->name.'">';
      require locate_template($templates);
      echo '</div>';
    }
  }
}

// Display the entire CPT for the current page
function the_page_cpt()
{
  global $post;
  $page_cpt_name = get_field('cpt_slug');
  if($page_cpt_name)
  {
    $query_args = array('post_type' => $page_cpt_name, 'orderby' => 'time', 'order' => 'ASC');
    $all_posts = get_posts($query_args);
    foreach($all_posts as $post)
    {
      setup_postdata($post);
      the_cpt_post();
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
?>