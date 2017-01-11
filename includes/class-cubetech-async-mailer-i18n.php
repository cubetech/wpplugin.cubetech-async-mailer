<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://www.cubetech.ch
 * @since      1.0.0
 *
 * @package    Cubetech_Async_Mailer
 * @subpackage Cubetech_Async_Mailer/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cubetech_Async_Mailer
 * @subpackage Cubetech_Async_Mailer/includes
 * @author     cubetech GmbH <info@cubetech.ch>
 */
class Cubetech_Async_Mailer_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cubetech-async-mailer',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
