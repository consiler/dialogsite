<?php
// The Query
$i = 0;
$args = array('post_type' => 'leadership_people');
$query = new WP_Query( $args );
?>
<div class="spyOnMe" id="div<?php echo $i; ?>">
<?php
// The Loop
if ( $query->have_posts() ) {
  while ( $query->have_posts() ) {
    $i++;
  }
} else {
  echo "No posts found.";
}
/* Restore original Post Data */
wp_reset_postdata();
?>
</div>