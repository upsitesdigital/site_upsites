<?php
/*
Template Name: Site por assinatura
*/
get_header();
?>
  <!-- main -->
  <main>
    <!-- slideFull -->
    <?php if(get_field('desativar_seccao_toppage') !== 'inativo') { ?>
    <section class="slideFull blue">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_toppage')) {
                echo '<div class="tag"><b>' . get_field('subtitulo_toppage') . '</b></div>';
              }
              if(get_field('titulo_toppage')) {
                echo '<h1>' . get_field('titulo_toppage') . '</h1>';
              }
              if(get_field('texto_toppage')) {
                echo '<p>' . get_field('texto_toppage') . '</p>';
              }
              if(get_field('texto_botao_toppage')) {
                echo '<a href="' . get_field('link_botao_toppage') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_toppage') . '</a>';
              }
            ?>
          </div>
          <div class="image">
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
            echo '<span>' . get_field('subtitulo_howtoworkblue') . '</span>';
          }
          if(get_field('titulo_howtoworkblue')) {
            echo '<h2>' . get_field('titulo_howtoworkblue') . '</h2>';
          }
          if(get_field('texto_howtoworkblue')) {
            echo '<p>' . get_field('texto_howtoworkblue') . '</p>';
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
    <!-- end:howtowork -->

    <!-- functions -->
    <?php if(get_field('desativar_seccao_websitesup') !== 'inativo') { ?>
    <section class="functions left">
      <div class="container">
        <div class="grid">
          <div class="image">
            <div class="box">
              <div class="image">
                <?php 
                  if(get_field('imagem_websitesup')) {
                    echo wp_get_attachment_image(get_field('imagem_websitesup'), 'full');
                  }
                ?>
              </div>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_websitesup')) {
                echo '<span>' . get_field('subtitulo_websitesup') . '</span>';
              }
              if(get_field('titulo_websitesup')) {
                echo '<h2>' . get_field('titulo_websitesup') . '</h2>';
              }
            ?>
            <?php
              if( have_rows('lista_websitesup') ):
                echo '<ul class="green">';
                while ( have_rows('lista_websitesup') ) : the_row();
                  if(get_sub_field('icone')) {
                    $image = '<div class="icons">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
                  } else {
                    $image = '<div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#seo"></use></svg></div>';
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

    <!-- howToWork -->
    <?php if(get_field('desativar_seccao_websitesup') !== 'inativo') { ?>
    <section class="howToWork top">
      <div class="container relative">
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
    <section id="funcionalidades" class="functions white posMenu">
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

    <!-- portfolio -->
    <?php if(get_field('desativar_seccao_templates') !== 'inativo') { ?>
    <section id="portfolio" class="portfolio">
      <div class="container">
        <?php 
          if(get_field('subtitulo_templates')) {
            echo '<span>' . get_field('subtitulo_templates') . '</span>';
          }
          if(get_field('titulo_templates')) {
            echo '<h2>' . get_field('titulo_templates') . '</h2>';
          }
          if(get_field('texto_templates')) {
            echo '<p>' . get_field('texto_templates') . '</p>';
          }
        ?>
        <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $postargs = array(
            'post_type' 						 => 'templates',
            'posts_per_page'         => 6,
            'paged' 								 => $paged,
            'post_status'            => 'publish',
          );
          $postcat = new WP_Query($postargs);
          $maxpages = $postcat->max_num_pages;
        ?>
        <div class="links">
          <a class="act load-more-categories" data-target="posts-templates" data-maxpages="<?= $maxpages; ?>" data-currentPage="1" data-cat="Todos" data-type="templates" data-tax="categories_templates" href="#">Todos</a>
          <?php 
            $terms = get_terms( 'categories_templates' );
            if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
              foreach ( $terms as $term ) {
                $maxpagescat = ceil($term->count / 6);
              echo '<a class="load-more-categories" id="load-more-links" href="#" data-target="posts-templates" data-maxpages="' . $maxpagescat . '" data-currentPage="1" data-type="templates" data-tax="categories_templates" data-cat="' . $term->slug . '">' . $term->name . '</a>';
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
        <div class="align-center">
          <?php if($maxpages != $paged) { ?>
            <a href="#" class="seeMore load-more-categories" id="load-more-button" data-target="posts-templates" data-maxpages="<?= $maxpages; ?>" data-currentPage="<?= $paged; ?>" data-cat="Todos" data-type="templates" data-tax="categories_templates">
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


    <!-- advancedFeatures -->
    <?php if(get_field('desativar_seccao_advfeat') !== 'inativo') { ?>
    <section class="advancedFeatures">
      <div class="container">
        <?php 
          if(get_field('subtitulo_advfeat')) {
            echo '<span>' . get_field('subtitulo_advfeat') . '</span>';
          }
          if(get_field('titulo_advfeat')) {
            echo '<h2>' . get_field('titulo_advfeat') . '</h2>';
          }
          if(get_field('texto_advfeat')) {
            echo '<p>' . get_field('texto_advfeat') . '</p>';
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
              echo '<div class="item">' . $image . '
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

    <!-- clients -->
    <?php get_template_part( 'template-parts/inc','clients' ); ?>
    <!-- end:clients -->

    <!-- price -->
    <?php if(get_field('desativar_seccao_fastwebsite') !== 'inativo') { ?>
    <section class="priceAndOptions">
      <div class="container">
        <div class="grid">
          <div class="box">
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
                  <a href="' . get_sub_field('link_botao') . '" class="btnBudgets">
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
                      echo '<li>
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
                echo '<span>' . get_field('subtitulo_fastwebsite') . '</span>';
              }
              if(get_field('titulo_fastwebsite')) {
                echo '<h2>' . get_field('titulo_fastwebsite') . '</h2>';
              }
            ?>
            <div class="items">
              <div class="item bright">
                <?php 
                  if(get_field('numero_modelos_fastwebsite')) {
                    echo '<b>' . get_field('numero_modelos_fastwebsite') . '+</b>';
                  }
                  if(get_field('texto_modelos_fastwebsite')) {
                    echo '<p>' . get_field('texto_modelos_fastwebsite') . '</p>';
                  }
                ?>
              </div>
              <div class="item">
                <?php 
                  if(get_field('numero_site_fastwebsite')) {
                    echo '<b>' . get_field('numero_site_fastwebsite') . '+</b>';
                  }
                  if(get_field('texto_site_fastwebsite')) {
                    echo '<p>' . get_field('texto_site_fastwebsite') . '</p>';
                  }
                ?>
              </div>
              <div class="item bleft">
                <?php 
                  if(get_field('numero_experiencia_fastwebsite')) {
                    echo '<b>' . get_field('numero_experiencia_fastwebsite') . '+</b>';
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




