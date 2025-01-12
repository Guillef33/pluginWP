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

function mi_plugin_menu() {
    add_menu_page(
        'Mercado Libre Props', // Título del menú
        'ML', // Título corto
        'manage_options', // Capacidad necesaria
        'ml-admin', // Slug del menú
		'ml_render_settings_page', // Función de callback
        'dashicons-admin-generic', // Icono (usando un dashicon)
        6 // Posición en el menú
    );

    add_submenu_page(
        'Mi Cuenta en ML',            // Título del menú
        'manage_options',              // Capacidad para acceder
        'mi-cuenta-ml',               // Slug de la página
        'ml_account_page_content',    // Función que genera el contenido
        'dashicons-admin-users',      // Icono para el menú
        20                            // Orden en el menú
    );
}
add_action( 'admin_menu', 'mi_plugin_menu' );



// Inicializa el plugin.
add_action( 'plugins_loaded', [ 'Auth_Handler', 'init' ] );

?>