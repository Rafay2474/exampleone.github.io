<?php
if(!function_exists('gaviasthemer_random_id')){
  function gaviasthemer_random_id($length=4){
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $string = '';
    for ($i = 0; $i < $length; $i++) {
      $string .= $characters[rand(0, strlen($characters) - 1)];
    }
    return $string;
  }
}  

function gaviasthemer_get_select_term( $taxonomy ) {
  global $wpdb;
  $cats = array();
  $query = "SELECT a.name,a.slug,a.term_id FROM $wpdb->terms a JOIN  $wpdb->term_taxonomy b ON (a.term_id= b.term_id ) where b.count>0 and b.taxonomy = '{$taxonomy}' and b.parent = 0";

  $categories = $wpdb->get_results($query);
  $cats['Choose Category'] = '';
  foreach ($categories as $category) {
     $cats[html_entity_decode($category->name, ENT_COMPAT, 'UTF-8')] = $category->slug;
  }
  return $cats;
}


function kipso_themer_scheme_colors(){
 $kipso_theme_options = get_option( 'kipso_theme_options' );
  $results = array();
  $results[''] = esc_html__('--None--', 'kipso');
  if(isset($kipso_theme_options['scheme_color'])){
    $colors = $kipso_theme_options['scheme_color'];
    if(!$colors) $colors = array('Turquoise[#00BDC0]', 'Tomato[#F86048]', 'GoldenRod[#FFA940]', 'Violet[#9238A4]');
    foreach ($colors as $color_tmp) {
      $title = $color = '';
      $tmp = explode('[', $color_tmp);
      $title = isset($tmp[0]) ? $tmp[0] : ''; 
      $color = isset($tmp[1]) ? str_replace(']', '', $tmp[1]) : ''; 
      if(!empty($title) && !empty($color)){
        $results[str_replace('-', ' ', strtolower($title))] = $title;
      }
    }
  }
  return $results;
}
