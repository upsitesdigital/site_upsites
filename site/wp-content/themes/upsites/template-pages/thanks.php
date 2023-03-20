<?php
/*
Template Name: Obrigado por pedir um orçamento
*/
get_header();

$phone 						= get_theme_mod('US_phone');
$phone_custom 		= str_replace(array('(', ')', '-', ' '), "", $phone);
$mail    		      = get_theme_mod('US_mail');
$address    		  = get_theme_mod('US_address');
?>

  <!-- main -->
  <main>

    <!-- thanksFormRequestQuote -->
    <section class="thanksFormRequestQuote">
      <div class="container">
        <div class="grid">
          <div class="item">
            <div class="tag">
              <b><?php the_title() ?></b>
            </div>
            <h1><?= get_field('titulo_thanks') ?></h1>
            <p>Nossos contatos:</p>
            <a href="<?= 'tel:+' . $phone_custom ?>" class="phone">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#phone"></use>
              </svg>
              <svg class="icon whats">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#whats"></use>
              </svg> <?= $phone ?>
            </a>
            <?php
              if ($mail != '') {
                echo '<p class="small"><a href="mailto:' . $mail . '">' . $mail  . '</a></p>';
              }
            ?>
            <?php
              if ($address != '') {
                echo '<p class="small">' . $address  . '</p>';
              }
            ?>
          </div>
          <div class="item image">
            <?php 
              if(get_field('imagem_thanks')) {
                echo wp_get_attachment_image(get_field('imagem_thanks'), 'full');
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    <!-- end:thanksFormRequestQuote -->

  </main>
  <!-- end:main -->

<?php get_footer(); ?>




