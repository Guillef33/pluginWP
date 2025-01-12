<?php
add_action( 'admin_menu', 'ml_add_settings_page' );
add_action( 'admin_init', 'ml_register_settings' );

function ml_add_settings_page() {
    add_menu_page(
        'Mercado Libre Auth',
        'Mercado Libre',
        'manage_options',
        'ml-auth',
        'ml_render_settings_page'
    );
}
function ml_register_settings() {
    register_setting('ml_settings_group', 'ml_client_id');
    register_setting('ml_settings_group', 'ml_client_secret');
}

function ml_render_settings_page() {
    ?>

    <div class="wrap">
        <h1>Ingresa tus credenciales</h1>
        <form method="post" action="options.php">
        <?php settings_fields('ml_settings_group'); ?>
        <?php do_settings_sections('ml_settings_group'); ?>
        <table class="form-table">
            <tr valign="top">
                <th scope="row">Client ID</th>
                <td><input type="text" name="ml_client_id" value="<?php echo esc_attr(get_option('ml_client_id')); ?>" class="regular-text" /></td>
            </tr>
            <tr valign="top">
                <th scope="row">Client Secret</th>
                <td><input type="password" name="ml_client_secret" value="<?php echo esc_attr(get_option('ml_client_secret')); ?>" class="regular-text" /></td>
            </tr>
        </table>
        <input type="submit" name="submit" id="submit" class="button button-primary" value="Guardar cambios">
    </form>
    </div>

   

    <div class="wrap">
        <h1>Conectar con Mercado Libre</h1>
        <p>Haz clic en el siguiente botón para autenticarte con Mercado Libre:</p>

        <?php 

        $auth_url = Auth_Handler::get_auth_url();
        if (!empty($auth_url)) {
            echo "URL de autenticación: <code>" . esc_url($auth_url) . "</code>";
        } else {
            echo "Error: No se pudo generar la URL de autenticación.";
        }
        ?>
           
        <a href="<?php echo esc_url( ml_get_auth_link() ); ?>" class="button button-primary">
            Conectar con Mercado Libre
        </a>
    </div>
    <?php

    
}
