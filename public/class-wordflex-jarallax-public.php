<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wordflex_Jarallax
 * @subpackage Wordflex_Jarallax/public
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wordflex_Jarallax
 * @subpackage Wordflex_Jarallax/public
 * @author     Awran5 <awran5@yahoo.com>
 */
class Wordflex_Jarallax_Public {

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
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;
	}

	/**
	 * Check to see if the bootstrap.css is included in a theme
	 * @see   wp_style_is()
	 * @return Bool
	 */
	public function is_style( $style ) {
		return wp_style_is( $style );
	}

	/**
	 * Check to see if the bootstrap.css is included in a theme
	 * @see   wp_script_is()
	 * @return Bool
	 */
	public function is_script( $script ) {
		return wp_script_is( $script );
	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * An instance of this class should be passed to the run() function
		 * defined in Wordflex_Jarallax_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wordflex_Jarallax_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'css/wordflex-jarallax-public.css', 
			array(), 
			$this->version, 
			'all' 
		);
	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		// Check if Jarallax is already loaded
		if( !$this->is_script('jarallax') ) {
			/**
			 * Load Jarallax Main Plugin
			 */
			wp_enqueue_script( 
				$this->plugin_name . '-jarallax', 
				plugin_dir_url( __FILE__ ) . 'js/jarallax.min.js', 
				array(), 
				$this->version, 
				true 
			);

			/**
			 * Load Jarallax video addon depends on jarallax
			 */
			wp_enqueue_script( 
				$this->plugin_name . '-jarallax-video', 
				plugin_dir_url( __FILE__ ) . 'js/jarallax-video.min.js', 
				array( $this->plugin_name . '-jarallax' ), 
				$this->version, 
				true 
			);
		}
		/**
		 * Load Plugin Main script 
		 */
		wp_enqueue_script( 
			$this->plugin_name, 
			plugin_dir_url( __FILE__ ) . 'js/wordflex-jarallax-public.js',
			array( 'jquery' ), 
			$this->version, 
			true 
		);
	}	
}