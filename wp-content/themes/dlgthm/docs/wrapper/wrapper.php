<?php get_header( global_template_base() ); ?>
<div id="banner-parallax-control">
</div>
<!-- data-stellar-background-ratio="0.5"
 --><div id="banner" data-custom-background-image="<?php echo get_field('hero_banner')['url']; ?>" data-stellar-ratio="2" data-stellar-vertical-offset="95" data-stellar-offset-parent="true">
  <!-- <div id="banner-white-fade"></div> -->
</div>
<div id="banner-bg-filler"></div>
<div id="page-heading-wrap">
  <div id="page-heading-inner">
    <h1 id="page-heading"><?php the_title(); ?></h1>
  </div>
</div>
<?php include global_template_path(); ?>
<?php get_footer( global_template_base() ); ?>