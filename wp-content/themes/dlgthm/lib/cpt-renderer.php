<?php
// Displaying a post
function the_cpt_post()
{
  $template_id = get_field('template_term');
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
?>