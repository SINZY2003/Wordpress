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
define( 'AUTH_KEY',          'Wz7OGG@3pF4LS>zUC E!&U^N&f baJy*pNVl,Q>`2%p&-hV7{A!/]Q:RS9>rsC,8' );
define( 'SECURE_AUTH_KEY',   '&W*Prm/Ky;Kv`-T{.zZPP1 DP2!{-f:%qU)PzN(Sf>kJU<1PuzisQq:+7=2Pr_c%' );
define( 'LOGGED_IN_KEY',     'V(3zbtc)Gy[$*>rG6zW:)6Q5LIPUq8BK[ycFv7uk5-@>vY}0izH%*=;wp]vG86aP' );
define( 'NONCE_KEY',         'ch-NG0+sw,TLu@yT &Aht<{0P/odNdu_8.z^6;~;<Q#`fKWeRqU>?DFa886Ro#FO' );
define( 'AUTH_SALT',         '`0gvf5W5u9(X-! VdL%|}&Fq7|5gG[9[ -FgM(]NLZR^f2aZRG${3R%P|E#wv&uO' );
define( 'SECURE_AUTH_SALT',  's)PRvd<;,I~$PY&}S>*$JJyt/|^K;9p8yff?k}3BG,I@`HK)6V+|6V#7x00c5 7Y' );
define( 'LOGGED_IN_SALT',    'HiNKqAmXQ3T-jm-a]r3}PqC<Sf,p`Ia.Bz9eRrz@ZC0YoaYO|(Ukw2egv:U7y-Tv' );
define( 'NONCE_SALT',        'h;g6E?QoP?q+mt^`Gqmfsu#`9ugE;!TJl((I2.g!6E<U|ZKj:X%`gI=J2`,OOZPc' );
define( 'WP_CACHE_KEY_SALT', 'QU:YTk0@l Y:[bSz9oL)#:YZFj{Tjf~![fX0GSm[Yew!znz s,h~Nl.lcTxMS&.2' );


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
