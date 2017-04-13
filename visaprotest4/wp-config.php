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
define('DB_NAME', 'visapro4_wp');

/** MySQL database username */
define('DB_USER', 'visapro_wp');

/** MySQL database password */
define('DB_PASSWORD', 'ELXco8S3DlDB5uqbXCB8');

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
define('AUTH_KEY',         '?#qBs^k.lTZgCs8L9P=Stu,Nw$]>ea*!Fm4WU~v/*! Ys+iOHnPmIz$RdhKg, Ge');
define('SECURE_AUTH_KEY',  '8.>`8+@U_ddRC+Ul5Bz:Cl)>%v9td#fWk0Y!aP#on_9NC1s+r/7oRe%v+AH Rg]h');
define('LOGGED_IN_KEY',    'qaCRtV}`}^V:NoN |&k{tJ$RF)|>X#Z}q+^08fQP%f~!D/E7B!nD]X}Sdem1f-N:');
define('NONCE_KEY',        '!EPyu<^AE0s2&AR1&+[=J^e?mf,NxXX!Dk2`&vvo9%|/Gu6SvS=x^5po(qArhBc~');
define('AUTH_SALT',        ',wIf8t$HQusJ~&**69vGN?Z>GBJ$Y^U<PpPMFh/a/n/f@cDzCJ~&ldCoiXV4sNt:');
define('SECURE_AUTH_SALT', ',q=W|VE-TvDvT$#b19)pX-wiiCXar?|g${j1la4heX8qxtR$PlWB 3za|@q6#TMY');
define('LOGGED_IN_SALT',   'r?1v;dus86Y8WKo!kBE#ytgpC.Y<*OE!qp{)tWo1+ 9]r+R&be>g4i:l=a$o%WU1');
define('NONCE_SALT',       '`+d/K>vj}J7Mfu1~iAezN|[]iBfe6/)W5lmRH@nxA8O#*bDSu>=zF9q*era-PrNo');

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
define('WP_DEBUG', true);
//define( 'WP_DEBUG_DISPLAY', false );

define('WP_HOME', 'http://visaprotest4');
define('WP_SITEURL', 'http://visaprotest4');

/* That's all, stop editing! Happy blogging. */

/** Absolute path to the WordPress directory. */
if ( !defined('ABSPATH') )
	define('ABSPATH', dirname(__FILE__) . '/');

/** Sets up WordPress vars and included files. */
require_once(ABSPATH . 'wp-settings.php');
