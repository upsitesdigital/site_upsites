<?php
/*
Template Name: Orçamentos
*/
get_header('land');
$logo_mobile    		    = get_theme_mod('US_logo_mobile');

?>
<div id="loader-layer">
  <?php
    if ($logo_mobile != '') {
      echo wp_get_attachment_image(attachment_url_to_postid($logo_mobile), 'full', '', array( "loading" => "lazy" ));
    }
  ?>
</div>
<?php the_content(); ?>

<?php get_footer('land'); ?>




