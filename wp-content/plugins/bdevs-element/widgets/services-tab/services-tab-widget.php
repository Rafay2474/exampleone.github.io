<?php
namespace BdevsElement\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Image_Size;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Services_Tab extends BDevs_El_Widget {

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @since 1.0.0
     * @access public
     *
     * @return string Widget name.
     */
    public function get_name() {
        return 'services-tab';
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
        return __( 'Services Tab', 'bdevs-element' );
    }

	public function get_custom_help_url() {
		return 'http://elementor.bdevs.net//widgets/contact-7-form/';
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
        return 'eicon-favorite';
    }

    public function get_keywords() {
        return [ 'services', 'tab' ];
    }

	protected function register_content_controls() {

        $this->start_controls_section(
            '_section_design_title',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
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
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'slider_active',
            [
                'label' => __( 'Slider active on/off', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'default' =>true,
                'condition' => [
                    'design_style' => ['style_3']
                ],
            ]
        );

        $this->end_controls_section();

        // section title
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_3']
                ],
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __( 'Sub Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'bdevs Info Box Sub Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Info Box Sub Title', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __( 'Title', 'bdevs-element' ),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => __( 'bdevs Info Box Title', 'bdevs-element' ),
                'placeholder' => __( 'Type Info Box Title', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __( 'Description', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'bdevs info box description goes here', 'bdevs-element' ),
                'placeholder' => __( 'Type info box description', 'bdevs-element' ),
                'rows' => 5,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'sort_description',
            [
                'label' => __( 'Sort Description', 'bdevs-element' ),
                'description' => bdevs_element_get_allowed_html_desc( 'intermediate' ),
                'type' => Controls_Manager::TEXTAREA,
                'default' => __( 'bdevs info box sort description goes here', 'bdevs-element' ),
                'placeholder' => __( 'Type info box sort description', 'bdevs-element' ),
                'rows' => 5,
                'condition' => [
                    'design_style' => 'style_1'
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_control(
            'title_tag',
            [
                'label' => __( 'Title HTML Tag', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'h1'  => [
                        'title' => __( 'H1', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h1'
                    ],
                    'h2'  => [
                        'title' => __( 'H2', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h2'
                    ],
                    'h3'  => [
                        'title' => __( 'H3', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h3'
                    ],
                    'h4'  => [
                        'title' => __( 'H4', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h4'
                    ],
                    'h5'  => [
                        'title' => __( 'H5', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h5'
                    ],
                    'h6'  => [
                        'title' => __( 'H6', 'bdevs-element' ),
                        'icon' => 'eicon-editor-h6'
                    ]
                ],
                'default' => 'h2',
                'toggle' => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __( 'Alignment', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'bdevs-element' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-element' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'bdevs-element' ),
                        'icon' => 'fa fa-align-right',
                    ],
                ],
                'toggle' => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};'
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
            'type',
            [
                'label' => __( 'Media Type', 'bdevs-element' ),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'icon' => [
                        'title' => __( 'Icon', 'bdevs-element' ),
                        'icon' => 'fa fa-smile-o',
                    ],
                    'image' => [
                        'title' => __( 'Image', 'bdevs-element' ),
                        'icon' => 'fa fa-image',
                    ],
                ],
                'default' => 'icon',
                'condition' => [
                    'field_condition' => ['style_1','style_2'],
                ], 
                'toggle' => false,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'type' => 'image',
                ],

                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'medium_large',
                'separator' => 'none',
                'exclude' => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail'
                ],
                'condition' => [
                    'type' => 'image'
                ]
            ]
        );        

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $repeater->add_control(
                'icon',
                [
                    'label' => __( 'Icon', 'bdevs-element' ),
                    'label_block' => true,
                    'type' => Controls_Manager::ICON,
                    'options' => bdevs_element_get_bdevs_element_icons(),
                    'default' => 'fa fa-smile-o',
                    'condition' => [
                        'type' => 'icon',
                    ]
                ]
            );
        } 
        else {
            $repeater->add_control(
                'selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'icon',
                    'label_block' => true,
                    'default' => [
                        'value' => 'fas fa-smile-wink',
                        'library' => 'fa-solid',
                    ],
                    'condition' => [
                        'type' => 'icon',
                    ]
                ]
            );
        }  

        $repeater->add_control(
            'tab_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'BG Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_1','style_2'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                 

        $repeater->add_control(
            'tab_menu_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Tab Menu Title', 'bdevs-element' ),
                'default' => __( 'Tab Menu Title', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );         

        $repeater->add_control(
            'tab_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Tab Title', 'bdevs-element' ),
                'default' => __( 'Tab Title', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );     

        $repeater->add_control(
            'tab_content',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Tab Content', 'bdevs-element' ),
                'default' => __( 'Content Here', 'bdevs-element' ),
                'placeholder' => __( 'Type subtitle here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'tab_content_list',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Tab Content List', 'bdevs-element' ),
                'default' => __( 'Content Here', 'bdevs-element' ),
                'placeholder' => __( 'Type content here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_2'],
                ], 
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        // Button
        $repeater->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Learn More',
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'button_url',
            [
                'label' => __( 'Button URL', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => '#',
                'placeholder' => __( 'button url', 'bdevs-element' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );



        // REPEATER
        $this->add_control(
            'slides',
            [
                'show_label' => false,
                'type' => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '<# print(tab_title || "Carousel Item"); #>',
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
                ]
            ]
        );

        $this->end_controls_section();

    }




    // register_style_controls

    protected function register_style_controls() {
        $this->start_controls_section(
            '_section_fields_style',
            [
                'label' => __( 'Form Fields', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'field_width',
            [
                'label' => __( 'Width', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => '%',
                ],
                'tablet_default' => [
                    'unit' => '%',
                ],
                'mobile_default' => [
                    'unit' => '%',
                ],
                'size_units' => [ '%', 'px' ],
                'range' => [
                    '%' => [
                        'min' => 1,
                        'max' => 100,
                    ],
                    'px' => [
                        'min' => 1,
                        'max' => 500,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'width: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .bdevs-cf7-form label' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_margin',
            [
                'label' => __( 'Spacing Bottom', 'bdevs-element' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'field_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'field_typography',
                'label' => __( 'Typography', 'bdevs-element' ),
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
                'scheme' => Typography::TYPOGRAPHY_3
            ]
        );

        $this->add_control(
            'field_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_control(
            'field_placeholder_color',
            [
                'label' => __( 'Placeholder Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} ::-webkit-input-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-moz-placeholder' => 'color: {{VALUE}};',
                    '{{WRAPPER}} ::-ms-input-placeholder' => 'color: {{VALUE}};',
                ],
            ]
		);

		$this->start_controls_tabs( 'tabs_field_state' );

        $this->start_controls_tab(
            'tab_field_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_border',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );

		$this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)',
            ]
        );

        $this->add_control(
            'field_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit)' => 'background-color: {{VALUE}}',
                ],
            ]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
            'tab_field_focus',
            [
                'label' => __( 'Focus', 'bdevs-element' ),
            ]
		);

		$this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'field_focus_border',
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'field_focus_box_shadow',
                'exclude' => [
                    'box_shadow_position',
                ],
                'selector' => '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus',
            ]
		);

		$this->add_control(
            'field_focus_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-form-control:not(.wpcf7-submit):focus' => 'background-color: {{VALUE}}',
                ],
            ]
        );

		$this->end_controls_tab();
		$this->end_controls_tabs();

		$this->end_controls_section();

        $this->start_controls_section(
            'submit',
            [
                'label' => __( 'Submit Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'submit_margin',
            [
                'label' => __( 'Margin', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'submit_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'submit_typography',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
                'scheme' => Typography::TYPOGRAPHY_4
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'submit_border',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_control(
            'submit_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'submit_box_shadow',
                'selector' => '{{WRAPPER}} .wpcf7-submit',
            ]
        );

        $this->add_control(
            'hr4',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( 'tabs_button_style' );

        $this->start_controls_tab(
            'tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'submit_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_button_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'submit_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'submit_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .wpcf7-submit:hover, {{WRAPPER}} .wpcf7-submit:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();
    }

    protected function render() {

        $settings = $this->get_settings_for_display(); 
        $this->add_render_attribute( 'title_2', 'class', 'section-title' );
        $title = bdevs_element_kses_basic( $settings['title' ] );

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        ?>


        <?php if ( $settings['design_style'] === 'style_1' ) : 
            // section_bg_image
            if (!empty($settings['section_bg_image']['id'])) {
                $section_bg_image = wp_get_attachment_image_url( $settings['section_bg_image']['id'], 'full' );
                if ( ! $section_bg_image ) {
                    $section_bg_image = $settings['section_bg_image']['url'];
                } 
             } 
        ?>

        <section class="expart__area wow fadeInUp2" data-wow-delay=".4s">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="expart__wrapper">
                            <div class="expart__nav">
                                <ul class="nav nav-pills justify-content-end" id="expart-tab" role="tablist">
                                    <?php foreach ( $settings['slides'] as $id => $slide ) :
                                        // img 
                                        $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                                        if ( ! $tab_image ) {
                                            $tab_image = $slide['tab_image']['url'];
                                        }

                                        // active class
                                        $active_tab = ($id == 0) ? 'active show' : '';      
                                    ?>
                                    <li class="nav-item text-center">
                                        <a class="nav-link <?php echo esc_attr($active_tab); ?>" id="philosophy-tab-<?php echo esc_attr($id); ?>" data-toggle="pill" href="#philosophy-<?php echo esc_attr($id); ?>" role="tab"><?php echo bdevs_element_kses_basic( $slide['tab_menu_title'] ); ?></a>
                                    </li>
                                    <?php endforeach; ?>
                                </ul>      
                            </div>
                            <div class="expart__tab">
                                <div class="tab-content" id="expart-Content">
                                    <?php foreach ( $settings['slides'] as $id => $slide ) :

                                        // img 
                                        $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                                        if ( ! $tab_image ) {
                                            $tab_image = $slide['tab_image']['url'];
                                        }

                                        // active class
                                        $active_tab = ($id == 0) ? 'active show' : '';      
                                    ?>
                                    <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="philosophy-<?php echo esc_attr($id); ?>">
                                        <div class="expart__tab-content white-bg">
                                            <?php if ( !empty( $tab_image ) ) : ?>
                                            <div class="expart__thumb" data-background="<?php print esc_url($tab_image); ?>"></div>
                                            <?php endif; ?>
                                            <div class="row">
                                                <div class="col-xl-6 col-lg-6 offset-lg-6">
                                                    <div class="expart__content">
                                                        <?php if ( !empty( !empty($slide['tab_title']) ) ) : ?>
                                                        <h3><?php echo bdevs_element_kses_basic( $slide['tab_title'] ); ?></h3>
                                                        <?php endif; ?>

                                                        <?php if ( !empty( !empty($slide['tab_content']) ) ) : ?>
                                                        <p><?php echo bdevs_element_kses_basic( $slide['tab_content'] ); ?></p>
                                                        <?php endif; ?>

                                                        <?php if ( !empty( !empty($slide['button_url']) ) ) : ?>
                                                        <a href="<?php echo esc_url( $slide['button_url'] ); ?>" class="z-btn"><?php echo esc_html( $slide['button_text'] ); ?></a>
                                                        <?php endif; ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <?php endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_2' ) : 
            // section_bg_image
            if (!empty($settings['section_bg_image']['id'])) {
                $section_bg_image = wp_get_attachment_image_url( $settings['section_bg_image']['id'], 'full' );
                if ( ! $section_bg_image ) {
                    $section_bg_image = $settings['section_bg_image']['url'];
                } 
             } 
        ?>

        <section class="services__area-3">
            <div class="container">
                <div class="row">
                    <div class="col-xl-12">
                        <div class="services__nav wow fadeInUp2" data-wow-delay=".4s">
                            <ul class="nav nav-pills " id="services-tab" role="tablist">
                                <?php foreach ( $settings['slides'] as $id => $slide ) :
                                    
                                    // img 
                                    $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                                    if ( ! $tab_image ) {
                                        $tab_image = $slide['tab_image']['url'];
                                    }

                                    if ( !empty($slide['image']['id']) ) {
                                        $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                                        if ( ! $image ) {
                                            $image = $slide['image']['url'];
                                        }
                                    }

                                    // active class
                                    $active_tab = ($id == 0) ? 'active show' : '';      
                                ?>
                                <li class="nav-item mb-45">
                                    <a class="nav-link <?php echo esc_attr($active_tab); ?>" id="sshare-<?php echo esc_attr($id); ?>" data-toggle="pill" href="#share-<?php echo esc_attr($id); ?>" role="tab">
                                    <?php if( !empty($slide['selected_icon']) ): ?>
                                        <?php bdevs_element_render_icon( $slide, 'icon', 'selected_icon', ['class' => 'bdevs-btn-icon'] ); ?>
                                        <?php else: ?>
                                            <img class="rounded-circle" src="<?php echo esc_url($image); ?>" alt="icon" />
                                    <?php endif; ?> 

                                    <?php echo bdevs_element_kses_basic( $slide['tab_menu_title'] ); ?>
                                    </a>
                                </li>
                                <?php endforeach; ?>
                            </ul>
                        </div>
                    </div>
                    <div class="col-xl-12">
                        <div class="services__tab grey-bg-18">
                            <div class="tab-content wow fadeInUp2" data-wow-delay=".6s" id="services-content">
                                <?php foreach ( $settings['slides'] as $id => $slide ) :
                                    // img 
                                    $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                                    if ( ! $tab_image ) {
                                        $tab_image = $slide['tab_image']['url'];
                                    }

                                    // active class
                                    $active_tab = ($id == 0) ? 'active show' : '';      
                                ?>
                                <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="share-<?php echo esc_attr($id); ?>" role="tabpanel">
                                    <div class="services__nav-content pt-90 pb-90">
                                        <div class="row">
                                            <div class="col-xl-5 col-lg-6">
                                                <?php if ( !empty( $tab_image ) ) : ?>
                                                <div class="services__thumb text-lg-right m-img">
                                                    <img src="<?php print esc_url($tab_image); ?>" alt="img">
                                                </div>
                                                <?php endif; ?> 
                                            </div>
                                            <div class="col-xl-7 col-lg-6">
                                                <div class="services__content-3 pl-70 pr-70">
                                                    <?php if ( !empty( !empty($slide['tab_title']) ) ) : ?>
                                                    <h3><?php echo bdevs_element_kses_basic( $slide['tab_title'] ); ?></h3>
                                                    <?php endif; ?>

                                                    <?php if ( !empty( !empty($slide['tab_content']) ) ) : ?>
                                                    <p><?php echo bdevs_element_kses_basic( $slide['tab_content'] ); ?></p>
                                                    <?php endif; ?>

                                                    <div class="services__icon-wrapper d-md-flex mb-35">
                                                    <?php echo bdevs_element_kses_intermediate($slide['tab_content_list']); ?>
                                                    </div>

                                                    <?php if ( !empty( !empty($slide['button_url']) ) ) : ?>
                                                        <a href="<?php echo esc_url( $slide['button_url'] ); ?>" class="z-btn"><?php echo esc_html( $slide['button_text'] ); ?></a>
                                                    <?php endif; ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section> 
        
        <?php elseif ( $settings['design_style'] === 'style_3' ) : 
            $slider_active = !empty($settings['slider_active']) ? 'service-active' : ''; 
        ?>
        <section class="service1">
            <div class="content_box_120_90">
                <div class="container">
                    <div class="row mb-55">
                        <div class="col-md-12">
                            <div class="title_style1 text-center">
                                <?php if ( $settings['sub_title'] ) : ?>
                                    <h5 class="sub-title"><?php echo bdevs_element_kses_intermediate( $settings['sub_title'] ); ?></h5>
                                <?php endif; ?>

                                <?php printf( '<%1$s %2$s>%3$s<span>.</span></%1$s>',
                                    tag_escape( $settings['title_tag'] ),
                                    $this->get_render_attribute_string( 'title' ),
                                    $title
                                ); ?>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <?php foreach ( $settings['slides'] as $id => $slide ) :
                            if (!empty($slide['tab_image']['id'])) {
                                $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                                if ( ! $tab_image ) {
                                    $tab_image_url = $slide['tab_image']['url'];
                                }
                            }
                            
                            // active class
                            $active_tab = ($id == 0) ? 'active show' : '';      
                        ?>
                        <div class="col-xl-3 col-lg-4 col-md-6">
                            <div class="service1__item text-center mb-30">
                                <?php if ( !empty($slide['tab_number']) ) : ?>
                                <span<?php echo bdevs_element_kses_basic( $slide['tab_number'] ); ?> </span>  
                                <?php endif; ?> 
                                <div class="service1__thumb">
                                   <?php if ( $slide['type'] === 'image' && ( $slide['image']['url'] || $slide['image']['id'] ) ) :
                                    $this->get_render_attribute_string( 'image' );
                                    $slide['hover_animation'] = 'disable-animation'; // hack to prevent image hover animation
                                    ?>
                                    <figure>
                                        <?php echo Group_Control_Image_Size::get_attachment_image_html( $slide, 'thumbnail', 'image' ); ?>
                                    </figure>
                                    <?php elseif ( ! empty( $slide['icon'] ) || ! empty( $slide['selected_icon']['value'] ) ) : ?>
                                    <figure>
                                        <?php bdevs_element_render_icon( $slide, 'icon', 'selected_icon' ); ?>
                                    </figure>
                                    <?php endif; ?>
                                </div>
                                <div class="service1__content">
                                    <?php if ( !empty($slide['tab_title']) ) : ?>
                                    <h3><a href="<?php echo esc_url($slide['button_url']); ?>"><?php echo bdevs_element_kses_basic( $slide['tab_title'] ); ?></a></h3>
                                    <?php endif; ?>

                                    <?php if ( !empty($slide['tab_content_info']) ) : ?>
                                    <p><?php echo bdevs_element_kses_basic( $slide['tab_content_info'] ); ?></p>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </section>        

        <?php endif; ?>


        <?php

    }
}