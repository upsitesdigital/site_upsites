<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

?>
<div class="item-slide" id="post-<?php the_ID(); ?>" data-scroll-reveal="enter bottom move 50px over 0.6s after 0s">
  <div class="grid-featured">
    <div class="item">
      <!-- div class="rate">
        <svg class="icon">
          <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#star-port"></use>
        </svg>
        <svg class="icon">
          <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#star-port"></use>
        </svg>
        <svg class="icon">
          <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#star-port"></use>
        </svg>
        <svg class="icon">
          <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#star-port"></use>
        </svg>
        <svg class="icon">
          <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#star-port"></use>
        </svg>
      </div -->
      <h3><?php the_title() ?></h3>
      <p><?php the_field('subtitulo_portifolio') ?></p>
      <a rel="nofollow" target="_blank" href="<?php the_field('link_portifolio') ?>">ACESSAR PROJETO</a>
    </div>
    <div class="item">
      <?= wp_get_attachment_image(get_field('mocap_port'), 'full', '', array( "loading" => "lazy" )) ?>
    </div>
  </div>
</div>