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
$tax       = get_queried_object()->taxonomy;
$term      = get_queried_object()->slug;
$termID    = get_queried_object()->term_id;
$termName  = get_queried_object()->name;

$id_blog = get_page_by_path( 'blog' );
$post_content = get_post($id_blog);
?>
  <!-- main -->
  <main id="main">
    <!-- slideFull -->
    <?php if(category_description( $termID ) != '') { ?>
      <section class="slideFull textMedium text-center max-width">
        <div class="container">
          <div class="grid">
            <div class="text">
              <div class="tag noBox" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                <span><?= $termName ?></span>
              </div>
              <div data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s">
              <?php 
                $title = explode("<p>", category_description( $termID ));
                echo apply_filters('the_content', $title[0]);
                $content = explode("</h1>", category_description( $termID ));
                echo '<div id="shortContent">';
                echo apply_filters('the_content', $content[1]);
                //echo '<p><a href="#" id="readMore">Leia mais</a></p>';
                echo '</div>';
                /*echo '<div id="largeContent">';
                echo apply_filters('the_content', $content[1]);
                echo '<p><a href="#" id="readLess">Leia menos</a></p>';
                echo '</div>';*/

                //echo category_description( $termID );
                if(get_field('texto_botao_toppagecat', get_queried_object())) {
                  echo '<a rel="dofollow" href="' . get_field('link_botao_toppagecat', get_queried_object()) . '" class="btnBudgets"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#ray"></use></svg> ' . get_field('texto_botao_toppagecat', get_queried_object()) . '</a>';
                }
              ?>
              </div>
            </div>
          </div>
        </div>
      </section>
    <?php } else {?>
      <section class="slideFull textBig">
        <div class="container">
          <div class="grid">
            <div class="text pbottom-30">
              <div class="tag noBox" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.2s">
                <span><?= $post_content->post_title ?></span>
              </div>
              <h1 class="title" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.3s"><?php the_field('subtitulo_blog', $id_blog) ?></h1>
            </div>
            <div class="image pTop" data-scroll-reveal="enter bottom move 50px over 0.6s after 0.4s">
              <img src="<?= get_template_directory_uri() ?>/assets/img/star.svg" alt="">
              <p class="ptop-20"><?php the_field('texto_de_apoio_blog', $id_blog) ?></p>
            </div>
          </div>
        </div>
      </section>
    <?php } ?>
    
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
                  $act = $term == $category->slug ? 'act' : '' ;
                  echo '<li class="' . $act . '"><a rel="dofollow" href="' . get_category_link($category->term_id) . '" title="' . $category->name . '">' . $category->name . '</a>';
                  
                  $args2 = array('orderby' => 'name', 'parent' => $category->cat_ID);
                  $subcategories = get_categories( $args2 );
                  //var_dump($subcategories);
                  if($subcategories) {
                    echo '<ul class="subcat">';

                    // While listing top level categories
                    // list their child categories
                    foreach ($subcategories as $subcategory) {
                        $actsub = $term == $subcategory->slug ? 'act' : '' ;
                        if($subcategory->name != 'notin') {
                          echo '<li class="' . $actsub . '"><a rel="dofollow" href="' . get_category_link($subcategory->term_id) . '" title="' . $subcategory->name . '">' . $subcategory->cat_name . '</a></li>';
                        }
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
                if(get_field('banner_img_blog_lateral', $id_blog)) {
                  if(get_field('banner_img_link_blog_lateral', $id_blog)) {
                    echo '<a rel="dofollow" href="'.get_field('banner_img_link_blog_lateral', $id_blog).'">';
                  }
                  echo wp_get_attachment_image(get_field('banner_img_blog_lateral', $id_blog), 'full');
                  if(get_field('banner_img_link_blog_lateral', $id_blog)) {
                    echo '</a>';
                  }
                }

                if(get_field('banner_js_blog_lateral', $id_blog)) {
                  echo get_field('banner_js_blog_lateral', $id_blog);
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
								);
								if ($term) {
									$postargs['tax_query'] = array(
										array(
											'taxonomy' 	=> $tax,
											'field' 		=> 'slug',
											'terms' 		=> $term,
										)
									);
								}
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
