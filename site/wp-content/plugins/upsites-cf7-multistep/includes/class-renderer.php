<?php
/**
 * Transforma o HTML do formulário CF7 em wizard — no SERVIDOR.
 *
 * Por que server-side e não em JS: o alvo roda WP Rocket com Delay JS. Se o
 * fatiamento acontecesse no cliente, o visitante veria as quatro etapas
 * empilhadas até o script acordar. Fatiando aqui, o formulário já nasce correto
 * — sem CLS, sem FOUC — e o JS só acrescenta comportamento.
 *
 * Regra inegociável: qualquer falha devolve o formulário ORIGINAL intacto.
 * Fail-open. Um formulário de página única funcionando é melhor que um erro.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Fatiamento das etapas e montagem do chrome do wizard.
 */
class UpSites_CF7MS_Renderer {

	/**
	 * Conecta os hooks.
	 *
	 * @return void
	 */
	public static function registrar() {
		add_filter( 'wpcf7_form_elements', array( __CLASS__, 'transformar' ), 20, 1 );
		add_filter( 'wpcf7_form_class_attr', array( __CLASS__, 'classe_do_form' ), 10, 1 );
	}

	/**
	 * Marca o <form> para o CSS conseguir escopar sem wrapper extra.
	 *
	 * @param string $classes Classes atuais.
	 * @return string
	 */
	public static function classe_do_form( $classes ) {
		if ( ! UpSites_CF7MS_Config::e_wizard() ) {
			return $classes;
		}

		return trim( $classes . ' upms-form' );
	}

	/**
	 * Ponto de entrada do filtro.
	 *
	 * @param string $html HTML interno do formulário.
	 * @return string
	 */
	public static function transformar( $html ) {
		$form = WPCF7_ContactForm::get_current();

		if ( ! $form instanceof WPCF7_ContactForm || ! UpSites_CF7MS_Config::e_wizard( $form ) ) {
			return $html;
		}

		try {
			$novo = self::montar( $html, UpSites_CF7MS_Config::obter( $form ) );

			return $novo ? $novo : $html;
		} catch ( Throwable $e ) {
			self::registrar_falha( $e );

			return $html;
		} catch ( Exception $e ) { // PHP 7.4 e anteriores.
			self::registrar_falha( $e );

			return $html;
		}
	}

	/**
	 * Registra a falha sem nunca interromper a renderização.
	 *
	 * @param Throwable|Exception $e Erro capturado.
	 * @return void
	 */
	private static function registrar_falha( $e ) {
		if ( defined( 'WP_DEBUG' ) && WP_DEBUG ) {
			error_log( '[upsites-cf7ms] falha ao montar o wizard: ' . $e->getMessage() ); // phpcs:ignore WordPress.PHP.DevelopmentFunctions.error_log_error_log
		}
	}

	/**
	 * Faz o trabalho: separa etapas, move o submit e monta o chrome.
	 *
	 * @param string              $html   HTML interno do formulário.
	 * @param array<string,mixed> $config Configuração do formulário.
	 * @return string|null HTML novo, ou null se não houver etapas.
	 */
	private static function montar( $html, array $config ) {
		$doc = self::carregar( $html );

		if ( ! $doc ) {
			return null;
		}

		list( $documento, $raiz ) = $doc;

		$xpath = new DOMXPath( $documento );
		$etapas = $xpath->query( './/div[contains(concat(" ", normalize-space(@class), " "), " up-step ")]', $raiz );

		if ( ! $etapas || 0 === $etapas->length ) {
			return null; // Sem etapas marcadas, não há wizard a montar.
		}

		// Snapshot: a NodeList é viva e reordenar nós durante a iteração a corrompe.
		$lista_etapas = array();
		foreach ( $etapas as $etapa ) {
			$lista_etapas[] = $etapa;
		}

		$submit = self::achar_submit( $xpath, $raiz );

		// ------------------------------------------------------------ estrutura
		$wrapper = $documento->createElement( 'div' );
		$wrapper->setAttribute( 'class', 'upms' );
		$wrapper->setAttribute( 'data-upms', '1' );

		$wizard = $documento->createElement( 'div' );
		$wizard->setAttribute( 'class', 'upms__wizard' );
		$wizard->setAttribute( 'data-upms-wizard', '1' );

		$wizard->appendChild( self::indicador( $documento, $lista_etapas ) );

		$painel = $documento->createElement( 'div' );
		$painel->setAttribute( 'class', 'upms__painel' );
		$painel->setAttribute( 'data-upms-painel', '1' );
		$painel->setAttribute( 'aria-live', 'polite' );

		foreach ( $lista_etapas as $indice => $etapa ) {
			self::preparar_etapa( $documento, $etapa, $indice );
			$painel->appendChild( $etapa ); // appendChild move o nó.
		}

		$wizard->appendChild( $painel );
		$wizard->appendChild( self::navegacao( $documento, $submit ) );

		// O que sobrou fora das etapas — consentimento, honeypot, campos ocultos,
		// reCAPTCHA — permanece na ordem autoral, abaixo da navegação. É onde o
		// aviso de consentimento fica na LP.
		$cauda = $documento->createElement( 'div' );
		$cauda->setAttribute( 'class', 'upms__cauda' );

		while ( $raiz->firstChild ) {
			$cauda->appendChild( $raiz->firstChild );
		}

		$wizard->appendChild( $cauda );
		$wrapper->appendChild( $wizard );
		$wrapper->appendChild( self::tela_de_sucesso( $documento, $config ) );

		$raiz->appendChild( $wrapper );

		return self::serializar( $documento, $raiz );
	}

	/**
	 * Carrega o HTML preservando UTF-8.
	 *
	 * Usa o prefixo <?xml encoding="utf-8"?> em vez de mb_convert_encoding com
	 * 'HTML-ENTITIES', que está deprecado desde o PHP 8.2.
	 *
	 * @param string $html HTML interno do formulário.
	 * @return array{0:DOMDocument,1:DOMElement}|null
	 */
	private static function carregar( $html ) {
		$documento = new DOMDocument( '1.0', 'UTF-8' );
		$documento->preserveWhiteSpace = true;
		$documento->formatOutput       = false;

		$anterior = libxml_use_internal_errors( true );

		$carregou = $documento->loadHTML(
			'<?xml encoding="utf-8" ?><div id="upms-raiz">' . $html . '</div>',
			LIBXML_HTML_NOIMPLIED | LIBXML_HTML_NODEFDTD
		);

		libxml_clear_errors();
		libxml_use_internal_errors( $anterior );

		if ( ! $carregou ) {
			return null;
		}

		foreach ( $documento->childNodes as $no ) {
			if ( XML_ELEMENT_NODE === $no->nodeType && 'upms-raiz' === $no->getAttribute( 'id' ) ) {
				return array( $documento, $no );
			}
		}

		return null;
	}

	/**
	 * Devolve o HTML interno da raiz, sem a div auxiliar.
	 *
	 * @param DOMDocument $documento Documento.
	 * @param DOMElement  $raiz      Raiz auxiliar.
	 * @return string
	 */
	private static function serializar( DOMDocument $documento, DOMElement $raiz ) {
		$saida = '';

		foreach ( $raiz->childNodes as $filho ) {
			$saida .= $documento->saveHTML( $filho );
		}

		return $saida;
	}

	/**
	 * Localiza o botão de envio do CF7.
	 *
	 * @param DOMXPath   $xpath XPath do documento.
	 * @param DOMElement $raiz  Raiz da busca.
	 * @return DOMElement|null
	 */
	private static function achar_submit( DOMXPath $xpath, DOMElement $raiz ) {
		$nos = $xpath->query( './/input[@type="submit"] | .//button[@type="submit"]', $raiz );

		return ( $nos && $nos->length ) ? $nos->item( 0 ) : null;
	}

	/**
	 * Prepara uma etapa: índice, visibilidade e título acessível.
	 *
	 * @param DOMDocument $documento Documento.
	 * @param DOMElement  $etapa     Elemento da etapa.
	 * @param int         $indice    Índice base zero.
	 * @return void
	 */
	private static function preparar_etapa( DOMDocument $documento, DOMElement $etapa, $indice ) {
		$etapa->setAttribute( 'data-upms-etapa', (string) $indice );
		$etapa->setAttribute( 'role', 'group' );

		if ( 0 !== $indice ) {
			$etapa->setAttribute( 'hidden', 'hidden' );
		}

		$titulo    = trim( $etapa->getAttribute( 'data-title' ) );
		$subtitulo = trim( $etapa->getAttribute( 'data-sub' ) );

		if ( '' === $titulo && '' === $subtitulo ) {
			return;
		}

		$cabecalho = $documento->createElement( 'div' );
		$cabecalho->setAttribute( 'class', 'upms__cabecalho' );

		if ( '' !== $titulo ) {
			$h = $documento->createElement( 'h2' );
			$h->setAttribute( 'class', 'upms__titulo' );
			$h->setAttribute( 'tabindex', '-1' );
			$h->appendChild( $documento->createTextNode( $titulo ) );
			$cabecalho->appendChild( $h );

			$etapa->setAttribute( 'aria-label', $titulo );
		}

		if ( '' !== $subtitulo ) {
			$p = $documento->createElement( 'p' );
			$p->setAttribute( 'class', 'upms__subtitulo' );
			$p->appendChild( $documento->createTextNode( $subtitulo ) );
			$cabecalho->appendChild( $p );
		}

		$etapa->insertBefore( $cabecalho, $etapa->firstChild );
	}

	/**
	 * Monta o indicador de progresso.
	 *
	 * O rótulo aparece só na etapa corrente — as demais ficam com o número. Isso
	 * compacta o indicador e evita colisão com o botão de fechar no mobile.
	 *
	 * @param DOMDocument     $documento Documento.
	 * @param DOMElement[]    $etapas    Etapas encontradas.
	 * @return DOMElement
	 */
	private static function indicador( DOMDocument $documento, array $etapas ) {
		$ol = $documento->createElement( 'ol' );
		$ol->setAttribute( 'class', 'upms__etapas' );
		$ol->setAttribute( 'data-upms-indicador', '1' );

		$total = count( $etapas );

		foreach ( $etapas as $indice => $etapa ) {
			$curto = trim( $etapa->getAttribute( 'data-short' ) );
			$curto = '' !== $curto ? $curto : (string) ( $indice + 1 );

			$li = $documento->createElement( 'li' );
			$li->setAttribute( 'class', 0 === $indice ? 'upms__etapa-item is-atual' : 'upms__etapa-item' );
			$li->setAttribute( 'data-upms-indice', (string) $indice );

			if ( 0 === $indice ) {
				$li->setAttribute( 'aria-current', 'step' );
			}

			$bolha = $documento->createElement( 'span' );
			$bolha->setAttribute( 'class', 'upms__bolha' );
			$bolha->appendChild( $documento->createTextNode( (string) ( $indice + 1 ) ) );
			$li->appendChild( $bolha );

			$rotulo = $documento->createElement( 'span' );
			$rotulo->setAttribute( 'class', 'upms__etapa-rotulo' );
			$rotulo->appendChild( $documento->createTextNode( $curto ) );
			$li->appendChild( $rotulo );

			// Texto só para leitor de tela: "Etapa 2 de 4".
			$sr = $documento->createElement( 'span' );
			$sr->setAttribute( 'class', 'upms__sr' );
			$sr->appendChild(
				$documento->createTextNode(
					sprintf(
						/* translators: 1: número da etapa; 2: total de etapas. */
						__( 'Etapa %1$d de %2$d', 'upsites-cf7-multistep' ),
						$indice + 1,
						$total
					)
				)
			);
			$li->appendChild( $sr );

			$ol->appendChild( $li );
		}

		return $ol;
	}

	/**
	 * Monta a barra de navegação, movendo o submit nativo para dentro dela.
	 *
	 * Mover — em vez de criar um botão novo e disparar submit sintético — mantém
	 * o rótulo editável no CF7 e o submit sendo o do próprio CF7.
	 *
	 * @param DOMDocument     $documento Documento.
	 * @param DOMElement|null $submit    Botão de envio, se houver.
	 * @return DOMElement
	 */
	private static function navegacao( DOMDocument $documento, $submit ) {
		$nav = $documento->createElement( 'div' );
		$nav->setAttribute( 'class', 'upms__nav' );

		$voltar = $documento->createElement( 'button' );
		$voltar->setAttribute( 'type', 'button' );
		$voltar->setAttribute( 'class', 'upms__btn upms__btn--voltar' );
		$voltar->setAttribute( 'data-upms-voltar', '1' );
		$voltar->setAttribute( 'hidden', 'hidden' );
		$voltar->appendChild( $documento->createTextNode( __( 'Voltar', 'upsites-cf7-multistep' ) ) );
		$nav->appendChild( $voltar );

		$avancar = $documento->createElement( 'button' );
		$avancar->setAttribute( 'type', 'button' );
		$avancar->setAttribute( 'class', 'upms__btn upms__btn--avancar' );
		$avancar->setAttribute( 'data-upms-avancar', '1' );
		$avancar->appendChild( $documento->createTextNode( __( 'Continuar', 'upsites-cf7-multistep' ) ) );
		$nav->appendChild( $avancar );

		if ( $submit ) {
			$classe = trim( $submit->getAttribute( 'class' ) . ' upms__btn upms__btn--enviar' );
			$submit->setAttribute( 'class', $classe );
			$submit->setAttribute( 'data-upms-enviar', '1' );
			$submit->setAttribute( 'hidden', 'hidden' );
			$nav->appendChild( $submit ); // Move o nó original.
		}

		return $nav;
	}

	/**
	 * Esqueleto da tela de sucesso, preenchido pelo JS após o wpcf7mailsent.
	 *
	 * Renderizado no servidor para manter o CSS estável e evitar FOUC.
	 *
	 * @param DOMDocument         $documento Documento.
	 * @param array<string,mixed> $config    Configuração do formulário.
	 * @return DOMElement
	 */
	private static function tela_de_sucesso( DOMDocument $documento, array $config ) {
		$done = $documento->createElement( 'div' );
		$done->setAttribute( 'class', 'upms__sucesso' );
		$done->setAttribute( 'data-upms-sucesso', '1' );
		$done->setAttribute( 'hidden', 'hidden' );
		$done->setAttribute( 'aria-live', 'polite' );

		$icone = $documento->createElement( 'div' );
		$icone->setAttribute( 'class', 'upms__sucesso-icone' );
		$icone->setAttribute( 'aria-hidden', 'true' );
		$done->appendChild( $icone );

		$h = $documento->createElement( 'h2' );
		$h->setAttribute( 'class', 'upms__sucesso-titulo' );
		$h->setAttribute( 'tabindex', '-1' );
		$h->appendChild( $documento->createTextNode( $config['sucesso_titulo'] ) );
		$done->appendChild( $h );

		$p = $documento->createElement( 'p' );
		$p->setAttribute( 'class', 'upms__sucesso-msg' );
		$p->setAttribute( 'data-upms-sucesso-msg', '1' );
		$done->appendChild( $p );

		$recap = $documento->createElement( 'dl' );
		$recap->setAttribute( 'class', 'upms__recap' );
		$recap->setAttribute( 'data-upms-recap', '1' );
		$done->appendChild( $recap );

		$wa = $documento->createElement( 'a' );
		$wa->setAttribute( 'class', 'upms__btn upms__btn--whatsapp' );
		$wa->setAttribute( 'data-upms-whatsapp', '1' );
		$wa->setAttribute( 'href', '#' );
		$wa->setAttribute( 'target', '_blank' );
		$wa->setAttribute( 'rel', 'noopener' );
		$wa->appendChild( $documento->createTextNode( __( 'Falar agora no WhatsApp', 'upsites-cf7-multistep' ) ) );
		$done->appendChild( $wa );

		$reiniciar = $documento->createElement( 'button' );
		$reiniciar->setAttribute( 'type', 'button' );
		$reiniciar->setAttribute( 'class', 'upms__reiniciar' );
		$reiniciar->setAttribute( 'data-upms-reiniciar', '1' );
		$reiniciar->appendChild( $documento->createTextNode( __( 'Enviar outra resposta', 'upsites-cf7-multistep' ) ) );
		$done->appendChild( $reiniciar );

		return $done;
	}
}
