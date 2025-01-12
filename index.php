<?php

// Include WordPress core files.
if ( ! function_exists( 'add_action' ) ) {
	require_once( ABSPATH . 'wp-load.php' );
}

/**
 * Plugin Name:       Tus propiedades en Mercado Libre
 * Plugin URI:        https://magnetitte.com/mercado-libre-wordpress/
 * Description:       Plugin para la publicacion de propiedades en Mercado Libre
 * Version:           0.0.1
 * Requires PHP:      7.2
 * Author:            Guillermo Flores
 * Author URI:        https://magnetitte.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

// Define constantes.
define( 'ML_AUTH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ML_AUTH_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Carga archivos necesarios.
require_once ML_AUTH_PLUGIN_DIR . 'includes/class-auth-handler.php';
require_once ML_AUTH_PLUGIN_DIR . 'includes/functions.php';
require_once ML_AUTH_PLUGIN_DIR . 'includes/settings-page.php';
require_once ML_AUTH_PLUGIN_DIR . 'includes/micuenta-page.php';


// Inicializa el plugin.
add_action( 'plugins_loaded', [ 'Auth_Handler', 'init' ] );

?>