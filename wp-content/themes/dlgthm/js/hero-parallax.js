(function($) {
  $(document).ready(function(){
    var topMenuHeight = $('.header-wrap').outerHeight();
    var b = false;
    $(window).scroll(function(){
      var scrolledPos = $(this).scrollTop() + topMenuHeight + 70;
      if(scrolledPos >= 365 && !b)
      {
        $('#banner-parallax-control').show();
        b = true;
      }
      if(scrolledPos < 365 && b)
      {
        $('#banner-parallax-control').hide();
        b = false;
      }
      console.log();
    });
    var banner = $('#banner');
    var bg_img = banner.attr('data-custom-background-image');
    if(bg_img)
    {
      $('#banner').before('<style type="text/css">#banner { background-image: url('+bg_img+'); }</style>')
    }
  });
})(jQuery);