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
    <div class="wrap">
        <h1>Conectar con Mercado Libre</h1>
        <p>Haz clic en el siguiente botón para autenticarte con Mercado Libre:</p>
        <a href="<?php echo esc_url( ml_get_auth_link() ); ?>" class="button button-primary">
            Conectar con Mercado Libre
        </a>
    </div>
    <?php
}
