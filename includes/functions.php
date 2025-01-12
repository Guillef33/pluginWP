<?php
// Generar un enlace de autenticación.
function ml_get_auth_link() {
    return Auth_Handler::get_auth_url();
}