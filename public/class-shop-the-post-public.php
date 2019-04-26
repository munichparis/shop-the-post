<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://munichparisstudio.com
 * @since      1.0.0
 *
 * @package    Shop_The_Post
 * @subpackage Shop_The_Post/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Shop_The_Post
 * @subpackage Shop_The_Post/public
 * @author     MunichParis Studio <contact@munichparis.com>
 */
class Shop_The_Post_Public {

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
		 * defined in Shop_The_Post_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shop_The_Post_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/shop-the-post-public.css', array(), $this->version, 'all' );

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
		 * defined in Shop_The_Post_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Shop_The_Post_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/shop-the-post-public.js', array( 'jquery' ), $this->version, false );

		// Tracdelight Header Script
		if(get_theme_mod('shopthepost_tracdelight_code', '') != '') {
			$key = get_theme_mod('shopthepost_tracdelight_code');

			wp_enqueue_script( 'tracdelight-script', 'https://scripts.tracdelight.io/tracdelight.js?accesskey=' . $key );
		}

	}


	/**
	* Creates a shortcode to display the Shop The Post Widget
	*
	* @since 1.0.0
	*/
	public function shop_the_post_shortcode( $atts = '' ) {

		$attributes = shortcode_atts( array(
	        'id' => 0
	    ), $atts );

	    $post_ID = $attributes['id'];

		$shopstyle = get_post_meta($post_ID, '_shopstyle_code', true);
		$rewardstyle = get_post_meta($post_ID, '_rewardstyle_shortcode', true);
		$tracdelight = get_post_meta($post_ID, '_tracdelight_code', true);

		$shop_the_post_title = get_theme_mod('shopthepost_widget_title', 'Shop this Post');

		ob_start();

		echo '<div class="shop-the-post-widget">';

		if($shop_the_post_title != '') {
			echo '<h3>' . $shop_the_post_title . '</h3>';
		}

		echo '<div class="shop-the-post-container">';

		if($shopstyle) {
			echo $shopstyle;
		} else if($rewardstyle) {
			echo do_shortcode($rewardstyle);
		} else if($tracdelight) {
			echo $tracdelight;
		} else {
			echo __('There are no widgets defined for this post.', 'shop-the-post');
		}

		echo '</div></div>';


		$output = ob_get_contents();

		return $output;

		ob_end_clean();
	}



	/**
	 * Adds the Shop the Post widget to custom post excerpts on the homepage.
	 *
	 * @since 	1.0.0
	 */
	public function shop_the_post_excerpt( $output ) {
		global $post;

		$shopstyle = get_post_meta($post->ID, '_shopstyle_code', true);
		$rewardstyle = get_post_meta($post->ID, '_rewardstyle_shortcode', true);
		$tracdelight = get_post_meta($post->ID, '_tracdelight_code', true);
		$shop_the_post_title = get_theme_mod('shopthepost_widget_title', 'Shop this Post');

		$shortcode = '';

		$widget = '';


		if(is_front_page() && ($shopstyle || $rewardstyle || $tracdelight) && get_theme_mod('shopthepost_show_excerpt_checkbox', TRUE)) {

		  	ob_start();

			echo '<div class="shop-the-post-widget">';

			if($shop_the_post_title != '') {
				echo '<h3>' . $shop_the_post_title . '</h3>';
			}

			echo '<div class="shop-the-post-container">';

			if($shopstyle) {
				echo $shopstyle;
			} else if($rewardstyle) {
				echo do_shortcode($rewardstyle);
			} else if($tracdelight) {
				echo $tracdelight;
			} else {
				echo __('There are no widgets defined for this post.', 'shop-the-post');
			}

			echo '</div></div>';


			$widget = ob_get_contents();

			ob_end_clean();
		}

	  	return $output . $widget;

	}

}
