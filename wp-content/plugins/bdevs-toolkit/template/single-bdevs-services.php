<?php 
/** 
 * The main template file
 *
 * @package  WordPress
 * @subpackage  medidove
 */
get_header(); ?>

        <section class="services__details pt-115 pb-100">
            <div class="container">
                <?php 
                if( have_posts() ):
                    while( have_posts() ): the_post();
                        $department_details_thumb = function_exists('get_field') ? get_field('department_details_thumb') : '';
                        $department_sub_title = function_exists('get_field') ? get_field('department_sub_title') : '';
                        $department_title = function_exists('get_field') ? get_field('department_title') : '';

                        // video
                        $department_video_image = function_exists('get_field') ? get_field('department_video_image') : '';
                        $department_video_url = function_exists('get_field') ? get_field('department_video_url') : '';

                        // department short info
                        $department_bottom_text = function_exists('get_field') ? get_field('department_bottom_text') : '';  

                ?>
                <div class="row">
                    <?php if ( is_active_sidebar( 'services-sidebar' ) ) : ?>
                    <div class="col-xl-4 col-lg-4 order-last order-lg-first">
                        <div class="services__sidebar mr-50">
                            <?php do_action("zibber_service_sidebar"); ?>
                        </div>
                    </div>
                    <?php endif; ?>

                    <div class="col-xl-8 col-lg-8">
                        <div class="services__text">
                            <h3 class="wow fadeInUp" data-wow-delay=".2s"><?php the_title(); ?></h3>
                        </div>
                        <div class="service-details-content">
                            <?php the_content(); ?>
                        </div>
                    </div>
                </div>
                <?php 
                    endwhile; wp_reset_query();
                endif; 
                ?>
            </div>
        </section>



<?php get_footer();  ?>