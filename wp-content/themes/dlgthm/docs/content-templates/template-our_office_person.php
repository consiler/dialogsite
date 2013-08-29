<?php
/*
Template: Office Member Bios
Comment: A template for a list/grid of people in the office
*/
$required_fields = array('grid_person_name', 'grid_person_image');
$fieldset = verified_fieldset($required_fields);
if($fieldset) {
?>
<div class="our_office_person">
   <?php
    $name = get_field("grid_person_name");
    var_dump($name);
   ?>
 </div>
<?php } else {
  fieldset_mismatch_error($required_fields);
} ?>