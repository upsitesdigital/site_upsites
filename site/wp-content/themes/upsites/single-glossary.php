<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
$id_glossario = get_page_by_path( 'glossario' );
$id_glossary_theme = get_page_by_path( 'glossario-tema' );

US_set_post_views(get_the_ID());

$mail = get_theme_mod('US_mail');
$term = wp_get_post_terms(get_the_ID(), 'term-glossary',  array("fields" => "all"));
$theme = wp_get_post_terms(get_the_ID(), 'theme-glossary',  array("fields" => "all"));
?>
  <!-- main -->
  <main id="main">
    
    <section class="hero-internal-glossary">
      <div class="container">
        <div class="grid-hero">
          <div class="text">
            <div class="breadcrumb">
              <a href="<?= get_permalink($id_glossario) ?>">Glossário</a>
              <div class="div"><svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#chevron2"></use></svg></div>
              <a href="<?= get_permalink($id_glossario) . '#' . $term[0]->name  ?>"><?= $term[0]->name; ?></a>
              <div class="div"><svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#chevron2"></use></svg></div>
              <a href="<?= get_permalink($id_glossary_theme) ?>#<?= $theme[0]->name; ?>"><span><?= $theme[0]->name; ?></span></a>
            </div>
            <!-- <span class="subtitle">CATEGORIA</span> -->
            <h1 class="title"><?php the_title() ?></h1>
            <?php the_excerpt() ?>
            <div class="share">
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
          <div class="box-link">
            <div class="box">
              <h3>simply dummy text of the printing</h3>
              <p class="likes"><span>
                <?php 
                  if(get_post_meta(get_the_ID(), 'US_post_like_count', true) == '') {
                    echo '0';
                    } else {
                    echo get_post_meta(get_the_ID(), 'US_post_like_count', true);
                  } 
                ?>
              </span> curtidas</p>
              <a href="#" class="btn" data-id="<?= get_the_ID() ?>">
                <svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#like"></use></svg>
                Like
              </a>
              <div class="image"><img src="<?= get_bloginfo("template_url") ?>/assets/img/glossary-box-internal.png" alt=""></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="internal-glossary">
      <div class="container">
        <div class="grid-internal-glossary">
          <div class="text">
            <?= the_content(); ?>
          </div>
          <div class="sidebar-glossary">
            <div class="box-term">
              <h3>Termos Relacionado</h3>
              <ul>
                <?php 
                  $args = array(
                    'post_type' 						 => 'glossary',
                    'post_status'            => 'publish',
                    'posts_per_page' => 5,
                    'tax_query' => array(
                      array(
                        'taxonomy'  => 'theme-glossary',
                        'field'     => 'slug',
                        'terms'     => $theme[0]->slug
                      ),
                    )
                  );
                  $query = new WP_Query( $args );
                  while ($query->have_posts()) : $query->the_post();
                    echo '<li><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                  endwhile;
                  wp_reset_postdata();
                ?>
              </ul>
            </div>
            <div class="box-banner">
              <h3><?= get_field('title_bannerglossary', $id_glossario); ?></h3>
              <p><?= get_field('text_bannerglossary', $id_glossario); ?></p>
              <?php
                if(get_field('linkbtn_bannerglossary', $id_glossario)) {
                  echo '<a rel="nofollow" target="_blank" href="' . get_field('linkbtn_bannerglossary', $id_glossario) . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_bloginfo("template_url") . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('textbtn_bannerglossary', $id_glossario) . '</a>';
                }
              ?>
              <div class="image">
                <img src="<?= get_bloginfo("template_url") ?>/assets/img/glossary-box-banner.png" alt="">
              </div>
            </div>
          </div>
        </div>
        <?php
          if(have_rows('faqs_postglossary')) :
            $count = 1;
            echo '<div class="faq faq-post">
              <h2>PERGUNTAS FREQUENTES</h2>
              <div class="grid">';
              while (have_rows('faqs_postglossary')) : the_row();
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
        <div class="bannerfull-glossary">
          <span class="subtitle"><?= get_field('subtitle_fullbannerglossary', $id_glossario); ?></span>
          <h2 class="title"><?= get_field('title_fullbannerglossary', $id_glossario); ?></h2>
          <p><?= get_field('text_fullbannerglossary', $id_glossario); ?></p>
          <?php
            if(get_field('linkbtn_fullbannerglossary', $id_glossario)) {
              echo '<a href="' . get_field('linkbtn_fullbannerglossary', $id_glossario) . '" class="btn">' . get_field('textbtn_fullbannerglossary', $id_glossario) . '</a>';
            }
          ?>
        </div>
      </div>
    </section>
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