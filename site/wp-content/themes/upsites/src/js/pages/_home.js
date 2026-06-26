/**
 * Home
 */
export default function () {
  // window.sr = new scrollReveal();
  if ($(document).scrollTop() > 0) {
    $("header").addClass("header-scrolling");
  } else {
    $("header").removeClass("header-scrolling");
  }
  if ($(document).scrollTop() > 200) {
    $("#footer-bar").addClass("footer-bar-scrolling");
  } else {
    $("#footer-bar").removeClass("footer-bar-scrolling");
  }
  var scroll_pos = 0;
  $(document).on("scroll", function (event) {
    var st = $(this).scrollTop();
    if (st > 0) {
      $("header#top").addClass("header-scrolling");
    } else {
      $("header#top").removeClass("header-scrolling");
    }
    if (st > scroll_pos) {
      $("header#header-mobile").addClass("header-scrolling");
      // console.log("down");
    } else {
      $("header#header-mobile").removeClass("header-scrolling");
      // console.log("up");
    }
    scroll_pos = st;
    if (st > 200) {
      $("#footer-bar").addClass("footer-bar-scrolling");
    } else {
      $("#footer-bar").removeClass("footer-bar-scrolling");
    }
  });

  var scroll_btn = 0;
  var page = (jQuery("footer").offset().top - jQuery(window).height()) / 4;

  if ($(document).scrollTop() > page) {
    $(".backtop").addClass("act");
  } else {
    $(".backtop").removeClass("act");
  }
  $(document).on("scroll", function () {
    scroll_btn = $(this).scrollTop();
    if (scroll_btn > page) {
      $(".backtop").addClass("act");
    } else {
      $(".backtop").removeClass("act");
    }
  });

  $(document).on("click", ".anchor", function () {
    const $target = $(this).attr("href");
    window.location.hash = $target;
    var $offset = $($target).offset().top - $("header").innerHeight() - 20;
    $(document).scrollTop($offset);
    return false;
  });

  $(document).on("click", ".accordion > .accordionClick", function () {
    $(this)
      .closest(".accordion")
      .toggleClass("accordionOpen")
      .find(".accordionContent")
      .slideToggle();
    return false;
  });

  $(document).on("click", ".faqs-new .box-list li h3", function () {
    $(this).closest("li").toggleClass("accordionOpen").find(".content").slideToggle();
    return false;
  });

  $(document).on("click", "#open-menu", function () {
    $(".seach-box").removeClass("act");
    $("body").toggleClass("menu-open");
    $(this).toggleClass("opened").attr("aria-expanded", "true");

    return false;
  });

  $(document).on(
    "click",
    "header#header-mobile #menu-mobile .box-menu .menu-mobile li",
    function () {
      $("body").toggleClass("menu-open");
      $("#open-menu").toggleClass("opened").attr("aria-expanded", "false");
    }
  );

  $(document).on("click", "#link-tabs a", function () {
    const $this = $(this);
    const $target = $this.data("tab");
    const $content = $("#content-tabs");

    if (!$this.hasClass("act")) {
      $("#link-tabs a").removeClass("act");
      $content.find(".grid").removeClass("act");
      $this.addClass("act");
      $content.find("#" + $target).addClass("act");
    }

    return false;
  });

  $(document).on("click", "#load-more-portifolios", function () {
    var $this = $(this);
    let currentPage = parseInt($this.attr("data-currentPage"));
    const cat = $this.attr("data-cat");
    const type = $this.attr("data-type");
    const tax = $this.attr("data-tax");
    const maxpages = $this.attr("data-maxpages");
    currentPage++;
    // console.log(currentPage);
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: "get_load_more",
        page: currentPage,
        cat: cat,
        type: type,
        tax: tax,
      },
      success: function (result) {
        // console.log(result);
        $("#posts-portifolios").append(result);
        if (result != "") {
          $this.attr("data-currentPage", currentPage);
        }
        if (maxpages == currentPage) {
          $this.hide();
        }
      },
    });

    return false;
  });

  $(document).on("click", "#load-more-templates", function () {
    var $this = $(this);
    let currentPage = parseInt($this.attr("data-currentPage"));
    let cat = $this.attr("data-cat");
    let type = $this.attr("data-type");
    let tax = $this.attr("data-tax");
    let maxpages = $this.attr("data-maxpages");
    currentPage++;
    console.log(currentPage);
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: "get_load_more",
        page: currentPage,
        cat: cat,
        type: type,
        tax: tax,
      },
      success: function (result) {
        // console.log(result);
        $("#posts-templates").append(result);
        if (result != "") {
          $this.attr("data-currentPage", currentPage);
        }
        if (maxpages == currentPage) {
          $this.hide();
        }
      },
    });

    return false;
  });

  $(document).on("click", ".load-more-categories", function () {
    $(".loader").fadeIn();
    var $this = $(this);
    var $thisID = $this.attr("id");
    let target = $this.attr("data-target");
    let cat = $this.attr("data-cat");
    let type = $this.attr("data-type");
    let tax = $this.attr("data-tax");
    let maxpages = parseInt($this.attr("data-maxpages"));
    let currentPage = parseInt($this.attr("data-currentPage"));

    let segmentos =
      $this.attr("data-segmentos") == undefined
        ? "All"
        : $this.attr("data-segmentos");

    // console.log(cat);
    // console.log(type);
    // console.log(tax);
    if ($thisID == "load-more-button") {
      currentPage++;
    } else {
      $(".links a").removeClass("act");
      $this.addClass("act");
    }
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: "get_load_more",
        page: currentPage,
        cat: cat,
        type: type,
        tax: tax,
        seg: segmentos,
      },
      success: function (result) {
        if ($thisID != "load-more-button") {
          $("#" + target).html("");
          $this.show();
        }
        $("#" + target).append(result);
        if (result != "") {
          console.log(currentPage);
          if ($thisID != "load-more-button") {
            $this
              .closest("section")
              .find(".seeMore")
              .attr("data-currentPage", "1");
          } else {
            $this
              .closest("section")
              .find(".seeMore")
              .attr("data-currentPage", currentPage);
          }
          $this
            .closest("section")
            .find(".seeMore")
            .attr("data-maxpages", maxpages);
          $this.closest("section").find(".seeMore").attr("data-cat", cat);
          //$this.attr('data-cat', cat);
        }
        console.log("maxpages == currentPage: " + maxpages == currentPage);
        console.log("maxpages: " + maxpages);
        console.log("currentPage: " + currentPage);
        if (maxpages == currentPage) {
          $this.closest("section").find(".seeMore").hide();
        } else {
          $this.closest("section").find(".seeMore").show();
        }
        $(".loader").fadeOut();
      },
    });

    return false;
  });

  $('input[name="your-tel"]').mask("(00) 0 0000-0000");
  $('input[name="sale-value"]').mask("000.000.000.000.000,00", {
    reverse: true,
  });
  $('input[name="your-whats"]').mask("(00) 0 0000-0000");
  $('input[name="ind-whats"]').mask("(00) 0 0000-0000");
  $('input[name="your-cpf"]').mask("000.000.000-00");
  $('input[name="ind-cpf"]').mask("000.000.000-00");

  if ($("#the-content").length) {
    var pontoAct = $("#the-content").position().top;
    $(window).resize(function () {
      pontoAct = $("#the-content").position().top;
    });
    // console.log(pontoAct);

    if ($(document).scrollTop() > pontoAct) {
      $("#btbar").addClass("act");
    } else {
      $("#btbar").removeClass("act");
    }

    var scroll_pos = 0;
    $(window).scroll(function () {
      scroll_pos = $(this).scrollTop();
      if (scroll_pos > pontoAct) {
        $("#btbar").addClass("act");
      } else {
        $("#btbar").removeClass("act");
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

  $(document).on("click", ".itemacord h3", function () {
    var $this = $(this);

    if ($this.closest(".itemacord").hasClass("open")) {
      $($this).closest(".itemacord").removeClass("open");
    } else {
      $(".itemacord").removeClass("open");
      $this.closest(".itemacord").toggleClass("open");
    }
    return false;
  });

  if ($(".statistics").length) {
    var scroll_pos = 0;
    var pontoAct =
      jQuery(".statistics").position().top - jQuery(window).innerHeight();
    jQuery(window).scroll(function () {
      scroll_pos = jQuery(this).scrollTop();
      if (scroll_pos > pontoAct) {
        $(".contagem").each(function () {
          if (!$(this).hasClass("act")) {
            $(this)
              .prop("Counter", 0)
              .animate(
                {
                  Counter: $(this).text(),
                },
                {
                  duration: 5000,
                  easing: "swing",
                  step: function (now) {
                    $(this).text(Math.ceil(now));
                  },
                  start: function () {
                    console.log("Animation start.");
                    $(this).addClass("act");
                  },
                  complete: function () {
                    console.log("Animation complete.");
                  },
                }
              );
          }
        });
        //$('.contagem').addClass('act');
      }
    });
  }

  $(document).on("click", ".modal-video", function () {
    var $body = $("body");
    $body.addClass("modal-video-open");

    let url = $(this).attr("href");
    $(".modal-videos")
      .find(".video")
      .html(
        '<iframe src="https://player.vimeo.com/video/' +
          url +
          '?h=1ac4fd9fb4&byline=0&portrait=0" width="100%" height="100%" frameborder="0" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>'
      );

    return false;
  });
  $(document).on("click", ".modal-video-close", function () {
    var $body = $("body");
    $body.removeClass("modal-video-open");
    $(".modal-videos").find(".video").html("");

    return false;
  });

  $(document).on("click", "#shortContent #readMore", function () {
    $(this)
      .closest("#shortContent")
      .slideUp(function () {
        $("#largeContent").slideDown();
      });
  });
  $(document).on("click", "#largeContent #readLess", function () {
    $(this)
      .closest("#largeContent")
      .slideUp(function () {
        $("#shortContent").slideDown();
      });
  });

  $(document).on("click", ".functions .grid .text ul li .txtopen", function () {
    var $this = $(this);
    $this.slideUp(function () {
      $this.closest("p").find(".txtclose").slideDown();
    });
  });
  $(document).on(
    "click",
    ".functions .grid .text ul li .txtclose",
    function () {
      var $this = $(this);
      $this.slideUp(function () {
        $this.closest("p").find(".txtopen").slideDown();
      });
    }
  );

  /*setTimeout(function() {
    $('.modal-03').addClass('act');
  }, 800);*/

  $(document).on(
    "click",
    ".modal-03 .overlay,.modal-03 .content .close",
    function () {
      $(this).closest(".modal-03").removeClass("act");
      return false;
    }
  );

  setTimeout(function () {
    $(".animateBlur").removeClass("animateBlur");
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

  $.exitIntent("enable", { sensitivity: 100 });
  $(document).bind("exitintent", function () {
    if (
      !jQuery("body").hasClass("page-template-thanks") &&
      !jQuery("body").hasClass("page-template-budgets") &&
      !jQuery("body").hasClass("page-template-partners")
    ) {
      if ($.cookie("exit-intent") == undefined) {
        jQuery(".modal-03").addClass("act");
        $.cookie("exit-intent", true, { expires: 10 });
      }
    }
  });
  setTimeout(function () {
    if (
      !jQuery("body").hasClass("page-template-thanks") &&
      !jQuery("body").hasClass("page-template-budgets")
    ) {
      //if ($.cookie('exit-intent') != true) {
      jQuery(".modal-03").addClass("act");
      $.cookie("exit-intent", 1, { expires: 10 });
      //}
    }
  }, 120000);
  setTimeout(function () {
    if (
      !jQuery("body").hasClass("page-template-thanks") &&
      !jQuery("body").hasClass("page-template-budgets")
    ) {
      //if ($.cookie('exit-intent') != true) {
      jQuery(".modal-03").addClass("act");
      $.cookie("exit-intent", 1, { expires: 10 });
      //}
    }
  }, 300000);
  setTimeout(function () {
    if (
      !jQuery("body").hasClass("page-template-thanks") &&
      !jQuery("body").hasClass("page-template-budgets")
    ) {
      //if ($.cookie('exit-intent') != true) {
      jQuery(".modal-03").addClass("act");
      $.cookie("exit-intent", 1, { expires: 10 });
      //}
    }
  }, 600000);

  setTimeout(function () {
    if (jQuery(".content-post table").length > 0) {
      console.log("table");
      jQuery(".content-post table").wrap(
        '<div style="overflow-x:auto;" class="table" />'
      );
    }
    jQuery(
      'a[href="https://upsites.digital/orcamentos"],a[href="https://upsites.digital/orcamentos/"]'
    ).each(function (index) {
      let slug = (url) => new URL(url).pathname.match(/[^\/]+/g);
      var url = new URL(jQuery(this).attr("href"));
      var urlslug = "home";
      if (slug(window.location) != null) {
        console.log("urlslug");
        urlslug = slug(window.location).pop();
      }
      console.log(urlslug);
      jQuery(this).attr("href", url + "?origin=" + urlslug);
      console.log(url + "?origin=" + urlslug);
    });
  }, 200);

  jQuery(".copy-btn").on("click", function (event) {
    event.preventDefault();
    var value = jQuery(this)
      .closest(".box-code")
      .find(".content-code")
      .find("code")
      .text();
    navigator.clipboard.writeText(value);
  });

  jQuery(document).on(
    "click",
    ".signature .form .submit_signature",
    function (event) {
      //console.log('data');
      jQuery("#loader-layer").fadeIn();
      const root = jQuery(this).closest(".form");
      let name = root.find('input[name="name"]');
      let office = root.find('input[name="office"]');
      let mail = root.find('input[name="mail"]');
      let phone = root.find('input[name="phone"]');
      let avatar = root.find('input[name="avatar"]').prop("files")[0];

      var formdata = new FormData();
      formdata.append("action", "create_signature");
      formdata.append("name", name.val());
      formdata.append("office", office.val());
      formdata.append("mail", mail.val());
      formdata.append("phone", phone.val());
      formdata.append("file", avatar);
      //formdata.append('nonce', nonce);

      jQuery.ajax({
        url: usAjax.ajaxurl,
        type: "POST",
        dataType: "json",

        cache: false,
        processData: false,
        contentType: false,
        enctype: "multipart/form-data",
        data: formdata,
        success: function (result) {
          console.log("result");
          console.log(result.success);
          console.log(result.data.url);
          if (result.success) {
            window.location.href = result.data.url;
          }
          //jQuery('#loader-layer').fadeOut();
        },
      });
      return false;
    }
  );

  jQuery(document).on(
    "change",
    '.signature .form .file-box input[type="file"]',
    function () {
      const root = $(this).closest(".file-box");
      let name = $(this).prop("files");
      root.find(".text-file").html(name[0].name);
    }
  );

  if (jQuery(".btn-sinature").length != 0) {
    jQuery(".btn-sinature").on("click", function (event) {
      event.preventDefault();
      var value = jQuery(this)
        .closest(".simple-page")
        .find("#box-sinature")
        .html();
      navigator.clipboard.writeText(value);
    });
  }
  if (jQuery("#copy-btn").length != 0) {
    new ClipboardJS("#copy-btn");

    document.getElementById("copy-btn").addEventListener("click", function () {
      alert("Assinatura copiada!");
    });
  }

  jQuery(".js-link").on("click", function () {
    const link = jQuery(this).data("href");
    window.open(link, "_blank");
    return false;
  });

  jQuery(document).on(
    "click",
    ".open-modal-partner, .modal-partners .close",
    function (event) {
      jQuery(".modal-partners").toggleClass("open");
      return false;
    }
  );
  jQuery(document).on(
    "click",
    ".modal-partners .content .body .form .next",
    function (event) {
      const root = jQuery(this).closest(".form");
      const current = root.find(".step-01");
      const next = root.find(".step-02");

      let error = 0;
      const msn = (a) => {
        if ($(a).val() == "") {
          error = 1;
          $(a).closest("label").addClass("error");
        } else {
          $(a).closest("label").removeClass("error");
        }
      };

      msn('input[name="your-name"]');
      msn('input[name="your-whats"]');
      msn('input[name="your-cpf"]');
      msn('input[name="your-company"]');
      msn('input[name="your-email"]');
      msn('input[name="your-pix"]');

      if (error == 0) {
        current.fadeOut(function () {
          next.fadeIn();
          jQuery(this)
            .closest(".content")
            .find(".header .steps")
            .addClass("act")
            .find(".step.step-02")
            .addClass("act");
        });
      }
      return false;
    }
  );
  jQuery(document).on(
    "click",
    ".modal-partners .content .header .steps .step.step-01",
    function (event) {
      const root = jQuery(this).closest(".content").find(".body");
      const current = root.find(".step-02");
      const next = root.find(".step-01");
      current.fadeOut(function () {
        next.fadeIn();
        // jQuery(this).closest('.content').find('.header .steps').addClass('act').find('.step.step-02').addClass('act');
      });
      return false;
    }
  );

  jQuery(document).on("blur", 'input[name="sale-value"]', function () {
    const $value = jQuery('input[name="sale-value"]').val().replace(".", "");
    const $commission = parseFloat($value) * 0.07;
    console.log("$value");
    console.log($commission);
    $('input[name="your-commission"]').val("");
    $('input[name="your-commission"]').unmask();
    $('input[name="your-commission"]').val(
      $commission.toFixed(2).replace(".", ",")
    );
    $('input[name="your-commission"]').mask("000.000.000.000.000,00", {
      reverse: true,
    });
  });

  jQuery(document).on(
    "click",
    ".open-modal-cookies, .modal-cookies .close",
    function (event) {
      jQuery(".modal-cookies").toggleClass("open");
      return false;
    }
  );

  jQuery(document).on(
    "click",
    ".price-box .see-more",
    function (event) {
      let target = jQuery(this).closest(".item").find(".hidemobile");
      if (!jQuery(this).hasClass('show')) {
        target.addClass('show');
        jQuery(this).addClass('show');
      } else {
        target.removeClass('show');
        jQuery(this).removeClass('show');
      }
      return false;
    }
  );


  jQuery(document).on("click", ".segments .box-title .right a", function (event) {
    let slug = jQuery(this).data('slug');
    jQuery('.segments .box-title .right a.act').removeClass('act');
    jQuery(this).addClass('act');
    console.log(slug);
    $(".loader").fadeIn();
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: "get_load_segment",
        type: 'landings',
        cat: slug,
        tax: 'categories_landings'
      },
      success: function (result) {
        console.log('result');
        console.log(result);
        $('.segments .list-segments').html(result);
        $(".loader").fadeOut();
      },
    });

    return false;
  });

  jQuery(document).on("click", ".cases .filters .filter-btns .adjustments", function (event) {
    var $body = $("body");
    $body.addClass("menu-filter-open");
    return false;
  });
  jQuery(document).on("click", ".menu-filter-box .header .close", function (event) {
    var $body = $("body");
    $body.removeClass("menu-filter-open");
    return false;
  });

  jQuery(document).on("click", ".cases .filters .list-filters a", function (event) {
    let slug = jQuery(this).data('slug');
    jQuery('input[value='+slug+']').prop('checked', false);
    jQuery(this).remove();
    jQuery('.menu-filter-box .footer button').click();
    return false;
  });

  
  
  jQuery(document).on("click", ".menu-filter-box .footer button", function (event) {
    $(".loader").fadeIn();
    let arrcats = [];
    const path = pathURL.templateurl;
    jQuery('.cases .filters .list-filters').html('');
    jQuery( ".menu-filter-box .box ul li input:checked" ).each(function( index ) {
      let html = '<a href="#" class="item" data-tax="' + jQuery( this ).data('tax') + '" data-slug="' + jQuery( this ).val() + '"><img class="icon" src="' + path + '/assets/img/close.svg" alt="">' + jQuery( this ).data('name') + '</a>';
      jQuery('.cases .filters .list-filters').append(html);
      arrcats.push({tax: jQuery( this ).data('tax'), value: jQuery( this ).val()});
    });

    
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: "get_load_cases",
        type: 'cases',
        tax: JSON.stringify(arrcats)
      },
      success: function (result) {
        console.log('result');
        jQuery('.cases .list-cases').html('');
        jQuery('.cases .list-cases').html(result);
        jQuery('.cases .paginations').remove();
        $(".loader").fadeOut();
        console.log(result);
      },
    });

    return false;
  });

  setTimeout(function() {$('#device-mobile').hide();}, 1000);
  $(document).on('click', '.case-gallery ul.tags li a', function() {
    const target = $(this).data('target');
    const targetact = $('.case-gallery ul.tags li a.act').data('target');
    
    if(!$(this).hasClass('act')) {
      $('.case-gallery ul.tags li a').removeClass('act');
      $(this).addClass('act');
      $('#' + targetact).hide().removeClass('act');
      $('#' + target).show().addClass('act');
      jQuery('#' +targetact+ ' .slide-top').slick('destroy');
      jQuery('#' +targetact+ ' .slide-bottom').slick('destroy');
      console.log(target);
      console.log(targetact);
      setTimeout(function() {
        const $casegallerytopb = $('#' +target+ ' .slide-top');
        $casegallerytopb.slick({
          infinite: true,
          slidesToShow: 2,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 5000,
          dots: false,
          arrows: false,
          centerMode: true,
          focusOnSelect: true,
          adaptiveHeight: true,
          centerPadding: "0",
        });
  
        const $casegallerybottomb = $('#' +target+ ' .slide-bottom');
        $casegallerybottomb.slick({
          infinite: true,
          slidesToShow: 2,
          slidesToScroll: 1,
          autoplay: true,
          autoplaySpeed: 5500,
          dots: false,
          arrows: false,
          centerMode: true,
          focusOnSelect: true,
          adaptiveHeight: true,
          centerPadding: "0",
          rtl: true,
        });
      }, 100);

    }

    return false;
  });
  if(jQuery('.beforeAfter').length > 0) {
    jQuery('.beforeAfter').beforeAfter();
  }

  $(document).on('submit', '#search-glossary', function(e) {
    e.preventDefault();
    const urlSearch = $('#search-glossary button').data('url');
    const val = $('#search-glossary input').val();
    let url = urlSearch;
    console.log(urlSearch);
    if(val != '') {
      url = urlSearch + '?search=' + encodeURIComponent(val);
    }
    location.assign(url);
  });

  $(document).on('click', '.submenulang a', function () {
    const $url = $(this).data('href');
    window.location.href = $url;
    return false;
  });

  

  $(document).on('click', '.hero-internal-glossary .grid-hero .box-link .box .btn', function () {
    $(".loader").fadeIn();
    const id = $(this).data('id');
    console.log('id JS');
    console.log(id);
    $.ajax({
      url: usAjax.ajaxurl,
      type: "POST",
      data: {
        action: "get_load_like",
        id: id,
      },
      success: function (result) {
        console.log('result');
        console.log(result);
        $('.hero-internal-glossary .grid-hero .box-link .box p span').text(result);
        $(".loader").fadeOut();
      },
    });
    return false;
  });

  if(jQuery('[data-fancybox="gallery"]').length > 0) {
    Fancybox.bind('[data-fancybox="gallery"]', {
      placeFocusBack: false,
      Carousel: {
        Thumbs: false,
        Toolbar: {
          display: {
            left: [],
            middle: [],
            right: ["close"],
          },
        },
      },
    });
  }

  /*setTimeout(function() {
    $('#loader-layer').fadeOut();
  }, 200);*/
}
