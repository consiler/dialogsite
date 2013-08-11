    
    <footer id="colophon" class="site-footer" role="contentinfo">
       <?php get_sidebar( 'main' ); ?>
    </footer><!-- #colophon -->

  </div>
<div class="footer-wrap">
  <div class="footer-inner">
    <div class="footer-menu-wrap">
      <?php
      wp_nav_menu( $defaults );
      ?>
    </div>
  </div>
</div>
<?php wp_footer(); ?>
</body>
</html>