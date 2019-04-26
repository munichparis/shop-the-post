<?php

/**
 * Add the metabox to the post editor.
 *
 * @link       https://munichparisstudio.com
 * @since      1.0.0
 *
 * @package    Shop_The_Post
 * @subpackage Shop_The_Post/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Shop_The_Post
 * @subpackage Shop_The_Post/admin
 * @author     MunichParis Studio <contact@munichparis.com>
 */
class Shop_The_Post_Admin_Metabox {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name ) {

		$this->plugin_name = $plugin_name;

	}


	/**
	 * Adds a metabox below the editor
	 */
	public function register_metabox() {
		add_meta_box(
			$this->plugin_name . '_widget_metabox',
			__('Shop the Post Widget', 'shop-the-post'),
			array( $this, 'display_metabox'),
			'post',
			'normal',
			'default'
		);
	}

	/**
	 * Output the HTML for the metabox.
	 */
	public function display_metabox( $post ) {
		// Nonce field to validate form request came from current site
		wp_nonce_field( basename( __FILE__ ), 'stp_fields' );

		// Widget (short)codes
		$shopstyle_code = get_post_meta($post->ID, '_shopstyle_code', true);
		$rewardstyle_shortcode = get_post_meta($post->ID, '_rewardstyle_shortcode', true);
		$tracdelight_code = get_post_meta($post->ID, '_tracdelight_code', true);
		$custom_shortcode = get_post_meta($post->ID, '_custom_shortcode', true);

		?>

		<div id="shop-tabs-navigation">
			<div class="nav-tab-wrapper current">
				<a class="nav-tab nav-tab-active" id="shopstyle-tab" href="#"><?php echo __('Shopstyle Collective', $this->plugin_name) ?></a>
				<a class="nav-tab" id="rewardstyle-tab" href="#"><?php echo __('Rewardstyle', $this->plugin_name) ?></a>
				<a class="nav-tab" id="tracdelight-tab" href="#"><?php echo __('Tracdelight', $this->plugin_name) ?></a>
			</div>
		</div>

		<?php 
		
		include_once( 'partials/shop-the-post-partial-shopstyle.php' );
		include_once( 'partials/shop-the-post-partial-rewardstyle.php' );
		include_once( 'partials/shop-the-post-partial-tracdelight.php' );
		?>

		<div class="shortcode">
			<h3><?php _e('Shop the Post Shortcode:', 'shop-the-post') ?>  <span style="margin-left: 0.75em; padding: 0.35em 0.5em; background-color: #eeeeee; font-weight: 600;">[shop_the_post_widget id="<?php echo $post->ID ?>"]</span></h3>
			<p><em><?php _e('Paste this shortcode where you want the content of this Shop the Post widget to appear (e.g. inside the article).', 'shop-the-post') ?></em></p>
		</div>

		<?php
	}



	/**
	 * Save Shop The Post Metabox
	 *
	 * @since  1.0.0
	 */
	function save_metabox( $post_id, $post ) {

		// Return if the user doesn't have edit permissions.
		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return $post_id;
		}

	    // Verify this came from the our screen and with proper authorization,
	    // because save_post can be triggered at other times.
		// if ( ! wp_verify_nonce( $_POST[$this->plugin_name . '_collection_metabox_field'], basename(__FILE__) ) ) {
		// 	return $post_id;
		// }

	    // Now that we're authenticated, time to save the data.
		$shopthepost_meta['_shopstyle_code'] = ( isset( $_POST['_shopstyle_code'] ) ? $_POST['_shopstyle_code'] : [] );
		$shopthepost_meta['_rewardstyle_shortcode'] = ( isset( $_POST['_rewardstyle_shortcode'] ) ? sanitize_text_field($_POST['_rewardstyle_shortcode']) : '' );
		$shopthepost_meta['_tracdelight_code'] = ( isset( $_POST['_tracdelight_code'] ) ? $_POST['_tracdelight_code'] : '' );
		$shopthepost_meta['_custom_shortcode'] = ( isset( $_POST['_custom_shortcode'] ) ? $_POST['_custom_shortcode'] : '' );


	    // Cycle through the $shopthepost_meta array
		foreach ( $shopthepost_meta as $key => $value ) :
	        // Don't store custom data twice
			if ( 'revision' === $post->post_type ) {
				return;
			}
			if ( get_post_meta( $post_id, $key, false ) ) {
	            // If the custom field already has a value, update it.
				update_post_meta( $post_id, $key, $value );
			} else {
	            // If the custom field doesn't have a value, add it.
				add_post_meta( $post_id, $key, $value);
			}
			if ( ! $value ) {
	            // Delete the meta key if there's no value
				delete_post_meta( $post_id, $key );
			}
		endforeach;

	}

}


