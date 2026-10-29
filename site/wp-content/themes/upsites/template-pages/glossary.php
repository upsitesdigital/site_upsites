<?php
/*
Template Name: Glossary
*/
get_header();

$url_glossario = get_permalink();

// modos: por letras (padrão), por temas (?view=temas) e busca (?search=)
$searchparam = isset($_GET['search']) ? sanitize_text_field(wp_unslash($_GET['search'])) : '';
$is_search = $searchparam != '';
$is_theme = !$is_search && isset($_GET['view']) && $_GET['view'] == 'temas';
$taxonomy = $is_theme ? 'theme-glossary' : 'term-glossary';

$termGlossaryargs = array(
  'hierarchical' => 1,
  'show_option_none' => '',
  'hide_empty' => 0,
  'parent' => 0,
  'taxonomy' => $taxonomy
);
$termGlossarycats = $is_search ? array() : get_categories($termGlossaryargs);
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
            <?php if ($is_search) : ?>
            <a href="<?= $url_glossario ?>#glossary" class="btn">
              <svg class="icon norotate"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#arrowSlide"></use></svg>
              Voltar ao glossário completo
            </a>
            <?php else : ?>
            <a href="#glossary" class="btn">
              Confira todos os termos
              <svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#arrowSlide"></use></svg>
            </a>
            <?php endif; ?>
          </div>
          <div class="box-search">
            <div class="image">
              <img src="<?= get_bloginfo("template_url") ?>/assets/img/glossary-box-search.png" alt="">
            </div>
            <form id="search-glossary" class="search">
              <input type="text" placeholder="Busca" value="<?= esc_attr($searchparam) ?>">
              <button data-url="<?= $url_glossario ?>"><svg class="icon"><use xlink:href="<?= get_bloginfo("template_url") ?>/assets/img/icons.svg#search"></use></svg></button>
            </form>
          </div>
        </div>
      </div>
    </section>

    <section id="glossary" class="glossary">
      <?php if ($is_search) : ?>
      <div class="container">
        <?php
          $args = array(
            'post_type' 						 => 'glossary',
            'post_status'            => 'publish',
            'posts_per_page' => -1,
            's' => $searchparam,
            'search_columns' => array( 'post_title' ),
          );

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
          wp_reset_postdata();
        ?>
      </div>
      <?php else : ?>
      <div class="container">
        <div class="filter">
          <div class="btns">
            <a href="<?= $url_glossario ?>#glossary" class="btn<?= $is_theme ? '' : ' act' ?>">por letras</a>
            <a href="<?= add_query_arg('view', 'temas', $url_glossario) ?>#glossary" class="btn<?= $is_theme ? ' act' : '' ?>">por temas</a>
          </div>
        </div>
      </div>
      <div class="alphabet">
        <div class="container">
        <?php
          foreach ($termGlossarycats as $termGlossary):
            echo '<a href="#'.$termGlossary->name.'">'.$termGlossary->name.'</a>';
          endforeach;
        ?>
        </div>
      </div>
      <div class="container">
        <?php

          $countcat = 1;
          foreach ($termGlossarycats as $termGlossary):


            $args = array(
              'post_type' 						 => 'glossary',
							'post_status'            => 'publish',
              'posts_per_page' => -1,
              'tax_query' => array(
                array(
                  'taxonomy'  => $taxonomy,
                  'field'     => 'slug',
                  'terms'     => $termGlossary->slug
                ),
              )
            );
            // Perform the query
            $query = new WP_Query( $args );

            $classfirstchild = $countcat == 1 ? 'first-child' : '' ;
            echo '<div class="block-list '.$classfirstchild.'" id="'.$termGlossary->name.'">
              <div class="title">'.$termGlossary->name.'</div>
              <div class="grid-list">
                <ul>';
                while ($query->have_posts()) : $query->the_post();

                  echo '<li class="item"><a href="' . get_the_permalink() . '">' . get_the_title() . '</a></li>';
                endwhile;
                echo '</ul>';
            echo '</div>
            </div>';
            $countcat++;
          endforeach;
          wp_reset_postdata();
        ?>
      </div>
      <?php endif; ?>
    </section>
  </main>
  <!-- end:main -->

<?php get_footer(); ?>
