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

  if(is_admin()){
    include("include/deodapps_fields.php");
  }
}
catch(Exception $e){
  echo 'erro.......';
}

//************** Init **************
function deodapps_twitter_cards_init() {
  wp_enqueue_style( 'deodapps-twitter-cards', plugin_dir_url( __FILE__ ) . 'style.admin.min.css', array(),'1.1','all' );
}
add_action( 'init', 'deodapps_twitter_cards_init' );

//************** Add CSS Scripts **************
function deodapps_twitter_cards_enqueue_styles() {
  //if(is_admin()){
  //}
}
add_action( 'wp_enqueue_scripts', 'deodapps_twitter_cards_enqueue_styles' );

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
    'deodapps-metatags',
    __( 'Deodapps Twitter Cards' ),
    '_deodapps_twitter_cards_metabox',
    'post',
    'normal',
    'default'
  );
}
add_action( 'add_meta_boxes', 'deodapps_twitter_cards_adding_custom_meta_boxes', 10, 2 );
function _deodapps_twitter_cards_metabox($post){
  $tw_enable = new FormField();
  $tw_enable->setLabel( __("Enable Custom Information?") );
  $tw_enable->setId( 'wp_deodapps_twc_enable' );
  $tw_enable->setDescription( __("Enable custom information for this post/page") );

  $tw_site = new FormField();
  $tw_site->setLabel( __("Twitter's username") );
  $tw_site->setId( 'wp_deodapps_twc_site' );
  $tw_site->setDescription( __("Twitter's username to be linked to this item") );

  $tw_title = new FormField();
  $tw_title->setLabel( __("Title") );
  $tw_title->setId( 'wp_deodapps_twc_title' );
  $tw_title->setDescription( __("Card Title, 70 chars max") );

  $tw_description = new FormField();
  $tw_description->setLabel( __("Description") );
  $tw_description->setId( 'wp_deodapps_twc_description' );
  $tw_description->setDescription( __("Card Description, 200 chars max") );

  $tw_image = new FormField();
  $tw_image->setLabel( __("Image") );
  $tw_image->setId( 'wp_deodapps_twc_image' );
  $tw_image->setDescription( __("Card Image, recommended 1200x400 pixels") );

  $tw_image_alt = new FormField();
  $tw_image_alt->setLabel( __("Image Alt Text") );
  $tw_image_alt->setId( 'wp_deodapps_twc_image_alt' );
  $tw_image_alt->setDescription( __("Card Image Alt text") );

?>
  <div class="wrapper_deodapps_metabox">
    <?php 
    echo $tw_enable->checkbox(); 
    echo $tw_site->text(); 
    echo $tw_title->text(); 
    echo $tw_description->text(); 
    echo $tw_image->text(); 
    echo $tw_image_alt->text(); 
    ?>
  </div>
<?php
}

//************** hook - wp_head **************
/**
 * Prints in the inside head section the item selected for the current post
 */
function deodapps_twitter_cards_head(){
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