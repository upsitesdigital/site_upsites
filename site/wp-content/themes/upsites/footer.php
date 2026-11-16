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

<script>
	jQuery(document).ready(function() {
		setTimeout(function() {
			jQuery('#loader-layer').fadeOut();
		}, 200);
	});
</script>
</body>
</html>
