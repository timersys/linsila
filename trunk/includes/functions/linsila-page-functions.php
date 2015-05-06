<?php
/**
 * Linsila Page Functions
 *
 * @author      Damian Logghe
 * @package     Linsila/Includes/Functions
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Retrieve page ids of linsila created pages
 *
 * @param string $page key
 * @return int
 */
function wc_get_page_id( $page ) {

	$page = apply_filters( 'linsila/get_' . $page . '_page_id', get_option('linsila_' . $page . '_page_id' ) );

	return $page ? absint( $page ) : -1;
}

/**
 * Create a page and store the ID in an option.
 *
 * @param mixed $slug Slug for the new page
 * @param string $option Option name to store the page's ID
 * @param string $page_title (default: '') Title for the new page
 * @param string $page_content (default: '') Content for the new page
 * @param string $template template file
 * @param int $post_parent (default: 0) Parent for the new page
 *
 * @return int page ID
 * @since 1.0.0
 */
function linsila_create_page( $slug, $option = '', $page_title = '', $page_content = '', $template = "", $post_parent = 0 ) {
	global $wpdb;

	$option_value = get_option( $option );

	if ( $option_value > 0 && get_post( $option_value ) ) {
		return -1;
	}

	if ( strlen( $page_content ) > 0 ) {
		// Search for an existing page with the specified page content (typically a shortcode)
		$page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM " . $wpdb->posts . " WHERE post_type='page' AND post_content LIKE %s LIMIT 1;", "%{$page_content}%" ) );
	} else {
		// Search for an existing page with the specified page slug
		$page_found = $wpdb->get_var( $wpdb->prepare( "SELECT ID FROM " . $wpdb->posts . " WHERE post_type='page' AND post_name = %s LIMIT 1;", $slug ) );
	}

	$page_found = apply_filters( 'linsila/create_page_id', $page_found, $slug, $page_content );

	if ( $page_found ) {
		if ( ! $option_value ) {
			update_option( $option, $page_found );
		}

		return $page_found;
	}

	$page_data = array(
		'post_status'       => 'publish',
		'post_type'         => 'page',
		'post_author'       => 1,
		'post_name'         => $slug,
		'post_title'        => $page_title,
		'post_content'      => $page_content,
		'post_parent'       => $post_parent,
		'page_template'     => $template,
		'comment_status'    => 'closed'
	);
	$page_id = wp_insert_post( $page_data );

	if ( $option ) {
		update_option( $option, $page_id );
	}

	return $page_id;
}