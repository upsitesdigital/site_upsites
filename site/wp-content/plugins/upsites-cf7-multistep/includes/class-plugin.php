<?php
/**
 * Orquestrador do plugin.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Carrega e conecta os subsistemas. Um único ponto de wiring.
 */
final class UpSites_CF7MS_Plugin {

	/**
	 * Instância única.
	 *
	 * @var UpSites_CF7MS_Plugin|null
	 */
	private static $instancia = null;

	/**
	 * Evita boot duplo.
	 *
	 * @var bool
	 */
	private $iniciado = false;

	/**
	 * Construtor privado — use instancia().
	 */
	private function __construct() {}

	/**
	 * Devolve a instância única.
	 *
	 * @return UpSites_CF7MS_Plugin
	 */
	public static function instancia() {
		if ( null === self::$instancia ) {
			self::$instancia = new self();
		}

		return self::$instancia;
	}

	/**
	 * Carrega as dependências e registra os hooks.
	 *
	 * @return void
	 */
	public function boot() {
		if ( $this->iniciado ) {
			return;
		}

		$this->iniciado = true;

		$arquivos = array(
			'includes/class-telefone.php',
			'includes/class-config.php',
			'includes/class-form-tags.php',
			'includes/class-validacao.php',
			'includes/class-honeypot.php',
			'includes/class-renderer.php',
			'includes/class-assets.php',
			'includes/class-modal.php',
			'includes/class-editor-panel.php',
			'includes/class-compat.php',
			'includes/class-sincronizador.php',
		);

		foreach ( $arquivos as $arquivo ) {
			require_once UPSITES_CF7MS_DIR . $arquivo;
		}

		UpSites_CF7MS_Form_Tags::registrar();
		UpSites_CF7MS_Validacao::registrar();
		UpSites_CF7MS_Honeypot::registrar();
		UpSites_CF7MS_Renderer::registrar();
		UpSites_CF7MS_Assets::registrar();
		UpSites_CF7MS_Modal::registrar();
		UpSites_CF7MS_Compat::registrar();

		if ( is_admin() ) {
			require_once UPSITES_CF7MS_DIR . 'admin/class-tela-sincronizacao.php';
			UpSites_CF7MS_Editor_Panel::registrar();
			UpSites_CF7MS_Tela_Sincronizacao::registrar();
		}

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			require_once UPSITES_CF7MS_DIR . 'includes/class-cli.php';
			WP_CLI::add_command( 'upsites-cf7ms', 'UpSites_CF7MS_CLI' );
		}
	}
}
