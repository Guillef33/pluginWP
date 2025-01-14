<?php



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

 // Include WordPress core files.
if ( ! function_exists( 'add_action' ) ) {
	require_once( ABSPATH . 'wp-load.php' );
}

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


// Hooks de activación y desactivación
register_activation_hook(__FILE__, 'ml_wp_register_activate');
register_deactivation_hook(__FILE__, 'ml_wp_disable_plugin');

function new_plugin_register_activate()
{
	update_option('_ml_wp_execute_activate', 1);
}

function new_plugin_disable_plugin()
{
	$GLOBALS['ml_wp']->disablePlugin();
}

function custom_plugin_menu() {
    add_menu_page(
        'ML Sync', 
        'ML Sync', 
        'manage_options', 
        'settings_page', 
        'settings_page', 
        'dashicons-admin-plugins', 
        6 
    );

    add_submenu_page(
        'settings_page', 
        'My Account', 
        'My Account', 
        'manage_options', 
        'my_account', 
        'my_account_page' 
    );
}
add_action('admin_menu', 'custom_plugin_menu');



// Caso 1 desde 0
// add_action( 'publish_post', 'send_notification', 10, 2 );

// Caso 2 desde sync 

// add_action( 'sync_post', 'send_notification', 10, 2 );

// function send_notification( $id, $post_obj ) {
//     // Armar el mensaje
//     $msg = 'Se ha publicado un nuevo post: ';
//     $msg .= '<strong>' . esc_html( $post_obj->post_title ) . '</strong><br>';
//     $msg .= '<p>' . esc_html( wp_trim_words( $post_obj->post_content, 20, '...' ) ) . '</p>'; 
//     $msg .= '<p>' . esc_html( wp_trim_words( $post_obj->post_author, 20, '...' ) ) . '</p>'; 
//     $msg .= '<p>' . esc_html( wp_trim_words( $post_obj->post_date, 20, '...' ) ) . '</p>'; 
//     $msg .= '<p>' . esc_html( wp_trim_words( $post_obj->post_status, 20, '...' ) ) . '</p>'; 


//     // Guardar el mensaje en las opciones de WordPress
//     update_option( 'mi_plugin_notificacion', $msg );
// }

// /**
//  * Mostrar la notificación en la home
//  */
// function display_notification_on_home() {
//     // Verificar si estamos en la home
//     if ( is_front_page() ) {
//         // Obtener el mensaje almacenado
//         $msg = get_option( 'mi_plugin_notificacion' );

//         // Mostrar el mensaje si existe
//         if ( $msg ) {
//             echo '<div style="background-color: #f9f9f9; border: 1px solid #ccc; padding: 10px; margin: 20px 0;">';
//             echo '<h3>Notificación:</h3>';
//             echo wp_kses_post( $msg );
//             echo '</div>';
//         }
//     }
// }
// add_action( 'wp_footer', 'display_notification_on_home' );





?>