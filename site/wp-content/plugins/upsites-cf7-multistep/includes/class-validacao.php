<?php
/**
 * Validação server-side de campos que o CF7 não cobre.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Torna obrigatório um [radio] marcado com class:up-obrigatorio.
 *
 * O Contact Form 7 não tem [radio*] — a tag simplesmente não existe, e escrevê-la
 * faz o shortcode aparecer literalmente na página. A obrigatoriedade de um grupo
 * de opções, então, precisa ser declarada de outro jeito.
 *
 * A escolha é `class:up-obrigatorio` porque é opção nativa de form-tag: continua
 * editável no wp-admin, o gerador de tags do CF7 não estranha, e a mesma classe
 * serve de gancho para o CSS e para a validação do wizard no cliente.
 */
class UpSites_CF7MS_Validacao {

	const CLASSE_OBRIGATORIO = 'up-obrigatorio';

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_filter( 'wpcf7_validate_radio', array( __CLASS__, 'validar_radio' ), 20, 2 );
	}

	/**
	 * Recusa o envio quando um radio obrigatório veio vazio.
	 *
	 * @param WPCF7_Validation $resultado Resultado acumulado.
	 * @param WPCF7_FormTag    $tag       Form-tag em validação.
	 * @return WPCF7_Validation
	 */
	public static function validar_radio( $resultado, $tag ) {
		if ( ! in_array( self::CLASSE_OBRIGATORIO, (array) $tag->get_class_option(), true ) ) {
			return $resultado;
		}

		$nome  = $tag->name;
		$valor = isset( $_POST[ $nome ] ) ? sanitize_text_field( wp_unslash( $_POST[ $nome ] ) ) : ''; // phpcs:ignore WordPress.Security.NonceVerification.Missing

		if ( '' === trim( $valor ) ) {
			$resultado->invalidate( $tag, wpcf7_get_message( 'invalid_required' ) );
		}

		return $resultado;
	}
}
