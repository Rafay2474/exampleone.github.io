<?php
namespace BdevsElement\Widget;

use \Elementor\Group_Control_Background;
use \Elementor\Group_Control_Css_Filter;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Slider extends BDevs_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @since 1.0.1
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'slider';
    }


    /**
     * Get widget title.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget title.
     */
    public function get_title() {
        return __( 'Slider', 'bdevs-element' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net//widgets/slider/';
    }

    /**
     * Get widget icon.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget icon.
     */
    public function get_icon() {
        return 'eicon-slider-full-screen';
    }

    public function get_keywords() {
        return [ 'slider', 'image', 'gallery', 'carousel' ];
    }

    protected function register_content_controls() {


        // Background Overlay
        $this->start_controls_section(
            '_section_background_overlay',
            [
                'label' => __( 'Background Overlay', 'elementor' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1','style_2'],
                ], 
            ]
        );
        
        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            [
                'name' => 'background',
                'label' => __( 'Background', 'bdevs-element' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .elementor-background-overlay,{{WRAPPER}} .slider__content-2::before',
            ]
        );

        $this->add_control(
            'background_overlay_opacity',
            [
                'label' => __( 'Opacity', 'elementor' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => .5,
                ],
                'range' => [
                    'px' => [
                        'max' => 1,
                        'step' => 0.01,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}}  .elementor-background-overlay,{{WRAPPER}} .slider__content-2::before' => 'opacity: {{SIZE}};',
                ]
            ]
        );

        $this->end_controls_section();


        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Slides', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'bdevs-element' ),
                    'style_2' => __( 'Style 2', 'bdevs-element' ),
                    'style_3' => __( 'Style 3', 'bdevs-element' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );


        // $this->add_group_control(
        //     \Elementor\Group_Control_Background::get_type(),
        //     [
        //         'name' => 'background',
        //         'label' => __( 'Background', 'bdevs-element' ),
        //         'types' => [ 'classic', 'gradient' ],
        //         'selector' => '{{WRAPPER}} .single-slider::before',
        //     ]
        // );

        $repeater = new Repeater();

        $repeater->add_control(
            'field_condition',
            [
                'label' => __( 'Field condition', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Style 1', 'bdevs-element' ),
                    'style_2' => __( 'Style 2', 'bdevs-element' ),
                    'style_3' => __( 'Style 3', 'bdevs-element' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'slider_item_style',
            [
                'label' => __( 'Slider Style', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __( 'Content Left', 'bdevs-element' ),
                    'style_2' => __( 'Content Center', 'bdevs-element' ),
                    'style_3' => __( 'Content Right', 'bdevs-element' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'condition' => [
                    'field_condition' => ['style_2'],
                ], 
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );   

        $repeater->add_control(
            'image_two',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image Two', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_3'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );   

        $repeater->add_control(
            'image_three',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image Three', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_3'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );         

        $repeater->add_control(
            'image_four',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image Four', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_3'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );    

        $repeater->add_control(
            'subtitle',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Sub Title', 'bdevs-element' ),
                'default' => __( 'Subtitle', 'bdevs-element' ),
                'placeholder' => __( 'Type subtitle here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_1','style_2','style_3'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                    

        $repeater->add_control(
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'bdevs-element' ),
                'default' => __( 'Title Here', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'desc',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Description', 'bdevs-element' ),
                'default' => __( 'Here content', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'video_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Video URL', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'url here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_1'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        //button two
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Text', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'condition' => [
                    'field_condition' => ['style_1','style_2','style_3'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'condition' => [
                    'field_condition' => ['style_1','style_2','style_3'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $repeater->add_control(
                'button_icon',
                [
                    'label' => __( 'Icon', 'bdevs-element' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-angle-right',
                ]
            );

            $condition = ['button_icon!' => ''];
        } else {
            $repeater->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $repeater->add_control(
            'button_icon_position',
            [
                'label' => __( 'Icon Position', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __( 'Before', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __( 'After', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'before',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'button_icon_spacing',
            [
                'label' => __( 'Icon Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn--icon-before .bdevs-btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-btn--icon-after .bdevs-btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default' => [
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ],
                    [
                        'image' => [
                            'url' => Utils::get_placeholder_image_src(),
                        ],
                    ]
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'before',
                'exclude' => [
                    'custom'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Settings', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'animation_speed',
            [
                'label' => __( 'Animation Speed', 'bdevs-element' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 10,
                'max' => 10000,
                'default' => 300,
                'description' => __( 'Slide speed in milliseconds', 'bdevs-element' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay',
            [
                'label' => __( 'Autoplay?', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'autoplay_speed',
            [
                'label' => __( 'Autoplay Speed', 'bdevs-element' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 100,
                'step' => 100,
                'max' => 10000,
                'default' => 3000,
                'description' => __( 'Autoplay speed in milliseconds', 'bdevs-element' ),
                'condition' => [
                    'autoplay' => 'yes'
                ],
                'frontend_available' => true,
            ]
        );        

        $this->add_control(
            'slidetoshow',
            [
                'label' => __( 'Slide to Show', 'bdevs-element' ),
                'type' => Controls_Manager::NUMBER,
                'min' => 1,
                'step' => 1,
                'max' => 12,
                'default' => 1,
                'description' => __( 'How many item you want to show?', 'bdevs-element' ),
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'loop',
            [
                'label' => __( 'Infinite Loop?', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'default' => 'yes',
                'frontend_available' => true,
            ]
        );

        $this->add_control(
            'vertical',
            [
                'label' => __( 'Vertical Mode?', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'navigation',
            [
                'label' => __( 'Navigation', 'bdevs-element' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'none' => __( 'None', 'bdevs-element' ),
                    'arrow' => __( 'Arrow', 'bdevs-element' ),
                    'dots' => __( 'Dots', 'bdevs-element' ),
                    'both' => __( 'Arrow & Dots', 'bdevs-element' ),
                ],
                'default' => 'arrow',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'slide_button',
            [
                'label' => __( 'Button ON/OFF', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'default' => 'yes',
                'return_value' => 'yes',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();


    }

    protected function register_style_controls() {
        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Slide Content', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'content_padding',
            [
                'label' => __( 'Content Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .single-slide-content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_background',
                'selector' => '{{WRAPPER}} .single-slide-content',
                'exclude' => [
                    'image'
                ]
            ]
        );

        $this->add_control(
            '_heading_title',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Title', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'title_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .title',
                'scheme' => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_control(
            '_heading_subtitle',
            [
                'type' => Controls_Manager::HEADING,
                'label' => __( 'Subtitle', 'bdevs-element' ),
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'subtitle_spacing',
            [
                'label' => __( 'Bottom Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .sub-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .sub-title',
                'scheme' => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_arrow',
            [
                'label' => __( 'Navigation - Arrow', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            'arrow_position_toggle',
            [
                'label' => __( 'Position', 'bdevs-element' ),
                'type' => Controls_Manager::POPOVER_TOGGLE,
                'label_off' => __( 'None', 'bdevs-element' ),
                'label_on' => __( 'Custom', 'bdevs-element' ),
                'return_value' => 'yes',
            ]
        );

        $this->start_popover();

        $this->add_responsive_control(
            'arrow_position_y',
            [
                'label' => __( 'Vertical', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'top: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'arrow_position_x',
            [
                'label' => __( 'Horizontal', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'condition' => [
                    'arrow_position_toggle' => 'yes'
                ],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 250,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev' => 'left: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .slick-next' => 'right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_popover();

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'arrow_border',
                'selector' => '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next',
            ]
        );

        $this->add_responsive_control(
            'arrow_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}}; overflow: hidden;',
                ],
            ]
        );

        $this->start_controls_tabs( '_tabs_arrow' );

        $this->start_controls_tab(
            '_tab_arrow_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'arrow_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev, {{WRAPPER}} .slick-next' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_arrow_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'arrow_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'arrow_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'arrow_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-prev:hover, {{WRAPPER}} .slick-next:hover' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_style_dots',
            [
                'label' => __( 'Navigation - Dots', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'dots_nav_position_y',
            [
                'label' => __( 'Vertical Position', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'range' => [
                    'px' => [
                        'min' => -100,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_spacing',
            [
                'label' => __( 'Spacing', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => ['px'],
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li' => 'margin-right: calc({{SIZE}}{{UNIT}} / 2); margin-left: calc({{SIZE}}{{UNIT}} / 2);',
                ],
            ]
        );

        $this->add_responsive_control(
            'dots_nav_align',
            [
                'label' => __( 'Alignment', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bdevs-element' ),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}}'
                ]
            ]
        );

        $this->start_controls_tabs( '_tabs_dots' );
        $this->start_controls_tab(
            '_tab_dots_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'dots_nav_color',
            [
                'label' => __( 'Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'dots_nav_hover_color',
            [
                'label' => __( 'Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots li button:hover' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_dots_active',
            [
                'label' => __( 'Active', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'dots_nav_active_color',
            [
                'label' => __( 'Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .slick-dots .slick-active button' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $slider_autoplay = ( $settings['autoplay'] == 'yes' ) ? true : false;
        $slider_playspeed =  $settings['autoplay_speed'] ? $settings['autoplay_speed'] : '3000';
        $animation_speed =  $settings['animation_speed'] ? $settings['animation_speed'] : '300';
        $slider_slideshow =  $settings['slidetoshow'] ? $settings['slidetoshow'] : '1';
        $slider_infinite = ( $settings['loop'] == 'yes' ) ? true : false;

        switch ( $settings['navigation'] ) {
            case 'none':
                $slider_arrows = false;
                $slider_dots = false;
                break;
            case 'arrow':
                $slider_arrows = true;
                $slider_dots = false;
                break;
            case 'dots':
                $slider_arrows = false;
                $slider_dots = true;
                break;
            case 'both':
                $slider_arrows = true;
                $slider_dots = true;
                break;
        }


        $slider_settings = array( 
            'autoplay' =>  $slider_autoplay, 
            'arrows' => $slider_arrows, 
            'speed' => $animation_speed, 
            'dots' => $slider_dots,  
            'playspeed' => $slider_playspeed,  
            'slideshow' => $slider_slideshow, 
            'infinite' => $slider_infinite,  
        );


        if ( empty( $settings['slides'] ) ) {
            return;
        }

        $this->add_render_attribute( 'button_no_icon', 'class', 'custom_btn bg_default_orange btn-no-icon wow fadeInUp22' );

        ?>

        <?php if ( $settings['design_style'] === 'style_3' ):

        $this->add_render_attribute( 'button', 'class', 'z-btn z-btn-border' );
        
        ?>

        <section class="hero__area p-relative slider-settings"
                 data-settings='<?php print json_encode($slider_settings); ?>'>
            <div class="hero__shape">
                <img class="one" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/03/icon-1.png" alt="img">
                <img class="two" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/03/icon-2.png" alt="img">
                <img class="three" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/03/icon-3.png" alt="img">
                <img class="four" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/03/icon-4.png" alt="img">
                <img class="five" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/03/icon-6.png" alt="img">
                <img class="six" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/03/icon-7.png" alt="img">
            </div>

            <?php foreach ( $settings['slides'] as $key => $slide ) :
            $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
            if ( ! $image ) {
                $image = $slide['image']['url'];
            }

            $image_two = wp_get_attachment_image_url( $slide['image_two']['id'], $settings['thumbnail_size'] );
            if ( ! $image_two ) {
                $image_two = $slide['image_two']['url'];
            }

            $image_three = wp_get_attachment_image_url( $slide['image_three']['id'], $settings['thumbnail_size'] );
            if ( ! $image_three ) {
                $image_three = $slide['image_three']['url'];
            }

            $image_four = wp_get_attachment_image_url( $slide['image_four']['id'], $settings['thumbnail_size'] );
            if ( ! $image_four ) {
                $image_four = $slide['image_four']['url'];
            }
            
            ?>
            <div class="hero__item hero__height d-flex align-items-center">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-6 col-lg-5 order-last">
                            <div class="hero__thumb-wrapper ml-100 scene ">
                                <?php if( !empty($image) ): ?>
                                <div class="hero__thumb one">
                                    <img class="layers" data-depth="0.2" src="<?php print esc_url($image); ?>" alt="img">
                                </div>
                                <?php endif; ?>
                                <?php if( !empty($image_two) ): ?>
                                <div class="hero__thumb two d-none d-md-block d-lg-none d-xl-block">
                                    <img class="layers" data-depth="0.3" src="<?php print esc_url($image_two); ?>" alt="img">
                                </div>
                                <?php endif; ?>
                                <?php if( !empty($image_three) ): ?>
                                <div class="hero__thumb three d-none d-sm-block">
                                    <img class="layers" data-depth="0.4" src="<?php print esc_url($image_three); ?>" alt="img">
                                </div>
                                <?php endif; ?>
                                <?php if( !empty($image_four) ): ?>    
                                <div class="hero__thumb four d-none d-md-block d-lg-none d-xl-block">
                                    <img class="layers" data-depth="0.5" src="<?php print esc_url($image_four); ?>" alt="img">
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                        <div class="col-xl-6 col-lg-7 d-flex align-items-center">
                            <div class="hero__content">
                                <?php if( !empty($slide['subtitle']) ): ?>
                                <span class="wow fadeInUp2" data-wow-delay=".2s"><?php echo bdevs_element_kses_basic( $slide['subtitle'] ); ?></span>
                                <?php endif; ?>

                                <?php if ( !empty($slide['title']) ) : ?>
                                <h1 class="wow fadeInUp2" data-wow-delay=".4s"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h1>
                                <?php endif; ?>

                                <?php if ( !empty($slide['desc']) ) : ?>
                                <p class="wow fadeInUp2" data-wow-delay=".6s"><?php echo bdevs_element_kses_intermediate( $slide['desc'] ); ?></p>
                                <?php endif; 
                                    if(!empty($settings['slide_button'])) :
                                ?>
                                <div class="slide-btn wow fadeInUp2" data-wow-delay=".8s">
                                    <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                            printf( '<a %1$s href="%3$s">%2$s</a>',
                                                $this->get_render_attribute_string( 'button' ),
                                                esc_html( $slide['button_text'] ),
                                                esc_url($slide['button_link']['url'])
                                                );
                                        elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                            <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                        <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                            if ( $slide['button_icon_position'] === 'before' ): ?>
                                                <a <?php $this->print_render_attribute_string( 'button' ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                <?php
                                            else: ?>
                                                <a <?php $this->print_render_attribute_string( 'button' ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                            <?php
                                            endif;
                                    endif; ?> 
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php endforeach; ?>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_2' ): 

        $this->add_render_attribute( 'button', 'class', 'z-btn z-btn-transparent' );
        
        ?>

            <section class="slider__area slider__area-2  slider-settings" data-settings='<?php print json_encode($slider_settings); ?>'>
                <div class="slider-active">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = $slide['image']['url'];
                        } 

                        $this->add_render_attribute( 'button_'. $key, 'class', 'z-btn z-btn-transparent' );
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    ?>

                    <div class="single-slider single-slider-2 slider__height slider__height-2 d-flex align-items-center" data-background="<?php print esc_url($image); ?>">
                        <div class="container">
                            <div class="row">
                                <?php if ( $slide['slider_item_style'] === 'style_2' ): ?>
                                <div class="col-xl-8 offset-xl-2 col-lg-8 offset-lg-2 col-md-9 offset-md-3 col-sm-10 offset-sm-2">
                                    <div class="slider__content slider__content-2 slider__content-3 text-center">
                                        <?php if( $slide['title'] ): ?>
                                        <h1 data-animation="fadeInUp2" data-delay=".5s">
                                            <?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h1>
                                        <?php endif; ?> 
                                        <?php if ( $slide['desc'] ) : ?>
                                        <p data-animation="fadeInUp2" data-delay=".7s">
                                            <?php echo bdevs_element_kses_intermediate( $slide['desc'] ); ?>
                                        </p>
                                        <?php endif; 
                                            if(!empty($settings['slide_button'])) :
                                        ?>

                                        <div class="slider__btn" data-animation="fadeInUp2" data-delay=".9s">
                                            <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                    printf( '<a %1$s>%2$s</a>',
                                                        $this->get_render_attribute_string( 'button_'. $key ),
                                                        esc_html( $slide['button_text'] )
                                                        );
                                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                        <?php
                                                    else: ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                    <?php
                                                    endif;
                                            endif; ?> 
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php elseif ( $slide['slider_item_style'] === 'style_3' ): ?>
                                <div class="col-xl-7 offset-xl-6 col-lg-8 offset-lg-4 col-md-9 offset-md-3 col-sm-10 offset-sm-2">
                                    <div class="slider__content slider__content-2">
                                        <?php if( $slide['title'] ): ?>
                                        <h1 data-animation="fadeInUp2" data-delay=".5s">
                                            <?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h1>
                                        <?php endif; ?> 
                                        <?php if ( $slide['desc'] ) : ?>
                                        <p data-animation="fadeInUp2" data-delay=".7s">
                                            <?php echo bdevs_element_kses_intermediate( $slide['desc'] ); ?>
                                        </p>
                                        <?php endif;
                                            if(!empty($settings['slide_button'])) :
                                        ?>
                                        <div class="slider__btn" data-animation="fadeInUp2" data-delay=".9s">
                                            <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                    printf( '<a %1$s>%2$s</a>',
                                                        $this->get_render_attribute_string( 'button_'. $key ),
                                                        esc_html( $slide['button_text'] )
                                                        );
                                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                        <?php
                                                    else: ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                    <?php
                                                    endif;
                                            endif; ?> 
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php else: ?>
                                <div class="col-xl-6">
                                    <div class="slider__content slider__content-2 slider__content-4">
                                        <?php if( $slide['subtitle'] ): ?>
                                        <span data-animation="fadeInUp2" data-delay=".3s"><?php echo bdevs_element_kses_basic( $slide['subtitle'] ); ?></span>
                                        <?php endif; ?> 
                                        <?php if( $slide['title'] ): ?>
                                        <h1 data-animation="fadeInUp2" data-delay=".5s">
                                            <?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h1>
                                        <?php endif; ?> 
                                        <?php if ( $slide['desc'] ) : ?>
                                        <p data-animation="fadeInUp2" data-delay=".7s">
                                            <?php echo bdevs_element_kses_intermediate( $slide['desc'] ); ?>
                                        </p>
                                        <?php endif; 
                                            if(!empty($settings['slide_button'])) :
                                        ?>
                                        <div class="slider__btn" data-animation="fadeInUp2" data-delay=".9s">
                                            <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                    printf( '<a %1$s>%2$s</a>',
                                                        $this->get_render_attribute_string( 'button_'. $key ),
                                                        esc_html( $slide['button_text'] )
                                                        );
                                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                        <?php
                                                    else: ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                    <?php
                                                    endif;
                                            endif; ?> 
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>

                    <?php endforeach; ?>    
                </div>
            </section>

        <?php else: 
        ?>

            <section class="slider__area slider__area-1 position-relative  slider-settings"
                     data-settings='<?php print json_encode($slider_settings); ?>'>
                <div class="slider-active slider-active-dot-none">
                    <?php foreach ( $settings['slides'] as $key => $slide ) :
                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                        if ( ! $image ) {
                            $image = $slide['image']['url'];
                        }
                        $this->add_render_attribute( 'button_'. $key, 'class', 'z-btn z-btn-transparent' );
                        $this->add_render_attribute( 'button_'. $key, 'href', $slide['button_link']['url'] );
                    ?>
                    <div class="single-slider slider__height d-flex align-items-center" data-background="<?php print esc_url($image); ?>">
                        <?php if ( $settings['background_overlay_opacity']) : ?>
                         <div class="elementor-background-overlay"></div>
                        <?php endif;?>
                        
                        <div class="slider__shape">
                            <img class="shape triangle" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/triangle.png" alt="triangle">
                            <img class="shape dotted-square" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/dotted-square.png" alt="dotted-square">
                            <img class="shape solid-square" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/solid-square.png" alt="solid-square">
                            <img class="shape circle" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/slider/circle.png" alt="circle">
                        </div>
                        <div class="container">
                            <div class="row">
                                <div class="col-xl-9 col-lg-9 col-md-10 col-sm-10">
                                    <div class="slider__content">
                                        <?php if( !empty($slide['subtitle']) ): ?>
                                        <span data-animation="fadeInUp2" data-delay=".3s"><?php echo bdevs_element_kses_basic( $slide['subtitle'] ); ?></span>
                                        <?php endif; ?>
                                        <?php if ( !empty($slide['title']) ) : ?>
                                        <h1 data-animation="fadeInUp2" data-delay=".5s"><?php echo bdevs_element_kses_basic( $slide['title'] ); ?></h1>
                                        <?php endif; ?>
                                        <?php if ( !empty($slide['desc']) ) : ?>
                                        <p class="decoration_text" data-animation="fadeInUp2" data-delay=".8s"><?php echo bdevs_element_kses_intermediate( $slide['desc'] ); ?></p>
                                        <?php endif; 
                                        if(!empty($settings['slide_button'])) :
                                        ?>

                                        <div class="slider__btn" data-animation="fadeInUp2" data-delay=".7s">
                                            <?php if ( $slide['button_text'] && ( ( empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) && empty( $slide['button_icon'] ) ) ) :
                                                    printf( '<a %1$s>%2$s</a>',
                                                        $this->get_render_attribute_string( 'button_'. $key ),
                                                        esc_html( $slide['button_text'] )
                                                        );
                                                elseif ( empty( $slide['button_text'] ) && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty( $slide['button_icon'] ) ) ) : ?>
                                                    <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon' ); ?></a>
                                                <?php elseif ( $slide['button_text'] && ( ( !empty( $slide['button_selected_icon'] ) || empty( $slide['button_selected_icon']['value'] ) ) || !empty($slide['button_icon']) ) ) :
                                                    if ( $slide['button_icon_position'] === 'before' ): ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span> <?php echo esc_html($slide['button_text']); ?></a>
                                                        <?php
                                                    else: ?>
                                                        <a <?php $this->print_render_attribute_string( 'button_'. $key ); ?>><?php echo esc_html($slide['button_text']); ?> <span><?php bdevs_element_render_icon( $slide, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] ); ?></span></a>
                                                    <?php
                                                    endif;
                                            endif; ?> 
                                        </div>
                                        <?php endif; ?>
                                    </div>
                                </div>
                                <?php if( !empty($slide['video_url']) ): ?>
                                <div class="col-xl-3 col-lg-3 col-md-2 col-sm-2">
                                    <div class="slider__play" data-animation="fadeInRight" data-delay=".9s">
                                        <a href="<?php echo esc_url( $slide['video_url'] ); ?>" class="slider__play-btn" data-fancybox><i class="fal fa-play"></i></a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
                </div>
            </section>

        <?php endif; ?>

    <?php
    }
}
