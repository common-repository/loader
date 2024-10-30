<?php
/**
 * Customizer Options
 *
 * @package Loader
 * @since 1.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

function loader_customizer_register($wp_customize) {

global $wp_customize;

// Register loader style panel
$wp_customize->add_panel( 'loader',
   array(
      'title' => __('Loader Panel', 'loader'),
      'description' => __('Customize the preloader', 'loader'),
      'priority' => 0,
      'capability' => 'edit_theme_options',
   ));


// Preloader style section
$wp_customize->add_section( 'loader_style',
   array(
      'title' => __('Loader Style', 'loader'),
      'description' =>  __('Modify the preloader style.', 'loader'),
      'panel' => 'loader', 
      'priority' => 10,
      'capability' => 'edit_theme_options', 
      'theme_supports' => '', 
      'active_callback' => '', 
      'description_hidden' => true, 
   )
);


// Preloader quote section
$wp_customize->add_section( 'loader_quotes',
   array(
      'title' => __('Loader Quotes', 'loader'),
      'description' => __('Add quotes to display on preloader (one each line).', 'loader'),
      'panel' => 'loader', 
      'priority' => 10,
      'capability' => 'edit_theme_options', 
      'theme_supports' => '', 
      'active_callback' => '', 
      'description_hidden' => true, 
   )
);

// custom html css panel
$wp_customize->add_section( 'loader_customs',
   array(
      'title' => __('Custom Preloader', 'loader'),
      'description' => __('Create custom preloader with html and css.', 'loader'),
      'panel' => 'loader', 
      'priority' => 10,
      'capability' => 'edit_theme_options', 
      'theme_supports' => '', 
      'active_callback' => '', 
      'description_hidden' => true, 
   )
);

// custom html css panel
$wp_customize->add_section( 'loader_scroll',
   array(
      'title' => __('Smooth Scroll', 'loader'),
      'description' => __('Smooth scrolling effect on browser.', 'loader'),
      'panel' => 'loader', 
      'priority' => 10,
      'capability' => 'edit_theme_options', 
      'theme_supports' => '', 
      'active_callback' => '', 
      'description_hidden' => true, 
   )
);

// Settings panel
$wp_customize->add_section( 'loader_settings',
   array(
      'title' => __('Settings', 'loader'),
      'description' => __('Configure the plugin for better user experience.', 'loader'),
      'panel' => 'loader', 
      'priority' => 10,
      'capability' => 'edit_theme_options', 
      'theme_supports' => '', 
      'active_callback' => '', 
      'description_hidden' => true, 
   )
);



// Load theme customizer options
require LOADER_URI . 'inc/controls.php';





// Select Sanitizer
function loader_sanitize_select( $input, $setting ) {
        $input   = sanitize_key( $input );
            $choices = $setting->manager->get_control( $setting->id )->choices;
            return ( array_key_exists( $input, $choices ) ? $input : $setting->default );
    }
    
// Checkbox Sanitizer        
function loader_sanitize_checkbox( $checked ) {
            return ( ( isset( $checked ) && true === $checked ) ? true : false );
    }

function loader_sanitize_image_upload( $file, $setting ) {
            $formats = array(
                'jpg|jpeg|jpe' => 'image/jpeg',
                'gif'          => 'image/gif',
                'png'          => 'image/png',
                'svg'          => 'image/svg+xml'
            );
            $file_ext = wp_check_filetype( $file, $formats );
            return ( $file_ext['ext'] ? $file : $setting->default );
    }

}
add_action('customize_register', 'loader_customizer_register');