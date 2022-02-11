<?php

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

use Elementor\Controls_Manager;
use Elementor\Utils;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;
use Elementor\Repeater;

class GVAElement_Testimonial extends GVAElement_Base{

    /**
     * Get widget name.
     *
     * Retrieve testimonial widget name.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'gva-testimonials';
    }

    /**
     * Get widget title.
     *
     * Retrieve testimonial widget title.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __('GVA Testimonials', 'kipso-themer');
    }

    /**
     * Get widget icon.
     *
     * Retrieve testimonial widget icon.
     *
     * @since  1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-posts-carousel';
    }

    public function get_keywords() {
        return [ 'testimonial', 'content', 'carousel' ];
    }

    public function get_script_depends() {
      return [
          'jquery.owl.carousel',
          'gavias.elements',
      ];
    }

    public function get_style_depends() {
      return array('owl-carousel-css');
    }

    /**
     * Register testimonial widget controls.
     *
     * Adds different input fields to allow the user to change and customize the widget settings.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function register_controls() {
        $this->start_controls_section(
            'section_testimonial',
            [
                'label' => __('Testimonials', 'kipso-themer'),
            ]
        );
        $this->add_control(
            'style',
            array(
                'label'   => esc_html__( 'Style', 'kipso-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'style-1',
                'options' => [
                  'style-1' => esc_html__('Style I - Carousel', 'kipso-themer'),
                  'style-2' => esc_html__('Style II - Carousel Single', 'kipso-themer'),
                ]
            )
         );
        $repeater = new Repeater();
        $repeater->add_control(
            'testimonial_content',
            [
                'label'       => __('Content', 'kipso-themer'),
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'I was impresed by the kipso services, lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia.',
                'label_block' => true,
                'rows'        => '10',
            ]
        );
        $repeater->add_control(
            'testimonial_image',
            [
                'label'      => __('Choose Image', 'kipso-themer'),
                'default'    => [
                    'url' => GAVIAS_KIPSO_PLUGIN_URL . 'elementor/assets/images/testimonial-placeholder.png',
                ],
                'type'       => Controls_Manager::MEDIA,
                'show_label' => false,
            ]
        );
        $repeater->add_control(
            'testimonial_name',
            [
                'label'   => __('Name', 'kipso-themer'),
                'default' => 'John Doe',
                'type'    => Controls_Manager::TEXT,
            ]
        );
        $repeater->add_control(
            'testimonial_job',
            [
                'label'   => __('Job', 'kipso-themer'),
                'default' => 'Designer',
                'type'    => Controls_Manager::TEXT,
            ]
        );
        
        $this->add_control(
            'testimonials',
            [
                'label'       => __('Testimonials Content Item', 'kipso-themer'),
                'type'        => Controls_Manager::REPEATER,
                 'fields' => $repeater->get_controls(),
                'title_field' => '{{{ testimonial_name }}}',
                'default'     => array(
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the kipso services, lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia.', 'kipso-themer' ),
                        'testimonial_name'     => esc_html__( 'Christine Eve', 'kipso-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'kipso-themer' ),
                        'testimonial_image'    => [
                            'url' => GAVIAS_KIPSO_PLUGIN_URL . 'elementor/assets/images/testimonial-placeholder.png',
                        ]
                    ),
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the kipso services, lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia.', 'kipso-themer' ),
                        'testimonial_name'     => esc_html__( 'Kevin Smith', 'kipso-themer' ),
                        'testimonial_job'      => esc_html__( 'Customer', 'kipso-themer' ),
                        'testimonial_image'    => [
                            'url' => GAVIAS_KIPSO_PLUGIN_URL . 'elementor/assets/images/testimonial-placeholder.png',
                        ]
                    ),
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the kipso services, lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia.', 'kipso-themer' ),
                        'testimonial_name'     => esc_html__( 'Jessica Brown', 'kipso-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'kipso-themer' ),
                        'testimonial_image'    => [
                            'url' => GAVIAS_KIPSO_PLUGIN_URL . 'elementor/assets/images/testimonial-placeholder.png',
                        ]
                    ),
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the kipso services, lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia.', 'kipso-themer' ),
                        'testimonial_name'     => esc_html__( 'David Anderson', 'kipso-themer' ),
                        'testimonial_job'      => esc_html__( 'Customer', 'kipso-themer' ),
                        'testimonial_image'    => [
                            'url' => GAVIAS_KIPSO_PLUGIN_URL . 'elementor/assets/images/testimonial-placeholder.png',
                        ]
                    ),
                    array(
                        'testimonial_content'  => esc_html__( 'I was impresed by the kipso services, lorem ipsum is simply free text used by copytyping refreshing. Neque porro est qui dolorem ipsum quia.', 'kipso-themer' ),
                        'testimonial_name'     => esc_html__( 'Susan Neill', 'kipso-themer' ),
                        'testimonial_job'      => esc_html__( 'Founder & CEO', 'kipso-themer' ),
                        'testimonial_image'    => [
                            'url' => GAVIAS_KIPSO_PLUGIN_URL . 'elementor/assets/images/testimonial-placeholder.png',
                        ]
                    ),
                ),
            ]
        );

        $this->add_group_control(
            Elementor\Group_Control_Image_Size::get_type(),
            [
                'name'      => 'testimonial_image', 
                'default'   => 'full',
                'separator' => 'none',
                'condition' => [
                    'style' => array('style-1', 'style-2')
                ]
            ]
        );

        $this->add_control(
            'view',
            [
                'label'   => __('View', 'kipso-themer'),
                'type'    => Controls_Manager::HIDDEN,
                'default' => 'traditional',
            ]
        );
        $this->end_controls_section();

         $this->add_control_carousel( false,
            array(
               'style' => ['style-1', 'style-2']
            )
         );

        // Style.
        $this->start_controls_section(
            'section_style_content',
            [
                'label' => __('Content', 'kipso-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
 
        $this->add_control(
            'content_content_color',
            [
                'label'     => __('Text Color', 'kipso-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .gva-testimonial-carousel .testimonial-content' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .gva-testimonial-carousel .icon-quote' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .gva-testimonial-carousel .testimonial-item .testimonial-content',
            ]
        );

        $this->end_controls_section();

        // Image Styling
        $this->start_controls_section(
            'section_style_image',
            [
                'label'     => __('Image', 'kipso-themer'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'image_size',
            [
                'label'      => __('Image Size', 'kipso-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 20,
                        'max' => 200,
                    ],
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-testimonial-carousel .testimonial-image img' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .gva-testimonial-carousel .testimonial-image img',
                'separator' => 'before',
            ]
        );

        $this->add_control(
            'image_border_radius',
            [
                'label'      => __('Border Radius', 'kipso-themer'),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .gva-testimonial-carousel .testimonial-image img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();

        // Name Styling
        $this->start_controls_section(
            'section_style_name',
            [
                'label' => __('Name', 'kipso-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'name_text_color',
            [
                'label'     => __('Text Color', 'kipso-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-name, {{WRAPPER}} .testimonial-name a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'name_typography',
                'selector' => '{{WRAPPER}} .testimonial-name',
            ]
        );

        $this->end_controls_section();

        // Job Styling
        $this->start_controls_section(
            'section_style_job',
            [
                'label' => __('Job', 'kipso-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'job_text_color',
            [
                'label'     => __('Text Color', 'kipso-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .testimonial-job, {{WRAPPER}} .testimonial-job a' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'job_typography',
                'selector' => '{{WRAPPER}} .elementor-testimonial-job',
            ]
        );
        $this->end_controls_section();

    }

    /**
     * Render testimonial widget output on the frontend.
     *
     * Written in PHP and used to generate the final HTML.
     *
     * @since  1.0.0
     * @access protected
     */
    protected function render() {
      $settings = $this->get_settings_for_display();
      printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
      if(isset($settings['style']) && $settings['style']){
         include $this->get_template('testimonials/gva-testimonials-' . $settings['style'] . '.php');
      }
      print '</div>';
    }

}
