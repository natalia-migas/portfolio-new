var $loading = $('#loadingDiv').hide();
$(document)
  .ajaxStart(function() {
    $loading.show();
  })
  .ajaxStop(function() {
    $loading.hide();
  });

// jQuery.ajaxSetup({
//   beforeSend: function() {
//     $loading.show();
//   },
//   complete: function(){
//     $loading.hide();
//   },
//   success: function() {}
// });

jQuery(document).ready(function($) {
  $('.scrollable').click(function(e) {
    e.preventDefault();
    var target = $(this).attr('href');
    $('body,html').animate(
      {
        scrollTop: $(target).offset().top
      },
      1000
    );
  });

  $('.navbar-toggler').on('click', function() {
    $(this).toggleClass('active');
  });
});

$(function() {
  var sectionsToWatch = [];
  var menuItems = $('.navbar-nav')
    .eq(0)
    .find('li');
  $(menuItems).each(function() {
    if ($(this).find('a').length) {
      sectionsToWatch.push(
        $(this)
          .find('a')
          .attr('href')
          .replace('#', '')
      );
    }
  });

  $(document).scroll(function() {
    var $nav = $('.fixed-top');
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());

    var scrollTopOffset = $(document).scrollTop();

    $(sectionsToWatch).each(function(k, v) {
      if (
        $('#' + v).length &&
        scrollTopOffset >= $('#' + v).offset().top - $('.fixed-top').height()
      ) {
        $('.navbar-nav li').removeClass('active');
        var x = $('.navbar-nav li').find('a[href="#' + v + '"]');
        x.parent('li').addClass('active');
      }
    });
  });

  $('.skills-slider').slick({
    dots: false,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,
    slidesToShow: 6,
    slidesToScroll: 2,
    responsive: [
      {
        breakpoint: 992,
        settings: {
          slidesToShow: 4,
          slidesToScroll: 2
        }
      },
      {
        breakpoint: 480,
        settings: {
          slidesToShow: 2,
          slidesToScroll: 2
        }
      }
    ]
  });
});
