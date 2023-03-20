/**
 * Home
 */
export default function() {
  if ($(document).scrollTop() > 10) {
    $("header").addClass('header-scrolling');
  } else {
    $("header").removeClass('header-scrolling');
  }
  var scroll_pos = 0;
  $(document).scroll(function() {
    scroll_pos = $(this).scrollTop();
    if (scroll_pos > 10) {
      $("header").addClass('header-scrolling');
    } else {
      $("header").removeClass('header-scrolling');
    }
  });
  $(document).on('click', '.anchor', function() {
    var $target = $(this).attr('href');
    window.location.hash = $target;
    var $offset = $($target).offset().top - $("header").innerHeight() - 20;
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

  $(document).on('click', '#link-tabs a', function() {
    const $this = $(this);
    let $target = $this.data('tab');
    let $content = $('#content-tabs');

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
    var $thisID = $(this).attr('id');
    let target = $this.attr('data-target');
    let cat = $this.attr('data-cat');
    let type = $this.attr('data-type');
    let tax = $this.attr('data-tax');
    let maxpages = $this.attr('data-maxpages');
    let currentPage = $this.attr('data-currentPage');
    console.log(cat);
    console.log(type);
    console.log(tax);
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
        tax: tax
      },
      success: function(result) {
        console.log(result);
        if ($thisID != 'load-more-button') {
          $('#' + target).html('');
          $('#load-more-button').show();
        }
        $('#' + target).append(result);
        if (result != '') {
          $('#load-more-button').attr('data-currentPage', currentPage);
          $('#load-more-button').attr('data-cat', cat);
        }
        if (maxpages == currentPage) {
          $('#load-more-button').hide();
        }
        $('.loader').fadeOut();
      }
    });

    return false;
  });

  $('input[name="your-tel"]').mask('(00) 0 0000-0000');

  var pontoAct = $("#the-content").position().top;
  $(window).resize(function() {
    pontoAct = $("#the-content").position().top;
  });
  console.log(pontoAct);

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