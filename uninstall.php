<?php

if (!defined('WP_UNINSTALL_PLUGIN')) {
    die;
}

// Clear Database stored data
$propiedades = get_posts(array('post_type' => 'propiedades', 'numberposts' => -1));

foreach ( $propiedades as $propiedad ) {
    wp_delete_post( $propiedad->ID, true );
}

// Access the database via SQL
// global $wpdb;
// $wpdb->query("DELETE FROM wp_posts WHERE post_type = 'propiedades'");
// $wpdb->query("DELETE FROM wp_postmeta WHERE post_id NOT IN (SELECT id FROM wp_posts)");
