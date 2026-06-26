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

$logo_footer    		    = get_theme_mod('US_logo_footer');
$text_footer    		    = get_theme_mod('US_text_footer');
$mail    		            = get_theme_mod('US_mail');
$address    		        = get_theme_mod('US_address');
$address_link    		    = get_theme_mod('US_address_link');
$phone 					        = get_theme_mod('US_phone');
$phone_custom 	        = '0'.str_replace(array('(', ')', '-', ' '), "", $phone);
$text_copyright    		  = get_theme_mod('US_text_copyright');
$link_privacy_policy    = get_theme_mod('US_link_privacy_policy');

$link_whats             = get_theme_mod('US_link_whats');
$link_facebook          = get_theme_mod('US_link_facebook');
$link_instagram         = get_theme_mod('US_link_instagram');
$link_linkedin          = get_theme_mod('US_link_linkedin');
$link_pinterest         = get_theme_mod('US_link_pinterest');

$post_list_01           = get_theme_mod('US_post_list_01');
$post_list_02           = get_theme_mod('US_post_list_02');
$post_list_03           = get_theme_mod('US_post_list_03');

$link_budgets    		    = get_theme_mod('US_link_budgets');

$title_popup    		    = get_theme_mod('US_title_popup');
$subtitle_popup    		  = get_theme_mod('US_subtitle_popup');
$text_popup    		      = get_theme_mod('US_text_popup');
$link_popup    		      = get_theme_mod('US_link_popup');
?>
  <!-- footer -->
  <footer id="footer">
    <div class="container">
      <div class="grid">
        <div class="item cols-01">
          <div class="flex">
						<?php
							if ($logo_footer != '') {
								echo '<a rel="dofollow Mobile-Bar" href="' . esc_url(home_url('/')) . '" class="logo" title="' . get_bloginfo('name') . '">' . wp_get_attachment_image(attachment_url_to_postid($logo_footer), 'full') . '</a>';
							}
						?>
          </div>
          <?php
            if ($text_footer != '') {
              echo '<p>' . nl2br(esc_html($text_footer))  . '</p>';
            }
          ?>
          <?php 
						if($phone != '') {
							echo '<a rel="nofollow" href="tel:' . $phone_custom . '" class="btn">
								<svg class="icon">
									<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#phone"></use>
								</svg> ' . $phone . '
							</a>';
						}	
					?>
          <?php
            if ($mail != '') {
              echo '<p class="d-flex df-center f14">
                <svg class="icon">
                  <use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#letter"></use>
                </svg> <a rel="dofollow" href="mailto:' . $mail . '">' . $mail  . '</a></p>';
            }
          ?>
          
        </div>
        <div class="item cols-02">
          <h4>Institucional</h4>
          <?php if (has_nav_menu('menufooter')) :
						$itemsWrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
						wp_nav_menu(
							array(
								'theme_location'       => 'menufooter',
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
					endif; ?>
        </div>
        <div class="item cols-03">
          <h4>Serviços</h4>
          <?php if (has_nav_menu('menufooterSevicos')) :
						$itemsWrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
						wp_nav_menu(
							array(
								'theme_location'       => 'menufooterSevicos',
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
					endif; ?>
        </div>
        <div class="item cols-04">
          <!-- h4>Principais artigos</h4>
          <ul>
          <?php
            $array = array($post_list_01,$post_list_02,$post_list_03);
            foreach($array as $post) {
              $US_post = get_post($post);
              echo '<li><a rel="dofollow" href="'.get_permalink( $post ).'">' . $US_post->post_title . '</a></li>';
            }
          ?>
          </ul -->
          <h4>Segmentos</h4>
          <?php if (has_nav_menu('menusegmentos')) :
						$itemsWrap = '<ul id="%1$s" class="%2$s">%3$s</ul>';
						wp_nav_menu(
							array(
								'theme_location'       => 'menusegmentos',
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
					endif; ?>
        </div>
      </div>
      <div class="address-box">
        <ul class="share">
          <?php
            if ($link_whats != '') {
              echo '<li><a rel="nofollow" href="' . $link_whats . '" aria-label="Link whatsapp"><svg class="icon whats"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#whats"></use></svg></a></li>';
            }
            if ($link_facebook != '') {
              echo '<li><a rel="nofollow" href="' . $link_facebook . '" aria-label="Link facebook"><svg class="icon facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#facebook"></use></svg></a></li>';
            }
            if ($link_instagram != '') {
              echo '<li><a rel="nofollow" href="' . $link_instagram . '" aria-label="Link instagram"><svg class="icon instagram"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#instagram"></use></svg></a></li>';
            }
            if ($link_linkedin != '') {
              echo '<li><a rel="nofollow" href="' . $link_linkedin . '" aria-label="Link linkedin"><svg class="icon linkedin"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#linkedin"></use></svg></a></li>';
            }
            if ($link_pinterest != '') {
              echo '<li><a rel="nofollow" href="' . $link_pinterest . '" aria-label="Link pinterest"><svg class="icon pinterest"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#pinterest"></use></svg></a></li>';
            }
          ?>
        </ul>
        <?php
          if ($address != '') {
            echo '<span class="address"><span>' . $address  . '</span></span>';
          }
        ?>
        <!-- SELO RR - SNIPPET -->
        <div class="selo-rr-wrapper">
          <svg class="selo-rr" xmlns="http://www.w3.org/2000/svg" viewBox="600 665 300 170" aria-label="Selo Responsible Resignation">
            <defs>
              <clipPath id="rr-pill"><path d="M685.1875 676.91h129.625c19.383 0 37.973 7.7 51.68 21.406C880.2 712.023 887.902 730.613 887.902 750s-7.703 37.977-21.41 51.684C852.785 815.39 834.195 823.09 814.813 823.09H685.187c-19.383 0-37.973-7.7-51.68-21.406C619.8 787.977 612.098 769.383 612.098 750s7.703-37.977 21.41-51.684c13.707-13.707 32.297-21.406 51.68-21.406z"/></clipPath>
              <clipPath id="rr-circle"><path d="M814.922 688.563c-33.93 0-61.438 27.507-61.438 61.437s27.508 61.438 61.438 61.438 61.437-27.508 61.437-61.438-27.508-61.438-61.438-61.438z"/></clipPath>
            </defs>
            <g clip-path="url(#rr-pill)"><rect x="612" y="676" width="276" height="148" fill="#585858"/></g>
            <g clip-path="url(#rr-circle)"><rect x="753" y="688" width="124" height="124" fill="#fafafa"/></g>
            <g transform="translate(634,647)" fill="#fff"><g transform="translate(2.166,152.795)"><path d="M65.5 0L41.016-42.047H24.781V0H11.359V-102.828H44.547C52.316-102.828 58.883-101.5 64.25-98.844C69.613-96.188 73.617-92.598 76.266-88.078C78.922-83.555 80.25-78.391 80.25-72.578C80.25-65.504 78.207-59.258 74.125-53.844C70.051-48.438 63.93-44.848 55.766-43.078L81.578 0ZM24.781-52.813H44.547C51.828-52.813 57.285-54.609 60.922-58.203C64.566-61.797 66.391-66.586 66.391-72.578C66.391-78.68 64.594-83.406 61-86.75C57.415-90.094 51.93-91.766 44.547-91.766H24.781Z"/></g></g>
            <g transform="translate(771,645)" fill="#585858"><g transform="translate(0.795,155.142)"><path d="M46.031-43.672L18.734 0H3.25L32.75-46.031C29.008-47.207 25.492-48.926 22.203-51.188C18.91-53.457 16.227-56.555 14.156-60.484C12.094-64.422 11.063-69.535 11.063-75.828C11.063-85.368 14.332-92.672 20.875-97.734C27.414-102.805 37.273-105.344 50.453-105.344H79.969V0H66.688V-43.672ZM66.688-93.984H50.75C42.29-93.984 35.848-92.531 31.422-89.625C26.993-86.719 24.781-81.922 24.781-75.234C24.781-68.743 26.941-63.727 31.266-60.188C35.598-56.645 42.29-54.875 51.344-54.875H66.688Z"/></g></g>
          </svg>
          <span class="selo-rr-tooltip">Temos o Selo Responsible Resignation (RR) que identifica profissionais que entregaram resultados consistentes e são recomendados pela nossa empresa mesmo no momento do desligamento.</span>
        </div>
        <!-- FIM SELO RR -->
        <!-- p class="wework">Hospedado por <span><img src="<?= get_template_directory_uri() ?>/assets/img/logo-infinite.svg" alt="logo-infinite" width="90" height="29"></span></p -->
      </div>
    </div>
    <div class="copyright">
      <div class="container">
        <?php
          if ($text_copyright != '') {
            echo '<p>© ' . date("Y") . ' ' . $text_copyright  . '</p>';
          }
        ?>
        <?php
          if ($link_privacy_policy != '') {
            echo '<a rel="nofollow" href="' . $link_privacy_policy  . '">Política de privacidade</a>';
          }
        ?>
      </div>
    </div>
  </footer>
  <!-- end:footer -->
  <div id="footer-bar">
    <ul>
      <li>
        <a rel="nofollow" href="tel:<?= $phone_custom ?>">
          <svg class="icon">
            <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#phone"></use>
          </svg> Telefone
        </a>
      </li>
      <li>
        <a rel="nofollow" target="_blank" href="<?= $link_budgets ?>?origin=footer-mobile">
          <div class="box">
            <svg class="icon">
            <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#ray"></use>
            </svg>
          </div> Orçamento
        </a>
      </li>
      <li>
        <a rel="dofollow" href="mailto:<?= $mail ?>">
          <svg class="icon">
            <use xlink:href="<?= get_template_directory_uri() ?>/assets/img/icons.svg#letter"></use>
          </svg> E-mail
        </a>
      </li>
    </ul>
  </div>
  <a rel="dofollow" href="#main" class="backtop">
  <i class="fa fa-angle-up" aria-hidden="true"></i>
  </a>

  <div class="loader">
  <div class="multi-spinner-container">
    <div class="multi-spinner">
      <div class="multi-spinner">
        <div class="multi-spinner">
          <div class="multi-spinner">
            <div class="multi-spinner">
              <div class="multi-spinner"></div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  </div>

  <?php if(!is_page_template( 'template-pages/video.php' ) OR !is_page_template( 'template-pages/partners.php' )) { ?>
    <div class="modal-03">
      <div class="overlay"></div>
      <div class="content">
        <div class="text">
          <?php 
            if($title_popup != '') {
              echo '<h2>' . $title_popup . '</h2>';
            }
            if($subtitle_popup != '') {
              echo '<h3>' . $subtitle_popup . '</h3>';
            }
            if($text_popup != '') {
              echo '<p>' . $text_popup . '</p>';
            }
          ?>
        </div>
        <div class="bar">
          <a href="<?= $link_popup ?>" target="_blank">
            <img src="<?= get_template_directory_uri() ?>/assets/img/coins.svg" alt="" class="before">
            Calcular valor agora
            <img src="<?= get_template_directory_uri() ?>/assets/img/arrow-popup.svg" alt="" class="after">
          </a>
        </div>
        <div class="image">
        <img src="<?= get_template_directory_uri() ?>/assets/img/img-popup03.svg" alt="">
        </div>
        <a href="#" class="close"><i class="fa fa-times" aria-hidden="true"></i></a>
      </div>
    </div>
  <?php } ?>