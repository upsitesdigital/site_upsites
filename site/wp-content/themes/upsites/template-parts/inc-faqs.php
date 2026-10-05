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
$title = array_key_exists('title', $args) ? $args['title'] : get_field('subtitulo_faqs', $idhome);
?>
<?php if(get_field('desativar_seccao_faqs') !== 'inativo') { ?>
<section class="faq">
	<div class="container">
		<?php 
			if($title != '') {
				echo '<h3 class="subtitle">' . $title . '</h3>';
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
				$objfaq = [
					"@type" => "Question", 
					"name" => get_the_title(), 
					"acceptedAnswer" => [ 
						"@type" => "Answer", 
						"text" => get_the_content()
					]
				];
				$objfaqjson = $objfaq;
				array_push($arrayfaq, $objfaq);
				get_template_part('template-parts/posts/content', 'faq');
			endwhile;
			wp_reset_postdata();
			// echo "<pre>";
			// var_dump($arrayfaq);
			// echo "</pre>";
			?>
			<div id="US_schema" style="display: none;">
				<textarea><?php echo json_encode($arrayfaq) ?></textarea>
			</div>

			<!-- script type="application/ld+json">
			{
				"@context": "https://schema.org",
				"@type": "FAQPage",
				"isPartOf": {
					"@type": "WebSite",
					"@id": "#WebSite"
				},
				"mainEntity": <?php echo json_encode($arrayfaq,JSON_UNESCAPED_UNICODE) ?>
			}
			</script -->
		</div>
	</div>
</section>
<?php } ?>
