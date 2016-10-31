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
define('AUTH_KEY',         'q}h8DU}e52K0Z8^3zxlPd^.;;);b[vQA&^KlJ$=9:a_n5YM_#ExVZ!p(/HWW,*N>');
define('SECURE_AUTH_KEY',  'pYWSkrkC>5Mb!>J<p~28w,+K+sXhVR8Lc$v,RH|8Vf#O:Gd-a#{U7?YglC+/bb{$');
define('LOGGED_IN_KEY',    'DLu^O__v((f0S~mZKI+uj,doNx.>:Y(&H#GOY!4AHNNgb-6Gby)KE48!O~AHJxF~');
define('NONCE_KEY',        '&G:yX7+P8{ao f9anpA%aV_M=b/3,9Xs}#=500C(XNPwPhX!vI}lq7DK6L<futkD');
define('AUTH_SALT',        '-HiV}KZ%Xfac>ZTfv|Q+/|vCw5[X*5;VU+4ss>&,,f}{DyC)WQw|50@q19he?EaO');
define('SECURE_AUTH_SALT', 'sk^CJE8N@Kwo-F|o){),T$|tIO-UY=DJk$^M/2$e/6CVaVa2 PVBZNbn7pD^qtlA');
define('LOGGED_IN_SALT',   'ag;hB;8Nz$SR*D$>~^]<aCMWTI/e5NB^Brufs((&j;}6;$]!Wdi5RZ=Z&ty6N@J/');
define('NONCE_SALT',       ';u?tRo+g{:)4X>rcdU(ag-:r8BD[r05m%a~q%mjB/_iJf(y$,Y|VGOd*@_lIqAi>');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_';

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
define('WP_DEBUG', false);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
