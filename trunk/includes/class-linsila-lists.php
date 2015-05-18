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

		echo json_encode( array('success' => true) );
		die();
	}
}