<?php
/**
 * Get an option from plugin settings
 *
 * Looks to see if the specified setting exists, returns default if not
 * @param $key
 * @param $default
 * @since 1.0.0
 * @return mixed
 */
function linsila_get_opt( $key, $default ){
	global $linsila_opts;
	$value = ! empty( $linsila_opts[ $key ] ) ? $linsila_opts[ $key ] : $default;
	$value = apply_filters( 'linsila/get_option', $value, $key, $default );
	return apply_filters( 'linsila/get_option/' . $key, $value, $key, $default );
}