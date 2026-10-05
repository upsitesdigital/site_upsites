<?php
/**
 * Comandos WP-CLI.
 *
 * Mesmo código da tela de administração, outro gatilho: é o que o
 * provisionamento do ambiente local usa.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Comandos do plugin.
 */
class UpSites_CF7MS_CLI {

	/**
	 * Aplica o formulário versionado no plugin ao Contact Form 7.
	 *
	 * ## OPTIONS
	 *
	 * [--sobrescrever-config]
	 * : Restaura também a configuração padrão do wizard, em vez de preservar a salva.
	 *
	 * ## EXAMPLES
	 *
	 *     wp upsites-cf7ms sincronizar-form
	 *
	 * @subcommand sincronizar-form
	 *
	 * @param array $args    Argumentos posicionais.
	 * @param array $assoc   Argumentos nomeados.
	 * @return void
	 */
	public function sincronizar_form( $args, $assoc ) {
		unset( $args );

		$preservar = empty( $assoc['sobrescrever-config'] );
		$resultado = UpSites_CF7MS_Sincronizador::aplicar( $preservar );

		if ( is_wp_error( $resultado ) ) {
			WP_CLI::error( $resultado->get_error_message() );
		}

		$form = wpcf7_contact_form( $resultado );

		WP_CLI::success(
			sprintf( 'Formulário #%d sincronizado. hash: %s', $resultado, $form ? $form->hash() : '?' )
		);
	}

	/**
	 * Mostra se o formulário no banco difere do arquivo do plugin.
	 *
	 * ## EXAMPLES
	 *
	 *     wp upsites-cf7ms comparar-form
	 *
	 * @subcommand comparar-form
	 *
	 * @return void
	 */
	public function comparar_form() {
		$c = UpSites_CF7MS_Sincronizador::comparar();

		if ( is_wp_error( $c ) ) {
			WP_CLI::error( $c->get_error_message() );
		}

		if ( $c['diferente'] ) {
			WP_CLI::warning( 'O formulário no banco está DIFERENTE do arquivo do plugin.' );
		} else {
			WP_CLI::success( 'O formulário no banco está em dia com o arquivo do plugin.' );
		}
	}
}
