/**
 * Parallax
 */
export default function() {
  if ($('.bg2').hasClass('parallax')) {

    $('.parallax').addClass('parallax-enabled');

    const $win = $(window);
    let winHeight = $win.height();
    const introElm = $('.parallax')[0];
    const scrollFn = function() {
      const st = $win.scrollTop();
      const y = (st + $('.slideFull .bg2').position().top) * 0.35;

      if (st <= winHeight) {
        introElm.style.top = `${Math.round(y)}px`;
      }
    };

    const frame = function() {
      window.requestAnimationFrame(scrollFn);
    };

    $win.on('scroll', frame).on('resize', function() {
      winHeight = $win.height();
    });
  }
}