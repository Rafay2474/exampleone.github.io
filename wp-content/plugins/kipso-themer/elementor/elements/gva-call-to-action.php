<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
use Elementor\Controls_Manager;
use Elementor\Scheme_Color;
use Elementor\Group_Control_Typography;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Border;
use Elementor\Group_Control_Image_Size;

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class GVAElement_Call_To_Action extends GVAElement_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve heading widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name() {
		return 'gva-call-to-action';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve heading widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'GVA Call To Action', 'kipso-themer' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve heading widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-type-tool';
	}


	/**
	 * Get widget keywords.
	 *
	 * Retrieve the list of keywords the widget belongs to.
	 *
	 * @since 2.1.0
	 * @access public
	 *
	 * @return array Widget keywords.
	 */
	public function get_keywords() {
		return [ 'call to action', 'block', 'action' ];
	}

	/**
	 * Register heading widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			[
				'label' => __( 'Content', 'kipso-themer' ),
			]
		);
		$this->add_control(
			'sub_title',
			[
				'label' => __( 'Sub Title', 'kipso-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your Sub Title', 'kipso-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'title_text',
			[
				'label' => __( 'Title', 'kipso-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'kipso-themer' ),
				'default' => __( 'Add Your Heading Text Here', 'kipso-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'description_text',
			[
				'label' 				=> __( 'Description', 'kipso-themer' ),
				'type' 				=> Controls_Manager::TEXTAREA,
				'placeholder' 		=> __( 'Enter Your Description', 'kipso-themer' ),
				'default'			=> __('There are many variations of passages of lore available but the majority have suffered alteration in some form.​', 'kipso-theme')
			]
		);
		$this->add_control(
			'use_icon_image',
			[
				'label' => __( 'Use Icon Image', 'kipso-themer' ),
				'type' => Controls_Manager::SWITCHER,
				'placeholder' => __( 'Use Icon Image or Icon Font', 'kipso-themer' ),
				'default' => 'yes',
				'condition' => [
					'style' => ['button-bottom']
				]
			]
		);

		$this->add_control(
			'icon',
			[
				'label' => __( 'Icon Class', 'kipso-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'default' => 'gv-icon-75',
				'placeholder' => __( 'gv-icon-75', 'kipso-themer' ),
				'description' => 'Use class icon font <a target="_blank" href="http://fontawesome.io/icons/">Icon Awesome</a> or <a target="_blank" href="http://gaviasthemes.com/icons/ionicon/">Custom icon</a>',
				'condition' => [
					'use_icon_image!' => 'yes',
					'style' => ['button-bottom']
				]
			]
		);

		$this->add_control(
			'icon_image',
			[
				'label' => __( 'Icon Image', 'kipso-themer' ),
				'type' => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
				'default' => [
					'url' => GAVIAS_KIPSO_PLUGIN_URL . 'elementor/assets/images/icon-placeholder.png',
				],
				'condition' => [
					'use_icon_image' => 'yes',
					'style' => ['button-bottom']
				]
			]
		);
		$this->add_control(
			'style',
			[
				'label' => __( 'Style', 'kipso-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
				'button-left' => esc_html__('Button Left', 'kipso-themer'),            
            'button-right' => esc_html__('Button Right', 'kipso-themer'),   
            'button-bottom' => esc_html__('Button Bottom Left', 'kipso-themer'),   
            'button-center' => esc_html__('Button Bottom Center', 'kipso-themer'),
				],
				'default' => 'button-bottom',
			]
		);

		$this->add_control(
			'header_tag',
			[
				'label' => __( 'HTML Tag', 'kipso-themer' ),
				'type' => Controls_Manager::SELECT,
				'options' => [
					'h1' => 'H1',
					'h2' => 'H2',
					'h3' => 'H3',
					'h4' => 'H4',
					'h5' => 'H5',
					'h6' => 'H6',
					'div' => 'div',
					'span' => 'span',
					'p' => 'p',
				],
				'default' => 'h2',
			]
		);


		$this->add_control(
			'max_width',
			[
				'label' => __( 'Max Width (px)', 'kipso-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 800,
				],
				'range' => [
					'px' => [
						'min' => 300,
						'max' => 1170,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action' => 'max-width: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section( //** Section Icon
			'section_Button',
			[
				'label' => __( 'Button', 'kipso-themer' ),
			]
		);

		$this->add_control(
			'button_url',
			[
				'label' 		=> __( 'Button URL', 'kipso-themer' ),
				'type' 		=> Controls_Manager::URL,
				'default'	=> [
						'url'		=> '#'
				]
			]
		);

		$this->add_control(
			'button_text',
			[
				'label' => __( 'Button Text', 'kipso-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'Read More'
			]
		);

		$this->add_control(
			'button_color',
			[
				'label' => __( 'Button Text Color', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .button-action .btn-cta' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background',
			[
				'label' => __( 'Button Background', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .button-action .btn-cta' => 'background: {{VALUE}};',
					'{{WRAPPER}} .gsc-call-to-action .button-action .btn-cta::before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Button Color Hover', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .button-action .btn-cta:hover' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_control(
			'button_background_hover',
			[
				'label' => __( 'Button Background Hover', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .button-action .btn-cta:hover' => 'background: {{VALUE}}!important;',
					'{{WRAPPER}} .gsc-call-to-action .button-action .btn-cta:hover:before' => 'background: {{VALUE}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			[
				'label' => __( 'Title', 'kipso-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'title_color',
			[
				'label' => __( 'Text Color', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-call-to-action .title',
			]
		);

		$this->add_responsive_control(
			'title_space',
			[
				'label' => __( 'Title Spacing', 'kipso-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_sub_title_style',
			[
				'label' => __( 'Sub Title', 'kipso-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'sub_title_color',
			[
				'label' => __( 'Text Color', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .sub-title' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_responsive_control(
			'sub_title_space',
			[
				'label' => __( 'Sub Title Spacing', 'kipso-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 5,
				],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .sub-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_sub_title',
				'selector' => '{{WRAPPER}} .gsc-call-to-action .sub-title',
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_desc_style',
			[
				'label' => __( 'Description', 'kipso-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
 
		$this->add_control(
			'desc_color',
			[
				'label' => __( 'Text Color', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .desc' => 'color: {{VALUE}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' => '{{WRAPPER}} .gsc-call-to-action .desc',
			]
		);

		$this->add_responsive_control(
			'description_space',
			[
				'label' => __( 'Description Spacing', 'kipso-themer' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 20,
				], 
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .gsc-call-to-action .desc' => 'margin-bottom: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->end_controls_section();
	}

	/**
	 * Render heading widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		printf( '<div class="gva-element-%s gva-element">', $this->get_name() );
         include $this->get_template('gva-call-to-action.php');
      print '</div>';
	}

	public function add_wpml_support() {
		add_filter( 'wpml_elementor_widgets_to_translate', [ $this, 'wpml_widgets_to_translate_filter' ] );
	}

	public function wpml_widgets_to_translate_filter( $widgets ) {
		$widgets[ $this->get_name() ] = [
			'conditions' => [ 'widgetType' => $this->get_name() ],
			'fields'     => [
				[
					'field'       => 'sub_title',
					'type'        => __( 'Sub Title', 'kipso-themer' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'title_text',
					'type'        => __( 'Title', 'kipso-themer' ),
					'editor_type' => 'LINE'
				],
				[
					'field'       => 'description_text',
					'type'        => __( 'Description', 'kipso-themer' ),
					'editor_type' => 'LINE'
				],
			],
		];
		return $widgets;
	}
}
