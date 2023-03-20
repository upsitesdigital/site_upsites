<?php
/*
Template Name: Loja
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

    <!-- functions -->
    <?php if(get_field('desativar_seccao_func') !== 'inativo') { ?>
    <section class="functions">
      <div class="container">
      <hr>
        <div class="grid pbottom-30">
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

    <!-- createToEcommerce -->
    <?php if(get_field('desativar_seccao_tab') !== 'inativo') { ?>
    <section class="createToEcommerce">
      <div class="container">
        <?php 
          if(get_field('titulo_tab')) {
            echo '<h2>' . get_field('titulo_tab') . '</h2>';
          }
        ?>
        <div id="link-tabs" class="tabs">
          <a href="#" data-tab="ecommerce-01" class="act">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ecommerce-01"></use>
              </svg>
            </div>
            <span>Desenvolvido para <br>vendas online</span>
          </a>
          <a href="#" data-tab="ecommerce-02">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ecommerce-02"></use>
              </svg>
            </div>
            <span>Integração com meios <br>de pagamento digital</span>
          </a>
          <a href="#" data-tab="ecommerce-03">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ecommerce-03"></use>
              </svg>
            </div>
            <span>O melhor serviço <br>ao consumidor</span>
          </a>
          <a href="#" data-tab="ecommerce-04">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ecommerce-04"></use>
              </svg>
            </div>
            <span>Lojas Virtuais de <br>Produtos por Assinatura</span>
          </a>
          <a href="#" data-tab="ecommerce-05">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ecommerce-05"></use>
              </svg>
            </div>
            <span>Loja virtual otimizada <br>para o Google</span>
          </a>
        </div>
        <div id="content-tabs" class="content">
          <div id="ecommerce-01" class="grid act">
            <div class="image">
              <?php 
                if(get_field('imagem_tab01')) {
                  echo wp_get_attachment_image(get_field('imagem_tab01'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_tab01')) {
                  echo '<h3>' . get_field('titulo_tab01') . '</h3>';
                }
                if(get_field('texto_tab01')) {
                  echo get_field('texto_tab01');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-02" class="grid">
          <div class="image">
              <?php 
                if(get_field('imagem_tab02')) {
                  echo wp_get_attachment_image(get_field('imagem_tab02'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_tab02')) {
                  echo '<h3>' . get_field('titulo_tab02') . '</h3>';
                }
                if(get_field('texto_tab02')) {
                  echo get_field('texto_tab02');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-03" class="grid">
            <div class="image">
              <?php 
                if(get_field('imagem_tab03')) {
                  echo wp_get_attachment_image(get_field('imagem_tab03'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_tab03')) {
                  echo '<h3>' . get_field('titulo_tab03') . '</h3>';
                }
                if(get_field('texto_tab03')) {
                  echo get_field('texto_tab03');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-04" class="grid">
            <div class="image">
              <?php 
                if(get_field('imagem_tab04')) {
                  echo wp_get_attachment_image(get_field('imagem_tab04'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_tab04')) {
                  echo '<h3>' . get_field('titulo_tab04') . '</h3>';
                }
                if(get_field('texto_tab04')) {
                  echo get_field('texto_tab04');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-05" class="grid">
            <div class="image">
              <?php 
                if(get_field('imagem_tab05')) {
                  echo wp_get_attachment_image(get_field('imagem_tab05'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_tab05')) {
                  echo '<h3>' . get_field('titulo_tab05') . '</h3>';
                }
                if(get_field('texto_tab05')) {
                  echo get_field('texto_tab05');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:createToEcommerce -->

    <!-- paymentMethod -->
    <?php if(get_field('desativar_seccao_paymentmethod') !== 'inativo') { ?>
    <section class="paymentMethod">
      <div class="container">
        <div class="grid">
          <div class="image">
            <?php 
              if(get_field('imagem_paymentmethod')) {
                echo wp_get_attachment_image(get_field('imagem_paymentmethod'), 'full');
              }
            ?>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_paymentmethod')) {
                echo '<span>' . get_field('subtitulo_paymentmethod') . '</span>';
              }
              if(get_field('titulo_paymentmethod')) {
                echo '<h2>' . get_field('titulo_paymentmethod') . '</h2>';
              }
              if(get_field('texto_paymentmethod')) {
                echo '<p>' . get_field('texto_paymentmethod') . '</p>';
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:paymentMethod -->

    <!-- clients -->
    <?php get_template_part( 'template-parts/inc','clients' ); ?>
    <!-- end:clients -->

    <!-- price -->
    <?php if(get_field('desativar_seccao_fastwebsiteshop') !== 'inativo') { ?>
    <section class="priceAndOptions">
      <div class="container">
        <div class="grid ptop-100 pbottom-55">
          <div class="box">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#cart"></use>
              </svg>
            </div>
            <?php 
              if( have_rows('Preço_fastwebsiteshop') ):
                while ( have_rows('Preço_fastwebsiteshop') ) : the_row();
                  echo '<h3>' . get_sub_field('titulo') . '</h3>
                  <p>' . get_sub_field('texto') . '</p>
                  <hr>
                  <div class="budget">' . get_sub_field('preco') . '</div>
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
              if( have_rows('Preço_fastwebsiteshop') ):
                while ( have_rows('Preço_fastwebsiteshop') ) : the_row();
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

    <!-- functions -->
    <?php if(get_field('desativar_seccao_fastwebsiteshop') !== 'inativo') { ?>
    <section class="functions">
      <div class="container">
        <div class="grid gridSmall">
          <div class="image">
            <div class="box">
              <?php 
                if(get_field('imagem_fastwebsiteshop')) {
                  echo '<div class="image">' . wp_get_attachment_image(get_field('imagem_fastwebsiteshop'), 'full') . '</div>';
                }
                if(get_field('texto_fastwebsiteshop')) {
                  echo '<h3>' . get_field('texto_fastwebsiteshop') . '</h3>';
                }
                if(get_field('texto_botao_fastwebsiteshop')) {
                  echo '<a href="' . get_field('link_botao_fastwebsiteshop') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_fastwebsiteshop') . '</a>';
                }
              ?>
            </div>
          </div>
          <div class="text ptop-65">
            <?php 
              if(get_field('subtitulo_fastwebsiteshop')) {
                echo '<span>' . get_field('subtitulo_fastwebsiteshop') . '</span>';
              }
              if(get_field('titulo_fastwebsiteshop')) {
                echo '<h2 class="pbottom-5">' . get_field('titulo_fastwebsiteshop') . '</h2>';
              }
            ?>
            <?php
              if( have_rows('lista_fastwebsiteshop') ):
                echo '<ul>';
                while ( have_rows('lista_fastwebsiteshop') ) : the_row();
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

    <!-- faq -->
    <?php $args = array(
      'type' => 'loja',
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




