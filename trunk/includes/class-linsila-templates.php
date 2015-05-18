<?php
/**
 * The class where all templates are loaded
 *
 * @package    Linsila
 * @subpackage Linsila/includes
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
			'linsila.php'     => __( 'Linsila', $this->plugin_slug ),

		);
		// adding support for theme templates to be merged and shown in dropdown
		$templates = wp_get_theme()->get_page_templates();
		$templates = array_merge( $templates, $this->templates );
	}

	/**
	 * Adds our template to the pages cache in order to trick WordPress
	 * into thinking the template file exists where it doens't really exist.
	 *
	 * @param   array    $atts    The attributes for the page attributes dropdown
	 * @return  array    $atts    The attributes for the page attributes dropdown
	 * @verison	1.0.0
	 * @since	1.0.0
	 */
	public function register_project_templates( $atts ) {
		// Create the key used for the themes cache
		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );
		// Retrieve the cache list. If it doesn't exist, or it's empty prepare an array
		$templates = wp_cache_get( $cache_key, 'themes' );
		if ( empty( $templates ) ) {
			$templates = array();
		} // end if
		// Since we've updated the cache, we need to delete the old cache
		wp_cache_delete( $cache_key , 'themes');
		// Now add our template to the list of templates by merging our templates
		// with the existing templates array from the cache.
		$templates = array_merge( $templates, $this->templates );
		// Add the modified cache to allow WordPress to pick it up for listing
		// available templates
		wp_cache_add( $cache_key, $templates, 'themes', 1800 );
		return $atts;
	} // end register_project_templates

	/**
	 * Checks if the template is assigned to the page
	 *
	 * @version    1.0.0
	 * @since    1.0.0
	 *
	 * @param $template
	 *
	 * @return string
	 */
	public function view_project_template( $template ) {
		global $post;
		// If no posts found, return to
		// avoid "Trying to get property of non-object" error
		if ( !isset( $post ) ) return $template;
		if ( ! isset( $this->templates[ get_post_meta( $post->ID, '_wp_page_template', true ) ] ) ) {
			return $template;
		} // end if

		$file = plugin_dir_path( __FILE__ ) . 'templates/' . get_post_meta( $post->ID, '_wp_page_template', true );

		// Just to be safe, we check if the file exist first
		if( file_exists( $file ) ) {
			return $file;
		} // end if
		return $template;
	} // end view_project_template



}
