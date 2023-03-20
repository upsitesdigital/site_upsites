<?php
/*
Template Name: Blog
*/
get_header();
?>

  <!-- main -->
  <main>
    <!-- slideFull -->
    <section class="slideFull textBig ptop-125">
      <div class="container">
        <div class="grid">
          <div class="text pbottom-30">
            <div class="tag noBox">
              <b><?php the_title() ?></b>
            </div>
            <h1><?php the_field('subtitulo_blog') ?></h1>
          </div>
          <div class="image pTop">
            <img src="<?= get_template_directory_uri() ?>/assets/img/star.svg" alt="">
            <p class="ptop-20"><?php the_field('texto_de_apoio_blog') ?></p>
          </div>
        </div>
      </div>
    </section>
    <!-- end:slideFull -->

    <!-- listBlog -->
    <section class="listBlog">
      <div class="container">
        <hr>
        <div class="grid">
          <div class="sidebar">
            <h3>CATEGORIAS</h3>
            <nav>
              <ul>
                <?php
                $args = array('orderby' => 'name', 'parent' => 0);
                $categories = get_categories($args);
                foreach($categories as $category) {
                  $act = $termName == $category->name ? 'act' : '' ;
                  echo '<li class="' . $act . '"><a href="' . get_category_link($category->term_id) . '" title="' . $category->name . '">' . $category->name . '</a>';
                  
                  $args2 = array('orderby' => 'name', 'parent' => $category->cat_ID);
                  $subcategories = get_categories( $args2 );
                  //var_dump($subcategories);
                  if($subcategories) {
                    echo '<ul class="subcat">';

                    // While listing top level categories
                    // list their child categories
                    foreach ($subcategories as $subcategory) {
                        $actsub = $termName == $subcategory->name ? 'act' : '' ;
                        echo '<li class="' . $actsub . '"><a href="' . get_category_link($subcategory->term_id) . '" title="' . $subcategory->name . '">' . $subcategory->cat_name . '</a></li>';
                    }

                    echo '</ul>';
                  }
                  echo '</li>';
                }
                ?>
              </ul>
            </nav>
          </div>
          <div class="content">
            <div class="banner">
            <?php 
              if(get_field('banner_blog')) {
                if(get_field('link_banner_blog')) {
                  echo '<a href="'.get_field('link_banner_blog').'">';
                }
                echo wp_get_attachment_image(get_field('banner_blog'), 'full');
                if(get_field('link_banner_blog')) {
                  echo '</a>';
                }
              }
            ?>
            </div>
            <div class="list">
              <?php
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$postargs = array(
									'post_type' 						 => 'post',
									'paged' 								 => $paged,
									'post_status'            => 'publish',
								);
								$postcat = new WP_Query($postargs);
								$maxpages = $postcat->max_num_pages;
								while ($postcat->have_posts()) : $postcat->the_post();
									get_template_part('template-parts/posts/content', 'blog');
								endwhile;
								// wp_reset_postdata();
							?>
            </div>
            <?php US_paging_nav($postcat, $paged, $maxpages); ?>
          </div>
        </div>
      </div>
    </section>
    <!-- end:listBlog -->

  </main>
  <!-- end:main -->

<?php get_footer(); ?>




