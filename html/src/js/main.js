/*
 * Plugins
 */
import 'slick-carousel';
// import 'selectric';
import svg4everybody from 'svg4everybody';

/**
 * Modules
 */
import slider from './modules/slider';
import parallax from './modules/parallax';

/**
 * Vendors
 */
// import plugins from './vendor/plugins';

/**
 * Pages
 */
import home from './pages/_home';


(($) => {
  'use strict';

  $(() => {
    svg4everybody();
    slider();
    // plugins();
    parallax();
    home();
  });
})(jQuery);