<?php
/*
Template Name: Home new
*/
get_header();
?>

  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <?php if(get_field('disable_section_timeabout') !== 'inativo') { ?>
      <?php 
        $bg = '';
        if(get_field('imagem_tophome')) {
          $bg = 'background-image: url(' . wp_get_attachment_image_url(get_field('imagem_tophome'), 'full') . ');';
        }
        /*$bgmobile = '';
        if(get_field('imagem_tophome3')) {
          $bgmobile = 'background: url(' . wp_get_attachment_image_url(get_field('imagem_tophome3'), 'full') . ') center bottom no-repeat, url(' . wp_get_attachment_image_url(get_field('imagem_tophome4'), 'full') . ') bottom center no-repeat;';
        }*/
        $astronauta = '';
        if(get_field('imagem_tophome2')) {
          $astronauta = '<div class="bg2 parallax" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.7s" style="background-image: url(' . wp_get_attachment_image_url(get_field('imagem_tophome2'), 'full') . ');"></div>';
        }
      ?>
      <section class="slideFull text-center relative" data-scroll-reveal="enter bottom move 0px over 0.6s after 0s">
        <div class="bgdesk" style="<?= $bg ?>"></div>
        <!-- div class="bgmobile" style="<?= $bgmobile ?>"></div -->
        <div class="container relative">
          <?= $astronauta ?>
          <div class="grid">
            <div class="text">
              <?php 
                if(get_field('subtitulo_tophome')) {
                  echo '<div class="tag noBox flex small" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><b>' . get_field('subtitulo_tophome') . '</b> 
                    <span class="google">4.9 
                    <img src="' . get_template_directory_uri() . '/assets/img/criacao-sites-melhor-empresa.svg" alt="google" width="100px" height="22px" />
                    </span>
                  </div>';
                }
                if(get_field('titulo_tophome')) {
                  echo '<h2 class="title" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_tophome') . '</h2>';
                }
                if(get_field('texto_tophome')) {
                  echo '<p class="" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_tophome') . '</p>';
                }
                if(get_field('form_tophome')) {
                  echo '<div class="form" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s">' . do_shortcode(get_field('form_tophome')) . '</div>';
                }
                if(get_field('texto_botao_tophome')) {
                  echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s"><a rel="nofollow" target="_blank" href="' . get_field('link_botao_tophome') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tophome') . '</a></div>';
                }
                if(get_field('texto_botao_veja_mais_tophome')) {
                  $anchor = strpos(get_field('link_botao_veja_mais_tophome'), '#') === false ? 'more' : 'more anchor' ;
                  echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s" rel="dofollow" href="' . get_field('link_botao_veja_mais_tophome') . '" class="'.$anchor.'"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrow"></use></svg> ' . get_field('texto_botao_veja_mais_tophome') . '</a>';
                }
              ?>
            </div>
            <div class="image">
              <?php 
                if(get_field('imagem_tophome')) {
                  echo wp_get_attachment_image(get_field('imagem_tophome'), 'full');
                }
              ?>
              <div class="box">
                <div class="box-icon">
                  <svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#screen"></use></svg>
                </div>
                <?php 
                  if(get_field('texto_box')) {
                    echo get_field('texto_box');
                  }
                ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>
    <!-- end:slideFull -->

    <div class="clients ptop-0 pbottom-0">
      <div class="container relative">
        <div class="clientSlide pbottom-0">
          <?php
            $slideargs = array(
              'post_type' 						 => 'clients',
              'post_status'            => 'publish',
              'posts_per_page'         => '15',
              'no_found_rows'          => true,
              'update_post_term_cache' => false,
              'update_post_meta_cache' => false,
              'cache_results'          => false
            );
            $slideposts = new WP_Query($slideargs);
            $count = 1;
            while ($slideposts->have_posts()) : $slideposts->the_post();
              echo '<div class="item gray" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.'.$count.'s">' . wp_get_attachment_image(get_field('imagem_clients'), 'logos-thumb', '', array( "loading" => "lazy" )) . '</div>';
              $count++;
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>

    <!-- howToWork -->
    <?php if(get_field('desativar_seccao_howtowork') !== 'inativo') { ?>
    <section id="como-funciona" class="howToWork ptop-100">
      <div class="container relative">
        <?php 
          if(get_field('subtitulo_howtowork')) {
            echo '<h3 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" class="title">' . get_field('subtitulo_howtowork') . '</h3>';
          }
          if(get_field('titulo_howtowork')) {
            echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_howtowork') . '</h2>';
          }
          if( have_rows('box_howtowork') ):
            $cont = 1;
            echo '<div class="grid">';
            while ( have_rows('box_howtowork') ) : the_row();
              if(get_sub_field('icone')) {
                $image = '<div class="icons">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
              } else {
                $image = '<div class="icons"><svg class="icon clearFill"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#screen"></use></svg></div>';
              }
              echo '<div class="item cols-0' . $cont . '" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.' . $cont . 's">' . $image . '
                <h3>' . get_sub_field('titulo') . '</h3>
                <p>' . get_sub_field('texto') . '</p>
              </div>';
              $cont++;
            endwhile;
            echo '</div>';
          endif;
        ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:howToWork -->

    <!-- portfolio -->
    <?php if(get_field('desativar_seccao_porthome') !== 'inativo') { ?>
    <section class="portfoliolistnew">
      <div class="container">
        <?php 
          if(get_field('subtitulo_porthome')) {
            echo '<span class="subtitle">' . get_field('subtitulo_porthome') . '</span>';
          }
          if(get_field('titulo_porthome')) {
            echo '<h2 class="title">' . get_field('titulo_porthome') . '</h2>';
          }
          if(get_field('texto_apoio_porthome')) {
            echo '<p>' . get_field('texto_apoio_porthome') . '</p>';
          }
        ?>
        <div class="box-slidepag" style="position: relative;">
        <?php
          $postargs = array(
            'post_type' 						 => 'portifolios',
            'posts_per_page'         => 6,
            'post_status'            => 'publish',
            'meta_key'      				 => 'destacar_port',
            'meta_value'    				 => '1',
            'no_found_rows'          => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'cache_results'          => false
          );
          $postcat = new WP_Query($postargs);
          if($postcat->have_posts()) {
            echo '<div class="box-slider">';
        ?>
          <?php while ($postcat->have_posts()) : $postcat->the_post(); ?>
            <div class="item">
              <div class="image">
                <?= wp_get_attachment_image(get_field('mocap_port'), 'full', '', array( "loading" => "lazy" )) ?>
                <a rel="nofollow" target="_blank" href="<?php the_field('link_portifolio') ?>"><img src="<?= get_template_directory_uri() ?>/assets/img/btn-portifolio.png" alt=""></a>
              </div>
              <div class="text">
                <div class="item">
                  <h3><?php the_title() ?></h3>
                  <span class="tag"><?php the_field('subtitulo_portifolio') ?></span>
                  <?php
                    if(get_the_excerpt()) {
                      echo '<p>' . get_the_excerpt() . '</p>';
                    }
                  ?>
                </div>
                <div class="btn-box">
                  <a rel="nofollow" target="_blank" href="<?php the_field('link_portifolio') ?>" class="seeMore">
                    veja online - <b><?php 
                    $remove = array("https:", "http:", "/", "www.");
                    echo str_replace($remove, "", get_field('link_portifolio'));
                    ?></b>
                  </a>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        <?php 
            echo '</div>';
          } 
        ?>
          <div id="btns-slider">
            <a href="#" class="prev">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
              </svg>
            </a>
            <div class="pags"><span class="current">01</span>  •  <span class="total">04</span></div>
            <a href="#" class="next">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </section>
    <section id="portfolio" class="portfolioListHome" style="padding-top: 0;">
      <div class="container">
        <div class="grid">
          <?php
            $postargs = array(
              'post_type' 						 => 'portifolios',
              'posts_per_page'         => 3,
              'post_status'            => 'publish',
              'meta_key'               => 'destacar_port',
              'meta_value'             => '0',
              'no_found_rows'          => true,
              'update_post_term_cache' => false,
              'update_post_meta_cache' => false,
              'cache_results'          => false,
              'tax_query' => array(
                array(
                  'taxonomy' => 'segmentos_portifolios',
                  'field' => 'slug',
                  'terms' => 'site-sob-medida'
                )
              )
            );
            $postcat = new WP_Query($postargs);
            while ($postcat->have_posts()) : $postcat->the_post();
              $args = array(
                'current_post' => $postcat->current_post,
              );
              get_template_part('template-parts/posts/content', 'portifolio', $args);
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
        <div class="center" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">
          <a rel="dofollow" href="<?= get_permalink( get_page_by_path( 'portfolio' ) ) ?>" class="btnBudgets"><svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use></svg> Ver todo o portfólio</a>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:portfolio -->

    <!-- functions -->
    <?php if(get_field('desativar_seccao_func') !== 'inativo') { ?>
    <section class="functions">
      <div class="container">
        <div class="grid">
          <div class="image">
            <div class="box">
              <?php 
                if(get_field('imagem_func')) {
                  echo '<div class="image" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . wp_get_attachment_image(get_field('imagem_func'), 'full') . '</div>';
                }
                if(get_field('texto_func')) {
                  echo '<h3 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('texto_func') . '</h3>';
                }
                if(get_field('texto_botao_func')) {
                  echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" rel="nofollow" target="'.get_field('target_type_func').'" href="' . get_field('link_botao_func') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_func') . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_func')) {
                echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('subtitulo_func') . '</h3>';
              }
              if(get_field('titulo_func')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_func') . '</h2>';
              }
              
              if( have_rows('funcionalidades_func') ):
                echo '<ul>';
                while ( have_rows('funcionalidades_func') ) : the_row();
                  if(get_sub_field('icone')) {
                    $image = '<div class="icons" data-scroll-reveal="enter right move 50px over 0.6s after 0s">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
                  } else {
                    $image = '<div class="icons" data-scroll-reveal="enter right move 50px over 0.6s after 0s"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#responsive"></use></svg></div>';
                  }
                  echo '<li>' . $image . '
                    <h3 data-scroll-reveal="enter right move 50px over 0.6s after 0.1s">' . get_sub_field('titulo') . '</h3>
                    <p data-scroll-reveal="enter right move 50px over 0.6s after 0.2s"><span class="txtopen">' . mb_strimwidth(get_sub_field('texto'), 0, 120, "...") . '<br><span class="text-underline">Leia mais</span></span><span class="txtclose">' . get_sub_field('texto') . '<br><span class="text-underline">Leia menos</span></span></p>
                  </li>';
                endwhile;
                echo '</ul>';
              endif;
            ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:functions -->

    <section class="agency">
      <div class="container">
        <span class="subtitle">AGÊNCIA DE CRIAÇÃO DE SITES</span>
        <h2 class="title">Connheça os tipos de site</h2>
      </div>
    </section>

    <!-- fullControl -->
    <?php if(get_field('desativar_seccao_fullcontrol') !== 'inativo') { ?>
    <section class="fullControl">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_fullcontrol')) {
                echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('subtitulo_fullcontrol') . '</h3>';
              }
              if(get_field('titulo_fullcontrol')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_fullcontrol') . '</h2>';
              }
              if(get_field('texto_fullcontrol')) {
                echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('texto_fullcontrol') . '</div>';
              }
            ?>
            <div class="items">
              <?php 
                if(get_field('link_fotos_fullcontrol')) {
                  echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" rel="dofollow" href="' . get_field('link_fotos_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#photo"></use></svg></div> Fotos</a>';
                } else {
                  echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#photo"></use></svg></div> Fotos</div>';
                } 
                if(get_field('link_videos_fullcontrol')) {
                  echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" rel="dofollow" href="' . get_field('link_videos_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#video"></use></svg></div> Videos</a>';
                } else {
                  echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#video"></use></svg></div> Videos</div>';
                }
                if(get_field('link_texto_fullcontrol')) {
                  echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" rel="dofollow" href="' . get_field('link_texto_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#text"></use></svg></div> Textos</a>';
                } else {
                  echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#text"></use></svg></div> Textos</div>';
                }
              ?>
            </div>
            <?php
            if(get_field('texto_botao_fullcontrol')) {
                echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" rel="nofollow" target="'.get_field('target_type_fullcontrol').'" href="' . get_field('link_botao_fullcontrol') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_fullcontrol') . '</a>';
              }
            ?>
          </div>
          <div class="image">
            <?php 
              if(get_field('imagem_fullcontrol')) {
                echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" class="image">' . wp_get_attachment_image(get_field('imagem_fullcontrol'), 'full') . '</div>';
              }
              if(get_field('subtexto_fullcontrol')) {
                echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" class="box"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#star"></use></svg></div><p>' . get_field('subtexto_fullcontrol') . '</p></div>';
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:fullControl -->

    <!-- clients -->
    <?php
      $args = array(
        'clientSlide' => 'false',
      ); 
      get_template_part( 'template-parts/inc','clients', $args ); ?>
    <!-- end:clients -->

    <!-- dontJustWebsite -->
    <?php if(get_field('desativar_seccao_dontjustwebsite') !== 'inativo') { ?>
    <section class="dontJustWebsite hide-mobile">
      <div class="before" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s"><img src="<?= get_template_directory_uri() ?>/assets/img/imageDontJustWebsite.svg" alt=""></div>
      <div class="container relative" style="overflow: hidden;">
        <div class="moon" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s"><img src="<?= get_template_directory_uri() ?>/assets/img/moon.svg" alt=""></div>
        <div class="grid">
          <div class="left">
            <?php 
              if(get_field('titulo_lateral_dontjustwebsite')) {
                echo '<h3 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_lateral_dontjustwebsite') . '</h3>';
              }
              if(get_field('texto_dontjustwebsite')) {
                echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('texto_dontjustwebsite') . '</div>';
              }
            ?>
          </div>
          <div class="right">
            <?php 
              if(get_field('subtitulo_dontjustwebsite')) {
                echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('subtitulo_dontjustwebsite') . '</h3>';
              }
              if(get_field('titulo_dontjustwebsite')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_dontjustwebsite') . '</h2>';
              }
              if( have_rows('lista_dontjustwebsite') ):
                echo '<ul>';
                $count = 1;
                while ( have_rows('lista_dontjustwebsite') ) : the_row();
                  echo '<li data-scroll-reveal="enter bottom move 50px over 0.6s after 0.'.$count.'s">' . get_sub_field('item') . '</li>';
                  $count++;
                endwhile;
                echo '</ul>';
              endif;
              
              if(get_field('texto_botao_dontjustwebsite')) {
                echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" rel="dofollow" href="' . get_field('link_botao_dontjustwebsite') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_dontjustwebsite') . '</a>';
              }
            ?>
          </div>
        </div>
      </div>
      <div class="container relative">
        <div class="after" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s"><img src="<?= get_template_directory_uri() ?>/assets/img/imageDontJustWebsiteafter.svg" alt=""></div>
      </div>
    </section>
    <?php } ?>
    <!-- end:dontJustWebsite -->

    <!-- faq -->
    <?php 
    $cat_faqs = get_field('cat_faqs') == '' ? 'home-new' : get_field('cat_faqs') ;
    $args = array(
      'type' => $cat_faqs,
    );
    get_template_part( 'template-parts/inc','faqs', $args ); ?>
    <!-- end:faq -->

    <!-- hireProfessionWebsite -->
    <?php $args = array(
      'type' => 'two-cols',
      'id' => get_the_ID(),
    );
    get_template_part( 'template-parts/inc','prices', $args ); ?>
    <!-- end:hireProfessionWebsite -->

    <!-- professionalWebsites -->
    <?php if(get_field('desativar_seccao_sitespro') !== 'inativo') { ?>
    <section class="professionalWebsites hide-mobile">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_sitespro')) {
                echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('subtitulo_sitespro') . '</h3>';
              }
              if(get_field('titulo_sitespro')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_sitespro') . '</h2>';
              }
              if(get_field('texto_sitespro')) {
                echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('texto_sitespro') . '</div>';
              }
              if(get_field('texto_melhor_parte_sitespro')) {
                echo '<div class="items">
                  <div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">
                    <div class="icons">
                      <svg class="icon">
                        <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#money"></use>
                      </svg>
                    </div>
                    <p>' . get_field('texto_melhor_parte_sitespro') . '</p>
                  </div>
                </div>';
              }
            ?>
          </div>
          <div class="image">
            <?php 
              if(get_field('imagem_sitespro')) {
                echo '<div class="image" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . wp_get_attachment_image(get_field('imagem_sitespro'), 'full') . '</div>';
              }
              if(get_field('texto_agilidade_modernidade_e_utilidade_sitespro')) {
                echo '<div class="box" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                  <div class="icons">
                    <svg class="icon">
                      <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#time"></use>
                    </svg>
                  </div>
                  <p>' . get_field('texto_agilidade_modernidade_e_utilidade_sitespro') . '</p>
                </div>';
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:professionalWebsites -->

    <!-- other-pages -->
    <?php if(get_field('desativar_seccao_landing') !== 'inativo') { ?>
    <?php get_template_part( 'template-parts/inc','other-pages' ); ?>
    <?php } ?>
    <!-- end:other-pages -->

    <!-- featuredArticles -->
    <?php get_template_part( 'template-parts/inc','articles' ); ?>
    <!-- end:featuredArticles -->
    
    <div class="hidden"><?= do_shortcode('[rank_math_rich_snippet id="s-91a29f0b-37f9-438a-9f3b-9673ee53639b"]'); ?></div>
  </main>
  <!-- end:main -->

<?php get_footer(); ?>


