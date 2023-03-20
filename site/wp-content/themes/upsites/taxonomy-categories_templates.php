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
get_header();
$tax       = get_queried_object()->taxonomy;
$termSlug  = get_queried_object()->slug;
$termID    = get_queried_object()->term_id;
$termName  = get_queried_object()->name;

$idObj = get_page_by_path( 'site-por-assinatura' );
$idhome = $idObj->ID;
?>
  <!-- main -->
  <main>
    <!-- portfolio -->
    <section class="portfolio">
      <div class="container">
        <?php 
          if(get_field('subtitulo_templates',$idhome)) {
            echo '<span>' . get_field('subtitulo_templates',$idhome) . '</span>';
          }
          if(get_field('titulo_templates',$idhome)) {
            echo '<h2>' . get_field('titulo_templates',$idhome) . '</h2>';
          }
          if(get_field('texto_templates',$idhome)) {
            echo '<p>' . get_field('texto_templates',$idhome) . '</p>';
          }
        ?>
        <div class="links">
          <a href="<?= get_permalink( get_page_by_path( 'site-por-assinatura' ) ) ?>">Todos</a>
          <?php 
          $terms = get_terms( 'categories_templates' );
          if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
              $act = $termName == $term->name ? 'act' : '' ;
              echo '<a class="' . $act . '" href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a>';
            }
          }
          ?>
        </div>
        <div id="posts-templates" class="grid">
          <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $postargs = array(
              'post_type' 						 => 'templates',
              'posts_per_page'         => 1,
              'paged' 								 => $paged,
              'post_status'            => 'publish',
              'tax_query' => array(
                array(
                    'taxonomy' => $tax,
                    'field' => 'slug',
                    'terms' => $termSlug
                )
              ),
            );
            $postcat = new WP_Query($postargs);
            $maxpages = $postcat->max_num_pages;
            // echo $maxpages;
            // echo $paged;
            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'template');
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
        <div class="align-center">
          <?php if($maxpages != $paged) { ?>
            <a href="#" class="seeMore" id="load-more-templates" data-maxpages="<?= $maxpages; ?>" data-currentPage="<?= $paged; ?>" data-cat="<?= $termSlug; ?>" data-type="templates" data-tax="categories_templates">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrow"></use>
              </svg> Carregar mais
            </a>
          <?php } ?>
        </div>
      </div>
    </section>
    <!-- end:portfolio -->

    <!-- hireProfessionWebsite -->
    <?php get_template_part( 'template-parts/inc','prices' ); ?>
    <!-- end:hireProfessionWebsite -->

    <!-- faq -->
    <?php get_template_part( 'template-parts/inc','faqs' ); ?>
    <!-- end:faq -->

  </main>
  <!-- end:main -->
<?php get_footer(); ?>
