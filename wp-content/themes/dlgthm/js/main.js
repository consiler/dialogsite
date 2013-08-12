/*              ,i1i:        ,tLfi.       .;ii;.                                  
 *            ittttttt1.   1GGGGGGGG,   ,tttttttt:                                
 *           ;ttttttttt1  iGGGGGGGGGG. .tttttttttt,                               
 *           itttttttttt  1GGGGGGGGGG, ,tttttttttt:                               
 *            1tttttttt,   LGGGGGGGGi   ;tttttttt;                                
 *             .;1tti,      .tCGGLi       :1tt1:                                  
 *                                                                                
 *                                                                                
 *                                                                                
 * ,111111i:.     ;;              ;;                                :,            
 * ,t.      ;t,   ..              ;i                                ;,            
 * ,t.       ,t.  ;;    ;1ttt;    ;i    .it1ti.     .it1t;.1,            .:::.    
 * ,t.        1:  i;  .t,    :1   ;i   1i     ;1   ii     it,       t: ,t,   :t.  
 * ,t.        1:  i;     .,,:1t   ;i  :1       1: ,t.     .t,       t: ,ti.       
 * ,t.       ,t.  i;  ,t:.   ,t   ;i  :1       1: .t.     .t,       t:    ,:it1,  
 * ,t.      ;t,   i;  ;i     1t   ;i   1;     ;1   ;1.   .1t,       t: 1;     ;t  
 * ,11111ii:      ;;   :1t11: ;1. ;;    .it1ti,      ,;i;..t,  :t   t:  iti;;1i.  
 *                                                 ii     ;1        t:            
 *                                                  ,i1tti,       it;              
 */
//Note: The jQuery that comes with Wordpress does not make use of the convenient $ shorthand variable.
//But we can still use $ with a scriptwide anonymous function.
(function($) {
  //Globals
  var navMenuWrap = $('.header-inner');
  var spyBar = $('#spyMenu');
  $(document).ready(function(){
    //Top Navigation Menu
    //Populate the grey sub menu
    // This takes the dropdown menu associated with the current section and moves it to the silver menu
    var currentPageCategoryDropDownMenu = $('li.current_page_item > .children');
    // "Is current page a category page with a dropdown menu containing child pages?"
    if(currentPageCategoryDropDownMenu.length !== 0)
    {
      // If we found a dropdown menu, we add a class that changes the dropdown menu's look
      //to a padded horizontal list of links, and add it to the silver bar
      //directly under the main navigation bar.
      currentPageCategoryDropDownMenu.addClass('second-menu-horizontal').appendTo('.second-menu');
    } else {
      // If we cannot find a drop down menu, our current section must not have any child pages.
      // Is the current page a child page? Look for a parent.
      var parentPageCategoryDropDownMenu = $('li.current_page_parent > .children');
      if(parentPageCategoryDropDownMenu.length !== 0)
      {
        // If there is a parent, we just move that parent's list (siblings of the current page) to the
        //silver sub-navigation bar. Otherwise, we do nothing.
        parentPageCategoryDropDownMenu.addClass('second-menu-horizontal').appendTo('.second-menu');
      }
    }
    // Assign a theme color to all the main pages
    var themeColors = ['blue', 'red', 'orange', 'yellow', 'green', 'beige', 'beigee', 'beigeee'];
    // Iterate over the top level navigation menu links, adding their color class.
    $(".menu > ul > li").each(function(i) {
     $(this).addClass("menu-top-level-"+themeColors[(i % themeColors.length)]);
    });
    // Initialize parallax scrolling
    $.stellar();
    // SpyBar
    // Spybar container positioning set up (stick to top menu on scroll down)
    var spyBarHeight = spyBar.outerHeight(),
        // pixels from top of page to bounding box excluding margin/padding
        spyBarYPosition = spyBar.offset.top,
        // state variable to track whether the spy bar is static (moves with page) or fixed (does not move with page)
        isTheSpyBarStaticRightNow = true,
    // Spybar page section tracking set up
        // id of spybar link highlighted on the last frame
        lastId,
        // top fixed nav height
        topMenuHeight = navMenuWrap.outerHeight(),
        // Spy Bar list links
        menuItems = spyBar.find("a"),
        // Anchors corresponding to menu items
        scrollItems = menuItems.map(function(){
          var item = $($(this).attr("href"));
          if (item.length) { return item; }
        });

    //Scroll tracking loop
    $(window).scroll(function(){
      // Find out how much the user has scrolled down the page
      var scrolledOffset = $(this).scrollTop() + topMenuHeight;
      // If the bottom of the fixed nav menu hits the top of the spy bar...
      if(scrolledOffset > spyBarYPosition){
        // no need to make it fixed if it already is
        if(isTheSpyBarStaticRightNow)
        {
          spyBar.addClass('stuck');
          spyBar.css({'position' : 'fixed'});
          isTheSpyBarStaticRightNow = false;
        }
      } else {
        // otherwise we have not scrolled the nav menu far down enough to touch the static spybar
        // check if we need to change the spybar
        if(!isTheSpyBarStaticRightNow)
        {
          spyBar.removeClass('stuck');
          spyBar.css({'position' : 'static'});
          isTheSpyBarStaticRightNow = true;
        }
      }
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
      if (lastId !== id)
      {
        lastId = id;
        // Set/remove active class
        menuItems
          .parent().removeClass("active")
          .end().filter("[href=#"+id+"]").parent().addClass("active");
       }                   
      });

    // Bind click handler to menu items
    // so we can get a fancy scroll animation to the desired section on click
    menuItems.click(function(e){
      var href = $(this).attr("href");
      var offsetTop = href === "#" ? 0 : $(href).offset().top-topMenuHeight+1-15;
      $('html, body').stop().animate({ 
          scrollTop: offsetTop
      }, 300);
      e.preventDefault();
    });

      /**
       * Arranges footer widgets vertically.
       */
      
      if ( $.isFunction( $.fn.masonry ) ) {
        var columnWidth = body.is( '.sidebar' ) ? 228 : 245;
        echo 'columnWidth';
        $( '#secondary .widget-area' ).masonry( {
          itemSelector: '.widget',
          columnWidth: columnWidth,
          gutterWidth: 20,
          isRTL: body.is( '.rtl' )
        } );
      }

    //Add filter Easter Eggs.
    // 'body_class' : 'key sequence'
    //@requires 'key sequence'.length < 30
    var easter_eggs = {'sepia': 'toyourpoint',
                      'black-and-white': 'goingforward',
                      'inverted': 'reachingout',
                      'contrast': 'crushingit'};
    var key_history = "";
    var key_memory = 0;
    for(var egg_key in easter_eggs)
    {
      if(easter_eggs[egg_key].length > key_memory)
      {
        key_memory = easter_eggs[egg_key].length;
      }
    }
    $('body').bind('keypress', function(e) {
      var code = (e.keyCode ? e.keyCode : e.which);
      var letter = String.fromCharCode(code);
      key_history += letter;
      while(key_history.length > key_memory){
        key_history = key_history.substr(1);
      }
      for(var egg_key in easter_eggs)
      {
        if(key_history.indexOf(easter_eggs[egg_key]) != -1)
        {
          for(var egg_key_2 in easter_eggs)
          {
            $('body').removeClass(egg_key_2);
          }
          $('body').addClass(egg_key);
        }
      }
    });
  });
})(jQuery);