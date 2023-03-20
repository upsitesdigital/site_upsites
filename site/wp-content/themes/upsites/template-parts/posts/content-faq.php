<?php
/**
 * Template part for displaying page content in page.php
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package WordPress
 */

?>
<div class="item accordion" id="faq-<?php the_ID(); ?>">
  <div class="title accordionClick">
    <h3><?php the_title() ?></h3>
    <svg class="icon accordionIcon">
      <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#chevron"></use>
    </svg>
  </div>
  <div class="content accordionContent">
    <?php the_content() ?>
  </div>
</div>
