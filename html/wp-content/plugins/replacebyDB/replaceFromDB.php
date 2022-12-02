<?php
/**
 * Plugin Name:       DB WordsReplacer
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

$depresion = array("muerte","tristeza","sollozo","dolor","mal","reir");
$vida = array("Vida","alegria","felicidad","diversion","bien","llorar");

//function dbplugin(){
//    global $wpdb;
//    $charset_collate = $wpdb->get_charset_collate();
//
//    $table_name = $wpdb->prefix . 'WordsToReplace';
//
//    $sql = "CREATE TABLE $table_name (
//        id mediumint(9) NOT NULL,
//        text palabraReemplazar NOT NULL,
//        text reemplazo NOT NULL,
//        PRIMARY KEY (id)
//        )$charset_collate;";
//
//    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
//    dbDelta($sql);
//}
//add_action('plugins_loaded', 'dbplugin');

function crearTablas() {
    global $wpdb;
    $charset_collate = $wpdb->get_charset_collate();

    $table_name1 = $wpdb->prefix . 'palabras_malsonantes';
    $table_name2 = $wpdb->prefix . 'palabras_reemplazo';

    $sql = "CREATE TABLE $table_name1 (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    $sql2 = "CREATE TABLE $table_name2 (
        id mediumint(9) NOT NULL,
        text text NOT NULL,
        PRIMARY KEY (id)
    ) $charset_collate;";

    require_once( ABSPATH . 'wp-admin/includes/upgrade.php' );
    dbDelta( $sql );
    dbDelta( $sql2 );

    //Insert
    $textreemplazo='eLPepPE';
    $textmalsonante='Pepe';

    $result = $wpdb->insert(
        $table_name1,
        array(
            'text' => $textmalsonante,
        )
    );
    $result = $wpdb->insert(
        $table_name2,
        array(
            'text' => $textreemplazo,
        )
    );

    error_log("Plugin DAM insert: " . $result);

}
add_action('plugins_loaded', 'crearTablas');

function renym_wordpress_typo_fix( $text ) {

    global $wpdb;

    // recojemos el
    $charset_collate = $wpdb->get_charset_collate();

    // le añado el prefijo a la tabla
    $table_name1 = $wpdb->prefix . 'palabras_malsonantes';
    $table_name2 = $wpdb->prefix . 'palabras_reemplazo';

    $resultado = $wpdb->get_results("SELECT text FROM " . $table_name1, ARRAY_A);
    $resultado2 = $wpdb->get_results("SELECT text FROM " . $table_name2, ARRAY_A);

    $depresion = array();
    $vida = array();

    foreach ($resultado as $row) {
        $depresion[] = $row['text'];
    }
    foreach ($resultado2 as $row) {
        $vida[] = $row['text'];
    }

    return str_replace( $depresion, $vida, $text );
}

add_filter( 'the_content', 'renym_wordpress_typo_fix' );

function dam22_shortcodes_init(){
    function dam22_shortcode($atts = [], $content = null){
        //Devuelve alerta con el texto denrto del alert.
        $content = "<script>alert('Yepa ya estoy por aqui, no podia dejar mi stream ' +
 'Ahora que por fin ya he vuelto a twitch' +
  'Demostraré que para esto nací' +
   'Ya estoy por casa, ya ha llegado el papa' +
    'Nunca di la chapa, pero Twitch lo puse en el mapa' +
     'El mas cabron el más real, el menos copión, siempre lo hice de corazón' +
      'El primer hispano en llegar al millón' +
       'Ese soy yo por si no te acordabas' +
        'Que fui yo quien remaba, cuando aquí no había nada' +
         'Solo youtubers que no stremeaban' +
          'Alli estaba yo, dandolo to' +
           'Vine de abajo y me puse en el to' +
            'Dedicación y mucha pasió' +
             'Hizo que en esto yo fuera el mejo' +
              'Fueron pocos los que me apoyaro' +
               'Y ahora mira monstro donde hemos llegad' +
                'A mi muchos tontos me subestimaro' +
                 'Pero con su odio se atragantaron');</script>";
        return $content;
    }
    add_shortcode('dam22', 'dam22_shortcode');
}


add_action('init', 'dam22_shortcodes_init');
