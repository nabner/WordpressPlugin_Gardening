<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       www.nyssaabner.com
 * @since      1.0.0
 *
 * @package    Garden_Cal
 * @subpackage Garden_Cal/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Garden_Cal
 * @subpackage Garden_Cal/public
 * @author     Nyssa Abner <nyssa.abner@powerhouseco.tech>
 */


class Garden_Cal_Public {

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
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Garden_Cal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Garden_Cal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/garden-cal-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Garden_Cal_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Garden_Cal_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/garden-cal-public.js', array( 'jquery' ), $this->version, false );

	}

	// Check to see if My Garden Help Page already exists - if not, create it
	// Basis: https://clicknathan.com/web-design/automatically-create-pages-wordpress/
	function create_garden_help() {

		global $wpdb;

		global $garden_help_slug;
		global $garden_results_slug;
		$garden_help_slug = 'gardenhelp';
		$garden_results_slug = 'gardenhelp_results';


		// Check to see if 'My Garden Help Page' already exists via looking up the slug (aka post_name) in the db
		if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $garden_help_slug . "'", 'ARRAY_A')) {
			return true;
		} 
		
		// Future Enhancements:
		// Check for is_admin
		// Add page to nav
		// Delete page on deactivation
		
		else {

			// This is the html form to display upon install
			$garden_help_content =

			
			'<html>

			<div class = "garden_cal_body">
				
				<a href="http://planthardiness.ars.usda.gov/PHZMWeb/" target="_blank">
					<img src="../wp-content/plugins/garden-cal/hardiness_zones.jpg" alt="U.S. Map with Hardiness Zones">
				</a>

			</br>

			<div class = "form">

				<form action = "garden_cal_results.php" method = "post">

					Select Your Hardiness Zone
					<select name = "zone">
						<option value = "1"> 1</option>
						<option value = "2"> 2</option>
						<option value = "3"> 3</option>
						<option value = "4"> 4</option>
						<option value = "5"> 5</option>
						<option value = "6"> 6</option>
				        <option value = "7"> 7</option>
				        <option value = "8"> 8</option>
				        <option value = "9"> 9</option>
				        <option value = "10"> 10</option>
				        <!-- <option value = "11"> 11</option> -->
					</select>

					</br>

					Select Your Garden Type
					<select name = "garden_type">
						<option value = "box"> Box</option>
						<option value = "container"> Container</option>
						<option value = "indoor"> Indoor</option>
						<option value = "raised bed"> Raised Bed</option>
						<option value = "rooftop"> Rooftop</option>
					</select>

					</br>


					What type of vegetation will you plant?
					<select name = "plant_type">
						<option value = "annuals"> Annuals</option>
						<option value = "fruit trees"> Fruit Trees</option>
						<option value = "herbs"> Herbs</option>
						<option value = "perennials"> Perennials</option>
						<option value = "pollinators"> Pollinators</option>
						<option value = "vegatables"> Vegatables</option>
					</select>

					</br>

					Find out what you can do for your garden today!
				    <!-- 
				    "Submit" button to send the data to the PHP functions 
				    Would like the formaction button to feed off the $garden_results_slug if possible
				    -->
			    	<button type="submit"Go! formaction="../gardenhelp_results" method = "post">Go! </button> 

			    </form> 

				</div>

			</div>



			</html>'; 


			$garden_help_post = array(

				'post_type' => 'page',
				'post_title' => 'Garden Help',
				'post_content' => $garden_help_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => $garden_help_slug,
				'filter' => true
			);

			wp_insert_post($garden_help_post);

		} // End of else 

	} // End of if the "create_garden_help" function 


	// Check to see if Garden Help Results Page already exists - if not, create it
	// Basis: https://clicknathan.com/web-design/automatically-create-pages-wordpress/
	// Future improvements: 
	// Need to check for is_admin
	// Need to delete page on deactivation
	function create_garden_results() {

		global $wpdb;

		// These 2 varibales are defined in the 'create_garden_help' function
		global $garden_help_slug;
		global $garden_results_slug;



		// Check to see if 'My Garden Help Page Results' already exists via looking up the slug (aka post_name) in the db
		if($wpdb->get_row("SELECT post_name FROM wp_posts WHERE post_name = '" . $garden_results_slug . "'", 'ARRAY_A')) {
			
			$garden_results_content = include (dirname(__FILE__) . "/garden_cal_results.php");

			// If it already exists, update it
			$garden_help_update = array(
				'ID' => ($wpdb->get_row("SELECT ID FROM wp_posts WHERE post_name = '" . $garden_results_slug . "'", 'ARRAY_A')),
				'post_title' => 'Garden Help Results',
				'post_content' => $garden_results_content
			);
			
			wp_update_post($garden_help_update);
		} 
		
		// If it doesn't exist yet, create it
		else {

			// This page contents displays results from filling out the garden help form
			/////////////////////
			// UPDATE THE FUNCTIONS.PHP
			$garden_results_content = include (dirname(__FILE__) . "/garden_cal_results.php");
 

			$garden_results_post = array(

				'post_type' => 'page',
				'post_title' => 'Garden Help Results',
				'post_content' => $garden_results_content,
				'post_status' => 'publish',
				'post_author' => 1,
				'post_name' => $garden_results_slug,
				'filter' => true
			);

			wp_insert_post($garden_results_post);

		} // End of else 

	} // End of if the "create_garden_results" function 

}
