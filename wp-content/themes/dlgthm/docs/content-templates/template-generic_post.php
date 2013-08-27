<?php
/*
Template: Generic Post
Comment: Just an all purpose post template...
*/
$required_fields = array('content');
$fieldset = verified_fieldset($required_fields);
if($fieldset) {
?>
<div class="generic_post">
  <div class="spyOnMe" id="content-section-<?php the_ID(); ?>">
    <h1><?php the_field('title'); ?></h1>
    <h1>test</h1>
    <?php the_field('content'); ?>
  </div>
</div>
<?php } else {
  fieldset_mismatch_error($required_fields);
} ?>