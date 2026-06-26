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

$idhome = array_key_exists('id',$args) ? $args['id'] : $idObj->ID;
//$idhome = $idObj->ID;

$phone 					= get_theme_mod('US_phone');
$phone_custom 	= '0'.str_replace(array('(', ')', '-', ' '), "", $phone);

$term = array_key_exists('type',$args) ? $args['type'] : 'tree-cols';

?>
<?php if(get_field('desativar_seccao_contsitepro') !== 'inativo') { ?>
<section id="contratar" class="hireProfessionWebsite <?= $term ?> ">
	<div class="container">
		<div class="grid">
			<div class="fast" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">
				<div class="box">
					<div class="icons">
						<svg class="icon">
							<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#screen"></use>
						</svg>
					</div>
					<?php 
						if( have_rows('lateral_esquerda_contsitepro', $idhome) ):
							while ( have_rows('lateral_esquerda_contsitepro', $idhome) ) : the_row();
								echo '<h3>' . get_sub_field('titulo') . '</h3>
								<p>' . get_sub_field('texto') . '</p>
								<hr>
								<div class="price">' . get_sub_field('preco') . '</div>
								<p class="small">' . get_sub_field('apoio') . '</p>
								<hr>';
								if( have_rows('itens') ):
									echo '<ul>';
									while ( have_rows('itens') ) : the_row();
										echo '<li data-scroll-reveal="enter right move 50px over 0.6s after 0.1s">
											<div class="before">
												<svg class="icon">
													<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#check"></use>
												</svg>
											</div>
											' . get_sub_field('item') . '
										</li>';
									endwhile;
									echo '</ul>';
								endif;
								echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0.1s" target="_blank" rel="nofollow" href="' . get_sub_field('link_botao') . '" class="btnBudgets mbottom-0">
									<svg class="icon">
										<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use>
									</svg> ' . get_sub_field('texto_botao') . '
								</a>';
							endwhile;
						endif;
					?>
				</div>
			</div>
			<div class="phone" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
				<div class="boxStick">
					<?php 
						if(get_field('subtitulo_contsitepro', $idhome)) {
							echo '<h3 class="subtitle">' . get_field('subtitulo_contsitepro', $idhome) . '</h3>';
						}
						if(get_field('titulo_contsitepro', $idhome)) {
							echo '<h2>' . get_field('titulo_contsitepro', $idhome) . '</h2>';
						}
						if(get_field('imagem_contsitepro', $idhome)) {
							echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_contsitepro', $idhome), 'full') . '</div>';
						}
						if(get_field('texto_contsitepro', $idhome)) {
							echo '<p>' . get_field('texto_contsitepro', $idhome) . '</p>';
						}
					?>
					<svg class="icon arrowSlide">
						<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
					</svg>
					<?php 
						if($phone != '') {
							echo '<a rel="nofollow" href="tel:' . $phone_custom . '">
								<svg class="icon">
									<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#phone"></use>
								</svg> ' . $phone . '
							</a>';
						}	
					?>
				</div>
			</div>
			<div class="customSite" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
				<div class="box">
					<div class="icons">
						<svg class="icon">
							<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#fullCustom"></use>
						</svg>
					</div>
					<?php 
						if( have_rows('lateral_direita_contsitepro', $idhome) ):
							while ( have_rows('lateral_direita_contsitepro', $idhome) ) : the_row();
								echo '<h3>' . get_sub_field('titulo') . '</h3>
								<p>' . get_sub_field('texto') . '</p>
								<hr>
								<div class="budget">' . get_sub_field('preco') . '</div>
								<p class="small">' . get_sub_field('apoio') . '</p>
								<hr>';
								if( have_rows('itens') ):
									echo '<ul>';
									while ( have_rows('itens') ) : the_row();
										echo '<li data-scroll-reveal="enter right move 50px over 0.6s after 0.1s">
											<div class="before">
												<svg class="icon">
													<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#check"></use>
												</svg>
											</div>
											' . get_sub_field('item') . '
										</li>';
									endwhile;
									echo '</ul>';
								endif;
								echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0.1s" rel="nofollow" target="_blank" href="' . get_sub_field('link_botao') . '" class="btnBudgets mbottom-0">
									<svg class="icon">
										<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use>
									</svg> ' . get_sub_field('texto_botao') . '
								</a>';
							endwhile;
						endif;
					?>
				</div>
			</div>
		</div>
	</div>
</section>
<?php } ?>