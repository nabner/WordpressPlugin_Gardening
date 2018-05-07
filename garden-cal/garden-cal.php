<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              www.nyssaabner.com
 * @since             1.0.0
 * @package           Garden_Cal
 *
 * @wordpress-plugin
 * Plugin Name:       Gardening Calendar
 * Plugin URI:        www.nyssaabner.com
 * Description:       This is a countdown/calendar/planning plugin for gardeners who need to know when to take action with their garden!
 * Version:           1.0.0
 * Author:            Nyssa Abner
 * Author URI:        www.nyssaabner.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       garden-cal
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently pligin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'PLUGIN_NAME_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-garden-cal-activator.php
 */
function activate_garden_cal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-garden-cal-activator.php';
	Garden_Cal_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-garden-cal-deactivator.php
 */
function deactivate_garden_cal() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-garden-cal-deactivator.php';
	Garden_Cal_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_garden_cal' );
register_deactivation_hook( __FILE__, 'deactivate_garden_cal' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-garden-cal.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_garden_cal() {

	$plugin = new Garden_Cal();
	$plugin->run();

}
run_garden_cal();
