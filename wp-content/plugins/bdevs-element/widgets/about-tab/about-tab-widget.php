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

class about_Tab extends BDevs_El_Widget {

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
        return 'about-tab';
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
        return __( 'About TAB', 'bdevs-element' );
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
        return [ 'about', 'tab' ];
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
                    'style_3' => __( 'Style 3', 'bdevs-element' ),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'shape_switch',
            [
                'label' => __('Shape Show/Hide', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();

        // title
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Description', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label'       => __( 'Sub Title', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXT,
                'default'     => 'Heading Sub Title',
                'placeholder' => __( 'Heading Sub Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => ['style_1', 'style_2'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'rows'        => 4,
                'default'     => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => ['style_1', 'style_2', 'style_3'],
                ],
            ]
        );

        $this->add_control(
            'description',
            [
                'label'       => __( 'Description', 'bdevs-element' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Heading Description Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition'   => [
                    'design_style' => ['style_1', 'style_3'],
                ],
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label'   => __( 'Title HTML Tag', 'bdevs-element' ),
                'type'    => Controls_Manager::CHOOSE,
                'options' => [
                    'h1' => [
                        'title' => __( 'H1', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h1',
                    ],
                    'h2' => [
                        'title' => __( 'H2', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h2',
                    ],
                    'h3' => [
                        'title' => __( 'H3', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h3',
                    ],
                    'h4' => [
                        'title' => __( 'H4', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h4',
                    ],
                    'h5' => [
                        'title' => __( 'H5', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h5',
                    ],
                    'h6' => [
                        'title' => __( 'H6', 'bdevs-element' ),
                        'icon'  => 'eicon-editor-h6',
                    ],
                ],
                'default' => 'h2',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label'     => __( 'Alignment', 'bdevs-element' ),
                'type'      => Controls_Manager::CHOOSE,
                'options'   => [
                    'left'   => [
                        'title' => __( 'Left', 'bdevs-element' ),
                        'icon'  => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'bdevs-element' ),
                        'icon'  => 'fa fa-align-center',
                    ],
                    'right'  => [
                        'title' => __( 'Right', 'bdevs-element' ),
                        'icon'  => 'fa fa-align-right',
                    ],
                ],
                'toggle'    => true,
                'selectors' => [
                    '{{WRAPPER}}' => 'text-align: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();


        // shape
        $this->start_controls_section(
            '_section_about_shape_image',
            [
                'label' => __( 'Shape Image', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2']
                ],
            ]
        );

        $this->add_control(
            'bg_shape_image',
            [
                'label' => __( 'Image', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );         

        $this->add_control(
            'bg_shape_image_2',
            [
                'label' => __( 'Image two', 'bdevs-element' ),
                'type' => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail',
                'default' => 'large',
                'separator' => 'none',
            ]
        );        
        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name' => 'thumbnail2',
                'default' => 'large',
                'separator' => 'none',
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
                    'style_2' => __( 'Style 2', 'bdevs-element' ),                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'tab_bg_color',
            [
                'label' => __( 'Tab BG Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FEC931',
                'frontend_available' => true,
                'selectors' => [
                     '{{WRAPPER}}  {{CURRENT_ITEM}}' => 'background-color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );   

        $repeater->add_control(
            'tab_bg_active_color',
            [
                'label' => __( 'Tab BG Active Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FEC931',
                'frontend_available' => true,
                'selectors' => [
                     '{{WRAPPER}}  {{CURRENT_ITEM}}.active' => 'background-color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        );

        $repeater->add_control(
            'tab_color',
            [
                'label' => __( 'Tab Icon Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FEC931',
                'frontend_available' => true,
                'selectors' => [
                     '{{WRAPPER}}  {{CURRENT_ITEM}} i' => 'color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
            ]
        ); 

        $repeater->add_control(
            'tab_active_color',
            [
                'label' => __( 'Tab Icon Active Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#FEC931',
                'frontend_available' => true,
                'selectors' => [
                     '{{WRAPPER}}  {{CURRENT_ITEM}}.active i' => 'color: {{VALUE}};',
                ],
                'style_transfer' => true,
                'frontend_available' => true,
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
                        'field_condition' => ['style_1']
                    ],
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
                        'field_condition' => ['style_1']
                    ],
                ]
            );
        }


        $repeater->add_control(
            'tab_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'condition' => [
                    'field_condition' => ['style_1']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );          

        $repeater->add_control(
            'tab_content_image',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Content Image', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->add_control(
            'tab_content_image3',
            [
                'type' => Controls_Manager::MEDIA,
                'label' => __( 'Content Image 3', 'bdevs-element' ),
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );  

            
        $repeater->add_control(
            'tab_sub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Tab Sub Title', 'bdevs-element' ),
                'default' => __( 'Tab Sub Title', 'bdevs-element' ),
                'placeholder' => __( 'Type sub title here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_3']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );          

        $repeater->add_control(
            'tab_title',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'label' => __( 'Tab Title', 'bdevs-element' ),
                'default' => __( 'Tab Title', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_1']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );          

        $repeater->add_control(
            'tab_img_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Tab img Title', 'bdevs-element' ),
                'default' => __( 'Tab img Title', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_3']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );            

        $repeater->add_control(
            'tab_img_number',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Number', 'bdevs-element' ),
                'default' => __( '01', 'bdevs-element' ),
                'placeholder' => __( 'Type number here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_3']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'tab_content_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Tab Content Title', 'bdevs-element' ),
                'default' => __( 'Tab Content Title', 'bdevs-element' ),
                'placeholder' => __( 'Type content here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_3']
                ],
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );     

        $repeater->add_control(
            'tab_content_info',
            [
                'type' => Controls_Manager::TEXTAREA,
                'label_block' => true,
                'show_label' => true,
                'default' => __( 'Content Here', 'bdevs-element' ),
                'placeholder' => __( 'Type subtitle here', 'bdevs-element' ),
                'condition' => [
                    'field_condition' => ['style_3']
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
                'condition' => [
                    'field_condition' => ['style_3']
                ],
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
                'condition' => [
                    'field_condition' => ['style_3']
                ],
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

        if ( empty( $settings['slides'] ) ) {
            return;
        }

        ?>
        
        <?php if ( $settings['design_style'] === 'style_1' ) : 
            $this->add_render_attribute( 'title', 'class', 'section__title section__title-2' );
            $title = bdevs_element_kses_basic( $settings['title'] );
        ?>
         <section class="features__area pt-135 pb-120 p-relative">
            <?php if ( !empty($settings['shape_switch']) ): ?>
            <div class="features__shape-2">
               <img class="features-2-dot" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/features/home-2/features-dot.png" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="features-2-dot-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/features/home-2/features-dot-2.png" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="features-2-dot-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/features/home-2/features-dot-3.png" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="features-2-triangle-1" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/features/home-2/features-triangle-1.png" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="features-2-triangle-2" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/features/home-2/features-triangle-2.png" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="features-2-triangle-3" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/features/home-2/features-triangle-3.png" alt="<?php print esc_attr__('image','wetland'); ?>">
            </div>
            <?php endif;?>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3 col-xl-8 offset-xl-2 col-lg-8 offset-lg-2">
                     <div class="section__title-wrapper section__title-wrapper-2 text-center mb-75 wow fadeInUp2" data-wow-delay=".3s">
                        <?php if ( $settings['sub_title'] ): ?>
                            <span class="section__pre-title purple"><?php echo bdevs_element_kses_intermediate( $settings['sub_title'] ); ?></span>
                        <?php endif;?>

                        <?php if (!empty($settings['title'])) : ?>
                        <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'title' ),
                            $title
                            );
                        ?>
                        <?php endif;?>

                        <?php if ( $settings['description'] ): ?>
                            <p <?php $this->print_render_attribute_string( 'details' );?>><?php echo bdevs_element_kses_intermediate( $settings['description'] ); ?></p>
                        <?php endif;?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-3 offset-xxl-1 col-xl-3 col-lg-4 col-md-4">
                     <div class="features__tab">
                        <ul class="nav nav-tabs" id="feaTab" role="tablist">
                            <?php foreach ( $settings['slides'] as $id => $slide ) :
                                // active class
                                $active_tab_menu = ($id == 0) ? 'active' : '';      
                            ?>
                           <li class="nav-item" role="presentation">
                                <button class="nav-link elementor-repeater-item-<?php echo esc_attr($slide['_id']); ?> <?php echo esc_attr($active_tab_menu); ?>" id="security-tab-<?php echo esc_attr($id); ?>" data-bs-toggle="tab" data-bs-target="#security-<?php echo esc_attr($id); ?>" type="button" role="tab" aria-controls="security-tab-<?php echo esc_attr($id); ?>" aria-selected="false">    <?php if ( ! empty( $slide['icon'] ) || ! empty( $slide['selected_icon']['value'] ) ) : ?> 
                                    <?php bdevs_element_render_icon( $slide, 'icon', 'selected_icon' ); ?>
                                    <?php endif; ?>
                                    <?php echo wp_kses_post( $slide['tab_title'] ); ?>   
                                </button>
                           </li>
                           <?php endforeach; ?>
                         </ul>
                     </div>
                  </div>
                  <div class="col-xxl-7 offset-xxl-1 col-xl-7 offset-xl-1 col-lg-8 col-md-8">
                     <div class="features__tab-content">
                        <div class="tab-content" id="feaTabContent">
                            <?php foreach ( $settings['slides'] as $id => $slide ) :
                                $tab_image = wp_get_attachment_image_url( $slide['tab_image']['id'], $settings['thumbnail_size'] );

                                $tab_content_image = wp_get_attachment_image_url( $slide['tab_content_image']['id'], $settings['thumbnail_size'] );

                                $tab_content_image3 = wp_get_attachment_image_url( $slide['tab_content_image3']['id'], $settings['thumbnail_size'] );

                                // active class
                                $active_tab = ($id == 0) ? 'show active' : '';       
                            ?>
                           <div class="tab-pane fade <?php echo esc_attr($active_tab); ?>" id="security-<?php echo esc_attr($id); ?>" role="tabpanel" aria-labelledby="security-tab-<?php echo esc_attr($id); ?>">
                              <div class="features__thumb">
                                 <div class="features__thumb-inner">
                                    <img class="fea-thumb" src="<?php print esc_url($tab_image); ?>" alt="<?php print esc_attr__('image','wetland'); ?>">
                                    <img class="fea-sm" src="<?php echo esc_url ($tab_content_image); ?>" alt="<?php print esc_attr__('image','wetland'); ?>">
                                    <img class="fea-sm-2" src="<?php echo esc_url ($tab_content_image3); ?>" alt="<?php print esc_attr__('image','wetland'); ?>">

                                    <img class="fea-2-shape" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/features/home-2/features-shape.png" alt="<?php print esc_attr__('image','wetland'); ?>">
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

        <?php elseif ( $settings['design_style'] === 'style_2' ) : 
            // bg_image
            if (!empty($settings['bg_shape_image']['id'])) {
                $bg_shape_image = wp_get_attachment_image_url( $settings['bg_shape_image']['id'], $settings['thumbnail_size'] );
                if ( ! $bg_shape_image ) {
                    $bg_shape_image = $settings['bg_shape_image']['url'];
                } 
            }

            // bg_image 2
            if (!empty($settings['bg_shape_image_2']['id'])) {
                $bg_shape_image_2 = wp_get_attachment_image_url( $settings['bg_shape_image_2']['id'], $settings['thumbnail2_size'] );
                if ( ! $bg_shape_image_2 ) {
                    $bg_shape_image_2 = $settings['bg_shape_image_2']['url'];
                } 
            }
        ?>
            <section class="about3">
            <?php if ( !empty( $bg_shape_image ) ) : ?>    
            <div class="about3__thumb2">
                <img src="<?php echo esc_url($bg_shape_image); ?>" alt="About Image">
            </div>
            <?php endif; ?>
            <?php if ( !empty( $bg_shape_image_2 ) ) : ?>
            <div class="about3__thumb3">
                <img src="<?php echo esc_url($bg_shape_image_2); ?>" alt="About Image">
            </div>
            <?php endif; ?>

            <div class="content_box_120_70">
                <div class="container">
                    <?php foreach ( $settings['slides'] as $id => $slide ) :
                        if ( !empty($slide['tab_content_image']['id']) ) {
                            $tab_content_image = wp_get_attachment_image_url( !empty($slide['tab_content_image']['id']), !empty($slide['tab_image_size']) );
                            if ( ! $tab_content_image ) {
                                $tab_content_image_url = $slide['tab_content_image']['url'];
                            }
                        }

                        // active class
                        $active_tab = ($id == 0) ? 'show active' : '';       
                    ?>
                    <div class="row">
                        <div class="col-lg-6 d-flex align-items-center">
                            <div class="about3__wrapper">
                                <div class="title_style1 mb-20">
                                    <?php if ( !empty($slide['tab_sub_title']) ) : ?> 
                                    <h5><?php echo bdevs_element_kses_basic( $slide['tab_sub_title'] ); ?></h5>
                                    <?php endif; ?>

                                    <?php if ( !empty($slide['tab_content_title']) ) : ?> 
                                    <h2><?php echo bdevs_element_kses_basic( $slide['tab_content_title'] ); ?></h2>
                                    <?php endif; ?>
                                </div>
                                <div class="about3__content mb-50">
                                    <?php if ( !empty($slide['tab_content_info']) ) : ?>
                                        <p><?php echo bdevs_element_kses_basic( $slide['tab_content_info'] ); ?></p>
                                    <?php endif; ?>
                                   <?php if ( !empty( $slide['button_url'] ) ) : ?>
                                        <a href="<?php echo esc_url( $slide['button_url'] ); ?>" class="site__btn1"><?php echo bdevs_element_kses_basic( $slide['button_text'] ); ?></a>
                                    <?php endif; ?>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <?php if ( !empty( $tab_content_image_url ) ) : ?>
                            <div class="about3__thumb1 mb-50">
                                <img class="img-fluid" src="<?php echo esc_url($tab_content_image_url); ?>"
                                    alt="About Image">
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                    <?php endforeach; ?>    
                </div>
            </div>
        </section> 

        <?php elseif ( $settings['design_style'] === 'style_3' ) : ?>
        <section class="about-others">
            <div class="container">
                <?php foreach ( $settings['slides'] as $id => $slide ) :
                    $tab_image = wp_get_attachment_image_url( !empty($slide['tab_image']['id']), !empty($slide['tab_image_size']) );
                    if ( ! $tab_image ) {
                        $tab_image_url = $slide['tab_image']['url'];
                    }

                    $tab_content_image = wp_get_attachment_image_url( !empty($slide['tab_content_image']['id']), !empty($slide['tab_image_size']) );
                    if ( ! $tab_image ) {
                        $tab_content_image_url = $slide['tab_content_image']['url'];
                    }

                    // active class
                    $active_tab = ($id == 0) ? 'show active' : '';       
                ?>
                <div class="row">
                    <div class="col-lg-6">
                        <div class="about2__left">
                            <?php if ( !empty( $tab_content_image_url ) ) : ?>
                            <div class="about2__left-thumb">
                                <img class="img-fluid" src="<?php echo esc_url($tab_content_image_url); ?>"
                                    alt="About Image">
                            </div>
                            <?php endif; ?>
                            <div class="about2__left-content">
                                <div class="about2__left-content-icon">
                                    <?php if ( ! empty( $slide['icon'] ) || ! empty( $slide['selected_icon']['value'] ) ) : ?> 
                                        <?php bdevs_element_render_icon( $slide, 'icon', 'selected_icon' ); ?>
                                    <?php endif; ?>
                                    <?php if ( !empty($slide['tab_img_number']) ) : ?> 
                                    <span><?php echo bdevs_element_kses_basic( $slide['tab_img_number'] ); ?></span>
                                    <?php endif; ?>
                                </div>
                                <?php if ( !empty($slide['tab_img_title']) ) : ?> 
                                <div class="about2__left-content-title">
                                    <h3><a href="<?php echo esc_url( $slide['button_url'] ); ?>"><?php echo bdevs_element_kses_basic( $slide['tab_img_title'] ); ?></a></h3>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="about2__right">
                            <div class="title_style1 mb-20">
                                <?php if ( !empty($slide['tab_sub_title']) ) : ?> 
                                <h5><?php echo bdevs_element_kses_basic( $slide['tab_sub_title'] ); ?></h5>
                                <?php endif; ?>

                                <?php if ( !empty($slide['tab_content_title']) ) : ?> 
                                <h2><?php echo bdevs_element_kses_basic( $slide['tab_content_title'] ); ?></h2>
                                <?php endif; ?>
                            </div>

                            <?php if ( !empty($slide['tab_content_info']) ) : ?>
                            <p><?php echo bdevs_element_kses_basic( $slide['tab_content_info'] ); ?></p>
                            <?php endif; ?>

                            <?php if ( !empty( $slide['button_url'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['button_url'] ); ?>" class="site__btn1"><?php echo bdevs_element_kses_basic( $slide['button_text'] ); ?></a>
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