<?php

/**
 * The plugin bootstrap file.
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * Dashboard. This file also includes all the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @package   TSB\WP\Plugin\Relationships
 * @copyright Copyright (C) 2025-2025, 26B - IT Consulting <hello@26b.io>
 * @license   http://www.gnu.org/licenses/gpl-3.0.html GNU General Public License, version 3 or higher
 *
 * @wordpress-plugin
 * Plugin Name:       WP Relationships
 * Description:       A relationship API for WordPress entities.
 * Version:           Unreleased
 * Author:            26B - IT Consulting
 * Author URI:        https://26b.io/
 * License:           GPL v3
 * Requires at least: 6.5
 * Requires PHP:      8.1.0
 * Text Domain:       wp-relationships
 * Domain Path:       /languages
 */

// Useful global constants.
define( 'WP_RELATIONSHIPS_PLUGIN_VERSION', 'Unreleased' );
define( 'WP_RELATIONSHIPS_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'WP_RELATIONSHIPS_PLUGIN_PATH', plugin_dir_path( __FILE__ ) );
define( 'WP_RELATIONSHIPS_PLUGIN_INC', WP_RELATIONSHIPS_PLUGIN_PATH . 'includes/' );
define( 'WP_RELATIONSHIPS_PLUGIN_DIST_URL', WP_RELATIONSHIPS_PLUGIN_URL . 'build/' );
define( 'WP_RELATIONSHIPS_PLUGIN_DIST_PATH', WP_RELATIONSHIPS_PLUGIN_PATH . 'build/' );

// Require Composer autoloader if it exists.
if ( file_exists( WP_RELATIONSHIPS_PLUGIN_PATH . 'vendor/autoload.php' ) ) {
	include_once WP_RELATIONSHIPS_PLUGIN_PATH . 'vendor/autoload.php';
}

// Include files.
require_once WP_RELATIONSHIPS_PLUGIN_INC . '/core.php';

// Activation/Deactivation.
register_activation_hook( __FILE__, '\TSB\WP\Plugin\Relationships\Core\activate' );
register_deactivation_hook( __FILE__, '\TSB\WP\Plugin\Relationships\Core\deactivate' );

// Bootstrap.
TSB\WP\Plugin\Relationships\Core\setup();
