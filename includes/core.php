<?php
/**
 * Core plugin functionality.
 *
 * @package TSB\WP\Plugin\Relationships
 */

namespace TSB\WP\Plugin\Relationships\Core;

use TSB\WP\Plugin\Relationships\ModuleInitialization;

/**
 * Default setup routine
 *
 * @return void
 */
function setup() {
	$n = function ( $function ) {
		return __NAMESPACE__ . "\\$function";
	};

	add_action( 'init', $n( 'i18n' ) );
	add_action( 'init', $n( 'init' ), (int) apply_filters( 'wp_relationships_init_priority', 8 ) );

	/**
	 * Fires when the Relationships plugin has loaded.
	 */
	do_action( 'wp_relationships_loaded' );
}

/**
 * Registers the default textdomain.
 *
 * @return void
 */
function i18n() {
	$locale = apply_filters( 'plugin_locale', get_locale(), 'wp-relationships' );
	load_textdomain( 'wp-relationships', WP_LANG_DIR . '/wp-relationships/wp-relationships-' . $locale . '.mo' );
	load_plugin_textdomain( 'wp-relationships', false, plugin_basename( WP_RELATIONSHIPS_PLUGIN_PATH ) . '/languages/' );
}

/**
 * Initializes the plugin and fires an action other plugins can hook into.
 *
 * @return void
 */
function init() {
	/**
	 * Fires before the Relationships plugin is initialized.
	 */
	do_action( 'wp_relationships_before_init' );

	// If the composer.json isn't found, trigger a warning.
	if ( ! file_exists( WP_RELATIONSHIPS_PLUGIN_PATH . 'composer.json' ) ) {
		add_action(
			'admin_notices',
			function () {
				$class = 'notice notice-error';
				/* translators: %s: the path to the plugin */
				$message = sprintf( __( 'The composer.json file was not found within %s. No classes will be loaded.', 'wp-relationships' ), WP_RELATIONSHIPS_PLUGIN_PATH );

				printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) );
			}
		);
		return;
	}

	ModuleInitialization::instance()->init_classes();

	/**
	 * Fires after the Relationships plugin is initialized.
	 */
	do_action( 'wp_relationships__init' );
}

/**
 * Activate the plugin
 *
 * @return void
 */
function activate() {
	// First load the init scripts in case any rewrite functionality is being loaded
	init();
}

/**
 * Deactivate the plugin
 *
 * Uninstall routines should be in uninstall.php
 *
 * @return void
 */
function deactivate() {
}
