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
$user_id = $post->post_author;
$avatar = (get_user_meta($post->post_author, 'us_imagem_avatar', true) != '') ? wp_get_attachment_image(get_user_meta($post->post_author, 'us_imagem_avatar', true)) : get_avatar($post->post_author, 120);
US_set_post_views(get_the_ID());

$twitter = get_the_author_meta( 'twitter', $user_id );
$facebook = get_the_author_meta( 'facebook', $user_id );
$linkedin = get_the_author_meta( 'linkedin', $user_id );


?>

  <!-- main -->
  <main>
    <!-- slideFull -->
    <section class="author-description">
      <div class="container">
				<div class="grid">
					<div class="authorPost">
						<div class="avatar">
							<?= $avatar ?>
						</div>
						<div class="text">
							<span>Autor</span>
							<h3><?= get_the_author_meta('display_name', $post->post_author) ?></h3>
							<div class="share">
								<ul>
									<?php 
										if($twitter) {
											echo '<li><a href="' . $twitter . '" title="Twitter"><svg class="icon twitter"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#twitter"></use></svg></a></li>';
										}
										if($facebook) {
											echo '<li><a href="' . $facebook . '" title="Facebook"><svg class="icon facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#facebook"></use></svg></a></li>';
										}
										if($linkedin) {
											echo '<li><a href="' . $linkedin . '" title="Linkedin"><svg class="icon linkedin"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#linkedin"></use></svg></a></li>';
										}
									?>
								</ul>
							</div>
							<p><?= get_the_author_meta('description', $post->post_author) ?></p>
						</div>
					</div>
					<div class="total-post">
						<?php
						if (count_user_posts($user_id) == 0) {
							echo 'Nenhuma matéria publicada';
						} elseif (count_user_posts($user_id) == 1) {
							echo '<span class="num">' . count_user_posts($user_id) . '</span><span class="text">MATÉRIA <br> POSTADA</span>';
						} else {
							echo '<span class="num">' . count_user_posts($user_id) . '</span><span class="text">MATÉRIAS <br> POSTADAS</span>';
						}
						?>
					</div>
        </div>
      </div>
    </section>
    <!-- end:slideFull -->

    <!-- listBlog -->
    <section class="listBlog">
      <div class="container">
        <hr>
        <div class="">
          <div class="content">
            <div class="banner">
            <?php 
              if(get_field('banner_blog')) {
                if(get_field('link_banner_blog')) {
                  echo '<a href="'.get_field('link_banner_blog').'">';
                }
                echo wp_get_attachment_image(get_field('banner_blog'), 'full');
                if(get_field('link_banner_blog')) {
                  echo '</a>';
                }
              }
            ?>
            </div>
            <div class="list">
              <?php
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$postargs = array(
									'post_type' 						 => 'post',
									'paged' 								 => $paged,
									'post_status'            => 'publish',
									'author' 								 => $user_id,
								);
								$postcat = new WP_Query($postargs);
								$maxpages = $postcat->max_num_pages;
								while ($postcat->have_posts()) : $postcat->the_post();
									get_template_part('template-parts/posts/content', 'blog');
								endwhile;
								// wp_reset_postdata();
							?>
            </div>
            <?php US_paging_nav($postcat, $paged, $maxpages); ?>
          </div>
        </div>
      </div>
    </section>
    <!-- end:listBlog -->

  </main>
  <!-- end:main -->
