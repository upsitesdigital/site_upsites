<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
$id_blog = get_page_by_path( 'blog' );
$avatar = (get_user_meta($post->post_author, 'us_imagem_avatar', true) != '') ? wp_get_attachment_image(get_user_meta($post->post_author, 'us_imagem_avatar', true)) : get_avatar($post->post_author, 120);
US_set_post_views(get_the_ID());

$mail = get_theme_mod('US_mail');

?>
  <!-- main -->
  <main>
    <!-- contentPost -->
    <section class="contentPost">
      <div class="container smallPost">
        <article>
          <?php
            $post_categories = wp_get_post_categories( get_the_ID());
            if( $post_categories ){
              echo '<ul class="cats">';
              $termsid = array();
              foreach($post_categories as $cats){
                $cat = get_category( $cats );
                array_push($termsid, $cat->term_id);
                echo '<li>' . $cat->name . '</li>';
              }
              echo '</ul>';
            }
          ?>
          <h1><?php the_title() ?></h1>
          <div class="font">
            <span class="author">Por 
						<?= '<a href="' . get_author_posts_url($post->post_author) . '" title="' . get_the_author_meta('display_name', $post->post_author) . '">' . get_the_author_meta('display_name', $post->post_author) . '</a>' ?>
						
            </span>
            <span class="origin">
							<?php 
								if(get_field('fonte_post')) {
									echo 'FONTE: <a href="http://'.get_field('fonte_post').'" title="'.get_field('fonte_post').'">'.get_field('fonte_post').'</a>';
								}
							?>
            </span>
          </div>
          <div class="image">
						<?= wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'full') ?>
					</div>
            

          <div id="the-content" class="share">
            <span>COMPARTILHE ESSE POST</span>
            <ul>
              <li>
                <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" title="Twitter">
                  <svg class="icon twitter">
										<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#twitter"></use>
									</svg>
                </a>
              </li>
              <li>
                <a href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" title="Whatsapp">
                  <svg class="icon whats">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#whats"></use>
                </svg>
                </a>
              </li>
              <li>
                <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Facebook">
                  <svg class="icon facebook">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#facebook"></use>
                </svg>
                </a>
              </li>
              <li>
                <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" title="Linkedin">
                  <svg class="icon linkedin">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#linkedin"></use>
                </svg>
                </a>
              </li>
              <li>
                <a href="mailto:?subject=<?php the_title(); ?> | UpSites&body=<?php the_permalink(); ?>." title="E-mail">
                  <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
          <div class="the-content">
            <div id="index-list">
              <div class="list">
                <h5>ACESSO RÁPIDO</h5>
                <ul>
                <?php 
                  $coreCont = get_the_content();
                  preg_match_all( '@<h[2].*?>(.*?)<\/h[2]>@', $coreCont, $matches );
                  $tag = $matches[1];
                  $index = 0;
                  foreach ($tag as $items) {
                    echo '<li><a class="anchor" href="#' . sanitize_title($items) . '">' . $items . '</a></li>';
                    $index++;
                  }
                ?>
                </ul>
              </div>
            </div>
            <div id="cont-index">
              <?php 
                the_content();
              ?>
              <?php
                if (have_rows('faqs_post')) :
                  $arrayfaqpost = [];
                  $count = 1;
                  echo '<div class="faq faq-post">
                  <h2>PERGUNTAS FREQUENTES</h2>
                    <div class="grid">';
                  while (have_rows('faqs_post')) : the_row();
                    $objfaq = ["@type" => "Question", "name" => get_sub_field('titulo'), "acceptedAnswer" => [ "@type" => "Answer", "text" => sanitize_text_field(get_sub_field('texto'))]];
                    $objfaqjson = json_encode($objfaq,JSON_UNESCAPED_UNICODE);
                    array_push($arrayfaqpost, $objfaq);
                    echo '<div class="item accordion" id="faq-' . $count . '">
                    <div class="title accordionClick">
                      <h3>' . get_sub_field('titulo') . '</h3>
                      <svg class="icon accordionIcon">
                        <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#chevron"></use>
                      </svg>
                    </div>
                    <div class="content accordionContent">' . get_sub_field('texto') . '</div>
                  </div>';
                  $count++;
                  endwhile;
                  echo '
                  </div>
                </div>';
                ?>
                <script type="application/ld+json">
                {
                  "@context": "https://schema.org",
                  "@type": "FAQPage",
                  "mainEntity": <?php echo json_encode($arrayfaqpost,JSON_UNESCAPED_UNICODE) ?>
                }
                </script>
                <?php
                endif;
              ?>
            </div>
            <div>
              <div id="btbar" class="share-fixed">
                <span>COMPARTILHE</span>
                <ul>
                  <li>
                    <a href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" title="Twitter">
                      <svg class="icon twitter">
                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#twitter"></use>
                      </svg>
                    </a>
                  </li>
                  <li>
                    <a href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" title="Whatsapp">
                      <svg class="icon whats">
                      <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#whats"></use>
                    </svg>
                    </a>
                  </li>
                  <li>
                    <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Facebook">
                      <svg class="icon facebook">
                      <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#facebook"></use>
                    </svg>
                    </a>
                  </li>
                  <li>
                    <a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" title="Linkedin">
                      <svg class="icon linkedin">
                      <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#linkedin"></use>
                    </svg>
                    </a>
                  </li>
                  <li>
                    <a href="mailto:?subject=<?php the_title(); ?> | UpSites&body=<?php the_permalink(); ?>." title="E-mail">
                      <i class="fa fa-envelope-o" aria-hidden="true"></i>
                    </a>
                  </li>
                </ul>
              </div>
            </div>
          </div>
        </article>
        <a href="<?= get_author_posts_url($post->post_author) ?>" title="<?= get_the_author_meta('display_name', $post->post_author) ?>" class="authorPost">
          <div class="avatar">
						<?= $avatar ?>
					</div>
          <div class="text">
            <h3><?= get_the_author_meta('display_name', $post->post_author) ?></h3>
            <p><?= get_the_author_meta('description', $post->post_author) ?></p>
          </div>
        </a>
        <div class="banner">
          <?php 
            if(get_field('banner_blog',$id_blog)) {
              if(get_field('link_banner_blog',$id_blog)) {
                echo '<a href="'.get_field('link_banner_blog',$id_blog).'">';
              }
              echo wp_get_attachment_image(get_field('banner_blog',$id_blog), 'full');
              if(get_field('link_banner_blog',$id_blog)) {
                echo '</a>';
              }
            }
          ?>
        </div>
      </div>
    </section>
    <!-- end:contentPost -->
    <!-- featuredArticles -->
    <section class="internaPost featuredArticles">
      <div class="container relative">
        <span>SE INFORME ANTES DE CRIAR SEU SITE!</span>
        <h2>ARTIGOS EM DESTAQUE</h2>
        <a href="<?= get_permalink( get_page_by_path( 'blog' ) ) ?>" class="all">
          VEJA MAIS
          <svg class="icon arrowSlide">
            <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
          </svg>
        </a>
        <div class="grid">
					<?php
          	$relargs = array(
							'post_type' 						 => 'post',
							'post_status'            => 'publish',
							'posts_per_page'         => '3',
							'post__not_in'     			 => array(get_the_ID()),
              'category__in'           => $termsid,
							'no_found_rows'          => true,
							'update_post_term_cache' => false,
							'update_post_meta_cache' => false,
							'cache_results'          => false
						);
						$relposts = new WP_Query($relargs);
						while ($relposts->have_posts()) : $relposts->the_post();
							get_template_part('template-parts/posts/content', 'blog');
						endwhile;
						wp_reset_postdata();
					?>
        </div>
      </div>
    </section>
    <!-- end:featuredArticles -->

  </main>
  <!-- end:main -->
<?php
get_footer();