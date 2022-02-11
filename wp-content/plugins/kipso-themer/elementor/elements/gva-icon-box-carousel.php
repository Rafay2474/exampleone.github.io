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

class GVAElement_Icon_Box_Carousel extends GVAElement_Base{

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
        return 'gva-icon-box-carousel';
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
        return __('GVA Icon Box Carousel', 'kipso-themer');
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
        return [ 'icon', 'box', 'content', 'carousel' ];
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
            'section_content',
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
            'default'     => 'Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.',
            'label_block' => true,
          ]
        );
        $repeater->add_control(
          'image',
          [
              'label'      => __('Choose Image', 'kipso-themer'),
              'default'    => [
                  'url' => GAVIAS_KIPSO_PLUGIN_URL . 'elementor/assets/images/icon-placeholder-white.png',
              ],
              'type'       => Controls_Manager::MEDIA,
              'show_label' => false,
          ]
        );
        $repeater->add_control(
            'link',
          [
              'label'     => __( 'Link', 'kipso-themer' ),
              'type'      => Controls_Manager::URL,
              'dynamic' => [
                  'active' => true,
              ],
              'placeholder' => __( 'https://your-link.com', 'kipso-themer' ),
              'label_block' => true
          ]
        );
        $repeater->add_control(
            'color',
          [
              'label'     => __( 'Color', 'kipso-themer' ),
              'type'      => Controls_Manager::COLOR,
              'default'   => '',
              'selectors' => [
                  '{{WRAPPER}} .gsc-icon-box-carousel.style-1 {{CURRENT_ITEM}} .box-icon .icon-inner' => 'background-color: {{VALUE}};',
                  '{{WRAPPER}} .gsc-icon-box-carousel.style-1 {{CURRENT_ITEM}} .box-icon:after' => 'border-color: {{VALUE}};',
                  '{{WRAPPER}} .gsc-icon-box-carousel.style-2 {{CURRENT_ITEM}}.icon-box-item-content' => 'background-color: {{VALUE}};',
                  '{{WRAPPER}} .gsc-icon-box-carousel.style-2 {{CURRENT_ITEM}}.icon-box-item-content:after' => 'border-color: {{VALUE}};',
              ],
          ]
        );

        $this->add_control(
            'icon_boxs',
            [
                'label'       => __('Brand Content Item', 'kipso-themer'),
                'type'        => Controls_Manager::REPEATER,
                'fields' => $repeater->get_controls(),
                'title_field' => '{{{ title }}}',
                'default'     => array(
                    array(
                        'title'  => esc_html__( 'IT & Software', 'kipso-themer' ),
                        'color'  => '#4F6FBE'
                    ),
                    array(
                        'title'  => esc_html__( 'Development', 'kipso-themer' ),
                        'color'  => '#9764DF'
                    ),
                    array(
                        'title'  => esc_html__( 'Music', 'kipso-themer' ),
                        'color'  => '#F9BC18'
                    ),
                    array(
                        'title'  => esc_html__( 'Photography', 'kipso-themer' ),
                        'color'  => '#54C9A4'
                    ),
                    array(
                        'title'  => esc_html__( 'Marketing', 'kipso-themer' ),
                        'color'  => '#FF8B6F'
                    ),
                    array(
                        'title'  => esc_html__( 'Health & Fitness', 'kipso-themer' ),
                        'color'  => '#3CCBF3'
                    ),
                ),
            ]
        );
        $this->add_control(
            'style',
            [
                'label' => __( 'Style', 'kipso-themer' ),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style-1' => esc_html__('Style I', 'kipso-themer'),
                    'style-2' => esc_html__('Style II', 'kipso-themer'),
                ],
                'default' => 'style-1',
            ]
        );
        
        $this->end_controls_section();

        $this->add_control_carousel(false);


        // Image Styling
        $this->start_controls_section(
            'section_style_image',
            [
                'label'     => __('Image', 'kipso-themer'),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name'      => 'image_border',
                'selector'  => '{{WRAPPER}} .gva-brand-carousel .brand-item-content img',
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
                    '{{WRAPPER}} .gva-brand-carousel .brand-item-content img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
        include $this->get_template('gva-icon-box-carousel.php');
      print '</div>';
    }

}
