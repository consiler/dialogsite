(function($) {
  // Cache selectors
  var lastId,
      topMenu = $("#top-menu"),
      topMenuHeight = topMenu.outerHeight()+15,
      // All list items
      menuItems = topMenu.find("a"),
      // Anchors corresponding to menu items
      scrollItems = menuItems.map(function(){
        var item = $($(this).attr("href"));
        if (item.length) { return item; }
      });

  // Bind click handler to menu items
  // so we can get a fancy scroll animation
  menuItems.click(function(e){
    var href = $(this).attr("href"),
        offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1;
    $('html, body').stop().animate({ 
        scrollTop: offsetTop
    }, 300);
    e.preventDefault();
  });

  // Bind to scroll
  $(window).scroll(function(){
     // Get container scroll position
     var fromTop = $(this).scrollTop()+topMenuHeight;
     
     // Get id of current scroll item
     var cur = scrollItems.map(function(){
       if ($(this).offset().top < fromTop)
         return this;
     });
     // Get the id of the current element
     cur = cur[cur.length-1];
     var id = cur && cur.length ? cur[0].id : "";
     
     if (lastId !== id) {
         lastId = id;
         // Set/remove active class
         menuItems
           .parent().removeClass("active")
           .end().filter("[href=#"+id+"]").parent().addClass("active");
     }                   
  });

    /**
   * 
   * Wordpress Default Theme Code
   * 
   */

  var body    = $( 'body' ),
      _window = $( window );

  /**
   * Adds a top margin to the footer if the sidebar widget area is higher
   * than the rest of the page, to help the footer always visually clear
   * the sidebar.
   */
  $( function() {
    if ( body.is( '.sidebar' ) ) {
      var sidebar   = $( '#secondary .widget-area' ),
          secondary = ( 0 == sidebar.length ) ? -40 : sidebar.height(),
          margin    = $( '#tertiary .widget-area' ).height() - $( '#content' ).height() - secondary;

      if ( margin > 0 && _window.innerWidth() > 999 )
        $( '#colophon' ).css( 'margin-top', margin + 'px' );
    }
  } );

  /**
   * Enables menu toggle for small screens.
   */
  ( function() {
    var nav = $( '#site-navigation' ), button, menu;
    if ( ! nav )
      return;

    button = nav.find( '.menu-toggle' );
    if ( ! button )
      return;

    // Hide button if menu is missing or empty.
    menu = nav.find( '.nav-menu' );
    if ( ! menu || ! menu.children().length ) {
      button.hide();
      return;
    }

    $( '.menu-toggle' ).on( 'click.twentythirteen', function() {
      nav.toggleClass( 'toggled-on' );
    } );
  } )();

  /**
   * Makes "skip to content" link work correctly in IE9 and Chrome for better
   * accessibility.
   *
   * @link http://www.nczonline.net/blog/2013/01/15/fixing-skip-to-content-links/
   */
  _window.on( 'hashchange.twentythirteen', function() {
    var element = document.getElementById( location.hash.substring( 1 ) );

    if ( element ) {
      if ( ! /^(?:a|select|input|button|textarea)$/i.test( element.tagName ) )
        element.tabIndex = -1;

      element.focus();
    }
  } );

  /**
   * Arranges footer widgets vertically.
   */
  if ( $.isFunction( $.fn.masonry ) ) {
    var columnWidth = body.is( '.sidebar' ) ? 228 : 245;

    $( '#secondary .widget-area' ).masonry( {
      itemSelector: '.widget',
      columnWidth: columnWidth,
      gutterWidth: 20,
      isRTL: body.is( '.rtl' )
    } );
  }

})(jQuery);