<?php
/**
 * The class where all custom post types are defined
 *
 * @package    Linsila
 * @subpackage Linsila/admin
 * @author     Damian Logghe <damian@timersys.com>
 */
class Linsila_Cpts {

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

	}

	/**
	 * Register the cpts needed in plugin
	 *
	 * @since    1.0.0
	 */
	public function register_cpts() {

		$this->linsila_projects();
		$this->linsila_clients();
		$this->register_taxonomies();
	}

	/**
	 * Linsila projects cpt
	 */
	private function linsila_projects(){

		$labels = array(
			'name'               =>  __( 'Linsila', $this->plugin_slug ),
			'singular_name'      => _x( 'Projects', 'post type singular name', $this->plugin_slug ),
			'menu_name'          => _x( 'Linsila', 'admin menu', $this->plugin_slug ),
			'name_admin_bar'     => _x( 'Projects', 'add new on admin bar', $this->plugin_slug ),
			'add_new'            => _x( 'Add New', 'Projects', $this->plugin_slug ),
			'add_new_item'       => __( 'Add New Project', $this->plugin_slug ),
			'new_item'           => __( 'New Project', $this->plugin_slug ),
			'edit_item'          => __( 'Edit Project', $this->plugin_slug ),
			'view_item'          => __( 'View Projects', $this->plugin_slug ),
			'all_items'          => __( 'Projects', $this->plugin_slug ),
			'search_items'       => __( 'Search Projects', $this->plugin_slug ),
			'parent_item_colon'  => __( 'Parent Projects:', $this->plugin_slug ),
			'not_found'          => __( 'No Projects found.', $this->plugin_slug ),
			'not_found_in_trash' => __( 'No Projects found in Trash.', $this->plugin_slug )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'exclude_from_search'=> true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_menu'       => true,
			'query_var'          => true,
			'rewrite'            => array( 'slug' => apply_filters('linsila/cpts/projects_slug','project') ),
			'capability_type'    => 'post',
			'capabilities' => array(
				'publish_posts' 		=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'edit_posts' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'edit_others_posts' 	=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'delete_posts' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'delete_others_posts' 	=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'read_private_posts' 	=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'edit_post' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'delete_post' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'read_post' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
			),
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'			 => 'dashicons-analytics',
			'supports'           => array( 'title', 'editor' )
		);

		register_post_type( 'linsila_project', $args );
	}

	/**
	 * Linsila clients cpt
	 */
	private function linsila_clients(){

		$labels = array(
			'name'               =>  __( 'Client', $this->plugin_slug ),
			'singular_name'      => _x( 'Client', 'post type singular name', $this->plugin_slug ),
			'menu_name'          => _x( 'Clients', 'admin menu', $this->plugin_slug ),
			'name_admin_bar'     => _x( 'Clients', 'add new on admin bar', $this->plugin_slug ),
			'add_new'            => _x( 'Add New', 'Clients', $this->plugin_slug ),
			'add_new_item'       => __( 'Add New Client', $this->plugin_slug ),
			'new_item'           => __( 'New Client', $this->plugin_slug ),
			'edit_item'          => __( 'Edit Client', $this->plugin_slug ),
			'view_item'          => __( 'View Client', $this->plugin_slug ),
			'all_items'          => __( 'Clients', $this->plugin_slug ),
			'search_items'       => __( 'Search Clients', $this->plugin_slug ),
			'parent_item_colon'  => __( 'Parent Clients:', $this->plugin_slug ),
			'not_found'          => __( 'No Clients found.', $this->plugin_slug ),
			'not_found_in_trash' => __( 'No Clients found in Trash.', $this->plugin_slug )
		);

		$args = array(
			'labels'             => $labels,
			'public'             => true,
			'exclude_from_search'=> true,
			'publicly_queryable' => false,
			'show_ui'            => true,
			'show_in_nav_menus'  => false,
			'show_in_menu'       => 'edit.php?post_type=linsila_project',
			'query_var'          => true,
			'rewrite'            => array( 'slug' => apply_filters('linsila/cpts/clients_slug','project') ),
			'capability_type'    => 'post',
			'capabilities' => array(
				'publish_posts' 		=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'edit_posts' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'edit_others_posts' 	=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'delete_posts' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'delete_others_posts' 	=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'read_private_posts' 	=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'edit_post' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'delete_post' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
				'read_post' 			=> apply_filters( 'linsila/cpts/roles', 'manage_options'),
			),
			'has_archive'        => false,
			'hierarchical'       => false,
			'menu_position'      => null,
			'menu_icon'			 => 'dashicons-analytics',
			'supports'           => array( 'title' )
		);

		register_post_type( 'linsila_client', $args );
	}

	/**
	 * Create taxonomies instance
	 */
	private function register_taxonomies() {
		$taxonomies = new Linsila_Taxonomies( $this->plugin_slug, $this->version);
	}
}
