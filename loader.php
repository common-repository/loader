<?php
/**
 * Plugin Name: Loader
 * Plugin URI: https://wordpress.org/plugins/loader
 * Description: Loader is a lightweight plugin to show preloader and prefetch on mouse hover to load pages faster.
 * Version: 2.0.1
 * Author: BroadBrander
 * Author URI: https://broadbrander.com
 * Text Domain: loader
 * Domain Path: /languages
 *
 * @author BroadBrander
 * @package Loader
 */


// Exit if accessed directly
if(! defined('ABSPATH')) {
	exit;
}

define( 'LOADER_URI', plugin_dir_path( __FILE__ ) . '/' );

	// Load plugin textdomain
	load_plugin_textdomain( 'loader' );

 	
	/**
	* Disable Loader on amp pages
	*
	* @package Loader
	* @since 1.1.1
	*/

	function loader_disable()
	{
		echo "<style>#bbpreloading{display:none !important;}.bbpreloading{display:none;}</style>";
	}

	// Check if amp page
	if ( function_exists( 'is_amp_endpoint' ) ) {

		add_action('wp_head', 'loader_disable');

	}



	// Hook for quotes
	function loader_quote(){	
		do_action('loader_quote');
	}
	
	// Customizer options 
	require LOADER_URI . 'inc/customizer.php';

	// Plugin functions (preloader)
	require LOADER_URI . 'inc/preloader/functions.php';

	// Plugin styles (preloader)
	require LOADER_URI . 'inc/preloader/styles.php';



	/**
	* Admin Admin
	*
	* @package Loader
	* @since 2.0.0
	*/

	

	if ( is_admin() ) {


	/**
	* Settings link
	*
	* @package Loader
	* @since 1.2.1
	*/ 

	// settings
	function loader_setting_plugin( $links ) {
	    $rate_plugin = '<a href="'.admin_url( '/customize.php?autofocus[panel]=loader' ).'">' . __( 'Settings', 'loader' ) . '</a>';
		
		
	    array_push( $links, $rate_plugin );
	  	return $links;
	}
	$plugin = plugin_basename( __FILE__ );
	add_filter( "plugin_action_links_$plugin", 'loader_setting_plugin' );

	// rate
	function loader_rate_plugin( $links ) {
	    $rate_plugin = '<a href="https://wordpress.org/support/plugin/loader/reviews/#new-post" target="_blank">' . __( '<div class="loader-stars"><span class="loader dashicons dashicons-star-filled"></span>
<span class="loader dashicons dashicons-star-filled"></span>
<span class="loader dashicons dashicons-star-filled"></span>
<span class="loader dashicons dashicons-star-filled"></span>
<span class="loader dashicons dashicons-star-filled"></span></div>
	    	<style>
	    	.loader-stars {
			    display: inline-block;
			}
			span.loader.dashicons.dashicons-star-filled:before {
			    font-size: 15px !important;
			    display: inline-block;
			    padding: 0;
			    margin: 0;
			    color: #ffb900;
			    background: transparent !important;
			}
			span.loader.dashicons.dashicons-star-filled {
			    padding: 0;
			    margin: 0;
			    width: 15px;
			    height: 15px;
			    display: inline-block;
			    float: left;
			}
	    	</style>', 'loader' ) . '</a>';
		
		
	    array_push( $links, $rate_plugin );
	  	return $links;
	}
	$plugin = plugin_basename( __FILE__ );
	add_filter( "plugin_action_links_$plugin", 'loader_rate_plugin' );


	/**
	* Admin Widget
	*
	* @package Loader
	* @since 1.2.1
	*/

	function loader_dashboard_widgets() {
	global $wp_meta_boxes;
	 
	wp_add_dashboard_widget('loader_info_widget', 'Loader', 'loader_dashboard_info');
	}
	 
	function loader_dashboard_info() {
	echo '<center><span class="dashicons dashicons-heart" style="font-size:50px; color: red; padding: 20px; padding-bottom: 30px;"></span><h2>Thanks for using Loader!</h2>
	<p class="about-description">We hope you are enjoying this plugin.</p>';
	echo '<a class="button button-primary button-hero load-customize hide-if-no-customize"  href="https://wordpress.org/support/plugin/loader/reviews/#new-post" target="_blank">Write an honest review</a>
	<p class="hide-if-no-customize">
				Have a suggestion or question? <a href="https://wordpress.org/support/plugin/loader/" target="_blank">Ask it here.</a></p>
	</center>';
	}
	add_action('wp_dashboard_setup', 'loader_dashboard_widgets');




	/**
	* Admin Menu Link
	*
	* @package Loader
	* @since 2.0.0
	*/

	function loader_register_my_custom_menu_page() {
	    add_menu_page(
	        'loader',
	        __( 'Loader', 'loader' ),
	        'manage_options',
	        admin_url( '/customize.php?autofocus[panel]=loader' ),
	        '',
	        'dashicons-marker',
	        60
	    );
	}
	add_action( 'admin_menu', 'loader_register_my_custom_menu_page' );


}