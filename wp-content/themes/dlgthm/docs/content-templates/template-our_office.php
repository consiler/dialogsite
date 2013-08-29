<?php
/*
Template: Office Member Bios
Comment: A template for a list/grid of people in the office
*/
$required_fields = array();
$fieldset = verified_fieldset($required_fields);
if($fieldset) {
?>
<div class="our_office">
   <?php render_cpt_with_template('our_office', 'our_office'); ?>
</div>
<?php } else {
  fieldset_mismatch_error($required_fields);
} ?>