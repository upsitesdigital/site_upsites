<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

?>
<div class="item-case" id="post-<?php the_ID(); ?>">
  <div class="image">
    <a rel="nofollow" href="<?= get_the_permalink() ?>" target="_blank">
      <?= wp_get_attachment_image(get_post_thumbnail_id(get_the_ID()), 'full', '', array( "loading" => "lazy" )) ?>
    </a>
  </div>
  <div class="relative">
    <?= US_term_list(get_the_ID(), 'categories_cases', 'tag') ?>
    <a rel="nofollow" href="<?= get_the_permalink() ?>" class="box" target="_blank">
      <span><?php the_field('subtitle_case') ?></span>
      <h3><?php the_title() ?></h3>
      <p><?php the_field('text_case') ?></p>
      <span class="link">Ver projeto</span>
    </a>
  </div>
</div>