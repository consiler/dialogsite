<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" <?php language_attributes(); ?>> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" <?php language_attributes(); ?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes(); ?>>
<!--<![endif]-->
  <head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <meta name="viewport" content="width=device-width">
    <title><?php wp_title( '|', true, 'right' ); ?></title>
    <link rel="profile" href="http://gmpg.org/xfn/11">
    <link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
    <!--[if lt IE 9]>
    <script src="<?php echo get_template_directory_uri(); ?>/js/html5.js"></script>
    <![endif]-->
    <?php wp_head(); ?>
  </head>
<?php
$defaults = array(
  'theme_location'  => 'Navigation Menu',
  'menu'            => '.menu',
  'container'       => 'div',
  'container_class' => 'dialog-menu',
  'container_id'    => 'dialog-menu',
  'menu_class'      => 'menu',
  'menu_id'         => '',
  'echo'            => true,
  'fallback_cb'     => 'wp_page_menu',
  'before'          => '',
  'after'           => '',
  'link_before'     => '',
  'link_after'      => '',
  'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
  'depth'           => 2,
  'walker'          => ''
);
?>
  <body <?php body_class(); ?>>
    <div class="header-wrap">
        <div class="header-inner">
          <div class="menu-wrap">
            <div class="menu-logo">
              <div class="logo-top"></div>
              <img class="logo-bottom" src="<?php bloginfo('template_url'); ?>/images/dialog-logo.png">
            </div>
            <?php
            wp_nav_menu( $defaults );
            ?>
            <div class="clearfix"></div>
          </div>
        </div>
        <div class="second-menu-wrap">
          <div class="second-menu">
          </div>
        </div>
      </div>
    <div id="body-wrap">