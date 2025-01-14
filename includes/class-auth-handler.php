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
        $redirect_uri = 'https://mediumturquoise-partridge-902524.hostingersite.com' ;

        return "https://auth.mercadolibre.com.ar/authorization?response_type=code&client_id={$app_id}&redirect_uri={$redirect_uri}";
    }

    public static function handle_callback() {
        if ( isset( $_GET['code'] ) ) {
            $auth_code = sanitize_text_field( $_GET['code'] );

            // Aquí puedes intercambiar el código por un Access Token.
            error_log( "Código recibido: $auth_code" );

            $access_token = self::get_access_token($auth_code);

            // Si obtenemos el token correctamente, puedes almacenarlo o hacer algo con él
            if ($access_token) {
                error_log("Access Token recibido: $access_token");
                return $access_token;
            } else {
                error_log("Error al obtener el Access Token.");
            }

            exit;
        }
    }

      // Función para intercambiar el código de autorización por un Access Token
      public static function get_access_token($authorization_code) {
        // Obtén tu Client ID y Client Secret desde las opciones de configuración o de alguna otra forma
        $client_id = get_option('ml_client_id');
        $client_secret = get_option('ml_client_secret');
        $redirect_uri = home_url(''); // Asegúrate de que esta URL sea la misma que configuraste

        // // Asegúrate de tener un código de verificación PKCE (si es necesario)
        // $code_verifier = 'TU_CODE_VERIFIER'; // Este es el código de verificación generado previamente

        // URL de la API de Mercado Libre para obtener el token
        $url = 'https://api.mercadolibre.com/oauth/token';

        // Datos del cuerpo de la solicitud POST
        $data = array(
            'grant_type' => 'authorization_code',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'code' => $authorization_code,
            'redirect_uri' => $redirect_uri,
            // 'code_verifier' => $code_verifier
        );

        // Iniciar una sesión cURL
        $ch = curl_init();

        // Configuración cURL para la solicitud POST
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ));

        // Ejecutar la solicitud cURL y obtener la respuesta
        $response = curl_exec($ch);

        // Verificar si hubo un error con la solicitud cURL
        if (curl_errno($ch)) {
            error_log('Error en la solicitud cURL: ' . curl_error($ch));
            curl_close($ch);
            return null;
        }

        // Cerrar la sesión de cURL
        curl_close($ch);

        // Decodificar la respuesta JSON de Mercado Libre
        $response_data = json_decode($response, true);

        // Verificar si se recibió un access token
        if (isset($response_data['access_token'])) {
            return $response_data['access_token'];
        } else {
            error_log('Error al obtener el Access Token: ' . print_r($response_data, true));
            return null;
        }
    }
}


?>