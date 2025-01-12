<?php

class Auth_Handler {
    public static function init() {
        add_action( 'init', [ __CLASS__, 'handle_callback' ] );
    }

    public static function get_auth_url() {
        $app_id = get_option('ml_client_id');
        if (empty($app_id)) {
            error_log('Error: El client_id no está configurado en settings-page.php');
            return '';
        }
        $redirect_uri = urlencode( home_url( '' ) );

            // Codifica solo el parámetro redirect_uri
        $redirect_uri_encoded = urlencode( $redirect_uri );
        // $code_challenge = 'TU_CODE_CHALLENGE';
        // $code_method = 'S256';

        return "https://auth.mercadolibre.com.ar/authorization?response_type=code&client_id={$app_id}&redirect_uri={$redirect_uri_encoded}";
    }

    public static function handle_callback() {
        if ( isset( $_GET['code'] ) ) {
            $auth_code = sanitize_text_field( $_GET['code'] );

            // Aquí puedes intercambiar el código por un Access Token.
            error_log( "Código recibido: $auth_code" );

            // Redirige al usuario a una página personalizada de éxito.
            wp_redirect( home_url( '' ) );
            exit;
        }
    }
}


?>