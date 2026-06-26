<?php
/**
 * The template for displaying the footer.
 *
 * Contains the body & html closing tags.
 *
 * @package HelloElementor
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_template_part( 'template-parts/footer' );

?>

<?php wp_footer(); ?>
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-WBSP9BT"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->

<script>
document.addEventListener('DOMContentLoaded', () => {
  /** init gtm after 3500 seconds - this could be adjusted */
  setTimeout(initGTM, 3500);
});
document.addEventListener('scroll', initGTMOnEvent);
document.addEventListener('mousemove', initGTMOnEvent);
document.addEventListener('touchstart', initGTMOnEvent);
function initGTMOnEvent(event) {
  initGTM();
  event.currentTarget.removeEventListener(event.type, initGTMOnEvent); // remove the event listener that got triggered
}
function initGTM() {
  if (window.gtmDidInit) {
    return false;
  }
  window.gtmDidInit = true; // flag to ensure script does not get added to DOM more than once.
  const script = document.createElement('script');
  script.type = 'text/javascript';
  script.async = true;
  // ensure PageViews is always tracked (on script load)
  script.onload = () => {
    dataLayer.push({ event: 'gtm.js', 'gtm.start': new Date().getTime(), 'gtm.uniqueEventId': 0 });
  };
  script.src = 'https://www.googletagmanager.com/gtm.js?id=GTM-WBSP9BT';
  document.head.appendChild(script);
}
</script>
<script>
	jQuery(document).ready(function() {
		setTimeout(function() {
			jQuery('#loader-layer').fadeOut();
		}, 200);
		/* Google Tag Manager */
		/*setTimeout(function() {
			(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
			new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
			j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
			'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
			})(window,document,'script','dataLayer','GTM-WBSP9BT');
		}, 10000); */
		/* End Google Tag Manager */
	});
</script>
</body>
</html>
