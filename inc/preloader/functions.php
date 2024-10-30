<?php
/**
 * Main functions (preloader)
 *
 * @package Loader
 * @since 1.0.0
 */

// No direct access, please.
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}


/**
 * Load script
 *
 * @package Loader
 * @since 1.0.0
 */


function loader_preload_script() {
    wp_enqueue_script( 'hover_loader_script', plugin_dir_url( __FILE__ ) . 'assets/js/hover-loader.min.js', array(), '2.0.0', true );
}
if ( get_theme_mod('enable_preload' , true) == true ) {
   add_action('wp_enqueue_scripts', 'loader_preload_script');
}
	

/**
 * Preloader Script
 *
 * @version	1.2.2
 * @since 1.0.0
 * @package	Loader
 */
function loader_script() {
 echo'
 <script>
window.onload = function loaderPreloader() {
  document.getElementById("bbpreloading").className = "bbpreloading hidepreloader";
};
</script>';
}



	

/**
 * Preloader Only Home Script
 *
 * @version	1.2.2
 * @since 1.2.2
 * @package	Loader
 */
function loader_only_home_style() {
 echo'
 <style>
 body:not(.home) #bbpreloading{
 	display: none !important;
 	opacity: 0 !important;
 	visibility: hidden !important;
 	transition: 0 !important;
 }
</style>';
}



/**
 * Preloader Html
 *
 * @version	1.2.2
 * @since 1.0.0
 * @package	Loader
 */

function loader_html() {
	 echo'<!-- Loader Preloader -->';
	 echo'<div id="bbpreloading" class="bbpreloading">';
	 echo'<div class="spinner"></div>';
	 echo'<div class="random-quote">';
	 loader_quote();
	 echo'</div>';
	 echo'</div>'
;}

function loader_3_html() {
	 echo'<!-- Loader Preloader -->';
	 echo'<div id="bbpreloading" class="bbpreloading">';
	 echo'<div class="loader-loader"><div></div><div></div></div>';
	 echo'<div class="random-quote">';
	 loader_quote();
	 echo'</div>';
	 echo'</div>'
;}

function loader_4_html() {
	 echo'<!-- Loader Preloader -->';
	 echo'<div id="bbpreloading" class="bbpreloading">';
	 echo'<div class="loader-loader"><div></div><div></div><div></div><div></div></div>';
	 echo'<div class="random-quote">';
	 loader_quote();
	 echo'</div>';
	 echo'</div>'
;}

function loader_6_html() {
	 echo'<!-- Loader Preloader -->';
	 echo'<div id="bbpreloading" class="bbpreloading">';
	 echo'	<div class="spinner">
			  <div class="bounce-1"></div>
			  <div class="bounce-2"></div>
			</div>';
	 echo'<div class="random-quote">';
	 loader_quote();
	 echo'</div>';
	 echo'</div>'
;}



function loader_image_html() {
	 echo'<!-- Loader Preloader -->';
	 echo'<div id="bbpreloading" class="bbpreloading">';
	 ?>
	 <div class="loader-image"><img class="loader-img-ani" src="<?php echo esc_url( get_theme_mod( 'loader_image' ) ); ?>" alt="Loading..."></div>
	 <?php
	 echo'<div class="random-quote">';
	 loader_quote();
	 echo'</div>';
	 echo'</div>'
;}

function loader_custom_html()
{
	 echo'<div id="bbpreloading" class="bbpreloading">';
	 echo get_theme_mod('loader_custom_html');
	 echo'<div class="random-quote">';
	 loader_quote();
	 echo'</div>';
	 echo'</div>';
}


/**
 * Preloader Quotes
 *
 * @version	1.2.2
 * @since 1.0.0
 * @package	Loader
 */

function loader_quotes() {

	$quotes = get_theme_mod('loader_all_quotes' , 'I am Loader!');

	// Split lines
	$quotes = explode( "\n", $quotes );

	// Randomly choose a line
	return wptexturize( $quotes[ mt_rand( 0, count( $quotes ) - 1 ) ] );
}

// Show the line on preloader
function loader_print_one_quote() {
	$chosen = loader_quotes();

	echo $chosen;
}


// Add script to footer
if ( get_theme_mod('only_home' , false) == true && get_theme_mod('enable_preloader', true ) == true ) {
	add_action('wp_head', 'loader_only_home_style');
	add_action('wp_footer', 'loader_script');
} else{
	add_action('wp_footer', 'loader_script');
}



// Call the quote on preloader if enabled.
if ( get_theme_mod('enable_quotes' , true) == true  && get_theme_mod('enable_preloader', true ) == true ) {
	add_action( 'loader_quote', 'loader_print_one_quote' );
}



/**
 * Add html detecting user choice
 *
 * @version	1.2.2
 * @since 1.0.0
 * @package	Loader
 */

if ( get_theme_mod('loader_style_select' , '1') == '1' && get_theme_mod('enable_preloader', true ) == true ) {

	add_action('wp_head', 'loader_html');

}


if ( get_theme_mod('loader_style_select') == 2 && get_theme_mod('enable_preloader', true ) == true ) {

	add_action('wp_head', 'loader_html');

}


if ( get_theme_mod('loader_style_select') == 3 && get_theme_mod('enable_preloader', true ) == true ) {

	add_action('wp_head', 'loader_3_html');

}


if ( get_theme_mod('loader_style_select') == 4 && get_theme_mod('enable_preloader', true ) == true ) {

	add_action('wp_head', 'loader_4_html');

}


if ( get_theme_mod('loader_style_select') == 5 && get_theme_mod('enable_preloader', true ) == true ) {

	add_action('wp_head', 'loader_html');

}

if ( get_theme_mod('loader_style_select') == 6 && get_theme_mod('enable_preloader', true ) == true ) {

	add_action('wp_head', 'loader_6_html');

}


if ( get_theme_mod('loader_style_select') == 'image' && get_theme_mod('enable_preloader', true ) == true ) {

	add_action('wp_head', 'loader_image_html');

}

if ( get_theme_mod('loader_style_select') == 'custom' && get_theme_mod('enable_preloader', true ) == true ) {

	add_action('wp_head', 'loader_custom_html');

}


/**
 * Smooth Browser Scrolling
 *
 * @since 1.4
 * 
 */

// inline js
function loader_smooth_scroll()
{
	echo "
<script>
var loaderScrolling = {

    // Scrolling Core
    frameRate        : ".get_theme_mod( 'loader_scroll_frame', '150' ).", // [Hz]
    animationTime    : ".get_theme_mod( 'loader_scroll_dur', '400' ).", // [ms]
    stepSize         : ".get_theme_mod( 'loader_scroll_step', '100' ).", // [px]

    // Pulse (less tweakable)
    // ratio of 'tail' to 'acceleration'
    pulseAlgorithm   : true,
    pulseScale       : 4,
    pulseNormalize   : 1,

    // Acceleration
    accelerationDelta : 50,  // 50
    accelerationMax   : 3,   // 3

    // Keyboard Settings
    keyboardSupport   : ".get_theme_mod( 'enable_kb_scroll', true ).",  // option
    arrowScroll       : ".get_theme_mod( 'loader_scroll_step_kb', '50' ).",    // [px]

    // Other
    fixedBackground   : true, 
    excluded          : ''    
};
</script>
	";
}



// Setting up smooth scroll
function loader_smooth_scroll_script()
{
	wp_enqueue_script( 'loader-smooth-scroll', plugin_dir_url( __FILE__ ) . 'assets/js/loader-scroll.min.js', array(), '2.0.0', true );
}

if ( get_theme_mod( 'smooth_scroll', false ) == true ) {
	add_action( 'wp_enqueue_scripts', 'loader_smooth_scroll_script' );
	add_action( 'wp_footer', 'loader_smooth_scroll');
}

// Setting up smooth scroll admin panel

function loader_admin_scripts() {
	wp_enqueue_script( 'loader-smooth-scroll', plugin_dir_url( __FILE__ ) . 'assets/js/loader-scroll.min.js', array(), '2.0.1', true );
}



if ( get_theme_mod( 'enable_kb_scroll_admin', false ) == true ) {
add_action( 'admin_enqueue_scripts', 'loader_admin_scripts' );
add_action( 'customize_controls_print_scripts', 'loader_admin_scripts', 10 );
add_action( 'admin_footer', 'loader_smooth_scroll');
}