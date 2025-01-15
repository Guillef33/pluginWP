<?php
// Generar un enlace de autenticación, a traves de un metodo public static
function ml_get_auth_link() {
    return Auth_Handler::get_auth_url();
}