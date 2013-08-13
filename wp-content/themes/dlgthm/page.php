<?php the_field('scrollspy'); ?>
<div class="content-wrap">
  <div class="content-scrollspy">
    <ul id="spyMenu">
      <?php
      //foreach($cpt_store as $cpt) {
      ?>
      <li>
        <a href="#content-section-<?php //echo $cpt['id']; ?>"><?php //echo $cpt['title']; ?></a>
      </li>
      <?php //} ?>
    </ul>
  </div>
  <div class="content-body">
    <?php
    //foreach($cpt_store as $cpt2) {
    ?>
    <div class="spyOnMe" id="content-section-<?php //echo $cpt2['id']; ?>">
      <h1><?php //echo $cpt2['title']; ?></h1>
      <?php //echo $cpt2['content']; ?>
    </div>
    <?php //} ?>
  </div>
</div>