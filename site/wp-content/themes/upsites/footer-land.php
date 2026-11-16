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
<footer></footer>
<?php wp_footer(); ?>

<script>
	jQuery(document).ready(function() {
		setTimeout(function() {
			jQuery('#loader-layer').fadeOut();
		}, 200);

		jQuery("#land-title").val("<?= get_field('texto_seglanding'); ?>");
	});
</script>
</body>
</html>
