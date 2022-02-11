<?php 
/**
 * Plugin Name: Kipso Themer
 * Description: Open Setting, Post Type, Shortcode ... for theme 
 * Version: 1.3.0
 * Author: Gaviasthemes Team
 */

define( 'GAVIAS_KIPSO_PLUGIN_URL', plugin_dir_url( __FILE__ ) );
define( 'GAVIAS_KIPSO_PLUGIN_DIR', plugin_dir_path( __FILE__ )  );

class Gavias_Kipso_Themer{

	function __construct(){
      $this->load_language_file();
		$this->include_files();
		$this->include_post_types();
      add_action('wp_head', array($this, 'gaviasthemer_ajax_url'));
      add_action('wp_enqueue_scripts', array($this, 'register_scripts'));
      $this->gavias_plugin_update();
	}

   function load_language_file(){
      load_plugin_textdomain('kipso-themer', false, basename( dirname( __FILE__ ) ) . '/languages' );
   }

   function gaviasthemer_ajax_url(){
     echo '<script> var ajaxurl = "' . admin_url('admin-ajax.php') . '";</script>';
   }
 
	function include_files(){
      require_once('redux/admin-init.php');
      require_once('includes/functions.php');
      require_once('includes/hook.php');
      require_once('includes/meta-term.php');
      require_once('includes/comment.php');
      require_once('elementor/init.php');   
	}

	function include_post_types(){
      require_once('posttypes/footer.php');
      require_once('posttypes/header.php');
		require_once('posttypes/gallery.php');
		require_once('posttypes/event.php');
		require_once('posttypes/portfolio.php');
      require_once('posttypes/team.php');
      require_once('posttypes/service.php');
	}

   function register_scripts(){
      $js_dir = plugin_dir_url( __FILE__ ).'assets/js';
      wp_register_script('gavias-themer', $js_dir.'/main.js', array('jquery'), null, true);
      wp_enqueue_script('gavias-themer');
   }

   public function gavias_plugin_update() {
      require 'plugin-update/plugin-update-checker.php';
      Puc_v4_Factory::buildUpdateChecker(
         'http://gaviasthemes.com/plugins/dummy_data/kipso-themer-update-plugin.json',
         __FILE__,
         'kipso-themer'
      );
   }
}

new Gavias_Kipso_Themer();

// add_action( 'init', 'kispo_themer_load_textdomain' );
// function kispo_themer_load_textdomain() {
//    $basename = basename( __FILE__ );
//    $basepath = plugin_basename( __FILE__ );
//    $basepath = str_replace( $basename, '', $basepath );
//    load_plugin_textdomain( 'kipso-themer', false, $basepath . 'languages' );
// }