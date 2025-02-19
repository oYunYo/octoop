<?php

// BEGIN iThemes Security - Ne modifiez pas ou ne supprimez pas cette ligne
// iThemes Security Config Details: 2
define( 'DISALLOW_FILE_EDIT', true ); // Désactive l’éditeur de code - Solid Security > Réglages > Ajustements WordPress > Éditeur de code
// END iThemes Security - Ne modifiez pas ou ne supprimez pas cette ligne

define( 'WP_CACHE', false ); // Ajouté par WP Rocket

define( 'ITSEC_ENCRYPTION_KEY', 'bio9WkNGQjRbfSotWnVfISB4KVI6Yi9MMDlQKlZtV1smd0EsL1ZpLFdDL10/L1BBan11WF9+PXA9bTBXZUFVQw==' );

/**
 * Chargement du fichier .env si disponible
 */
$dotenv_path = __DIR__ . '/.env';

if (file_exists($dotenv_path)) {
    $lines = file($dotenv_path, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) continue;
        list($name, $value) = explode('=', $line, 2);
        putenv(trim($name) . '=' . trim($value));
        $_ENV[trim($name)] = trim($value);
        $_SERVER[trim($name)] = trim($value);
    }
}

/**
 * The base configuration for WordPress
 *
 * The wp-config.php creation script uses this file during the installation.
 * You don't have to use the website, you can copy this file to "wp-config.php"
 * and fill in the values.
 *
 * This file contains the following configurations:
 *
 * * Database settings
 * * Secret keys
 * * Database table prefix
 * * ABSPATH
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/
 *
 * @package WordPress
 */

// ** Database settings - You can get this info from your web host ** //
/** The name of the database for WordPress */
define( 'DB_NAME', getenv('DB_NAME') ?: 'default_db' );

/** Database username */
define( 'DB_USER', getenv('DB_USER') ?: 'default_user' );

/** Database password */
define( 'DB_PASSWORD', getenv('DB_PASSWORD') ?: 'default_password' );

/** Database hostname */
define( 'DB_HOST', getenv('DB_HOST') ?: 'localhost' );

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
define('AUTH_KEY', getenv('AUTH_KEY') ?: 'default_auth_key');
define('SECURE_AUTH_KEY', getenv('SECURE_AUTH_KEY') ?: 'default_secure_auth_key');
define('LOGGED_IN_KEY', getenv('LOGGED_IN_KEY') ?: 'default_logged_in_key');
define('NONCE_KEY', getenv('NONCE_KEY') ?: 'default_nonce_key');
define('AUTH_SALT', getenv('AUTH_SALT') ?: 'default_auth_salt');
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT') ?: 'default_secure_auth_salt');
define('LOGGED_IN_SALT', getenv('LOGGED_IN_SALT') ?: 'default_logged_in_salt');
define('NONCE_SALT', getenv('NONCE_SALT') ?: 'default_nonce_salt');

/**#@-*/

/**
 * WordPress database table prefix.
 *
 * You can have multiple installations in one database if you give each
 * a unique prefix. Only numbers, letters, and underscores please!
 *
 * At the installation time, database tables are created with the specified prefix.
 * Changing this value after WordPress is installed will make your site think
 * it has not been installed.
 *
 * @link https://developer.wordpress.org/advanced-administration/wordpress/wp-config/#table-prefix
 */
$table_prefix = 'oc_';

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
 * @link https://developer.wordpress.org/advanced-administration/debug/debug-wordpress/
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