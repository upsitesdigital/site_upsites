<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

?>
<div class="item-port" id="post-<?php the_ID(); ?>" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
  <div class="image">
    <a rel="nofollow" target="_blank" href="<?php the_field('link_templates') ?>"><?= wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'portfolio-thumb') ?></a>
  </div>
  <div class="relative">
    <a rel="nofollow" target="_blank" href="<?php the_field('link_templates') ?>" class="box">
      <?= US_term_list(get_the_ID(), 'categories_templates', 'tags') ?>
      <h3><?php the_title() ?></h3>
      <!-- p><?php the_field('resumo_templates') ?></p-->
      <span class="link">Visite o modelo</span>
    </a>
  </div>
</div>
