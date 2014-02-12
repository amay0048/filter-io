<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, WordPress Language, and ABSPATH. You can find more information
 * by visiting {@link http://codex.wordpress.org/Editing_wp-config.php Editing
 * wp-config.php} Codex page. You can get the MySQL settings from your web host.
 *
 * This file is used by the wp-config.php creation script during the
 * installation. You don't have to use the web site, you can just copy this file
 * to "wp-config.php" and fill in the values.
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'wordpress');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', 'root');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

/** The Database Collate type. Don't change this if in doubt. */
define('DB_COLLATE', '');

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define('AUTH_KEY',         '!wH:vUh{+#o]-SJ{|v8C<sFPp{[|-P[P%-JEmM74pKe$qAz|xt<*_m`kyxQ.|S!N');
define('SECURE_AUTH_KEY',  '&IIy6S77;kfv]uO&SHwO[xAY;#Oc-a:^hh=VHnP6ZC Q3+[q|b%b4~K&?&t/Nh*z');
define('LOGGED_IN_KEY',    'DGKtLs[FQu)-K1|na)4yp#)!S|<~+yNqYi<0iSvFKWK/ws 4=bH1~;FR|e`&mHYn');
define('NONCE_KEY',        '=V$x{:wMGWK!,BxnN=3Zn+ZZ.&AXT|+cZnf(1r|0EQa:-F(`o7d(ItbwPC:2aII+');
define('AUTH_SALT',        '[=ZLHaxJj(U+*Ie(~^O,-j{4wa)(yaiwk _x d/=]WFEB-!sg0cGrpLPo#;y;W&`');
define('SECURE_AUTH_SALT', 'fUru[x|XF!rD(s]Nf?F4$@S-sAUo|p;fE=fJ`/a1;=TUdWYTw2&~:D[:ns7<uI|M');
define('LOGGED_IN_SALT',   'qmJN)_GZ&e,V*c3h|&`U2~Mn _TN!82nwLy:<N@^tBwp0|GSPvckDi;SuF48vQry');
define('NONCE_SALT',       'ySP+iGQ9lpNHZfP)r5J#!a6N^|y{V+&-_g)gF#WuZ{d|X-;=*c?Uq)1w|GaV<`6D');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wptv_';

/**
 * WordPress Localized Language, defaults to English.
 *
 * Change this to localize WordPress. A corresponding MO file for the chosen
 * language must be installed to wp-content/languages. For example, install
 * de_DE.mo to wp-content/languages and set WPLANG to 'de_DE' to enable German
 * language support.
 */
define('WPLANG', '');

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 */
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
