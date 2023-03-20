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
$phone 						= get_theme_mod('US_phone');
$phone_custom 		= str_replace(array('(', ')', '-', ' '), "", $phone);
$text_copyright 	= get_theme_mod('US_text_copyright');
$logo_white    		= get_theme_mod('US_logo_white');

$class_head = '';
if(is_page_template( 'template-pages/portifolios.php' ) or is_tax( 'categories_portifolios' ) or is_page_template( 'template-pages/signature-site.php' ) or is_tax( 'categories_templates' ) or is_page_template( 'template-pages/shop.php' )) {
	$class_head = 'blue';
}
?>
  <!-- header -->
  <header id="top" class="<?= $class_head ?>">
    <div class="container">
      <div class="grid">
        <div class="item logo">
					<?php
					$the_custom_logo = get_theme_mod('custom_logo');
					$site_name = get_bloginfo('name');
					$tagline   = get_bloginfo('description', 'display');
					if (function_exists('the_custom_logo') &&  has_custom_logo()) {
						echo '<a class="logo-normal" href="' . esc_url(home_url('/')) . '" rel="home" title="' . get_bloginfo('name') . '"><img src="' . esc_url(wp_get_attachment_url(get_theme_mod('custom_logo'))) . '" alt="' . get_bloginfo('name') . '"  /></a>';
						if($class_head == 'blue' && $logo_white != '') {
							echo '<a class="logo-white" href="' . esc_url(home_url('/')) . '" rel="home" title="' . get_bloginfo('name') . '">' . wp_get_attachment_image(attachment_url_to_postid($logo_white), 'full') . '</a>';
						}
					}
					?>
        </div>
        <div class="item menu">
          <a href="#" id="open-menu" class="">
            <div class="ani">
              <svg class="close" width="30" height="30" viewBox="0 0 100 100">
                <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                <path class="line line2" d="M 20,50 H 80" />
                <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
              </svg>
            </div>
          </a>
          <?php 
					if(is_page_template( 'template-pages/blog.php' ) or is_category()) {
						$nenu = 'menublog';
					}
					if(is_page_template( 'template-pages/portifolios.php' ) or is_tax( 'categories_portifolios' )) {
						$nenu = 'menuportfolio';
					}
					if(is_page_template( 'template-pages/seo.php' )) {
						$nenu = 'menuseo';
					}
					if(is_page_template( 'template-pages/shop.php' )) {
						$nenu = 'menushop';
					}
					if(is_page_template( 'template-pages/signature-site.php' ) or is_tax( 'categories_templates' )) {
						$nenu = 'menusignaturesite';
					}
					if (has_nav_menu($nenu)) {
						$itemsWrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
						wp_nav_menu(
							array(
								'theme_location'       => $nenu,
								'menu'                 => '',
								'container'            => 'ul',
								'container_class'      => 'menu',
								'container_id'         => '',
								'container_aria_label' => '',
								'menu_class'           => '',
								'menu_id'              => '',
								'echo'                 => true,
								'fallback_cb'          => 'wp_page_menu',
								'before'               => '',
								'after'                => '',
								'link_before'          => '',
								'link_after'           => '',
								'items_wrap'           => $itemsWrap,
								'item_spacing'         => 'preserve',
								'depth'                => 0,
								'walker'               => '',
							)
						);
					} else {
						if (has_nav_menu('menu')) :
							$itemsWrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
							wp_nav_menu(
								array(
									'theme_location'       => 'menu',
									'menu'                 => '',
									'container'            => 'ul',
									'container_class'      => 'menu',
									'container_id'         => '',
									'container_aria_label' => '',
									'menu_class'           => '',
									'menu_id'              => '',
									'echo'                 => true,
									'fallback_cb'          => 'wp_page_menu',
									'before'               => '',
									'after'                => '',
									'link_before'          => '',
									'link_after'           => '',
									'items_wrap'           => $itemsWrap,
									'item_spacing'         => 'preserve',
									'depth'                => 0,
									'walker'               => '',
								)
							);
						endif;
					}; ?>
        </div>
        <div class="item phone">
					<?php 
						if($phone != '') {
							echo '<a href="tel:+' . $phone_custom . '">
								<svg class="icon">
									<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#phone"></use>
								</svg> ' . $phone . '
							</a>';
						}	
					?>
        </div>
      </div>
    </div>
  </header>
  <!-- end:header -->