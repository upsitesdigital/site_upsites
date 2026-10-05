<?php
/*
Template Name: Parceiros
*/
get_header();

?>

  <!-- main -->
  <main id="main">
    <!-- hero-partners -->
    <section class="hero-partners">
      <div class="container">
        <div class="grid">
          <div class="text">
            <div class="tag noBox">
              <h1><?= get_field('subtitle_hero_partners') ?></h1>
            </div>
            <h2><?= get_field('title_hero_partners') ?></h2>
            <p><?= get_field('text_hero_partners') ?></p>
            <a href="#" class="btnBudgets open-modal-partner">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg?v=3#coin"></use>
              </svg> Indique e ganhe
            </a>
          </div>
          <div class="calc-box">
            <div class="box">
              <h3>Calcule abaixo o valor da sua comissão!</h3>
              <div class="form">
                <label for="">
                  <div class="prefix">R$</div>
                  <input type="text" name="sale-value" id="" placeholder="10.000,00">
                  <div class="label">Valor da venda</div>
                </label>
                <label for="">
                  <div class="prefix">R$</div>
                  <input type="text" name="your-commission" id="" placeholder="700,00" readonly>
                  <div class="label">Sua comissão</div>
                </label>
              </div>
              <div class="image">
                <img src="<?= get_template_directory_uri() ?>/assets/img/hero-partners.webp" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end:hero-partners -->

    <!-- modality-partners -->
    <section class="modality-partners">
      <div class="container">
        <div class="grid">
          <div class="text">
            <h2><?= get_field('title_modality_partners') ?></h2>
            <p><?= get_field('text_modality_partners') ?></p>
            <a href="" class="btnBudgets open-modal-partner">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg?v=3#coin"></use>
              </svg> Indique e ganhe
            </a>
          </div>
          <div class="modality-box">
            <div class="box">
              <h3>como funciona?</h3>
              <?php if( have_rows('list_modality_partners') ): ?>
                <ul>
                <?php while( have_rows('list_modality_partners') ): the_row(); 
                  ?>
                  <li>
                    <div class="number">
                      <?php 
                        echo '<div class="number">0' . get_row_index() . '</div>';
                      ?>
                    </div>
                    <div class="description">
                      <p><?= get_sub_field('text'); ?></p>
                    </div>
                  </li>
                <?php endwhile; ?>
                </ul>
              <?php endif; ?>
              <div class="image">
                <img src="<?= get_template_directory_uri() ?>/assets/img/modality-partners.webp" alt="">
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
    <!-- end:modality-partners -->

    <!-- benefits-partners -->
    <section class="benefits-partners">
      <div class="container">
        <h2><?= get_field('title_benefits_partners') ?></h2>
        <p><?= get_field('text_benefits_partners') ?></p>
        <?php if( have_rows('list_benefits_partners') ): ?>
          <div class="grid">
          <?php while( have_rows('list_benefits_partners') ): the_row(); 
            ?>
            <div class="item cols-0<?= get_row_index() ?>">
              <div class="icons"><?= wp_get_attachment_image(get_sub_field('icon'), 'full', '', array( "loading" => "lazy" )) ?></div>
              <h3><?= get_sub_field('title'); ?></h3>
              <p><?= get_sub_field('text'); ?></p>
            </div>
          <?php endwhile; ?>
          </div>
        <?php endif; ?>
      </div>
    </section>
    <!-- end:benefits-partners -->

    <!-- list-partners -->
    <?php if( have_rows('sec_list_partners') ): ?>
      <?php while( have_rows('sec_list_partners') ): the_row();
        $border = get_row_index() == 1 ? '' : 'border';
        $dir = get_row_index() % 2 == 0 ? 'right' : 'left' ;
        ?>
        <section class="list-partners">
          <div class="container">
            <div class="grid <?= $border ?> <?= $dir ?>">
              <div class="text">
                <h3 class="subtitle">PARCEIRO</h3>
                <h2><?= get_sub_field('title'); ?></h2>
                <?php if( have_rows('list') ): ?>
                  <ul>
                  <?php while( have_rows('list') ): the_row(); ?>
                    <li>
                      <svg class="icon">
                        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg?v=3#check-circle"></use>
                      </svg>
                      <?= get_sub_field('text'); ?>
                    </li>
                  <?php endwhile; ?>
                  </ul>
                <?php endif; ?>
                <a href="#" class="btnBudgets open-modal-partner">
                  <svg class="icon">
                    <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg?v=3#coin"></use>
                  </svg> Indique e ganhe
                </a>
              </div>
              <div class="image">
              <?= wp_get_attachment_image(get_sub_field('image'), 'full', '', array( "loading" => "lazy" )) ?>
              </div>
            </div>
          </div>
        </section>
      <?php endwhile; ?>
    <?php endif; ?>
    <!-- end:list-partners -->

    <!-- list-partners -->
    <section class="cta-partners">
      <div class="container">
        <div class="grid">
          <div class="text">
            <h3 class="subtitle"><?= get_field('subtitle_cta_partners') ?></h3>
            <h2><?= get_field('title_cta_partners') ?></h2>
            
            <a href="<?= get_field('link_cta_partners') ?>" class="btnBudgets">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg?v=3#whats"></use>
              </svg> Fale conosco
            </a>
          </div>
          <div class="image">
            <?= wp_get_attachment_image(get_field('image_cta_partners'), 'full', '', array( "loading" => "lazy" )) ?>
          </div>
        </div>
      </div>
    </section>
    <!-- end:list-partners -->

    <div class="modal-partners">
      <div class="content">
        <div class="header">
          <div class="steps">
            <div class="step step-01 act">1</div>
            <div class="step step-02">2</div>
          </div>
          <h2>Indique e ganhe</h2>
          <p>Indique um plano UpSites e ganhe 7% sob a venda convertida!</p>
          <a href="#" class="close">
            <svg class="icon">
              <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg?v=4#close"></use>
            </svg>
          </a>
        </div>
        <div class="body">
          <div class="form">
            <?= do_shortcode('[contact-form-7 id="f6da595" title="modal-partners"]') ?>
          </div>
          <div class="image">
            <img src="<?= get_template_directory_uri() ?>/assets/img/modal-partners.webp" alt="">
          </div>
        </div>
      </div>
    </div>
  </main>
  <!-- end:main -->

<?php get_footer(); ?>




