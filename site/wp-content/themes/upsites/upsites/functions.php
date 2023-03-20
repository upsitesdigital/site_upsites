<?php
/* url da pasta upsites no thema */
$upsites = get_template_directory() . '/upsites/';

/** 
 * After theme setup hook actions
 */
add_action('after_setup_theme', function () {

  add_theme_support('widgets');
  add_theme_support('woocommerce');
  add_theme_support('wc-product-gallery-zoom');
  add_theme_support('wc-product-gallery-lightbox');
  add_theme_support('wc-product-gallery-slider');
  add_theme_support('title-tag');
  add_theme_support('post-thumbnails');

  add_image_size('portfolio-thumb', 361, 304, true);

  // This theme uses wp_nav_menu() in two locations.
  register_nav_menus(
    array(
      'menu' => __('Top Menu', 'upsites'),
      'menublog' => __('Top Menu blog', 'upsites'),
      'menuportfolio' => __('Top Menu portfolio', 'upsites'),
      'menuseo' => __('Top Menu seo', 'upsites'),
      'menushop' => __('Top Menu shop', 'upsites'),
      'menusignaturesite' => __('Top Menu signaturesite', 'upsites'),
      'menufooter' => __('Footer Menu', 'upsites'),
      'menudown' => __('Downloads Menu', 'upsites'),
    )
  );
  add_theme_support(
    'custom-logo',
    array(
      'height'      => 197,
      'width'       => 50,
      'flex-height' => true,
      'flex-width'  => true,
    )
  );
});


/** 
 * Load theme assets
 */
add_action('wp_enqueue_scripts', function () {
  $assets_src = get_template_directory_uri() . '/assets';
  $version = wp_get_theme()->get('Version');

  // Load theme style
  if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
    wp_enqueue_style('theme', "{$assets_src}/css/main.css", [], $version, 'all');
  } else {
    wp_enqueue_style('theme', "{$assets_src}/css/main.min.css", [], $version, 'all');
  }

  // Load theme 
  wp_enqueue_script('cookie', "//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js", ['jquery'], $version, true);
  wp_enqueue_script('mask', "https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.10.3/jquery.mask.min.js", ['jquery'], $version, true);
  if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
    wp_enqueue_script('theme', "{$assets_src}/js/bundle.js", ['jquery'], $version, true);
  } else {
    wp_enqueue_script('theme', "{$assets_src}/js/bundle.min.js", ['jquery'], $version, true);
  }

  wp_localize_script('theme', 'usAjax', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce'   => wp_create_nonce('nonce')
  ));
  wp_enqueue_script('theme');
}, 999, 1);

add_action('admin_enqueue_scripts', function () {
  $assets_src = get_template_directory_uri() . '/assets';
  $version = wp_get_theme()->get('Version');

  wp_enqueue_style('admincss', "{$assets_src}/css/admin.css", [], $version, 'all');

});

/** 
 * Category
 */
function US_term_list($ID, $cat)
{
  //echo $cat;
  $term_list = wp_get_post_terms($ID, $cat, ['fields' => 'all']);
  $primary_term_bkp = $term_list[0]->name;
  $primary_termid_bkp = $term_list[0]->term_id;
  $primary_term = '';
  $primary_termid = '';

  foreach ($term_list as $term) {
    if (get_post_meta($ID, '_yoast_wpseo_primary_' . $cat, true) == $term->term_id) {
      $primary_term = $term->name;
      $primary_termid = $term->term_id;
    }
  }
  $primary_term = ($primary_term !== '') ? $primary_term : $primary_term_bkp;
  $primary_termid = ($primary_termid !== '') ? $primary_termid : $primary_termid_bkp;
  return '<a href="' . get_category_link($primary_termid) . '" class="tag">' . $primary_term . '</a>';
}


function US_paging_nav($posts, $paged, $maxpages)
{

  /** Stop execution if there's only 1 page */
  if ($posts->max_num_pages <= 1)
    return;

  //$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
  $max   = intval($maxpages);

  /** Add current page to the array */
  if ($paged >= 1)
    $links[] = $paged;

  /** Add the pages around the current page to the array */
  if ($paged >= 3) {
    $links[] = $paged - 1;
    $links[] = $paged - 2;
  }

  if (($paged + 2) <= $max) {
    $links[] = $paged + 2;
    $links[] = $paged + 1;
  }

  echo '<div class="paginations">' . "\n";

  /** Previous Post Link */
  if (get_previous_posts_link()) {
    
    printf('<a href="%s" id="slick-prev" class="slick-prev slick-arrow" aria-label="Previous"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrowSlide"></use></svg></a>' . "\n", get_previous_posts_page_link());
  } else {
    printf('<a href="#" id="slick-prev" class="slick-prev slick-arrow" aria-label="Previous"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrowSlide"></use></svg></a>' . "\n", get_previous_posts_page_link());
  }
  echo '<div class="pagingInfo">';
  /** Link to first page, plus ellipses if necessary */
  if($paged <= 9) {
    echo '0' . $paged;
  } else {
    echo $paged;
  }
  echo ' • ';
  if($maxpages <= 9) {
    echo '0' . $maxpages;
  } else {
    echo $maxpages;
  }
  echo '</div>';
  /** Next Post Link */
  if (get_next_posts_link('next', $posts->max_num_pages)) {
    printf('<a href="%s" id="slick-next" class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrowSlide"></use></svg></a>' . "\n", get_next_posts_page_link());
  } else {
    printf('<a href="#" id="slick-next" class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrowSlide"></use></svg></a>' . "\n", get_next_posts_page_link());
  }
  echo '</div>' . "\n";
}

function searchFilter($query)
{
  if ($query->is_search) {
    $type = $_GET['post_type'];
    if (isset($query->query_vars['post_type'])) {
      if ($type == 'downloads') {
        $query->set('post_type', $type);
        return locate_template('search-download.php');
      }
    } else {
      $query->set('post_type', 'post');
    }
  }
  /*if ($query->is_search) {
    if (!isset($query->query_vars['post_type'])) {
      $query->set('post_type', 'post');
    }
  }*/
  return $query;
}
add_filter('pre_get_posts', 'searchFilter');

function get_load_more() {
  $ajaxpostsArgs = array(
    'post_type' => $_POST['type'],
    'posts_per_page' => 6,
    'order' => 'DESC',
    'post_status' => 'publish',
    'paged' => $_POST['page'],

  );
  if ($_POST['cat'] != 'Todos') {
    $ajaxpostsArgs['tax_query'] = array(
      array(
        'taxonomy' => $_POST['tax'],
        'field' => 'slug',
        'terms' => $_POST['cat']
      )
    );
  }
  $ajaxposts = new WP_Query($ajaxpostsArgs);
  $response = '';
  $t = [];

  if($ajaxposts->have_posts()) {
    while($ajaxposts->have_posts()) : $ajaxposts->the_post();
      //echo $t++;
      if($_POST['type'] == 'portifolios') {
        $response .= get_template_part('template-parts/posts/content', 'portifolio');
      }
      if($_POST['type'] == 'templates') {
        $response .= get_template_part('template-parts/posts/content', 'template');
      }
      
    endwhile;
  } else {
    $response = '';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_get_load_more', 'get_load_more');
add_action('wp_ajax_nopriv_get_load_more', 'get_load_more');

function US_add_my_tc_button() {
  global $typenow;
  // check user permissions
  if ( !current_user_can('edit_posts') && !current_user_can('edit_pages') ) {
  return;
  }
  // verify the post type
  if( ! in_array( $typenow, array( 'post', 'page' ) ) )
      return;
  // check if WYSIWYG is enabled
  if ( get_user_option('rich_editing') == 'true') {
      add_filter("mce_external_plugins", "US_add_tinymce_plugin");
      add_filter('mce_buttons', 'US_register_my_tc_button');
  }
}
add_action('admin_head', 'US_add_my_tc_button');

function US_add_tinymce_plugin($plugin_array) {
  $assets_src = get_template_directory_uri() . '/assets';
  $plugin_array['US_tc_button'] = get_template_directory_uri() . '/assets/js/text-button.js'; // CHANGE THE BUTTON SCRIPT HERE
  return $plugin_array;
}

function US_register_my_tc_button($buttons) {
  array_push($buttons, "US_tc_button");
  return $buttons;
}

function auto_id_headings( $content ) {

	$content = preg_replace_callback( '/(\<h[1-6](.*?))\>(.*)(<\/h[1-6]>)/i', function( $matches ) {
		if ( ! stripos( $matches[0], 'id=' ) ) :
			$matches[0] = $matches[1] . $matches[2] . ' id="' . sanitize_title( $matches[3] ) . '">' . $matches[3] . $matches[4];
		endif;
		return $matches[0];
	}, $content );

    return $content;

}
add_filter( 'the_content', 'auto_id_headings' );

/* CUSTOMIZER_REPEATER_VERSION */
define('CUSTOMIZER_REPEATER_VERSION', '1.1.0');
require $upsites . 'customizer-repeater/inc/customizer.php';

/* US_SET_POST_VIEWS */
define('US_SET_POST_VIEWS', '1.1.0');
require $upsites . 'post-views/post-views.php';

/* US_CUSTOMIZER_CONTROLS */
define('US_CUSTOMIZER_CONTROLS', '1.1.0');
require $upsites . 'customizer-controls/customizer-controls.php';

/* US_CUSTOMIZER_REGISTER */
define('US_CUSTOMIZER_REGISTER', '1.1.0');
require $upsites . 'customizer-register/customizer-register.php';

/* US_COMMENTS */
define('US_COMMENTS', '1.1.0');
require $upsites . 'comments/comments.php';

/* US_PAGINATION */
define('US_PAGINATION', '1.1.0');
require $upsites . 'pagination/pagination.php';
