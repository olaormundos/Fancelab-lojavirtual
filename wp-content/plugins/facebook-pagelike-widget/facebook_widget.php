<?php
/**
 * @package Widget for Social Page Feeds
 * @version 6.1
 */
/*
Plugin Name: Widget for Social Page Feeds
Plugin URI: https://patelmilap.wordpress.com/
Description: This widget adds a Simple Facebook Page Like Widget into your WordPress website sidebar within few minutes.
Author: Milap Patel
Version: 6.1
Author URI: https://patelmilap.wordpress.com/
Text Domain: facebook-pagelike-widget
*/
if( !class_exists( 'Facebook_Pagelike_widget' ) ) {

    class Facebook_Pagelike_widget {

        public function __construct() {

            if( !defined( 'FB_WIDGET_PLUGIN_URL' ) )
                define( 'FB_WIDGET_PLUGIN_URL' , plugin_dir_url( __FILE__ ) );

            if( !defined( 'FB_WIDGET_PLUGIN_BASE_URL' ) )
                define( 'FB_WIDGET_PLUGIN_BASE_URL' , dirname( __FILE__ ) );
            
            $this->includes();
            
            register_activation_hook( __FILE__ , array( $this, 'fb_widget_activate' ) );
            register_deactivation_hook( __FILE__ , array( $this, 'fb_widget_deactivate' ) );

            add_action( 'plugins_loaded', array( $this, 'LoadFbtextDomain' ) );
            add_action( 'activated_plugin', array( $this, 'fb_widget_redirect' ) );

        }
        
        public function fb_widget_activate() {}
        
        public function fb_widget_deactivate() {}
        
        public function fb_widget_redirect( $plugin ) {

            if( $plugin == plugin_basename( __FILE__ ) ) {
                exit( wp_redirect( admin_url( 'widgets.php' ) ) );
            }
            
        }

        public function LoadFbtextDomain() {

            load_plugin_textdomain( 'facebook-pagelike-widget',false, basename( dirname( __FILE__ ) ) );

        }

        public function includes() {

            require FB_WIDGET_PLUGIN_BASE_URL . '/fb_class.php';
            require FB_WIDGET_PLUGIN_BASE_URL . '/short_code.php';
            include FB_WIDGET_PLUGIN_BASE_URL . '/includes/add-review.php';

        }

    }
}
new Facebook_Pagelike_widget();
?>