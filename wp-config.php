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
define('DB_NAME', 'domainc4_ss_dbname4de');

/** MySQL database username */
define('DB_USER', 'domainc4_ss_d4de');

/** MySQL database password */
define('DB_PASSWORD', 'DhOcPPRafP0y');

/** MySQL hostname */
define('DB_HOST', 'localhost');

/** Database Charset to use in creating database tables. */
define('DB_CHARSET', 'utf8');

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
define('AUTH_KEY', 'jinPvVA?j$+dV}ybjknATcjtFVQtm*BDFmsJ;?&hecUg_W@|MST%rZXEaa)/WfooFp<N[[W;xXxv&W)NMPCYsV-&oG=*KnrP/pTaCkj()^-!mNnvUrpNFh]xk_?g;e}^');
define('SECURE_AUTH_KEY', '{Qx*wYQmoxO$V/hpWVaCPs_%)$lESO$S>Y!-zIQZ{xumz@hf(axoGMzr@]HVytv=SL;bLZgqp[y^IvV!fy^vz;VWzK;_JNj[_cdZOLefwPHOla@MKax-Hf|z&ZY^rnJJ');
define('LOGGED_IN_KEY', 'Q/fe*h>um=jq;Ib|dX$ifEhnXjvcTYn<mJvkWTG+Tygi$qblCH/]Bhl@Yuh?]L[uPm*]R^vshLE@k_t}QDdWKZ{>K^)|na<VY]BnN@$JbJrpX)j>znP(o^NkYszLAWHq');
define('NONCE_KEY', 'fU+wo[$WgTdITh^gAe*(hreQ]pv>n&GSHL}bLub@h{+Scmzf_v=CBVxtrxr>P/o_!!nvN%YyK/]m)rLM<}]TUcw%impqRhc}x_G[l$>kcY|Lo?AqndNr<^yT&FWMPiUW');
define('AUTH_SALT', 'LkiAjv/];J<*j(JCJU+||b{OF-|IRN]H;+SKEc[RRPCmT&p<igZed+yk$c%wCz}sgfik|>_=Ja?V@wrpl*[G?;nH%kQoDVxK+qnwApev)|>UDPWoSzw$%ioTowup&mMq');
define('SECURE_AUTH_SALT', 'SsZS{JO^b/>J^!$wg_dk&xEqk_A)+JG=h}P;$sJAcgd?+ZN!GN=Muey&}YnmW{[muUe*UJm+X*Wh[G-o>{RcP@PLRLpJTOrd;V|zIy+L%hMdf&r%QZbMZH/e?PxJi[uF');
define('LOGGED_IN_SALT', 'Tvb>XoMLw[W]-_+l%hmhtxj*RfT-*}Y>bMw>mzy^)oOz*Nf}xTV>;FW$={JaI;oB|Fgez(+pf>UbLsi$};J%%RqZ-uHI}Krh(zNQe^Q%e^+m(paPvPJ_CyU;+Yj?uPxm');
define('NONCE_SALT', '<QKTd]m;!SJQ|apN^<zFoRRLbi(ztfvwUSOTM^OF]KLlyDA=FBrALAEl(b=rA^s!+ljY_*I)TeE*g@A|@e]@VbRGNKNFCeTI$q]=oR[smr><YsQLE;h]V%)$cg>h{D^O');

/**#@-*/

/**
 * WordPress Database Table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 */
$table_prefix = 'wp_mkqa_';

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
