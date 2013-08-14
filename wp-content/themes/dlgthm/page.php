<div class="content-wrap">
  <?php
  if($scrollspy)
  {
  ?>
    <div class="content-scrollspy">
      <ul id="spyMenu">
        <style type="text/css">
          #spyMenu > li.active > a { border-right: 5px  solid; color: <?php echo $theme_color; ?>; }
        </style>
        <?php render_cpt_with_template('team', 'team_profile_scrollspy_li'); ?>
      </ul>
    </div>
  <?php } ?>
  <div class="content-body <?php if(!$scrollspy) { echo 'content-body-fullwidth'; } ?>">
    <?php render_cpt_with_template('team', 'team_profile'); ?>
  </div>
</div>