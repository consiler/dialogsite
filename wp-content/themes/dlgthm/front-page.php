<?php
$l = page_get_cpt_list();
$frontpage_slides = $l[0];
render_cpt_with_template($frontpage_slides, 'slide-bigh1');
?>