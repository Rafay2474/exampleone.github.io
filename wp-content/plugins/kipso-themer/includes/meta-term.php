<?php
function kipso_themer_taxonomy_edit_meta_field( $term ) {
   $kipso_scheme_colors = kipso_themer_scheme_colors();
   $term_meta_color = $term && !empty($term->term_id) ? get_term_meta( $term->term_id, 'course_category_color', true ) : false;
   ?>
   <tr class="form-field">
      <th scope="row" valign="top"><label for="term_meta[course_category_color]"><?php _e( 'Choose Color', 'kipso_themer' ); ?></label></th>
      <td>
         <select name="term_meta[course_category_color]">
            <?php foreach ($kipso_scheme_colors as $key => $color) { ?>
               <option <?php echo ($term_meta_color==$key) ? 'selected' : '' ?> value="<?php echo esc_attr($key) ?>"><?php echo esc_html( $color ) ?></option>
            <?php } ?>
         </select>
         <p class="description"><?php _e( 'Choose color skin', 'kipso_themer' ); ?></p>
         <?php wp_nonce_field( 'update_term_meta', 'term_meta_nonce' ) ?>
      </td>
   </tr>
   <?php
}

add_action( 'course_category_add_form_fields', 'kipso_themer_taxonomy_edit_meta_field', 10 );
add_action( 'course_category_edit_form_fields', 'kipso_themer_taxonomy_edit_meta_field', 10 );

/**
 * Save meta data callback function.
 */
function kipso_themer_save_taxonomy_custom_meta( $term_id ) {
   if (
      isset( $_POST['term_meta'] ) && is_array( $_POST['term_meta'] ) &&
      ! empty( $_POST['term_meta_nonce'] ) && wp_verify_nonce( $_POST['term_meta_nonce'], 'update_term_meta' )
   ) {
      foreach ( $_POST['term_meta'] as $key => $value ) {
         update_term_meta( $term_id, $key, sanitize_text_field( $value ) );
      }
   }
}

add_action( 'edited_course_category', 'kipso_themer_save_taxonomy_custom_meta', 10, 2 );
add_action( 'create_course_category', 'kipso_themer_save_taxonomy_custom_meta', 10, 2 );


//=== Rate comment metabox
add_filter( 'comment_edit_redirect',  'kipso_themer_save_comment_rate', 10, 2 );
add_action( 'add_meta_boxes', 'kipso_themer_add_comment_rate' );
function kipso_themer_save_comment_rate( $location, $comment_id ){
  if( !wp_verify_nonce( $_POST['noncename_comment_rate'], plugin_basename( __FILE__ ) ) && !isset( $_POST['rate'] ) ){
    return $location;
  }
  update_comment_meta( $comment_id, 'rate', sanitize_text_field( $_POST['rate'] ) );
  return $location;
}

function kipso_themer_add_comment_rate() {
  add_meta_box( 
    'section_id_wpse_82317',
    esc_html__( 'Rating for course', 'kipso' ),
    'kipso_themer_inner_comment_rate',
    'comment',
    'normal'
  );
}

function kipso_themer_inner_comment_rate( $comment ) {
  wp_nonce_field( plugin_basename( __FILE__ ), 'noncename_comment_rate' );
  $c_meta = get_comment_meta( $comment->comment_ID, 'rate', true );
 
  echo '<select id="rate" name="rate">';
    echo '<option value="1"'.(esc_attr($c_meta)==1?'selected':'').'>1</option>';
    echo '<option value="2"'.(esc_attr($c_meta)==2?'selected':'').'>2</option>';
    echo '<option value="3"'.(esc_attr($c_meta)==3?'selected':'').'>3</option>';
    echo '<option value="4"'.(esc_attr($c_meta)==4?'selected':'').'>4</option>';
    echo '<option value="5"'.(esc_attr($c_meta)==5?'selected':'').'>5</option>';
  echo '</select>';  
}