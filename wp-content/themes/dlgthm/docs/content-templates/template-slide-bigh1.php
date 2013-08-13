<?php
/*
Template: FS Slide Big H1
Comment: A template for a basic fullwidth slide with arbitrary bg color and text color. Text is bolded, center.
*/
$required_fields = array(
  'background-color',
  'color',
  'big_centered_title_text');
$fieldset = verified_fieldset($required_fields);
if($fieldset) {
?>
<div class="block-wrap" style="background-color: <?php echo $fieldset['background-color']; ?>;">
  <div class="block-center">
    <h1 style="color: <?php echo $fieldset['color']; ?>;"><?php echo $fieldset['big_centered_title_text']; ?></h1>
  </div>
</div>
<?php } else { echo('Assigned fieldset does not match template fieldset in CPT template slide-bigh1.'); } ?>