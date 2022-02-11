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
define( 'DB_NAME', 'exampleone' );

/** Database username */
define( 'DB_USER', 'admin' );

/** Database password */
define( 'DB_PASSWORD', 'admin' );

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
define( 'AUTH_KEY',         'r/id{Yag>G4.$MF#9X9WeE~rya@l 3WC2Zfy*$6!;fdz:a5q@rww#PpZ1!L4QTp_' );
define( 'SECURE_AUTH_KEY',  'B62$HC}uYsoJJEF;j_/wq!:$bjPF+Foh]J.u@(-YspXvA`<CHB&hM=+}A(W7qzzb' );
define( 'LOGGED_IN_KEY',    'Fu4kWDR&[dBNl 1b@b5qC(gZ+&&m%K^1gRWE=&XaNPpC2 1F98thh}3G7$YEzxI5' );
define( 'NONCE_KEY',        'ySi1j<9x$rEY4&=ee(g4SC-yuKSKL*i/dCa(]_2r{qK*khQ)TB}l|mIZc-f6VHL_' );
define( 'AUTH_SALT',        '/i%.=Ms+Xh`pJDV/IaZ:ephM2syV;I]_TK*ion#Y|`87G$^]&Uz~c,!#?:rpJK#F' );
define( 'SECURE_AUTH_SALT', '(1ge(2txbG^QP3PJzKXfF)f@A:?}3i@WuY${RUL^QoY4k$ 0=[b1GMC)29m547-w' );
define( 'LOGGED_IN_SALT',   'M1?FyhQ{0QIQ1`L[5TIjzw9ya#ea13NbkkCQAmw&U/I}Y90p%#)^^z{d>xN?Hj2:' );
define( 'NONCE_SALT',       'Pf[U9t9cY){5Kq(M1q&j}?/{D3Mh*#7-R$>d>Y2hezNP(MJio+@P%m4e#}q8dOjm' );

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



/* That's all, stop editing! Happy publishing. */

/** Absolute path to the WordPress directory. */
if ( ! defined( 'ABSPATH' ) ) {
	define( 'ABSPATH', __DIR__ . '/' );
}

/** Sets up WordPress vars and included files. */
require_once ABSPATH . 'wp-settings.php';
