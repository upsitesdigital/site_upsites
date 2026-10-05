<?php
/*
Template Name: Segmentos
*/
get_header();


?>
  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <?php if(get_field('desativar_seccao_toppage') !== 'inativo') { ?>
    <section class="slideFull">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_toppage')) {
                echo '<div class="tag noBox" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><h1>' . get_field('subtitulo_toppage') . '</h1></div>';
              }
              if(get_field('titulo_toppage')) {
                echo '<h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_toppage') . '</h2>';
              }
              if(get_field('texto_toppage')) {
                echo '<p data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">' . get_field('texto_toppage') . '</p>';
              }
              if(get_field('texto_botao_toppage')) {
                echo '<div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s"><a rel="dofollow" href="' . get_field('link_botao_toppage') . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_toppage') . '</a></div>';
              }
            ?>
          </div>
          <div class="image" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.7s">
            <?php 
              if(get_field('imagem_toppage')) {
                echo wp_get_attachment_image(get_field('imagem_toppage'), 'full');
              }
            ?>
          </div>
        </div>
      </div>
    </section>
    <?php } ?>
    <!-- end:slideFull -->

    <section id="segments" class="segments">
      <div class="container">
        <div class="box-title">
          <!-- div class="left">
            <span class="subtitle">simply dummy</span>
            <h2 class="title">simply dummy text of <br>the printing and</h2>
          </div -->
          <div class="right">
            <?php
              $typesargs = array(
                'taxonomy'    => 'categories_landings',
                'hide_empty'  => true,
                'orderby'     => 'id',
                'order'       => 'ASC',
              );
              $types = get_categories($typesargs);
              echo '<a href="#" class="text act" data-slug="all">Todas</a>';
              foreach($types as $type) {
                echo '<a href="#" class="text" data-slug="' . $type->slug . '">' . $type->name . '</a>';
              }
            ?>
          </div>
        </div>
        <div class="list-segments">
          <?php
            $relargs = array(
              'post_type' 						 => 'landings',
              'post_status'            => 'publish',
              'posts_per_page'         => '-1',
              'post__not_in'     			 => array(get_the_ID()),
              'no_found_rows'          => true,
              'update_post_term_cache' => false,
              'update_post_meta_cache' => false,
              'cache_results'          => false
            );
            $relposts = new WP_Query($relargs);
            while ($relposts->have_posts()) : $relposts->the_post();
          ?>
              <a href="<?= get_the_permalink() ?>" class="item">
                <div class="box-icon" style="background-color: <?= get_field('cor_seglanding') ?>;">
                  <?= wp_get_attachment_image(get_field('icone_seglanding'), 'full') ?>
                </div>
                <h3>Site para <?= get_field('texto_seglanding') ?></h3>
              </a>
          <?php
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>

    <!-- faq -->
    <?php /*
    $args = array(
      'type' => 'segmentos',
    );
    get_template_part( 'template-parts/inc','faqs', $args ); */ ?>
    <!-- end:faq -->

  </main>
  <!-- end:main -->

<?php get_footer(); ?>




