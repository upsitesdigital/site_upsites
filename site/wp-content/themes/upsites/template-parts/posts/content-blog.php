<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

?>
<div class="item" id="post-<?php the_ID(); ?>">
  <div class="image">
    <a href="<?= get_the_permalink() ?>" class="img">
      <?= wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'thumbnail') ?>
    </a>
    <?= US_term_list(get_the_ID(), 'category') ?>
  </div>
  <a href="<?= get_the_permalink() ?>" class="box">
    <h3><?php the_title() ?></h3>
    <span class="link">LEIA MAIS</span>
  </a>
</div>
