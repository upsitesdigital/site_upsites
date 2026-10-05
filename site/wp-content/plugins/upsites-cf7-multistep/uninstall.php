<?php
/**
 * Desinstalação: remove as options do plugin.
 *
 * O formulário CF7 em si NÃO é removido — ele é conteúdo do cliente, criado pelo
 * Contact Form 7, e apagá-lo levaria junto o histórico de submissões do Flamingo.
 *
 * @package UpSites_CF7MS
 */

defined( 'WP_UNINSTALL_PLUGIN' ) || exit;

delete_option( 'upsites_cf7ms_form_id' );
delete_option( 'upsites_cf7ms_form_versao' );
delete_option( 'upsites_cf7ms_config' );
delete_option( 'upsites_cf7ms_form_base' );
