/**
 * Slider
 */
export default function () {

  const $clientSlide = $('.clientSlide');
  $clientSlide.slick({
    slidesToShow: 4,
    slidesToScroll: 4,
    dots: false,
    arrows: true,
    nextArrow: '<button class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="assets/img/icons.svg#arrowSlide"></use></svg></button>',
    prevArrow: '<button class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon"><use xlink:href="assets/img/icons.svg#arrowSlide"></use></svg></button>',
    centerMode: true,
    focusOnSelect: true,
    adaptiveHeight: true,
    centerPadding: '0'
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

  $testimonySlide.on('init reInit afterChange', function (event, slick, currentSlide) {
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
    centerPadding: '0'
  });
}