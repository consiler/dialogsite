<?php
$cpt = get_field("cpt_slug");
$args = array('post_type' => $cpt, 'orderby' => 'time', 'order' => 'ASC');
$cpt_posts = get_posts($args);
foreach($cpt_posts as $post)
{
  setup_postdata($post);
  ?>
    <div class="block-wrap slide-bigh1-wrap" id="purpose-strategy-execution-wrap" style="background-color: <?php the_field('background-color'); ?>;">
      <h1 style="color: <?php the_field('color'); ?>;"><?php the_field('big_centered_title_text'); ?></h1>
    </div>
  <?php
}
wp_reset_postdata();
?>
<div id="form-example">
  <?php
the_content();?>
</div>