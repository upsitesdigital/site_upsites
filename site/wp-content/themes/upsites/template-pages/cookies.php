<?php
/*
Template Name: Cookies
*/
get_header();

?>
  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <section class="slideFull video-hero blue">
      <div class="container">
        <div class="grid">
          <div class="text">
            <h1 class="tag">
              <b><?= get_field('subtitle_herocookies') ?></b>
            </h1>
            <h2><?= get_field('title_herocookies') ?></h2>
            <p><?= get_field('text_herocookies') ?></p>
            <?php 
              if(get_field('textbtn_herocookies')) {
                echo '<a rel="nofollow" href="' . get_field('linkbtn_herocookies') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('textbtn_herocookies') . '</a>';
              }
            ?>
          </div>
          <div class="box-video">
            <div class="video">
              <video width="auto" height="100%" loop autoplay playsinline muted>
                <source src="<?= get_field('video_herocookies') ?>" type="video/mp4">
              </video>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end:slideFull -->

    <div class="clients ptop-0 pbottom-50 blue">
      <div class="container relative">
        <div class="clientSlide border-bottom">
        <?php if( have_rows('clients_list') ): 
          while( have_rows('clients_list') ): the_row();
            echo '<div class="item white">' . wp_get_attachment_image(get_sub_field('logo'), 'logos-thumb', '', array( "loading" => "lazy" )) . '</div>';
          endwhile;
        endif; ?>
        </div>
      </div>
    </div>

    <!-- howToWork -->
    <section class="howToWork blue">
      <div class="container relative">
        <?php 
          if(get_field('subtitle_howToWorkcookies')) {
            echo '<h3 class="title">' . get_field('subtitle_howToWorkcookies') . '</h3>';
          }
          if(get_field('title_howToWorkcookies')) {
            echo '<h2 class="pbottom-10">' . get_field('title_howToWorkcookies') . '</h2>';
          }
          if(get_field('text_howToWorkcookies')) {
            echo '<p>' . get_field('text_howToWorkcookies') . '</p>';
          }
          if( have_rows('boxs_howToWorkcookies') ):
            $cont = 1;
            echo '<div class="grid">';
            while ( have_rows('boxs_howToWorkcookies') ) : the_row();
              if(get_sub_field('icon')) {
                $image = '<div class="icons">' . wp_get_attachment_image(get_sub_field('icon'), 'full') . '</div>';
              } else {
                $image = '<div class="icons"><svg class="icon clearFill"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#screen"></use></svg></div>';
              }
              echo '<div class="item white cols-0' . $cont . '" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.' . $cont . 's">' . $image . '
                <h3>' . get_sub_field('title') . '</h3>
                <p>' . get_sub_field('text') . '</p>
              </div>';
              $cont++;
            endwhile;
            echo '</div>';
          endif;
        ?>
      </div>
    </section>
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
                echo '<h2 class="pbottom-30">' . get_field('titulo_func') . '</h2>';
              }
              
              if(get_field('texto_func2')) {
                echo '<p>' . get_field('texto_func2') . '</p>';
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
                    <p><span class="white">' . get_sub_field('texto') . '</span></p>
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
    <section class="createToEcommerce">
      <div class="container">
        <h3 class="subtitle"><?= get_field('subtitletabs_cookies') ?></h3>
        <h2><?= get_field('titletabs_cookies') ?></h2>
        <?php 
        if( have_rows('tabs_cookies') ):
          echo '<div id="link-tabs" class="tabs">';
          $count = 1;
          while ( have_rows('tabs_cookies') ) : the_row();
            $class = $count == 1 ? 'act icon' : 'icon' ;
            echo '<a href="#" class="' . $class . '" data-tab="tabs-' . $count . '">
            <div class="icons">' . wp_get_attachment_image(get_sub_field('icontab'), 'full', '', array( "loading" => "lazy" )) . '</div>
            <span>' . get_sub_field('titletab') . '</span>
          </a>';
          $count++;
          endwhile;
          echo '</div>';
        endif;

        if( have_rows('tabs_cookies') ):
          echo '<div id="content-tabs" class="content">';
          $countc = 1;
          while ( have_rows('tabs_cookies') ) : the_row();
            $class = $countc == 1 ? 'act' : '' ;
            $btn = get_sub_field('linkbtn') ? '<a href="' . get_sub_field('linkbtn') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_sub_field('textbtn') . '</a>' : '';
            echo '<div id="tabs-' . $countc . '" class="grid reverse right ' . $class . '">
            <div class="image">' . wp_get_attachment_image(get_sub_field('image'), 'full', '', array( "loading" => "lazy" )) . '</div>
            <div class="text">
              <h3>' . get_sub_field('titlecont') . '</h3>
              ' . get_sub_field('text') . '
              ' . $btn . '
            </div>
          </div>';
          $countc++;
          endwhile;
          echo '</div>';
        endif;
        ?>
      </div>
    </section>
    <!-- end:createToEcommerce -->

    <!-- faq -->
    <?php $args = array(
      'type' => 'cookies',
      'title' => 'AVISO DE COOKIES E ADEQUAÇÃO À LGPD',
    );
    get_template_part( 'template-parts/inc','faqs', $args ); ?>
    <!-- end:faq -->

    <!-- price-box -->
    <section id="precos" class="price-box">
      <div class="container">
        <span class="subtitle"><?= get_field('subtitle_pricebox') ?></span>
        <h2 class="title"><?= get_field('title_pricebox') ?></h2>
        <p><?= get_field('texto_pricebox') ?></p>
        <div class="grid">
        <?php 
        $count = 1;
        if( have_rows('plan_pricebox') ):
          while ( have_rows('plan_pricebox') ) : the_row();
          $class = $count == 1 ? 'monthly-plan' : 'annual-plan' ;
          ?>
          <div class="item <?= $class ?>">
            <div class="box">
              <div class="icons">
                <svg class="icon">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#screen"></use>
                </svg>
              </div>
              <h3><?= get_sub_field('title') ?></h3>
              <hr>
              <?php if(get_sub_field('text_support')) {
                echo '<div class="price ptop-0 pbottom-0">' . get_sub_field('price') . '</div><p class="small">' . get_sub_field('text_support') . '</p>';
              } else {
                echo '<div class="price">' . get_sub_field('price') . '</div>';
              } ?>
              <hr>
              <?php if(get_sub_field('textbtn')) { ?>
                <a rel="nofollow" href="#" class="btnBudgets open-modal-cookies">
                  <svg class="icon">
                    <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use>
                  </svg> <?= get_sub_field('textbtn') ?>
                </a>
              <?php } ?>
              <ul>
              <?php 
              if( have_rows('items') ):
                $cont = 0;
                while ( have_rows('items') ) : the_row();
                  $class = $cont >= 3 ? 'hidemobile' : 'showmobile' ;
                ?>
                <li class="<?= $class ?>">
                  <div class="before">
                    <svg class="icon">
                      <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#check"></use>
                    </svg>
                  </div>
                  <?= get_sub_field('texto') ?>
                </li>
                <?php 
                $cont++;
                endwhile;
              endif;
              ?>
              </ul>
              <a href="#" class="see-more">Ver mais <i class="fa fa-angle-down" aria-hidden="true"></i></a>
            </div>
          </div>
          <?php 
          $count++;
          endwhile;
        endif;
        ?>
        </div>
      </div>
    </section>
    <!-- end:price-box -->

    <!-- hero-image -->
    <section class="hero-image blue">
      <div class="container">
        <div class="grid">
          <div class="text">
            <div class="tag">
              <span class="subtitle"><?= get_field('subtitle_heroimage') ?></span>
            </div>
            <h2 class="title"><?= get_field('title_heroimage') ?></h2>
            <p><?= get_field('text_heroimage') ?></p>
            <?php 
              if(get_field('linkbtn_heroimage')) {
                echo '<a href="' . get_field('linkbtn_heroimage') . '" class="btnBudgets">
                  <svg class="icon">
                    <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use>
                  </svg> ' . get_field('textbtn_heroimage') . '
                </a>';
              }
            ?>
            
          </div>
          <div class="image">
            <?php 
              if(get_field('image_heroimage')) {
                echo wp_get_attachment_image(get_field('image_heroimage'), 'full');
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    <!-- end:hero-image -->

    <div class="modal-cookies">
      <div class="content">
        <div class="header">
          <h2>Adeque seu site à LGPD!</h2>
          <p>Envie seus dados no formulário que vamos entrar em contato</p>
          <a href="#" class="close">
            <svg class="icon">
              <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg?v=4#close"></use>
            </svg>
          </a>
        </div>
        <div class="body">
          <div class="form">
            <?= do_shortcode('[contact-form-7 id="029b823" title="Formulário cookies"]') ?>
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- end:main -->

<?php get_footer(); ?>




