<?php

   $style = $settings['style'];
   
   $title_text = $settings['title_text'];

   if ( ! empty( $settings['link']['url'] ) ) {
      $this->add_render_attribute( 'link', 'href', $settings['link']['url'] );
      $this->add_render_attribute( 'link', 'class', 'popup-video' );

      if ( $settings['link']['is_external'] ) {
         $this->add_render_attribute( 'link', 'target', '_blank' );
      }

      if ( $settings['link']['nofollow'] ) {
         $this->add_render_attribute( 'link', 'rel', 'nofollow' );
      }
   }
   $this->add_render_attribute( 'title_text', 'class', 'title' );
   $this->add_render_attribute( 'description_text', 'class', 'title-desc' );

   $this->add_render_attribute( 'block', 'class', [ 'widget gsc-video-box clearfix', $settings['style'] ] );
   
   $this->add_inline_editing_attributes( 'title_text', 'none' );

   ?>

   <?php if($style == 'style-1'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <div class="video-inner">
            <span class="video-action">
               <?php if($settings['link']['url']){ ?>
                  <a <?php echo $this->get_render_attribute_string( 'link' ) ?>><i class="fa fa-play"></i></a>
               <?php } ?>  
            </span>    
         </div>
      </div> 
   <?php } ?>

   <?php if($style == 'style-2'){ ?>
      <div <?php echo $this->get_render_attribute_string( 'block' ) ?>>
         <div class="video-inner">
            <?php if($title_text){ ?>
               <div <?php echo $this->get_render_attribute_string( 'title_text' ); ?>>
                  <span><?php echo $settings['title_text'] ?></span>
               </div>
            <?php } ?>
            <div class="video-image">
               <img src="<?php echo esc_url($settings['image']['url']) ?>" alt="<?php echo esc_html($settings['title_text']) ?>"/>
               <span class="video-action">
                  <?php if($settings['link']['url']){ ?>
                     <a <?php echo $this->get_render_attribute_string( 'link' ) ?>><i class="fa fa-play"></i></a>
                  <?php } ?>  
               </span>    
            </div>   
         </div>
      </div> 
   <?php } ?>
