/**
 * Home
 */
export default function() {
  // window.sr = new scrollReveal();
  if ($(document).scrollTop() > 10) {
    $('header').addClass('header-scrolling');
  } else {
    $('header').removeClass('header-scrolling');
  }
  if ($(document).scrollTop() > 200) {
    $('#footer-bar').addClass('footer-bar-scrolling');
  } else {
    $('#footer-bar').removeClass('footer-bar-scrolling');
  }
  var scroll_pos = 0;
  $(document).on("scroll", function(event) {
    var st = $(this).scrollTop();
    if (st > scroll_pos) {
      $('header').addClass('header-scrolling');
      // console.log("down");
    } else {
      $('header').removeClass('header-scrolling');
      // console.log("up");
    }
    scroll_pos = st;
    if (st > 200) {
      $('#footer-bar').addClass('footer-bar-scrolling');
    } else {
      $('#footer-bar').removeClass('footer-bar-scrolling');
    }
  });

  var scroll_btn = 0;
  var page = (jQuery('footer').offset().top - jQuery(window).height()) / 4;

  if ($(document).scrollTop() > page) {
    $('.backtop').addClass('act');
  } else {
    $('.backtop').removeClass('act');
  }
  $(document).on("scroll", function() {
    scroll_btn = $(this).scrollTop();
    if (scroll_btn > page) {
      $('.backtop').addClass('act');
    } else {
      $('.backtop').removeClass('act');
    }
  });




  $(document).on('click', '.anchor', function() {
    const $target = $(this).attr('href');
    window.location.hash = $target;
    var $offset = $($target).offset().top - $('header').innerHeight() - 20;
    $(document).scrollTop($offset);
    return false;
  });

  $(document).on('click', '.accordion > .accordionClick', function() {
    $(this).closest('.accordion').toggleClass('accordionOpen').find('.accordionContent').slideToggle();
    return false;
  });


  $(document).on('click', '#open-menu', function() {
    $('.seach-box').removeClass('act');
    $('body').toggleClass('menu-open');
    $(this).toggleClass('opened').attr('aria-expanded', 'true');

    return false;
  });

  $(document).on('click', 'header#header-mobile #menu-mobile .box-menu .menu-mobile li', function() {
    $('body').toggleClass('menu-open');
    $('#open-menu').toggleClass('opened').attr('aria-expanded', 'false');
  });

  $(document).on('click', '#link-tabs a', function() {
    const $this = $(this);
    const $target = $this.data('tab');
    const $content = $('#content-tabs');

    if (!$this.hasClass('act')) {
      $('#link-tabs a').removeClass('act');
      $content.find('.grid').removeClass('act');
      $this.addClass('act');
      $content.find('#' + $target).addClass('act');
    }

    return false;
  });

  $(document).on('click', '#load-more-portifolios', function() {
    var $this = $(this);
    let currentPage = parseInt($this.attr('data-currentPage'));
    const cat = $this.attr('data-cat');
    const type = $this.attr('data-type');
    const tax = $this.attr('data-tax');
    const maxpages = $this.attr('data-maxpages');
    currentPage++;
    // console.log(currentPage);
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: 'get_load_more',
        page: currentPage,
        cat: cat,
        type: type,
        tax: tax
      },
      success: function(result) {
        // console.log(result);
        $('#posts-portifolios').append(result);
        if (result != '') {
          $this.attr('data-currentPage', currentPage);
        }
        if (maxpages == currentPage) {
          $this.hide();
        }
      }
    });

    return false;
  });


  $(document).on('click', '#load-more-templates', function() {
    var $this = $(this);
    let currentPage = parseInt($this.attr('data-currentPage'));
    let cat = $this.attr('data-cat');
    let type = $this.attr('data-type');
    let tax = $this.attr('data-tax');
    let maxpages = $this.attr('data-maxpages');
    currentPage++;
    console.log(currentPage);
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: 'get_load_more',
        page: currentPage,
        cat: cat,
        type: type,
        tax: tax
      },
      success: function(result) {
        // console.log(result);
        $('#posts-templates').append(result);
        if (result != '') {
          $this.attr('data-currentPage', currentPage);
        }
        if (maxpages == currentPage) {
          $this.hide();
        }
      }
    });

    return false;
  });


  $(document).on('click', '.load-more-categories', function() {
    $('.loader').fadeIn();
    var $this = $(this);
    var $thisID = $this.attr('id');
    let target = $this.attr('data-target');
    let cat = $this.attr('data-cat');
    let type = $this.attr('data-type');
    let tax = $this.attr('data-tax');
    let maxpages = parseInt($this.attr('data-maxpages'));
    let currentPage = parseInt($this.attr('data-currentPage'));

    let segmentos = $this.attr('data-segmentos') == undefined ? 'All' : $this.attr('data-segmentos');

    // console.log(cat);
    // console.log(type);
    // console.log(tax);
    if ($thisID == 'load-more-button') {
      currentPage++;
    } else {
      $('.links a').removeClass('act');
      $this.addClass('act');
    }
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: 'get_load_more',
        page: currentPage,
        cat: cat,
        type: type,
        tax: tax,
        seg: segmentos
      },
      success: function(result) {
        if ($thisID != 'load-more-button') {
          $('#' + target).html('');
          $this.show();
        }
        $('#' + target).append(result);
        if (result != '') {
          console.log(currentPage);
          if ($thisID != 'load-more-button') {
            $this.closest('section').find('.seeMore').attr('data-currentPage', '1');
          } else {
            $this.closest('section').find('.seeMore').attr('data-currentPage', currentPage);
          }
          $this.closest('section').find('.seeMore').attr('data-maxpages', maxpages);
          $this.closest('section').find('.seeMore').attr('data-cat', cat);
          //$this.attr('data-cat', cat);
        }
        console.log('maxpages == currentPage: ' + maxpages == currentPage);
        console.log('maxpages: ' + maxpages);
        console.log('currentPage: ' + currentPage);
        if (maxpages == currentPage) {
          $this.closest('section').find('.seeMore').hide();
        } else {
          $this.closest('section').find('.seeMore').show();
        }
        $('.loader').fadeOut();
      }
    });

    return false;
  });

  $('input[name="your-tel"]').mask('(00) 0 0000-0000');

  if ($("#the-content").length) {
    var pontoAct = $("#the-content").position().top;
    $(window).resize(function() {
      pontoAct = $("#the-content").position().top;
    });
    // console.log(pontoAct);

    if ($(document).scrollTop() > pontoAct) {
      $("#btbar").addClass('act');
    } else {
      $("#btbar").removeClass('act');
    }

    var scroll_pos = 0;
    $(window).scroll(function() {
      scroll_pos = $(this).scrollTop();
      if (scroll_pos > pontoAct) {
        $("#btbar").addClass('act');
      } else {
        $("#btbar").removeClass('act');
      }
    });
  }

  /*$('.contagem').each(function() {
    $(this).prop('Counter', 0).animate({
      Counter: $(this).text()
    }, {
      duration: 5000,
      easing: 'swing',
      step: function(now) {
        $(this).text(Math.ceil(now));
      }
    });
  });*/

  $(document).on('click', '.itemacord h3', function() {
    var $this = $(this);

    if ($this.closest('.itemacord').hasClass('open')) {
      $($this).closest('.itemacord').removeClass('open');
    } else {
      $('.itemacord').removeClass('open');
      $this.closest('.itemacord').toggleClass('open');
    }
    return false;
  });

  if ($(".statistics").length) {
    var scroll_pos = 0;
    var pontoAct = jQuery('.statistics').position().top - jQuery(window).innerHeight();
    jQuery(window).scroll(function() {
      scroll_pos = jQuery(this).scrollTop();
      if (scroll_pos > pontoAct) {
        $('.contagem').each(function() {

          if (!$(this).hasClass('act')) {
            $(this).prop('Counter', 0).animate({
              Counter: $(this).text()
            }, {
              duration: 5000,
              easing: 'swing',
              step: function(now) {
                $(this).text(Math.ceil(now));
              },
              start: function() {
                console.log('Animation start.');
                $(this).addClass('act');
              },
              complete: function() {
                console.log('Animation complete.');
              }
            });

          }
        });
        //$('.contagem').addClass('act');
      }
    });
  }

  $(document).on('click', '.modal-video', function() {
    var $body = $('body');
    $body.addClass('modal-video-open');

    let url = $(this).attr('href');
    $('.modal-videos').find('.video').html('<iframe src="https://player.vimeo.com/video/' + url + '?h=1ac4fd9fb4&byline=0&portrait=0" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>');

    return false;
  });
  $(document).on('click', '.modal-video-close', function() {
    var $body = $('body');
    $body.removeClass('modal-video-open');
    $('.modal-videos').find('.video').html('');

    return false;
  });

  $(document).on('click', '#shortContent #readMore', function() {
    $(this).closest('#shortContent').slideUp(function() {
      $('#largeContent').slideDown();
    });
  });
  $(document).on('click', '#largeContent #readLess', function() {
    $(this).closest('#largeContent').slideUp(function() {
      $('#shortContent').slideDown();
    });
  });

  $(document).on('click', '.functions .grid .text ul li .txtopen', function() {
    var $this = $(this);
    $this.slideUp(function() {
      $this.closest('p').find('.txtclose').slideDown();
    });
  });
  $(document).on('click', '.functions .grid .text ul li .txtclose', function() {
    var $this = $(this);
    $this.slideUp(function() {
      $this.closest('p').find('.txtopen').slideDown();
    });
  });

  /*setTimeout(function() {
    $('.modal-03').addClass('act');
  }, 800);*/

  $(document).on('click', '.modal-03 .overlay,.modal-03 .content .close', function() {
    $(this).closest('.modal-03').removeClass('act');
    return false;
  });

  setTimeout(function() {
    $('.animateBlur').removeClass('animateBlur');
  }, 800);

  /*var counter = 1;
  jQuery(document).mousemove(function(e) {
    console.log('mousemove');
    if (e.pageY <= 2) {
      console.log(e.pageY <= 2);
      if ($.cookie('exit-intent') == undefined) {
        console.log($.cookie('exit-intent') == undefined);
        jQuery('.modal-03').addClass('act');
        $.cookie('exit-intent', true, { expires: 10 });
      }
    }
  });*/

  $.exitIntent('enable', { 'sensitivity': 100 });
  $(document).bind('exitintent', function() {
    if (!jQuery('body').hasClass('page-template-thanks') && !jQuery('body').hasClass('page-template-budgets')) {
      if ($.cookie('exit-intent') == undefined) {
        jQuery('.modal-03').addClass('act');
        $.cookie('exit-intent', true, { expires: 10 });
      }
    }
  });
  setTimeout(function() {
    if (!jQuery('body').hasClass('page-template-thanks') && !jQuery('body').hasClass('page-template-budgets')) {
      //if ($.cookie('exit-intent') != true) {
      jQuery('.modal-03').addClass('act');
      $.cookie('exit-intent', 1, { expires: 10 });
      //}
    }
  }, 120000);
  setTimeout(function() {
    if (!jQuery('body').hasClass('page-template-thanks') && !jQuery('body').hasClass('page-template-budgets')) {
      //if ($.cookie('exit-intent') != true) {
      jQuery('.modal-03').addClass('act');
      $.cookie('exit-intent', 1, { expires: 10 });
      //}
    }
  }, 300000);
  setTimeout(function() {
    if (!jQuery('body').hasClass('page-template-thanks') && !jQuery('body').hasClass('page-template-budgets')) {
      //if ($.cookie('exit-intent') != true) {
      jQuery('.modal-03').addClass('act');
      $.cookie('exit-intent', 1, { expires: 10 });
      //}
    }
  }, 600000);


  /*setTimeout(function() {
    $('#loader-layer').fadeOut();
  }, 200);*/
}