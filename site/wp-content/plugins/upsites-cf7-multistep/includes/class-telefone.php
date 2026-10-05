<?php
/**
 * Normalização de telefone.
 *
 * Classe pura, sem nenhuma chamada ao WordPress — é testável com PHPUnit sem
 * bootstrap. O JS do wizard tem a implementação espelho em assets/js/wizard.js;
 * as duas precisam concordar.
 *
 * @package UpSites_CF7MS
 */

defined( 'ABSPATH' ) || exit;

/**
 * Converte telefone digitado para o formato canônico esperado pelo middleware.
 */
class UpSites_CF7MS_Telefone {

	/**
	 * Monta o telefone em E.164 sem o "+": só dígitos, com código do país.
	 *
	 * O middleware grava exatamente isto (ex.: 5511999999999) e prefixa "+55"
	 * na saída para os destinos que exigem. Passar o número formatado com
	 * máscara aqui é seguro: tudo que não é dígito é descartado.
	 *
	 * @param string $ddi      Código do país, com ou sem "+" (ex.: "+55").
	 * @param string $telefone Número nacional, com ou sem máscara.
	 * @return string Só dígitos. String vazia se não houver número.
	 */
	public static function e164( $ddi, $telefone ) {
		$pais     = preg_replace( '/\D/', '', (string) $ddi );
		$nacional = preg_replace( '/\D/', '', (string) $telefone );

		if ( '' === $nacional ) {
			return '';
		}

		// Número já digitado com o código do país embutido não deve duplicá-lo.
		if ( '' !== $pais && 0 === strpos( $nacional, $pais ) && strlen( $nacional ) > strlen( $pais ) + 7 ) {
			return $nacional;
		}

		return $pais . $nacional;
	}

	/**
	 * Aplica a máscara brasileira: (11) 99999-9999 ou (11) 9999-9999.
	 *
	 * @param string $bruto Entrada do usuário.
	 * @return string Número mascarado.
	 */
	public static function mascara_br( $bruto ) {
		$d = substr( preg_replace( '/\D/', '', (string) $bruto ), 0, 11 );
		$n = strlen( $d );

		if ( 0 === $n ) {
			return '';
		}
		if ( $n <= 2 ) {
			return '(' . $d;
		}
		if ( $n <= 6 ) {
			return '(' . substr( $d, 0, 2 ) . ') ' . substr( $d, 2 );
		}
		if ( $n <= 10 ) {
			return '(' . substr( $d, 0, 2 ) . ') ' . substr( $d, 2, 4 ) . '-' . substr( $d, 6 );
		}

		return '(' . substr( $d, 0, 2 ) . ') ' . substr( $d, 2, 5 ) . '-' . substr( $d, 7 );
	}

	/**
	 * Diz se o número parece um celular brasileiro (11 dígitos, 9 no início do número).
	 *
	 * @param string $telefone Número, com ou sem máscara.
	 * @return bool
	 */
	public static function e_celular_br( $telefone ) {
		$d = preg_replace( '/\D/', '', (string) $telefone );

		return 11 === strlen( $d ) && '9' === $d[2];
	}
}
