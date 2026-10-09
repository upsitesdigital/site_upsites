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

$title   = get_field('title_otherpages') ? get_field('title_otherpages') : 'TAMBÉM CRIAMOS SITE PARA:';
$linkbtn = get_field('linkbtn_otherpages') ? get_field('linkbtn_otherpages') : get_permalink( get_page_by_path( 'criacao-sites-segmentos' ) );
$textbtn = get_field('textbtn_otherpages') ? get_field('textbtn_otherpages') : 'Ver todos';
$list    = get_field('list_otherpages');

?>

<section class="other-pages">
	<div class="container">
		<h2><?= $title ?></h2>
		<div class="box-slide-page pageSlide">
			<?php
				$relargs = array(
					'post_type' 						 => 'landings',
					'post_status'            => 'publish',
					'posts_per_page'         => '-1',
					'post__not_in'     			 => array(get_the_ID()),
					'no_found_rows'          => true,
					'update_post_term_cache' => false,
					'update_post_meta_cache' => false,
					'cache_results'          => false
				);
				if($list) {
					$relargs['post__in'] = $list;
					$relargs['orderby']  = 'post__in';
				}
				$relposts = new WP_Query($relargs);
				while ($relposts->have_posts()) : $relposts->the_post();
			?>
					<a href="<?= get_the_permalink() ?>" class="item">
						<div class="box-icon" style="background-color: <?= get_field('cor_seglanding') ?>;">
							<?= wp_get_attachment_image(get_field('icone_seglanding'), 'full') ?>
						</div>
						<h3>Site para <?= get_field('texto_seglanding') ?></h3>
					</a>
			<?php
				endwhile;
				wp_reset_postdata();
			?>
		</div>
		<div class="center" style="text-align: center;">
			<a href="<?= $linkbtn ?>" class="btnBudgets"><?= $textbtn ?></a>
		</div>
	</div>
</section>