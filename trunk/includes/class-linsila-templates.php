<?php
/**
 * The class where all templates are loaded
 *
 * @package    Linsila
 * @subpackage Linsila/admin
 * @author     Damian Logghe <damian@timersys.com>
 */
class Linsila_Templates {

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
	 * The array of templates that this plugin tracks.
	 * @since   1.0.0
	 * @access protected
	 * @var      array
	 */
	protected $templates;

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
		$this->templates = array();

		// Add your templates to this array.
		$this->templates = array(
			'template-example.php'     => __( 'Linsila', $this->plugin_slug ),

		);
		// adding support for theme templates to be merged and shown in dropdown
		$templates = wp_get_theme()->get_page_templates();
		$templates = array_merge( $templates, $this->templates );
	}



}
