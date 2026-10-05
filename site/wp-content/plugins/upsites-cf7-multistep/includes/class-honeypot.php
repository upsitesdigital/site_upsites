<?php
/**
 * Honeypot próprio.
 *
 * Antes o formulário usava a tag [honeypot] do plugin "Honeypot for Contact
 * Form 7". Quando esse plugin não está instalado, o Contact Form 7 não conhece
 * a tag e **imprime o shortcode literalmente na página** — foi o que aconteceu
 * no staging. Uma dependência de terceiro que falha em público não vale a pena
 * numa armadilha de spam de trinta linhas.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Campo-isca e detecção de spam.
 */
class UpSites_CF7MS_Honeypot {

	const TAG = 'upsites_honeypot';

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_action( 'wpcf7_init', array( __CLASS__, 'adicionar_tag' ), 10, 0 );
		add_filter( 'wpcf7_spam', array( __CLASS__, 'detectar' ), 10, 2 );

		// Antes do renderer (prioridade 20): tag órfã não deve nem entrar no DOM.
		add_filter( 'wpcf7_form_elements', array( __CLASS__, 'limpar_tags_orfas' ), 10, 1 );
	}

	/**
	 * Registra a form-tag.
	 *
	 * @return void
	 */
	public static function adicionar_tag() {
		wpcf7_add_form_tag(
			array( self::TAG ),
			array( __CLASS__, 'renderizar' ),
			array( 'name-attr' => true )
		);
	}

	/**
	 * Renderiza o campo-isca.
	 *
	 * O estilo vai inline de propósito: a folha de estilo do wizard pode não ter
	 * carregado (WP Rocket, otimizador de CSS), e um honeypot visível é pior que
	 * nenhum honeypot — o visitante legítimo preenche e é barrado como spam.
	 *
	 * @param WPCF7_FormTag|array $tag Form-tag.
	 * @return string
	 */
	public static function renderizar( $tag ) {
		$tag  = new WPCF7_FormTag( $tag );
		$nome = $tag->name ? $tag->name : 'up_website';

		return sprintf(
			'<div style="position:absolute!important;left:-9999px!important;top:auto!important;width:1px!important;height:1px!important;overflow:hidden!important" aria-hidden="true">'
			. '<label for="%1$s">%2$s</label>'
			. '<input type="text" id="%1$s" name="%1$s" value="" tabindex="-1" autocomplete="off" />'
			. '</div>',
			esc_attr( $nome ),
			esc_html__( 'Deixe este campo em branco', 'upsites-cf7-multistep' )
		);
	}

	/**
	 * Marca a submissão como spam se a isca foi preenchida.
	 *
	 * @param bool            $spam      Veredito acumulado.
	 * @param WPCF7_Submission $submission Submissão.
	 * @return bool
	 */
	public static function detectar( $spam, $submission ) {
		if ( $spam ) {
			return $spam;
		}

		$form = $submission instanceof WPCF7_Submission ? $submission->get_contact_form() : null;

		if ( ! $form instanceof WPCF7_ContactForm ) {
			return $spam;
		}

		foreach ( $form->scan_form_tags( array( 'type' => self::TAG ) ) as $tag ) {
			if ( empty( $tag->name ) ) {
				continue;
			}

			// phpcs:ignore WordPress.Security.NonceVerification.Missing
			$valor = isset( $_POST[ $tag->name ] ) ? trim( (string) wp_unslash( $_POST[ $tag->name ] ) ) : '';

			if ( '' !== $valor ) {
				$submission->add_spam_log(
					array(
						'agent'  => 'upsites_honeypot',
						'reason' => 'Campo-isca preenchido.',
					)
				);

				return true;
			}
		}

		return $spam;
	}

	/**
	 * Remove do HTML qualquer form-tag que o CF7 não substituiu.
	 *
	 * Rede de segurança para o formulário que já está no banco com a tag antiga
	 * de terceiro, e para quem escrever uma tag de um plugin que não está ativo.
	 * Melhor o campo sumir do que o visitante ler "[honeypot up_hp]" na tela.
	 *
	 * @param string $html HTML do formulário.
	 * @return string
	 */
	public static function limpar_tags_orfas( $html ) {
		if ( false === strpos( $html, '[' ) ) {
			return $html;
		}

		return preg_replace( '/\[\s*(?:honeypot|upsites_honeypot)\b[^\]]*\]/i', '', $html );
	}
}
