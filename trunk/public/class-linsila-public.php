<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       http://wp.timersys.com
 * @since      1.0.0
 *
 * @package    Linsila
 * @subpackage Linsila/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Linsila
 * @subpackage Linsila/public
 * @author     Damian Logghe <damian@timersys.com>
 */
class Linsila_Public {

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
	 * @param      string    $linsila       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $linsila, $version ) {

		$this->plugin_slug = $linsila;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		wp_enqueue_style( 'lin-foundation', plugin_dir_url( __FILE__ ) . 'css/foundation.min.css', array(), $this->version, 'all' );
		wp_enqueue_style( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'css/linsila-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		wp_enqueue_script( 'lin-foundation', plugin_dir_url( __FILE__ ) . 'js/foundation.min.js', array( 'jquery' ), $this->version, true );
		wp_enqueue_script( 'lin-modernizer', plugin_dir_url( __FILE__ ) . 'js/vendor/modernizr.js', '', $this->version, false );
		wp_enqueue_script( $this->plugin_slug, plugin_dir_url( __FILE__ ) . 'js/linsila-public.js', array( 'jquery' ), $this->version, true );

	}


	/**
	 * If we are in our template strip everything out and leave it clean
	 * @since 1.0.0
	 */
	public function remove_all_actions(){
		if( ! is_linsila_page() )
			return;
		global $wp_scripts, $wp_styles;

		$exceptions = array(
			'admin-bar',
			'jquery',
			'query-monitor',
			'lin-modernizer',
			'lin-foundation',
			'linsila'
		);

		foreach( $wp_scripts->queue as $handle ){
			if( in_array($handle, $exceptions))
				continue;
			wp_dequeue_script($handle);
		}

		foreach( $wp_styles->queue as $handle ){
			if( in_array($handle, $exceptions) )
				continue;
			wp_dequeue_style($handle);
		}

		// Now remove actions
		$action_exceptions = array(
			'wp_print_footer_scripts',
			'wp_admin_bar_render',

		);

		// No core action in header
		remove_all_actions('wp_header');

		global $wp_filter;
		foreach( $wp_filter['wp_footer'] as $priority => $handle ){

			if( in_array( key($handle), $action_exceptions ) )
				continue;
			unset( $wp_filter['wp_footer'][$priority] );
		}

	}

	/**
	 * Check if user is logged and then check if authorized to be here
	 */
	public function check_user_authorization(){
		if( ! is_linsila_page() )
			return;

		$authorized = false;
		echo '<pre>';
		var_dump(get_permalink( linsila_get_page_id('linsila')));
		echo '<pre>';
		die();
		if( ! is_user_logged_in() )
			wp_safe_redirect( wp_login_url());

		$authorized_roles = apply_filters('linsila/authorized_roles', array('administrator'));

		foreach( $authorized_roles as $role ){
			if( current_user_can($role) )
				$authorized = true;
		}

		if( !$authorized )
			wp_safe_redirect( wp_login_url());
	}
}
