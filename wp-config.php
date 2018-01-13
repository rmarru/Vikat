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
define('DB_NAME', 'vikat_db');

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
define('AUTH_KEY',         '9Gwq</3B&vf|`O>@WSSAi#LvncPzBg0~NwqMV`?;oBu^!ICyI,dGn9[n|CM%ic(d');
define('SECURE_AUTH_KEY',  'Stdz8?)DGiqme&00|,hl?W])!43Yb45g;&ML7uE~o?>-8Y~?X,!?iNfA%d|;ZRi2');
define('LOGGED_IN_KEY',    '[tA9h4`X2Vr=EF(!Dof(o_`]yg#zF8$fh3lpFoc1*-@~T{.QO7),F/kQrU`XsTW]');
define('NONCE_KEY',        'Y08pK9.QcgMYcx(GI)V>9i0efeR#$4Sv Yv^oY^dEK`wj%=9iU%Wa!/D@:?wirH=');
define('AUTH_SALT',        ',D-J7!/H>,ky{TUmp/-COc(m9iDWkw/4`YfD$~4>$t@o:&p@}v,(d*h)}W =,gAN');
define('SECURE_AUTH_SALT', ':d:8 ,E?5cL4H;]D,j[N!i&7(Szy&>!a>Qy*ue47xjPo4%gDwK=>3L-,|P}VxFjY');
define('LOGGED_IN_SALT',   '8^Oe7}/csx0-:#/Yec-1v2YQEa=&>r{|AUl/Ig,7<#UNIMLE;A%6~oj 627D4Doj');
define('NONCE_SALT',       '#[HaJp/|:^Q9~<?t<i5wQ]]0KE58/E#&b#Y`>*F!>[w?hjpat,%ol9Asig<_zUgY');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix  = 'wp_vikat';

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
