<?php get_header( global_template_base() ); ?>
<div id="banner" data-stellar-background-ratio="0.5">
  <h1>Team</h1>
</div>
<div class="content-wrap">
  <div class="content-scrollspy">
    <ul id="spyMenu">
      <?php for($i = 0; $i < 10; $i++) {
  ?>
      <li>
        <a href="#div<?php echo $i; ?>">asdfghjkl;</a>
      </li>
      <?php } ?>
    </ul>
  </div>
  <div class="content-body">
    <?php include global_template_path(); ?>
  </div>
</div>
<?php get_sidebar( global_template_base() ); ?>
<?php get_footer( global_template_base() ); ?>