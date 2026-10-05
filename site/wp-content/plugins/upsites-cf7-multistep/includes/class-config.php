<?php
/**
 * Configuração por formulário.
 *
 * Guardada como *property* do WPCF7_ContactForm (não em wp_options), para que o
 * botão "Duplicate" do CF7 leve a configuração junto e cada formulário tenha a
 * sua — replicar o wizard não pode exigir tocar em código.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Leitura e escrita da configuração do wizard.
 */
class UpSites_CF7MS_Config {

	const PROPRIEDADE = 'upsites_cf7ms';

	/**
	 * Endpoint de produção do middleware de leads.
	 */
	const ENDPOINT_PADRAO = 'https://web-production-9b27d.up.railway.app/webhook/lp-google-ads';

	/**
	 * Texto do aviso de consentimento. Precisa casar com o HTML do formulário —
	 * é ele que vai para a trilha de auditoria da LGPD.
	 */
	const CONSENTIMENTO_TEXTO = 'Autorizo a UpSites e seus representantes a entrarem em contato por telefone, WhatsApp e e-mail sobre a minha solicitação, conforme a Política de Privacidade.';

	/**
	 * Versão do texto acima. Bumpar quando o texto mudar, para rastrear qual
	 * versão cada lead viu.
	 */
	const CONSENTIMENTO_VERSAO = 'v1-2026-07';

	/**
	 * Valores padrão da configuração.
	 *
	 * @return array<string,mixed>
	 */
	public static function padroes() {
		return array(
			'ativo'               => false,
			'exibicao'            => 'modal',
			'gatilho_seletor'     => 'a[href="#solicitar-orcamento"], a[href*="/orcamentos"], .up-abrir-orcamento',
			'exibir_em'           => 'home',
			'endpoint'            => '',
			'rascunho_ativo'      => true,
			'origem'              => 'site_principal',
			'whatsapp_numero'     => '551141303275',
			'whatsapp_mensagem'   => 'Olá! Sou {primeiro_nome} e tenho interesse em {tipo_projeto} — acabei de enviar o formulário no site.',
			'sucesso_titulo'      => 'Recebemos seu pedido!',
			'sucesso_mensagem'    => 'Obrigado, {primeiro_nome}! Nossa equipe vai analisar e te chamar bem rápido. Se quiser adiantar, fale agora no WhatsApp.',
			'recap_campos'        => 'nome,telefone,email,empresa,site_url,tipo_projeto,prazo',
			'consentimento_versao' => self::CONSENTIMENTO_VERSAO,
			'conversao_quando'    => 'middleware',
			'conversao_valor'     => 200,
			'painel_titulo'       => 'Vamos colocar seu projeto em órbita.',
			'painel_subtitulo'    => 'Conte o que você precisa — a gente cuida do resto, do planejamento ao lançamento, e além.',
		);
	}

	/**
	 * Registra a property no CF7. Sem isto, set_properties() a descarta.
	 *
	 * @param array $propriedades Properties conhecidas pelo CF7.
	 * @return array
	 */
	public static function registrar_propriedade( $propriedades ) {
		$propriedades[ self::PROPRIEDADE ] = self::padroes();

		return $propriedades;
	}

	/**
	 * Lê a configuração de um formulário, já mesclada com os padrões.
	 *
	 * @param WPCF7_ContactForm|null $form Formulário; null usa o corrente.
	 * @return array<string,mixed>
	 */
	public static function obter( $form = null ) {
		if ( null === $form ) {
			$form = WPCF7_ContactForm::get_current();
		}

		if ( ! $form instanceof WPCF7_ContactForm ) {
			return self::padroes();
		}

		$salva = $form->prop( self::PROPRIEDADE );
		$salva = is_array( $salva ) ? $salva : array();

		return array_merge( self::padroes(), $salva );
	}

	/**
	 * Diz se o formulário está configurado como wizard.
	 *
	 * @param WPCF7_ContactForm|null $form Formulário; null usa o corrente.
	 * @return bool
	 */
	public static function e_wizard( $form = null ) {
		$config = self::obter( $form );

		return ! empty( $config['ativo'] );
	}

	/**
	 * Resolve o endpoint do middleware.
	 *
	 * Precedência: constante UPSITES_CF7MS_ENDPOINT (é o que o ambiente local usa
	 * para apontar ao mock) > configuração do formulário > padrão de produção.
	 * O filtro permite sobrepor tudo.
	 *
	 * @param array<string,mixed> $config Configuração do formulário.
	 * @return string
	 */
	public static function endpoint( array $config ) {
		if ( defined( 'UPSITES_CF7MS_ENDPOINT' ) && UPSITES_CF7MS_ENDPOINT ) {
			$url = UPSITES_CF7MS_ENDPOINT;
		} elseif ( ! empty( $config['endpoint'] ) ) {
			$url = $config['endpoint'];
		} else {
			$url = self::ENDPOINT_PADRAO;
		}

		/**
		 * Permite trocar o endpoint do middleware.
		 *
		 * @param string $url    URL do endpoint.
		 * @param array  $config Configuração do formulário.
		 */
		return apply_filters( 'upsites_cf7ms_endpoint', $url, $config );
	}

	/**
	 * Sanitiza a configuração vinda do editor do CF7.
	 *
	 * @param array $bruto Dados de $_POST já desempacotados.
	 * @return array<string,mixed>
	 */
	public static function sanitizar( array $bruto ) {
		$padroes = self::padroes();
		$limpo   = array();

		foreach ( $padroes as $chave => $padrao ) {
			$valor = isset( $bruto[ $chave ] ) ? $bruto[ $chave ] : null;

			if ( is_bool( $padrao ) ) {
				$limpo[ $chave ] = ! empty( $valor );
				continue;
			}

			if ( is_int( $padrao ) ) {
				$limpo[ $chave ] = null === $valor ? $padrao : (int) $valor;
				continue;
			}

			if ( 'endpoint' === $chave ) {
				$limpo[ $chave ] = $valor ? esc_url_raw( trim( $valor ) ) : '';
				continue;
			}

			if ( 'origem' === $chave ) {
				$limpo[ $chave ] = $valor ? sanitize_key( $valor ) : $padrao;
				continue;
			}

			if ( in_array( $chave, array( 'whatsapp_mensagem', 'sucesso_mensagem', 'painel_subtitulo' ), true ) ) {
				$limpo[ $chave ] = null === $valor ? $padrao : sanitize_textarea_field( $valor );
				continue;
			}

			$limpo[ $chave ] = null === $valor ? $padrao : sanitize_text_field( $valor );
		}

		return $limpo;
	}
}
