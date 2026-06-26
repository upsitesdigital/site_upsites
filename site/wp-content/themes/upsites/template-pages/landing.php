<?php
/*
Template Name: Landing
*/
get_header('land');
$logo_mobile    		    = get_theme_mod('US_logo_mobile');
?>
  <style>
    body::-webkit-scrollbar-thumb {
      background-color: <?= get_field('subtitulo_color') ?>;
    }
    .landing {
      background-color: <?= get_field('background_color') ?>;
    }
    .landing .btnBudgets {
      background-color: <?= get_field('botao_color') ?>;
      border: 1px solid <?= get_field('botao_color') ?>;
    }
    .landing .btnBudgets:hover {
      color: white;
      background-color: transparent;
    }
    .landing .btnBudgets:hover .icon {
      fill: white;
    }

    /* header-landing */
    .landing .header-landing .title,
    .landing .header-landing p {
      color: <?= get_field('titulo_color') ?>;
    }

    /* site-medic */
    .landing .site-medic h2,
    .landing .site-medic .grid .item h3 {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .site-medic h2 .icon {
      fill: <?= get_field('titulo_color_icon') ?>;
    }
    .landing .site-medic h1 {
      color: <?= get_field('subtitulo_color') ?>;
    }
    .landing .site-medic .grid .item {
      background-color: <?= get_field('background_color_box') ?>;
    }
    .landing .site-medic .grid .item p {
      color: <?= get_field('paragrafo_color') ?>;
    }
    .landing .site-medic .grid .item p a {
      color: <?= get_field('paragrafo_color_link') ?>;
    }
    .landing .site-medic .grid .item p a:hover {
      color: <?= get_field('paragrafo_color_link_hover') ?>;
    }

    /* deliver-results */
    .landing .deliver-results h2 {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .deliver-results ul li {
      color: <?= get_field('lista_color') ?>;
    }
    .landing .deliver-results ul li .icon {
      fill: <?= get_field('lista_color_icon') ?>;
    }

    /* land-port */
    .landing .land-port h2 {
      color: <?= get_field('subtitulo_color') ?>;
    }
    .landing .land-port h3,
    .landing .land-port p,
    .landing .land-port .grid .item h4 {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .land-port .grid .item p {
      color: <?= get_field('subtitulo_color') ?>;
    }

    /* land-client */
    .landing .land-client h2 {
      color: <?= get_field('subtitulo_color') ?>;
    }
    .landing .land-client p {
      color: <?= get_field('titulo_color') ?>;
    }

    /* pros-cons */
    .landing .pros-cons p,
    .landing .pros-cons .slide-client .item h3,
    .landing .pros-cons .grid .item h2,
    .landing .pros-cons .grid .item ul li {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .pros-cons .slide-client .item {
      background-color: <?= get_field('background_color_box') ?>;
    }
    .landing .pros-cons .slide-client .item span {
      color: <?= get_field('subtitulo_color') ?>;
    }
    .landing .pros-cons .slide-client .item p {
      color: <?= get_field('paragrafo_color') ?>;
    }

    /* box-online */
    .landing .box-online .grid .item .box {
      background-color: <?= get_field('background_color_box') ?>;
    }
    .landing .box-online .grid .item .box h3 {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .box-online .grid .item .box p {
      color: <?= get_field('paragrafo_color') ?>;
    }

    /* more-patients */
    .landing .more-patients h2 {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .more-patients form label .label {
      color: <?= get_field('form_label_color') ?>;
    }
    .landing .more-patients p {
      color: <?= get_field('paragrafo_color') ?>;
    }
    .landing .more-patients p b,
    .landing .more-patients p a {
      color: <?= get_field('paragrafo_color_link') ?>;
    }
    .landing .more-patients p a:hover {
      color: <?= get_field('paragrafo_color_link_hover') ?>;
    }
    .landing .more-patients form label input {
      background-color: <?= get_field('form_input_color_background') ?>;
      border-color: <?= get_field('form_input_color_border') ?>;
      color: <?= get_field('form_input_color') ?>;
    }

    /* land-faq */
    .landing .land-faq .grid .cols .item {
      border-color: <?= get_field('titulo_color_border') ?>;
    }
    .landing .land-faq h2,
    .landing .land-faq .grid .cols .item.open h3 {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .land-faq .grid .cols .item h3 {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .land-faq .grid .cols .item h3 .icon {
      stroke: <?= get_field('subtitulo_color') ?>;
      fill: transparent;
    }
    .landing .land-faq .grid .cols .item .box-content p {
      color: <?= get_field('paragrafo_color') ?>;
    }

    /* box-text */
    .landing .box-text h2 {
      color: <?= get_field('subtitulo_color') ?>;
    }
    .landing .box-text h3 {
      color: <?= get_field('titulo_color') ?>;
    }
    .landing .box-text p {
      color: <?= get_field('paragrafo_color') ?>;
    }
    .landing .box-text p b,
    .landing .box-text p a {
      color: <?= get_field('paragrafo_color_link') ?>;
    }


  </style>
  <div id="loader-layer">
    <?php
      if ($logo_mobile != '') {
        echo wp_get_attachment_image(attachment_url_to_postid($logo_mobile), 'full', '', array( "loading" => "lazy" ));
      }
    ?>
  </div>
  <!-- main -->
  <main id="main" class="landing">
    <div class="block-bg">
      <?php if(get_field('background_headerland')) { ?>
      <div class="bg" style="background-image: url(<?= wp_get_attachment_image_url(get_field('background_headerland'), 'full') ?>); opacity: <?= get_field('background_headerland_opacity') ?>;"></div>
      <?php } ?>

      <!-- header-landing -->
      <?php if(get_field('titulo_headerland')) { ?>
      <section class="header-landing">
        <div class="container">
          <div class="logo" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
            <a rel="dofollow" href="<?= esc_url(home_url('/')) ?>">
              <?= wp_get_attachment_image(get_field('logo_headerland'), 'full') ?>
            </a>
          </div>

          <h2 class="title" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s"><?= get_field('titulo_headerland') ?></h2>
          <p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s"><?= get_field('paragrafo_headerland') ?></p>
          <div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s"><a rel="dofollow" href="<?= get_field('link_headerbotao') ?>" class="btnBudgets"><svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use></svg> <?= get_field('texto_headerbotao') ?></a></div>
        </div>
      </section>
      <?php } ?>
      <!-- end:header-landing -->

      <!-- site-medic -->
      <?php if(get_field('titulo_sitemedic')) { ?>
      <section class="site-medic">
        <div class="container">
          <h1 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><?= get_field('subtitulo_sitemedic') ?></h1>
          <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">
            <span><?= get_field('titulo_sitemedic') ?></span>
            <svg class="icon" aria-hidden="true" viewBox="0 0 320 512" xmlns="http://www.w3.org/2000/svg"><path d="M296 160H180.6l42.6-129.8C227.2 15 215.7 0 200 0H56C44 0 33.8 8.9 32.2 20.8l-32 240C-1.7 275.2 9.5 288 24 288h118.7L96.6 482.5c-3.6 15.2 8 29.5 23.3 29.5 8.4 0 16.4-4.4 20.8-12l176-304c9.3-15.9-2.2-36-20.7-36z"></path></svg>
          </h2>
          <?php if( have_rows('itens_sitemedic') ): 
            $count = 1;?>
            <div class="grid">
            <?php while( have_rows('itens_sitemedic') ): the_row(); ?>
              <div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?=$count?>s">
                <h3><?= get_sub_field('titulo'); ?></h3>
                <?= get_sub_field('texto'); ?>
              </div>
            <?php $count++; endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
      </section>
      <?php } ?>
      <!-- end:site-medic -->
    </div>

    <!-- deliver-results -->
    <?php if(get_field('titulo_deliverresults')) { ?>
    <section class="deliver-results">
      <div class="container">
        <div class="grid">
          <div class="item">
            <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><?= get_field('titulo_deliverresults') ?></h2>
            <?php if( have_rows('itens_deliverresults') ): 
              $count = 1;?>
              <ul>
              <?php while( have_rows('itens_deliverresults') ): the_row(); ?>
                <li data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?=$count?>s"><svg aria-hidden="true" class="icon" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg>
                  <?= get_sub_field('titulo'); ?>
                </li>
              <?php $count++;endwhile; ?>
            </ul>
            <?php endif; ?>
            <div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><a rel="dofollow" href="<?= get_field('link_botao_deliverresults') ?>" class="btnBudgets"><svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use></svg> <?= get_field('texto_botao_deliverresults') ?></a></div>
          </div>
          <div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
            <?= wp_get_attachment_image(get_field('imagem_deliverresults'), 'full') ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:deliver-results -->

    <!-- land-port -->
    <section class="land-port">
      <div class="container">
        <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><?= get_field('subtitulo_landport') ?></h2>
        <h3 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s"><?= get_field('titulo_landport') ?></h3>
        <p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s"><?= get_field('texto_landport') ?></p>
        <?php $cat = get_field('categoria_landport'); ?>
        
        <?php if( have_rows('portfolios_landport') ): 
          $count = 1;?>
        <div class="grid">
          <?php while( have_rows('portfolios_landport') ): the_row(); ?>
          <div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?=$count?>s">
            <a rel="dofollow" href="<?= get_sub_field('link'); ?>" target="_blank" rel="nofollow">
              <?= wp_get_attachment_image(get_sub_field('imagem'), 'large') ?>
              <h4><?= get_sub_field('titulo'); ?></h4>
              <p><?= get_sub_field('categoria'); ?></p>
            </a>
          </div>
          <?php $count++; endwhile; ?>
        </div>
        <?php endif; ?>

        <div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><a rel="dofollow" href="<?= get_field('link_botao_landport') ?>" class="btnBudgets"><svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use></svg> <?= get_field('texto_botao_landport') ?></a></div>
      </div>
    </section>
    <!-- end:land-port -->

    <!-- land-client -->
    <?php if(get_field('titulo_landclient')) { ?>
    <section class="land-client">
      <div class="container">
        <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><?= get_field('subtitulo_landclient') ?></h2>
        <p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s"><?= get_field('titulo_landclient') ?></p>

        <?php if( have_rows('logos_landclient') ): 
          $count=1;?>
          <div class="grid">
          <?php while( have_rows('logos_landclient') ): the_row(); ?>
            <div class="item" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?=$count?>s">
              <?= wp_get_attachment_image(get_sub_field('logo'), 'full') ?>
            </div>
          <?php $count++; endwhile; ?>
        </div>
        <?php endif; ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:land-client -->

    <!-- pros-cons -->
    <section class="pros-cons">
      <div class="container">
        <div class="grid">
          <div class="item">
            <?php if( have_rows('site_tradicional_proscons') ): ?>
              <?php while( have_rows('site_tradicional_proscons') ): the_row(); ?>
                <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                  <svg class="icon" xmlns="http://www.w3.org/2000/svg" height="365pt" viewBox="0 0 365.71733 365" width="365pt"><g fill="#f44336"><path d="m356.339844 296.347656-286.613282-286.613281c-12.5-12.5-32.765624-12.5-45.246093 0l-15.105469 15.082031c-12.5 12.503906-12.5 32.769532 0 45.25l286.613281 286.613282c12.503907 12.5 32.769531 12.5 45.25 0l15.082031-15.082032c12.523438-12.480468 12.523438-32.75.019532-45.25zm0 0"></path><path d="m295.988281 9.734375-286.613281 286.613281c-12.5 12.5-12.5 32.769532 0 45.25l15.082031 15.082032c12.503907 12.5 32.769531 12.5 45.25 0l286.632813-286.59375c12.503906-12.5 12.503906-32.765626 0-45.246094l-15.082032-15.082032c-12.5-12.523437-32.765624-12.523437-45.269531-.023437zm0 0"></path></g></svg>
                  <?= get_sub_field('titulo') ?>
                </h2>

                <?php if( have_rows('itens') ): 
                  $count=1;?>
                <ul>
                  <?php while( have_rows('itens') ): the_row(); ?>
                    <li data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?=$count?>s"><svg aria-hidden="true" class="icon" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M256 8C119 8 8 119 8 256s111 248 248 248 248-111 248-248S393 8 256 8zm0 448c-110.5 0-200-89.5-200-200S145.5 56 256 56s200 89.5 200 200-89.5 200-200 200z"></path></svg>
                      <?= get_sub_field('item') ?>
                    </li>
                  <?php $count++; endwhile; ?>
                </ul>
                <?php endif; ?>
            
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <div class="item">
            <?php if( have_rows('site_upsites_proscons') ): ?>
              <?php while( have_rows('site_upsites_proscons') ): the_row(); ?>
                <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                  <svg class="icon" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><path style="fill:#A5EB78;" d="M433.139,67.108L201.294,298.953c-6.249,6.249-16.381,6.249-22.63,0L78.861,199.15L0,278.011 l150.547,150.549c10.458,10.458,24.642,16.333,39.431,16.333l0,0c14.788,0,28.973-5.876,39.43-16.333L512,145.968L433.139,67.108z"></path><g style="opacity:0.1;">	<path d="M485.921,119.888L187.59,418.22c-8.254,8.253-18.633,13.882-29.847,16.391c9.363,6.635,20.608,10.28,32.235,10.28l0,0  c14.788,0,28.973-5.876,39.43-16.333L512,145.966L485.921,119.888z"></path></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g><g></g></svg>
                  <?= get_sub_field('titulo') ?>
                </h2>

                <?php if( have_rows('itens') ): 
                  $count=1;?>
                <ul class="green">
                  <?php while( have_rows('itens') ): the_row(); ?>
                    <li data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?=$count?>s"><svg aria-hidden="true" class="icon" viewBox="0 0 512 512" xmlns="http://www.w3.org/2000/svg"><path d="M173.898 439.404l-166.4-166.4c-9.997-9.997-9.997-26.206 0-36.204l36.203-36.204c9.997-9.998 26.207-9.998 36.204 0L192 312.69 432.095 72.596c9.997-9.997 26.207-9.997 36.204 0l36.203 36.204c9.997 9.997 9.997 26.206 0 36.204l-294.4 294.401c-9.998 9.997-26.207 9.997-36.204-.001z"></path></svg>
                      <?= get_sub_field('item') ?>
                    </li>
                  <?php $count++; endwhile; ?>
                </ul>
                <?php endif; ?>
            
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
        <div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><?= get_field('texto_proscons') ?></div>
        <?php if( have_rows('depoimentos_proscons') ): ?>
        <div class="slide-client" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">
          <?php while( have_rows('depoimentos_proscons') ): the_row(); ?>
            <div class="item">
              <h3><?= get_sub_field('titulo') ?></h3>
              <span><?= get_sub_field('subtitulo') ?></span>
              <p><?= get_sub_field('texto') ?></p>
            </div>
          <?php endwhile; ?>
        </div>
        <?php endif; ?>
        <div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s"><a rel="dofollow" href="<?= get_field('link_botao_proscons') ?>" class="btnBudgets"><svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use></svg> <?= get_field('texto_botao_proscons') ?></a></div>
      </div>
    </section>
    <!-- end:pros-cons -->

    <!-- box-online -->
    <?php if(get_field('background_boxonline')) { ?>
    <section class="box-online" style="background-image: url(<?= wp_get_attachment_image_url(get_field('background_boxonline'), 'full') ?>);background-position: center center;background-repeat: no-repeat;">
      <div class="container">
        <div class="grid">
          <div class="item">
            <?php if( have_rows('esquerda_boxonline') ): ?>
              <?php while( have_rows('esquerda_boxonline') ): the_row(); ?>
                <?php if( have_rows('boxs') ): 
                  $count=1;?>
                  <?php while( have_rows('boxs') ): the_row(); ?>
                    <div class="box" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?=$count?>s">
                      <div class="icons"><?= wp_get_attachment_image(get_sub_field('icone'), 'full') ?></div>
                      <div class="text">
                        <h3><?= get_sub_field('titulo') ?></h3>
                        <p><?= get_sub_field('texto') ?></p>
                      </div>
                    </div>
                  <?php $count++; endwhile; ?>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <div class="item">
            <?php if( have_rows('direita_boxonline') ): ?>
              <?php while( have_rows('direita_boxonline') ): the_row(); ?>
                <?php if( have_rows('boxs') ): 
                  $count=1;?>
                  <?php while( have_rows('boxs') ): the_row(); ?>
                    <div class="box" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?=$count?>s">
                      <div class="icons"><?= wp_get_attachment_image(get_sub_field('icone'), 'full') ?></div>
                      <div class="text">
                        <h3><?= get_sub_field('titulo') ?></h3>
                        <p><?= get_sub_field('texto') ?></p>
                      </div>
                    </div>
                  <?php $count++; endwhile; ?>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:box-online -->

    <!-- more-patients -->
    <?php if(get_field('titulo_morepatients')) { ?>
    <section id="orcamento" class="more-patients" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
      <div class="bg" style="background-image: url(<?= wp_get_attachment_image_url(get_field('background_morepatients'), 'full') ?>); background-size: <?= get_field('background_morepatients_size') ?>; opacity: <?= get_field('background_morepatients_opacity') ?>;"></div>
      <div class="container">
        <h2><?= get_field('titulo_morepatients') ?></h2>
        <p><?= get_field('texto_morepatients') ?></p>
        <?= do_shortcode(get_field('form_morepatients')) ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:more-patients -->

    <!-- land-faq -->
    <?php if(get_field('titulo_landfaq')) { ?>
    <section class="land-faq" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
      <div class="container">
        <h2><?= get_field('titulo_landfaq') ?></h2>
        <div class="grid">
          <div class="cols">
            <?php if( have_rows('esquerda_landfaq') ): ?>
              <?php while( have_rows('esquerda_landfaq') ): the_row(); ?>
                <?php if( have_rows('faqs') ): ?>
                  <?php while( have_rows('faqs') ): the_row(); ?>
                    <div class="item itemacord">
                      <h3>
                        <?= get_sub_field('pergunta') ?>
                        <svg class="icon accordionIcon">
                          <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#chevron2"></use>
                        </svg>
                      </h3>
                      <div class="box-content">
                        <p><?= get_sub_field('resposta') ?></p>
                      </div>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <div class="cols">
            <?php if( have_rows('direita_landfaq') ): ?>
              <?php while( have_rows('direita_landfaq') ): the_row(); ?>
                <?php if( have_rows('faqs') ): ?>
                  <?php while( have_rows('faqs') ): the_row(); ?>
                    <div class="item itemacord">
                      <h3>
                        <?= get_sub_field('pergunta') ?>
                        <svg class="icon accordionIcon">
                          <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#chevron2"></use>
                        </svg>
                      </h3>
                      <div class="box-content">
                        <p><?= get_sub_field('resposta') ?></p>
                      </div>
                    </div>
                  <?php endwhile; ?>
                <?php endif; ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
        <a rel="dofollow" href="<?= get_field('link_botao_landfaq') ?>" class="btnBudgets"><svg class="icon"><use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use></svg> <?= get_field('texto_botao_landfaq') ?></a>
      </div>
    </section>
    <?php } ?>
    <!-- end:land-faq -->

    <!-- box-text -->
    <?php if(get_field('titulo_boxtext')) { ?>
    <section class="box-text">
      <div class="container">
        <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><?= get_field('subtitulo_boxtext') ?></h2>
        <h3 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s"><?= get_field('titulo_boxtext') ?></h3>
        <div class="grid" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
          <div class="cols">
            <?php if( have_rows('esquerda_boxtext') ): ?>
              <?php while( have_rows('esquerda_boxtext') ): the_row(); ?>
                <?= get_sub_field('texto') ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
          <div class="cols">
            <?php if( have_rows('direita_boxtext') ): ?>
              <?php while( have_rows('direita_boxtext') ): the_row(); ?>
                <?= get_sub_field('texto') ?>
              <?php endwhile; ?>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:box-text -->
  </main>
  <!-- end:main -->

  <?php get_footer('land'); ?>