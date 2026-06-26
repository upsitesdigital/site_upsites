<?php
/*
Template Name: Blog
*/
get_header();
?>

  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <section class="slideFull textBig ptop-125 blog-grid">
      <div class="container">
        <div class="grid">
          <div class="text pbottom-30">
            <div class="tag noBox" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
              <h3 class="subtitle"><?php the_title() ?></h3>
            </div>
            <h1 class="title" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s"><?php the_field('subtitulo_blog') ?></h1>
          </div>
          <div class="image pTop" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
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
            <div class="search-box" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
              <form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">
                <input type="text" autocomplete="off" class="search-field" placeholder="O que você procura?" value="<?php echo get_search_query(); ?>" name="s" />
                <button type="submit" class="search-submit">
                  <svg class="icon">
                    <use xlink:href="<?php echo get_template_directory_uri(); ?>/assets/img/icons.svg#search"></use>
                  </svg>
                </button>
              </form>
            </div>
            <h3 data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">CATEGORIAS</h3>
            <nav data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
              <ul>
                <?php
                $args = array('orderby' => 'name', 'parent' => 0);
                $categories = get_categories($args);
                foreach($categories as $category) {
                  $act = $termName == $category->name ? 'act' : '' ;
                  echo '<li class="' . $act . '"><a rel="dofollow" href="' . get_category_link($category->term_id) . '" title="' . $category->name . '">' . $category->name . '</a>';
                  
                  $args2 = array('orderby' => 'name', 'parent' => $category->cat_ID);
                  $subcategories = get_categories( $args2 );
                  //var_dump($subcategories);
                  if($subcategories) {
                    echo '<ul class="subcat">';

                    // While listing top level categories
                    // list their child categories
                    foreach ($subcategories as $subcategory) {
                        $actsub = $termName == $subcategory->name ? 'act' : '' ;
                        echo '<li class="' . $actsub . '"><a rel="dofollow" href="' . get_category_link($subcategory->term_id) . '" title="' . $subcategory->name . '">' . $subcategory->cat_name . '</a></li>';
                    }

                    echo '</ul>';
                  }
                  echo '</li>';
                }
                ?>
              </ul>
            </nav>
            <div class="banner" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.5s">
              <?php 
                if(get_field('banner_img_blog_lateral')) {
                  if(get_field('banner_img_link_blog_lateral')) {
                    echo '<a rel="dofollow" href="'.get_field('banner_img_link_blog_lateral').'">';
                  }
                  echo wp_get_attachment_image(get_field('banner_img_blog_lateral'), 'full');
                  if(get_field('banner_img_link_blog_lateral')) {
                    echo '</a>';
                  }
                }

                if(get_field('banner_js_blog_lateral')) {
                  echo get_field('banner_js_blog_lateral');
                }
              ?>
            </div>
          </div>
          <div class="content">
            
            <div class="list">
              <?php
								$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
								$postargs = array(
									'post_type' 						 => 'post',
									'paged' 								 => $paged,
									'post_status'            => 'publish',
                  'category__not_in'       => get_category_by_slug('notin'),
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




