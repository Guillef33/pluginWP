<?php

class Auth_Handler {

    public static function init() {
        add_action('init', array(__CLASS__, 'handle_callback'));
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

    public static function get_access_token($authorization_code) {
        // Obtén tu Client ID y Client Secret desde las opciones de configuración 
        $client_id = get_option('ml_client_id');
        $client_secret = get_option('ml_client_secret');
        $redirect_uri = home_url(''); // URL de redirección

        $url = 'https://api.mercadolibre.com/oauth/token';

        $data = array(
            'grant_type' => 'authorization_code',
            'client_id' => $client_id,
            'client_secret' => $client_secret,
            'code' => $authorization_code,
            'redirect_uri' => $redirect_uri,
            // 'code_verifier' => $code_verifier
        );

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Accept: application/json',
            'Content-Type: application/x-www-form-urlencoded'
        ));

        $response = curl_exec($ch);

        if (curl_errno($ch)) {
            error_log('Error en la solicitud cURL: ' . curl_error($ch));
            curl_close($ch);
            return null;
        }

        curl_close($ch);

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