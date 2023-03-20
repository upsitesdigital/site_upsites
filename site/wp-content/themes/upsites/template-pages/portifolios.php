<?php
/*
Template Name: Portifolios
*/
get_header();
?>
  <!-- main -->
  <main>
    <!-- portfolio -->
    <section class="portfolio">
      <div class="container">
        <span><?php the_field('subtitulo_portifolios'); ?></span>
        <h2><?php the_title(); ?></h2>
        <p><?php the_field('resumo_portifolios'); ?></p>
        <?php
          $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
          $postargs = array(
            'post_type' 						 => 'portifolios',
            'posts_per_page'         => 6,
            'paged' 								 => $paged,
            'order'                  => 'DESC',
            'post_status'            => 'publish',
          );
          $postcat = new WP_Query($postargs);
          $maxpages = $postcat->max_num_pages;
        ?>
        <div class="links">
          <a class="act load-more-categories" data-target="posts-portifolios" data-maxpages="<?= $maxpages; ?>" data-currentPage="1" data-cat="Todos" data-type="portifolios" data-tax="categories_portifolios" href="#">Todos</a>
          <?php 
          $terms = get_terms( 'categories_portifolios' );
          if ( ! empty( $terms ) && ! is_wp_error( $terms ) ){
            foreach ( $terms as $term ) {
              $maxpagescat = ceil($term->count / 6);
              echo '<a class="load-more-categories" id="load-more-links" href="#" data-target="posts-portifolios" data-maxpages="' . $maxpagescat . '" data-currentPage="1" data-type="portifolios" data-tax="categories_portifolios" data-cat="' . $term->slug . '">' . $term->name . '</a>';
            }
          }
          ?>
        </div>
        <div id="posts-portifolios" class="grid">
          <?php
            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'portifolio');
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
        <div class="align-center">
          <?php if($maxpages != $paged) { ?>
            <a href="#" class="seeMore load-more-categories" id="load-more-button" data-target="posts-portifolios" data-maxpages="<?= $maxpages; ?>" data-currentPage="<?= $paged; ?>" data-cat="Todos" data-type="portifolios" data-tax="categories_portifolios">
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
    <?php $args = array(
      'type' => 'portfolio',
    );
    get_template_part( 'template-parts/inc','faqs', $args ); ?>
    <!-- end:faq -->

  </main>
  <!-- end:main -->
<?php get_footer(); ?>




