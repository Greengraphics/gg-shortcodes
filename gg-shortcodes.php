<?php
    
/* Plugin Name: GG Shortcodes
 * Plugin URI: https://greengraphics.com.au
 * Description: A series of custom shortcodes.
 * Version: 20160520
 * Author: Nathan
 * Author URI: https://greengraphics.com.au
 * Text Domain: ggsc
 * Domain Path: /lang
 */
 
if( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

if( ! class_exists( 'ggsc' ) ) : 

class ggsc {
    
    
	/*
	*  __construct
	*
	*  A dummy constructor to ensure plugin is only initialized once
    *
	*/
	
	function __construct() {
		
		/* Do nothing here */
		
	} // function __construct
	
	
    /*
	*  initialize
	*
	*  The real constructor to initialize plugin
	*
	*/
		
	function initialize() {	 
        
        // vars
		$this->settings = array(
			
			// basic
			'name'				=> __('GG Shortcodes', 'ggsc'),
			'version'			=> '20160520',
						
			// urls
			'basename'			=> plugin_basename( __FILE__ ),
			'path'				=> plugin_dir_path( __FILE__ ),
			'dir'				=> plugin_dir_url( __FILE__ ),
			
			// options
			'show_admin'		=> true,
			'show_updates'		=> true,
			'stripslashes'		=> false,
			'local'				=> true,
			'json'				=> true,
			'save_json'			=> '',
			'load_json'			=> array(),
			'default_language'	=> '',
			'current_language'	=> '',
			'capability'		=> 'manage_options',
			'uploader'			=> 'wp',
			'autoload'			=> false,
			'l10n'				=> true,
			'l10n_textdomain'	=> ''
		);
        
        
        
		add_action('init',	array($this, 'init'), 5);
		add_action('init',	array($this, 'register_shortcodes'), 5);        
		add_action('wp_enqueue_scripts',	array($this, 'register_assets'), 5);
	
	} // function initialize
	
	
	/*
	*  init
	*
	*  This function will run after all plugins and theme functions have been included
	*
	*/
	
	function init() {
    
        /* Do stuff */
    
    } // function init
    
    
    /*
    *  register_shortcodes
    *
    *  This function will register all shortcodes.
    *
    */
    
    function register_shortcodes() {
        
        function col_shortcode( $atts, $content = null ) {
            $a = shortcode_atts( array(
                'class' => 'col'
            ), $atts );
            
        	return "<div class='" . $a['class'] . "'>" . $content . "</div>";
        }
        add_shortcode( 'col', 'col_shortcode' );        
        
    } // function register_shortcodes
    
    
	/*
	*  register_assets
	*
	*  This function will register scripts and styles
	*
	*/
	
	function register_assets() {
    	
		wp_register_style( 'ggsc-main', plugin_dir_url( __FILE__ ) . 'assets/css/ggsc-main.css', [], $version );
		
		wp_enqueue_style( 'ggsc-main' );	
	
	} // function register_assets
    
    
} // class ggsc


/*
*  ggsc
*
*  The main function responsible for returning the one true ggsc Instance to functions everywhere.
*  Use this function like you would a global variable, except without needing to declare the global.
*
*  Example: <?php $ggsc = ggsc(); ?>
*
*/

function ggsc() {

	global $ggsc;
	
	if( !isset($ggsc) ) {
	
		$ggsc = new ggsc();
		
		$ggsc->initialize();
		
	}
	
	return $ggsc;
	
}


// initialize
ggsc();


endif; // class exists check