<?php
/*
Template Name: SEO
*/
get_header();
?>
  <!-- main -->
  <main>
    <!-- slideFull -->
    <?php if(get_field('desativar_seccao_toppage') !== 'inativo') { ?>
    <section class="slideFull">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_toppage')) {
                echo '<div class="tag noBox"><b>' . get_field('subtitulo_toppage') . '</b></div>';
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
    <?php if(get_field('desativar_seccao_howtowork4') !== 'inativo') { ?>
    <section class="howToWork big">
      <div class="container relative">
        <?php 
          if(get_field('subtitulo_howtowork4')) {
            echo '<span>' . get_field('subtitulo_howtowork4') . '</span>';
          }
          if(get_field('titulo_howtowork4')) {
            echo '<h2>' . get_field('titulo_howtowork4') . '</h2>';
          }
          if( have_rows('box_howtowork4') ):
            $cont = 1;
            echo '<div class="grid fourCols">';
            while ( have_rows('box_howtowork4') ) : the_row();
              if(get_sub_field('icone')) {
                $image = '<div class="icons">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
              } else {
                $image = '<div class="icons"><svg class="icon clearFill"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#screen"></use></svg></div>';
              }
              echo '<div class="item cols-0' . $cont . ' pbottom-20">' . $image . '
                <h3>' . get_sub_field('titulo') . '</h3>
                <p><b>' . get_sub_field('texto') . '</b></p>
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

    <!-- dados -->
    <?php if(get_field('desativar_seccao_dados') !== 'inativo') { ?>
    <section class="dados">
      <div class="container">
        <?php
          if( have_rows('itens_dados') ):
            echo '<div class="grid fourCols">';
            while ( have_rows('itens_dados') ) : the_row();
              echo '<div class="item">
                <h2><strong>' . get_sub_field('numero') . '</strong> ' . get_sub_field('titulo') . '</h2>
                <p>' . get_sub_field('texto') . '</p>
              </div>';
            endwhile;
            echo '</div>';
          endif;
        ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:dados -->

    <!-- functions -->
    <?php if(get_field('desativar_seccao_func2') !== 'inativo') { ?>
    <section class="functions">
      <div class="container">
        <div class="grid pbottom">
          <div class="image">
            <div class="box">
              <?php
                if(get_field('imagem_func2')) {
                  echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_func2'), 'full') . '</div>';
                }
                if(get_field('texto2_func2')) {
                  echo '<h3>' . get_field('texto2_func2') . '</h3>';
                }
                if(get_field('texto_botao_func2')) {
                  echo '<a href="' . get_field('link_botao_func2') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_func2') . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_func2')) {
                echo '<span>' . get_field('subtitulo_func2') . '</span>';
              }
              if(get_field('titulo_func2')) {
                echo '<h2 class="small">' . get_field('titulo_func2') . '</h2>';
              }
              if(get_field('texto_func2')) {
                echo '<p>' . get_field('texto_func2') . '</p>';
              }
            ?>
            <?php
              if( have_rows('funcionalidades_func2') ):
                echo '<ul>';
                while ( have_rows('funcionalidades_func2') ) : the_row();
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

    <!-- functions -->
    <?php if(get_field('desativar_seccao_conseo') !== 'inativo') { ?>
    <section class="functions white left ptop-30 smallp">
      <div class="container">
        <div class="grid">
          <div class="image big">
            <div class="box">
              <?php
                if(get_field('imagem_conseo')) {
                  echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_conseo'), 'full') . '</div>';
                }
                if(get_field('texto2_conseo')) {
                  echo '<h3>' . get_field('texto2_conseo') . '</h3>';
                }
                if(get_field('texto_botao_conseo')) {
                  echo '<a href="' . get_field('link_botao_conseo') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_conseo') . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_conseo')) {
                echo '<span>' . get_field('subtitulo_conseo') . '</span>';
              }
              if(get_field('titulo_conseo')) {
                echo '<h2 class="small">' . get_field('titulo_conseo') . '</h2>';
              }
              if(get_field('texto_conseo')) {
                echo '<p>' . get_field('texto_conseo') . '</p>';
              }
            ?>
            <?php
              if( have_rows('funcionalidades_conseo') ):
                echo '<ul class="green small">';
                while ( have_rows('funcionalidades_conseo') ) : the_row();
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

    <!-- clients -->
    <?php get_template_part( 'template-parts/inc','clients' ); ?>
    <!-- end:clients -->
    
    <?php if(get_field('desativar_seccao_slide') !== 'inativo') { ?>
    <div class="slide-grafics">
      <div class="container-small">
        <div class="box-slide">
          <?php
            if( have_rows('imagens_slide') ):
              while ( have_rows('imagens_slide') ) : the_row();
                echo '<div class="item">';
                  echo wp_get_attachment_image(get_sub_field('imagem'), 'full');
                  echo '<div class="text">'.get_sub_field('titulo').'</div>';
                echo '</div>';
              endwhile;
            endif;
          ?>
        </div>
        <a href="#" class="prev">
          <svg class="icon">
            <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrow"></use>
          </svg>
        </a>
        <a href="#" class="next">
          <svg class="icon">
            <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrow"></use>
          </svg>
        </a>
      </div>
      <div class="box-dots"></div>
    </div>
    <?php } ?>

    <!-- functions -->
    <?php if(get_field('desativar_seccao_otimseo') !== 'inativo') { ?>
    <section class="functions ptop">
      <div class="container">
        <div class="grid">
          <div class="image">
            <div class="box">
              <?php
                if(get_field('imagem_otimseo')) {
                  echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_otimseo'), 'full') . '</div>';
                }
                if(get_field('texto2_otimseo')) {
                  echo '<h3>' . get_field('texto2_otimseo') . '</h3>';
                }
                if(get_field('texto_botao_otimseo')) {
                  echo '<a href="' . get_field('link_botao_otimseo') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_otimseo') . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_otimseo')) {
                echo '<span>' . get_field('subtitulo_otimseo') . '</span>';
              }
              if(get_field('titulo_otimseo')) {
                echo '<h2>' . get_field('titulo_otimseo') . '</h2>';
              }
              if(get_field('texto_otimseo')) {
                echo '<p class="small">' . get_field('texto_otimseo') . '</p>';
              }
            ?>
            <?php
              if( have_rows('funcionalidades_otimseo') ):
                echo '<ul>';
                while ( have_rows('funcionalidades_otimseo') ) : the_row();
                  if(get_sub_field('icone')) {
                    $image = '<div class="icons">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
                  } else {
                    $image = '<div class="icons"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#responsive"></use></svg></div>';
                  }
                  $class = get_sub_field('item_pequeno') == 1 ? ' class="small"' : '' ;
                  echo '<li '. $class . '>' . $image . '
                    <h3>' . get_sub_field('titulo') . '</h3>
                    <p>' . get_sub_field('texto') . '</p>
                  </li>';
                endwhile;
                echo '</ul>';
              endif;
            ?>
          </div>
        </div>

        <div class="recovery-penalties">
          <?php 
            if(get_field('titulo_recpen')) {
              echo '<h2>' . get_field('titulo_recpen') . '</h2>';
            }
            if(get_field('texto_recpen')) {
              echo '<p>' . get_field('texto_recpen') . '</p>';
            }
          ?>

          <a href="#" class="prev">
            <svg class="icon">
              <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrow"></use>
            </svg>
          </a>
          <a href="#" class="next">
            <svg class="icon">
              <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrow"></use>
            </svg>
          </a>
          <?php
            if( have_rows('box_slide_recpen') ):
              echo '<div class="recovery-penalties-slide">';
              while ( have_rows('box_slide_recpen') ) : the_row();
                echo '<div class="item">
                  <div class="icons">
                    <svg class="icon clearFill">
                      <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#check"></use>
                    </svg>
                  </div>
                  <p class="mtop-10">' . get_sub_field('texto') . '</p>
                </div>';
              endwhile;
              echo '</div>';
            endif;
          ?>
          <?php 
            if(get_field('texto_abaixo_dos_box_recpen')) {
              echo '<p>' . get_field('texto_abaixo_dos_box_recpen') . '</p>';
            }
          ?>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:functions -->

    <!-- faq -->
    <?php 
    $args = array(
      'type' => 'seo',
    );
    get_template_part( 'template-parts/inc','faqs', $args ); ?>
    <!-- end:faq -->

    <!-- formRequestQuote -->
    <?php if(get_field('desativar_seccao_requestquote') !== 'inativo') { ?>
    <section id="contato" class="formRequestQuote">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_requestquote')) {
                echo '<span>' . get_field('subtitulo_requestquote') . '</span>';
              }
              if(get_field('titulo_requestquote')) {
                echo '<h2>' . get_field('titulo_requestquote') . '</h2>';
              }
              if(get_field('texto_requestquote')) {
                echo '<p>' . get_field('texto_requestquote') . '</p>';
              }
              if(get_field('imagem_requestquote')) {
                echo wp_get_attachment_image(get_field('imagem_requestquote'), 'full');
              }
            ?>
          </div>
          <div class="form">
            <?= do_shortcode(get_field('formulario_requestquote')) ?>
          </div>
        </div>

      </div>
    </section>
    <?php } ?>
    <!-- end:formRequestQuote -->

  </main>
  <!-- end:main -->
<?php get_footer(); ?>




