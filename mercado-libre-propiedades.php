<?php
/**
 * Plugin Name:       Tus propiedades en Mercado Libre
 * Plugin URI:        https://magnetitte.com/mercado-libre-wordpress/
 * Description:       Plugin para la publicacion de propiedades en Mercado Libre
 * Version:           0.0.2
 * Requires PHP:      7.2
 * Author:            Guillermo Flores
 * Author URI:        https://magnetitte.com/
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );

// Define constantes.
define( 'ML_AUTH_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'ML_AUTH_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Carga archivos necesarios.
require_once ML_AUTH_PLUGIN_DIR . 'includes/class-auth-handler.php';
require_once ML_AUTH_PLUGIN_DIR . 'includes/functions.php';
require_once ML_AUTH_PLUGIN_DIR . 'templates/settings-page.php';
require_once ML_AUTH_PLUGIN_DIR . 'templates/micuenta-page.php';

// Inicializa el plugin.
add_action( 'plugins_loaded', [ 'Auth_Handler', 'init' ] );

class MercadoLibrePropiedades {
	public function __construct() {
		add_action('init', array($this, 'custom_post_type'));
	}

	function activate() {
		$this->custom_post_type();
		flush_rewrite_rules();
	}

	function deactivate() {
		flush_rewrite_rules();
	}

	function uninstall() {
		// delete CPT
		// delete all the plugin data from the DB
	}

	static function custom_post_type() {
		register_post_type('propiedad', ['public' => true, 'label' => 'Propiedades']);
	}
}

if (class_exists('MercadoLibrePropiedades')) {
	$ml_wp = new MercadoLibrePropiedades();
}

// Hooks de activación y desactivación
register_activation_hook(__FILE__, array($ml_wp, 'activate'));
register_deactivation_hook(__FILE__, array($ml_wp, 'deactivate'));
register_uninstall_hook(__FILE__, array($ml_wp, 'uninstall'));




function custom_plugin_menu() {
    add_menu_page(
        'Mercado Libre Sync', 
        'ML Sync', 
        'manage_options', 
        'settings_page', 
        'settings_page', 
        'dashicons-admin-plugins', 
        6 
    );

    add_submenu_page(
        'settings_page', 
        'My Account', 
        'My Account', 
        'manage_options', 
        'my_account', 
        'my_account_page' 
    );
}
add_action('admin_menu', 'custom_plugin_menu');





?>