<?php
/**
 * Plugin Name:       UpSites — Formulário multistep para Contact Form 7
 * Plugin URI:        https://github.com/joaovicentefs/form-site-principal-upsites
 * Description:       Transforma um formulário do Contact Form 7 num wizard multi-step com a identidade visual do site principal, captura parcial de leads, consentimento LGPD e integração com o middleware de leads da UpSites.
 * Version:           0.1.4
 * Requires at least: 6.4
 * Requires PHP:      7.4
 * Author:            UpSites Digital
 * Author URI:        https://upsites.digital
 * Text Domain:       upsites-cf7-multistep
 * Domain Path:       /languages
 * License:           GPL-2.0-or-later
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/*
 * ---------------------------------------------------------------------------
 * GUARDAS DE FATAL ERROR — antes de QUALQUER require.
 *
 * O alvo (upsites.digital) só é acessível por wp-admin: não há SSH nem FTP para
 * renomear a pasta do plugin se ele derrubar o site. Portanto, incompatibilidade
 * tem que virar aviso no admin, nunca tela branca.
 * ---------------------------------------------------------------------------
 */

if ( version_compare( PHP_VERSION, '7.4', '<' ) ) {
	add_action(
		'admin_notices',
		static function () {
			printf(
				'<div class="notice notice-error"><p>%s</p></div>',
				esc_html(
					sprintf(
						/* translators: %s: versão do PHP em uso. */
						__( 'UpSites Multistep exige PHP 7.4 ou superior. Este servidor roda PHP %s — o plugin está inativo.', 'upsites-cf7-multistep' ),
						PHP_VERSION
					)
				)
			);
		}
	);
	return;
}

define( 'UPSITES_CF7MS_VERSION', '0.1.4' );
define( 'UPSITES_CF7MS_FILE', __FILE__ );
define( 'UPSITES_CF7MS_DIR', plugin_dir_path( __FILE__ ) );
define( 'UPSITES_CF7MS_URL', plugin_dir_url( __FILE__ ) );
define( 'UPSITES_CF7MS_MIN_CF7', '5.7' );

/**
 * Sobe o plugin depois do Contact Form 7.
 *
 * O CF7 define WPCF7_VERSION no seu próprio carregamento; checar aqui (e não no
 * topo do arquivo) garante que a ordem de carregamento dos plugins não produza
 * um falso negativo.
 */
add_action(
	'plugins_loaded',
	static function () {
		if ( ! defined( 'WPCF7_VERSION' ) ) {
			add_action( 'admin_notices', 'upsites_cf7ms_aviso_cf7_ausente' );
			return;
		}

		if ( version_compare( WPCF7_VERSION, UPSITES_CF7MS_MIN_CF7, '<' ) ) {
			add_action( 'admin_notices', 'upsites_cf7ms_aviso_cf7_antigo' );
			return;
		}

		require_once UPSITES_CF7MS_DIR . 'includes/class-plugin.php';
		UpSites_CF7MS_Plugin::instancia()->boot();
	},
	20
);

/**
 * Aviso: Contact Form 7 não está ativo.
 */
function upsites_cf7ms_aviso_cf7_ausente() {
	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html__(
			'UpSites Multistep precisa do Contact Form 7 ativo. Ative o Contact Form 7 para que o formulário multi-step funcione.',
			'upsites-cf7-multistep'
		)
	);
}

/**
 * Aviso: Contact Form 7 é antigo demais.
 */
function upsites_cf7ms_aviso_cf7_antigo() {
	printf(
		'<div class="notice notice-warning"><p>%s</p></div>',
		esc_html(
			sprintf(
				/* translators: 1: versão mínima exigida; 2: versão instalada. */
				__( 'UpSites Multistep exige Contact Form 7 %1$s ou superior. A versão instalada é a %2$s.', 'upsites-cf7-multistep' ),
				UPSITES_CF7MS_MIN_CF7,
				WPCF7_VERSION
			)
		)
	);
}

add_action(
	'init',
	static function () {
		load_plugin_textdomain( 'upsites-cf7-multistep', false, dirname( plugin_basename( __FILE__ ) ) . '/languages' );
	}
);
