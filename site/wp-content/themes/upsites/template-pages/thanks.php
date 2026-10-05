<?php
/*
Template Name: Obrigado por pedir um orçamento
*/
get_header();

$phone 						= get_theme_mod('US_phone');
$phone_custom 		= '0'.str_replace(array('(', ')', '-', ' '), "", $phone);
$phone2 					= get_theme_mod('US_phone2');
$phone2_custom 		= str_replace(array('(', ')', '-', ' '), "", $phone2);
$mail    		      = get_theme_mod('US_mail');
$address    		  = get_theme_mod('US_address');
?>

  <!-- main -->
  <main id="main">

    <!-- thanksFormRequestQuote -->
    <section class="thanksFormRequestQuote">
      <div class="container">
        <div class="grid">
          <div class="item">
            <?php 
              if(get_the_title()) {
                echo '<div class="tag" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><h1 class="b">' . get_the_title() . '</h1></div>';
              }
              if(get_field('titulo_thanks')) {
                echo '<h2 class="title" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_thanks') . '</h2>';
              }
            ?>
            <p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">Nossos contatos:</p>
            <div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s">
              <a rel="dofollow" href="<?= 'tel:' . $phone_custom ?>" class="phone">
                <svg class="icon">
                  <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#phone"></use>
                </svg> <?= $phone ?>
              </a>
            </div>
            
            <!-- a href="<?= 'tel:+' . $phone2_custom ?>" class="phone">
              <svg class="icon whats">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#whats"></use>
              </svg> <?= $phone2 ?>
            </a -->
            <?php
              if ($mail != '') {
                echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.6s" class="small"><a rel="dofollow" href="mailto:' . $mail . '"><svg class="icon">
                <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#letter"></use>
              </svg> ' . $mail  . '</a></p>';
              }
            ?>
          </div>
          <div class="item image" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s">
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




