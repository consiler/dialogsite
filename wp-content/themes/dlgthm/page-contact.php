<?php
/* Template Name: Contact Page */
?>
<div class="content-wrap content-wrap-pad-top">
  <div class="content-body <?php if(!$scrollspy) { echo 'content-body-fullwidth'; } ?>">
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
    <?php the_content(); ?>
    <?php endwhile; endif; ?>
  </div>
</div>