<?php
/* Template Name: Contact Page */
?>
<div class="content-wrap">
  <div class="content-body <?php if(!$scrollspy) { echo 'content-body-fullwidth'; } ?>">
    <?php
      the_content();
    ?>
  </div>
</div>