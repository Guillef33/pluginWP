<?php
/**
 * Plugin Name:       Tus propiedades en Mercado Libre
 * Plugin URI:        https://magnetitte.com/mercado-libre-wordpress/
 * Description:       Plugin para la publicacion de propiedades en Mercado Libre
 * Version:           0.1
 * Requires PHP:      7.2
 * Author:            Guillermo Flores
 * Author URI:        https://magnetitte.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

 // Evitar acceso directo al archivo
if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

 // Hook para ejecutar cuando un post es publicado
add_action( 'publish_post', 'send_notification', 10, 2 );

/**
 * Función que almacena la notificación al publicar un post
 *
 * @param int $id ID del post publicado.
 * @param WP_Post $post_obj Objeto del post publicado.
 */
function send_notification( $id, $post_obj ) {
    // Armar el mensaje
    $msg = 'Se ha publicado un nuevo post: ';
    $msg .= '<strong>' . esc_html( $post_obj->post_title ) . '</strong><br>';
    $msg .= '<p>' . esc_html( wp_trim_words( $post_obj->post_content, 20, '...' ) ) . '</p>'; // Muestra solo un resumen.

    // Guardar el mensaje en las opciones de WordPress
    update_option( 'mi_plugin_notificacion', $msg );
}

/**
 * Mostrar la notificación en la home
 */
function display_notification_on_home() {
    // Verificar si estamos en la home
    if ( is_front_page() ) {
        // Obtener el mensaje almacenado
        $msg = get_option( 'mi_plugin_notificacion' );

        // Mostrar el mensaje si existe
        if ( $msg ) {
            echo '<div style="background-color: #f9f9f9; border: 1px solid #ccc; padding: 10px; margin: 20px 0;">';
            echo '<h3>Notificación:</h3>';
            echo wp_kses_post( $msg );
            echo '</div>';
        }
    }
}
add_action( 'wp_footer', 'display_notification_on_home' );

add_shortcode( "video", function($atts, $content){
	$id = $atts['id'];
	return '
    <div class="responsiveContent">
        <iframe width="560" height="315" src="https://www.youtube.com/embed/'.$id.'?rel=0" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen>
        </iframe>
    </div>';
});
?>