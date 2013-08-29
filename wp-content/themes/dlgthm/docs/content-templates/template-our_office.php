<?php
/*
Template: Office Member Bios
Comment: A template for a list/grid of people in the office
*/
$required_fields = array('grid_person_name', 'grid_person_image');
$fieldset = verified_fieldset($required_fields);
if($fieldset) {
?>
<div class="our_office">
  <div class="spyOnMe" id="content-section-<?php the_ID(); ?>">
    <h1><?php the_title(); ?></h1>
    <?php 
      the_field(our_office);
    ?>
  </div>
</div>
<?php } else {
  fieldset_mismatch_error($required_fields);
} ?>