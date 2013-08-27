<?php
/*
Template: Watermelon Template Thing
Comment: Whateva.
*/
$required_fields = array('color');
$fieldset = verified_fieldset($required_fields);
if($fieldset) {
?>
<h1 style="color: <?php echo $fieldset['color']; ?>;">Watermelon</h1>
<?php } else {
  fieldset_mismatch_error($required_fields);
} ?>