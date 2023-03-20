<?php
/*
Template Name: Home
*/
get_header();
?>

  <!-- main -->
  <main>
    <!-- slideFull -->
    <?php if(get_field('desativar_seccao_tophome') !== 'inativo') { ?>
      <section class="slideFull">
        <div class="container">
          <div class="grid">
            <div class="text">
              <?php 
                if(get_field('subtitulo_tophome')) {
                  echo '<div class="tag flex"><b>' . get_field('subtitulo_tophome') . '</b> 
                    <span class="google">4.8 
                    <img class="star" src="' . get_template_directory_uri() . '/assets/img/full-star.svg" />
                    <img class="star" src="' . get_template_directory_uri() . '/assets/img/full-star.svg" />
                    <img class="star" src="' . get_template_directory_uri() . '/assets/img/full-star.svg" />
                    <img class="star" src="' . get_template_directory_uri() . '/assets/img/full-star.svg" />
                    <img class="star" src="' . get_template_directory_uri() . '/assets/img/half-star.svg" />
                    <img src="' . get_template_directory_uri() . '/assets/img/google.svg" />
                    </span>
                  </div>';
                }
                if(get_field('titulo_tophome')) {
                  echo '<h1>' . get_field('titulo_tophome') . '</h1>';
                }
                if(get_field('texto_tophome')) {
                  echo '<p>' . get_field('texto_tophome') . '</p>';
                }
                if(get_field('texto_botao_tophome')) {
                  echo '<a href="' . get_field('link_botao_tophome') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tophome') . '</a>';
                }
                if(get_field('texto_botao_veja_mais_tophome')) {
                  $anchor = strpos(get_field('link_botao_veja_mais_tophome'), '#') === false ? 'more' : 'more anchor' ;
                  echo '<a href="' . get_field('link_botao_veja_mais_tophome') . '" class="'.$anchor.'"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrow"></use></svg> ' . get_field('texto_botao_veja_mais_tophome') . '</a>';
                }
              ?>
            </div>
            <div class="image">
              <?php 
                if(get_field('imagem_tophome')) {
                  echo wp_get_attachment_image(get_field('imagem_tophome'), 'full');
                }
              ?>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>
    <!-- end:slideFull -->

    <!-- howToWork -->
    <?php if(get_field('desativar_seccao_howtowork') !== 'inativo') { ?>
    <section id="como-funciona" class="howToWork">
      <div class="container relative">
        <?php 
          if(get_field('subtitulo_howtowork')) {
            echo '<span>' . get_field('subtitulo_howtowork') . '</span>';
          }
          if(get_field('titulo_howtowork')) {
            echo '<h2>' . get_field('titulo_howtowork') . '</h2>';
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
              echo '<div class="item cols-0' . $cont . '">' . $image . '
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

    <!-- functions -->
    <?php if(get_field('desativar_seccao_func') !== 'inativo') { ?>
    <section class="functions">
      <div class="container">
        <div class="grid">
          <div class="image">
            <div class="box">
              <?php 
                if(get_field('imagem_func')) {
                  echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_func'), 'full') . '</div>';
                }
                if(get_field('texto_func')) {
                  echo '<h3>' . get_field('texto_func') . '</h3>';
                }
                if(get_field('texto_botao_func')) {
                  echo '<a href="' . get_field('link_botao_func') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_func') . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_func')) {
                echo '<span>' . get_field('subtitulo_func') . '</span>';
              }
              if(get_field('titulo_func')) {
                echo '<h2>' . get_field('titulo_func') . '</h2>';
              }
              
              if( have_rows('funcionalidades_func') ):
                echo '<ul>';
                while ( have_rows('funcionalidades_func') ) : the_row();
                  if(get_sub_field('icone')) {
                    $image = '<div class="icons">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
                  } else {
                    $image = '<div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#responsive"></use></svg></div>';
                  }
                  echo '<li>' . $image . '
                    <h3>' . get_sub_field('titulo') . '</h3>
                    <p>' . get_sub_field('texto') . '</p>
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

    <!-- fullControl -->
    <?php if(get_field('desativar_seccao_fullcontrol') !== 'inativo') { ?>
    <section class="fullControl">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_fullcontrol')) {
                echo '<span>' . get_field('subtitulo_fullcontrol') . '</span>';
              }
              if(get_field('titulo_fullcontrol')) {
                echo '<h2>' . get_field('titulo_fullcontrol') . '</h2>';
              }
              if(get_field('texto_fullcontrol')) {
                echo get_field('texto_fullcontrol');
              }
            ?>
            <div class="items">
              <?php 
                if(get_field('link_fotos_fullcontrol')) {
                  echo '<a href="' . get_field('link_fotos_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#photo"></use></svg></div> Fotos</a>';
                } else {
                  echo '<div class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#photo"></use></svg></div> Fotos</div>';
                } 
                if(get_field('link_videos_fullcontrol')) {
                  echo '<a href="' . get_field('link_videos_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#video"></use></svg></div> Videos</a>';
                } else {
                  echo '<div class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#video"></use></svg></div> Videos</div>';
                }
                if(get_field('link_texto_fullcontrol')) {
                  echo '<a href="' . get_field('link_texto_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#text"></use></svg></div> Textos</a>';
                } else {
                  echo '<div class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#text"></use></svg></div> Textos</div>';
                }
              ?>
            </div>
            <?php
            if(get_field('texto_botao_fullcontrol')) {
                echo '<a href="' . get_field('link_botao_fullcontrol') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_fullcontrol') . '</a>';
              }
            ?>
          </div>
          <div class="image">
            <?php 
              if(get_field('imagem_fullcontrol')) {
                echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_fullcontrol'), 'full') . '</div>';
              }
              if(get_field('subtexto_fullcontrol')) {
                echo '<div class="box"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#star"></use></svg></div><p>' . get_field('subtexto_fullcontrol') . '</p></div>';
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:fullControl -->

    <!-- clients -->
    <?php get_template_part( 'template-parts/inc','clients' ); ?>
    <!-- end:clients -->

    <!-- portfolio -->
    <?php if(get_field('desativar_seccao_porthome') !== 'inativo') { ?>
    <section class="portfolioListHome">
      <div class="container">
        <?php 
          if(get_field('subtitulo_porthome')) {
            echo '<span>' . get_field('subtitulo_porthome') . '</span>';
          }
          if(get_field('titulo_porthome')) {
            echo '<h2>' . get_field('titulo_porthome') . '</h2>';
          }
          if(get_field('texto_porthome')) {
            echo '<p>' . get_field('texto_porthome') . '</p>';
          }
        ?>
        <div class="links">
          <?php 
            if(get_field('texto_apoio_porthome')) {
              echo '<div class="tag">' . get_field('texto_apoio_porthome') . '</div>';
            }
          ?>
          <a href="<?= get_permalink( get_page_by_path( 'portifolios' ) ) ?>" class="seeMore">
            <svg class="icon">
              <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
            </svg> VEJA MAIS
          </a>
        </div>
        <div class="grid">
          <?php
            $postargs = array(
              'post_type' 						 => 'portifolios',
              'posts_per_page'         => 3,
              'post_status'            => 'publish',
              'no_found_rows'          => true,
              'update_post_term_cache' => false,
              'update_post_meta_cache' => false,
              'cache_results'          => false
            );
            $postcat = new WP_Query($postargs);
            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'portifolio');
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:portfolio -->

    <!-- professionalWebsites -->
    <?php if(get_field('desativar_seccao_sitespro') !== 'inativo') { ?>
    <section class="professionalWebsites">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_sitespro')) {
                echo '<span>' . get_field('subtitulo_sitespro') . '</span>';
              }
              if(get_field('titulo_sitespro')) {
                echo '<h2>' . get_field('titulo_sitespro') . '</h2>';
              }
              if(get_field('texto_sitespro')) {
                echo get_field('texto_sitespro');
              }
              if(get_field('texto_melhor_parte_sitespro')) {
                echo '<div class="items">
                  <div class="item">
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
                echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_sitespro'), 'full') . '</div>';
              }
              if(get_field('texto_agilidade_modernidade_e_utilidade_sitespro')) {
                echo '<div class="box">
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

    <!-- dontJustWebsite -->
    <?php if(get_field('desativar_seccao_dontjustwebsite') !== 'inativo') { ?>
    <section class="dontJustWebsite">
      <div class="before"><img src="<?= get_template_directory_uri() ?>/assets/img/imageDontJustWebsite.svg" alt=""></div>
      <div class="container relative" style="overflow: hidden;">
        <div class="moon"><img src="<?= get_template_directory_uri() ?>/assets/img/moon.svg" alt=""></div>
        <div class="grid">
          <div class="left">
            <?php 
              if(get_field('titulo_lateral_dontjustwebsite')) {
                echo '<h3>' . get_field('titulo_lateral_dontjustwebsite') . '</h3>';
              }
              if(get_field('texto_botao_dontjustwebsite')) {
                echo '<a href="' . get_field('link_botao_dontjustwebsite') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_dontjustwebsite') . '</a>';
              }
              if(get_field('texto_dontjustwebsite')) {
                echo get_field('texto_dontjustwebsite');
              }
            ?>
          </div>
          <div class="right">
            <?php 
              if(get_field('subtitulo_dontjustwebsite')) {
                echo '<span>' . get_field('subtitulo_dontjustwebsite') . '</span>';
              }
              if(get_field('titulo_dontjustwebsite')) {
                echo '<h2>' . get_field('titulo_dontjustwebsite') . '</h2>';
              }
              if( have_rows('lista_dontjustwebsite') ):
                echo '<ul>';
                while ( have_rows('lista_dontjustwebsite') ) : the_row();
                  echo '<li>' . get_sub_field('item') . '</li>';
                endwhile;
                echo '</ul>';
              endif;
            ?>
          </div>
        </div>
      </div>
      <div class="container relative">
        <div class="after"><img src="<?= get_template_directory_uri() ?>/assets/img/imageDontJustWebsiteafter.svg" alt=""></div>
      </div>
    </section>
    <?php } ?>
    <!-- end:dontJustWebsite -->

    <!-- hireProfessionWebsite -->
    <?php get_template_part( 'template-parts/inc','prices' ); ?>
    <!-- end:hireProfessionWebsite -->

    <!-- faq -->
    <?php $args = array(
      'type' => 'home',
    );
    get_template_part( 'template-parts/inc','faqs', $args ); ?>
    <!-- end:faq -->

    <!-- featuredArticles -->
    <?php get_template_part( 'template-parts/inc','articles' ); ?>
    <!-- end:featuredArticles -->

  </main>
  <!-- end:main -->

<?php get_footer(); ?>




