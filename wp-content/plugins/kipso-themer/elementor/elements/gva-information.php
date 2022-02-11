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

class GVAElement_Information extends GVAElement_Base{

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
        return 'gva-information';
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
        return __('GVA Information', 'kipso-themer');
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
        return 'eicon-posts-list';
    }

    public function get_keywords() {
        return [ 'information', 'content' ];
    }

    public function get_script_depends() {
      return [
          'jquery.owl.carousel',
          'gavias.elements',
      ];
    }

    public function get_style_depends() {
        return [
            'owl-carousel-css',
        ];
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
            'section_information',
            [
                'label' => __('Content', 'kipso-themer'),
            ]
        );
        $repeater = new Repeater();
        $repeater->add_control(
            'title',
            [
                'label'       => __('Title', 'kipso-themer'),
                'type'        => Controls_Manager::TEXT,
                'default'     => '',
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'content',
            [
                'label'   => __('Content', 'kipso-themer'),
                'default' => '',
                'type'    => Controls_Manager::TEXT,
                'label_block' => true,
            ]
        );
        $repeater->add_control(
            'icon',
            [
                'label'   => __('Icon', 'kipso-themer'),
                'default' => 'fa fa-home',
                'type'    => Controls_Manager::ICON,
            ]
        );

        $this->add_control(
            'informations',
            [
                'label'       => __('Content Item', 'kipso-themer'),
                'type'        => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => array(
                    array(
                        'title'     => esc_html__( 'Phone', 'kipso-themer' ),
                        'content'   => esc_html__( '444 777 0000', 'kipso-themer' ),
                        'icon'      => esc_html__( ' fa fa-phone', 'kipso-themer' ),
                    ),
                    array(
                        'title'     => esc_html__( 'Address', 'kipso-themer' ),
                        'content'   => esc_html__( '22 Road, Borklyn Street, New York, USA', 'kipso-themer' ),
                        'icon'      => esc_html__( 'fa fa-map-marker', 'kipso-themer' ),
                    ),
                    array(
                        'title'     => esc_html__( 'Email', 'kipso-themer' ),
                        'content'   => esc_html__( 'needhelp@kipso.com', 'kipso-themer' ),
                        'icon'      => esc_html__( 'fa fa-envelope-open', 'kipso-themer' ),
                    ),
                    
                ),
            ]
        );

        $this->end_controls_section();

         $this->start_controls_section(
            'section_box_layout',
            [
                'label' => __('Layout', 'kipso-themer'),
                'type'  => Controls_Manager::SECTION,
            ]
        );
        $this->add_control(
            'layout',
            [
                'label'   => __( 'Layout Display', 'kipso-themer' ),
                'type'    => Controls_Manager::SELECT,
                'default' => 'carousel',
                'options' => [
                    'list'      => __( 'List', 'kipso-themer' ),
                    'carousel'  => __( 'Carousel', 'kipso-themer' ),
                ]
            ]
        );
        $this->end_controls_section();

        $this->add_control_carousel(false, array('layout' => 'carousel'));
       
        // List Styling
        $this->start_controls_section(
            'section_list_styling',
            [
                'label' => __('List', 'kipso-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'layout' => 'list',
                ],
            ]
        );
        $this->add_control(
            'space_between',
            [
                'label'      => __(' Space Between', 'kipso-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 2,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size'  => 12,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-information .information-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Icon Styling
        $this->start_controls_section(
            'section_icon_styling',
            [
                'label' => __('Icon', 'kipso-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'view',
            [
                'label' => __( 'View', 'kipso-themer' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'default' => __( 'Default', 'kipso-themer' ),
                    'stacked' => __( 'Stacked', 'kipso-themer' ),
                    'framed' => __( 'Framed', 'kipso-themer' ),
                ],
                'default' => 'default',
                'prefix_class' => 'elementor-view-',
            ]
        );

        $this->add_control(
            'shape',
            [
                'label' => __( 'Shape', 'kipso-themer' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'circle' => __( 'Circle', 'kipso-themer' ),
                    'square' => __( 'Square', 'kipso-themer' ),
                ],
                'default' => 'circle',
                'condition' => [
                    'view!' => 'default',
                ],
                'prefix_class' => 'elementor-shape-',
            ]
        );

        $this->add_control(
            'primary_color',
            [
                'label' => __( 'Primary Color', 'kipso-themer' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}}.elementor-view-stacked .elementor-icon' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}}.elementor-view-framed .elementor-icon, {{WRAPPER}}.elementor-view-default .elementor-icon' => 'color: {{VALUE}}; border-color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_color',
            [
                'label'     => __('Icon Color', 'kipso-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .gva-information .information-item .info-icon .elementor-icon' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_control(
            'icon_size',
            [
                'label'      => __('Icon Font Size', 'kipso-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size'  => 15,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-information .information-item .info-icon .elementor-icon' => 'font-size: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_control(
            'icon_box_size',
            [
                'label'      => __('Icon Box Size', 'kipso-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 30,
                        'max' => 200,
                    ],
                ],
                'default'   => [
                    'size'  => 40,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-information .information-item .info-icon .elementor-icon' => 'width: {{SIZE}}{{UNIT}};height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );
        $this->add_control(
            'icon_line_height',
            [
                'label'      => __('Icon Line Height', 'kipso-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 10,
                        'max' => 200,
                    ],
                ],
                'default'   => [
                    'size'  => 35,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-information .information-item .info-icon .elementor-icon' => 'line-height: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'view!' => 'default',
                ],
            ]
        );
        $this->add_control(
            'icon_space',
            [
                'label'      => __('Icon Space', 'kipso-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 6,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size'  => 15,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-information .information-item .info-icon' => 'padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();

        // Title Styling
        $this->start_controls_section(
            'section_title_styling',
            [
                'label' => __('Title', 'kipso-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_control(
            'title_color',
            [
                'label'     => __('Title Color', 'kipso-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .gva-information .information-item .info-content .title' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title_typography',
                'selector' => '{{WRAPPER}} .gva-information .information-item .info-content .title',
            ]
        );
        $this->add_control(
            'title_space',
            [
                'label'      => __('Title Space', 'kipso-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size'  => 2,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-information .information-item .info-content .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->end_controls_section();


        // Content Styling
        $this->start_controls_section(
            'section_content_styling',
            [
                'label' => __('Content', 'kipso-themer'),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'content_color',
            [
                'label'     => __('Content Color', 'kipso-themer'),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .gva-information .information-item .info-content .content' => 'color: {{VALUE}};',
                ],
            ]
        );
         $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'content_typography',
                'selector' => '{{WRAPPER}} .gva-information .information-item .info-content .content',
            ]
        );
        $this->add_control(
            'content_space',
            [
                'label'      => __('Content Space', 'kipso-themer'),
                'type'       => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range'      => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'default'   => [
                    'size'  => 5,
                ],
                'selectors'  => [
                    '{{WRAPPER}} .gva-information .information-item .info-content .content' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
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
        if( !empty($settings['layout']) ){
            include $this->get_template('information/' . $settings['layout'] . '.php');
        }
      print '</div>';
    }

}
