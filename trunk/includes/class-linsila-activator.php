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

		self::create_pages();


	}

	/**
	 * All pages needed for plugin
	 * @since 1.0.0
	 * return void
	 */
	private static function create_pages() {

		$pages = apply_filters( 'linsila/install/create_pages', array(
			'linsila' => array(
				'name'    => _x( 'linsila', 'Page slug', 'linsila' ),
				'title'   => _x( 'Linsila', 'Page title', 'linsila' ),
				'content' => '',
				'template'=> 'linsila.php'
			)
		) );

		foreach ( $pages as $key => $page ) {
			linsila_create_page( esc_sql( $page['name'] ), 'linsila_' . $key . '_page_id', $page['title'], $page['content'], ! empty( $page['template'] ) ? $page['template'] : '' , ! empty( $page['parent'] ) ? wc_get_page_id( $page['parent'] ) : '' );
		}
	}

}
