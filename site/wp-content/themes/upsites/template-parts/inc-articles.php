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
?>
<?php if(get_field('desativar_seccao_articles') !== 'inativo') { ?>
<section class="featuredArticles">
	<div class="container relative">
		<?php 
			if(get_field('subtitulo_articles', $idhome)) {
				echo '<span>' . get_field('subtitulo_articles', $idhome) . '</span>';
			}
			if(get_field('titulo_articles', $idhome)) {
				echo '<h2>' . get_field('titulo_articles', $idhome) . '</h2>';
			}
		?>
		<a href="<?= get_permalink( get_page_by_path( 'blog' ) ) ?>" class="all">
			VEJA MAIS
			<svg class="icon arrowSlide">
				<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
			</svg>
		</a>
		<div class="grid">
			<?php
				$postargs = array(
					'post_type' 						 => 'post',
					'posts_per_page'         => 3,
					'post_status'            => 'publish',
					'meta_key'      				 => 'destacar_post',
					'meta_value'    				 => '1',
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false
				);
				$postcat = new WP_Query($postargs);
				while ($postcat->have_posts()) : $postcat->the_post();
					get_template_part('template-parts/posts/content', 'blog');
				endwhile;
				// wp_reset_postdata();
			?>
		</div>
	</div>
</section>
<?php } ?>
