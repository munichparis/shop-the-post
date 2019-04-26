<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       https://munichparisstudio.com
 * @since      1.0.0
 *
 * @package    Shop_The_Post
 * @subpackage Shop_The_Post/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Shop_The_Post
 * @subpackage Shop_The_Post/includes
 * @author     MunichParis Studio <contact@munichparis.com>
 */
class Shop_The_Post_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'shop-the-post',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
