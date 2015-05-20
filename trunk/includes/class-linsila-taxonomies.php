<?php
/**
 * The class where all custom post types are defined
 *
 * @package    Linsila
 * @subpackage Linsila/admin
 * @author     Damian Logghe <damian@timersys.com>
 */
class Linsila_Taxonomies {

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
	 * @param      string    $linsila       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $linsila, $version ) {

		$this->plugin_slug = $linsila;
		$this->version = $version;
		$this->run();
	}

	/**
	 * Register the taxonomies for custom cpts
	 * we call them cpt_name_tax_name
	 * @since    1.0.0
	 */
	public function run() {

		$this->linsila_project_linsila_list();


	}

	private function linsila_project_linsila_list() {
		// Add new taxonomy, make it hierarchical (like categories)
		$labels = array(
			'name'              => _x( 'Lists', 'taxonomy general name', $this->plugin_slug ),
			'singular_name'     => _x( 'List', 'taxonomy singular name', $this->plugin_slug ),
			'search_items'      => __( 'Search Lists', $this->plugin_slug ),
			'all_items'         => __( 'All Lists', $this->plugin_slug ),
			'parent_item'       => __( 'Parent List', $this->plugin_slug ),
			'parent_item_colon' => __( 'Parent List:', $this->plugin_slug ),
			'edit_item'         => __( 'Edit List', $this->plugin_slug ),
			'update_item'       => __( 'Update List', $this->plugin_slug ),
			'add_new_item'      => __( 'Add New List', $this->plugin_slug ),
			'new_item_name'     => __( 'New List Name', $this->plugin_slug ),
			'menu_name'         => __( 'Lists', $this->plugin_slug ),
		);

		$args = array(
			'hierarchical'      => false,
			'labels'            => $labels,
			'show_ui'           => true,
			'show_admin_column' => true,
			'query_var'         => true,
			'rewrite'           => array( 'slug' => 'list' ),
		);

		register_taxonomy( 'linsila_list', array( 'linsila_project' ), $args );
	}

}
