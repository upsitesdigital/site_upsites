<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

 $current_post = array_key_exists('current_post',$args) ? $args['current_post'] * 2 : 0 * 2;
 $image = get_field('thumb_blog') ? get_field('thumb_blog') : get_post_thumbnail_id(get_the_ID()) ;
?>
<div class="item" id="post-<?php the_ID(); ?>" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.<?= $current_post; ?>s">
  <div class="image">
    <a rel="dofollow" href="<?= get_the_permalink() ?>" class="img">
      <?= wp_get_attachment_image($image, 'blog-thumb', '', array( "loading" => "lazy" )) ?>
    </a>
    <?= US_term_list(get_the_ID(), 'category', 'tag') ?>
  </div>
  <a rel="dofollow" href="<?= get_the_permalink() ?>" class="box">
    <h3><?php the_title() ?></h3>
    <span class="link">LEIA MAIS</span>
  </a>
</div>
