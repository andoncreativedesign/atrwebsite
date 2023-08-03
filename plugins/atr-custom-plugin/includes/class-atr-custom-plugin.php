<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       https://theandongroup.com
 * @since      1.0.0
 *
 * @package    Atr_Custom_Plugin
 * @subpackage Atr_Custom_Plugin/includes
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
 * @package    Atr_Custom_Plugin
 * @subpackage Atr_Custom_Plugin/includes
 * @author     Faris <faris@theandongroup.com>
 */
class Atr_Custom_Plugin {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Atr_Custom_Plugin_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

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
		if ( defined( 'ATR_CUSTOM_PLUGIN_VERSION' ) ) {
			$this->version = ATR_CUSTOM_PLUGIN_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'atr-custom-plugin';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Atr_Custom_Plugin_Loader. Orchestrates the hooks of the plugin.
	 * - Atr_Custom_Plugin_i18n. Defines internationalization functionality.
	 * - Atr_Custom_Plugin_Admin. Defines all hooks for the admin area.
	 * - Atr_Custom_Plugin_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-atr-custom-plugin-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-atr-custom-plugin-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-atr-custom-plugin-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-atr-custom-plugin-public.php';

		$this->loader = new Atr_Custom_Plugin_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Atr_Custom_Plugin_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Atr_Custom_Plugin_i18n();

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

		$plugin_admin = new Atr_Custom_Plugin_Admin( $this->get_plugin_name(), $this->get_version() );

		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		//$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Atr_Custom_Plugin_Public( $this->get_plugin_name(), $this->get_version() );

		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		//$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		$this->loader->add_action( 'init', $plugin_public, 'ct_create_custom_post_types' );
		$this->loader->add_action( 'init', $plugin_public, 'ct_create_subjects_hierarchical_taxonomy' );
		$this->loader->add_action( 'init', $plugin_public, 'ct_create_propertylocation_taxonomy' );

		$this->loader->add_filter( 'pll_the_language_link', $plugin_public, 'ct_url_query_string' );

		// $this->loader->add_shortcodes('show_welcome_video_section',$plugin_public,'show_welcome_video_section_fn');
		// $this->loader->add_shortcodes('show_promo_slider', $plugin_public,'wpb_promo_slider_shortcode');
		
		//$this->loader->add_shortcodes('show_people', $plugin_public,'wpb_demo_shortcode');

		$this->loader->add_shortcodes('show_mission_slider',$plugin_public,'show_mission_slider_fn');
		$this->loader->add_shortcodes("show_home_explore_community",$plugin_public,"show_explore_community_properties_home_fn");
		// $this->loader->add_shortcodes('show_design_features',$plugin_public,'show_design_features_fn');
		$this->loader->add_shortcodes('show_community_properties',$plugin_public,'show_community_properties_fn');
		$this->loader->add_shortcodes('show_community_listing',$plugin_public,'show_community_listing_fn');
		$this->loader->add_shortcodes('show_communities_how_we_can_help',$plugin_public,'show_communities_how_we_can_help_fn');
		$this->loader->add_shortcodes('sc_onload_popup',$plugin_public,'sc_onload_popup_fn');
		// $this->loader->add_shortcodes('get_explore_community',$plugin_public,'get_explore_the_Community');
		$this->loader->add_shortcodes('sc_fr_testimonials_noslider',$plugin_public,'fr_testimonials_noslider');
		// $this->loader->add_shortcodes('community_detail_page_slider',$plugin_public,'community_detail_page_slider_fn');
		// $this->loader->add_shortcodes('careers_page_dynamic',$plugin_public,'sc_careers_page_dynamic_fn');
		$this->loader->add_shortcodes('people_testimonial_services',$plugin_public,'people_testimonial');
		$this->loader->add_shortcodes('have_property_in_mind_calculator_services',$plugin_public,'have_property_in_mind_calculator');
		// $this->loader->add_shortcodes('finance_home_image_services',$plugin_public,'finance_home_image');
		$this->loader->add_shortcodes('choosing_your_home_services',$plugin_public,'choosing_your_home');
		// $this->loader->add_shortcodes('faqs_home_image_services',$plugin_public,'faqs_home_image');
		$this->loader->add_shortcodes('sc_show_contactus_page',$plugin_public,'sc_show_contact_page_fn');
		
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
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Atr_Custom_Plugin_Loader    Orchestrates the hooks of the plugin.
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

}
