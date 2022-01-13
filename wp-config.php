<?php
/**
 * As configurações básicas do WordPress
 *
 * O script de criação wp-config.php usa esse arquivo durante a instalação.
 * Você não precisa usar o site, você pode copiar este arquivo
 * para "wp-config.php" e preencher os valores.
 *
 * Este arquivo contém as seguintes configurações:
 *
 * * Configurações do MySQL
 * * Chaves secretas
 * * Prefixo do banco de dados
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar estas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define( 'DB_NAME', 'meuprimeirotema' );

/** Usuário do banco de dados MySQL */
define( 'DB_USER', 'root' );

/** Senha do banco de dados MySQL */
define( 'DB_PASSWORD', '' );

/** Nome do host do MySQL */
define( 'DB_HOST', 'localhost' );

/** Charset do banco de dados a ser usado na criação das tabelas. */
define( 'DB_CHARSET', 'utf8mb4' );

/** O tipo de Collate do banco de dados. Não altere isso se tiver dúvidas. */
define( 'DB_COLLATE', '' );

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las
 * usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org
 * secret-key service}
 * Você pode alterá-las a qualquer momento para invalidar quaisquer
 * cookies existentes. Isto irá forçar todos os
 * usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'VS^7K{#,HHiIh#Fm!GjSH)<YIA]bQ14X1w<9mZ9BMSB<hojm[<jjb}!z@v&2}Sd1' );
define( 'SECURE_AUTH_KEY',  '$w=[4<9VY!-TkTZFYGa2B[jjd5KH>Zcs~_$~=u:DK(Vv ML*fw5$N:o.:M3/av?Z' );
define( 'LOGGED_IN_KEY',    'ET8;.rF;YO7pY]SMQkLs(N[wIbI;rz2Pqd+KD)%GcbvSx{)1g>:H:7tDBflN)Z-2' );
define( 'NONCE_KEY',        'zne%gKTh>0e*bdDE!H!S5l(O]$<j;q?{Kby6kI~|#$A7}%LVQ=>6j:)+fpqiFwyE' );
define( 'AUTH_SALT',        '26,!9_0Z!uq;DQ!T/1A(>KjHX`H$%e(O>X7Auxc#,8t*YF#oTM(c83 xQ]&Nyw!I' );
define( 'SECURE_AUTH_SALT', 'yBk--f53&1^=ZvBwex&<] U<!OF{s;k8,)x(}Z_Q3zmhcd}!34nv0LlQS+$rpMQ^' );
define( 'LOGGED_IN_SALT',   '7hT,|lg8[2EUTTIOa_G$2t_scmZGwi@RegO|Nr;/9>DKMT-YQ^5vW~NJ=kmc `|7' );
define( 'NONCE_SALT',       'w>K5z8R2x4~t}G*dlqg^xso,IZEc}*}lW653n-jEc-lJN9@8b63@Hxj&3?OOyMYV' );

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der
 * um prefixo único para cada um. Somente números, letras e sublinhados!
 */
$table_prefix = 'mptw_';

/**
 * Para desenvolvedores: Modo de debug do WordPress.
 *
 * Altere isto para true para ativar a exibição de avisos
 * durante o desenvolvimento. É altamente recomendável que os
 * desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 *
 * Para informações sobre outras constantes que podem ser utilizadas
 * para depuração, visite o Codex.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', true );
define( 'WP_MEMORY_LIMIT', '256M' );

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Configura as variáveis e arquivos do WordPress. */
require_once ABSPATH . 'wp-settings.php';
