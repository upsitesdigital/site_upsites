<?php
/*
Template Name: Chat
Template Post Type: services, page
*/
get_header();

?>

  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <?php if(get_field('desativar_seccao_toppage') !== 'inativo') { ?>
    <section class="slideFull mbottom-50">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_toppage')) {
                echo '<div class="tag noBox" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><h1>' . get_field('subtitulo_toppage') . '</h1></div>';
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
                  echo '<div class="image" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . wp_get_attachment_image(get_field('imagem_func'), 'full') . '</div>';
                }
                if(get_field('texto_func')) {
                  echo '<h3 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('texto_func') . '</h3>';
                }
                if(get_field('texto_botao_func')) {
                  echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s"><a rel="dofollow" href="' . get_field('link_botao_func') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_func') . '</a></div>';
                }
              ?>
            </div>
          </div>
          <div class="text">
            <?php 
              if(get_field('subtitulo_func')) {
                echo '<h3 class="subtitle" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('subtitulo_func') . '</h3>';
              }
              if(get_field('titulo_func')) {
                echo '<h2 class="pbottom-20" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_func') . '</h2>';
              }
              if(get_field('texto_func2')) {
                echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_func2') . '</p>';
              }
              
              if( have_rows('funcionalidades_func') ):
                echo '<ul>';
                while ( have_rows('funcionalidades_func') ) : the_row();
                  if(get_sub_field('icone')) {
                    $image = '<div class="icons" data-scroll-reveal="enter right move 50px over 0.6s after 0.2s">' . wp_get_attachment_image(get_sub_field('icone'), 'full') . '</div>';
                  } else {
                    $image = '<div class="icons" data-scroll-reveal="enter right move 50px over 0.6s after 0.2s"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#responsive"></use></svg></div>';
                  }
                  echo '<li>' . $image . '
                    <h3 data-scroll-reveal="enter right move 50px over 0.6s after 0.3s">' . get_sub_field('titulo') . '</h3>
                    <p data-scroll-reveal="enter right move 50px over 0.6s after 0.4s">' . get_sub_field('texto') . '</p>
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
    <?php if(get_field('desativar_seccao_chat_tab') !== 'inativo') { ?>
    <section class="createToEcommerce">
      <div class="container">
        <?php 
          if(get_field('titulo_chat_tab')) {
            echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('titulo_chat_tab') . '</h2>';
          }
          if(get_field('texto_chat_tab')) {
            echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('texto_chat_tab') . '</p>';
          }
        ?>
        <div id="link-tabs" class="tabs itens6" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
          <a rel="dofollow" href="#" data-tab="ecommerce-01" class="act">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#clinicas-hospitais"></use>
              </svg>
            </div>
            <span>Clínicas e <br>hospitais</span>
          </a>
          <a rel="dofollow" href="#" data-tab="ecommerce-02">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#beleza-bem-estar"></use>
              </svg>
            </div>
            <span>Beleza e bem-<br>estar</span>
          </a>
          <a rel="dofollow" href="#" data-tab="ecommerce-03">
            <div class="icons">
              <svg class="icon fill">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#fitness-esporte"></use>
              </svg>
            </div>
            <span>Fitness e <br>esporte</span>
          </a>
          <a rel="dofollow" href="#" data-tab="ecommerce-04">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#educacao"></use>
              </svg>
            </div>
            <span>Educação</span>
          </a>
          <a rel="dofollow" href="#" data-tab="ecommerce-05">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#suporte-cliente"></use>
              </svg>
            </div>
            <span>Suporte ao <br>cliente</span>
          </a>
          <a rel="dofollow" href="#" data-tab="ecommerce-06">
            <div class="icons">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#RH-recrutamento"></use>
              </svg>
            </div>
            <span>RH e <br>Recrutamento</span>
          </a>
        </div>
        <div id="content-tabs" class="content" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">
          <div id="ecommerce-01" class="grid right act">
            <div class="image">
              <?php 
                if(get_field('imagem_chat_tab01')) {
                  echo wp_get_attachment_image(get_field('imagem_chat_tab01'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_chat_tab01')) {
                  echo '<h3>' . get_field('titulo_chat_tab01') . '</h3>';
                }
                if(get_field('texto_chat_tab01')) {
                  echo get_field('texto_chat_tab01');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a rel="dofollow" href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-02" class="grid right">
            <div class="image">
              <?php 
                if(get_field('imagem_chat_tab02')) {
                  echo wp_get_attachment_image(get_field('imagem_chat_tab02'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_chat_tab02')) {
                  echo '<h3>' . get_field('titulo_chat_tab02') . '</h3>';
                }
                if(get_field('texto_chat_tab02')) {
                  echo get_field('texto_chat_tab02');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a rel="dofollow" href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-03" class="grid right">
            <div class="image">
              <?php 
                if(get_field('imagem_chat_tab03')) {
                  echo wp_get_attachment_image(get_field('imagem_chat_tab03'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_chat_tab03')) {
                  echo '<h3>' . get_field('titulo_chat_tab03') . '</h3>';
                }
                if(get_field('texto_chat_tab03')) {
                  echo get_field('texto_chat_tab03');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a rel="dofollow" href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-04" class="grid right">
            <div class="image">
              <?php 
                if(get_field('imagem_chat_tab04')) {
                  echo wp_get_attachment_image(get_field('imagem_chat_tab04'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_chat_tab04')) {
                  echo '<h3>' . get_field('titulo_chat_tab04') . '</h3>';
                }
                if(get_field('texto_chat_tab04')) {
                  echo get_field('texto_chat_tab04');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a rel="dofollow" href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-05" class="grid right">
            <div class="image">
              <?php 
                if(get_field('imagem_chat_tab05')) {
                  echo wp_get_attachment_image(get_field('imagem_chat_tab05'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_chat_tab05')) {
                  echo '<h3>' . get_field('titulo_chat_tab05') . '</h3>';
                }
                if(get_field('texto_chat_tab05')) {
                  echo get_field('texto_chat_tab05');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a rel="dofollow" href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
          <div id="ecommerce-06" class="grid right">
            <div class="image">
              <?php 
                if(get_field('imagem_chat_tab06')) {
                  echo wp_get_attachment_image(get_field('imagem_chat_tab06'), 'full');
                }
              ?>
            </div>
            <div class="text">
              <?php 
                if(get_field('titulo_chat_tab06')) {
                  echo '<h3>' . get_field('titulo_chat_tab06') . '</h3>';
                }
                if(get_field('texto_chat_tab06')) {
                  echo get_field('texto_chat_tab06');
                }
                if(get_field('texto_botao_tab')) {
                  echo '<a rel="dofollow" href="' . get_field('link_botao_tab') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_tab') . '</a>';
                }
              ?>
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:createToEcommerce -->

    <!-- clients -->
    <section class="clients">
      <div class="container">
        <?php 
          if(get_field('titulo_client_chat')) {
            echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">' . get_field('titulo_client_chat') . '</h2>';
          }
          if(get_field('texto_client_chat')) {
            echo '<p class="pbottom-25" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('texto_client_chat') . '</p>';
          }
        ?>
        <?php if( have_rows('logos_client_chat') ): ?>
          <div class="grid-logos">
          <?php while( have_rows('logos_client_chat') ): the_row(); 
            $image = get_sub_field('logo');
            ?>
            <div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">
              <?= wp_get_attachment_image($image, 'full'); ?>
            </div>
          <?php endwhile; ?>
          </div>
        <?php endif; ?>

        <?php if( have_rows('depoimento') ): ?>
          <div class="testimony-chat" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">
          <?php while( have_rows('depoimento') ): the_row(); 
            $image = get_sub_field('avatar');
            ?>
            <div class="box">
              <div class="person">
                <div class="avatar"><?= wp_get_attachment_image($image, 'full'); ?></div>
                <div class="info">
                  <strong><?= the_sub_field('nome'); ?></strong>
                  <span><?= the_sub_field('cargo'); ?></span>
                </div>
              </div>
              <p><?= the_sub_field('texto'); ?></p>
              <div class="blockGoogle">
                <div class="item image">
                  <div class="box-google">
                    <div class="logo"><img src="<?= get_template_directory_uri() ?>/assets/img/google2.svg"></div>
                    <div class="text">
                      <span class="text1">TOP #1 no Google</span>						<div class="google">
                        <span>4.8</span>							<img class="star" src="<?= get_template_directory_uri() ?>/assets/img/full-star.svg">
                        <img class="star" src="<?= get_template_directory_uri() ?>/assets/img/full-star.svg">
                        <img class="star" src="<?= get_template_directory_uri() ?>/assets/img/full-star.svg">
                        <img class="star" src="<?= get_template_directory_uri() ?>/assets/img/full-star.svg">
                        <img class="star" src="<?= get_template_directory_uri() ?>/assets/img/half-star.svg">
                      </div>
                      <span class="text2">80+ avaliações</span>					</div>
                  </div>
                </div>
                <div class="item">
                  <p>A UpSites é uma agência de criação de sites com clientes satisfeitos espalhados pelo Brasil inteiro.</p>				
                </div>
              </div>
            </div>
          <?php endwhile; ?>
          </div>
        <?php endif; ?>
      
      </div>
    </section>
    <!-- end:clients -->

    <!-- faq -->
    <?php 
    $args = array(
      'type' => 'chatbot',
    );
    get_template_part( 'template-parts/inc','faqs', $args ); ?>
    <!-- end:faq -->

    <!-- budget-box -->
    <section class="budget-box">
      <div class="container">
        <div class="grid">
          <div class="item">
            <div class="box">
              <div class="icons" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                <svg class="icon">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#screen"></use>
                </svg>
              </div>
              <?php 
                if(get_field('titulo_budget_box')) {
                  echo '<h3 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_budget_box') . '</h3>';
                }
                if(get_field('texto_budget_box')) {
                  echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_budget_box') . '</p>';
                }
              ?>
              <hr>
              <a data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s" rel="dofollow" href="<?php the_field('link_do_botao_budget_box') ?>" class="btnBudgets">
                <svg class="icon">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use>
                </svg> Peça um Orçamento
              </a>
              <div class="image" data-scroll-reveal="enter bottom move 0px over 0.6s after 0.6s">
                <?= wp_get_attachment_image(get_field('imagem_budget_box'), 'full'); ?>
              </div>
            </div>
          </div>
          <div class="item">
            <?php if( have_rows('lista_budget_box') ): 
              $count = 0; ?>
              <ul>
              <?php while( have_rows('lista_budget_box') ): the_row(); ?>
                <li data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?= $count ?>s">
                  <div class="before"><svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#check"></use></svg></div>
                  <?= the_sub_field('texto'); ?>
                </li>
              <?php $count++; endwhile; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <!-- end:budget-box -->

    <!-- formRequestQuote -->
    <?php if(get_field('desativar_seccao_requestquote') !== 'inativo') { ?>
    <section id="contato" class="formRequestQuote" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_requestquote')) {
                echo '<h3 class="subtitle">' . get_field('subtitulo_requestquote') . '</h3>';
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




