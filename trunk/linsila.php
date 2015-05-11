<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://wp.timersys.com
 * @since             1.0.0
 * @package           Linsila
 *
 * @wordpress-plugin
 * Plugin Name:       Linsila
 * Plugin URI:        https://linsila.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            Damian Logghe
 * Author URI:        http://wp.timersys.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       linsila
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

define( 'LINSILA_PLUGIN_DIR' , plugin_dir_path(__FILE__) );
define( 'LINSILA_PLUGIN_URL' , plugin_dir_url(__FILE__) );
define( 'LINSILA_PLUGIN_HOOK' , basename( dirname( __FILE__ ) ) . '/' . basename( __FILE__ ) );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-linsila-activator.php
 */
function activate_linsila() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-linsila-activator.php';
	Linsila_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-linsila-deactivator.php
 */
function deactivate_linsila() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-linsila-deactivator.php';
	Linsila_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_linsila' );
register_deactivation_hook( __FILE__, 'deactivate_linsila' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-linsila.php';

/**
 * Begins execution of the plugin.
 * @since    1.0.0
 */
function Linsila() {

	$plugin = Linsila::instance();
	$plugin->run();
	return $plugin;

}

$GLOBALS['Linsila'] = Linsila();
