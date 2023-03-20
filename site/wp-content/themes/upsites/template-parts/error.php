<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>

  <!-- main -->
  <main>

    <!-- 404 -->
    <section class="page-404">
      <div class="container">
        <a href="<?= esc_url(home_url('/')) ?>" class="logo">
          <img src="<?= get_template_directory_uri() ?>/assets/img/logo.png" width="100%">
        </a>
        <div class="grid">
          <div class="item">
            <img src="<?= get_template_directory_uri() ?>/assets/img/img-404.svg" class="img-404">
            <p>pagina não encontrada</p>
            <a href="<?= esc_url(home_url('/')) ?>" class="btnBudgets">Voltar a home</a>
          </div>
          <div class="item">
            <img src="<?= get_template_directory_uri() ?>/assets/img/image-404.svg" class="image-404">
          </div>
        </div>
      </div>
    </section>
    <!-- end:404 -->

  </main>
  <!-- end:main -->
