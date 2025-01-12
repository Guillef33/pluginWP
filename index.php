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

<<<<<<< HEAD
=======
// function mi_plugin_menu() {
//     add_menu_page(
//         'Mercado Libre Props', // Título del menú
//         'ML', // Título corto
//         'manage_options', // Capacidad necesaria
//         'ml-admin', // Slug del menú
// 		'ml_render_settings_page', // Función de callback
//         'dashicons-admin-generic', // Icono (usando un dashicon)
//         6 // Posición en el menú
//     );

//     add_submenu_page(
//         'Mi Cuenta en ML',            // Título del menú
//         'manage_options',              // Capacidad para acceder
//         'mi-cuenta-ml',               // Slug de la página
//         'ml_account_page_content',    // Función que genera el contenido
//         'dashicons-admin-users',      // Icono para el menú
//         20                            // Orden en el menú
//     );
// }
// add_action( 'admin_menu', 'mi_plugin_menu' );
>>>>>>> c75103dd4cff7b01a36152eda05b003c80961e18

// Inicializa el plugin.
add_action( 'plugins_loaded', [ 'Auth_Handler', 'init' ] );

<<<<<<< HEAD
=======
// function ml_account_page_content() {
//     // Este es el contenido de la página donde se mostrará la información de Mercado Libre
//     ?>
//     <div class="wrap">
//         <h1>Mi Cuenta en Mercado Libre</h1>
//         <p>Aquí podrás ver los detalles de tu cuenta de Mercado Libre:</p>

//         <?php
//         // // Aquí llamamos a la función que obtiene los datos de la API de Mercado Libre
//         // $access_token = get_option('ml_access_token'); // Supongamos que tienes el access_token guardado en la base de datos

//         // if ($access_token) {
//         //     $user_data = MercadoLibreAPI::get_user_data($access_token);

//         //     if ($user_data) {
//         //         echo '<pre>' . print_r($user_data, true) . '</pre>';
//         //     } else {
//         //         echo '<p>No se pudieron obtener los datos del usuario.</p>';
//         //     }
//         // } else {
//         //     echo '<p>No tienes un access token válido. Por favor, autentícate primero.</p>';
//         // }
//         ?>

//     </div>
//     <?php
// }

// function ml_render_settings_page() {
//     ?>

//     <div class="wrap">
//         <h1>Ingresa tus credenciales</h1>
//         <form method="post" action="options.php">
//         <?php settings_fields('ml_settings_group'); ?>
//         <?php do_settings_sections('ml_settings_group'); ?>
//         <table class="form-table">
//             <tr valign="top">
//                 <th scope="row">Client ID</th>
//                 <td><input type="text" name="ml_client_id" value="<?php echo esc_attr(get_option('ml_client_id')); ?>" class="regular-text" /></td>
//             </tr>
//             <tr valign="top">
//                 <th scope="row">Client Secret</th>
//                 <td><input type="password" name="ml_client_secret" value="<?php echo esc_attr(get_option('ml_client_secret')); ?>" class="regular-text" /></td>
//             </tr>
//         </table>
//         <input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios">
//     </form>
//     </div>

   

//     <div class="wrap">
//         <h1>Conectar con Mercado Libre</h1>
//         <p>Haz clic en el siguiente botón para autenticarte con Mercado Libre:</p>
//         <a href="<?php echo esc_url( ml_get_auth_link() ); ?>" class="button button-primary">
//             Conectar con Mercado Libre
//         </a>

//         <?php 

//         $auth_url = Auth_Handler::get_auth_url();
//         if (!empty($auth_url)) {
//             echo "<p><strong>URL de autenticación:</strong> <a href='" . esc_url($auth_url) . "' target='_blank' style='color: #0073aa; text-decoration: underline;'>" . esc_html($auth_url) . "</a></p>";
//         } else {
//             echo "<p style='color: red;'>Error: No se pudo generar la URL de autenticación.</p>";
//         }
//         ?>

//     <div>
//         <a href="<?php echo esc_url( admin_url( 'admin.php?page=ml-admin' ) ); ?>" class="button button-primary">
//             Ver mi cuenta
//         </a>
//     </div>
            
      
//     </div>
//     <?php

    
// }

>>>>>>> c75103dd4cff7b01a36152eda05b003c80961e18

?>