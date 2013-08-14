<div class="content-wrap">
  <?php
  //bool - do we want to use a scrollspy sidebar to index the posts?
  $scrollSpy = get_field('scrollspy');
  var_dump($scrollSpy);
  if($scrollSpy)
  {
  ?>
    <div class="content-scrollspy">
      <ul id="spyMenu">
        <?php render_cpt_with_template('team', 'team_profile_scrollspy_li'); ?>
      </ul>
    </div>
  <?php } ?>
  <div class="content-body <?php if(!$scrollSpy) { echo 'content-body-fullwidth'; } ?>">
    <?php render_cpt_with_template('team', 'team_profile'); ?>
  </div>
</div>