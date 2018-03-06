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
define('DB_NAME', 'lenswithbenefits');

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
define('AUTH_KEY',         '0l? Yf@4hF/#jTnh}kb1}}q/3[6k2S20Z6).E|M$KV3%7AQPiNmX_|dNtWVwF#@k');
define('SECURE_AUTH_KEY',  'PEl8y41wA,} !pYUtqCk0e4.Q!Mq%]fFTK}cl4ppPr=b%Y`lD|Iu,n+<^u]s>THr');
define('LOGGED_IN_KEY',    '8D^ 6X.<jmEjM7q79p^L4#-leck`v=IF)n{T*QiSnr}cR@zUUZEhk^=z``$%o]9X');
define('NONCE_KEY',        'kvY%;z&U|Rcd1wC@S!XQb{EE~TR%11EV87U1.q0X3^WQME[y?Z#|T->m1U?N&Kgl');
define('AUTH_SALT',        '*Smc`;IA5|AJJQ`wXd|8JMpzX$Os>f!_cg|P{x#VFaQ+VeCVNY6GhT&GoW.cm ,d');
define('SECURE_AUTH_SALT', 'ex!:*73Du1)[U)%%EJNR=x#(%$wxK)T5>:n.Xj6:-,6-|GMCnf9flDNrE%E cjh]');
define('LOGGED_IN_SALT',   '@/!d]*,^r|wxQWV<Hs#W!naWjVn1ts+Y+j:(yN]2n3e0ed8uAM$5@%i;J.tdK&Zs');
define('NONCE_SALT',       'eH3H7F7o>k=lhApoG>IeOPK#e<&~8aA^TszG,M;L[T+6!Bw[} H31EJjRuX:!tak');

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
