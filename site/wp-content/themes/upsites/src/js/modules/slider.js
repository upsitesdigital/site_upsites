/**
 * Slider
 */
export default function () {
  let directory_uri = "";
  if (window.location.origin.indexOf("localhost") != -1) {
    directory_uri =
      window.location.origin +
      "/projetos/site_upsites/site/wp-content/themes/upsites";
  } else {
    directory_uri = window.location.origin + "/wp-content/themes/upsites";
  }

  const $clientSlide = $(".clientSlide");
  $clientSlide.slick({
    speed: 4000,
    autoplaySpeed: 0,
    infinite: true,
    variableWidth: true,
    cssEase: 'linear',
    slidesToShow: 1,

    //slidesToShow: 5,
    slidesToScroll: 1,
    autoplay: true,
    //autoplaySpeed: 5000,
    dots: false,
    arrows: false,
    nextArrow:
      '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="' +
      directory_uri +
      '/assets/img/icons.svg#arrowSlide"></use></svg></button>',
    prevArrow:
      '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon"><use xlink:href="' +
      directory_uri +
      '/assets/img/icons.svg#arrowSlide"></use></svg></button>',
    centerMode: false,
    focusOnSelect: false,
    draggable: false,
    pauseOnFocus: false,
    pauseOnHover: false,
    swipe: false,
    touchMove: false,
    touchThreshold: false,
    adaptiveHeight: true,
    centerPadding: "0",
    responsive: [
      {
        breakpoint: 769,
        settings: {
          infinite: false,
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 481,
        settings: {
          infinite: false,
          slidesToShow: 1,
        },
      },
    ],
  });

  const $boxslide = $(".box-slide");
  $boxslide.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    dots: true,
    appendDots: $(".slide-grafics .box-dots"),
    arrows: true,
    nextArrow: $(".slide-grafics .container-small .next"),
    prevArrow: $(".slide-grafics .container-small .prev"),
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: "0",
  });

  /*const $recoverypenaltiesslide = $('.recovery-penalties-slide');
  $recoverypenaltiesslide.slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    dots: false,
    arrows: true,
    nextArrow: $('.recovery-penalties .next'),
    prevArrow: $('.recovery-penalties .prev'),
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: '0',
    responsive: [{
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
        arrows: false,
        dots: true,
      }
    }, {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        adaptiveHeight: true,
        dots: true,
      }
    }]
  });*/

  const $status = $(".clients  .pagingInfo");
  const $testimonySlide = $(".clients  .testimonySlide");
  const changeSlide = (slider, action) => {
    $(slider).slick(action);
  };

  $(".clients #slick-next").on("click", () => {
    changeSlide($testimonySlide, "slickNext");
  });

  $(".clients #slick-prev").on("click", () => {
    changeSlide($testimonySlide, "slickPrev");
  });

  $testimonySlide.on(
    "init reInit afterChange",
    function (event, slick, currentSlide) {
      const i = (currentSlide ? currentSlide : 0) + 1;
      const n = i <= 9 ? "0" + i : i;
      const c =
        slick.slideCount <= 9 ? "0" + slick.slideCount : slick.slideCount;
      $status.text(n + " • " + c);
    }
  );

  $testimonySlide.slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    dots: false,
    arrows: true,
    nextArrow:
      '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="' +
      directory_uri +
      '/assets/img/icons.svg#arrowSlide"></use></svg></button>',
    prevArrow:
      '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon"><use xlink:href="' +
      directory_uri +
      '/assets/img/icons.svg#arrowSlide"></use></svg></button>',
    centerMode: false,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: "0",
    responsive: [
      {
        breakpoint: 769,
        settings: {
          infinite: false,
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 481,
        settings: {
          infinite: false,
          slidesToShow: 1,
        },
      },
    ],
  });

  const $statusPort = $(".portfolioListHome  .pagingInfo");
  const $slidePort = $(".portfolioListHome .featured .slide");

  $slidePort.on(
    "init reInit afterChange",
    function (event, slick, currentSlide) {
      const i = (currentSlide ? currentSlide : 0) + 1;
      const n = i <= 9 ? "0" + i : i;
      const c =
        slick.slideCount <= 9 ? "0" + slick.slideCount : slick.slideCount;
      $statusPort.text(n + " • " + c);
    }
  );
  $slidePort.slick({
    autoplay: true,
    autoplaySpeed: 5000,
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    appendDots: $(".portfolioListHome .featured .pagSlide .box-dots"),
    arrows: true,
    nextArrow: $(".portfolioListHome .featured .pagSlide .slick-next"),
    prevArrow: $(".portfolioListHome .featured .pagSlide .slick-prev"),
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: "0",
    responsive: [
      {
        breakpoint: 769,
        settings: {
          infinite: false,
          slidesToShow: 1,
        },
      },
      {
        breakpoint: 481,
        settings: {
          infinite: false,
          slidesToShow: 1,
        },
      },
    ],
  });

  const $slideclient = $(".slide-client");
  $slideclient.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: false,
    arrows: true,
    nextArrow:
      '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg aria-hidden="true" class="e-font-icon-svg e-eicon-chevron-right" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M696 533C708 521 713 504 713 487 713 471 708 454 696 446L400 146C388 133 375 125 354 125 338 125 325 129 313 142 300 154 292 171 292 187 292 204 296 221 308 233L563 492 304 771C292 783 288 800 288 817 288 833 296 850 308 863 321 871 338 875 354 875 371 875 388 867 400 854L696 533Z"></path></svg></button>',
    prevArrow:
      '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg aria-hidden="true" class="e-font-icon-svg e-eicon-chevron-left" viewBox="0 0 1000 1000" xmlns="http://www.w3.org/2000/svg"><path d="M646 125C629 125 613 133 604 142L308 442C296 454 292 471 292 487 292 504 296 521 308 533L604 854C617 867 629 875 646 875 663 875 679 871 692 858 704 846 713 829 713 812 713 796 708 779 692 767L438 487 692 225C700 217 708 204 708 187 708 171 704 154 692 142 675 129 663 125 646 125Z"></path></svg></button>',
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: "0",
  });

  const $pageSlide = $(".pageSlide");
  $pageSlide.slick({
    slidesToShow: 4,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    dots: false,
    arrows: true,
    nextArrow:
      '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="' +
      directory_uri +
      '/assets/img/icons.svg#arrowSlide"></use></svg></button>',
    prevArrow:
      '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon"><use xlink:href="' +
      directory_uri +
      '/assets/img/icons.svg#arrowSlide"></use></svg></button>',
    centerMode: false,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: "20px",
    responsive: [
      {
        breakpoint: 769,
        settings: {
          infinite: false,
          slidesToShow: 2,
        },
      },
      {
        breakpoint: 481,
        settings: {
          infinite: false,
          slidesToShow: 1,
        },
      },
    ],
  });

  const $portfoliolistnew = $(".portfoliolistnew .box-slider");
  $portfoliolistnew.on('init reInit', function (event, slick) {
    let count = slick.slideCount <= 9 ? '0' + slick.slideCount : slick.slideCount;
    $('#btns-slider .pags .total').html(count);
  });
  $portfoliolistnew.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    autoplay: true,
    autoplaySpeed: 5000,
    dots: false,
    arrows: true,
    nextArrow: $('#btns-slider .next'),
    prevArrow: $('#btns-slider .prev'),
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: "0",
  });
  $portfoliolistnew.on('afterChange', function (event, slick, currentSlide) {
    let total = currentSlide + 1;
    let count = total <= 9 ? '0' + total : total;
    $('#btns-slider .pags .current').html(count);
  });

  

  const $casefeatured = $(".case-featured .box-slider");
  $casefeatured.slick({
    slidesToShow: 1,
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

  const $casegallerytop = $(".case-gallery .slide-top");
  $casegallerytop.slick({
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

  const $casegallerybottom = $(".case-gallery .slide-bottom");
  $casegallerybottom.slick({
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
}
