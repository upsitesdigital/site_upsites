<?php
/*
Template Name: Site por assinatura
Template Post Type: services, page
*/
get_header();
$id_home = get_page_by_path( 'home' );
?>
  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <?php if(get_field('desativar_seccao_toppage') !== 'inativo') { ?>
    <section class="slideFull blue">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_toppage')) {
                echo '<div class="tag" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><h1>' . get_field('subtitulo_toppage') . '</h1></div>';
              }
              if(get_field('titulo_toppage')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_toppage') . '</h2>';
              }
              if(get_field('texto_toppage')) {
                echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_toppage') . '</p>';
              }
              if(get_field('texto_botao_toppage')) {
                echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s"><a rel="dofollow" href="' . get_field('link_botao_toppage') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_toppage') . '</a></div>';
              }
            ?>
          </div>
          <div class="image" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.7s">
            <?php 
              if(get_field('imagem_toppage')) {
                echo wp_get_attachment_image(get_field('imagem_toppage'), 'full');
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:slideFull -->

    <!-- howToWork -->
    <?php if(get_field('desativar_seccao_howtoworkblue') !== 'inativo') { ?>
    <section id="comofunciona" class="howToWork blue posMenu">
      <div class="container relative">
        <?php 
          if(get_field('subtitulo_howtoworkblue')) {
            echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('subtitulo_howtoworkblue') . '</h3>';
          }
          if(get_field('titulo_howtoworkblue')) {
            echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_howtoworkblue') . '</h2>';
          }
          if(get_field('texto_howtoworkblue')) {
            echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_howtoworkblue') . '</p>';
          }
          if( have_rows('box_howtoworkblue') ):
            $cont = 1;
            echo '<div class="grid">';
            while ( have_rows('box_howtoworkblue') ) : the_row();
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
        <?php
          if(get_field('texto_botao_toppage')) {
            echo '<center><div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s"><a rel="dofollow" href="' . get_field('link_botao_toppage') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_toppage') . '</a></div></center>';
          }
        ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:howtowork -->

    <!-- portfolio -->
    <?php if(get_field('desativar_seccao_templates') !== 'inativo') { ?>
    <section id="modelo" class="portfolio">
      <div class="container">
        <?php 
          if(get_field('subtitulo_templates')) {
            echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('subtitulo_templates') . '</h3>';
          }
          if(get_field('titulo_templates')) {
            echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_templates') . '</h2>';
          }
          if(get_field('texto_templates')) {
            echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_templates') . '</p>';
          }
        ?>
        <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $postargs = array(
            'post_type' 						 => 'templates',
            'posts_per_page'         => 9,
            'paged' 								 => $paged,
            'post_status'            => 'publish',
          );
          $postcat = new WP_Query($postargs);
          $maxpages = $postcat->max_num_pages;
        ?>
        <div class="links" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
          <a rel="dofollow" class="act load-more-categories" data-target="posts-templates" data-maxpages="<?= $maxpages; ?>" data-currentPage="1" data-cat="Todos" data-type="templates" data-tax="categories_templates" href="#">Todos</a>
          <?php 
            $terms = get_terms( 'categories_templates' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
              foreach ( $terms as $term ) {
                $maxpagescat = ceil($term->count / 9);
                if ($term->name == 'Populares') {
                  echo '<a rel="dofollow" class="load-more-categories star" id="load-more-links" href="#" data-target="posts-templates" data-maxpages="' . $maxpagescat . '" data-currentPage="1" data-type="templates" data-tax="categories_templates" data-cat="' . $term->slug . '"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#star-port"></use></svg>' . $term->name . '</a>';
                }
              }
            }
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
              foreach ( $terms as $term ) {
                $maxpagescat = ceil($term->count / 9);
                if ($term->name != 'Populares') {
                  echo '<a rel="dofollow" class="load-more-categories" id="load-more-links" href="#" data-target="posts-templates" data-maxpages="' . $maxpagescat . '" data-currentPage="1" data-type="templates" data-tax="categories_templates" data-cat="' . $term->slug . '">' . $term->name . '</a>';
                }
              }
            }
          ?>
        </div>
        <div id="posts-templates" class="grid">
          <?php
            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'template');
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
        <div class="align-center" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
          <?php if($maxpages != $paged) { ?>
            <a rel="dofollow" href="#" class="seeMore load-more-categories" id="load-more-button" data-target="posts-templates" data-maxpages="<?= $maxpages; ?>" data-currentPage="<?= $paged; ?>" data-cat="Todos" data-type="templates" data-tax="categories_templates">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrow"></use>
              </svg> Carregar mais
            </a>
          <?php } ?>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:portfolio -->

    

    <!-- howToWork -->
    <?php if(get_field('desativar_seccao_websitesup') !== 'inativo') { ?>
    <section class="howToWork top-big">
      <div class="container relative">
        <?php 
          if(get_field('subtitulo_websitesup')) {
            echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('subtitulo_websitesup') . '</h3>';
          }
          if(get_field('titulo_websitesup')) {
            echo '<h2 class="pbottom" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_websitesup') . '</h2>';
          }
          if(get_field('texto_websitesup')) {
            echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_websitesup') . '</div>';
          }
        ?>
        <?php
          if( have_rows('box_websitesup') ):
            $cont = 1;
            echo '<div class="grid">';
            while ( have_rows('box_websitesup') ) : the_row();
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
        <?php
          if(get_field('texto_botao_toppage')) {
            echo '<center><div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s"><a rel="dofollow" href="' . get_field('link_botao_toppage') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_toppage') . '</a></div></center>';
          }
        ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:howToWork -->

    <!-- functions -->
    <?php if(get_field('desativar_seccao_func') !== 'inativo') { ?>
    <!-- section id="funcionalidades" class="functions white posMenu">
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
                  echo '<a rel="dofollow" href="' . get_field('link_botao_func') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_func') . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_func')) {
                echo '<h3 class="subtitle">' . get_field('subtitulo_func') . '</h3>';
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
    </section -->
    <?php } ?>
    <!-- end:functions -->

    <!-- clients -->
    <?php 
      $args = array(
        'clientSlide' => 'false',
      ); 
      get_template_part( 'template-parts/inc','clients', $args ); ?>
    <!-- end:clients -->

    <!-- portfolio -->
    <?php if(get_field('desativar_seccao_porthome') !== 'inativo') { ?>
    <section id="portfolio" class="portfolioListHome portfolio  ptop-10">
      <div class="container">
        <div class="title">
          <div class="item">
            <?php 
              if(get_field('subtitulo_porthome', $id_home)) {
                echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('subtitulo_porthome', $id_home) . '</h3>';
              }
              if(get_field('titulo_porthome', $id_home)) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('titulo_porthome', $id_home) . '</h2>';
              }
              if(get_field('texto_apoio_porthome', $id_home)) {
                echo '<div class="tag" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('texto_apoio_porthome', $id_home) . '</div>';
              }
            ?>
          </div>
          <div class="item">
          <!-- a href="<?= get_permalink( get_page_by_path( 'portifolios' ) ) ?>" class="seeMore">
            <svg class="icon">
              <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
            </svg> VER TODOS
          </a -->
          </div>
        </div>

        <?php
          $catsargs = array(
            'post_type' 						 => 'portifolios',
            'posts_per_page'         => -1,
            'post_status'            => 'publish',
            'tax_query' => array(
              array(
                  'taxonomy'  => 'segmentos_portifolios',
                  'field'     => 'slug',
                  'terms'     => 'site-assinatura'
              ),
            )
          );
          $cats = new WP_Query($catsargs);
        ?>
        <!-- div class="links mtop-40">
          <a rel="dofollow" class="act load-more-categories" data-target="posts-portifolios" data-maxpages="<?= $maxpages; ?>" data-currentPage="1" data-cat="Todos" data-type="portifolios" data-tax="categories_portifolios" data-segmentos="site-assinatura" href="#">Todos</a>
          <?php
          $catarr = array();
            while ($cats->have_posts()) : $cats->the_post();
              foreach ( get_the_terms( $cats->ID, 'categories_portifolios' ) as $term ) {
                array_push($catarr, $term->slug);
              }
            endwhile;
            foreach ( array_unique($catarr) as $slug ) {
              $term = get_term_by('slug', $slug, 'categories_portifolios');
              echo '<a rel="dofollow" class="load-more-categories" id="load-more-links" href="#" data-target="posts-portifolios" data-maxpages="1" data-currentPage="1" data-type="portifolios" data-tax="categories_portifolios" data-segmentos="site-assinatura" data-cat="' . $term->slug . '">' . $term->name . '</a>';
            }
            wp_reset_postdata();
          ?>
        </div -->
        <div id="posts-portifolios" class="grid teest">
          <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $postargs = array(
              'post_type' 						 => 'portifolios',
              'posts_per_page'         => 9,
              'paged' 								 => $paged,
              'order'                  => 'DESC',
              'post_status'            => 'publish',
              'tax_query' => array(
                array(
                    'taxonomy'  => 'segmentos_portifolios',
                    'field'     => 'slug',
                    'terms'     => 'site-assinatura'
                ),
              )
            );
            $postcat = new WP_Query($postargs);
            $maxpages = $postcat->max_num_pages;

            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'portifolio');
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
        <div class="center" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
          <?php if($maxpages != $paged) { ?>
            <a rel="dofollow" href="#" class="seeMore load-more-categories" id="load-more-button" data-target="posts-portifolios" data-maxpages="<?= $maxpages; ?>" data-currentPage="<?= $paged; ?>" data-cat="Todos" data-type="portifolios" data-tax="categories_portifolios" data-segmentos="site-assinatura">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrow"></use>
              </svg> Carregar mais
            </a>
          <?php } ?>
        </div>

        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:portfolio -->

    <!-- functions -->
    <?php if(get_field('desativar_seccao_websitesup') !== 'inativo') { ?>
    <section class="functions left">
      <div class="container">
        <div class="grid">
          <div class="image">
            <div class="box">
              <div class="image" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                <?php 
                  if(get_field('imagem_websitesup')) {
                    echo wp_get_attachment_image(get_field('imagem_websitesup'), 'full');
                  }
                ?>
                <?php
                  if(get_field('texto_botao_toppage')) {
                    echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s"><a rel="dofollow" href="' . get_field('link_botao_toppage') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_toppage') . '</a></div>';
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_websitesup')) {
                echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('subtitulo_websitesup') . '</h3>';
              }
              if(get_field('titulo_websitesup')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_websitesup') . '</h2>';
              }
            ?>
            <?php
              if( have_rows('lista_websitesup') ):
                echo '<ul class="green">';
                while ( have_rows('lista_websitesup') ) : the_row();
                  if(get_sub_field('icone')) {
                    $image = '<div class="icons" data-scroll-reveal="enter right move 50px over 0.6s after 0.2s">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
                  } else {
                    $image = '<div class="icons" data-scroll-reveal="enter right move 50px over 0.6s after 0.2s"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#seo"></use></svg></div>';
                  }
                  echo '<li>' . $image . '
                    <h3 data-scroll-reveal="enter right move 50px over 0.6s after 0.3s">' . get_sub_field('titulo') . '</h3>
                    <div data-scroll-reveal="enter right move 50px over 0.6s after 0.4s">' . get_sub_field('texto') . '</div>
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


    <!-- advancedFeatures -->
    <?php if(get_field('desativar_seccao_advfeat') !== 'inativo') { ?>
    <section class="advancedFeatures">
      <div class="container">
        <?php 
          if(get_field('subtitulo_advfeat')) {
            echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('subtitulo_advfeat') . '</h3>';
          }
          if(get_field('titulo_advfeat')) {
            echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_advfeat') . '</h2>';
          }
          if(get_field('texto_advfeat')) {
            echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_advfeat') . '</p>';
          }
        ?>
        <?php
          if( have_rows('lista_advfeat') ):
            echo '<div class="grid">';
            while ( have_rows('lista_advfeat') ) : the_row();
              if(get_sub_field('icone')) {
                $image = '<div class="icons">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
              } else {
                $image = '<div class="icons"><svg class="icon clearFill"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#screen"></use></svg></div>';
              }
              echo '<div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . $image . '
                <h3>' . get_sub_field('titulo') . '</h3>
                <p>' . get_sub_field('texto') . '</p>
              </div>';
            endwhile;
            echo '</div>';
          endif;
        ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:advancedFeatures -->

    <!-- price -->
    <?php if(get_field('desativar_seccao_fastwebsite') !== 'inativo') { ?>
    <section id="precos" class="priceAndOptions">
      <div class="container">
        <div class="grid">
          <div class="box" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#screen"></use>
              </svg>
            </div>
            <?php 
              if( have_rows('Preço_fastwebsite') ):
                while ( have_rows('Preço_fastwebsite') ) : the_row();
                  echo '<h3>' . get_sub_field('titulo') . '</h3>
                  <p>' . get_sub_field('texto') . '</p>
                  <hr>
                  <div class="price">' . get_sub_field('preco') . '</div>
                  <p class="small">' . get_sub_field('apoio') . '</p>
                  <hr>
                  <a target="_blank" rel="nofollow" href="' . get_sub_field('link_botao') . '" class="btnBudgets">
                    <svg class="icon">
                      <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use>
                    </svg> ' . get_sub_field('texto_botao') . '
                  </a>';
                endwhile;
              endif;
            ?>
          </div>
          <div class="options">
            <?php 
              if( have_rows('Preço_fastwebsite') ):
                while ( have_rows('Preço_fastwebsite') ) : the_row();
                  $num_rows = count(get_sub_field('itens'));
                  if ($num_rows % 2 != 0){
                    $num_rows--;
                  }
                  if( have_rows('itens') ):
                    echo '<ul>';
                    while ( have_rows('itens') ) : the_row();
                      echo '<li data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                        <div class="before">
                          <svg class="icon">
                            <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#check"></use>
                          </svg>
                        </div>
                        ' . get_sub_field('item') . '
                      </li>';
                      if ($num_rows/2 == get_row_index()) {echo '</ul><ul>';}
                    endwhile;
                    echo '</ul>';
                  endif;
                endwhile;
              endif;
            ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:price -->

    <!-- statistics -->
    <?php if(get_field('desativar_seccao_fastwebsite') !== 'inativo') { ?>
    <section class="statistics">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_fastwebsite')) {
                echo '<h3 class="subtitle">' . get_field('subtitulo_fastwebsite') . '</h3>';
              }
              if(get_field('titulo_fastwebsite')) {
                echo '<h2>' . get_field('titulo_fastwebsite') . '</h2>';
              }
            ?>
            <div class="items">
              <div class="item bright">
                <?php 
                  if(get_field('numero_modelos_fastwebsite')) {
                    echo '<b><i class="contagem">' . get_field('numero_modelos_fastwebsite') . '</i>+</b>';
                  }
                  if(get_field('texto_modelos_fastwebsite')) {
                    echo '<p>' . get_field('texto_modelos_fastwebsite') . '</p>';
                  }
                ?>
              </div>
              <div class="item">
                <?php 
                  if(get_field('numero_site_fastwebsite')) {
                    echo '<b><i class="contagem">' . get_field('numero_site_fastwebsite') . '</i>+</b>';
                  }
                  if(get_field('texto_site_fastwebsite')) {
                    echo '<p>' . get_field('texto_site_fastwebsite') . '</p>';
                  }
                ?>
              </div>
              <div class="item bleft">
                <?php 
                  if(get_field('numero_experiencia_fastwebsite')) {
                    echo '<b><i class="contagem">' . get_field('numero_experiencia_fastwebsite') . '</i>+</b>';
                  }
                  if(get_field('texto_experiencia_fastwebsite')) {
                    echo '<p>' . get_field('texto_experiencia_fastwebsite') . '</p>';
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="image">
            <?php 
              if(get_field('imagem_fastwebsite')) {
                echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_fastwebsite'), 'full') . '</div>';
              }
            ?>
          </div>
        </div>
        <?php
          if(get_field('texto_botao_toppage')) {
            echo '<center class="pbottom-100"><div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s"><a rel="dofollow" href="' . get_field('link_botao_toppage') . '" class="btnBudgets mtop-0"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_toppage') . '</a></div></center>';
          }
        ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:statistics -->


    <!-- featuredArticles -->
    <?php get_template_part( 'template-parts/inc','articles' ); ?>
    <!-- end:featuredArticles -->

  </main>
  <!-- end:main -->


<?php get_footer(); ?>




