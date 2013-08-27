<div class="content-wrap">
  <div class="content-body <?php if(!$scrollspy) { echo 'content-body-fullwidth'; } ?>">
    <?php //render_cpt_with_template('team', 'team_profile'); ?>
    <?php
      $cpt_info = get_field('cpt_set');
      render_cpt_with_template($cpt_info);
    ?>
  </div>
</div>