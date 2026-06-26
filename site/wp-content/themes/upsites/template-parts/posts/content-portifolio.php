<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

$current_post = array_key_exists('current_post',$args) ? $args['current_post'] * 2 : 0 * 2;
?>
<div class="item-port" id="post-<?php the_ID(); ?>" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?= $current_post; ?>s">
  <div class="image">
    <a rel="nofollow" href="<?php the_field('link_portifolio') ?>" target="_blank">
      <?= wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'full', '', array( "loading" => "lazy" )) ?>
    </a>
  </div>
  <div class="relative">
    <?= US_term_list(get_the_ID(), 'categories_portifolios', 'tag') ?>
    <a rel="nofollow" href="<?php the_field('link_portifolio') ?>" class="box" target="_blank">
      <span><?php the_field('subtitulo_portifolio') ?></span>
      <h3><?php the_title() ?></h3>
      <!-- p><?php the_field('resumo_portifolio') ?></p -->
      <span class="link">Ver projeto</span>
    </a>
  </div>
</div>
