<?php
/*
Template Name: Videos
*/
get_header();

?>

  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <?php if(get_field('desativar_seccao_toppage') !== 'inativo') { ?>
    <section class="slideFull mbottom-50">
      <div class="container">
        <div class="grid">
          <div class="text">
            <?php 
              if(get_field('subtitulo_toppage')) {
                echo '<div class="tag noBox" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s"><h3 class="subtitle">' . get_field('subtitulo_toppage') . '</h3></div>';
              }
              if(get_field('titulo_toppage')) {
                echo '<h1 class="title" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">' . get_field('titulo_toppage') . '</h1>';
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

    <!-- videos -->
    <section class="videos">
      <div class="container">
        <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">Vídeos sobre o editor do site</h2>
        <div class="grid-videos">
          <?php
            $videosargs = array(
              'post_type' 						 => 'videos',
              'post_status'            => 'publish',
              'tax_query'              => array(
                array(
                  'taxonomy' 	=> 'categories_videos',
                  'field' 		=> 'slug',
                  'terms' 		=> 'geral',
                )
              )
            );
            $videos = new WP_Query($videosargs);
            while ($videos->have_posts()) : $videos->the_post();
              get_template_part('template-parts/posts/content', 'video');
            endwhile;
            // wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>
    <!-- end:videos -->
    
    <!-- videos -->
    <section class="videos">
      <div class="container">
        <h2 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">Vídeos para sites Catálogo ou Loja Virtual</h2>
        <div class="grid-videos">
          <?php
            $videosargs = array(
              'post_type' 						 => 'videos',
              'post_status'            => 'publish',
              'tax_query'              => array(
                array(
                  'taxonomy' 	=> 'categories_videos',
                  'field' 		=> 'slug',
                  'terms' 		=> 'loja',
                )
              )
            );
            $videos = new WP_Query($videosargs);
            while ($videos->have_posts()) : $videos->the_post();
              get_template_part('template-parts/posts/content', 'video');
            endwhile;
            // wp_reset_postdata();
          ?>
        </div>
      </div>
    </section>
    <!-- end:videos -->

  </main>
  <!-- end:main -->

  <div class="modal-videos">
    <div class="content-video">
      <div class="video">
      </div>
      <a rel="dofollow" href="#" class="close modal-video-close">X</a>
    </div>
  </div>
<?php get_footer(); ?>




