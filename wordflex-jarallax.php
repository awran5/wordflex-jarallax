<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              #
 * @since             1.0.0
 * @package           Wordflex_Jarallax
 *
 * @wordpress-plugin
 * Plugin Name:       WordFlex Jarallax
 * Plugin URI:        https://github.com/awran5/wordflex-jarallax
 * Description:       A light weighted WordPress plugin to add smooth parallax scrolling effect for background images, videos to your content.
 * Version:           1.0.0
 * Author:            Awran5
 * Author URI:        https://github.com/awran5/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wordflex-jarallax
 * Domain Path:       /languages
 *
 * 
 * This program is free software; you can redistribute it and/or
 * modify it under the terms of the GNU General Public License
 * as published by the Free Software Foundation; either version 2
 * of the License, or (at your option) any later version.

 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.

 * You should have received a copy of the GNU General Public License
 * along with this program; if not, write to the Free Software
 * Foundation, Inc., 51 Franklin Street, Fifth Floor, Boston, MA  02110-1301, USA.
 * 
 */ 

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'WFJ_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wordflex-jarallax-activator.php
 */
function activate_wordflex_jarallax() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordflex-jarallax-activator.php';
	Wordflex_Jarallax_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wordflex-jarallax-deactivator.php
 */
function deactivate_wordflex_jarallax() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wordflex-jarallax-deactivator.php';
	Wordflex_Jarallax_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_wordflex_jarallax' );
register_deactivation_hook( __FILE__, 'deactivate_wordflex_jarallax' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wordflex-jarallax.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wordflex_jarallax() {

	$plugin = new Wordflex_Jarallax();
	$plugin->run();

}
run_wordflex_jarallax();