<?php
add_action( 'admin_menu', 'ml_add_settings_page' );

function ml_add_settings_page() {
    add_menu_page(
        'Mercado Libre Auth',
        'Mercado Libre',
        'manage_options',
        'ml-auth',
        'ml_render_settings_page'
    );
}

function ml_render_settings_page() {
    ?>

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

    <div class="wrap">
        <h1>Conectar con Mercado Libre</h1>
        <p>Haz clic en el siguiente botón para autenticarte con Mercado Libre:</p>
        <a href="<?php echo esc_url( ml_get_auth_link() ); ?>" class="button button-primary">
            Conectar con Mercado Libre
        </a>
    </div>
    <?php

    
}
