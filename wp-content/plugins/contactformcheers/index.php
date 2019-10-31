<?php
/*
* Plugin Name: Kontaktform
* Plugin URI: http://emilieasmussen.dk/storyscaping
* Description: This is a wordpress Newsletter plugin, based on HTML5, CSS, JS and PHP
* Version: 0.01
* Author: Emilie Asmussen
* Author URI:http://emilieasmussen.dk/storyscaping
* License: GPL2
*/

function my_form()
{

$content  = '';
$content .= '<form method="page" action="http://emilieasmussen.dk/storyscaping/kontakt/">';
$content .= '<input type="text" name="fullname" placeholder="Fulde navn" id="fullname">'; /* her laver vi et felt til at skrive ens fulde navn i */
$content .= '<input type="text" name="emailadress" placeholder="Email" id="emailadress">'; /* her laver vi et felt til at skrive ens emailadresse i */
$content .= '<input type="text" name="besked" placeholder="Besked" id="besked">'; /* her laver vi et felt til at skrive ens besked i */

$content .= '<input type="button" name="submit_form" value="SEND" id="submit">'; /* her laver vi en knap til at trykke send på*/

return $content;
}

add_shortcode('show_form_plugin','my_form'); /*her laver i vi shortcode der skal skrives i wordpress*/

/* her registere vi vores stylesheet*/
add_action('wp_enqueue_scripts', 'register_plugin_styles');

function register_plugin_styles(){

wp_enqueue_style('custom_form_plugin_style', plugins_url('/contactformcheers/css/style.css'));
wp_enqueue_script('custom_form_plugin_script', plugins_url('/contactformcheers/script.js'), array(), null, true);

    
}

?>
