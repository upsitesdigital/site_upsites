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
$phone 					        = get_theme_mod('US_phone');
$phone_custom 	        = str_replace(array('(', ')', '-', ' '), "", $phone);
$text_copyright    		  = get_theme_mod('US_text_copyright');
$link_privacy_policy    = get_theme_mod('US_link_privacy_policy');

$link_whats             = get_theme_mod('US_link_whats');
$link_facebook          = get_theme_mod('US_link_facebook');
$link_instagram         = get_theme_mod('US_link_instagram');
$link_linkedin          = get_theme_mod('US_link_linkedin');
?>
  <!-- footer -->
  <footer id="footer">
    <div class="container">
      <div class="grid">
        <div class="item cols-01">
          <div class="flex">
						<?php
							if ($logo_footer != '') {
								echo '<a href="' . esc_url(home_url('/')) . '" class="logo" rel="home" title="' . get_bloginfo('name') . '">' . wp_get_attachment_image(attachment_url_to_postid($logo_footer), 'full') . '</a>';
							}
						?>
          </div>
          <?php
            if ($text_footer != '') {
              echo '<p>' . nl2br(esc_html($text_footer))  . '</p>';
            }
          ?>
        </div>
        <div class="item cols-02">
        <?php if (has_nav_menu('menu')) :
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
					endif; ?>
        </div>
        <div class="item cols-03">
            <ul class="share">
              <?php
                if ($link_whats != '') {
                  echo '<li><a href="' . $link_whats . '"><svg class="icon whats"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#whats"></use></svg></a></li>';
                }
                if ($link_facebook != '') {
                  echo '<li><a href="' . $link_facebook . '"><svg class="icon facebook"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#facebook"></use></svg></a></li>';
                }
                if ($link_instagram != '') {
                  echo '<li><a href="' . $link_instagram . '"><svg class="icon instagram"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#instagram"></use></svg></a></li>';
                }
                if ($link_linkedin != '') {
                  echo '<li><a href="' . $link_linkedin . '"><svg class="icon linkedin"><use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#linkedin"></use></svg></a></li>';
                }
              ?>
            </ul>
          <?php
            if ($mail != '') {
              echo '<p><a href="mailto:' . $mail . '">' . $mail  . '</a></p>';
            }
          ?>
          <?php
            if ($address != '') {
              echo '<p>' . $address  . '</p>';
            }
          ?>
          <?php 
						if($phone != '') {
							echo '<a href="tel:+' . $phone_custom . '" class="btn">
								<svg class="icon">
									<use xlink:href="' . get_template_directory_uri() . '/assets/img/icons.svg#phone"></use>
								</svg> ' . $phone . '
							</a>';
						}	
					?>
        </div>
      </div>
      <div class="copyright">
        <?php
          if ($text_copyright != '') {
            echo '<p>© ' . date("Y") . ' ' . $text_copyright  . '</p>';
          }
        ?>
        <?php
          if ($link_privacy_policy != '') {
            echo '<a href="' . $link_privacy_policy  . '">Política de privacidade</a>';
          }
        ?>
      </div>
    </div>
  </footer>
  <!-- end:footer -->

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

