<?php
/**
 * We handle all customers here
 *
 * @package    Linsila
 * @subpackage Linsila/Includes
 * @author     Damian Logghe <damian@timersys.com>
 */
class Linsila_Clients {

	/*
	 * @var Array of clients objects
	 */
	private $clients;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 */
	public function __construct( ) {

	}

	public function getClients(){
		global $post;

		$this->clients = array();

		$args = array(
			'post_type'		=> 'linsilia_client',
			'post_status'	=> 'publish',
			'posts_per_page' => -1
		);
		// The Query
		$the_query = new WP_Query( $args );

		// The Loop
		if ( $the_query->have_posts() ) {
			while ( $the_query->have_posts() ) {
				$the_query->the_post();

				$this->clients[] = $post;
			}
		}
		/* Restore original Post Data */
		wp_reset_postdata();

		return $this->clients;
	}


}
