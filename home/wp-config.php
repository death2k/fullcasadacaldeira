<?php
/** Enable W3 Total Cache */

//Do not delete these. Doing so WILL break your site.
define( 'WP_CONTENT_URL', 'http://www.casadacaldeira.com.br/home/gespress' );
define( 'WP_CONTENT_DIR', '/srv/ftp/casadacaldeira/public_html/home/gespress' );

/** 
 * As configurações básicas do WordPress.
 *
 * Esse arquivo contém as seguintes configurações: configurações de MySQL, Prefixo de Tabelas,
 * Chaves secretas, Idioma do WordPress, e ABSPATH. Você pode encontrar mais informações
 * visitando {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. Você pode obter as configurações de MySQL de seu servidor de hospedagem.
 *
 * Esse arquivo é usado pelo script ed criação wp-config.php durante a
 * instalação. Você não precisa usar o site, você pode apenas salvar esse arquivo
 * como "wp-config.php" e preencher os valores.
 *
 * @package WordPress
 */

// ** Configurações do MySQL - Você pode pegar essas informações com o serviço de hospedagem ** //
/** O nome do banco de dados do WordPress */
define('DB_NAME', 'casadacaldeira_37');

/** Usuário do banco de dados MySQL */
define('DB_USER', 'casadacaldeira_3');

/** Senha do banco de dados MySQL */
define('DB_PASSWORD', 'Vida3700');

/** nome do host do MySQL */
define('DB_HOST', 'localhost');

/** Conjunto de caracteres do banco de dados a ser usado na criação das tabelas. */
define('DB_CHARSET', 'utf8mb4');

/** O tipo de collate do banco de dados. Não altere isso se tiver dúvidas. */
define('DB_COLLATE', '');

/**#@+
 * Chaves únicas de autenticação e salts.
 *
 * Altere cada chave para um frase única!
 * Você pode gerá-las usando o {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * Você pode alterá-las a qualquer momento para desvalidar quaisquer cookies existentes. Isto irá forçar todos os usuários a fazerem login novamente.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',        '8u[n$:]$i~WROnJ?x(H!4:|52(wPjExy-Nrz]WG+QQ+vfu+eC4]U446Lb~Fe|RZ6');
define('SECURE_AUTH_KEY', 'j.n{zXto+U* ++S(Jr)J5_E7V6Y|IoE0++|]NvQMxD+-~Z/0e;+r`-|#in*^WKN5');
define('LOGGED_IN_KEY',   'Z 4~||q_YB|>B2lpKrw3PfMk4>=Eir|usAO}NAy?OAe0JO BRm.ZZu-UqA#!Wcc{');
define('NONCE_KEY',       '4k:C%S*qSsa-<R*MY2X2d~.}E&3MX$*H@gOka!F(e4NayeZD9-oQpNZ36?=d?bBU');
define('AUTH_SALT',        '-}:9S0o8D 4KG I?d0H>YMyXv}~,rg/8A7rR2,ZNf5PU_t6sOy;X.E4,G:_Pafur');
define('SECURE_AUTH_SALT', '-*:Sr(/WW|kIxivo+~GVkR2zWR23g<|wx#>@L XpQp-zb%KB~+)D6JoBKX{m`*_S');
define('LOGGED_IN_SALT',   'il5DApE.?~tQx?2CrFehKVd`C]0+q)<E=n9MZ*w3NBNA}H.@cyvFc> 3z~m#8bF~');
define('NONCE_SALT',       'k>(xW~d%+Mu< P17885uu<8r(jX@F!q7=gs9o+A=#q#kt0eutC8&&F8|q(v+re]F');

/**#@-*/

/**
 * Prefixo da tabela do banco de dados do WordPress.
 *
 * Você pode ter várias instalações em um único banco de dados se você der para cada um um único
 * prefixo. Somente números, letras e sublinhados!
 */
$table_prefix  = 'cc37_';


/**
 * Para desenvolvedores: Modo debugging WordPress.
 *
 * altere isto para true para ativar a exibição de avisos durante o desenvolvimento.
 * é altamente recomendável que os desenvolvedores de plugins e temas usem o WP_DEBUG
 * em seus ambientes de desenvolvimento.
 */
define('WP_DEBUG', false);

/* Isto é tudo, pode parar de editar! :) */

/** Caminho absoluto para o diretório WordPress. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');
	
/** Configura as variáveis do WordPress e arquivos inclusos. */
require_once(ABSPATH . 'wp-settings.php');
