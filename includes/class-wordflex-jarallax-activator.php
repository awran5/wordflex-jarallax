<?php

/**
 * Fired during plugin activation
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wordflex_Jarallax
 * @subpackage Wordflex_Jarallax/includes
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Wordflex_Jarallax
 * @subpackage Wordflex_Jarallax/includes
 * @author     Awran5 <awran5@yahoo.com>
 */
class Wordflex_Jarallax_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		flush_rewrite_rules();
	}

}


