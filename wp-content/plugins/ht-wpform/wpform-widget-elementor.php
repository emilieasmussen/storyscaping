<?php
/**
 * Plugin Name: Wpform Widget Elementor
 * Description: The Wpform Widget Elementor is a elementor addons for WordPress.
 * Plugin URI:  https://htplugins.com/
 * Author:      HT Plugins
 * Author URI:  https://profiles.wordpress.org/htplugins/#content-plugins
 * Version:     1.0.1
 * License:     GPL2
 * License URI:  https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: ht-wpform
 * Domain Path: /languages
*/

if( ! defined( 'ABSPATH' ) ) exit(); // Exit if accessed directly

if ( ! function_exists('is_plugin_active')) { include_once( ABSPATH . 'wp-admin/includes/plugin.php' ); }

define( 'HTWPFORM_VERSION', '1.0.1' );
define( 'HTWPFORM_PL_URL', plugins_url( '/', __FILE__ ) );
define( 'HTWPFORM_PL_PATH', plugin_dir_path( __FILE__ ) );

if( is_plugin_active('wpforms-lite/wpforms.php') || is_plugin_active('wpforms/wpforms.php') ){
    
    // Elementor Widgets File Call
    function htwpform_elementor_widgets(){
        include( HTWPFORM_PL_PATH.'include/elementor_widgets.php' );
    }
    add_action('elementor/widgets/widgets_registered','htwpform_elementor_widgets');

}

// Check Plugins is Installed or not
if( !function_exists( 'htwpform_is_plugins_active' ) ){
    function htwpform_is_plugins_active( $pl_file_path = NULL ){
        $installed_plugins_list = get_plugins();
        return isset( $installed_plugins_list[$pl_file_path] );
    }
}

// Load Plugins
function htwpform_load_plugin() {
    load_plugin_textdomain( 'ht-wpform' );
    if ( ! did_action( 'elementor/loaded' ) ) {
        add_action( 'admin_notices', 'htwpform_check_elementor_status' );
        return;
    }

    if( !is_plugin_active('wpforms-lite/wpforms.php') ){
        if( !is_plugin_active('wpforms/wpforms.php') ){
            add_action( 'admin_notices', 'htwpform_check_wpform_status' );
        }
        return;
    }

}
add_action( 'plugins_loaded', 'htwpform_load_plugin' );

// Check Elementor install or not.
function htwpform_check_elementor_status(){
    $elementor = 'elementor/elementor.php';
    if( htwpform_is_plugins_active( $elementor ) ) {
        if( ! current_user_can( 'activate_plugins' ) ) {
            return;
        }
        $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $elementor . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $elementor );

        $message = '<p>' . __( 'HT Wpform Addons not working because you need to activate the Elementor plugin.', 'ht-wpform' ) . '</p>';
        $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Elementor Now', 'ht-wpform' ) ) . '</p>';
    } else {
        if ( ! current_user_can( 'install_plugins' ) ) {
            return;
        }
        $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=elementor' ), 'install-plugin_elementor' );
        $message = '<p>' . __( 'HT Wpform Addons not working because you need to install the Elementor plugin', 'ht-wpform' ) . '</p>';
        $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Elementor Now', 'ht-wpform' ) ) . '</p>';
    }
    echo '<div class="error"><p>' . $message . '</p></div>';
}

// Check Elementor install or not.
function htwpform_check_wpform_status(){
    $wpforms = 'wpforms-lite/wpforms.php';
    if( htwpform_is_plugins_active( $wpforms ) ) {
        if( ! current_user_can( 'activate_plugins' ) ) {
            return;
        }
        $activation_url = wp_nonce_url( 'plugins.php?action=activate&amp;plugin=' . $wpforms . '&amp;plugin_status=all&amp;paged=1&amp;s', 'activate-plugin_' . $wpforms );

        $message = '<p>' . __( 'HT Wpform Addons not working because you need to activate the Wpforms plugin.', 'ht-wpform' ) . '</p>';
        $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $activation_url, __( 'Activate Wpforms Now', 'ht-wpform' ) ) . '</p>';
    } else {
        if ( ! current_user_can( 'install_plugins' ) ) {
            return;
        }
        $install_url = wp_nonce_url( self_admin_url( 'update.php?action=install-plugin&plugin=wpforms-lite' ), 'install-plugin_wpforms-lite' );
        $message = '<p>' . __( 'HT Wpform Addons not working because you need to install the Wpforms plugin', 'ht-wpform' ) . '</p>';
        $message .= '<p>' . sprintf( '<a href="%s" class="button-primary">%s</a>', $install_url, __( 'Install Wpforms Now', 'ht-wpform' ) ) . '</p>';
    }
    echo '<div class="error"><p>' . $message . '</p></div>';
}



?>