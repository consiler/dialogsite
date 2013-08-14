<?php
//bool - do we want to use a scrollspy sidebar to index the posts?
the_field('scrollspy');
?>
<div class="content-wrap">
  <div class="content-scrollspy">
    <ul id="spyMenu">
      <?php render_cpt_with_template('team', 'team_profile_scrollspy_li'); ?>
    </ul>
  </div>
  <div class="content-body">
    <?php render_cpt_with_template('team', 'team_profile'); ?>
  </div>
</div>