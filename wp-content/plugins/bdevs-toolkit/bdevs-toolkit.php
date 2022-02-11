<?php 
if ( !defined('ABSPATH') )
    exit;

/*
Plugin Name: Bdevs Toolkit
Plugin URI: http://bdevs.net/
Description: Bdevs Toolkit Plugin
Version: 1.0.4
Author: BDevs
Author URI: http://bdevs.net
*/

define( 'BDEVS_TOOLKIT_VER', '1.0.4' );
define( 'BDEVS_TOOLKIT_DIR', plugin_dir_path( __FILE__ ) );
define( 'BDEVS_TOOLKIT_URL', plugin_dir_url( __FILE__ ) );

define( 'BDEVS_TOOLKIT_METABOX_ACTIVED', in_array( 'cmb2/init.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) );

final class Bdevs_toolkit {

	private static $instance;

	function __construct() {

		require_once BDEVS_TOOLKIT_DIR . '/inc/custom-post.php';

    	require_once BDEVS_TOOLKIT_DIR . '/inc/acf-meta-field.php';
    	require_once BDEVS_TOOLKIT_DIR . '/inc/class-ocdi-importer.php';
    	/**
		* widgets
		*/
		require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-latest-posts-sidebar.php';
		require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-subscriber-widget.php';
		// require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-service-list.php';
		// require_once BDEVS_TOOLKIT_DIR . '/widgets/bdevs-services-form-widget.php';
		// add_filter( 'template_include', array( $this, '_custom_template_include' ) );
	}

	public static function instance() {

		if ( ! isset( self::$instance ) && ! ( self::$instance instanceof Bdevs_toolkit ) ) {
			self::$instance = new Bdevs_toolkit;
		}
		return self::$instance;
	}

	public function _custom_template_include( $template ) {
		$post_types = bdevs_custom_post_types();
		foreach ( $post_types as $post_type => $fields ) {
			if ( is_singular( $post_type ) ) {
				return $this->_get_custom_template( 'single-'. $post_type .'.php');
			}
        }
        return $template;
		
	}
	
	public function _get_custom_template( $template ) {
		if ( $theme_file = locate_template( array( $template ) ) ) {
			$file = $theme_file;
		} 
		else {
			$file = BDEVS_TOOLKIT_DIR . 'template/'. $template;
		}
		return apply_filters( __FUNCTION__, $file, $template );
	}

}

function Bdevs_toolkit() {

	return Bdevs_toolkit::instance();
}

Bdevs_toolkit();

/** 
*
*/
// function bdevs_custom_post_types() {
// 	return array (
// 		'bdevs-services' => array('title' => 'Service', 'plural_title' => 'Services', 'rewrite' => 'ourservices','menu_icon' => 'dashicons-admin-generic'), 
// 		'bdevs-cases'  => array( 'title' => 'Cases', 'plural_title' => 'Cases', 'rewrite' => 'ourcases','menu_icon' => 'dashicons-format-image' )
// 	);
// }

// add_filter('custom_bdevs_post_types', 'bdevs_custom_post_types');

/** 
*
*/
// function bdevs_custom_taxonomies() {
// 	return array (
// 		'service-categories' => array(
// 			'title' => 'Services Category', 
// 			'plural_title' =>'Services Categories', 
// 			'rewrite' => 'services-cat', 
// 			'post_type' => 'bdevs-services'
// 		),
// 		'cases-categories' => array(
// 			'title' => 'Cases Category', 
// 			'plural_title' =>'Cases Categories', 
// 			'rewrite' => 'cases-cat', 
// 			'post_type' => 'bdevs-cases'
// 		),
// 	);
// }

// add_filter('custom_bdevs_taxonomies', 'bdevs_custom_taxonomies');


/**
* taxonomy category
*/
function bdevs_get_terms($id,$tax){
    $terms = get_the_terms( get_the_ID(), $tax ); 
    $list = '';
    if ( $terms && ! is_wp_error( $terms ) ) : 
        $i=1;
        $cats_count = count($terms);
        foreach ( $terms as $term ) {
            $exatra = ( $cats_count > $i ) ? ', ' : '';
            $list .= $term->name . $exatra;
            $i++;
        }
    endif;
    return trim($list,',');
}

// Load textdomain
function markite_load_plugin_textdomain() {
	load_plugin_textdomain( 'bdevs-toolkit', false, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'init', 'markite_load_plugin_textdomain' );

//sent mail 
function markite_wp_mail( $to, $subject, $message, $headers ) {
	wp_mail( $to, $subject, $message, $headers );
}


// get_shop_search_shortcode
function shop_search_callback() {
	ob_start(); ?>
	<div class="sidebar__widget-content"><div class="sidebar__search-wrapper">
		<form class="sidebar-widget-form" action="<?php print esc_url(home_url('/shop')); ?>" method="get">
  			<input type="text" value="<?php print esc_attr( get_search_query() ) ?>" required name="s" placeholder="<?php echo esc_html__('Search','markite'); ?>">
  			<button type="submit"> <i class="fal fa-search"></i>  </button>
		</form>
	</div></div>
	<?php return ob_get_clean();
}
add_shortcode( 'get_shop_search_shortcode', 'shop_search_callback' );