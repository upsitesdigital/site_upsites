<?php
/**
 * Enfileiramento de CSS e JS.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Registra e enfileira os assets do wizard.
 */
class UpSites_CF7MS_Assets {

	const HANDLE_TRACKING = 'upsites-cf7ms-tracking';
	const HANDLE_WIZARD   = 'upsites-cf7ms-wizard';
	const HANDLE_CSS      = 'upsites-cf7ms';

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enfileirar' ), 20 );
	}

	/**
	 * Versão usada no cache-busting.
	 *
	 * Em desenvolvimento usa o mtime, porque bumpar a versão do plugin a cada
	 * salvamento seria absurdo. Em produção é a constante — e é ela que invalida
	 * o cache do WP Rocket.
	 *
	 * @param string $caminho Caminho absoluto do arquivo.
	 * @return string
	 */
	private static function versao( $caminho ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG && file_exists( $caminho ) ) {
			return UPSITES_CF7MS_VERSION . '.' . filemtime( $caminho );
		}

		return UPSITES_CF7MS_VERSION;
	}

	/**
	 * Enfileira os assets.
	 *
	 * O tracking.js vai em TODAS as páginas, de propósito: ele grava o first-touch
	 * (referrer externo e landing page da primeira visita) e os click IDs. Carregá-lo
	 * só onde o formulário aparece perderia a atribuição de quem chega por um
	 * anúncio, navega e só depois pede orçamento.
	 *
	 * @return void
	 */
	public static function enfileirar() {
		wp_enqueue_script(
			self::HANDLE_TRACKING,
			UPSITES_CF7MS_URL . 'assets/js/tracking.js',
			array(),
			self::versao( UPSITES_CF7MS_DIR . 'assets/js/tracking.js' ),
			false // No <head>: precisa rodar antes de qualquer navegação.
		);

		if ( ! self::pagina_tem_wizard() ) {
			return;
		}

		wp_enqueue_style(
			self::HANDLE_CSS,
			UPSITES_CF7MS_URL . 'assets/css/wizard.css',
			array(),
			self::versao( UPSITES_CF7MS_DIR . 'assets/css/wizard.css' )
		);

		wp_enqueue_script(
			self::HANDLE_WIZARD,
			UPSITES_CF7MS_URL . 'assets/js/wizard.js',
			array( self::HANDLE_TRACKING ),
			self::versao( UPSITES_CF7MS_DIR . 'assets/js/wizard.js' ),
			true
		);

		wp_localize_script( self::HANDLE_WIZARD, 'UPSITES_CF7MS', self::dados_para_o_js() );
	}

	/**
	 * Diz se a página corrente carrega o wizard.
	 *
	 * @return bool
	 */
	private static function pagina_tem_wizard() {
		$config = UpSites_CF7MS_Modal::config_ativa();

		return ! empty( $config );
	}

	/**
	 * Dados passados ao JS.
	 *
	 * @return array<string,mixed>
	 */
	private static function dados_para_o_js() {
		$config = UpSites_CF7MS_Modal::config_ativa();
		$config = is_array( $config ) ? $config : UpSites_CF7MS_Config::padroes();

		$dados = array(
			'endpoint'         => UpSites_CF7MS_Config::endpoint( $config ),
			'origem'           => $config['origem'],
			'rascunhoAtivo'    => (bool) $config['rascunho_ativo'],
			'gatilhoSeletor'   => $config['gatilho_seletor'],
			'whatsappNumero'   => preg_replace( '/\D/', '', (string) $config['whatsapp_numero'] ),
			'whatsappMensagem' => $config['whatsapp_mensagem'],
			'sucessoMensagem'  => $config['sucesso_mensagem'],
			'recapCampos'      => array_values(
				array_filter( array_map( 'trim', explode( ',', (string) $config['recap_campos'] ) ) )
			),
			'consentimento'    => array(
				'texto'  => UpSites_CF7MS_Config::CONSENTIMENTO_TEXTO,
				'versao' => $config['consentimento_versao'],
			),
			'conversao'        => array(
				'quando' => $config['conversao_quando'],
				'valor'  => (int) $config['conversao_valor'],
			),
			'recaptchaSitekey' => self::sitekey_recaptcha(),
			'i18n'             => array(
				'continuar'      => __( 'Continuar', 'upsites-cf7-multistep' ),
				'enviar'         => __( 'Enviar pedido', 'upsites-cf7-multistep' ),
				'enviando'       => __( 'Enviando…', 'upsites-cf7-multistep' ),
				'nomeInvalido'   => __( 'Digite seu nome completo.', 'upsites-cf7-multistep' ),
				'emailInvalido'  => __( 'Digite um e-mail válido.', 'upsites-cf7-multistep' ),
				'foneInvalido'   => __( 'Digite um telefone válido.', 'upsites-cf7-multistep' ),
				'escolhaOpcao'   => __( 'Escolha uma opção para continuar.', 'upsites-cf7-multistep' ),
				'campoObrig'     => __( 'Preencha este campo para continuar.', 'upsites-cf7-multistep' ),
				'celular'        => __( 'Celular identificado', 'upsites-cf7-multistep' ),
				'labelNome'      => __( 'Nome', 'upsites-cf7-multistep' ),
				'labelContato'   => __( 'Contato', 'upsites-cf7-multistep' ),
				'labelEmpresa'   => __( 'Empresa', 'upsites-cf7-multistep' ),
				'labelSite'      => __( 'Site', 'upsites-cf7-multistep' ),
				'labelProjeto'   => __( 'Projeto', 'upsites-cf7-multistep' ),
				'labelPrazo'     => __( 'Prazo', 'upsites-cf7-multistep' ),
				'pessoaFisica'   => __( 'Pessoa física', 'upsites-cf7-multistep' ),
				'semSite'        => __( 'Ainda não tem', 'upsites-cf7-multistep' ),
			),
		);

		/**
		 * Permite ajustar os dados entregues ao JS do wizard.
		 *
		 * @param array $dados  Dados.
		 * @param array $config Configuração do formulário.
		 */
		return apply_filters( 'upsites_cf7ms_dados_js', $dados, $config );
	}

	/**
	 * Sitekey do reCAPTCHA v3, quando o módulo do CF7 está ativo.
	 *
	 * O token do v3 vale cerca de dois minutos. Num wizard de quatro etapas o
	 * visitante passa disso com facilidade, e o CF7 rejeitaria o envio como spam.
	 * O JS usa esta chave para regerar o token a cada avanço de etapa.
	 *
	 * @return string
	 */
	private static function sitekey_recaptcha() {
		if ( ! class_exists( 'WPCF7_RECAPTCHA' ) ) {
			return '';
		}

		$recaptcha = WPCF7_RECAPTCHA::get_instance();

		if ( ! $recaptcha || ! $recaptcha->is_active() ) {
			return '';
		}

		$sitekey = $recaptcha->get_sitekey();

		return is_string( $sitekey ) ? $sitekey : '';
	}
}
