<?php
/*
Template: Office Person Pane
Comment: A square in the custom headshot grid on the Team page.
*/
$required_fields = array(
  'name',
  'bio',
  'title',
  'headshot');//might not be the right ones
$fieldset = verified_fieldset($required_fields);
if($fieldset) {
?>
it worked
<?php } else {
  fieldset_mismatch_error($required_fields);
} ?>