<div id="banner" data-stellar-background-ratio="0.5">
  <h1>Team</h1>
  <div id="banner-white-fade"></div>
</div>
<?php
  $args = array('post_type' => 'leadership_people', 'orderby' => 'time', 'order' => 'ASC');
  $cpts = get_posts($args);
  $cpt_store = array();
  foreach($cpts as $post)
  {
    setup_postdata($post);
    $cpt_store[] = array('title' => get_the_title(), 'content' => get_the_content(), 'id' => get_the_ID());
  }
  wp_reset_postdata();
?>
<div class="content-wrap">
  <div class="content-scrollspy">
    <ul id="spyMenu">
      <?php
      foreach($cpt_store as $cpt) {
      ?>
      <li>
        <a href="#content-section-<?php echo $cpt['id']; ?>"><?php echo $cpt['title']; ?></a>
      </li>
      <?php } ?>
    </ul>
  </div>
  <div class="content-body">
    <?php
    foreach($cpt_store as $cpt2) {
    ?>
    <div class="spyOnMe" id="content-section-<?php echo $cpt2['id']; ?>">
      <h1><?php echo $cpt2['title']; ?></h1>
      <?php echo $cpt2['content']; ?>
    </div>
    <?php } ?>
  </div>
</div>