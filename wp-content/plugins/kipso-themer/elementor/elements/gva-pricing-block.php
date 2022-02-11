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
use Elementor\Repeater;

/**
 * Elementor heading widget.
 *
 * Elementor widget that displays an eye-catching headlines.
 *
 * @since 1.0.0
 */
class GVAElement_Pricing_Block extends GVAElement_Base {

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
		return 'gva-pricing-block';
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
		return __( 'GVA Pricing Block', 'kipso-themer' );
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
		return [ 'pricing', 'block' ];
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
			'title_text',
			[
				'label' => __( 'Title', 'kipso-themer' ),
				'type' => Controls_Manager::TEXT,
				'dynamic' => [
					'active' => true,
				],
				'placeholder' => __( 'Enter your title', 'kipso-themer' ),
				'default' => __( 'Standard', 'kipso-themer' ),
				'label_block' => true
			]
		);
		$this->add_control(
			'price',
			[
				'label' => __( 'Price', 'kipso-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( '60.00', 'kipso-themer' ),
				'default' => __( '60.00', 'kipso-themer' ),
			]
		);
		$this->add_control(
			'currency',
			[
				'label' => __( 'Currency', 'kipso-themer' ),
				'type' => Controls_Manager::TEXT,
				'placeholder' => __( 'Currency', 'kipso-themer' ),
				'default' => __( '$', 'kipso-themer' ),
			]
		);
		$this->add_control(
         'featured',
         [
            'label'     => __('Featured', 'kipso-themer'),
            'type'      => Controls_Manager::SWITCHER,
            'default'   => 'no',
         ]
     );
		$repeater = new Repeater();
      $repeater->add_control(
         'pricing_features',
			[
	         'label'       => __('Pricing Features', 'kipso-themer'),
	         'type'        => Controls_Manager::TEXTAREA,
	         'default'     => 'Free text goes here',
	         'label_block' => true,
	         'rows'        => '10',
	      ]
	   );

		$this->add_control(
            'pricing_content',
            [
               'label'       => __('Pricing Features', 'kipso-themer'),
               'type'        => Controls_Manager::REPEATER,
               'fields' => $repeater->get_controls(),

               'title_field' => '{{{ pricing_features }}}',
               'default'     => array(
                  array(
                     'name'  => esc_html__( '3 Full Courses', 'kipso-themer' )
                  ),
                  array(
                     'name'  => esc_html__( 'Lifetime free support', 'kipso-themer' )
                  ),
                  array(
                     'name'  => esc_html__( 'Upgrate options', 'kipso-themer' )
                  ),
                  array(
                      'name'  => esc_html__( '9 Days Time', 'kipso-themer' )
                  ),
                ),
            ]
        );

		$this->end_controls_section();

		$this->start_controls_section( //** Section Icon
			'section_button',
			[
				'label' => __( 'Button', 'kipso-themer' ),
			]
		);
		$this->add_control(
			'button_url',
			[
				'label' => __( 'Button URL', 'kipso-themer' ),
				'type' => Controls_Manager::URL,
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
			'bottom_text',
			[
				'label' => __( 'Bottom Text', 'kipso-themer' ),
				'type' => Controls_Manager::TEXT,
				'default' => 'No hidden charges!'
			]
		);
		$this->add_control(
			'button_color',
			[
				'label' => __( 'Button Text Color', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .pricing-action .btn-cta' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background',
			[
				'label' => __( 'Button Background', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .pricing-action .btn-cta' => 'background: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_color_hover',
			[
				'label' => __( 'Button Color Hover', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .pricing-action .btn-cta:hover' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_control(
			'button_background_hover',
			[
				'label' => __( 'Button Background Hover', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .pricing-action .btn-cta:hover' => 'background: {{VALUE}};',
					'{{WRAPPER}} .gsc-pricing .pricing-action .btn-cta:hover:before' => 'background: {{VALUE}};',
				],
			]
		);
		$this->end_controls_section();

		// Price Text Styling
		$this->start_controls_section(
			'section_price_style',
			[
				'label' => __( 'Price Text', 'kipso-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'price_color',
			[
				'label' => __( 'Price Text Color', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .price-value' => 'color: {{VALUE}};',
					'{{WRAPPER}} .gsc-pricing:after' => 'border-color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_sub_title',
				'selector' => '{{WRAPPER}} .gsc-pricing .price-value',
			]
		);
		$this->end_controls_section();

		// Title Styling
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
					'{{WRAPPER}} .gsc-pricing .title' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography',
				'selector' => '{{WRAPPER}} .gsc-pricing .title',
			]
		);
		$this->end_controls_section();

		//Desc Styling
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
					'{{WRAPPER}} .gsc-pricing .plan-list' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_desc',
				'selector' =>'{{WRAPPER}} .gsc-pricing .plan-list'
			]
		);
		$this->end_controls_section();

		//Bottom Text
		$this->start_controls_section(
			'section_bottom_text_style',
			[
				'label' => __( 'Bottom Text', 'kipso-themer' ),
				'tab' => Controls_Manager::TAB_STYLE,
			]
		);
		$this->add_control(
			'bottom_text_color',
			[
				'label' => __( 'Text Color', 'kipso-themer' ),
				'type' => Controls_Manager::COLOR,
				'selectors' => [
					'{{WRAPPER}} .gsc-pricing .bottom-text' => 'color: {{VALUE}};',
				],
			]
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name' => 'typography_bottom_text',
				'selector' => '{{WRAPPER}} .gsc-pricing .bottom-text',
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
         include $this->get_template('gva-pricing-block.php');
      print '</div>';
	}

}
