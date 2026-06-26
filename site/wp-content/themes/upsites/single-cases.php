<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

get_header(); 
$id_blog = get_page_by_path( 'blog' );
$avatar = (get_user_meta($post->post_author, 'us_imagem_avatar', true) != '') ? wp_get_attachment_image(get_user_meta($post->post_author, 'us_imagem_avatar', true)) : get_avatar($post->post_author, 120);
$avatar2 = (get_user_meta(get_field('authors_reviewed')['ID'], 'us_imagem_avatar', true) != '') ? wp_get_attachment_image(get_user_meta(get_field('authors_reviewed')['ID'], 'us_imagem_avatar', true)) : get_avatar(get_field('authors_reviewed')['ID'], 120);
US_set_post_views(get_the_ID());

$mail = get_theme_mod('US_mail');

?>
  <!-- main -->
  <main id="main">
    <?php if(get_field('title_cases') != '') { ?>
    <section class="case-featured">
      <div class="container">
        <ul class="term-list">
          <li><?= US_term_list(get_the_ID(), 'technologies_cases', 'tag') ?></li>
          <li><?= US_term_list(get_the_ID(), 'types_cases', 'tag') ?></li>
        </ul>
        <?php 
          //echo '<span class="subtitle pbottom-40">' . get_field('subtitle_cases') .'</span>';
          echo '<h1 class="title">' . get_field('title_cases') .'</h1>';
          if(get_field('text_cases')) {
            echo '<p class="description">' . get_field('text_cases') .'</p>';
          }
          
          if(get_field('desativar_seccao_slide') != 'inativo') {
            if( have_rows('imageslide_cases') ): ?>
              <div class="box-slidepag" style="position: relative;">
                <div class="box-slider">
                  <?php while( have_rows('imageslide_cases') ): the_row(); ?>
                    <div class="item">
                      <div class="image">
                        <?= wp_get_attachment_image(get_sub_field('image'), 'full', '', array( "loading" => "lazy" )) ?>
                      </div>
                    </div>
                  <?php endwhile; ?>
                </div>
              </div>
            <?php endif; 
          }
        ?>
        <!-- evolution -->
        <?php 
        if(get_field('desativar_seccao_beforeAfter') != 'inativo') { ?>
        <div class="case-evolution container relative">
          <div class="before-after">
            <div class="box">
              <div class="images">
                <div class="beforeAfter">
                  <?= wp_get_attachment_image(get_field('imagebefore_casesevolution'), 'full', '', array( "loading" => "lazy" )) ?>
                  <?= wp_get_attachment_image(get_field('imageafter_casesevolution'), 'full', '', array( "loading" => "lazy" )) ?>
                </div>
                <!-- div class="div"></div -->
              </div>
            </div>
          </div>
        </div>
        <?php } ?>
        <!-- end:evolution -->
        <?php 
          if(get_field('link_case')) {
            echo '<div class="btn-box">
              <a rel="nofollow" target="_blank" href="' . get_field('link_case') .'" class="seeMore">
                veja online - <b>' . get_field('textbtn_case') .'</b>
              </a>
            </div>';
          }
        ?>
      </div>
    </section>
    <?php } ?>
     
    <!-- howToWork -->
    <?php if(get_field('title_howToWork') != '') { ?>
    <section class="case-howToWork">
      <div class="container relative">
        <?php 
          echo '<h2>' . get_field('title_howToWork') .'</h2>';
        ?>
        <?php if( have_rows('items_howToWork') ): ?>
          <div class="grid">
            <?php while( have_rows('items_howToWork') ): the_row(); ?>
              <div class="item">
                <div class="icons"><?= wp_get_attachment_image(get_sub_field('icon'), 'full', '', array( "loading" => "lazy" )) ?></div>
                <h3><?= get_sub_field('text') ?></h3>
                <div class="text">
                  <p><?= get_sub_field('description') ?></p>
                </div>
              </div>
            <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:howToWork -->

    <!-- about-client -->
    <?php if(get_field('title_casesaboutclient') != '') { ?>
    <section class="case-about-client">
      <div class="container relative">
        <div class="grid-about">
          <div class="text">
            <?php 
              echo '<span class="subtitle pbottom-40">' . get_field('subtitle_casesaboutclient') .'</span>';
              echo '<h2 class="title">' . get_field('title_casesaboutclient') .'</h2>';
              if(get_field('text_casesaboutclient')) {
                echo '<p>' . get_field('text_casesaboutclient') .'</p>';
              }
              if(get_field('link_case')) {
                echo '<div class="btn-box">
                  <a rel="nofollow" target="_blank" href="' . get_field('link_case') .'" class="seeMore">
                    veja online - <b>' . get_field('textbtn_case') .'</b>
                  </a>
                </div>';
              }
            ?>
            <?php if( have_rows('tags_casesaboutclient') ): ?>
              <ul class="tags">
                <?php while( have_rows('tags_casesaboutclient') ): the_row();
                echo '<li>' . get_sub_field('tag') .'</li>';
                endwhile; ?>
              </ul>
            <?php endif; ?>
          </div>
          <div class="box-list">
            <?php 
              echo '<h3 class="title">' . get_field('titlebox_casesaboutclient') .'</h3>';
            ?>
            <?php if( have_rows('listbox_casesaboutclient') ): ?>
              <ul>
                <?php while( have_rows('listbox_casesaboutclient') ): the_row();
                echo '<li><svg class="icon"><use xlink:href="'. get_bloginfo("template_url") .'/assets/img/icons.svg#checkmark-square"></use></svg>' . get_sub_field('text') .'</li>';
                endwhile; ?>
              </ul>
            <?php endif; ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:about-client -->

    <!-- gallery -->
    <?php if(get_field('title_casesgallery') != '') { ?>
    <section class="case-gallery">
      <div class="container relative">
        <?php 
          echo '<span class="subtitle">' . get_field('subtitle_casesgallery') .'</span>';
          echo '<h2 class="title">' . get_field('title_casesgallery') .'</h2>';
        ?>
        <ul class="tags">
          <li>
            <a href="#" data-target="device-desktop" class="act">
              <svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg?v=05#device-desktop"></use></svg>
              <span>Layout Desktop</span>
            </a>
          </li>
          <li>
            <a href="#" data-target="device-mobile">
              <svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg?v=05#device-mobile"></use></svg>
              <span>Layout Mobile</span>
            </a>
          </li>
        </ul>
        <div id="device-desktop" class="content-desktop">
          <?php if( have_rows('slidetopdesktop_casesgallery') ): ?>
            <div class="slide-top">
              <?php while( have_rows('slidetopdesktop_casesgallery') ): the_row(); ?>
                <a data-fancybox="gallery" href="<?= wp_get_attachment_image_url(get_sub_field('image'), 'full') ?>"><?= wp_get_attachment_image(get_sub_field('image'), 'full', '', array( )) ?></a>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
          <?php if( have_rows('slidebottomdesktop_casesgallery') ): ?>
            <div class="slide-bottom" dir="rtl">
              <?php while( have_rows('slidebottomdesktop_casesgallery') ): the_row(); ?>
                <a data-fancybox="gallery" href="<?= wp_get_attachment_image_url(get_sub_field('image'), 'full') ?>"><?= wp_get_attachment_image(get_sub_field('image'), 'full', '', array( )) ?></a>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
        <div id="device-mobile" class="content-mobile">
          <?php if( have_rows('slidetopmobile_casesgallery') ): ?>
            <div class="slide-top" >
              <?php while( have_rows('slidetopmobile_casesgallery') ): the_row(); 
              var_dump(get_sub_field('image'));
              ?>
                <a data-fancybox="gallery" href="<?= wp_get_attachment_image_url(get_sub_field('image'), 'full') ?>"><?= wp_get_attachment_image(get_sub_field('image'), 'full', '', array( )) ?></a>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
          <?php if( have_rows('slidebottommobile_casesgallery') ): ?>
            <div class="slide-bottom" dir="rtl">
              <?php while( have_rows('slidebottommobile_casesgallery') ): the_row(); ?>
                <a data-fancybox="gallery" href="<?= wp_get_attachment_image_url(get_sub_field('image'), 'full') ?>"><?= wp_get_attachment_image(get_sub_field('image'), 'full', '', array( )) ?></a>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
        <?php 
          if(get_field('link_case')) {
            echo '<div class="center">
              <a rel="nofollow" target="_blank" href="' . get_field('link_case') .'" class="seeMore">
                veja online - <b>' . get_field('textbtn_case') .'</b>
              </a>
            </div>';
          }
        ?>
      </div>
    </section>
    <?php } ?>
    <!-- end:gallery -->

    <!-- letter -->
    <?php 
    //var_dump(get_field('fontstylelist_casesletter'));
    //if(empty(get_field('fontstylelist_casesletter'))) { ?>
    <section class="case-letter">
      <div class="container relative">
        <div class="grid-letter">
          <div class="text">
            <?php if( have_rows('fontstylelist_casesletter') ): ?>
              <ul>
                <?php while( have_rows('fontstylelist_casesletter') ): the_row(); ?>
                  <li>
                    <div class="title title-1" style="font-family: '<?= get_sub_field("fontname") ?>'; font-size: <?= get_sub_field("fontsize") ?>px; font-weight: <?= get_sub_field("fontweight")["value"] ?>;"><?= get_sub_field("title") ?>-<?= get_sub_field("fontsize") ?></div>
                    <span>Font-size: <?= get_sub_field("fontsize") ?></span>
                    <span>Font-weight: <?= get_sub_field("fontweight")["label"] ?></span>
                  </li>
                <?php endwhile; ?>
              </ul>
            <?php endif; ?>
          </div>
          <div class="font-type">
            <?php if( have_rows('fontstylelist2_casesletter') ): ?>
              <ul class="font-type-list">
                <?php while( have_rows('fontstylelist2_casesletter') ): the_row(); ?>
                  <li>
                    <span class="subtitle"><?= get_sub_field("subtitle_casesletter") ?></span>
                    <h2 class="title" style="font-family: '<?= get_sub_field("fontname") ?>'; font-size: <?= get_sub_field("fontsize") ?>px; font-weight: <?= get_sub_field("fontweight")["value"] ?>;"><?= get_sub_field("fontstyle_casesletter") ?></h2>
                  </li>
                <?php endwhile; ?>
              </ul>
            <?php endif; ?>
            
            <?= wp_get_attachment_image(get_field('fontstyleimage_casesletter'), 'full', '', array( "loading" => "lazy" )) ?>
          </div>
        </div>
        <div class="color-palette">
          <h3 class="title">Paleta de cores</h3>
          <?php if( have_rows('colorpalette_casesletter') ): ?>
            <div class="flex">
              <?php while( have_rows('colorpalette_casesletter') ): the_row(); ?>
                <div class="box-color" style="width: <?= get_sub_field("percentage") ?>%;">
                  <div class="bar" style="background-color: <?= get_sub_field("color") ?>;"></div>
                  <span class="hex"><?= get_sub_field("color") ?></span>
                </div>
              <?php endwhile; ?>
            </div>
          <?php endif; ?>
        </div>
      </div>
    </section>
    <?php //} ?>
    <!-- end:letter -->

    <!-- testimonial -->
    <?php if(get_field('title_casestestimonial') != '') { ?>
    <section class="case-testimonial">
      <div class="container relative">
        <?php 
          echo '<span class="subtitle">' . get_field('subtitle_casestestimonial') .'</span>';
          echo '<h2 class="title">' . get_field('title_casestestimonial') .'</h2>';
        ?>
        <div class="box-testimonial">
          <div class="user">
            <?php 
              echo '<div class="avatar">'.wp_get_attachment_image(get_field('avatar_casestestimonial'), 'full', '', array( "loading" => "lazy" )).'</div>';
              echo '<div class="content">';
                echo '<span class="name">' . get_field('name_casestestimonial') .'</span>';
                echo '<span class="position">' . get_field('position_casestestimonial') .'</span>';
              echo '</div>';
            ?>
          </div>
          <?php 
            echo '<p class="description">' . get_field('testimonial_casestestimonial') .'</p>';
          ?>
          <div class="box-google">
            <div class="logo"><img src="<?= get_bloginfo("template_url") ?>/assets/images/google.png.webp" alt=""></div>
            <div class="content">
              A UpSites é uma agência de criação de sites com clientes satisfeitos espalhados pelo Brasil inteiro.
            </div>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:testimonial -->

    <!-- others-featured -->
    <section class="case-others-featured">
      <div class="container relative">
        <h3 class="subtitle">CASES</h3>
        <h2>Confira outros cases</h2>
        <a rel="dofollow" href="<?= get_permalink( get_page_by_path( 'case' ) ) ?>" class="all" aria-label="Todos os posts do blog">
          VEJA TODOS OS CASES
          <svg class="icon arrowSlide">
            <use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#arrowSlide"></use>
          </svg>
        </a>
        <div class="grid">
          <?php
            $postargs = array(
              'post_type' 						 => 'cases',
              'order'                  => 'DESC',
              'posts_per_page'         => 3,
              //'paged' 								 => $paged,
              'post_status'            => 'publish',
            );
            $postcat = new WP_Query($postargs);
            $maxpages = $postcat->max_num_pages;
            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'cases');
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>
    <!-- end:others-featured -->
    
    <?php if(get_field('title_ctacases') != '') { ?>
    <section class="cta-case">
      <div class="container">
        <div class="grid">
          <div class="text">
            <span class="subtitle"><?= get_field("subtitle_ctacases") ?></span>
            <h2 class="title"><?= get_field("title_ctacases") ?></h2>
            <p><?= get_field("text_ctacases") ?></p>
            <?php 
              if(get_field("linkbtn_ctacases")) {
                echo '<a rel="dofollow" href="' . get_field("linkbtn_ctacases") . '" class="btnBudgets">
                  <svg class="icon"><use xlink:href="' . get_bloginfo("template_url") . '/assets/img/icons.svg#ray"></use></svg> 
                  ' . get_field("textbtn_ctacases") . '
                </a>';
              }
            ?>
          </div>
          <div class="image">
            <?= wp_get_attachment_image(get_field('image_ctacases'), 'full') ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>

  </main>
  <!-- end:main -->
<?php
get_footer();