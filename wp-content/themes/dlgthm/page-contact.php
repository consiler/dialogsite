<?php
//cpt naming standards: {page_slug}_content
$cpt = get_field("cpt_slug");
$args = array('post_type' => $cpt, 'orderby' => 'time', 'order' => 'ASC');
$cpt_posts = get_posts($args);
foreach($cpt_posts as $post)
{
  setup_postdata($post);
  render_cpt_template(get_field('template_term'));
}
wp_reset_postdata();
?>
<div id="form-example">
  <?php the_content(); ?>
</div>