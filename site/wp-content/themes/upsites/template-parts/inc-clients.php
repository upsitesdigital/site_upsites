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

$class_grey = '';
if(is_page_template( 'template-pages/signature-site.php' )) {
	$class_grey = 'grey';
}

$class_hide = '';
if(is_page_template( 'template-pages/signature-site.php' ) or is_page_template( 'template-pages/shop.php' ) or is_page_template( 'template-pages/seo.php' )) {
	$class_hide = 'hide';
}
?>
<?php if(get_field('desativar_seccao_clients') !== 'inativo') { ?>
<section class="clients <?= $class_grey; ?>">
	<div class="container">
		<?php 
			if(get_field('subtitulo_clients', $idhome)) {
				echo '<span>' . get_field('subtitulo_clients', $idhome) . '</span>';
			}
			if(get_field('titulo_clients', $idhome)) {
				echo '<h2>' . get_field('titulo_clients', $idhome) . '</h2>';
			}
			if(get_field('texto_clients', $idhome)) {
				echo '<p>' . get_field('texto_clients', $idhome) . '</p>';
			}
		?>
		<div class="clientSlide <?= $class_hide; ?>">
			<?php
				$slideargs = array(
					'post_type' 						 => 'clients',
					'post_status'            => 'publish',
					'posts_per_page'         => '-1',
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false
				);
				$slideposts = new WP_Query($slideargs);
				while ($slideposts->have_posts()) : $slideposts->the_post();
					echo '<div class="item">' . wp_get_attachment_image(get_field('imagem_clients'), 'full') . '</div>';
				endwhile;
				wp_reset_postdata();
			?>
		</div>

		<div class="testimonySlide">
			<?php
				$slideargs = array(
					'post_type' 						 => 'assessments',
					'post_status'            => 'publish',
					'posts_per_page'         => '6',
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false
				);
				$slideposts = new WP_Query($slideargs);
				while ($slideposts->have_posts()) : $slideposts->the_post();
					echo '<div class="item">
						<div class="box">
							<svg class="icon">
								<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#quotation"></use>
							</svg>
							<p>' . get_the_content() . '</p>
							<div class="person">
								<div class="info">
									<strong>' . get_the_title() . '</strong>
									<span>' . get_field('cargo_assessments') . '</span>
								</div>
							</div>
		
						</div>
					</div>';
				endwhile;
				wp_reset_postdata();
			?>
		</div>


		<div class="pagSlide">
			<button id="slick-prev" class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon">
					<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
				</svg></button>
			<div class="pagingInfo"></div>
			<button id="slick-next" class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon">
					<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
				</svg></button>
		</div>
		<div class="blockGoogle">
			<div class="item image">
				<?php 
					if(get_field('banner_clients', $idhome)) {
						echo wp_get_attachment_image(get_field('banner_clients', $idhome), 'full');
					}
				?>
			</div>
			<div class="item">
				<?php 
					if(get_field('text_banner_clients', $idhome)) {
						echo '<p>' . get_field('text_banner_clients', $idhome) . '</p>';
					}
				?>
				
			</div>
		</div>
	</div>
</section>
<?php } ?>
