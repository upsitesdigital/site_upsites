<?php
/*
Template Name: Home
*/
get_header();
?>

  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <?php if(get_field('desativar_seccao_tophome') !== 'inativo') { ?>
      <?php 
      $bg = '';
        if(get_field('imagem_tophome')) {
          $bg = 'background-image: url(' . wp_get_attachment_image_url(get_field('imagem_tophome'), 'full') . ');';
        }
      ?>
      <section class="slideFull text-center relative" style="<?= $bg ?>">
        <div class="container">
          <div class="grid">
            <div class="text">
              <?php 
                if(get_field('subtitulo_tophome')) {
                  echo '<div class="tag noBox flex small"><b>' . get_field('subtitulo_tophome') . '</b> 
                    <span class="google">4.9 
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
                  echo '<h2 class="title">' . get_field('titulo_tophome') . '</h2>';
                }
                if(get_field('texto_tophome')) {
                  echo '<p class="">' . get_field('texto_tophome') . '</p>';
                }
                if(get_field('texto_botao_tophome')) {
                  echo '<a rel="dofollow" href="' . get_field('link_botao_tophome') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tophome') . '</a>';
                }
                if(get_field('texto_botao_veja_mais_tophome')) {
                  $anchor = strpos(get_field('link_botao_veja_mais_tophome'), '#') === false ? 'more' : 'more anchor' ;
                  echo '<a rel="dofollow" href="' . get_field('link_botao_veja_mais_tophome') . '" class="'.$anchor.'"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrow"></use></svg> ' . get_field('texto_botao_veja_mais_tophome') . '</a>';
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
            while ($slideposts->have_posts()) : $slideposts->the_post();
              echo '<div class="item">' . wp_get_attachment_image(get_field('imagem_clients'), 'full') . '</div>';
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
      </div>
    </div>

    <!-- portfolio -->
    


    <?php if(get_field('desativar_seccao_porthome') !== 'inativo') { ?>
    <section id="portfolio" class="portfolioListHome" >
      <div class="container">
        <div class="title">
          <div class="item">
            <?php 
              if(get_field('subtitulo_porthome')) {
                echo '<span data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('subtitulo_porthome') . '</span>';
              }
              if(get_field('titulo_porthome')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_porthome') . '</h2>';
              }
              if(get_field('texto_apoio_porthome')) {
                echo '<div class="tag" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('texto_apoio_porthome') . '</div>';
              }
            ?>
          </div>
          <div class="item">
          <a rel="dofollow" href="<?= get_permalink( get_page_by_path( 'portfolio' ) ) ?>" class="seeMore" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">
            <svg class="icon">
              <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
            </svg> VER TODOS
          </a>
          </div>
        </div>
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
        ?>
        <div class="featured">
          <div class="slide">
            <?php
              while ($postcat->have_posts()) : $postcat->the_post();
                get_template_part('template-parts/posts/content', 'portifolio-slide');
              endwhile;
              wp_reset_postdata();
            ?>
          </div>
          <div class="pagSlide" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">
            <button class="slick-prev slick-arrow" aria-label="Previous" type="button">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
              </svg>
            </button>
            <div class="pagingInfo"></div>
            <button class="slick-next slick-arrow" aria-label="Next" type="button">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
              </svg>
            </button>
          </div>
        </div>
        <?php } ?>
        <div class="grid">
          <?php
            $postargs = array(
              'post_type' 						 => 'portifolios',
              'posts_per_page'         => 3,
              'post_status'            => 'publish',
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
              get_template_part('template-parts/posts/content', 'portifolio');
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

    <!-- howToWork -->
    <?php if(get_field('desativar_seccao_howtowork') !== 'inativo') { ?>
    <section id="como-funciona" class="howToWork top-big">
      <div class="container relative">
        <?php 
          if(get_field('subtitulo_howtowork')) {
            echo '<h1 class="title">' . get_field('subtitulo_howtowork') . '</h1>';
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
              echo '<div class="item cols-0' . $cont . '" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.'.$cont.'s">' . $image . '
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
    
    <!-- clients -->
    <?php
      $args = array(
        'clientSlide' => 'false',
      ); 
      get_template_part( 'template-parts/inc','clients', $args ); ?>
    <!-- end:clients -->

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
                  echo '<a data-scroll-reveal="enter bottom move 50px over 0.6s after 0s" rel="dofollow" href="' . get_field('link_botao_func') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_func') . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_func')) {
                echo '<span data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('subtitulo_func') . '</span>';
              }
              if(get_field('titulo_func')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">' . get_field('titulo_func') . '</h2>';
              }
              
              if( have_rows('funcionalidades_func') ):
                echo '<ul>';
                while ( have_rows('funcionalidades_func') ) : the_row();
                  if(get_sub_field('icone')) {
                    $image = '<div class="icons">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
                  } else {
                    $image = '<div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#responsive"></use></svg></div>';
                  }
                  echo '<li data-scroll-reveal="enter right move 50px over 0.6s after 0s">' . $image . '
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
                  echo '<a rel="dofollow" href="' . get_field('link_fotos_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#photo"></use></svg></div> Fotos</a>';
                } else {
                  echo '<div class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#photo"></use></svg></div> Fotos</div>';
                } 
                if(get_field('link_videos_fullcontrol')) {
                  echo '<a rel="dofollow" href="' . get_field('link_videos_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#video"></use></svg></div> Videos</a>';
                } else {
                  echo '<div class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#video"></use></svg></div> Videos</div>';
                }
                if(get_field('link_texto_fullcontrol')) {
                  echo '<a rel="dofollow" href="' . get_field('link_texto_fullcontrol') . '" class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#text"></use></svg></div> Textos</a>';
                } else {
                  echo '<div class="item"><div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#text"></use></svg></div> Textos</div>';
                }
              ?>
            </div>
            <?php
            if(get_field('texto_botao_fullcontrol')) {
                echo '<a rel="dofollow" href="' . get_field('link_botao_fullcontrol') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_fullcontrol') . '</a>';
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
                echo '<a rel="dofollow" href="' . get_field('link_botao_dontjustwebsite') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_dontjustwebsite') . '</a>';
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

    <!-- faq -->
    <?php $args = array(
      'type' => 'home',
    );
    get_template_part( 'template-parts/inc','faqs', $args ); ?>
    <!-- end:faq -->

    <!-- hireProfessionWebsite -->
    <?php get_template_part( 'template-parts/inc','prices' ); ?>
    <!-- end:hireProfessionWebsite -->

    <!-- professionalWebsites -->
    <?php if(get_field('desativar_seccao_sitespro') !== 'inativo') { ?>
    <section class="professionalWebsites hide-mobile">
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

    <!-- featuredArticles -->
    <?php get_template_part( 'template-parts/inc','articles' ); ?>
    <!-- end:featuredArticles -->

  </main>
  <!-- end:main -->

<?php get_footer(); ?>




