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
 * * ABSPATH
 *
 * @link https://wordpress.org/documentation/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'misscherries' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', 'root' );

/** Database hostname */
define( 'DB_HOST', 'localhost' );

/** Database charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

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
define( 'AUTH_KEY',         '`~WUvH<[t4Z K?eR?I{3Tg;gsuGvF%(lmRC}L=G6g.VeLT9lY)cF2pRA7Zei-yuX' );
define( 'SECURE_AUTH_KEY',  'gr3oumc]>v9#OX=;20Z[ydf(%Prft[#w|[a8qydQ8S&.JLX@bg@2nT-2OM8}2eM[' );
define( 'LOGGED_IN_KEY',    'e@gWV|O1zV6%?YG1Tn8,;8Wg[0-|z:l]Tt%vUY0K#B]UY*J85h3&k8<:0qF+!&-r' );
define( 'NONCE_KEY',        '.rFniYJGG%UWWg&%Fhn%3h/r ^GNd3q6jPI@;ZLi)V$^hw,j+et8&%x-,%j})yx`' );
define( 'AUTH_SALT',        'WvyDG=u,U|nmP+K-]jz@=s~5o&(/f YxtPVQ-%dRC/=n|~DSi/}t4aZ8$]uy9zCs' );
define( 'SECURE_AUTH_SALT', 'Af[{r ;64N5T[,:VMMMEDG7Zmy+aFHp@%PV4S1Y?QE5_CP9p1+.ZmYEaC[Tjm]fv' );
define( 'LOGGED_IN_SALT',   '+zeu`#yuPTB:OMxkS:%cND.$C][Cpz2K^SU!sOjs+dHz!|gSEY3{2 :B |efuX2=' );
define( 'NONCE_SALT',       'Hb,=!)ILU8CEA2H(;JTMdAiH`>S/K*~]99<fX`KQc9 b{Jv}g~YLPjafq}1;?~tj' );

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_';

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
 * @link https://wordpress.org/documentation/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
