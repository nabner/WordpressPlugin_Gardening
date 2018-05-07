<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       www.nyssaabner.com
 * @since      1.0.0
 *
 * @package    Garden_Cal
 * @subpackage Garden_Cal/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Garden_Cal
 * @subpackage Garden_Cal/includes
 * @author     Nyssa Abner <nyssa.abner@powerhouseco.tech>
 */
class Garden_Cal_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'garden-cal',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
