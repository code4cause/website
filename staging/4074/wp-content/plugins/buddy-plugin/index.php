<?php
/*
Plugin Name: Buddy Plugin
Plugin URI: http://themeforest.net/item/buddy-multipurpose-wordpress-buddypress-theme/3506362?ref=GhostPool
Description: A required plugin for the Buddy theme you purchased from ThemeForest. It includes a number of features that you can still use if you switch to another theme.
Version: 1.6
Author: GhostPool
Author URI: http://themeforest.net/user/GhostPool/portfolio?ref=GhostPool
License: You should have purchased a license from ThemeForest.net
Text Domain: buddy-plugin
*/

if ( ! class_exists( 'GhostPool_Buddy' ) ) {

	class GhostPool_Buddy {

		public function __construct() {
		
			// Load plugin translations
			add_action( 'plugins_loaded', array( &$this, 'ghostpool_plugin_load_textdomain' ) );
		
			if ( ! post_type_exists( 'slide' ) && ! class_exists( 'GhostPool_Slides' ) ) {
				require_once( sprintf( '%s/post-types/slide-tax.php', dirname( __FILE__ ) ) ) ;
				$GhostPool_Slides = new GhostPool_Slides();
			}
						
			if ( ! class_exists( 'CustomSidebars' ) ) {
				require_once( sprintf( '%s/custom-sidebars/custom-sidebars.php', dirname( __FILE__ ) ) ) ;
			}
							
		} 
		
		public static function ghostpool_activate() {} 		
		
		public static function ghostpool_deactivate() {}
		
		public function ghostpool_plugin_load_textdomain() {
			load_plugin_textdomain( 'buddy', false, trailingslashit( WP_LANG_DIR ) . 'plugins/' );
			load_plugin_textdomain( 'buddy', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}
				
	}
	
}

// Active/deactivate plugin
if ( class_exists( 'GhostPool_Buddy' ) ) {

	register_activation_hook( __FILE__, array( 'GhostPool_Buddy', 'ghostpool_activate' ) );
	register_deactivation_hook( __FILE__, array( 'GhostPool_Buddy', 'ghostpool_deactivate' ) );

	$ghostpool_buddy = new GhostPool_Buddy();

}

?>