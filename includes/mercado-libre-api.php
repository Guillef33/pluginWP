<?php

class MercadoLibreAPI {
    // URL base de la API de Mercado Libre
    const API_URL = 'https://api.mercadolibre.com';

    public static function get_user_data($access_token) {
        $url = self::API_URL . '/users/me'; // Endpoint para obtener los datos del usuario

        // Iniciar la sesión cURL
        $ch = curl_init();

        // Configuración cURL para la solicitud GET
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Authorization: Bearer ' . $access_token, // Agregar el access token en los encabezados
            'Accept: application/json',
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

        // Decodificar la respuesta JSON
        $response_data = json_decode($response, true);

        // Verificar si la solicitud fue exitosa
        if (isset($response_data['id'])) {
            return $response_data; // Devuelve los datos del usuario
        } else {
            error_log('Error al obtener los datos del usuario: ' . print_r($response_data, true));
            return null;
        }
    }
}

$access_token = get_option('ml_access_token'); 

$user_data = MercadoLibreAPI::get_user_data($access_token);


if ($user_data) {
    echo 'Datos del usuario: ' . print_r($user_data, true);
} else {
    echo 'No se pudieron obtener los datos del usuario.';
}
?>
