<?php
   $this->add_render_attribute( 'block', 'class', [ 'gva-user', ' text-' . $settings['align'] ] );
   $url_profile = wp_login_url();
   if(function_exists('learn_press_get_page_link')){
      $url_profile = learn_press_get_page_link( 'profile' );
   }

   if(empty($settings['text_login_url']['url'])) $settings['text_login_url']['url'] = $url_profile;

   $this->add_render_attribute( 'url_text', 'href', $settings['text_login_url']['url'] );

   if ( $settings['text_login_url']['is_external'] ) {
      $this->add_render_attribute( 'url_text', 'target', '_blank' );
   }
   if ( $settings['text_login_url']['nofollow'] ) {
      $this->add_render_attribute( 'url_text', 'rel', 'nofollow' );
   }
?>

<div <?php echo $this->get_render_attribute_string( 'block' ) ?>>

   <?php if(is_user_logged_in()){ ?>

      <?php
         $user = wp_get_current_user();
         $_random = gaviasthemer_random_id();
         $args = [
            'echo'        => false,
            'menu'        => $settings['menu'],  
            'menu_class'  => 'gva-nav-menu gva-main-menu',
            'menu_id'     => 'menu-' . $_random,
            'container'   => 'div',
            'walker'      => new Kipso_Walker()
         ];
         $menu_html = wp_nav_menu($args);
      ?>
 
      <div class="login-account">
         <div class="profile">
            <div class="avata">
               <?php echo get_avatar( $user->ID, 64 ); ?>
            </div>
            <div class="name">
               <?php echo esc_html($user->display_name) ?>
               <i class="icon gv-icon-161"></i>
            </div>
         </div>  
         <div class="user-account">
            <?php echo $menu_html; ?>
         </div> 
      </div>

   <?php }else{ ?>

      <div class="login-register">
         <a <?php echo $this->get_render_attribute_string( 'url_text' ); ?>>
            <?php echo esc_html__('Login/Register') ?>
         </a>
      </div>

   <?php } ?>
</div>