<?php
/*
Template Name: Portifolios
*/
get_header();
?>
  <!-- main -->
  <main id="main">
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
        <span data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><?php the_field('subtitulo_portifolios'); ?></span>
        <h1 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s" class="title"><?php the_title(); ?></h1>
        <p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s"><?php the_field('resumo_portifolios'); ?></p>
        <?php
          $catsargs = array(
            'post_type' 						 => 'portifolios',
            'posts_per_page'         => -1,
            'post_status'            => 'publish',
            'tax_query' => array(
              array(
                  'taxonomy'  => 'segmentos_portifolios',
                  'field'     => 'slug',
                  'terms'     => 'site-sob-medida'
              ),
            )
          );
          $cats = new WP_Query($catsargs);
        ?>
        <div class="links" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s">
          <a rel="dofollow" class="act load-more-categories" data-target="posts-portifolios" data-maxpages="<?= $maxpages; ?>" data-currentPage="1" data-cat="Todos" data-type="portifolios" data-tax="categories_portifolios" data-segmentos="site-sob-medida" href="#">Todos</a>
          <?php
          $catarr = array();
            while ($cats->have_posts()) : $cats->the_post();
              foreach ( get_the_terms( $cats->ID, 'categories_portifolios' ) as $term ) {
                array_push($catarr, $term->slug);
              }
            endwhile;
            foreach ( array_unique($catarr) as $slug ) {
              $term = get_term_by('slug', $slug, 'categories_portifolios');
              $maxpagescat = ceil($term->count / 9);
              echo '<a rel="dofollow" class="load-more-categories" id="load-more-links" href="#" data-target="posts-portifolios" data-maxpages="' . $maxpagescat . '" data-currentPage="1" data-type="portifolios" data-tax="categories_portifolios" data-segmentos="site-sob-medida" data-cat="' . $term->slug . '">' . $term->name . '</a>';
              
            }
            wp_reset_postdata();
          ?>
        </div>
        <div id="posts-portifolios" class="grid teest">
          <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $postargs = array(
              'post_type' 						 => 'portifolios',
              'posts_per_page'         => 9,
              'paged' 								 => $paged,
              'order'                  => 'DESC',
              'post_status'            => 'publish',
              'tax_query' => array(
                array(
                    'taxonomy'  => 'segmentos_portifolios',
                    'field'     => 'slug',
                    'terms'     => 'site-sob-medida'
                ),
              )
            );
            $postcat = new WP_Query($postargs);
            $maxpages = $postcat->max_num_pages;

            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'portifolio');
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
        <div class="align-center" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
          <?php if($maxpages != $paged) { ?>
            <a rel="dofollow" href="#" class="seeMore load-more-categories" id="load-more-button" data-target="posts-portifolios" data-maxpages="<?= $maxpages; ?>" data-currentPage="<?= $paged; ?>" data-cat="Todos" data-type="portifolios" data-tax="categories_portifolios" data-segmentos="site-sob-medida">
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

    <!-- faq ->
    <?php $args = array(
      'type' => 'portfolio',
    );
    get_template_part( 'template-parts/inc','faqs', $args ); ?>
    <!- end:faq -->

  </main>
  <!-- end:main -->
<?php get_footer(); ?>




