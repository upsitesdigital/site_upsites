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
$logo_mobile    		    = get_theme_mod('US_logo_mobile');

$phone 						= get_theme_mod('US_phone');
$phone_custom 		= '0'.str_replace(array('(', ')', '-', ' '), "", $phone);
$text_copyright 	= get_theme_mod('US_text_copyright');
$logo_white    		= get_theme_mod('US_logo_white');

$class_head = '';
if(is_page_template( 'template-pages/portifolios.php' ) 
	or is_page_template( 'template-pages/cookies.php' ) 
  or is_tax( 'categories_portifolios' ) 
	or is_page_template( 'template-pages/signature-site.php' ) 
	or is_page_template( 'template-pages/cases.php' ) 
	or is_tax( 'categories_templates' ) 
	or is_page_template( 'template-pages/shop.php' )) {
	$class_head = 'blue';
}
$bar_partners = '';
if(is_page_template('template-pages/signature-site.php')) {
	$bar_partners = 'white';
}
$link_whats             = get_theme_mod('US_link_whats');
$link_facebook          = get_theme_mod('US_link_facebook');
$link_instagram         = get_theme_mod('US_link_instagram');
$link_linkedin          = get_theme_mod('US_link_linkedin');
$link_pinterest         = get_theme_mod('US_link_pinterest');
?>
<!-- div id="loader-layer">
	<?php
		if ($logo_mobile != '') {
			echo wp_get_attachment_image(attachment_url_to_postid($logo_mobile), 'full', '', array( "loading" => "lazy" ));
		}
	?>
</div -->
<!-- header -->
 <?php 
 		if(
			is_home() 
			or is_page_template( 'template-pages/home.php' ) 
			or is_page_template( 'template-pages/home-old.php' ) 
			or is_page_template( 'template-pages/home-new.php' )
			or is_page_template( 'template-pages/seo.php' )
			or is_page_template( 'template-pages/chat.php' )
			or is_page_template( 'template-pages/blog.php' ) 
			or is_archive( )
			or is_single()
		) {
	 echo '<div id="bar-partners" class="<?= $bar_partners ?>">
		 <div class="container">
			 <a target="_blank" href="https://seo.upsites.digital/">
				 <b>Seu site está perdendo clientes? </b>
				 Receba uma análise de SEO gratuita!
				 <svg class="icon">
					 <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg?v=4#arrow-right"></use>
				 </svg>
			 </a>
		 </div>
	 </div>';
 }
?>
<header id="top" class="<?= $class_head ?>">
	<div class="container">
		<div class="grid">
			<div class="item logo">
				<?php
				$the_custom_logo = get_theme_mod('custom_logo');
				$site_name = get_bloginfo('name');
				$tagline   = get_bloginfo('description', 'display');
				if (function_exists('the_custom_logo') &&  has_custom_logo()) {
					echo '<a rel="dofollow Home" class="logo-normal" href="' . esc_url(home_url('/')) . '" title="' . get_bloginfo('name') . '">'.wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', '', array( "loading" => "lazy" )).'</a>';
					if($class_head == 'blue' && $logo_white != '') {
						echo '<a rel="dofollow Home" class="logo-white" href="' . esc_url(home_url('/')) . '" title="' . get_bloginfo('name') . '">' . wp_get_attachment_image(attachment_url_to_postid($logo_white), 'full', '', array( "loading" => "lazy" )) . '</a>';
					}
				}
				?>
			</div>
			<div class="item menu">
				
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
				}; 
				
				if(is_user_logged_in()) {
					if(!(is_page_template( 'template-pages/blog.php' ) or is_category())) {
						echo '<div class="lang">';
							$current_language = get_locale();
							$lang = trp_custom_language_switcher();  
							
							if ( apply_filters( 'trp_allow_tp_to_run', true ) ){
								foreach ($lang as $it){
									$itens = $it;
									if($current_language == $itens['language_code']) { 
										// var_dump($itens);
										echo '<a href="#" class="current" data-href="#" title="' . $itens['language_name'] . '">
											<div class="flag"><img src="' . $itens['flag_link'] . '" /></div>
										</a>';
									}
								}
								echo '<div class="submenulang submenu">';
								foreach ($lang as $it){
									$itens = $it;
									if($current_language != $itens['language_code']) {
										echo '<a href="#" data-href="' . $itens['current_page_url'] . '" title="' . $itens['language_name'] . '">
											<div class="flag"><img src="' . $itens['flag_link'] . '" /></div>
										</a>';
									}
								}
								echo '</div>';
							} 
						echo '</div>';
					}
				}
				?>
			</div>
			<div class="item phone">
				<?php 
					if($phone != '') {
						echo '<a rel="nofollow" href="tel:' . $phone_custom . '">
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
<header id="header-mobile">
	<ul>
		<li>
			<a rel="dofollow" href="<?= esc_url(home_url('/')) ?>">
				<svg class="icon">
					<use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#home"></use>
				</svg> Home
			</a>
		</li>
		<li>
			<?php
				if ($logo_mobile != '') {
					echo '<a rel="dofollow Mobile" href="' . esc_url(home_url('/')) . '" class="logo" title="' . get_bloginfo('name') . '">' . wp_get_attachment_image(attachment_url_to_postid($logo_mobile), 'full', '', array( "loading" => "lazy" )) . '</a>';
				}
			?>
		</li>
		<li>
			<?php 
				if(is_user_logged_in()) {
					if(!(is_page_template( 'template-pages/blog.php' ) or is_category())) {
						echo '<div class="lang">';
							$current_language = get_locale();
							$lang = trp_custom_language_switcher();  
							
							if ( apply_filters( 'trp_allow_tp_to_run', true ) ){
								foreach ($lang as $it){
									$itens = $it;
									if($current_language == $itens['language_code']) { 
										// var_dump($itens);
										echo '<a href="#" class="current" data-href="#" title="' . $itens['language_name'] . '">
											<div class="flag"><img src="' . $itens['flag_link'] . '" /></div>
										</a>';
									}
								}
								echo '<div class="submenulang submenu">';
								foreach ($lang as $it){
									$itens = $it;
									if($current_language != $itens['language_code']) {
										echo '<a href="#" data-href="' . $itens['current_page_url'] . '" title="' . $itens['language_name'] . '">
											<div class="flag"><img src="' . $itens['flag_link'] . '" /></div>
										</a>';
									}
								}
								echo '</div>';
							} 
						echo '</div>';
					}
				}
			?>
			<a rel="dofollow" href="#" id="open-menu" class="" aria-label="Abre menu">
				<div class="ani">
					<svg class="close" width="30" height="30" viewBox="0 0 100 100">
						<path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
						<path class="line line2" d="M 20,50 H 80" />
						<path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
					</svg>
				</div>
			</a>
			<div id="menu-mobile">
				<div class="logo-mobile">
					<?php
					$the_custom_logo = get_theme_mod('custom_logo');
					$site_name = get_bloginfo('name');
					$tagline   = get_bloginfo('description', 'display');
					if (function_exists('the_custom_logo') &&  has_custom_logo()) {
						echo '<a rel="dofollow Mobile-Menu" class="logo-normal" href="' . esc_url(home_url('/')) . '" title="' . get_bloginfo('name') . '">'.wp_get_attachment_image(get_theme_mod('custom_logo'), 'full', '', array( "loading" => "lazy" )).'</a>';
					}
					?>
				</div>
				<div class="box-menu">
					<?php 
					$itemsWrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
					wp_nav_menu(
						array(
							'theme_location'       => 'menumobile',
							'menu'                 => 'menu-mobile',
							'container'            => 'ul',
							'container_class'      => 'menu',
							'container_id'         => '',
							'container_aria_label' => '',
							'menu_class'           => 'menu-mobile',
							'menu_id'              => '',
							'echo'                 => true,
							'fallback_cb'          => 'wp_page_menu',
							'before'               => '',
							'after'                => '',
							'link_before'          => '',
							'link_after'           => '<i class="fa fa-angle-right" aria-hidden="true"></i>',
							'items_wrap'           => $itemsWrap,
							'item_spacing'         => 'preserve',
							'depth'                => 0,
							'walker'               => new WPDocs_Walker_Nav_Menu(),
						)
					);
					?>
				</div>
				<ul class="share">
					<?php
						if ($link_whats != '') {
							echo '<li><a rel="nofollow" href="' . $link_whats . '"><svg class="icon whats"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#whats"></use></svg></a></li>';
						}
						if ($link_facebook != '') {
							echo '<li><a rel="nofollow" href="' . $link_facebook . '"><svg class="icon facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#facebook"></use></svg></a></li>';
						}
						if ($link_instagram != '') {
							echo '<li><a rel="nofollow" href="' . $link_instagram . '"><svg class="icon instagram"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#instagram"></use></svg></a></li>';
						}
						if ($link_linkedin != '') {
							echo '<li><a rel="nofollow" href="' . $link_linkedin . '"><svg class="icon linkedin"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#linkedin"></use></svg></a></li>';
						}
						if ($link_pinterest != '') {
							echo '<li><a rel="nofollow" href="' . $link_pinterest . '"><svg class="icon pinterest"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#pinterest"></use></svg></a></li>';
						}
					?>
				</ul>
			</div>
		</li>
	</ul>
</header>
<!-- end:header -->