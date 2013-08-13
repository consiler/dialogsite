<?php
// Rendering a CPT template
function render_cpt_template($template_id)
{
  if(count($template_id) < 1)
  {
    die('Invalid or malformed template name.');
  } else {
    $t = get_term($template_id[0], 'content_templates');
    $templates = CONTENT_TEMPLATE_PATH.'template-'.$t->name.'.php';
    echo '<div class="content-template-wrap template-'.$t->name.'">';
    require locate_template($templates);
    echo '</div>';
  }
}
?>