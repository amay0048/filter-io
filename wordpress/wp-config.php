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
define('AUTH_KEY',         'lT8Y<H-!ZTJ|lgdG|wR[W-GQ(F@7.o:H%=pE0l$Y3Tf3z-tkPLk:sR$GI#ke^^Ig');
define('SECURE_AUTH_KEY',  'sI^4tW.-eY+!>==^FaF]@q cGBZ-U1#ENQ^{u$}U[}H[GVc]|A1c2l#:@ExJG[xe');
define('LOGGED_IN_KEY',    'mz4.HH-2:+HT|xQhJ.2WtsnH1f%}|P7n/z LaN;mXWKRfv-C;DkaI6gio)xCujUf');
define('NONCE_KEY',        'a=FiYj680W.|md0u2*A]W0)H{+kW-jz@wWy%U!R=`pI|>`X:l;QF/31P$MV(D/%M');
define('AUTH_SALT',        'P[%[NV6$&;F7DD&1yV6Qyv|Ay-6n$uSn^(B3<&#0HyoP`5b8|`rYUh)g*~-rO?]=');
define('SECURE_AUTH_SALT', 'fE`o-ACVB]bKQ=Q1S#5=K*d>$%5!pKd$l$IJt;Q(9,h880?IOJi`o]dc>r[3A3K{');
define('LOGGED_IN_SALT',   '})>f/F&8-HX3mm5)[-(Js!#&L.g#j<|eB-`O;oSFgIH9665jk()=4U*QFl!c^55h');
define('NONCE_SALT',       '/kL)?dO$TBDm^z,KK,W$_$NAM5lxV)u=lvp];vS:u-pIZvhf*63o?l|-wAlsrPu8');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
