"use strict";

(function ($) {
  $(document).ready(function () {
    stm_nav_toggle();
  });
  $(window).on('load', function () {
    $('.ulearn_loader_bg').delay(1200).fadeToggle();
  });

  var stm_nav_toggle = function stm_nav_toggle() {
    $('.mobile-switcher').on('click', function (e) {
      e.preventDefault();
      e.stopPropagation();
      $(this).toggleClass('active');
      $(this).parent().toggleClass('active').find('.navigation-menu').toggleClass('active');
    });
    $(".ulearn-menu li.menu-item-has-children > a").after('<span class="arrow"></span>');
    $('.ulearn-menu > li.menu-item-has-children .arrow').on('click', function () {
      var $this = $(this);

      if ($this.hasClass('active')) {
        $this.toggleClass('active');
        $this.parent().toggleClass('active');
      } else {
        $this.addClass('active');
        $this.parent().addClass('active');
      }
    });
  };
})(jQuery);