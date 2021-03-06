<?php

/**
 * @link              https://www.cubetech.ch
 * @since             1.0.0
 * @package           Cubetech_Async_Mailer
 *
 * @wordpress-plugin
 * Plugin Name:       cubetech aSync Mailer
 * Plugin URI:        https://github.com/cubetech/wpplugin.cubetech-async-mailer
 * Description:       cubetech aSync Mailer – sends out your mails asynchronous
 * Version:           1.0.1
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
	 * Email Async.
	 *
	 * We override the wp_mail function for all non-cron requests with a function that simply
	 * captures the arguments and schedules a cron event to send the email.
	 */
	if ( ! defined( 'DOING_CRON' ) || ( defined( 'DOING_CRON' ) && ! DOING_CRON ) ) {

		if (  ! function_exists('wp_mail') ) {

		    function wp_mail() {

		        // Get the args passed to the wp_mail function
		        $args = func_get_args();

		        // Add a random value to work around that fact that identical events scheduled within 10 minutes of each other
		        // will not work. See: http://codex.wordpress.org/Function_Reference/wp_schedule_single_event
		        $args[] = mt_rand();

		        // Schedule the email to be sent
		        wp_schedule_single_event( time() + 5, 'cron_send_mail', $args );
		    }

		}

	}

	/**
	 * This function runs during cron requests to send emails previously scheduled by our
	 * overrided wp_mail function. We remove the last argument because it is just a random
	 * value added to make sure the cron job schedules correctly.
	 *
	 * @hook    cron_send_mail  10
	 */
	function cubetech_cron_send_mail() {

	    $args = func_get_args();

	    // Remove the random number that was added to the arguments
	    array_pop( $args );

	    // set content type of mail
		add_filter( 'wp_mail_content_type', 'html_mail' );

		// call original function of wp_mail
	    call_user_func_array( 'wp_mail', $args );

		// reset content type of mail
	    remove_filter( 'wp_mail_content_type', 'html_mail' );
	}

	/**
	 * Hook the mail sender. We accept more arguments than wp_mail currently takes just in case
	 * they add more in the future.
	 */
	add_action( 'cron_send_mail', 'cubetech_cron_send_mail', 10, 10 );

	/**
	 * Set text/html as content type for mails (use with filter: wp_mail_content_type)
	 */
	function html_mail() {
		return 'text/html';
	}
	
