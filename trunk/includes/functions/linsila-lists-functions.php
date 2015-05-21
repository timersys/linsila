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
 * Return all the linsila_list terms in use
 * @return mixed
 */
function linsila_get_lists(){
	$lists = get_terms( 'linsila_list', array(
		'cache_domain'      => 'linsila_lists',
		'orderby'           => 'linsila_list_sort',
		'hide_empty'        => 0,
	) );

	return $lists;
}

