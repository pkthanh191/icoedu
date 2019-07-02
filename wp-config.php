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
define('DB_NAME', 'thanhpk');

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
define('AUTH_KEY',         'rmtQ9_fHE?@.)(q^pD5u:YxA!SGlgX*7+|*/MZ3Bb$@~0|Xqj17EbzY~(sk(;@*D');
define('SECURE_AUTH_KEY',  'i3(MQS?h;^hY@8Y+Aehbpc>jZ]HB2z+D->d4,H1QIU2HC1nK<seiX6o)`bs3uB(U');
define('LOGGED_IN_KEY',    ')A:X]#f.nBEi=0nX`xPa0&cd=YX<[%xd;vm_o4)|g-PYrhcOGnebFn!h_n!I?]IW');
define('NONCE_KEY',        '5iJSxZ& SXe%@@h;}Nmc$=5NA2>qu$YZ)pEw+I)s.d~] NCHQL)W?XVN $<1|MWT');
define('AUTH_SALT',        'd(.]r~VztdIFAA{k~DS17#(n#kN#G8bcYYgS/*o[f|h);@gBJKUY)XFL&zU>o6Sg');
define('SECURE_AUTH_SALT', 'ECZ^:Oc=q%Ma,@)mv75XH~M-_jnsDrrUH![,%BU`H0&=43 n(h74l.D?OH9U+zK$');
define('LOGGED_IN_SALT',   ']hQH~s52r2z`<rp[EQg;^IDOXocx{h*i}PjR_Thr0%dg<{ne~%Jyy,L!FUghn(+H');
define('NONCE_SALT',       'P%+WX)[)<9:.=pG>jO:4OIEopeiiUrK,<@g?7%Vf1h~QTwzN_5JS4DPT}{kzdU%B');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'tbl_';

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
define('WP_DEBUG', true);

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
