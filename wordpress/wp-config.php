<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the
 * installation. You don't have to use the web site, you can
 * copy this file to "wp-config.php" and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * MySQL settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://codex.wordpress.org/Editing_wp-config.php
 *
 * @package WordPress
 */

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define('DB_NAME', 'sun');

/** MySQL database username */
define('DB_USER', 'root');

/** MySQL database password */
define('DB_PASSWORD', '');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8mb4');

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
define('AUTH_KEY',         'E4<t{ackatj|S(oPAT5kt?:2|!ampr)Xr+lCsFz`ZOE{2cn2f0_AU,-Ke_Ix.#GP');
define('SECURE_AUTH_KEY',  'Yqnd<Vh,Vatee/z+-1-wlBdSY$m;q8oENtiRBezta)2]H,,sv84K%|$M}NKc?|*(');
define('LOGGED_IN_KEY',    ' iYuIz3%b&!T*M8) G+`_`fFc]{ElFeOYe=~IsYl9C/!D7SwoLr8o8Z)zZ8{]-W{');
define('NONCE_KEY',        '$b +}Ih1PJNCRLIDlnybf[AiT>W>-I}CC*r.E~IK4#(2&JvvHMH%dw,$QdEh=x>r');
define('AUTH_SALT',        '-O]}K@}tF<Pr@l/X3PA<K)0?[!*sh7`&hx,fu z;@pfTv)`7G<!Frgd{0Wh`dXlA');
define('SECURE_AUTH_SALT', 'u_aeU7Qiv=6q]u->MZ=8{`yG:b$.QG r0]^g29luS|bI<RZ09/ctAPeo,??7=HDT');
define('LOGGED_IN_SALT',   'k-_I~EMCtU_S~c6cB^<6{xYC&h&[kk;j.mc!-,1Yh.g7, Y11c{p,.X*07eF#9at');
define('NONCE_SALT',       '?EJ?~h+~W{-)xNUDFPAR{TeStz_u3v8+wk-mvei+>|]=,oR3:/?g<sv/AAQ:r1*H');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'sun_';

/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
