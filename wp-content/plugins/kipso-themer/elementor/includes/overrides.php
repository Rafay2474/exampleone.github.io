<?php
use Elementor\Controls_Manager;
use Elementor\Repeater;
class GVA_Elementor_Override{
   public function __construct() {
      $this->add_actions();
   }

   public function add_actions() {
      add_action( 'elementor/element/column/layout/after_section_end', [ $this, 'after_column_end' ], 10, 2 );
      add_action( 'elementor/element/section/section_layout/after_section_end', [ $this, 'after_row_end' ], 10, 2 );
   }

   public function after_column_end( $obj, $args ) {
      $obj->start_controls_section(
         'gva_section_column',
         array(
            'label' => esc_html__( 'Gavias Extra Settings', 'kipso-themer' ),
            'tab'   => Controls_Manager::TAB_LAYOUT,
         )
      );
      $obj->add_control(
         '_gva_extra_classes',
         [
            'label' => __( 'Styles Available', 'kipso-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               '' => __( '-- None --', 'kipso-themer' ),
               'bg-overflow-left' => __( 'Background Overflow Left', 'kipso-themer' ),
               'bg-overflow-right' => __( 'Background Overflow Right', 'kipso-themer' ),
               'bg-overflow-bottom' => __( 'Background Overflow Bottom', 'kipso-themer' ),
            ],
            'default' => '',
            'prefix_class' => 'column-style-',
         ]
      );
      $obj->add_control(
         '_gva_elements style',
         [
            'label' => __( 'Elements Style', 'kipso-themer' ),
            'type' => Controls_Manager::SELECT,
            'options' => [
               '' => __( '-- None --', 'kipso-themer' ),
               'flex-element-center' => __( 'Flex Elements Center Align Left', 'kipso-themer' ),
               'flex-element-center-ali-right' => __( 'Flex Elements Center Align Right', 'kipso-themer' ),
            ],
            'default' => '',
            'prefix_class' => '',
         ]
     );
      $obj->end_controls_section();     
   }

   public function after_row_end( $obj, $args ) {
      $_post_type = get_post_type();
      //if($_post_type == 'gva_header'){
      $obj->start_controls_section(
         'gva_section_row',
         array(
            'label' => esc_html__( 'Sticky Menu Settings (Use only for row in header)', 'kipso-themer' ),
            'tab'   => Controls_Manager::TAB_LAYOUT,
         )
      );
      $obj->add_control(
         '_gva_sticky_menu',
         [
            'label'     => __( 'Sticky Menu Row', 'kipso-themer' ),
            'type'      => Controls_Manager::SELECT,
            'options'   => [
               '' => __( '-- None --', 'kipso-themer' ),
               'gv-sticky-menu' => __( 'Sticky Menu', 'kipso-themer' ),
            ],
            'default'         => '',
            'prefix_class'    => '',
            'description'     => __('You can only enable sticky menu for one row, please make sure display all sticky menu for other rows')
         ]
      );
      $obj->add_control(
         '_gva_sticky_background',
         [
            'label'     => __('Sticky Background Color', 'kipso-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}}.stuck' => 'background: {{VALUE}}', 
            ],
            'condition' => [
               '_gva_sticky_menu!' => ''
            ]
         ]
      );
      $obj->add_control(
         '_gva_sticky_menu_text_color',
         [
            'label'     => __('Sticky Text Color', 'kipso-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}}.stuck' => 'color: {{VALUE}}', 
            ],
            'condition' => [
               '_gva_sticky_menu!' => ''
            ]
         ]
      );
      $obj->add_control(
         '_gva_sticky_menu_link_color',
         [
            'label'     => __('Sticky Link Menu Color', 'kipso-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}}.stuck .gva-navigation-menu ul.gva-nav-menu > li > a' => 'color: {{VALUE}}',
            ],
            'condition' => [
               '_gva_sticky_menu!' => ''
            ]
         ]
      );
      $obj->add_control(
         '_gva_sticky_menu_link_hover_color',
         [
            'label'     => __('Sticky Link Menu Hover Color', 'kipso-themer'),
            'type'      => Controls_Manager::COLOR,
            'selectors' => [
               '{{WRAPPER}}.stuck .gva-navigation-menu ul.gva-nav-menu > li > a:hover' => 'color: {{VALUE}}',
            ],
            'condition' => [
               '_gva_sticky_menu!' => ''
            ]
         ]
      );
      $obj->end_controls_section();
   }
}

new GVA_Elementor_Override();
