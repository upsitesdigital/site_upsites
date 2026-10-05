<?php
/**
 * Aba "Wizard UpSites" no editor do Contact Form 7.
 *
 * Toda a configuração vive aqui, e como property do formulário — não em
 * wp_options. Assim o botão "Duplicate" do CF7 leva a configuração junto, e
 * replicar o wizard não exige tocar em código.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Painel de configuração e salvamento.
 */
class UpSites_CF7MS_Editor_Panel {

	const NONCE = 'upsites_cf7ms_nonce';

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_filter( 'wpcf7_editor_panels', array( __CLASS__, 'adicionar_aba' ), 20, 1 );
		add_action( 'wpcf7_save_contact_form', array( __CLASS__, 'salvar' ), 10, 1 );
	}

	/**
	 * Adiciona a aba ao editor.
	 *
	 * @param array $paineis Painéis atuais.
	 * @return array
	 */
	public static function adicionar_aba( $paineis ) {
		$paineis['upsites-cf7ms'] = array(
			'title'    => __( 'Wizard UpSites', 'upsites-cf7-multistep' ),
			'callback' => array( __CLASS__, 'render' ),
		);

		return $paineis;
	}

	/**
	 * Renderiza o painel.
	 *
	 * @param WPCF7_ContactForm $form Formulário em edição.
	 * @return void
	 */
	public static function render( $form ) {
		$c = UpSites_CF7MS_Config::obter( $form );

		wp_nonce_field( 'upsites_cf7ms_salvar_' . $form->id(), self::NONCE );

		self::aviso_redirect( $form, $c );

		echo '<h2>' . esc_html__( 'Formulário multi-step', 'upsites-cf7-multistep' ) . '</h2>';

		echo '<p class="description">';
		echo esc_html__(
			'As etapas vêm do próprio conteúdo do formulário: envolva os campos em <div class="up-step" data-title="..." data-sub="..." data-short="...">. Nenhuma tag especial é necessária.',
			'upsites-cf7-multistep'
		);
		echo '</p>';

		echo '<table class="form-table" role="presentation"><tbody>';

		self::linha_checkbox( 'ativo', __( 'Ativar o wizard neste formulário', 'upsites-cf7-multistep' ), $c['ativo'] );

		self::linha_select(
			'exibicao',
			__( 'Como exibir', 'upsites-cf7-multistep' ),
			array(
				'modal'  => __( 'Modal, aberto por um CTA da página', 'upsites-cf7-multistep' ),
				'inline' => __( 'Direto na página, onde o shortcode estiver', 'upsites-cf7-multistep' ),
			),
			$c['exibicao']
		);

		self::linha_texto(
			'gatilho_seletor',
			__( 'Seletor CSS dos CTAs que abrem o modal', 'upsites-cf7-multistep' ),
			$c['gatilho_seletor'],
			__( 'Separe por vírgula. O clique nesses elementos abre o modal em vez de navegar.', 'upsites-cf7-multistep' )
		);

		self::linha_texto(
			'exibir_em',
			__( 'Em quais páginas carregar', 'upsites-cf7-multistep' ),
			$c['exibir_em'],
			__( '“home”, “todas”, ou slugs/IDs separados por vírgula.', 'upsites-cf7-multistep' )
		);

		echo '</tbody></table>';

		echo '<h2>' . esc_html__( 'Integração com o middleware de leads', 'upsites-cf7-multistep' ) . '</h2>';
		echo '<table class="form-table" role="presentation"><tbody>';

		if ( defined( 'UPSITES_CF7MS_ENDPOINT' ) ) {
			echo '<tr><th scope="row">' . esc_html__( 'Endpoint', 'upsites-cf7-multistep' ) . '</th><td><code>';
			echo esc_html( UPSITES_CF7MS_ENDPOINT );
			echo '</code><p class="description">';
			esc_html_e( 'Definido pela constante UPSITES_CF7MS_ENDPOINT no wp-config.php — este campo fica sem efeito.', 'upsites-cf7-multistep' );
			echo '</p></td></tr>';
		} else {
			self::linha_texto(
				'endpoint',
				__( 'Endpoint do middleware', 'upsites-cf7-multistep' ),
				$c['endpoint'],
				sprintf(
					/* translators: %s: URL padrão. */
					__( 'Em branco usa o padrão: %s', 'upsites-cf7-multistep' ),
					UpSites_CF7MS_Config::ENDPOINT_PADRAO
				)
			);
		}

		self::linha_checkbox(
			'rascunho_ativo',
			__( 'Enviar rascunhos (captura parcial de abandono)', 'upsites-cf7-multistep' ),
			$c['rascunho_ativo']
		);

		self::linha_texto(
			'origem',
			__( 'Valor de “origem” no payload', 'upsites-cf7-multistep' ),
			$c['origem'],
			__( 'Atenção: enquanto o middleware não tiver o ramo “site_principal”, o lead chega ao Ploomes rotulado como “LP Google Ads - WhatsApp”. Ver docs/contrato-middleware.md.', 'upsites-cf7-multistep' )
		);

		self::linha_texto(
			'consentimento_versao',
			__( 'Versão do texto de consentimento', 'upsites-cf7-multistep' ),
			$c['consentimento_versao'],
			__( 'Bumpe quando o texto do aviso mudar, para rastrear qual versão cada lead viu.', 'upsites-cf7-multistep' )
		);

		echo '</tbody></table>';

		echo '<h2>' . esc_html__( 'Conversões de anúncio', 'upsites-cf7-multistep' ) . '</h2>';
		echo '<table class="form-table" role="presentation"><tbody>';

		self::linha_select(
			'conversao_quando',
			__( 'Quando disparar generate_lead', 'upsites-cf7-multistep' ),
			array(
				'middleware' => __( 'Só após o middleware confirmar (paridade com a LP)', 'upsites-cf7-multistep' ),
				'cf7'        => __( 'Assim que o Contact Form 7 confirmar o envio', 'upsites-cf7-multistep' ),
			),
			$c['conversao_quando']
		);

		self::linha_texto( 'conversao_valor', __( 'Valor da conversão', 'upsites-cf7-multistep' ), $c['conversao_valor'] );

		echo '</tbody></table>';

		echo '<h2>' . esc_html__( 'Tela de sucesso', 'upsites-cf7-multistep' ) . '</h2>';
		echo '<table class="form-table" role="presentation"><tbody>';

		self::linha_texto( 'sucesso_titulo', __( 'Título', 'upsites-cf7-multistep' ), $c['sucesso_titulo'] );
		self::linha_textarea(
			'sucesso_mensagem',
			__( 'Mensagem', 'upsites-cf7-multistep' ),
			$c['sucesso_mensagem'],
			__( 'Aceita {primeiro_nome}.', 'upsites-cf7-multistep' )
		);
		self::linha_texto( 'whatsapp_numero', __( 'Número do WhatsApp', 'upsites-cf7-multistep' ), $c['whatsapp_numero'] );
		self::linha_textarea(
			'whatsapp_mensagem',
			__( 'Mensagem pré-montada do WhatsApp', 'upsites-cf7-multistep' ),
			$c['whatsapp_mensagem'],
			__( 'Aceita {primeiro_nome} e {tipo_projeto}.', 'upsites-cf7-multistep' )
		);
		self::linha_texto(
			'recap_campos',
			__( 'Campos no resumo', 'upsites-cf7-multistep' ),
			$c['recap_campos'],
			__( 'Nomes dos campos, separados por vírgula, na ordem em que devem aparecer.', 'upsites-cf7-multistep' )
		);

		echo '</tbody></table>';

		echo '<h2>' . esc_html__( 'Painel de marca do modal', 'upsites-cf7-multistep' ) . '</h2>';
		echo '<table class="form-table" role="presentation"><tbody>';
		self::linha_texto( 'painel_titulo', __( 'Título', 'upsites-cf7-multistep' ), $c['painel_titulo'] );
		self::linha_textarea( 'painel_subtitulo', __( 'Subtítulo', 'upsites-cf7-multistep' ), $c['painel_subtitulo'] );
		echo '</tbody></table>';
	}

	/**
	 * Avisa quando há redirect configurado — ele mataria a tela de sucesso.
	 *
	 * O plugin wpcf7-redirect engancha o wpcf7mailsent para navegar para outra
	 * URL. Não dá para cancelar de forma confiável um listener de terceiro, então
	 * o caminho é avisar quem edita.
	 *
	 * @param WPCF7_ContactForm   $form   Formulário.
	 * @param array<string,mixed> $config Configuração do wizard.
	 * @return void
	 */
	private static function aviso_redirect( $form, array $config ) {
		if ( empty( $config['ativo'] ) ) {
			return;
		}

		$redirect = get_post_meta( $form->id(), '_wpcf7_redirect_page_id', true );
		$url      = get_post_meta( $form->id(), '_wpcf7_redirect_external_url', true );

		if ( empty( $redirect ) && empty( $url ) ) {
			return;
		}

		printf(
			'<div class="notice notice-error inline"><p><strong>%s</strong> %s</p></div>',
			esc_html__( 'Redirect configurado neste formulário.', 'upsites-cf7-multistep' ),
			esc_html__( 'O wizard mostra a própria tela de sucesso, com resumo e botão de WhatsApp. Com o redirect ativo, o visitante é levado embora antes de vê-la. Desligue o redirect na aba correspondente.', 'upsites-cf7-multistep' )
		);
	}

	/**
	 * Linha de campo de texto.
	 *
	 * @param string $chave    Nome do campo.
	 * @param string $rotulo   Rótulo.
	 * @param mixed  $valor    Valor atual.
	 * @param string $descricao Texto de ajuda.
	 * @return void
	 */
	private static function linha_texto( $chave, $rotulo, $valor, $descricao = '' ) {
		$id = 'upms-' . $chave;
		echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $rotulo ) . '</label></th><td>';
		printf(
			'<input type="text" id="%1$s" name="upsites_cf7ms[%2$s]" value="%3$s" class="large-text" />',
			esc_attr( $id ),
			esc_attr( $chave ),
			esc_attr( (string) $valor )
		);
		if ( $descricao ) {
			echo '<p class="description">' . esc_html( $descricao ) . '</p>';
		}
		echo '</td></tr>';
	}

	/**
	 * Linha de textarea.
	 *
	 * @param string $chave     Nome do campo.
	 * @param string $rotulo    Rótulo.
	 * @param mixed  $valor     Valor atual.
	 * @param string $descricao Texto de ajuda.
	 * @return void
	 */
	private static function linha_textarea( $chave, $rotulo, $valor, $descricao = '' ) {
		$id = 'upms-' . $chave;
		echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $rotulo ) . '</label></th><td>';
		printf(
			'<textarea id="%1$s" name="upsites_cf7ms[%2$s]" rows="3" class="large-text">%3$s</textarea>',
			esc_attr( $id ),
			esc_attr( $chave ),
			esc_textarea( (string) $valor )
		);
		if ( $descricao ) {
			echo '<p class="description">' . esc_html( $descricao ) . '</p>';
		}
		echo '</td></tr>';
	}

	/**
	 * Linha de checkbox.
	 *
	 * @param string $chave  Nome do campo.
	 * @param string $rotulo Rótulo.
	 * @param bool   $valor  Valor atual.
	 * @return void
	 */
	private static function linha_checkbox( $chave, $rotulo, $valor ) {
		$id = 'upms-' . $chave;
		echo '<tr><th scope="row">' . esc_html( $rotulo ) . '</th><td>';
		printf(
			'<label for="%1$s"><input type="checkbox" id="%1$s" name="upsites_cf7ms[%2$s]" value="1" %3$s /> %4$s</label>',
			esc_attr( $id ),
			esc_attr( $chave ),
			checked( (bool) $valor, true, false ),
			esc_html__( 'Sim', 'upsites-cf7-multistep' )
		);
		echo '</td></tr>';
	}

	/**
	 * Linha de select.
	 *
	 * @param string   $chave   Nome do campo.
	 * @param string   $rotulo  Rótulo.
	 * @param string[] $opcoes  Mapa valor => rótulo.
	 * @param mixed    $valor   Valor atual.
	 * @return void
	 */
	private static function linha_select( $chave, $rotulo, array $opcoes, $valor ) {
		$id = 'upms-' . $chave;
		echo '<tr><th scope="row"><label for="' . esc_attr( $id ) . '">' . esc_html( $rotulo ) . '</label></th><td>';
		printf( '<select id="%1$s" name="upsites_cf7ms[%2$s]">', esc_attr( $id ), esc_attr( $chave ) );
		foreach ( $opcoes as $v => $r ) {
			printf(
				'<option value="%1$s" %2$s>%3$s</option>',
				esc_attr( $v ),
				selected( (string) $valor, (string) $v, false ),
				esc_html( $r )
			);
		}
		echo '</select></td></tr>';
	}

	/**
	 * Persiste a configuração como property do formulário.
	 *
	 * @param WPCF7_ContactForm $form Formulário salvo.
	 * @return void
	 */
	public static function salvar( $form ) {
		if ( ! isset( $_POST['upsites_cf7ms'] ) || ! is_array( $_POST['upsites_cf7ms'] ) ) {
			return;
		}

		$nonce = isset( $_POST[ self::NONCE ] ) ? sanitize_text_field( wp_unslash( $_POST[ self::NONCE ] ) ) : '';

		if ( ! wp_verify_nonce( $nonce, 'upsites_cf7ms_salvar_' . $form->id() ) ) {
			return;
		}

		if ( ! current_user_can( 'wpcf7_edit_contact_form', $form->id() ) ) {
			return;
		}

		// Sanitização campo a campo acontece dentro de Config::sanitizar().
		$bruto = wp_unslash( $_POST['upsites_cf7ms'] ); // phpcs:ignore WordPress.Security.ValidatedSanitizedInput.InputNotSanitized

		$form->set_properties(
			array( UpSites_CF7MS_Config::PROPRIEDADE => UpSites_CF7MS_Config::sanitizar( (array) $bruto ) )
		);

		$form->save();
	}
}
