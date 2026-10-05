<?php
/**
 * Compatibilidade com o que já está instalado no alvo.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * WP Rocket, autop do CF7 e wpcf7-redirect.
 */
class UpSites_CF7MS_Compat {

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_filter( 'wpcf7_autop_or_not', array( __CLASS__, 'desligar_autop' ), 10, 1 );
		add_filter( 'wpcf7_form_novalidate', array( __CLASS__, 'novalidate' ), 10, 1 );

		// WP Rocket.
		add_filter( 'rocket_delay_js_exclusions', array( __CLASS__, 'excluir_do_delay_js' ), 10, 1 );
		add_filter( 'rocket_exclude_defer_js', array( __CLASS__, 'excluir_do_delay_js' ), 10, 1 );
		add_filter( 'rocket_exclude_js', array( __CLASS__, 'excluir_do_delay_js' ), 10, 1 );
	}

	/**
	 * Desliga o autop nos formulários wizard.
	 *
	 * O wpcf7_autop injeta <p> e <br> no meio do markup. Como as etapas são
	 * <div class="up-step"> envolvendo os form-tags, isso quebra a estrutura e
	 * produz parágrafos órfãos entre os campos.
	 *
	 * O filtro não recebe o formulário como argumento; get_current() está setado
	 * durante o render, e é assim que se escopa.
	 *
	 * @param bool $autop Valor atual.
	 * @return bool
	 */
	public static function desligar_autop( $autop ) {
		return UpSites_CF7MS_Config::e_wizard() ? false : $autop;
	}

	/**
	 * Garante novalidate nos formulários wizard.
	 *
	 * Campos required dentro de etapas ocultas fariam o Chrome lançar
	 * "An invalid form control is not focusable" e o submit morreria em silêncio.
	 * O CF7 já usa novalidate por padrão; isto é defesa contra mudança futura.
	 *
	 * @param bool $novalidate Valor atual.
	 * @return bool
	 */
	public static function novalidate( $novalidate ) {
		return UpSites_CF7MS_Config::e_wizard() ? true : $novalidate;
	}

	/**
	 * Mantém fora do Delay JS o que precisa rodar antes da primeira interação.
	 *
	 * O tracking.js grava first-touch (referrer e landing_url) e os click IDs.
	 * Atrasá-lo até o primeiro toque perde a atribuição de quem sai rápido.
	 *
	 * @param array $excluidos Lista atual.
	 * @return array
	 */
	public static function excluir_do_delay_js( $excluidos ) {
		if ( ! is_array( $excluidos ) ) {
			$excluidos = array();
		}

		return array_merge(
			$excluidos,
			array(
				'upsites-cf7-multistep/assets/js/',
				'contact-form-7/includes/js/',
				'contact-form-7/includes/swv/',
				'google.com/recaptcha',
				'gstatic.com/recaptcha',
				'googletagmanager.com/gtm.js',
				'bzrcdn.openai.com/sdk/oaiq',
			)
		);
	}
}
