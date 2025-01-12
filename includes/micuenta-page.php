<?php
add_action( 'admin_menu', 'ml_add_account_page' );
// add_action( 'admin_init', 'ml_account_page_content' );

function ml_add_account_page() {
    add_menu_page(
        'Mi Cuenta en Mercado Libre', // Título de la página
        'Mi Cuenta en ML',            // Título del menú
        'manage_options',              // Capacidad para acceder
        'mi-cuenta-ml',               // Slug de la página
        'ml_account_page_content',    // Función que genera el contenido
        'dashicons-admin-users',      // Icono para el menú
        20                            // Orden en el menú
    );
}


function ml_account_page_content() {
    // Este es el contenido de la página donde se mostrará la información de Mercado Libre
    ?>
    <div class="wrap">
        <h1>Mi Cuenta en Mercado Libre</h1>
        <p>Aquí podrás ver los detalles de tu cuenta de Mercado Libre:</p>

        <?php
        // // Aquí llamamos a la función que obtiene los datos de la API de Mercado Libre
        // $access_token = get_option('ml_access_token'); // Supongamos que tienes el access_token guardado en la base de datos

        // if ($access_token) {
        //     $user_data = MercadoLibreAPI::get_user_data($access_token);

        //     if ($user_data) {
        //         echo '<pre>' . print_r($user_data, true) . '</pre>';
        //     } else {
        //         echo '<p>No se pudieron obtener los datos del usuario.</p>';
        //     }
        // } else {
        //     echo '<p>No tienes un access token válido. Por favor, autentícate primero.</p>';
        // }
        ?>

    </div>
    <?php
}
