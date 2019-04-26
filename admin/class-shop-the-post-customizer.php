<?php

/**
 * Add the customizer functionality.
 *
 * @link       https://munichparisstudio.com
 * @since      1.0.0
 *
 * @package    Shop_The_Post
 * @subpackage Shop_The_Post/admin
 */

/**
 * The customizer functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Shop_The_Post
 * @subpackage Shop_The_Post/admin
 * @author     MunichParis Studio <contact@munichparis.com>
 */
class Shop_The_Post_Customizer {

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
	 * Adds a 'Shop the Post' section
	 */
	public function register_customizer_section( $wp_customize ) {
		$wp_customize->add_section( 'shopthepost_options_section', array(
	        'priority'       => 15,
	        'capability'     => 'edit_theme_options',
	        'title'          => __('Shop The Post', 'shop-the-post'),
	    ) );
	}


	/**
	 * Add the customizer settings and controls
	 */
	public function register_customizer_settings( $wp_customize ) {

		//* Add Customizer Setting: Shop the Post Widget Title
		$wp_customize->add_setting( 'shopthepost_widget_title' , array(
		    'default'     => 'Shop this Post',
		    'transport'   => 'refresh',
		    'sanitize_callback' => 'sanitize_text_field'
		) );

	   //* Add Customizer Control: Shop the Post Widget Title
	   $wp_customize->add_control( 'shopthepost_widget_title',
			array(
				'settings'		=> 'shopthepost_widget_title',
				'section'		=> 'shopthepost_options_section',
				'type'			=> 'text',
				'label'			=> __( 'Shop The Post Widget Title', 'shop-the-post' ),
				'description'	=> __( 'Set the headline for the Shop the Post widgets.', 'shop-the-post' )
			)
		);

	   // Show/Hide Shop The Post Widget in the homepage excerpt Checkbox
		$wp_customize->add_setting( 'shopthepost_show_excerpt_checkbox' , array(
		    'default'     => TRUE,
		    'transport'   => 'refresh',
		    'sanitize_callback'	=> array($this, 'sanitize_checkbox')
		) );
	   	$wp_customize->add_control( 'shopthepost_show_excerpt_checkbox',
			array(
				'settings'		=> 'shopthepost_show_excerpt_checkbox',
				'section'		=> 'shopthepost_options_section',
				'type'			=> 'checkbox',
				'label'			=> __( 'Show Shop the Post Widgets on the Homepage (after each post excerpt)', 'shop-the-post' ),
			)
		);

	   //* Add Customizer Setting: Tracdelight Heeader Script
		$wp_customize->add_setting( 'shopthepost_tracdelight_code' , array(
		    'transport'   => 'refresh',
		    'sanitize_callback' => array($this, 'sanitize_tracdelight_script')
		) );

	   //* Add Customizer Control: Tracdelight Heeader Script
	   $wp_customize->add_control( 'shopthepost_tracdelight_code',
			array(
				'settings'		=> 'shopthepost_tracdelight_code',
				'section'		=> 'shopthepost_options_section',
				'type'			=> 'textarea',
				'label'			=> __( 'Tracdelight Header Script', 'shop-the-post' ),
				'description'	=> __( 'Add the Tracdelight script code here to add it before the closing <head> tag on your blog. (Note: This field will automatically extract your individual access key for optimal performance.)', 'shop-the-post' )
			)
		);

	}



	// Helper function: Sanitize Tracdelight header script
	public function sanitize_tracdelight_script( $code, $setting ) {

		$key = $this->get_string_between($code, 'tracdelight.js?accesskey=', '" async="async"');
	  
	  	// If a key is found, return the code
	  	return ( ($key != '') ? $key : '' );
	}

	// Helper function: Return string between two substrings
	public function get_string_between($string, $start, $end){
	    $string = ' ' . $string;
	    $ini = strpos($string, $start);
	    if ($ini == 0) return '';
	    $ini += strlen($start);
	    $len = strpos($string, $end, $ini) - $ini;
	    return substr($string, $ini, $len);
	}

	// Helper function: Sanitize checkboxes
	public function sanitize_checkbox( $checked ) {
	  // Boolean check.
	  return ( ( isset( $checked ) && true == $checked ) ? true : false );
	}

}


