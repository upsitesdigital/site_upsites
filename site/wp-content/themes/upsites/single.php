<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
$id_blog = get_page_by_path( 'blog' );
$avatar = (get_user_meta($post->post_author, 'us_imagem_avatar', true) != '') ? wp_get_attachment_image(get_user_meta($post->post_author, 'us_imagem_avatar', true)) : get_avatar($post->post_author, 120);
$avatar2 = (get_user_meta(get_field('authors_reviewed')['ID'], 'us_imagem_avatar', true) != '') ? wp_get_attachment_image(get_user_meta(get_field('authors_reviewed')['ID'], 'us_imagem_avatar', true)) : get_avatar(get_field('authors_reviewed')['ID'], 120);
US_set_post_views(get_the_ID());

$mail = get_theme_mod('US_mail');

?>
  <!-- main -->
  <main id="main">
    <?php if (get_field('fullbannerheader_post')) {?> 
      <section class="top-banner">
        <div class="container">
          <h2>Descubra quanto custa um site <br>profissional agora mesmo!</h2>
          <h3>Você já se perguntou quanto custa ter um site para o seu negócio? </h3>
          <p>Entendemos a importância de um site de qualidade e acessível para todos.<br>
          Descubra agora uma estimativa de preço para contratar um site profissional.</p>
            <a rel="nofollow" target="_blank" href="https://upsites.digital/orcamentos/?origin=banner-post-<?=  get_post_field( 'post_name', get_the_ID() ) ?>" class="btnBudgets">
              <svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#coins"></use></svg> 
              Calcule o valor do site
            </a>
            <p class="small">Abaixo, você encontrará um artigo completo sobre o tema "Quanto custa um site", onde abordamos <br>detalhadamente os diversos aspectos que influenciam no valor final do seu projeto</p>
        </div>
      </section>
    <?php } ?>
    <!-- contentPost -->
    <section class="contentPost">
      <div class="container smallPost">
      <div id="the-content" class="grid-content">
        <div></div>
        <article>
          <?php if (function_exists('rank_math_the_breadcrumbs')) rank_math_the_breadcrumbs(); ?>
          <?php
            $post_categories = wp_get_post_categories( get_the_ID());
            if( $post_categories ){
              echo '<ul class="cats">';
              $termsid = array();
              foreach($post_categories as $cats){
                $cat = get_category( $cats );
                array_push($termsid, $cat->term_id);
                echo '<li><a rel="dofollow" href="' . get_term_link($cat->slug, 'category') . '">' . $cat->name . '</a></li>';
              }
              echo '</ul>';
            }
          ?>
          <h1><?php the_title() ?></h1>
          <div class="font">
            <div class="left">
              <span class="author">Por <?= '<a rel="dofollow" href="' . get_author_posts_url($post->post_author) . '" title="' . get_the_author_meta('display_name', $post->post_author) . '">' . get_the_author_meta('display_name', $post->post_author) . '</a>' ?></span>
              <span class="date"><?= get_the_date(); ?></span>
            </div>
            <span class="origin">
              <?php 
                if(get_field('fonte_post')) {
                  echo 'FONTE: <a rel="dofollow" href="http://'.get_field('fonte_post').'" title="'.get_field('fonte_post').'">'.get_field('fonte_post').'</a>';
                }
              ?>
            </span>
          </div>
          <?php if (get_field('authors_reviewed')) {
            ?>
            <div class="reviewed">
              <img src="<?= get_template_directory_uri() ?>/assets/img/reviewed.svg" alt="">
              Revisado por 
              <div class="link">
                <span><?= get_field('authors_reviewed')['display_name']; ?></span>
                <div class="popup-reviewed">
                  <div class="box-avatar"><?= $avatar2 ?></div>
                  <div class="box-content">
                    <span class="reviewed-icon"><img src="<?= get_template_directory_uri() ?>/assets/img/reviewed.svg" alt=""> revisado</span>
                    <h3><?= get_field('authors_reviewed')['display_name']; ?></h3>
                    <p><?= mb_strimwidth(get_the_author_meta('description', get_field('authors_reviewed')['ID']), 0, 100, "...") ?></p>
                    <a href="<?= get_author_posts_url(get_field('authors_reviewed')['ID']) ?>">Ver perfil completo</a>
                  </div>
                </div>
              </div>
            </div>
          <?php } ?>
          <?php if(has_excerpt()) { ?>
            <div class="excerpt">
              <p class="title-tldr pbottom-10"><b>Resumo (TL;DR)</b></p>
              <?php the_excerpt() ?>
            </div>
          <?php }; ?>
          <div class="image">
            <?= wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'full') ?>
          </div>

          <div class="share">
            <span>COMPARTILHE ESSE POST</span>
            <ul>
              <li>
                <a target="_blank" rel="nofollow" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" title="Twitter">
                  <svg class="icon twitter">
                    <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#twitter"></use>
                  </svg>
                </a>
              </li>
              <li>
                <a target="_blank" rel="nofollow" href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" title="Whatsapp">
                  <svg class="icon whats">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#whats"></use>
                </svg>
                </a>
              </li>
              <li>
                <a target="_blank" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Facebook">
                  <svg class="icon facebook">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#facebook"></use>
                </svg>
                </a>
              </li>
              <li>
                <a target="_blank" rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" title="Linkedin">
                  <svg class="icon linkedin">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#linkedin"></use>
                </svg>
                </a>
              </li>
              <li>
                <a target="_blank" rel="nofollow" href="mailto:?subject=<?php the_title(); ?> | UpSites&body=<?php the_permalink(); ?>." title="E-mail">
                  <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>

          <div id="index-list">
            <div class="list">
              <h5>Acesso rápido</h5>
              <ul>
                <?php 
                  $coreCont = get_the_content();
                  preg_match_all( '@<h[2].*?>(.*?)<\/h[2]>@', $coreCont, $matches );
                  $tag = $matches[1];
                  $index = 1;
                  foreach ($tag as $items) {
                    $url = get_the_permalink(get_the_ID()) .'/#' . sanitize_title($items);
                    $i = $index <= 9 ? '0'.$index : $index;
                    echo '<li data-content="' . $i . '"><a rel="dofollow" class="anchor" href="#' . sanitize_title($items) . '">' . $items . '</a></li>';
                    $index++;
                  }
                ?>
              </ul>
            </div>
          </div>
          
          
          <div class="content-post">
            <?php the_content(); ?>

            <?php
              if (have_rows('faqs_post')) :
                $arrayfaqpost = [];
                $count = 1;
                echo '<div id="US_schema" class="faq faq-post">
                  <h2>PERGUNTAS FREQUENTES</h2>
                  <div class="grid">';
                  while (have_rows('faqs_post')) : the_row();
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
                </div></div>';
              endif;
            ?>
            <div class="authorPost">
              <div class="avatar">
                <?= $avatar ?>
              </div>
              <div class="text">
                <h3><?= get_the_author_meta('display_name', $post->post_author) ?></h3>
                <p><?= get_the_author_meta('description', $post->post_author) ?></p>
                <?php 
                $twitter = get_the_author_meta( 'twitter', $post->post_author );
                $facebook = get_the_author_meta( 'facebook', $post->post_author );
                $linkedin = get_the_author_meta( 'linkedin', $post->post_author );?>
                <?php 
								  if($twitter or $facebook or $linkedin) {
                ?>
                <div class="share">
                  <ul>
                    <?php 
                      if($twitter) {
                        echo '<li><a rel="nofollow" href="' . $twitter . '" title="Twitter"><svg class="icon twitter"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#twitter"></use></svg></a></li>';
                      }
                      if($facebook) {
                        echo '<li><a rel="nofollow" href="' . $facebook . '" title="Facebook"><svg class="icon facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#facebook"></use></svg></a></li>';
                      }
                      if($linkedin) {
                        echo '<li><a rel="nofollow" href="' . $linkedin . '" title="Linkedin"><svg class="icon linkedin"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#linkedin"></use></svg></a></li>';
                      }
                    ?>
                  </ul>
                </div>
                <?php } ?>
                <a href="<?= get_author_posts_url($post->post_author) ?>">Ver todos os posts</a>
              </div>
            </div>
            <div class="banner">
              <?php 
                if(get_field('banner_blog',$id_blog)) {
                  if(get_field('link_banner_blog',$id_blog)) {
                    echo '<a rel="dofollow" href="'.get_field('link_banner_blog',$id_blog).'">';
                  }
                  echo wp_get_attachment_image(get_field('banner_blog',$id_blog), 'full');
                  if(get_field('link_banner_blog',$id_blog)) {
                    echo '</a>';
                  }
                }
              ?>
            </div>
          </div>
            

        </article>
        <div>
          <div id="btbar" class="share-fixed">
            <span>COMPARTILHE</span>
            <ul>
              <li>
                <a target="_blank" rel="nofollow" href="https://twitter.com/intent/tweet?url=<?php the_permalink(); ?>&text=<?php the_title(); ?>" title="Twitter">
                  <svg class="icon twitter">
                    <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#twitter"></use>
                  </svg>
                </a>
              </li>
              <li>
                <a target="_blank" rel="nofollow" href="https://api.whatsapp.com/send?text=<?php the_permalink(); ?>" title="Whatsapp">
                  <svg class="icon whats">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#whats"></use>
                </svg>
                </a>
              </li>
              <li>
                <a target="_blank" rel="nofollow" href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="Facebook">
                  <svg class="icon facebook">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#facebook"></use>
                </svg>
                </a>
              </li>
              <li>
                <a target="_blank" rel="nofollow" href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" title="Linkedin">
                  <svg class="icon linkedin">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#linkedin"></use>
                </svg>
                </a>
              </li>
              <li>
                <a target="_blank" rel="nofollow" href="mailto:?subject=<?php the_title(); ?> | UpSites&body=<?php the_permalink(); ?>." title="E-mail">
                  <i class="fa fa-envelope-o" aria-hidden="true"></i>
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>


      </div>
    </section>
    <!-- end:contentPost -->
    <!-- featuredArticles -->
    <section class="internaPost featuredArticles">
      <div class="container relative">
        <span>SE INFORME ANTES DE CRIAR SEU SITE!</span>
        <h2>ARTIGOS RELACIONADOS</h2>
        <!-- a rel="dofollow" href="<?= get_permalink( get_page_by_path( 'blog' ) ) ?>" class="all">
          VEJA MAIS
          <svg class="icon arrowSlide">
            <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
          </svg>
        </a -->
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