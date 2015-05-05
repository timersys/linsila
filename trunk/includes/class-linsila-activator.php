<?php

/**
 * Fired during plugin activation
 *
 * @link       http://wp.timersys.com
 * @since      1.0.0
 *
 * @package    Linsila
 * @subpackage Linsila/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Linsila
 * @subpackage Linsila/includes
 * @author     Damian Logghe <damian@timersys.com>
 */
class Linsila_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		// Checks if the main page option exists
		if ( ! linsila_get_opt( 'linsila_page', false ) ) {
			// Main Page ( Dashboard?)
			$linsila = wp_insert_post(
				array(
					'post_title'     => __( 'Linsila', 'linsila' ),
					'page_template'  => 'templates/linsila.php',
					'post_status'    => 'publish',
					'post_author'    => 1,
					'post_type'      => 'page',
					'comment_status' => 'closed'
				)
			);
			$options['linsila_page']         = $linsila;
		}

	}

}
