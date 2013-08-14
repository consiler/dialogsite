<?php
/*
Template: Team Member Bio
Comment: A template for a short fixed width bio of senior management.
*/
$required_fields = array(
  'name',
  'bio');
$fieldset = verified_fieldset($required_fields);
if($fieldset) {
?>
<div class="spyOnMe" id="content-section-<?php the_ID(); ?>">
  <h1><?php the_field('name'); ?></h1>
  <p><?php the_field('bio'); ?></p>
</div>
<?php } else {
  fieldset_mismatch_error($required_fields);
} ?>