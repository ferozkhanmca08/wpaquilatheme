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
define( 'DB_NAME', 'wp642' );

/** Database username */
define( 'DB_USER', 'root' );

/** Database password */
define( 'DB_PASSWORD', '' );

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
define( 'AUTH_KEY',         '`7a8<7)jS,^i`Gl,{.Pdq9t!!}m%=/w.>YO|/vBO*l8XLREuT72<UVdrz|e.DeIe' );
define( 'SECURE_AUTH_KEY',  'gAu!cK|bw)EKrXfmIIKi0vCt%jm+&dwuN .1oLs;>)SEU$vzr$5 2*2{CDNbGoo5' );
define( 'LOGGED_IN_KEY',    'cyt9Z70R^3j:o*w`YFOw4DK}|z~**{+}q?lQ ~|FPK4(;0/]I_~CicuA.WSQ:1g@' );
define( 'NONCE_KEY',        ':t#F9Yh+1IZ3B3`SaFeyOqtgQHK;TscGmd}WI8Md^{ZD}*ui`CM1gcNS~yOQ0[7>' );
define( 'AUTH_SALT',        'N5z}fIr[&&YC/KO}[VG+ e[B},s(#+/RiJNW!yu2N!WMOM.kAYO,IM6dM8yL25PT' );
define( 'SECURE_AUTH_SALT', 'h>mAU|LXYcDBELEHeV8W5?NAN+[ESGF5B= t^6R>M][v*7Dwc7C*H`&V&H`Tnk]{' );
define( 'LOGGED_IN_SALT',   'WK:^mo*0D5Ooqh:GZ3ba6+JAz2RFnm:w/1`bsS<+)F:*vt,o?^{HT:>B?rH<9cI#' );
define( 'NONCE_SALT',       ':mUiUP@}+CL0C*X/!b&J=)a/@e^c%%eK8In;E]hgWS[pfh~t>_U17MpEX3i*ItMd' );

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
