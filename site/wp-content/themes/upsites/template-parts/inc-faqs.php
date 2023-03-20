<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

$idObj = get_page_by_path( 'home' );
$idhome = $idObj->ID;

$term = $args['type'];
?>
<?php if(get_field('desativar_seccao_faqs') !== 'inativo') { ?>
<section class="faq">
	<div class="container">
		<?php 
			if(get_field('subtitulo_faqs', $idhome)) {
				echo '<span>' . get_field('subtitulo_faqs', $idhome) . '</span>';
			}
			if(get_field('titulo_faqs', $idhome)) {
				echo '<h2>' . get_field('titulo_faqs', $idhome) . '</h2>';
			}
		?>
		<div class="grid">
			<?php
			$slideargs = array(
				'post_type' 						 => 'faqs',
				'post_status'            => 'publish',
				'posts_per_page'         => '-1',
				'no_found_rows'          => true,
				'update_post_term_cache' => false,
				'update_post_meta_cache' => false,
				'cache_results'          => false
			);
			
			if ($term) {
				$slideargs['tax_query'] = array(
					array(
						'taxonomy' => 'categories_faqs',
						'field' => 'slug',
						'terms' => $term,
					)
				);
			}
			$slideposts = new WP_Query($slideargs);
			$arrayfaq = [];
			while ($slideposts->have_posts()) : $slideposts->the_post();
				$objfaq = ["@type" => "Question", "name" => get_the_title(), "acceptedAnswer" => [ "@type" => "Answer", "text" => get_the_content()]];
				$objfaqjson = json_encode($objfaq,JSON_UNESCAPED_UNICODE);
				array_push($arrayfaq, $objfaq);
				get_template_part('template-parts/posts/content', 'faq');
			endwhile;
			wp_reset_postdata();
			?>
			<script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "FAQPage",
				"mainEntity": <?php echo json_encode($arrayfaq,JSON_UNESCAPED_UNICODE) ?>
			}
			</script>
		</div>
	</div>
</section>
<?php } ?>
