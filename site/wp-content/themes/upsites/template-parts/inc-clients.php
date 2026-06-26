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

$term = array_key_exists('subtitle',$args) ? $args['subtitle'] : NULL;
$titulo = array_key_exists('titulo',$args) ? $args['titulo'] : NULL;
$text = array_key_exists('text',$args) ? $args['text'] : NULL;
$testimony = array_key_exists('testimonySlide',$args) ? $args['testimonySlide'] : NULL;
$clients = array_key_exists('clientSlide',$args) ? $args['clientSlide'] : NULL;
$google = array_key_exists('google',$args) ? $args['google'] : NULL;
?>
<?php if(get_field('desativar_seccao_clients') !== 'inativo') { ?>
<section class="clients">
	<div class="container">
		<?php 
			if($term == NULL) {
				if(get_field('subtitulo_clients', $idhome)) {
					echo '<h3 class="subtitle"  data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('subtitulo_clients', $idhome) . '</h3>';
				}
			} else {
				echo '<h3 class="subtitle"  data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . $term . '</h3>';
			}
			
			if($titulo == NULL) {
				if(get_field('titulo_clients', $idhome)) {
					echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_clients', $idhome) . '</h2>';
				}
			} else {
				echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . $titulo . '</h2>';
			}
			if($text == NULL) {
				if(get_field('texto_clients', $idhome)) {
					echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('texto_clients', $idhome) . '</p>';
				}
			} else {
				echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . $text . '</p>';
			}
		?>
		<?php 
			if($clients == NULL) {?>
		<div class="clientSlide">
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
				$count = 1;
				while ($slideposts->have_posts()) : $slideposts->the_post();
					echo '<div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.'.$count.'s">' . wp_get_attachment_image(get_field('imagem_clients'), 'full') . '</div>';
					$count++;
				endwhile;
				wp_reset_postdata();
			?>
		</div>
		<?php } 
		?>
		<?php 
			if($testimony == NULL) {?>
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
						$count = 1;
						while ($slideposts->have_posts()) : $slideposts->the_post();
							echo '<div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.'.$count.'s">
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
							$count++;
						endwhile;
						wp_reset_postdata();
					?>
				</div>
				<div class="pagSlide" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">
					<button id="slick-prev" class="slick-prev slick-arrow" aria-label="Previous" type="button"><svg class="icon">
							<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
						</svg></button>
					<div class="pagingInfo"></div>
					<button id="slick-next" class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon">
							<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
						</svg></button>
				</div>
			<?php } 
		?>
		
		<?php 
			if($google == NULL) {?>
		<div class="blockGoogle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">
			<div class="item image">
				<div class="box-google">
					<div class="logo"><img src="<?= get_template_directory_uri() ?>/assets/img/google2.svg" alt="google" width="57" height="57" /></div>
					<div class="text">
						<?php 
							if(get_field('text_banner_clients_g1', $idhome)) {
								echo '<span class="text1">' . get_field('text_banner_clients_g1', $idhome) . '</span>';
							}
						?>
						<div class="google">
							<?php 
								if(get_field('text_banner_clients_g2', $idhome)) {
									echo '<span>' . get_field('text_banner_clients_g2', $idhome) . '</span>';
								}
							?>
							<img class="star" src="<?= get_template_directory_uri() ?>/assets/img/full-star.svg" alt="star" width="17" height="16" />
							<img class="star" src="<?= get_template_directory_uri() ?>/assets/img/full-star.svg" alt="star" width="17" height="16" />
							<img class="star" src="<?= get_template_directory_uri() ?>/assets/img/full-star.svg" alt="star" width="17" height="16" />
							<img class="star" src="<?= get_template_directory_uri() ?>/assets/img/full-star.svg" alt="star" width="17" height="16" />
							<img class="star" src="<?= get_template_directory_uri() ?>/assets/img/half-star.svg" alt="star" width="17" height="16" />
						</div>
						<?php 
							if(get_field('text_banner_clients_g3', $idhome)) {
								echo '<span class="text2">' . get_field('text_banner_clients_g3', $idhome) . '</span>';
							}
						?>
					</div>
				</div>
			</div>
			<div class="item">
				<?php 
					if(get_field('text_banner_clients', $idhome)) {
						echo '<p>' . get_field('text_banner_clients', $idhome) . '</p>';
					}
				?>
				
			</div>
		</div>
		<?php } 
		?>
	</div>
</section>
<?php } ?>
