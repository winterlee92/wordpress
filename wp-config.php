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
define( 'WP_ALLOW_REPAIR', true );

// ** MySQL settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'wordpress' );

/** MySQL database username */
define( 'DB_USER', 'root' );

/** MySQL database password */
define( 'DB_PASSWORD', '' );

/** MySQL hostname */
define( 'DB_HOST', 'localhost' );

/** Database Charset to use in creating database tables. */
define( 'DB_CHARSET', 'utf8mb4' );

/** The Database Collate type. Don't change this if in doubt. */
define( 'DB_COLLATE', '' );

/**#@+
 * Authentication Unique Keys and Salts.
 *
 * Change these to different unique phrases!
 * You can generate these using the {@link https://api.wordpress.org/secret-key/1.1/salt/ WordPress.org secret-key service}
 * You can change these at any point in time to invalidate all existing cookies. This will force all users to have to log in again.
 *
 * @since 2.6.0
 */
define( 'AUTH_KEY',         'mrA(1/4]/`KOMVdH[l(Cl1zUk^ieis95=(bct}0;]]G{bl{f;CLt581t@k_{s0k>' );
define( 'SECURE_AUTH_KEY',  'pj[CJ`2%,|=,ltWcKDHl!SKAg-,=w&Il!,N~kmhpy7I]eu:wLoY!~bacd`S(/g6u' );
define( 'LOGGED_IN_KEY',    'Ik4^D2jgwC`H:Mf*20qn;[[`v4#ke-#6%y:rm37>h@jz(Rl}esBg?<XS5t#uzp<n' );
define( 'NONCE_KEY',        '*Lm$/zKh-k}x.Of^%2?1zPjZmAU$ Gady+XtQSDApMH9TfhgJ:`#TyRtO=;99XV1' );
define( 'AUTH_SALT',        '?S j#HhipiA@:C)3s$ru/(< YzZtff*[-J}Ncbz:r&]|;{o`* R1Y NDNU@73%Uf' );
define( 'SECURE_AUTH_SALT', 'l|Zi<+Ub+]qe}_O!oNj_.DYLg[o$>57tVp&DV7_:hI{9rIL$_$4C{/T.87++T7Dl' );
define( 'LOGGED_IN_SALT',   'Ku;@6SsPNS.gU#klq_0~mp;dO]wA&PjZ*EvZ}w|3~u`u1ndt(]D~:pvk^wE2k>zq' );
define( 'NONCE_SALT',       '}mwFqCs~5(8yY1ddZ$04,eg1T]Xd|;v#$f###L:p/bS`c,)kBK/oVv#_v2K^XeEY' );

/**#@-*/

/**
 * WordPress Database Table prefix.
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
 * visit the Codex.
 *
 * @link https://codex.wordpress.org/Debugging_in_WordPress
 */
define( 'WP_DEBUG', false );
@ini_set('upload_max_size' , '256M' );
/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', dirname( __FILE__ ) . '/' );
}

/** Sets up WordPress vars and included files. */
require_once( ABSPATH . 'wp-settings.php' );
