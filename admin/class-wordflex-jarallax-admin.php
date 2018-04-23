<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wordflex_Jarallax
 * @subpackage Wordflex_Jarallax/admin
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wordflex_Jarallax
 * @subpackage Wordflex_Jarallax/admin
 * @author     Awran5 <awran5@yahoo.com>
 */
class Wordflex_Jarallax_Admin {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

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
	 * @param    string    $plugin_name       The name of this plugin.
	 * @param    string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
		$this->load_admin_panel();
	}

	public function load_admin_panel() {

		/**
		 * Include CMB2 library
		 * @link https://github.com/WebDevStudios/CMB2
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/lib/cmb2/init.php';
		/**
		 * Include CMB2 Slider
		 * @link https://github.com/improy/CMB2-slider-field
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/lib/cmb2-custom/cmb2-slider/cmb2-field-slider.php';
		/**
		 * Load Admin page
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wordflex-jarallax-admin-display.php';
		/**
		 * Load Jarallax shortcode
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/partials/wordflex-jarallax-shortcode.php';
	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * Load main plugin stylesheet depending on jquery ui stylesheet
		 */
		wp_enqueue_style( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'css/wordflex-jarallax-admin.css', 
			array(), 
			$this->version,
			'all' 
		);

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * CMB2 confitional
		 */
		wp_enqueue_script( 
			$this->plugin_name . 'cmb2-conditional-logic', 
			plugin_dir_url( __FILE__ ) . 'js/cmb2-conditional-logic.js', 
			array( 'jquery' ), 
			$this->version, 
			true 
		);

		/**
		 * Load main plugin script
		 */
		wp_enqueue_script( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'js/wordflex-jarallax-admin.js', 
			array( 'jquery' ), 
			$this->version, 
			true 
		);

	}

	/**
	 * Register a custom post type called "wordflex-jarallax".
	 *
	 * @see partials/wordflex-jarallax-admin-display.php for (WordFlex_Jarallax_admin_metabox)
	 */
	public function create_post_type() {
	    
	    $labels = array(
	        'name'              => _x('WordFlex Jarallax', 'wordflex-jarallax'),
	        'singular_name'     => _x('WordFlex Jarallax', 'wordflex-jarallax'),
	        'add_new'           => _x('New background', 'wordflex-jarallax'),
	        'all_items'         => __('All backgrounds', 'wordflex-jarallax'),
	        'add_new_item'      => __('Add background', 'wordflex-jarallax'),
	        'edit_item'         => __('Edit background', 'wordflex-jarallax'),
	        'new_item'          => __('New background', 'wordflex-jarallax'),
	        'view_item'         => __('View background', 'wordflex-jarallax'),
	        'search_items'      => __('Search backgrounds', 'wordflex-jarallax'),
	        'not_found'         => __('No backgrounds found', 'wordflex-jarallax'),
	        'not_found_in_trash'=> __('No backgrounds found in trash', 'wordflex-jarallax'),
	        'parent_item_colon' => __('Parent background', 'wordflex-jarallax'),
	    );

	    $args = array(
	        'labels'                => $labels,
	        'public'                => false,  
	        'publicly_queryable'    => false,
	        'exclude_from_search'   => true,
	        'show_in_nav_menus'     => false,
	        'show_ui'               => true,
	        'show_in_menu'          => true,
	        'show_in_admin_bar'     => true,         
	        'can_export'            => true,
	        'hierarchical'          => false,
	        'has_archive'           => false,
	        'query_var'             => false,
	        'capability_type'       => 'page',
	        'map_meta_cap'          => true,
	        'menu_icon'             => 'dashicons-align-center',
	        'menu_position'         => 100,
	        'supports'              => array( 'title' ),
	        'register_meta_box_cb'  => 'WordFlex_Jarallax_register_metabox', // callback
	    );
	    register_post_type( 'wordflex-jarallax', $args );
	}

	/**
	 * Disable cmb2 default styles
	 * @return Empty
	 */
	public function disable_cmb2_styles() {}

}