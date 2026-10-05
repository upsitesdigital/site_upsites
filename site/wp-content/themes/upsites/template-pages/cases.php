<?php
/*
Template Name: Cases
*/
get_header();
?>

  <!-- main -->
  <main id="main">
    
    <section class="hero-case">
      <div class="container">
        <div class="text">
          <span class="tag">
            <b><?= get_field("subtitle_cases") ?></b>
          </span>
          <h1 class="title"><?= get_field("title_cases") ?></h1>
          <p><?= get_field("text_cases") ?></p>
        </div>
      </div>
    </section>

    <section class="cases">
      <div class="container">
        <div class="filters">
          <div class="list-filters">
          </div>
          <div class="filter-btns">
            <div class="search"><img src="<?= get_bloginfo("template_url") ?>/assets/img/search-minus.svg" alt=""></div>
            <a href="#" class="adjustments">
              <img src="<?= get_bloginfo("template_url") ?>/assets/img/icon-adjustments.svg" alt="">
              filtros
            </a>
          </div>
        </div>
        <div class="list-cases">
          <?php
            $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
            $postargs = array(
              'post_type' 						 => 'cases',
              'order'                  => 'DESC',
              'posts_per_page'         => -1,
              //'paged' 								 => $paged,
              'post_status'            => 'publish',
            );
            $postcat = new WP_Query($postargs);
            $maxpages = $postcat->max_num_pages;
            while ($postcat->have_posts()) : $postcat->the_post();
              get_template_part('template-parts/posts/content', 'cases');
            endwhile;
            wp_reset_postdata();
          ?>
        </div>
        <?php // US_paging_nav($postcat, $paged, $maxpages); ?>
      </div>
    </section>

    <section class="cta-case">
      <div class="container">
        <div class="grid">
          <div class="text">
            <span class="subtitle"><?= get_field("subtitle_ctacases") ?></span>
            <h2 class="title"><?= get_field("title_ctacases") ?></h2>
            <p><?= get_field("text_ctacases") ?></p>
            <?php 
              if(get_field("linkbtn_ctacases")) {
                echo '<a rel="dofollow" href="' . get_field("linkbtn_ctacases") . '" class="btnBudgets">
                  <svg class="icon"><use xlink:href="' . get_bloginfo("template_url") . '/assets/img/icons.svg#ray"></use></svg> 
                  ' . get_field("textbtn_ctacases") . '
                </a>';
              }
            ?>
          </div>
          <div class="image">
            <?= wp_get_attachment_image(get_field('image_ctacases'), 'full') ?>
          </div>
        </div>
      </div>
    </section>

    <div class="menu-filter-box">
      <div class="scroll">
        <div class="header">
          <h3>filtros</h3>
          <a href="#" class="close">
            <img src="<?= get_bloginfo("template_url") ?>/assets/img/close.svg" alt="">
          </a>
        </div>
        <div class="box">
          <h4>Tipos de Site</h4>
          <ul>
            <?php
              $typesargs = array(
                'taxonomy'    => 'types_cases',
                'hide_empty'  => false,
                'orderby'     => 'name',
                'order'       => 'ASC'
              );
              $types = get_categories($typesargs);
              foreach($types as $type) {
                echo '<li>
                  <input type="checkbox" name="filter" data-tax="types_cases" data-name="'.$type->name.'" value="'.$type->slug.'">
                  <a href="#">
                    '.$type->name.'
                    <div class="checkbox">
                      <svg class="icon"><use xlink:href="'. get_bloginfo("template_url") .'/assets/img/icons.svg?v=01#checked"></use></svg>
                    </div>
                  </a>
                </li>';
              }
            ?>
          </ul>
        </div>
        <div class="box">
          <h4>Nicho</h4>
          <ul>
            <?php
              $catsargs = array(
                'taxonomy'    => 'categories_cases',
                'hide_empty'  => false,
                'orderby'     => 'name',
                'order'       => 'ASC'
              );
              $cats = get_categories($catsargs);
              foreach($cats as $cat) {
                echo '<li>
                  <input type="checkbox" name="filter" data-tax="categories_cases" data-name="'.$cat->name.'" value="'.$cat->slug.'">
                  <a href="#">
                    '.$cat->name.'
                    <div class="checkbox">
                      <svg class="icon"><use xlink:href="'. get_bloginfo("template_url") .'/assets/img/icons.svg?v=01#checked"></use></svg>
                    </div>
                  </a>
                </li>';
              }
            ?>
          </ul>
        </div>
        <div class="box last-child">
          <h4>Tecnologia</h4>
          <ul>
            <?php
              $technologiesargs = array(
                'taxonomy'    => 'technologies_cases',
                'hide_empty'  => false,
                'orderby'     => 'name',
                'order'       => 'ASC'
              );
              $technologies = get_categories($technologiesargs);
              foreach($technologies as $technology) {
                echo '<li>
                  <input type="checkbox" name="filter" data-tax="technologies_cases" data-name="'.$technology->name.'" value="'.$technology->slug.'">
                  <a href="#">
                    '.$technology->name.'
                    <div class="checkbox">
                      <svg class="icon"><use xlink:href="'. get_bloginfo("template_url") .'/assets/img/icons.svg?v=01#checked"></use></svg>
                    </div>
                  </a>
                </li>';
              }
            ?>
          </ul>
        </div>
      </div>
      <div class="footer">
        <button>FILTRA</button>
        <a href="#">CANCELAR</a>
      </div>
    </div>
  </main>
  <!-- end:main -->

<?php get_footer(); ?>




