<?php

/**
 * Plugin Name:       Depresión Plugin
 * Description:       Reemplaza las palabras que se le indiquen por otras definidas relacionadas con la depresión.
 * Version:           1.10.3
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            El inigualable
 * Author URI:        localhost
 * License:           GPL v2 or later
 * Text Domain:       my-basics-plugin
 * Domain Path:       /languages
 */

function renym_wordpress_typo_fix( $text ) {
    $depresion = array("muerte","tristeza","sollozo","dolor","mal","reir");
    $vida = array("Vida","alegria","felicidad","diversion","bien","llorar");

    return str_replace( $vida, $depresion, $text );
}

add_filter( 'the_content', 'renym_wordpress_typo_fix' );
#Cuando hay un error en el login
   function contrasinal_olvidada(){
       return 'La contraseña es castelao!';
   }

add_filter( 'login_errors', 'contrasinal_olvidada' );
