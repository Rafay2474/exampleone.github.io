<?php
   if ( empty( $settings['title_text'] ) ) {
      return;
   }
   $title_text = $settings['title_text'];
   $sub_title = $settings['sub_title'];
   $description_text = $settings['description_text'];
   
   $icon_tag = 'span';
   $icon = $icon_image = '';
   if($settings['use_icon_image'] == 'yes'){
      $icon_image = (isset($settings['icon_image']['url']) && $settings['icon_image']['url']) ? $settings['icon_image']['url'] : '';
   }else{
      $icon = $settings['icon'];
   }
   $has_icon = ! ( empty( $icon ) && empty( $icon_image ) );

   $this->add_render_attribute( 'block', 'class', [ $settings['style'], 'widget gsc-call-to-action', $has_icon ? 'has-icon' : '' ] );
   $header_tag = 'h2';

   $this->add_render_attribute( 'title_text', 'class', 'title' );
   $this->add_render_attribute( 'description_text', 'class', 'desc' );

   if ( $has_icon ) {
      $this->add_render_attribute( 'icon', 'class', ['icon', $icon] );
   }

   $this->add_inline_editing_attributes( 'title_text', 'none' );
   $this->add_inline_editing_attributes( 'sub_title', 'none' );
   $this->add_inline_editing_attributes( 'description_text' );

   ?>

   <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
      <?php if ( $has_icon ){ ?>
         <div class="icon-inner">
            <?php if( $settings['use_icon_image'] != 'yes' ){ ?>
               <span <?php echo $this->get_render_attribute_string( 'icon' ); ?>></span>
            <?php }else{ ?>
               <span class="icon icon-image"><img src="<?php echo esc_url($icon_image) ?>" alt="<?php echo esc_html($settings['title_text']) ?>"/></span>
            <?php } ?>   
         </div>
      <?php } ?> 
      <div class="content-inner clearfix"> 
         <div class="content">
            <?php if($title_text){ ?>
               <<?php echo esc_attr($header_tag) ?> <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                  <span><?php echo $settings['title_text'] ?></span>
               </<?php echo esc_attr($header_tag) ?>>
            <?php } ?>
            <?php if($sub_title){ ?>
               <div class="sub-title"><span><?php echo esc_html($sub_title); ?></span></div>
            <?php } ?>
            <?php if($description_text){ ?>
               <div <?php echo $this->get_render_attribute_string( 'description_text' ); ?>><?php echo wp_kses($description_text, true); ?></div>
            <?php } ?>
         </div>
         <?php if($settings['button_url']['url']){ ?>
            <div class="button-action">
               <?php $this->gva_render_button('btn-theme btn-cta'); ?>
            </div>
         <?php } ?>
      </div>
   </div>
