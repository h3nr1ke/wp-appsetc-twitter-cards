<?php
/*
Plugin Name: Deodapps - Twitter Cards
Plugin URI:  https://developer.wordpress.org/plugins/the-basics/
Description: Create a simple way to include Twitter cards in Posts and Pages.
Version:     0.0.1
Author:      Henrique Deodato @ Deodapps
Author URI:  https://www.deodapps.com
License:     GPL2
License URI: https://www.gnu.org/licenses/gpl-2.0.html
Text Domain: deodapps
Domain Path: /languages
*/
defined( 'ABSPATH' ) or die( 'Não não, perdão...' );

//************** Includes **************
try{
  include("include/deodapps_twitter_cards.php");
}
catch(Exception $e){
  echo 'erro.......';
}

//************** Init **************
function deodapps_twitter_cards_init() {
}
add_action( 'init', 'deodapps_twitter_cards_init' );

//************** Add Menu Itens **************
function deodapps_twitter_cards_menu(){
  global $submenu;

  $main_menu = 'deodapps-menu';

  if ( !isset( $submenu[ $main_menu ] ) ) {
    //adiciona...
    add_menu_page(
      'Deodapps',
      'Deodapps',
      'manage_options',
      $main_menu, 
      'deodapps_twitter_cards_menu_content'
      );
  }
  add_submenu_page(
    $main_menu, 
    'Twitter Cards',
    'Twitter Cards',
    'manage_options',
    'deodapps-twitter-cards',
    'deodapps_twitter_cards_submenu_content'
  );
}

function deodapps_twitter_cards_menu_content(){
  echo "Menu Deodapps...";
}

function deodapps_twitter_cards_submenu_content(){
  echo "Sub Menu Deodapps...";
}

add_action('admin_menu', 'deodapps_twitter_cards_menu');

//************** Activation / Deactivation **************
function deodapps_twitter_cards_activation() {

}
register_activation_hook( __FILE__, 'deodapps_twitter_cards_activation' );

function deodapps_twitter_cards_deactivation(){

}
register_deactivation_hook( __FILE__, 'deodapps_twitter_cards_deactivation' );

//************** hook - add_meta_boxes **************
function deodapps_twitter_cards_adding_custom_meta_boxes( $post_type, $post ) {
    add_meta_box( 
        'my-meta-box',
        __( 'My Meta Box' ),
        'render_my_meta_box',
        'post',
        'normal',
        'default'
    );
}
add_action( 'add_meta_boxes', 'adding_custom_meta_boxes', 10, 2 );

//************** hook - wp_head **************
/**
 * Prints in the inside head section the item selected for the current post
 */
function deodapps_twitter_cards_head(){
  //echo '<!-- era is_admin() -> '.is_admin().'-->';
  if( !is_admin() ){
    //get current page
    try{
      $twitterCards = new TwitterCards();
      $output = sprintf($twitterCards->summary(),'@hdeodato','Teste Title','Description Test','image_url_here','Image Alt Text');
      echo $output;
    }
    catch(Exception $e){
      echo '<!-- ';
      print_r($e);
      echo ' -->';
    }
  }
  else{
    echo '<!-- No tags for -->';
  }
}
add_action('wp_head', 'deodapps_twitter_cards_head');