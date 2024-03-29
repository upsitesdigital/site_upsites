<?php
/**
 * A configuração de base do WordPress
 *
 * Este ficheiro define os seguintes parâmetros: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, e ABSPATH. Pode obter mais informação
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} no Codex. As definições de MySQL são-lhe fornecidas pelo seu serviço de alojamento.
 *
 * Este ficheiro contém as seguintes configurações:
 *
 * * Configurações de  MySQL
 * * Chaves secretas
 * * Prefixo das tabelas da base de dados
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */
define('WPCF7_AUTOP', false);
// ** Definições de MySQL - obtenha estes dados do seu serviço de alojamento** //
/** O nome da base de dados do WordPress */
define( 'DB_NAME', 'upsites' );

/** O nome do utilizador de MySQL */
define( 'DB_USER', 'root' );

/** A password do utilizador de MySQL  */
define( 'DB_PASSWORD', '' );

/** O nome do serviddor de  MySQL  */
define( 'DB_HOST', 'localhost' );

/** O "Database Charset" a usar na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O "Database Collate type". Se tem dúvidas não mude. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação.
 *
 * Mude para frases únicas e diferentes!
 * Pode gerar frases automáticamente em {@link https://api.wordpress.org/secret-key/1.1/salt/ Serviço de chaves secretas de WordPress.org}
 * Pode mudar estes valores em qualquer altura para invalidar todos os cookies existentes o que terá como resultado obrigar todos os utilizadores a voltarem a fazer login
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY', 'KJe{Q}b`~%:@<w?+A{9m~sC[}/+NX#xscQ]MX&TermH{BbivhV_)DY+$V~u-zssS' );
define( 'SECURE_AUTH_KEY', 'mFK@/6!I.YEkObj6`C-28A(`jx*blG>Ti4W|;wze^?b`TI=]l#m/eB&^NeWaB<N_' );
define( 'LOGGED_IN_KEY', '* iVwo5A<Mj33@[h{$ZSvt7=cyv~x-wIeR9(b<2&4ju?4#%Bu>*hq|7G% &E8Te*' );
define( 'NONCE_KEY', 'Sy.l(ekB/%e}~9FkRg_WaSf@Ok{_/`]XZ| j|%Iu_t$}@`^@cDp^3$7FbhAQTwg8' );
define( 'AUTH_SALT', '|G%HsCSxG3@G$]1N=Yb52i9hBAzVvb(cH2EXl4IdDqMf?q!`UibIxZF,@xf(B>bA' );
define( 'SECURE_AUTH_SALT', 'll(=;mtk*G;6U`Y*~)~<}#?s7j$l!:z`0nKU IXdI+Asj.lvE-~Ai7:A)n%57GU|' );
define( 'LOGGED_IN_SALT', '+Vn0c$;O/Ct`wm@(]adzci2B@w&sp4iu=0kFPfh?bkf2+51f[efTz,[`9R^[!qI/' );
define( 'NONCE_SALT', 'dM>E?:kB`@q;te[r(]vHLI Qq %fg>YBI=wp!1q}/>ErX{;l%RhP@q6~w{Y[R4y#' );

/**#@-*/

/**
 * Prefixo das tabelas de WordPress.
 *
 * Pode suportar múltiplas instalações numa só base de dados, ao dar a cada
 * instalação um prefixo único. Só algarismos, letras e underscores, por favor!
 */
$table_prefix = 'wp_';

/**
 * Para developers: WordPress em modo debugging.
 *
 * Mude isto para true para mostrar avisos enquanto estiver a testar.
 * É vivamente recomendado aos autores de temas e plugins usarem WP_DEBUG
 * no seu ambiente de desenvolvimento.
 *
 * Para mais informações sobre outras constantes que pode usar para debugging,
 * visite o Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );

/* E é tudo. Pare de editar! */

/** Caminho absoluto para a pasta do WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Define as variáveis do WordPress e ficheiros a incluir. */
require_once( ABSPATH . 'wp-settings.php' );
