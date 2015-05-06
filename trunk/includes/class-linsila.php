<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       http://wp.timersys.com
 * @since      1.0.0
 *
 * @package    Linsila
 * @subpackage Linsila/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Linsila
 * @subpackage Linsila/includes
 * @author     Damian Logghe <damian@timersys.com>
 */
class Linsila {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Linsila_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $linsila    The string used to uniquely identify this plugin.
	 */
	protected $linsila;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * All the settings options stored in db
	 *
	 * @since    2.5.0
	 * @access   protected
	 * @var      array    $settings  Saved settings
	 */
	protected $settings;

	/**
	 * Default values
	 * @since   2.5.0
	 * @access  private
	 * @var array of defaults
	 */
	private $defaults;
	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {

		$this->plugin_slug = 'linsila';
		$this->version = '1.0.0';

		$this->load_dependencies();
		$this->load_settings();
		$this->set_locale();
		$this->add_templates();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Linsila_Loader. Orchestrates the hooks of the plugin.
	 * - Linsila_i18n. Defines internationalization functionality.
	 * - Linsila_Admin. Defines all hooks for the admin area.
	 * - Linsila_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/linsila-admin-functions.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/functions/linsila-page-functions.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-linsila-loader.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-linsila-i18n.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-linsila-admin.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-linsila-public.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-linsila-cpts.php';
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-linsila-templates.php';

		$this->loader = new Linsila_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Linsila_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Linsila_i18n();
		$plugin_i18n->set_domain( $this->get_linsila() );

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Linsila_Admin( $this->get_linsila(), $this->get_version() );
		$cpts = new Linsila_Cpts( $this->get_linsila(), $this->get_version() );

		//Register all custom post types
		$this->loader->add_action( 'init', $cpts, 'register_cpts' );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Linsila_Public( $this->get_linsila(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		// if we ar ein linsila remove everything from header/footer
		$this->loader->add_action( 'wp', $plugin_public, 'remove_all_actions' );

	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_linsila() {
		return $this->plugin_slug;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Linsila_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

	/**
	 * Load all settings and defaults
	 * @since   1.0.0
	 */
	private function load_settings() {
		global $linsila_opts;

		$linsila_opts = $this->settings =  wp_parse_args( get_option( 'linsila_settings', $this->defaults ), $this->defaults ) ;
	}

	/**
	 * Load plugin defaults
	 * @since   1.0.0
	 */
	public function load_defaults() {

		$defaults       = array();
		$this->defaults = apply_filters( 'linsila/load_defaults', $defaults );
	}

	private function add_templates() {
		$templates = new Linsila_Templates( $this->plugin_slug, $this->version);

		// Add a filter to the page attributes metabox to inject our template into the page template cache.
		$this->loader->add_filter( 'page_attributes_dropdown_pages_args', $templates, 'register_project_templates');
		// Add a filter to the save post in order to inject out template into the page cache
		$this->loader->add_filter( 'wp_insert_post_data', $templates, 'register_project_templates');
		// Add a filter to the template include in order to determine if the page has our template assigned and return it's path
		$this->loader->add_filter( 'template_include', $templates, 'view_project_template');
	}
}
