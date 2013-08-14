(function($) {
  var topMenuHeight = $('.header-wrap').outerHeight();
  var b = false;
  $(window).scroll(function(){
    var scrolledPos = $(this).scrollTop() + topMenuHeight;
    if(scrolledPos >= 245 && !b)
    {
      $('#banner-parallax-control').show();
      b = true;
    }
    if(scrolledPos < 245 && b)
    {
      $('#banner-parallax-control').hide();
      b = false;
    }
    console.log();
  });
})(jQuery);