/**
 * Slider
 */
export default function() {
  let directory_uri = '';
  if (window.location.origin.indexOf('localhost') != -1) {
    directory_uri = window.location.origin + '/projetos/site_upsites/site/wp-content/themes/upsites';
  } else {
    directory_uri = window.location.origin + '/wp-content/themes/upsites';
  }

  const $clientSlide = $('.clientSlide');
  $clientSlide.slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    dots: false,
    arrows: true,
    nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="' + directory_uri + '/assets/img/icons.svg#arrowSlide"></use></svg></button>',
    prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon"><use xlink:href="' + directory_uri + '/assets/img/icons.svg#arrowSlide"></use></svg></button>',
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: '0',
    responsive: [{
      breakpoint: 769,
      settings: {
        slidesToShow: 3,
      }
    }, {
      breakpoint: 481,
      settings: {
        slidesToShow: 2,
      }
    }]
  });

  const $boxslide = $('.box-slide');
  $boxslide.slick({
    slidesToShow: 1,
    slidesToScroll: 1,
    dots: true,
    appendDots: $('.slide-grafics .box-dots'),
    arrows: true,
    nextArrow: $('.slide-grafics .container-small .next'),
    prevArrow: $('.slide-grafics .container-small .prev'),
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: '0'
  });

  const $recoverypenaltiesslide = $('.recovery-penalties-slide');
  $recoverypenaltiesslide.slick({
    slidesToShow: 4,
    slidesToScroll: 1,
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
      }
    }, {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        adaptiveHeight: true,
      }
    }]
  });

  const $status = $('.pagingInfo');
  const $testimonySlide = $('.testimonySlide');
  const changeSlide = (slider, action) => {
    $(slider).slick(action);
  };

  $('#slick-next').on('click', () => {
    changeSlide($testimonySlide, 'slickNext');
  });

  $('#slick-prev').on('click', () => {
    changeSlide($testimonySlide, 'slickPrev');
  });

  $testimonySlide.on('init reInit afterChange', function(event, slick, currentSlide) {
    const i = (currentSlide ? currentSlide : 0) + 1;
    const n = (i <= 9 ? '0' + i : i);
    const c = (slick.slideCount <= 9 ? '0' + slick.slideCount : slick.slideCount);
    $status.text(n + ' • ' + c);
  });

  $testimonySlide.slick({
    slidesToShow: 3,
    slidesToScroll: 1,
    dots: false,
    arrows: false,
    centerMode: false,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: '0',
    responsive: [{
      breakpoint: 769,
      settings: {
        slidesToShow: 2,
      }
    }, {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
      }
    }]
  });
}