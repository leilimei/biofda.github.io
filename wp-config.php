<?php
/**
 * WordPress基础配置文件。
 *
 * 这个文件被安装程序用于自动生成wp-config.php配置文件，
 * 您可以不使用网站，您需要手动复制这个文件，
 * 并重命名为“wp-config.php”，然后填入相关信息。
 *
 * 本文件包含以下配置选项：
 *
 * * MySQL设置
 * * 密钥
 * * 数据库表名前缀
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** MySQL 设置 - 具体信息来自您正在使用的主机 ** //
/** WordPress数据库的名称 */
define( 'DB_NAME', 'biofda' );

/** MySQL数据库用户名 */
define( 'DB_USER', 'biofda' );

/** MySQL数据库密码 */
define( 'DB_PASSWORD', 'xz6PW4N5dwj46b8k' );

/** MySQL主机 */
define( 'DB_HOST', 'localhost' );

/** 创建数据表时默认的文字编码 */
define( 'DB_CHARSET', 'utf8mb4' );

/** 数据库整理类型。如不确定请勿更改 */
define( 'DB_COLLATE', '' );

/**#@+
 * 身份认证密钥与盐。
 *
 * 修改为任意独一无二的字串！
 * 或者直接访问{@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org密钥生成服务}
 * 任何修改都会导致所有cookies失效，所有用户将必须重新登录。
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         '63O9~%:mId6l8?Hl,6|2O|||fly;Ab=(!=b-;G,>.q5{<![m.6(c`?SgVTp:d=A2' );
define( 'SECURE_AUTH_KEY',  '+sVA4g%sy)c:iL5Y}=#K*1Ok|e.%>m}z$CUiCXNex(<_#tH`GXo}!>>x2^}vi;.3' );
define( 'LOGGED_IN_KEY',    'WU` +<SEi?-lC[SYvhH9M4Y^D<,M(|gD];tjKc=$>po,q@a&@.=y6T`}5rin}!CJ' );
define( 'NONCE_KEY',        '?i>4=GD0;^XGtYu>UZdn3{VVx>0ZwE)9k3;mgD3XAb kN?UAh_#t)jb8n{<a{2V_' );
define( 'AUTH_SALT',        'G`_DX++x$_qys&_;_lY8w!1-@=?<`@iBj{;OAFJ&~&aV9f<#>e-n>[2!3i%X3=%-' );
define( 'SECURE_AUTH_SALT', 'BtEcnD54lH}1hdZ!IZ~Fg_~0Ux)B4VgZ7hAmuMV(7Qt6hTUX7|#x(k0=LEl]-AB@' );
define( 'LOGGED_IN_SALT',   'rH:Y#6D&9N.*)XiL exSBAXE.}`+vLb.;}-gid+41L2CTrYYItPa*~k2PjU_Gehj' );
define( 'NONCE_SALT',       '*J9&m*V[C+h?7ZOhngxyC|0bY>*co|q.8i|eE!.=xw20fNYSE,kvC=yU0IIZWqFS' );

/**#@-*/

/**
 * WordPress数据表前缀。
 *
 * 如果您有在同一数据库内安装多个WordPress的需求，请为每个WordPress设置
 * 不同的数据表前缀。前缀名只能为数字、字母加下划线。
 */
$table_prefix = 'wp_';

/**
 * 开发者专用：WordPress调试模式。
 *
 * 将这个值改为true，WordPress将显示所有用于开发的提示。
 * 强烈建议插件开发者在开发环境中启用WP_DEBUG。
 *
 * 要获取其他能用于调试的信息，请访问文档。
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define('WP_DEBUG', false);

/* 好了！请不要再继续编辑。请保存本文件。使用愉快！ */

/** WordPress目录的绝对路径。 */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** 设置WordPress变量和包含文件。 */
require_once( ABSPATH . 'wp-settings.php' );
