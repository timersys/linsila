<?php
/**
 * The class to handle all studd related to lists
 *
 * @package    Linsila
 * @subpackage Linsila/admin
 * @author     Damian Logghe <damian@timersys.com>
 */

class Linsila_Lists {
	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $linsila    The ID of this plugin.
	 */
	private $plugin_slug;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $linsila       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $linsila, $version ) {

		$this->plugin_slug = $linsila;
		$this->version = $version;
	}

	public function ajax_create_list(){
		check_ajax_referer( 'ajax-linsila-nonce', 'nonce' );

		$term     = esc_attr( $_POST['list_name']);
		$taxonomy = 'linsila_list';
 		$new_term = wp_insert_term( $term, $taxonomy, $args = array() );
		if( is_wp_error( $new_term ) ) {
			echo json_encode( array( 'error' => $new_term->get_error_message() ) );
			die();
		}

		echo json_encode( array( 'success' => $new_term ) );

		die();
	}
}