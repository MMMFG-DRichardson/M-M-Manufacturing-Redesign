<?php
/**
 * The base configurations of the WordPress.
 *
 * This file has the following configurations: MySQL settings, Table Prefix,
 * Secret Keys, and ABSPATH. You can find more information by visiting
 * {@link https://codex.wordpress.org/Editing_wp-config.php Editing wp-config.php}
 * Codex page. You can get the MySQL settings from your web host.
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
define('DB_USER', 'wordpress');

/** MySQL database password */
define('DB_PASSWORD', 'wordpress');

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
define('AUTH_KEY',         'CfR{om2~?$u7rRiqj_$Szd)FLfoN(&o+(}E6&)8.3~t3UAy-lG3t=iw@=]rV0D~Z');
define('SECURE_AUTH_KEY',  '[//a=@Zl#JciUsc{nm:.m*>4oXmODP+X/pDX@^uVBjee9Q|p6+Iy>&a=S]i?l_-!');
define('LOGGED_IN_KEY',    'TQ b^?:=bF,xxvG^!_tqE5+ Y/:SVX zJ[d)]uJXOVL{j5MO++UO-R!Wb+M]K0;.');
define('NONCE_KEY',        'By3;7 CLqw5N.2rja>53OQCY{PJ<>=Joy5^:DOR93bdm;K)VXoif3O~:kS7$b_-k');
define('AUTH_SALT',        ':#Z[vH<r1QF&_:_e|(KR&^^l(nZCGXas4k#^`:lERAGvmQw-)+X.t4mB{]*2qUYp');
define('SECURE_AUTH_SALT', 'o` JL)gSY3x1c5E.zDUyG2q{o9d7hA2P2tyN`O%K,@@y)nmjeBke!4+KRxKsanK]');
define('LOGGED_IN_SALT',   '&~D]T&H2mb=`z3|HF?$zaR2}/<x>8H )E+I#jFz*Xw70+SQ*W bM%opw>//ny#@w');
define('NONCE_SALT',       'lp8(EQHU VMu.UJsev{lcFbC_/M-mt@IK;RU |b(ZA+-2vP!|5~_W!6|@$BA&$B3');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each a unique
 * prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
