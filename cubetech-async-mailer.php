<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://www.cubetech.ch
 * @since             1.0.0
 * @package           Cubetech_Async_Mailer
 *
 * @wordpress-plugin
 * Plugin Name:       cubetech aSync Mailer
 * Plugin URI:        https://github.com/cubetech/wpplugin.cubetech-async-mailer
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            cubetech GmbH
 * Author URI:        https://www.cubetech.ch
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       cubetech-async-mailer
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-cubetech-async-mailer-activator.php
 */
function activate_cubetech_async_mailer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cubetech-async-mailer-activator.php';
	Cubetech_Async_Mailer_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-cubetech-async-mailer-deactivator.php
 */
function deactivate_cubetech_async_mailer() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cubetech-async-mailer-deactivator.php';
	Cubetech_Async_Mailer_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_cubetech_async_mailer' );
register_deactivation_hook( __FILE__, 'deactivate_cubetech_async_mailer' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-cubetech-async-mailer.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_cubetech_async_mailer() {

	$plugin = new Cubetech_Async_Mailer();
	$plugin->run();

}
run_cubetech_async_mailer();
