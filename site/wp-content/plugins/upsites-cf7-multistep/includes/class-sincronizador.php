<?php
/**
 * Sincroniza o formulário CF7 a partir dos arquivos versionados no plugin.
 *
 * O formulário do Contact Form 7 vive no banco, não em arquivo — e o meta
 * `_hash` é não-determinístico (depende de time() e home_url()), então não dá
 * para versionar o post. A fonte da verdade fica em `formularios/` dentro do
 * plugin, e esta classe empurra para o banco.
 *
 * O mesmo código atende três gatilhos: o wp-cli do ambiente local, a tela de
 * administração (único caminho em produção, onde só há wp-admin) e o comando
 * WP-CLI registrado pelo plugin.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Leitura dos arquivos e escrita no formulário CF7.
 */
class UpSites_CF7MS_Sincronizador {

	const OPTION_FORM_ID = 'upsites_cf7ms_form_id';
	const OPTION_BASE    = 'upsites_cf7ms_form_base';
	const TITULO_PADRAO  = 'Orçamento UpSites — Multistep';

	/**
	 * Diretório dos arquivos do formulário.
	 *
	 * @return string
	 */
	public static function diretorio() {
		return UPSITES_CF7MS_DIR . 'formularios/orcamento-multistep/';
	}

	/**
	 * Lê as properties a partir dos arquivos.
	 *
	 * @return array<string,mixed>|WP_Error
	 */
	public static function propriedades_do_arquivo() {
		$dir = self::diretorio();

		$arquivos = array(
			'form'                => 'form.html',
			'mail'                => 'mail.json',
			'mail_2'              => 'mail-2.json',
			'messages'            => 'mensagens.json',
			'additional_settings' => 'configuracoes-adicionais.txt',
		);

		$props = array();

		foreach ( $arquivos as $chave => $arquivo ) {
			$caminho = $dir . $arquivo;

			if ( ! is_readable( $caminho ) ) {
				return new WP_Error(
					'upsites_cf7ms_arquivo_ausente',
					sprintf(
						/* translators: %s: nome do arquivo. */
						__( 'Arquivo do formulário não encontrado: %s', 'upsites-cf7-multistep' ),
						$arquivo
					)
				);
			}

			$conteudo = file_get_contents( $caminho ); // phpcs:ignore WordPress.WP.AlternativeFunctions

			if ( '.json' === substr( $arquivo, -5 ) ) {
				$decodificado = json_decode( $conteudo, true );

				if ( ! is_array( $decodificado ) ) {
					return new WP_Error(
						'upsites_cf7ms_json_invalido',
						sprintf(
							/* translators: %s: nome do arquivo. */
							__( 'JSON inválido em %s', 'upsites-cf7-multistep' ),
							$arquivo
						)
					);
				}

				$props[ $chave ] = $decodificado;
			} else {
				$props[ $chave ] = $conteudo;
			}
		}

		return $props;
	}

	/**
	 * Localiza o formulário alvo.
	 *
	 * Prioriza o ID guardado em option: criar duplicata quebraria qualquer página
	 * que referencie o formulário por ID.
	 *
	 * @return WPCF7_ContactForm|null
	 */
	public static function form_alvo() {
		$id = (int) get_option( self::OPTION_FORM_ID, 0 );

		if ( $id ) {
			$form = wpcf7_contact_form( $id );
			if ( $form instanceof WPCF7_ContactForm ) {
				return $form;
			}
		}

		$por_titulo = wpcf7_get_contact_form_by_title( self::TITULO_PADRAO );

		return $por_titulo instanceof WPCF7_ContactForm ? $por_titulo : null;
	}

	/**
	 * Compara banco, arquivo e a base — o conteúdo aplicado da última vez.
	 *
	 * Saber que "está diferente" não basta para decidir. Com a base guardada dá
	 * para responder a pergunta que importa: aplicar agora desfaz alguma edição
	 * feita no wp-admin?
	 *
	 *   só o arquivo mudou  → o plugin trouxe formulário novo; aplicar é seguro
	 *   só o banco mudou    → alguém editou no admin; aplicar DESFAZ a edição
	 *   os dois mudaram     → conflito; aplicar perde a edição manual
	 *
	 * @return array{estado:string,banco:string,arquivo:string,base:string}|WP_Error
	 */
	public static function comparar() {
		$props = self::propriedades_do_arquivo();

		if ( is_wp_error( $props ) ) {
			return $props;
		}

		$form    = self::form_alvo();
		$banco   = $form ? (string) $form->prop( 'form' ) : '';
		$arquivo = (string) $props['form'];
		$base    = (string) get_option( self::OPTION_BASE, '' );

		$n_banco   = self::normalizar( $banco );
		$n_arquivo = self::normalizar( $arquivo );
		$n_base    = self::normalizar( $base );

		if ( ! $form ) {
			$estado = 'ausente';
		} elseif ( $n_banco === $n_arquivo ) {
			$estado = 'em_dia';
		} elseif ( '' === $n_base ) {
			// Sincronizado por uma versão anterior, que não guardava a base.
			$estado = 'indeterminado';
		} else {
			$bancoMudou   = ( $n_banco !== $n_base );
			$arquivoMudou = ( $n_arquivo !== $n_base );

			if ( $bancoMudou && $arquivoMudou ) {
				$estado = 'conflito';
			} elseif ( $bancoMudou ) {
				$estado = 'editado_no_admin';
			} else {
				$estado = 'plugin_novo';
			}
		}

		return array(
			'estado'    => $estado,
			'diferente' => ( 'em_dia' !== $estado && 'ausente' !== $estado ),
			'banco'     => $banco,
			'arquivo'   => $arquivo,
			'base'      => $base,
		);
	}

	/**
	 * Normaliza para comparar sem ruído de fim de linha.
	 *
	 * @param string $texto Conteúdo.
	 * @return string
	 */
	private static function normalizar( $texto ) {
		return trim( str_replace( array( "\r\n", "\r" ), "\n", (string) $texto ) );
	}

	/**
	 * Aplica os arquivos ao formulário do banco.
	 *
	 * Usa a API do CF7 em vez de escrever os post metas na mão: o save() cuida do
	 * `_hash`, do `_locale` e do `post_content`, e dispara os hooks que os
	 * add-ons escutam.
	 *
	 * @param bool $preservar_config Mantém a configuração do wizard já salva.
	 * @return int|WP_Error ID do post, ou erro.
	 */
	public static function aplicar( $preservar_config = true ) {
		if ( ! class_exists( 'WPCF7_ContactForm' ) ) {
			return new WP_Error( 'upsites_cf7ms_sem_cf7', __( 'Contact Form 7 não está ativo.', 'upsites-cf7-multistep' ) );
		}

		$props = self::propriedades_do_arquivo();

		if ( is_wp_error( $props ) ) {
			return $props;
		}

		$form      = self::form_alvo();
		$existente = $form instanceof WPCF7_ContactForm;

		if ( ! $existente ) {
			// get_template preenche os defaults de mail e messages, então os JSONs
			// podem omitir chaves sem gerar índice indefinido.
			$form = WPCF7_ContactForm::get_template( array( 'title' => self::TITULO_PADRAO ) );
		}

		$config = $preservar_config && $existente
			? UpSites_CF7MS_Config::obter( $form )
			: array_merge(
				UpSites_CF7MS_Config::padroes(),
				array(
					'ativo'    => true,
					'exibicao' => 'modal',
				)
			);

		$props[ UpSites_CF7MS_Config::PROPRIEDADE ] = $config;

		$form->set_title( self::TITULO_PADRAO );

		if ( function_exists( 'wpcf7_is_valid_locale' ) && wpcf7_is_valid_locale( 'pt_BR' ) ) {
			$form->set_locale( 'pt_BR' );
		}

		$form->set_properties( $props );
		$post_id = $form->save();

		if ( ! $post_id ) {
			return new WP_Error( 'upsites_cf7ms_falha_save', __( 'Falha ao salvar o formulário.', 'upsites-cf7-multistep' ) );
		}

		update_option( self::OPTION_FORM_ID, (int) $post_id );
		update_option( 'upsites_cf7ms_form_versao', UPSITES_CF7MS_VERSION );

		// Guarda o que foi aplicado. É esta base que permite, na próxima vez,
		// distinguir "o plugin trouxe novidade" de "alguém editou no admin".
		update_option( self::OPTION_BASE, (string) $props['form'], false );

		if ( function_exists( 'rocket_clean_domain' ) ) {
			rocket_clean_domain();
		}

		return (int) $post_id;
	}
}
