<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              http://ljapps.com
 * @since             1.0
 * @package           WP_Facebook_Reviews
 *
 * @wordpress-plugin
 * Plugin Name:       WP Facebook Review Slider
 * Plugin URI:        http://ljapps.com/wp-review-slider-pro/
 * Description:       Allows you to easily display your Facebook Page reviews in your Posts, Pages, and Widget areas.
 * Version:           7.5
 * Author:            LJ Apps
 * Author URI:        http://ljapps.com/
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wp-fb-reviews
 * Domain Path:       /languages
 */


 
// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wp-fb-reviews-activator.php
 */
function activate_WP_FB_Reviews($networkwide) {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-fb-reviews-activator.php';
	WP_FB_Reviews_Activator::activate_all($networkwide);
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wp-fb-reviews-deactivator.php
 */
function deactivate_WP_FB_Reviews() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wp-fb-reviews-deactivator.php';
	WP_FB_Reviews_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_WP_FB_Reviews' );
register_deactivation_hook( __FILE__, 'deactivate_WP_FB_Reviews' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wp-fb-reviews.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_WP_FB_Reviews() {
	define( 'wpfbrev_plugin_dir', plugin_dir_path( __FILE__ ) );
	define( 'wpfbrev_plugin_url', plugins_url( "",__FILE__) );

	
	$plugin = new WP_FB_Reviews();
	$plugin->run();

}
run_WP_FB_Reviews();

