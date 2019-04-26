<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://munichparisstudio.com
 * @since             1.0.0
 * @package           Shop_The_Post
 *
 * @wordpress-plugin
 * Plugin Name:       Shop the Post
 * Plugin URI:        https://munichparisstudio.com
 * Description:       Add affiliate products and shopping widgets to your posts to provide an easy way of shopping to your readers.
 * Version:           1.0.0
 * Author:            MunichParis Studio
 * Author URI:        https://munichparisstudio.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       shop-the-post
 * Domain Path:       /languages
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
define( 'SHOP_THE_POST_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-shop-the-post-activator.php
 */
function activate_shop_the_post() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shop-the-post-activator.php';
	Shop_The_Post_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-shop-the-post-deactivator.php
 */
function deactivate_shop_the_post() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-shop-the-post-deactivator.php';
	Shop_The_Post_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_shop_the_post' );
register_deactivation_hook( __FILE__, 'deactivate_shop_the_post' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-shop-the-post.php';

/**
* Plugin update checker
*/
require 'plugin-update-checker-4.6/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/munichparis/shop-the-post',
	__FILE__,
	'shop-the-post'
);
$myUpdateChecker->getVcsApi()->enableReleaseAssets();


/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_shop_the_post() {

	$plugin = new Shop_The_Post();
	$plugin->run();

}
run_shop_the_post();
