<?php
$root_dir = dirname(__DIR__);
$webroot_dir = $root_dir . '/web';

/**
 * Use Dotenv to set required environment variables and load .env file in root
 */
if (file_exists($root_dir . '/.env')) {
  Dotenv::load($root_dir);
}

Dotenv::required(array('DB_NAME', 'DB_USER', 'DB_PASSWORD', 'WP_HOME', 'WP_SITEURL'));

/**
 * Set up our global environment constant and load its config first
 * Default: development
 */
define('WP_ENV', getenv('WP_ENV') ? getenv('WP_ENV') : 'development');

$env_config = dirname(__FILE__) . '/environments/' . WP_ENV . '.php';

if (file_exists($env_config)) {
  require_once $env_config;
}

/**
 * Custom Content Directory
 */
define('CONTENT_DIR',     '/app');
define('WP_CONTENT_DIR',  $webroot_dir . CONTENT_DIR);
define('WP_CONTENT_URL',  WP_HOME . CONTENT_DIR);
define('WP_PLUGIN_DIR',   WP_CONTENT_DIR . '/plugins' );
define('PLUGINDIR',       WP_CONTENT_DIR . '/plugins' );
define('WP_PLUGIN_URL',   WP_CONTENT_URL . '/plugins' );
define('WPMU_PLUGIN_DIR', WP_CONTENT_DIR . '/mu-plugins' );
define('MUPLUGINDIR',     WP_CONTENT_DIR . '/mu-plugins' );
define('WPMU_PLUGIN_URL', WP_CONTENT_URL . '/mu-plugins' );
define('WPDI_PLUGIN_DIR', WP_CONTENT_DIR . '/dropins' );
define( 'UPLOADS',        WP_CONTENT_DIR . '/uploads' );

/**
 * DB settings
 */
define('DB_CHARSET', 'utf8');
define('DB_COLLATE', '');
$table_prefix = getenv('DB_PREFIX') ? getenv('DB_PREFIX') : 'wp_';

/**
 * Authentication Unique Keys and Salts
 */
define('AUTH_KEY',         getenv('AUTH_KEY'));
define('SECURE_AUTH_KEY',  getenv('SECURE_AUTH_KEY'));
define('LOGGED_IN_KEY',    getenv('LOGGED_IN_KEY'));
define('NONCE_KEY',        getenv('NONCE_KEY'));
define('AUTH_SALT',        getenv('AUTH_SALT'));
define('SECURE_AUTH_SALT', getenv('SECURE_AUTH_SALT'));
define('LOGGED_IN_SALT',   getenv('LOGGED_IN_SALT'));
define('NONCE_SALT',       getenv('NONCE_SALT'));

/**
 * Salt for Cache Key and Version for CSS / JS
 */
define( 'WP_CACHE_KEY_SALT', getenv('WP_CACHE_KEY_SALT') );
define( 'WP_SITE_VERSION',   getenv('WP_SITE_VERSION') );

/**
 * Disable updates
 */
define('AUTOMATIC_UPDATER_DISABLED', true);
define('WP_AUTO_UPDATE_CORE', false );

/**
 * Crons
 */
define('DISABLE_WP_CRON', true);
define('ALTERNATE_WP_CRON', true );
/**
 * Disable file editor
 */ 
define('DISALLOW_FILE_EDIT', true);
define('DISALLOW_FILE_MODS', true );

/** 
 * Enable multisite
 

define('MULTISITE', true);
define('SUBDOMAIN_INSTALL', true);
define('PATH_CURRENT_SITE', '/');
define('SITE_ID_CURRENT_SITE', 1);
define('BLOG_ID_CURRENT_SITE', 1);

*/
/**
 * Disable big updates
 */
define( 'DO_NOT_UPGRADE_GLOBAL_TABLES', true );
 
/** Location of the DB config file for HyperDB **/
define( 'DB_CONFIG_FILE', __DIR__ . '/db-config.php' );

/** Good morning! */
//define( 'SUNRISE', true );

/**
 * Bootstrap WordPress
 */
if (!defined('ABSPATH')) {
  define('ABSPATH', $webroot_dir . '/wp/');
}
