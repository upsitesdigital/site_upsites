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

  add_image_size('logos-thumb', 186, 118, true);
  add_image_size('portfolio-thumb', 361, 304, true);
  add_image_size('blog-thumb', 722, 608, true);

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
      'menufooterSevicos' => __('Footer Menu Seviços', 'upsites'),
      'menudown' => __('Downloads Menu', 'upsites'),
      'menumobile' => __('Mobile Menu', 'upsites'),
      'menusegmentos' => __('Segmentos Menu', 'upsites'),
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
  wp_dequeue_style( 'wp-block-library' );
  wp_dequeue_style( 'wp-block-library-theme' );
  wp_dequeue_style( 'wc-blocks-style' );

  $assets_src = get_template_directory_uri() . '/assets';
  $version = wp_get_theme()->get('Version');

  // Load theme style
  if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
    wp_enqueue_style('structure', "{$assets_src}/css/structure.css", [], $version, 'all');
  } else {
    wp_enqueue_style('structure', "{$assets_src}/css/structure.min.css", [], $version, 'all');
  }

  if(is_page_template( 'template-pages/home.php' ) or is_page_template( 'template-pages/home-old.php' ) or is_page_template( 'template-pages/home-new.php' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('home', "{$assets_src}/css/home.css", [], $version, 'all');
    } else {
      wp_enqueue_style('home', "{$assets_src}/css/home.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/signature-site.php' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('signaturesite', "{$assets_src}/css/signature-site.css", [], $version, 'all');
    } else {
      wp_enqueue_style('signaturesite', "{$assets_src}/css/signature-site.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/custom-page.php' )) {
    //var_dump(get_the_id());
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      
    } else {
      
    }
  } else if (is_page_template( 'template-pages/shop.php' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('shop', "{$assets_src}/css/shop.css", [], $version, 'all');
    } else {
      wp_enqueue_style('shop', "{$assets_src}/css/shop.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/seo.php' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('seo', "{$assets_src}/css/seo.css", [], $version, 'all');
    } else {
      wp_enqueue_style('seo', "{$assets_src}/css/seo.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/chat.php' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('chat', "{$assets_src}/css/chat.css", [], $version, 'all');
    } else {
      wp_enqueue_style('chat', "{$assets_src}/css/chat.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/cookies.php' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('cookies', "{$assets_src}/css/cookies.css", [], $version, 'all');
    } else {
      wp_enqueue_style('cookies', "{$assets_src}/css/cookies.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/segments.php' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('segments', "{$assets_src}/css/segments.css", [], $version, 'all');
    } else {
      wp_enqueue_style('segments', "{$assets_src}/css/segments.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/portifolios.php' ) or is_tax('categories_portifolios')) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('portfolio', "{$assets_src}/css/portfolio.css", [], $version, 'all');
    } else {
      wp_enqueue_style('portfolio', "{$assets_src}/css/portfolio.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/blog.php' ) or is_archive( )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('blog', "{$assets_src}/css/blog.css", [], $version, 'all');
    } else {
      wp_enqueue_style('blog', "{$assets_src}/css/blog.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/partners.php' ) or is_archive( )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('partners', "{$assets_src}/css/partners.css", [], $version, 'all');
    } else {
      wp_enqueue_style('partners', "{$assets_src}/css/partners.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/cases.php' ) or is_archive( )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('cases', "{$assets_src}/css/cases.css", [], $version, 'all');
    } else {
      wp_enqueue_style('cases', "{$assets_src}/css/cases.min.css", [], $version, 'screen');
    }
  } else if (is_page_template( 'template-pages/glossary.php' ) or is_page_template( 'template-pages/glossary-theme.php' ) or is_page_template( 'template-pages/glossary-search.php' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('glossary', "{$assets_src}/css/glossary.css", [], $version, 'all');
    } else {
      wp_enqueue_style('glossary', "{$assets_src}/css/glossary.min.css", [], $version, 'screen');
    }
  } else if (is_singular( 'glossary')) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('single-glossary', "{$assets_src}/css/single-glossary.css", [], $version, 'all');
    } else {
      wp_enqueue_style('single-glossary', "{$assets_src}/css/single-glossary.min.css", [], $version, 'screen');
    }
  } else if(is_singular( 'landings' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('landings', "{$assets_src}/css/landings.css", [], $version, 'all');
    } else {
      wp_enqueue_style('landings', "{$assets_src}/css/landings.min.css", [], $version, 'all');
    }
  } else if(is_singular( 'cases' )) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('single-cases', "{$assets_src}/css/single-cases.css", [], $version, 'all');
    } else {
      wp_enqueue_style('single-cases', "{$assets_src}/css/single-cases.min.css", [], $version, 'all');
      }
      wp_enqueue_style('fancyapps', "https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.css", [], $version, 'all');
      wp_enqueue_script('fancyappsJS', "https://cdn.jsdelivr.net/npm/@fancyapps/ui@6.1/dist/fancybox/fancybox.umd.js", ['jquery'], $version, array('strategy' => 'defer'));

    add_action('wp_head', function () {
      if( have_rows('fontslist_casesletter') ): 
        while( have_rows('fontslist_casesletter') ): the_row(); ?>
          <?php if(get_sub_field("origem") == 'file') { ?>
            <style>
            @font-face {
              font-family: '<?= get_sub_field("fontname") ?>';
              src: url('<?= get_sub_field("archive") ?>') format('woff');
            }
            </style>
          <?php } elseif(get_sub_field("origem") == 'google') { ?>
            <link rel="preconnect" href="https://fonts.googleapis.com">
            <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
            <link href="<?= get_sub_field("urlgoogle") ?>" rel="stylesheet">
          <?php }
        endwhile;
      endif;
    });
    wp_enqueue_script('beforeafter', "{$assets_src}/js/beforeafter.jquery.min.js", ['jquery'], $version, array('strategy' => 'defer'));
  } else if (is_single()) {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('postinternal', "{$assets_src}/css/post-internal.css", [], $version, 'all');
    } else {
      wp_enqueue_style('postinternal', "{$assets_src}/css/post-internal.min.css", [], $version, 'screen');
    }
  } else {
    if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
      wp_enqueue_style('theme', "{$assets_src}/css/main.css", [], $version, 'all');
    } else {
      wp_enqueue_style('theme', "{$assets_src}/css/main.min.css", [], $version, 'all');
    }
  }
  wp_enqueue_style('fontawesome', "{$assets_src}/css/font-awesome.min.css", [], $version, 'all');

  // Load theme 
  wp_enqueue_script('exitintent', "{$assets_src}/js/jquery.exitintent.min.js", ['jquery'], $version, array('strategy' => 'defer'));
  wp_enqueue_script('cookie', "//cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js", ['jquery'], $version, array('strategy' => 'defer'));
  wp_enqueue_script('mask', "https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.10.3/jquery.mask.min.js", ['jquery'], $version, array('strategy' => 'defer'));
  // wp_enqueue_script('scrollreveal', "{$assets_src}/js/scrollreveal.min.js", ['jquery'], $version, true);
  if (strpos(get_bloginfo('url'), 'local.wp4') !== false or strpos(get_bloginfo('url'), 'localhost') !== false) {
    wp_enqueue_script('theme', "{$assets_src}/js/bundle.js", ['jquery'], $version, array('strategy' => 'defer'));
  } else {
    wp_enqueue_script('theme', "{$assets_src}/js/bundle.min.js", ['jquery'], $version, array('strategy' => 'defer'));
  }

  wp_enqueue_script('clipboard', "https://cdnjs.cloudflare.com/ajax/libs/clipboard.js/2.0.6/clipboard.min.js", ['jquery'], $version, array('strategy' => 'defer'));
  if(is_singular( 'signatures' )) {
  }

  wp_localize_script('theme', 'usAjax', array(
    'ajaxurl' => admin_url('admin-ajax.php'),
    'nonce'   => wp_create_nonce('nonce')
  ));
  wp_enqueue_script('theme');
  wp_localize_script('theme', 'pathURL', array( 'templateurl' => get_bloginfo("template_url") ));
}, 999, 1);

add_action('admin_enqueue_scripts', function () {
  $assets_src = get_template_directory_uri() . '/assets';
  $version = wp_get_theme()->get('Version');

  wp_enqueue_style('admincss', "{$assets_src}/css/admin.css", [], $version, 'all');

});

/** 
 * Category
 */
function US_term_list($ID, $cat, $class)
{
  //echo $cat;
  $term_list = wp_get_post_terms($ID, $cat, ['fields' => 'all']);
  $primary_term_bkp = $term_list[0]->name;
  $primary_termid_bkp = $term_list[0]->term_id;
  $class = $class == '' ? 'tag' : $class ;
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
  if ($class == 'color') {
    return '<span class="tag" style="background-color: ' . get_field( "cor_cat", 'cat_faqs_' . $primary_termid ) . '">' . $primary_term . '</span>';
  } else if ($class == 'link') {
    return '<a rel="dofollow" href="' . get_category_link($primary_termid) . '" class="tag">' . $primary_term . '</a>';
  } else {
    return '<span class="' . $class . '">' . $primary_term . '</span>';
  }
  //return '<a rel="dofollow" href="' . get_category_link($primary_termid) . '" class="tag">' . $primary_term . '</a>';
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
    
    printf('<a rel="dofollow" href="%s" id="slick-prev" class="slick-prev slick-arrow" aria-label="Previous"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrowSlide"></use></svg></a>' . "\n", get_previous_posts_page_link());
  } else {
    printf('<a rel="dofollow" href="#" id="slick-prev" class="slick-prev slick-arrow" aria-label="Previous"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrowSlide"></use></svg></a>' . "\n", get_previous_posts_page_link());
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
    printf('<a rel="dofollow" href="%s" id="slick-next" class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrowSlide"></use></svg></a>' . "\n", get_next_posts_page_link());
  } else {
    printf('<a rel="dofollow" href="#" id="slick-next" class="slick-next slick-arrow" aria-label="Next" type="button"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#arrowSlide"></use></svg></a>' . "\n", get_next_posts_page_link());
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
    'posts_per_page' => 9,
    'order' => 'DESC',
    'post_status' => 'publish',
    'paged' => $_POST['page'],
  );
  $ajaxpostsArgs['tax_query'] = array();
  if ($_POST['cat'] != 'Todos') {
      array_push($ajaxpostsArgs['tax_query'], array(
        'taxonomy' => $_POST['tax'],
        'field' => 'slug',
        'terms' => $_POST['cat']
      ));
  }
  if ($_POST['seg'] != 'All') {
    array_push($ajaxpostsArgs['tax_query'], array(
      'taxonomy'  => 'segmentos_portifolios',
      'field'     => 'slug',
      'terms'     => $_POST['seg']
    ));
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



function get_load_cases() {
  $paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
  $ajaxpostsArgs = array(
    'post_type' => $_POST['type'],
    'order' => 'DESC',
    'posts_per_page' => -1,
    'post_status' => 'publish',
    'paged' => $paged,
  );
  $arraytax = json_decode(stripslashes($_POST['tax']));
  $types_cases = [];
  $categories_cases = [];
  $technologies_cases = [];
  $ajaxpostsArgs['tax_query'] = array('relation' => 'OR');
  foreach ($arraytax as $val) {
    if($val->tax === 'types_cases') {
      array_push($types_cases, $val->value);
    }
    if($val->tax === 'categories_cases') {
      array_push($categories_cases, $val->value);
    }
    if($val->tax === 'technologies_cases') {
      array_push($technologies_cases, $val->value);
    }
  }


  if (!empty($types_cases)) {
    array_push($ajaxpostsArgs['tax_query'], array(
      'taxonomy' => 'types_cases',
      'field' => 'slug',
      'terms' => $types_cases
    ));
  }
  if (!empty($categories_cases)) {
    array_push($ajaxpostsArgs['tax_query'], array(
      'taxonomy' => 'categories_cases',
      'field' => 'slug',
      'terms' => $categories_cases
    ));
  }
  if (!empty($technologies_cases)) {
    array_push($ajaxpostsArgs['tax_query'], array(
      'taxonomy' => 'technologies_cases',
      'field' => 'slug',
      'terms' => $technologies_cases
    ));
  }

  $ajaxposts = new WP_Query($ajaxpostsArgs);
  $maxpages = $ajaxposts->max_num_pages;
  $response = '';
  $result = [];
  $pag = '';

  if($ajaxposts->have_posts()) {
    while($ajaxposts->have_posts()) : $ajaxposts->the_post();
      //echo $t++;
      $response .= get_template_part('template-parts/posts/content', 'cases');
      
    endwhile;
    $pag = US_paging_nav($ajaxposts, $paged, $maxpages);
  } else {
    $response = '';
  }
  echo $response;
  exit;
}
add_action('wp_ajax_get_load_cases', 'get_load_cases');
add_action('wp_ajax_nopriv_get_load_cases', 'get_load_cases');



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
  $plugin_array['US_tc_button2'] = get_template_directory_uri() . '/assets/js/text-button.js'; // CHANGE THE BUTTON SCRIPT HERE
  $plugin_array['US_tc_button3'] = get_template_directory_uri() . '/assets/js/text-button.js'; // CHANGE THE BUTTON SCRIPT HERE
  $plugin_array['US_tc_button4'] = get_template_directory_uri() . '/assets/js/text-button.js'; // CHANGE THE BUTTON SCRIPT HERE
  $plugin_array['US_tc_button5'] = get_template_directory_uri() . '/assets/js/text-button.js'; // CHANGE THE BUTTON SCRIPT HERE
  return $plugin_array;
}

function US_register_my_tc_button($buttons) {
  array_push($buttons, "US_tc_button");
  array_push($buttons, "US_tc_button2");
  array_push($buttons, "US_tc_button3");
  array_push($buttons, "US_tc_button4");
  array_push($buttons, "US_tc_button5");
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

/* add_action('wp_footer', function () { ?>
  <style>
    #block-copyright {
      background-color: #f4f4f4;
    }
    #block-copyright .container-copyright {
      max-width: 1200px;
      padding: 20px 20px;
      margin: 0 auto;
      display: flex;
      justify-content: space-between;
    }
    #block-copyright .container-copyright p{
      font-size: 12px;
      color: #7E7E7E;
    }
  </style>
  <div id="block-copyright">
    <div class="container-copyright">
      <p>© <?= date('Y') ?> TODOS OS DIREITOS RESERVADOS – CNPJ: 25.139.884/0001-90</p>
      <p><a rel="dofollow" href="https://upsites.digital/" target="_blank" runtime_url="https://upsites.digital/" type="url">Criação de sites por UpSites</a></p>
    </div>
  </div>
<?php }); */

add_action('wp_head', function () { ?>
    <meta name="author" content="Upsites">
<?php }, 1, 20);


class WPDocs_Walker_Nav_Menu extends Walker_Nav_Menu {

	/**
	 * Starts the list before the elements are added.
	 *
	 * Adds classes to the unordered list sub-menus.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 */
	function start_lvl( &$output, $depth = 0, $args = array() ) {
		// Depth-dependent classes.
		$indent = ( $depth > 0  ? str_repeat( "\t", $depth ) : '' ); // code indent
		$display_depth = ( $depth + 1); // because it counts the first submenu as 0
		$classes = array(
			'sub-menu',
			( $display_depth % 2  ? 'menu-odd' : 'menu-even' ),
			( $display_depth >=2 ? 'sub-sub-menu' : '' ),
			'menu-depth-' . $display_depth
		);
		$class_names = implode( ' ', $classes );

		// Build HTML for output.
		$output .= "\n" . $indent . '<ul class="' . $class_names . '">' . "\n";
	}

	/**
	 * Start the element output.
	 *
	 * Adds main/sub-classes to the list items and links.
	 *
	 * @param string $output Passed by reference. Used to append additional content.
	 * @param object $item   Menu item data object.
	 * @param int    $depth  Depth of menu item. Used for padding.
	 * @param array  $args   An array of arguments. @see wp_nav_menu()
	 * @param int    $id     Current item ID.
	 */
	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		global $wp_query;
		$indent = ( $depth > 0 ? str_repeat( "\t", $depth ) : '' ); // code indent

		// Depth-dependent classes.
		$depth_classes = array(
			( $depth == 0 ? 'main-menu-item' : 'sub-menu-item' ),
			( $depth >=2 ? 'sub-sub-menu-item' : '' ),
			( $depth % 2 ? 'menu-item-odd' : 'menu-item-even' ),
			'menu-item-depth-' . $depth
		);
		$depth_class_names = esc_attr( implode( ' ', $depth_classes ) );

		// Passed classes.
		$classes = empty( $item->classes ) ? array() : (array) $item->classes;
		$class_names = esc_attr( implode( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item ) ) );

		// Build HTML.
		$output .= $indent . '<li id="nav-menu-item-'. $item->ID . '" class="' . $depth_class_names . ' ' . $class_names . '">';

		// Link attributes.
		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';
		$attributes .= ' class="menu-link ' . ( $depth > 0 ? 'sub-menu-link' : 'main-menu-link' ) . '"';
    $description = ! empty( $item->description ) ? esc_attr( $item->description ) : 'home';
		// Build HTML output and pass through the proper filter.
		$item_output = sprintf( '%1$s<a%2$s><div class="box-icon"><svg class="icon"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#'.$description.'"></use></svg></div>%3$s%4$s%5$s</a>%6$s',
			$args->before,
			$attributes,
			$args->link_before,
			apply_filters( 'the_title', $item->title, $item->ID ),
			$args->link_after,
			$args->after
		);
		$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
	}
}


/* basic shortcode */
function calltoaction($atts = [])
{
  ob_start();
  $link_budgets    		    = get_theme_mod('US_link_budgets');
  $slug = get_post_field( 'post_name', get_post() );
  $title = 'Precisando de um site profissional?';
  if(isset($atts["title"])) {
    $title = $atts["title"];
  }
  $text = 'Descubra quanto custa o seu site';
  if(isset($atts["text"])) {
    $text = $atts["text"];
  }
?>
<div class="box-banner-calltoaction">
  <div class="item">
    <h3><?= $title ?></h3>
    <p><?= $text ?></p>
    <a rel="dofollow" target="_blank" href="<?= $link_budgets ?>?origin=<?= $slug ?>" class="btnBudgets">
      <svg class="icon">
        <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use>
      </svg>
      Peça um Orçamento
    </a>
  </div>
  <div class="image">
    <img src="<?= get_template_directory_uri() ?>/assets/img/box-banner-calltoaction.svg" alt="">
  </div>
</div>
<?php
  return ob_get_clean();
}
add_shortcode('calltoaction', 'calltoaction');
/* end:basic shortcode */

add_filter( 'rank_math/json_ld', function( $data, $jsonld ) {
  if (isset( $data['publisher'] ) ) {
      unset( $data['publisher'] );
  }
  unset($data['place']);
  unset($data['WebSite']);
  unset($data['WebPage']);
  unset($data['webpage']);
  unset($data['ImageObject']);
  unset($data['ProfilePage']);
  unset($data['primaryImage']);
  unset($data['BreadcrumbList']);
  unset($data['BlogPosting']);
  return $data;
}, 99, 2);


add_filter('script_loader_tag', 'US_remove_type_attr', 10, 2);

function US_remove_type_attr($tag, $handle) {
  if (preg_match("/id=['\"]jquery-core-js['\"]/", $tag)) {
    return preg_replace( "/type=['\"]text\/(javascript|css)['\"]/", '', $tag );
  } else {
    return $tag;
  }
}

function uploadImg($imgFeatured) {
  $upload = wp_upload_bits($imgFeatured["name"], null, file_get_contents($imgFeatured["tmp_name"]));
  $filename = $upload['file'];


  $uploadfile = $uploaddir['basedir'] . '/'. 'custom-uploads' . '/';
  move_uploaded_file($filename, $uploadfile);
  $wp_filetype = wp_check_filetype($filename, null );
  $attachment = array(
    'post_mime_type' => $wp_filetype['type'],
    'post_title' => sanitize_file_name($filename),
    'post_content' => '',
    'post_status' => 'inherit'
  );
  $attach_id = wp_insert_attachment( $attachment, $filename, '' );
  require_once(ABSPATH . 'wp-admin/includes/image.php');
  $attach_data = wp_generate_attachment_metadata( $attach_id, $filename );
  wp_update_attachment_metadata( $attach_id, $attach_data );
  
  return $attach_id;
}
function create_signature() {
  $name = $_POST['name'];
  $office = $_POST['office'];
  $mail = $_POST['mail'];
  $phone = $_POST['phone'];
  $avatar = $_FILES['file'];

  $post = array(
    'post_title'    => $name,
    'post_status'   => 'publish',
    'post_type'   => 'signatures'
  );
  $post_id = wp_insert_post( $post );
  add_post_meta($post_id, 'office_signature', $office, true);
  add_post_meta($post_id, 'email_signature', $mail, true);
  add_post_meta($post_id, 'phone_signature', $phone, true);

  $image = set_post_thumbnail( $post_id, uploadImg($avatar) );

  return wp_send_json_success(array('url' => get_the_permalink( $post_id ) ));

  exit;
}
add_action('wp_ajax_create_signature', 'create_signature');
add_action('wp_ajax_nopriv_create_signature', 'create_signature');

add_filter( 'acf/fields/wysiwyg/toolbars' , 'my_toolbars'  );
function my_toolbars( $toolbars )
{
    $toolbars['Very Simple' ] = array();
    $toolbars['Very Simple' ][1] = array('bold' , 'bullist' );
    return $toolbars;
}




function get_load_segment() {
  $ajaxpostsArgs = array(
    'post_type' => $_POST['type'],
    'posts_per_page' => -1,
    'order' => 'DESC',
    'post_status' => 'publish',
    //'paged' => $_POST['page'],
  );
  $ajaxpostsArgs['tax_query'] = array();
  if ($_POST['cat'] != 'all') {
      array_push($ajaxpostsArgs['tax_query'], array(
        'taxonomy' => $_POST['tax'],
        'field' => 'slug',
        'terms' => $_POST['cat']
      ));
  }

  $ajaxposts = new WP_Query($ajaxpostsArgs);
  $response = '';
  $t = [];

  if($ajaxposts->have_posts()) {
    while($ajaxposts->have_posts()) : $ajaxposts->the_post();
      //echo $t++;
      $response .= '<a href="' . get_the_permalink() . '" class="item">
                <div class="box-icon" style="background-color: '.  get_field('cor_seglanding') . ';">
                  ' . wp_get_attachment_image(get_field('icone_seglanding'), 'full') . '
                </div>
                <h3>Site para ' . get_field('texto_seglanding') . '</h3>
              </a>';
      
    endwhile;
  } else {
    $response = '';
  }

  echo $response;
  exit;
}
add_action('wp_ajax_get_load_segment', 'get_load_segment');
add_action('wp_ajax_nopriv_get_load_segment', 'get_load_segment');


function custom_mime_types($mimes) {
    $mimes['woff'] = 'font/woff';
    
    return $mimes;
}
add_filter('upload_mimes', 'custom_mime_types');


add_filter('trp_flags_path', 'trpc_flags_path', 10, 2);
function trpc_flags_path($original_flags_path, $language_code)
{

  // only change the folder path for the following languages:
  $languages_with_custom_flags = array('en_US', 'pt_BR', 'es_ES');

  if (in_array($language_code, $languages_with_custom_flags)) {
    return get_stylesheet_directory_uri() . '/assets/img/flags/';
  } else {
    return $original_flags_path;
  }
}


add_filter('rank_math/frontend/robots', function ($robots) {
  if (is_page_template( 'template-pages/budgets.php' )) {
    return ['noindex', 'nofollow'];
  }
  return $robots;
});


add_filter( 'user_contactmethods', function( $methods ) {
    $methods['linkedin'] = 'LinkedIn URL';
    return $methods;
});



function US_set_post_like($postID)
{
  $count_key = 'US_post_like_count';
  $count = get_post_meta($postID, $count_key, true);
  if ($count == '') {
    $count = 0;
    delete_post_meta($postID, $count_key);
    add_post_meta($postID, $count_key, '1');
  } else {
    $count++;
    update_post_meta($postID, $count_key, $count);
  }
}
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);

function get_load_like() {
  $id = $_POST['id'];
  
  US_set_post_like(intval($id));
  echo get_post_meta(intval($id), 'US_post_like_count', true);
  exit;
}
add_action('wp_ajax_get_load_like', 'get_load_like');
add_action('wp_ajax_nopriv_get_load_like', 'get_load_like');