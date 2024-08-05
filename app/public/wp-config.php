<?php
/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the web site, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * Localized language
 * * ABSPATH
 *
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'local' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8' );

/** The database collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication unique keys and salts.
 *
 * Change these to different unique phrases! You can generate these using
 * the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}.
 *
 * You can change these at any point in time to invalidate all existing cookies.
 * This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',          'O?C`|$dD`1xq{cJYG8a[o9APXT[sgF?+&L!w}hB,WP*}CNJua*,AgSG(L-<Kg=4`' );
define( 'SECURE_AUTH_KEY',   '@g ez2+Mup(CbwA{Za7qq*CE|-G}J4,5SsDNVnYp_<12i||i- Vi2W.}6QWbz~X1' );
define( 'LOGGED_IN_KEY',     '9dJj~MyW/^>fk{74`%:]RM)%V*Yrq;b>~TjUut~R1M8YhU;!`XtKd8O#JfJ2>nC7' );
define( 'NONCE_KEY',         '^SUvboj#LpLS2<2gM_QCJl&dct]N<fJBa/?o*n4ZOw.K=SL3H!RxKx-khV{c+i[[' );
define( 'AUTH_SALT',         'c%rFRO?`2Ej9Rgg]6u/t~vQK0-:THBP~`pRQ Wr$2qBQR$Sb$6Xr%8a</yVhOHTX' );
define( 'SECURE_AUTH_SALT',  '^{jxM0hNqF|&Sn5UN!pR[I7o77J>3N~$hC#S$#GgO9H*{7`G.BN6rm^iNRrd.hCZ' );
define( 'LOGGED_IN_SALT',    '4Ns#hA8AvmVSg~>B CIy i^$u`]_(lI@2*Fd.wlaquKxJ?.qbFRyv^dfM#ZfFy@z' );
define( 'NONCE_SALT',        'qwj!.Quf$$9J6r$L?pDLz_d.l(]:j_JXx<d c^:pWF[<twp_b(=@|~#<#~{~8jVe' );
define( 'WP_CACHE_KEY_SALT', '{1-q$+YV;gy];IEj/L{EW|ob#b$50KgQb2A0Gf8w !Khu5yJ%.O%du3D3)/B^|,V' );


/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';


/* Add any custom values between this line and the "stop editing" line. */



/**
 * For developers: WordPress debugging mode.
 *
 * Change this to true to enable the display of notices during development.
 * It is strongly recommended that plugin and theme developers use WP_DEBUG
 * in their development environments.
 *
 * For information on other constants that can be used for debugging,
 * visit the documentation.
 *
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
if ( ! defined( 'WP_DEBUG' ) ) {
	define( 'WP_DEBUG', false );
}

define( 'WP_ENVIRONMENT_TYPE', 'local' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
