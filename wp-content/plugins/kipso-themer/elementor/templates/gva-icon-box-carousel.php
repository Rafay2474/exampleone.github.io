<?php
   if (!defined('ABSPATH')) {
      exit; // Exit if accessed directly.
   }

   use Elementor\Group_Control_Image_Size;

   $this->add_render_attribute('wrapper', 'class', ['gsc-icon-box-carousel', $settings['style']]);
   $this->add_render_attribute('carousel', 'class', ['init-carousel-owl owl-carousel']);


?>

   <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
      <div <?php echo $this->get_render_attribute_string('carousel') ?> <?php echo $this->get_carousel_settings() ?>>
         <?php
         foreach ($settings['icon_boxs'] as $item): ?>
            <div class="item icon-box-item">
               <div class="icon-box-item-content elementor-repeater-item-<?php echo esc_attr($item['_id']) ?>">
                  <?php if(isset($item['image']['url'])){ ?>
                     <div class="box-icon">
                        <div class="icon-inner">
                           <img src="<?php echo esc_url($item['image']['url']) ?>" alt="<?php echo esc_html($item['title']) ?>" />
                        </div>
                     </div>
                  <?php } ?> 

                  <?php 
                     if(isset($item['title'])){ 
                        $title_html = $item['title'];
                        echo '<div class="title"> ' . $title_html . '</div>';
                     } 
                  ?>
               </div>
               <?php 
                  if ( ! empty( $item['link']['url'] ) ) {
                     $this->add_render_attribute( 'link-'. $item['_id'], 'href', $item['link']['url'] );
                     if ( $item['link']['is_external'] ) {
                        $this->add_render_attribute( 'link-' . $item['_id'], 'target', '_blank' );
                     }
                     if ( $item['link']['nofollow'] ) {
                        $this->add_render_attribute( 'link-' . $item['_id'], 'rel', 'nofollow' );
                     }
                     echo ('<a class="link-overlay" ' . $this->get_render_attribute_string('link-' . $item['_id']) . '></a>');
                  }
               ?>
            </div>
         <?php endforeach; ?>
      </div>
   </div>
