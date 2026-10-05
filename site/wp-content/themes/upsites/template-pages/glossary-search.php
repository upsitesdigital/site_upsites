<?php
/*
Template Name: Glossary search
*/
get_header();

$id_glossario = get_page_by_path( 'glossario' );
$id_glossary_theme = get_page_by_path( 'glossario-tema' );
$id_glossary_search = get_page_by_path( 'glossario-search' );
$termGlossaryargs = array(
  'hierarchical' => 1,
  'show_option_none' => '',
  'hide_empty' => 0,
  'parent' => 0,
  'taxonomy' => 'term-glossary'
);
$termGlossarycats = get_categories($termGlossaryargs);

if (isset($_GET['search'])) {
  $searchparam = $_GET['search'];
}
?>

  <!-- main -->
  <main id="main">

    <section class="hero-glossary">
      <div class="container">
        <div class="grid-hero">
          <div class="text">
            <span class="subtitle"><?= get_field('subtitle_glossary'); ?></span>
            <h1 class="title"><?= get_field('title_glossary'); ?></h1>
            <p><?= get_field('text_glossary'); ?></p>
            <a href="#glossary" class="btn">
              Confira todos os termos
              <svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#arrowSlide"></use></svg>
            </a>
          </div>
          <div class="box-search">
            <div class="image">
              <img src="<?= get_bloginfo("template_url") ?>/assets/img/glossary-box-search.png" alt="">
            </div>
            <form id="search-glossary" class="search">
              <input type="text" placeholder="Busca" value="<?= $searchparam ?>">
              <button data-url="<?= get_permalink($id_glossary_search) ?>"><svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#search"></use></svg></button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section id="glossary" class="glossary">
      
      <div class="container">
        <?php 
          
          $countcat = 1;
          
          $args = array(
            'post_type' 						 => 'glossary',
            'post_status'            => 'publish',
            'posts_per_page' => -1,
          );
          if($searchparam != '') {
            $args['s'] = $searchparam;
            $args['search_columns'] = array( 'post_title' );
          }

          // Perform the query
          $query = new WP_Query( $args );
          if($query->have_posts()) {
            echo '<div class="list-search-glossary">';
              while ($query->have_posts()) : $query->the_post();
                echo '<div class="item">
                  <h3 class="title">' . get_the_title() . '</h3>
                  <p>' . get_the_excerpt() . '</p>
                  <a href="' . get_the_permalink() . '" class="btn">Saiba mais</a>
                </div>';
              endwhile;
            echo '</div>'; 
          } else {
            echo '<p>Nenhum artigo encontrado.</p>';
          }
          
        ?>

      </div>
    </section>
  </main>
  <!-- end:main -->

<?php get_footer(); ?>




