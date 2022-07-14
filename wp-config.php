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
 * @link https://wordpress.org/support/article/editing-wp-config-php/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', 'edittheme' );

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
define( 'AUTH_KEY',         '&8o>$`OVUJ{V*P2pQ-+5X0QxRrI|h@(05$U?P()q:=649CT^FOT_|D jJLko]&A;' );
define( 'SECURE_AUTH_KEY',  'Dz=SO`F(@P6vl/&KsXPY/&.K)?a}Lhd,W(|Sd0(J[ G(h@7i8uN!~5&P$bQtdHC=' );
define( 'LOGGED_IN_KEY',    'WnY-~-w8}^fOj*1De:=RJdl=La^:a_e~2%iBt%XkSWF~*A(w3#H#}z?5;JJ-W6)_' );
define( 'NONCE_KEY',        '_:i2R)1>G]13[ ]QH_fH].@%Bv!T(wbi VMoj=1jhG9$=`K>hri.UNi5I|}-@2TF' );
define( 'AUTH_SALT',        'lgq:.YMI85mY))S^LfmMqPU;bFF(?O$AgjV)z15^/*e2R{].cwDh+;;YBV]3g#MJ' );
define( 'SECURE_AUTH_SALT', 'L8MBM&jVW6vbA,4.rtC!&Sq>#Y)k:K2;CK 1%BNiDXfx{OU3-Oh`UqTU+LO.eF[n' );
define( 'LOGGED_IN_SALT',   '<Y?j&1q?lm$nTbK}ql|7tN_W?@z>0-t?>#o3GNc>|Vk j#IWw32>blxX=!JleZC[' );
define( 'NONCE_SALT',       '/[7R:F4VWx=8V*n!k+eP$ZVK#?[Tf>B*1FK>O!!Iy3~eh8b2Jb<;n#aOIK}[9Zyk' );

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
 * @link https://wordpress.org/support/article/debugging-in-wordpress/
 */
define( 'WP_DEBUG', false );

/* Add any custom values between this line and the "stop editing" line. */
define( 'FS_METHOD', 'direct' );

/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}


define( 'UPLOADS', 'wp-content/uploads' );

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
