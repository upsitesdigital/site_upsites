<?php
/**
 * Modal no rodapé e shortcode de gatilho.
 *
 * O alvo só é acessível por wp-admin — não há como editar o template do tema.
 * Por isso o modal é injetado em wp_footer e ligado aos CTAs existentes por um
 * seletor CSS configurável, sem tocar em nenhum arquivo do tema.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Renderização do modal e resolução de qual formulário usar na página.
 */
class UpSites_CF7MS_Modal {

	/**
	 * Cache do par (formulário, configuração) da página corrente.
	 *
	 * @var array|null|false false = ainda não resolvido.
	 */
	private static $resolvido = false;

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_action( 'wp_footer', array( __CLASS__, 'renderizar' ), 20 );
		add_shortcode( 'upsites_wizard_trigger', array( __CLASS__, 'shortcode_gatilho' ) );
	}

	/**
	 * Encontra o formulário wizard que deve aparecer nesta página.
	 *
	 * @return array<string,mixed>|null Configuração, ou null se não houver.
	 */
	public static function config_ativa() {
		$par = self::resolver();

		return $par ? $par['config'] : null;
	}

	/**
	 * Encontra o formulário wizard aplicável à página corrente.
	 *
	 * @return array{form:WPCF7_ContactForm,config:array}|null
	 */
	private static function resolver() {
		if ( false !== self::$resolvido ) {
			return self::$resolvido;
		}

		self::$resolvido = null;

		if ( is_admin() || ! class_exists( 'WPCF7_ContactForm' ) ) {
			return null;
		}

		$ids = get_posts(
			array(
				'post_type'              => 'wpcf7_contact_form',
				'post_status'            => 'publish',
				'posts_per_page'         => 50,
				'fields'                 => 'ids',
				'no_found_rows'          => true,
				'update_post_term_cache' => false,
			)
		);

		foreach ( $ids as $id ) {
			$form = wpcf7_contact_form( $id );

			if ( ! $form instanceof WPCF7_ContactForm ) {
				continue;
			}

			$config = UpSites_CF7MS_Config::obter( $form );

			if ( empty( $config['ativo'] ) || 'modal' !== $config['exibicao'] ) {
				continue;
			}

			if ( ! self::pagina_casa( $config['exibir_em'] ) ) {
				continue;
			}

			self::$resolvido = array(
				'form'   => $form,
				'config' => $config,
			);
			break;
		}

		return self::$resolvido;
	}

	/**
	 * Decide se a página corrente está no escopo configurado.
	 *
	 * @param string $escopo 'home', 'todas', ou lista de slugs/IDs separada por vírgula.
	 * @return bool
	 */
	private static function pagina_casa( $escopo ) {
		$escopo = trim( (string) $escopo );

		if ( '' === $escopo || 'todas' === $escopo ) {
			return true;
		}

		if ( 'home' === $escopo ) {
			return is_front_page();
		}

		$alvos = array_filter( array_map( 'trim', explode( ',', $escopo ) ) );

		foreach ( $alvos as $alvo ) {
			if ( 'home' === $alvo && is_front_page() ) {
				return true;
			}
			if ( is_numeric( $alvo ) && is_page( (int) $alvo ) ) {
				return true;
			}
			if ( ! is_numeric( $alvo ) && is_page( $alvo ) ) {
				return true;
			}
		}

		return false;
	}

	/**
	 * Injeta o <dialog> com o formulário dentro.
	 *
	 * <dialog> nativo dá de graça: foco preso, fechar com Esc, ::backdrop e
	 * inertização do fundo — coisas que a LP resolvia na mão.
	 *
	 * @return void
	 */
	public static function renderizar() {
		$par = self::resolver();

		if ( ! $par ) {
			return;
		}

		$config = $par['config'];
		$form   = $par['form'];

		printf(
			'<dialog class="upms-modal" data-upms-modal="1" aria-label="%s">',
			esc_attr__( 'Solicitar orçamento', 'upsites-cf7-multistep' )
		);

		echo '<div class="upms-modal__caixa">';

		printf(
			'<button type="button" class="upms-modal__fechar" data-upms-fechar="1" aria-label="%s">&times;</button>',
			esc_attr__( 'Fechar', 'upsites-cf7-multistep' )
		);

		// Painel de marca — some no mobile.
		echo '<aside class="upms-modal__marca" aria-hidden="true">';
		printf( '<h3 class="upms-modal__marca-titulo">%s</h3>', esc_html( $config['painel_titulo'] ) );
		printf( '<p class="upms-modal__marca-texto">%s</p>', esc_html( $config['painel_subtitulo'] ) );
		echo '<ul class="upms-modal__marca-lista">';
		printf( '<li>%s</li>', esc_html__( 'Leva cerca de 1 minuto', 'upsites-cf7-multistep' ) );
		printf( '<li>%s</li>', esc_html__( 'Seus dados seguros, sem spam', 'upsites-cf7-multistep' ) );
		printf( '<li>%s</li>', esc_html__( 'Resposta rápida do nosso time', 'upsites-cf7-multistep' ) );
		echo '</ul>';
		echo '</aside>';

		echo '<div class="upms-modal__conteudo">';
		echo do_shortcode( '[contact-form-7 id="' . absint( $form->id() ) . '"]' );
		echo '</div>';

		echo '</div>';
		echo '</dialog>';
	}

	/**
	 * Shortcode que renderiza um botão de gatilho.
	 *
	 * @param array $atts Atributos do shortcode.
	 * @return string
	 */
	public static function shortcode_gatilho( $atts ) {
		$atts = shortcode_atts(
			array(
				'label' => __( 'Solicitar orçamento', 'upsites-cf7-multistep' ),
				'class' => '',
			),
			$atts,
			'upsites_wizard_trigger'
		);

		return sprintf(
			'<button type="button" class="upms-gatilho %1$s" data-upms-abrir="1">%2$s</button>',
			esc_attr( $atts['class'] ),
			esc_html( $atts['label'] )
		);
	}
}
