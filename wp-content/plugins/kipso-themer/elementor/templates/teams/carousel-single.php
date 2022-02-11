<?php
  $query = $this->query_posts();
  $_random = gaviasthemer_random_id();
  if ( ! $query->found_posts ) {
    return;
  }

  $this->add_render_attribute('wrapper', 'class', ['gva-teams-carousel']);

  $this->add_render_attribute('wrapper', 'data-filter', $_random);

  $this->add_render_attribute('carousel', 'class', 'init-carousel-owl owl-carousel carousel-thumbnail');
  $this->add_render_attribute('carousel', 'data-items', 1);
  $this->add_render_attribute('carousel', 'data-items_lg', 1);
  $this->add_render_attribute('carousel', 'data-items_md', 1);
  $this->add_render_attribute('carousel', 'data-items_sm', 1);
  $this->add_render_attribute('carousel', 'data-items_xs', 1);
  $this->add_render_attribute('carousel', 'data-loop', 1);
  $this->add_render_attribute('carousel', 'data-auto_play', 1);
  $this->add_render_attribute('carousel', 'data-navigation', 0);
  $this->add_render_attribute('carousel', 'data-pagination', 1);
  $this->add_render_attribute('carousel', 'data-mouse_drag', 1);
  $this->add_render_attribute('carousel', 'data-touch_drag', 1);
  ?>

   <div <?php echo $this->get_render_attribute_string('wrapper'); ?>>
      <div <?php echo $this->get_render_attribute_string('carousel') ?>>
          <?php
              global $post;
              $count = 0;
              while ( $query->have_posts() ) { 
              $query->the_post();
                  $post->loop = $count++;
                  $post->post_count = $query->post_count;
                  set_query_var( 'settings', $settings );
                  get_template_part('templates/content/item', 'team-style-3' );
              }
          ?>
      </div>
   </div>
  <?php
  wp_reset_postdata();