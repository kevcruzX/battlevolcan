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
define('DB_NAME', 'battlevolcan_1bd');

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
define('AUTH_KEY',         '7JfH(,9x@^RRc/$T}ZU![0K1Sc#as{#Wbe:nLzwP<20~C1cGtrH^=jlLlVNDDFr+');
define('SECURE_AUTH_KEY',  'BpYDbZGdE2us!58^5%R48-/~Ro,Hu`Ey3DC7PA_iu8$6Yvx/I9UP/Qqcm?fn^V<v');
define('LOGGED_IN_KEY',    't%B,_nJ-7SD?m{E_d_c:x5C=?rY^mEfyw$NE){$fxNV3+IVD.IY5I^Qv)pKIxi}m');
define('NONCE_KEY',        'Rk6T_(6{* /mG3^HUwk5LKGOt!|kE~?lHiocU|*_0$,76!$T,N`9Ggg%S~6nH5^P');
define('AUTH_SALT',        'jXy|>b;C/*$,9q-g0!ERz[Ty$Bpag/Y9 nrw$(JR7vayhQNRAL77YFyw,|.dFBFD');
define('SECURE_AUTH_SALT', 'rZgeNcsL+D%n]9e?e|~t`7gdf_$V3L#[T7LO${`:lX_DW0vC,joE4!6y3_WkF2I?');
define('LOGGED_IN_SALT',   'D?>6VoemUnQHB<(];{0VPCcY*3DRx<vOc28o[>Z)]hL{+hwpG|lCL}3EW-*u<?hz');
define('NONCE_SALT',       '^aV96/<bFz,~#t~?oV)NhgVi{ ?QS-$t,H{u0A@DpBbB^#s%_[nls;%hx+ _1*s$');

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
