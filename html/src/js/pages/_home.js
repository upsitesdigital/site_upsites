/**
 * Home
 */
export default function() {
  $(document).on('click', '.anchor', function() {
    var $target = $(this).attr('href');
    var $offset = $($target).position().top;
    $('body,html').animate({ scrollTop: $offset }, 1000);
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

}