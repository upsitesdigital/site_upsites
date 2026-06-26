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
$idObj = get_page_by_path( 'portifolios' );
$idhome = $idObj->ID;

?>
  <!-- main -->
  <main>
    <section class="portfoliolistnew">
      <div class="container">
        <?php 
          echo '<span class="subtitle pbottom-40"><span>AGÊNCIA</span>  •  <b>PORTIFÓLIO</b></span>';
        ?>
        <div class="box-slidepag" style="position: relative;">
        <?php
          $postargs = array(
            'post_type' 						 => 'portifolios',
            'posts_per_page'         => 6,
            'post_status'            => 'publish',
            'meta_key'      				 => 'destacar_port',
            'meta_value'    				 => '1',
            'no_found_rows'          => true,
            'update_post_term_cache' => false,
            'update_post_meta_cache' => false,
            'cache_results'          => false
          );
          $postcat = new WP_Query($postargs);
          if($postcat->have_posts()) {
            echo '<div class="box-slider">';
        ?>
          <?php while ($postcat->have_posts()) : $postcat->the_post(); ?>
            <div class="item">
              <div class="image">
                <?= wp_get_attachment_image(get_field('mocap_port'), 'full', '', array( "loading" => "lazy" )) ?>
                <a rel="nofollow" target="_blank" href="<?php the_field('link_portifolio') ?>"><img src="<?= get_template_directory_uri() ?>/assets/img/btn-portifolio.png" alt=""></a>
              </div>
              <div class="text">
                <div class="item">
                  <h3><?php the_title() ?></h3>
                  <span class="tag"><?php the_field('subtitulo_portifolio') ?></span>
                  <?php
                    if(get_the_excerpt()) {
                      echo '<p>' . get_the_excerpt() . '</p>';
                    }
                  ?>
                </div>
                <div class="btn-box">
                  <a rel="nofollow" target="_blank" href="<?php the_field('link_portifolio') ?>" class="seeMore">
                    veja online - <b><?php 
                    $remove = array("https:", "http:", "/", "www.");
                    echo str_replace($remove, "", get_field('link_portifolio'));
                    ?></b>
                  </a>
                </div>
              </div>
            </div>
          <?php endwhile; wp_reset_postdata(); ?>
        <?php 
            echo '</div>';
          } 
        ?>
          <div id="btns-slider">
            <a href="#" class="prev">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
              </svg>
            </a>
            <div class="pags"><span class="current">01</span>  •  <span class="total">04</span></div>
            <a href="#" class="next">
              <svg class="icon">
                <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#arrowSlide"></use>
              </svg>
            </a>
          </div>
        </div>
      </div>
    </section>
    <!-- portfolio -->
    <section class="portfolio">
      <div class="container">
        <span><?php the_field('subtitulo_portifolios',$idhome); ?></span>
        <h2><?= get_the_title($idhome); ?></h2>
        <p><?php the_field('resumo_portifolios',$idhome); ?></p>
        <div class="links">
          <a rel="dofollow" href="<?= get_permalink( get_page_by_path( 'portifolios' ) ) ?>">Todos</a>
          <?php 
          $terms = get_terms( 'categories_portifolios' );
          if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
              $act = $termName == $term->name ? 'act' : '' ;
              echo '<a class="' . $act . '" href="' . esc_url( get_term_link( $term ) ) . '">' . $term->name . '</a>';
            }
          }
          ?>
        </div>
        <div id="posts-portifolios" class="grid">
          <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $postargs = array(
              'post_type' 						 => 'portifolios',
              //'posts_per_page'         => 1,
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
            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'portifolio');
            endwhile;
            //wp_reset_postdata();
          ?>
        </div>
        <div class="align-center" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
          <?php if($maxpages != $paged) { ?>
            <a rel="dofollow" href="#" class="seeMore load-more-categories" id="load-more-button" 
            data-target="posts-portifolios" 
            data-maxpages="<?= $maxpages; ?>" 
            data-currentPage="<?= $paged; ?>" 
            data-cat="<?= $termSlug; ?>" 
            data-type="portifolios" 
            data-tax="categories_portifolios" 
            data-segmentos="site-sob-medida">
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
