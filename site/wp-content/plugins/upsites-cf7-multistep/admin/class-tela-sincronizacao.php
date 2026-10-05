<?php
/**
 * Tela "Sincronizar formulário", em Contato → Sincronizar formulário.
 *
 * Em produção só existe wp-admin: sem SSH e sem wp-cli, esta tela é o único
 * caminho para levar o formulário versionado do plugin até o banco.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Página de administração da sincronização.
 */
class UpSites_CF7MS_Tela_Sincronizacao {

	const SLUG  = 'upsites-cf7ms-sincronizar';
	const NONCE = 'upsites_cf7ms_sincronizar';

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_action( 'admin_menu', array( __CLASS__, 'adicionar_pagina' ), 20 );
	}

	/**
	 * Adiciona a página como submenu do Contact Form 7.
	 *
	 * @return void
	 */
	public static function adicionar_pagina() {
		add_submenu_page(
			'wpcf7',
			__( 'Sincronizar formulário', 'upsites-cf7-multistep' ),
			__( 'Sincronizar formulário', 'upsites-cf7-multistep' ),
			'wpcf7_edit_contact_forms',
			self::SLUG,
			array( __CLASS__, 'render' )
		);
	}

	/**
	 * Renderiza a página.
	 *
	 * @return void
	 */
	public static function render() {
		if ( ! current_user_can( 'wpcf7_edit_contact_forms' ) ) {
			wp_die( esc_html__( 'Sem permissão.', 'upsites-cf7-multistep' ) );
		}

		$mensagem = self::processar_envio();

		echo '<div class="wrap"><h1>' . esc_html__( 'Sincronizar formulário', 'upsites-cf7-multistep' ) . '</h1>';

		if ( $mensagem ) {
			printf(
				'<div class="notice notice-%1$s"><p>%2$s</p></div>',
				esc_attr( $mensagem['tipo'] ),
				esc_html( $mensagem['texto'] )
			);
		}

		echo '<p>' . esc_html__(
			'O conteúdo do formulário é versionado dentro do plugin. Esta tela aplica a versão do plugin ao formulário do Contact Form 7 que está no banco.',
			'upsites-cf7-multistep'
		) . '</p>';

		$comparacao = UpSites_CF7MS_Sincronizador::comparar();

		if ( is_wp_error( $comparacao ) ) {
			printf(
				'<div class="notice notice-error"><p>%s</p></div></div>',
				esc_html( $comparacao->get_error_message() )
			);
			return;
		}

		$form   = UpSites_CF7MS_Sincronizador::form_alvo();
		$versao = get_option( 'upsites_cf7ms_form_versao', '—' );

		$situacao = self::descrever( $comparacao['estado'] );

		echo '<table class="widefat striped" style="max-width:760px"><tbody>';
		self::linha( __( 'Formulário no banco', 'upsites-cf7-multistep' ), $form ? sprintf( '#%d — %s', $form->id(), $form->title() ) : __( 'ainda não criado', 'upsites-cf7-multistep' ) );
		self::linha( __( 'Versão aplicada', 'upsites-cf7-multistep' ), $versao );
		self::linha( __( 'Versão no plugin', 'upsites-cf7-multistep' ), UPSITES_CF7MS_VERSION );
		self::linha( __( 'Situação', 'upsites-cf7-multistep' ), $situacao['resumo'] );
		echo '</tbody></table>';

		printf(
			'<div class="notice notice-%1$s inline" style="margin:16px 0;max-width:760px"><p>%2$s</p></div>',
			esc_attr( $situacao['tom'] ),
			esc_html( $situacao['explicacao'] )
		);

		if ( $comparacao['diferente'] ) {
			// Quem edita no admin precisa ver o que seria desfeito, não só que
			// "está diferente".
			if ( in_array( $comparacao['estado'], array( 'editado_no_admin', 'conflito' ), true ) ) {
				echo '<h2>' . esc_html__( 'O que foi editado no wp-admin', 'upsites-cf7-multistep' ) . '</h2>';
				echo '<p class="description">' . esc_html__(
					'Esta é a edição que será desfeita se você aplicar. Copie o que quiser preservar antes.',
					'upsites-cf7-multistep'
				) . '</p>';

				$diff_manual = wp_text_diff(
					$comparacao['base'],
					$comparacao['banco'],
					array(
						'title_left'  => __( 'Aplicado da última vez', 'upsites-cf7-multistep' ),
						'title_right' => __( 'No banco agora (sua edição)', 'upsites-cf7-multistep' ),
					)
				);

				echo $diff_manual ? wp_kses_post( $diff_manual ) : '<p>' . esc_html__( 'Sem diferenças de texto.', 'upsites-cf7-multistep' ) . '</p>';
			}

			echo '<h2>' . esc_html__( 'O que a aplicação vai gravar', 'upsites-cf7-multistep' ) . '</h2>';

			$diff = wp_text_diff(
				$comparacao['banco'],
				$comparacao['arquivo'],
				array(
					'title_left'  => __( 'No banco (atual)', 'upsites-cf7-multistep' ),
					'title_right' => __( 'No plugin (novo)', 'upsites-cf7-multistep' ),
				)
			);

			echo $diff ? wp_kses_post( $diff ) : '<p>' . esc_html__( 'Sem diferenças de texto.', 'upsites-cf7-multistep' ) . '</p>';
		}

		echo '<form method="post" style="margin-top:20px">';
		wp_nonce_field( self::NONCE, '_upsites_cf7ms_nonce' );

		echo '<p><label><input type="checkbox" name="preservar_config" value="1" checked /> ';
		esc_html_e( 'Manter a configuração da aba “Wizard UpSites” já salva neste formulário', 'upsites-cf7-multistep' );
		echo '</label></p>';

		submit_button(
			$form
				? __( 'Aplicar a versão do plugin', 'upsites-cf7-multistep' )
				: __( 'Criar o formulário', 'upsites-cf7-multistep' ),
			'primary',
			'upsites_cf7ms_aplicar'
		);

		echo '</form></div>';
	}

	/**
	 * Texto e tom para cada estado da comparação.
	 *
	 * @param string $estado Estado devolvido por Sincronizador::comparar().
	 * @return array{resumo:string,explicacao:string,tom:string}
	 */
	private static function descrever( $estado ) {
		switch ( $estado ) {
			case 'ausente':
				return array(
					'resumo'     => __( 'Formulário ainda não criado.', 'upsites-cf7-multistep' ),
					'explicacao' => __( 'Clique no botão abaixo para criar o formulário a partir do arquivo do plugin.', 'upsites-cf7-multistep' ),
					'tom'        => 'info',
				);

			case 'em_dia':
				return array(
					'resumo'     => __( 'Em dia.', 'upsites-cf7-multistep' ),
					'explicacao' => __( 'O formulário no banco é igual ao do plugin. Não há nada a aplicar.', 'upsites-cf7-multistep' ),
					'tom'        => 'success',
				);

			case 'plugin_novo':
				return array(
					'resumo'     => __( 'O plugin trouxe uma versão nova do formulário.', 'upsites-cf7-multistep' ),
					'explicacao' => __( 'Ninguém editou o formulário no wp-admin desde a última sincronização. Aplicar é seguro: não há edição sua para perder.', 'upsites-cf7-multistep' ),
					'tom'        => 'info',
				);

			case 'editado_no_admin':
				return array(
					'resumo'     => __( 'O formulário foi editado aqui no wp-admin.', 'upsites-cf7-multistep' ),
					'explicacao' => __( 'O plugin não trouxe formulário novo — a diferença é a sua edição. Aplicar agora DESFAZ essa edição. Se ela é para valer, mande o conteúdo para quem mantém o plugin, para virar a nova versão do arquivo.', 'upsites-cf7-multistep' ),
					'tom'        => 'warning',
				);

			case 'conflito':
				return array(
					'resumo'     => __( 'Conflito: o formulário mudou nos dois lados.', 'upsites-cf7-multistep' ),
					'explicacao' => __( 'O plugin trouxe uma versão nova E alguém editou o formulário no wp-admin. Aplicar mantém a versão do plugin e descarta a edição feita aqui. Confira os dois blocos abaixo antes de decidir.', 'upsites-cf7-multistep' ),
					'tom'        => 'error',
				);

			default:
				return array(
					'resumo'     => __( 'O banco está diferente do arquivo.', 'upsites-cf7-multistep' ),
					'explicacao' => __( 'Não dá para saber de onde veio a diferença: este formulário foi sincronizado por uma versão do plugin que ainda não guardava essa referência. A partir da próxima aplicação, esta tela passa a distinguir edição no admin de versão nova do plugin.', 'upsites-cf7-multistep' ),
					'tom'        => 'warning',
				);
		}
	}

	/**
	 * Processa o POST de aplicação.
	 *
	 * @return array{tipo:string,texto:string}|null
	 */
	private static function processar_envio() {
		if ( ! isset( $_POST['upsites_cf7ms_aplicar'] ) ) {
			return null;
		}

		$nonce = isset( $_POST['_upsites_cf7ms_nonce'] )
			? sanitize_text_field( wp_unslash( $_POST['_upsites_cf7ms_nonce'] ) )
			: '';

		if ( ! wp_verify_nonce( $nonce, self::NONCE ) ) {
			return array(
				'tipo'  => 'error',
				'texto' => __( 'Sessão expirada. Recarregue a página e tente de novo.', 'upsites-cf7-multistep' ),
			);
		}

		if ( ! current_user_can( 'wpcf7_edit_contact_forms' ) ) {
			return array( 'tipo' => 'error', 'texto' => __( 'Sem permissão.', 'upsites-cf7-multistep' ) );
		}

		$preservar = ! empty( $_POST['preservar_config'] );
		$resultado = UpSites_CF7MS_Sincronizador::aplicar( $preservar );

		if ( is_wp_error( $resultado ) ) {
			return array( 'tipo' => 'error', 'texto' => $resultado->get_error_message() );
		}

		return array(
			'tipo'  => 'success',
			'texto' => sprintf(
				/* translators: %d: ID do formulário. */
				__( 'Formulário #%d sincronizado. Se o site usa cache, limpe-o antes de conferir.', 'upsites-cf7-multistep' ),
				$resultado
			),
		);
	}

	/**
	 * Linha da tabela de situação.
	 *
	 * @param string $rotulo Rótulo.
	 * @param string $valor  Valor.
	 * @return void
	 */
	private static function linha( $rotulo, $valor ) {
		printf(
			'<tr><th scope="row" style="width:220px">%s</th><td>%s</td></tr>',
			esc_html( $rotulo ),
			esc_html( $valor )
		);
	}
}
