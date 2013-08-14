<div class="content-wrap">
  <?php
  if($scrollspy)
  {
  ?>
    <div class="content-scrollspy">
      <ul id="spyMenu">
        <?php render_cpt_with_template('team', 'team_profile_scrollspy_li'); ?>
      </ul>
    </div>
  <?php } ?>
  <div class="content-body <?php if(!$scrollspy) { echo 'content-body-fullwidth'; } ?>">
    <?php render_cpt_with_template('team', 'team_profile'); ?>
  </div>
</div>