<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

?>
<div class="item-port" id="post-<?php the_ID(); ?>">
  <div class="image">
    <?= wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'portfolio-thumb') ?>
  </div>
  <div class="box">
    <?= US_term_list(get_the_ID(), 'categories_portifolios') ?>
    <span><?php the_field('subtitulo_portifolio') ?></span>
    <h3><?php the_title() ?></h3>
    <p><?php the_field('resumo_portifolio') ?></p>
    <a class="link" target="_blank" href="<?php the_field('link_portifolio') ?>">Visite o modelo</a>
  </div>
</div>
