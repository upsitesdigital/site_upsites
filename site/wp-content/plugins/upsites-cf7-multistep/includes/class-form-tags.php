<?php
/**
 * Form-tag [upsites_hidden].
 *
 * O CF7 core não tem campo oculto (foi removido na v3). Esta é a ÚNICA form-tag
 * custom do plugin — tudo o mais é form-tag nativa, para o formulário continuar
 * editável e duplicável pelo wp-admin.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registro e renderização dos campos ocultos de tracking.
 */
class UpSites_CF7MS_Form_Tags {

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_action( 'wpcf7_init', array( __CLASS__, 'adicionar_tag' ), 10, 0 );
		add_filter( 'wpcf7_pre_construct_contact_form_properties', array( 'UpSites_CF7MS_Config', 'registrar_propriedade' ), 10, 1 );
		add_action( 'wpcf7_save_contact_form', array( __CLASS__, 'limpar_cache_wp_rocket' ), 20, 1 );
	}

	/**
	 * Registra a form-tag no CF7.
	 *
	 * @return void
	 */
	public static function adicionar_tag() {
		wpcf7_add_form_tag(
			array( 'upsites_hidden' ),
			array( __CLASS__, 'renderizar' ),
			array( 'name-attr' => true )
		);
	}

	/**
	 * Renderiza o input oculto.
	 *
	 * IMPORTANTE: o value sai SEMPRE vazio do servidor. A página do formulário é
	 * cacheável (WP Rocket), e um valor gerado em PHP — lead_uid, gclid — seria
	 * servido idêntico para todos os visitantes. Quem preenche é o JS.
	 *
	 * @param WPCF7_FormTag|array $tag Form-tag.
	 * @return string HTML do input.
	 */
	public static function renderizar( $tag ) {
		$tag = new WPCF7_FormTag( $tag );

		if ( empty( $tag->name ) ) {
			return '';
		}

		return sprintf(
			'<input type="hidden" name="%1$s" value="" data-upms-hidden="%1$s" autocomplete="off" />',
			esc_attr( $tag->name )
		);
	}

	/**
	 * Limpa o cache do WP Rocket ao salvar um formulário.
	 *
	 * Sem isto, editar o formulário no admin não reflete no front até o cache
	 * expirar — e a pessoa conclui, errado, que o plugin ignorou a edição.
	 *
	 * @param WPCF7_ContactForm $form Formulário salvo.
	 * @return void
	 */
	public static function limpar_cache_wp_rocket( $form ) {
		unset( $form );

		if ( function_exists( 'rocket_clean_domain' ) ) {
			rocket_clean_domain();
		}
	}
}
