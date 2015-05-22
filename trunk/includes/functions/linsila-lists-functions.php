<?php
/**
 * Linsila Lists Functions
 *
 * @author      Damian Logghe
 * @package     Linsila/Includes/Functions
 * @version     1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/**
 * Return all the linsila_list terms in use ordered
 * @return mixed
 */
function linsila_get_lists(){
	$lists = get_terms( 'linsila_list', array(
		'cache_domain'      => 'linsila_lists',
		'orderby'           => 'linsila_list_sort',
		'hide_empty'        => 0,
	) );
	$order = get_option('linsila_lists_sorting');

	$lists_with_keys = array();

	foreach( $lists  as $l ) {
		$lists_with_keys[$l->term_id] = $l;
	}

	uksort($lists_with_keys, function($key1, $key2) use ($order) {
		return (array_search($key1, $order) > array_search($key2, $order));
	});
	return $lists_with_keys;

}

