<?php
namespace BdevsElement\Widget;

use Elementor\Core\Schemes\Typography;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Text_Shadow;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Repeater;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class CTA extends BDevs_El_Widget {

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
        return 'cta';
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
        return __( 'CTA', 'bdevs-element' );
    }

    public function get_custom_help_url() {
        return 'http://elementor.bdevs.net/widgets/gradient-heading/';
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
        return 'eicon-t-letter';
    }

    public function get_keywords() {
        return ['gradient', 'advanced', 'heading', 'title', 'colorful'];
    }

    protected function register_content_controls() {

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label'              => __( 'Design Style', 'bdevs-element' ),
                'type'               => Controls_Manager::SELECT,
                'options'            => [
                    'style_1' => __( 'Style 1', 'bdevs-element' ),
                    'style_2' => __( 'Style 2', 'bdevs-element' ),
                    'style_3' => __( 'Style 3', 'bdevs-element' ),
                    'style_4' => __( 'Style 4', 'bdevs-element' ),
                ],
                'default'            => 'style_1',
                'frontend_available' => true,
                'style_transfer'     => true,
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

        //desc
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __( 'Title & Desccription', 'bdevs-element' ),
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
                'condition' => [
                    'design_style' => ['style_10', 'style_12'],
                ],
            ]
        );

        $this->add_control(
            'title',
            [
                'label'       => __( 'Title', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'desccription',
            [
                'label'       => __( 'Desccription', 'bdevs-element' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Heading Desccription Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1', 'style_2','style_3','style_4'],
                ],
            ]
        );

        $this->add_control(
            'cta_info',
            [
                'label'       => __( 'CTA Info', 'bdevs-element' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Form Info Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_1','style_3','style_4'],
                ],
            ]
        );

        $this->add_control(
            'image',
            [
                'label'   => __( 'Image', 'bdevs-element' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Image_Size::get_type(),
            [
                'name'      => 'thumbnail',
                'default'   => 'medium_large',
                'separator' => 'none',
                'exclude'   => [
                    'full',
                    'custom',
                    'large',
                    'shop_catalog',
                    'shop_single',
                    'shop_thumbnail',
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
                'default' => 'h3',
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
        // section title 01 end 

        // section title 02 
        $this->start_controls_section(
            '_section_title2',
            [
                'label' => __( 'Title & Desccription 02', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]

        );


        $this->add_control(
            'title2',
            [
                'label'       => __( 'Title2', 'bdevs-element' ),
                'label_block' => true,
                'type'        => Controls_Manager::TEXTAREA,
                'default'     => 'Heading Title',
                'placeholder' => __( 'Heading Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'desccription2',
            [
                'label'       => __( 'Desccription2', 'bdevs-element' ),
                'type'        => Controls_Manager::TEXTAREA,
                'placeholder' => __( 'Heading Desccription Text', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'image2',
            [
                'label'   => __( 'Image2', 'bdevs-element' ),
                'type'    => Controls_Manager::MEDIA,
                'default' => [
                    'url' => Utils::get_placeholder_image_src(),
                ],
                'dynamic' => [
                    'active' => true,
                ],
                'condition' => [
                    'design_style' => ['style_2'],
                ],
            ]
        );

        $this->add_control(
            'title_tag2',
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
                'default' => 'h3',
                'toggle'  => false,
            ]
        );

        $this->add_responsive_control(
            'align2',
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

        //listview with icon
        $this->start_controls_section(
            '_section_list',
            [
                'label'     => __( 'Items List', 'bdevs-element' ),
                'tab'       => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_10', 'style_11'],
                ],
            ]
        );

        $repeater = new Repeater();

        $repeater->add_control(
            'title',
            [
                'type'        => Controls_Manager::TEXT,
                'label_block' => true,
                'label'       => __( 'Title', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'dynamic'     => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'items_list',
            [
                'show_label'  => false,
                'type'        => Controls_Manager::REPEATER,
                'fields'      => $repeater->get_controls(),
                'title_field' => '<# print(title || "Carousel Item"); #>',
                'default'     => [
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
                ],
            ]
        );

        $this->end_controls_section();


        // Contact Form 7
        $this->start_controls_section(
            '_section_cf7',
            [
                'label' => bdevs_element_is_cf7_activated() ? __('Contact Form 7', 'bdevs-element') : __('Missing Notice', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_1'],
                ],
            ]
        );

        if (!bdevs_element_is_cf7_activated()) {
            $this->add_control(
                '_cf7_missing_notice',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => sprintf(
                        __('Hello %2$s, looks like %1$s is missing in your site. Please click on the link below and install/activate %1$s. Make sure to refresh this page after installation or activation.', 'bdevs-element'),
                        '<a href="' . esc_url(admin_url('plugin-install.php?s=Contact+Form+7&tab=search&type=term'))
                        . '" target="_blank" rel="noopener">Contact Form 7</a>',
                        bdevs_element_get_current_user_display_name()
                    ),
                    'content_classes' => 'elementor-panel-alert elementor-panel-alert-danger',
                ]
            );

            $this->add_control(
                '_cf7_install',
                [
                    'type' => Controls_Manager::RAW_HTML,
                    'raw' => '<a href="' . esc_url(admin_url('plugin-install.php?s=Contact+Form+7&tab=search&type=term')) . '" target="_blank" rel="noopener">Click to install or activate Contact Form 7</a>',
                ]
            );
            $this->end_controls_section();
            return;
        }

        $this->add_control(
            'form_id',
            [
                'label' => __('Select Your Form', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'label_block' => true,
                'options' => ['' => __('', 'bdevs-element')] + \bdevs_element_get_cf7_forms(),
            ]
        );

        $this->add_control(
            'html_class',
            [
                'label' => __('HTML Class', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'description' => __('Add CSS custom class to the form.', 'bdevs-element'),
            ]
        );

        $this->end_controls_section();
        // form end 

        //button
        $this->start_controls_section(
            '_section_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2','style_3','style_4']
                ],
            ]
        );

        $this->add_control(
            'button_text',
            [
                'label' => __( 'Button Text', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
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
            $this->add_control(
                'button_selected_icon',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
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

        $this->add_control(
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
        $this->end_controls_section();

        // 2nd btn
        $this->start_controls_section(
            '_section_button2',
            [
                'label' => __( 'Button 2', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
                'condition' => [
                    'design_style' => ['style_2','style_3','style_4']
                ],
            ]
        );
        $this->add_control(
            'button_text2',
            [
                'label' => __( 'Button Text 2', 'bdevs-element' ),
                'type' => Controls_Manager::TEXT,
                'default' => 'Button Text',
                'placeholder' => __( 'Type button text here', 'bdevs-element' ),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ],
            ]
        );

        $this->add_control(
            'button_link2',
            [
                'label' => __( 'Link', 'bdevs-element' ),
                'type' => Controls_Manager::URL,
                'placeholder' => 'http://elementor.bdevs.net/',
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if ( bdevs_element_is_elementor_version( '<', '2.6.0' ) ) {
            $this->add_control(
                'button_icon2',
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
            $this->add_control(
                'button_selected_icon2',
                [
                    'type' => Controls_Manager::ICONS,
                    'fa4compatibility' => 'button_icon',
                    'label_block' => true,
                ]
            );
            $condition = ['button_selected_icon[value]!' => ''];
        }

        $this->add_control(
            'button_icon_position2',
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

        $this->add_control(
            'button_icon_spacing2',
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

        $this->end_controls_section();

    }


    protected function register_style_controls() {
        $this->start_controls_section(
            '_section_style_title',
            [
                'label' => __( 'Title & Desccription', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_control(
            '_heading_title',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => __( 'Title', 'bdevs-element' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_margin',
            [
                'label'      => __( 'Margin', 'bdevs-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cta__content .cta__content' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_padding',
            [
                'label'      => __( 'Padding', 'bdevs-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cta__content .cta__content' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'title',
                'selector' => '{{WRAPPER}} .cta__area .cta__content .z-title',
                'scheme'   => Typography::TYPOGRAPHY_1,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'title',
                'label'    => __( 'Text Shadow', 'bdevs-element' ),
                'selector' => '{{WRAPPER}} .cta__area .cta__content .z-title',
            ]
        );

        $this->add_control(
            'heading_color',
            [
                'label'     => __( 'Text Color', 'bdevs-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cta__area .cta__content .z-title' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'blend_mode',
            [
                'label'     => __( 'Blend Mode', 'bdevs-element' ),
                'type'      => Controls_Manager::SELECT,
                'options'   => [
                    ''            => __( 'Normal', 'bdevs-element' ),
                    'multiply'    => 'Multiply',
                    'screen'      => 'Screen',
                    'overlay'     => 'Overlay',
                    'darken'      => 'Darken',
                    'lighten'     => 'Lighten',
                    'color-dodge' => 'Color Dodge',
                    'saturation'  => 'Saturation',
                    'color'       => 'Color',
                    'difference'  => 'Difference',
                    'exclusion'   => 'Exclusion',
                    'hue'         => 'Hue',
                    'luminosity'  => 'Luminosity',
                ],
                'selectors' => [
                    '{{WRAPPER}} .cta__area .cta__content .z-title' => 'mix-blend-mode: {{VALUE}};',
                ],
                'separator' => 'none',
            ]
        );

        // subtitle
        $this->add_control(
            '_heading_subtitle',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => __( 'Sub Title', 'bdevs-element' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_subtitle_margin',
            [
                'label'      => __( 'Margin', 'bdevs-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cta__content span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_subtitle_padding',
            [
                'label'      => __( 'Padding', 'bdevs-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .cta__content span' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'subtitle',
                'selector' => '{{WRAPPER}} .cta__content span',
                'scheme'   => Typography::TYPOGRAPHY_2,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'subtitle',
                'label'    => __( 'Text Shadow', 'bdevs-element' ),
                'selector' => '{{WRAPPER}} .cta__content span',
            ]
        );

        $this->add_control(
            'heading_subtitle_color',
            [
                'label'     => __( 'Text Color', 'bdevs-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .cta__content span' => 'color: {{VALUE}};',
                ],
            ]
        );

        // content

        $this->add_control(
            '_heading_description',
            [
                'type'      => Controls_Manager::HEADING,
                'label'     => __( 'Content', 'bdevs-element' ),
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'heading_desc_margin',
            [
                'label'      => __( 'Margin', 'bdevs-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .section-heading p' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'heading_desc_padding',
            [
                'label'      => __( 'Padding', 'bdevs-element' ),
                'type'       => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors'  => [
                    '{{WRAPPER}} .section-heading p' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name'     => 'desccription',
                'selector' => '{{WRAPPER}} .section-heading p',
                'scheme'   => Typography::TYPOGRAPHY_3,
            ]
        );

        $this->add_group_control(
            Group_Control_Text_Shadow::get_type(),
            [
                'name'     => 'desccription',
                'label'    => __( 'Text Shadow', 'bdevs-element' ),
                'selector' => '{{WRAPPER}} .section-heading p',
            ]
        );

        $this->add_control(
            'heading_desc_color',
            [
                'label'     => __( 'Text Color', 'bdevs-element' ),
                'type'      => Controls_Manager::COLOR,
                'default'   => '',
                'selectors' => [
                    '{{WRAPPER}} .section-heading p' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_section();
        
        // Button style
        $this->start_controls_section(
            '_section_style_button',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button_typography',
                'selector' => '{{WRAPPER}} .bdevs-btn',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button_border',
                'selector' => '{{WRAPPER}} .bdevs-btn',
            ]
        );

        $this->add_control(
            'button_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-btn',
            ]
        );

        $this->add_control(
            'hr',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button' );

        $this->start_controls_tab(
            '_tab_button_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus,{{WRAPPER}} .bdevs-btn:hover::after' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus,{{WRAPPER}} .bdevs-btn:hover::after' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus,{{WRAPPER}} .bdevs-btn:hover::after' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

         /** button 2 **/
        $this->start_controls_section(
            '_section_style_button2',
            [
                'label' => __( 'Button 2', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'button2_padding',
            [
                'label' => __( 'Padding', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', 'em', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn-border' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'button2_typography',
                'selector' => '{{WRAPPER}} .bdevs-btn-border',
                'scheme' => Typography::TYPOGRAPHY_4,
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'button2_border',
                'selector' => '{{WRAPPER}} .bdevs-btn-border',
            ]
        );

        $this->add_control(
            'button2_border_radius',
            [
                'label' => __( 'Border Radius', 'bdevs-element' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%' ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn-border' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'button2_box_shadow',
                'selector' => '{{WRAPPER}} .bdevs-btn-border',
            ]
        );

        $this->add_control(
            'hr2',
            [
                'type' => Controls_Manager::DIVIDER,
                'style' => 'thick',
            ]
        );

        $this->start_controls_tabs( '_tabs_button2' );

        $this->start_controls_tab(
            '_tab_button2_normal',
            [
                'label' => __( 'Normal', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button2_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'default' => '',
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn-border' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn-border' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            '_tab_button2_hover',
            [
                'label' => __( 'Hover', 'bdevs-element' ),
            ]
        );

        $this->add_control(
            'button2_hover_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn-border:hover, {{WRAPPER}} .bdevs-btn-border:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn-border:hover, {{WRAPPER}} .bdevs-btn-border:focus' => 'background-color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button2_hover_border_color',
            [
                'label' => __( 'Border Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'condition' => [
                    'button_border_border!' => '',
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn-border:hover, {{WRAPPER}} .bdevs-btn-border:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();

    }

    protected function render() {

        $settings = $this->get_settings_for_display();
        if (!empty($settings['title'])) {
            $title = bdevs_element_kses_basic( $settings['title'] );
        }

        if (!empty($settings['title2'])) {
            $title2 = bdevs_element_kses_basic( $settings['title2'] );
        }
        

        if ( !empty( $settings['image']['id'] ) ) {
            $image = wp_get_attachment_image_url( $settings['image']['id'], $settings['thumbnail_size'] );
        }

        ?>

        <?php if ( $settings['design_style'] === 'style_4' ):

            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'section__title' );

            $this->add_render_attribute( 'button', 'class', 'm-btn m-btn-border-2 cta__btn active bdevs-btn' );
            if ( !empty( $settings['button_link'] ) ) {
                $this->add_link_attributes( 'button', $settings['button_link'] );
            }

            $this->add_render_attribute( 'button2', 'class', 'm-btn m-btn-border-2 cta__btn bdevs-btn-border' );
            if ( !empty( $settings['button_link2'] ) ) {
                $this->add_link_attributes( 'button2', $settings['button_link2'] );
            }

            if ( !empty( $image ) ) {
                $image = $settings['image']['url'];
            }

            ?>

        <section class="cta__area">
            <div class="container">
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                     <div class="section__title-wrapper text-center mb-45 wow fadeInUp2" data-wow-delay=".3s">
                       <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'title' ),
                            $title
                            );
                        ?>
                        
                        <?php if ( !empty( $settings['desccription'] ) ): ?>
                            <p><?php echo bdevs_element_kses_basic( $settings['desccription'] ); ?></p>
                        <?php endif;?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  <div class="col-xxl-6 offset-xxl-3">
                     <div class="cta__content text-center wow fadeInUp2" data-wow-delay=".5s">
                        <?php if ( !empty($settings['button_text']) ): ?> 
                            <?php if ( $settings['button_text'] && (  ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) && empty( $settings['button_icon'] ) ) ):
                            printf( '<a %1$s>%2$s</a>',
                                $this->get_render_attribute_string( 'button' ),
                                esc_html( $settings['button_text'] )
                            );
                            elseif ( empty( $settings['button_text'] ) && (  ( !empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || !empty( $settings['button_icon'] ) ) ): ?>
                            <a <?php $this->print_render_attribute_string( 'button' );?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon' );?></a>
                            <?php elseif ( $settings['button_text'] && (  ( !empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || !empty( $settings['button_icon'] ) ) ):
                            if ( $settings['button_icon_position'] === 'before' ): ?>
                            <a <?php $this->print_render_attribute_string( 'button' );?>><span><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] );?></span> <?php echo esc_html( $settings['button_text'] ); ?></a>
                            <?php
                            else: ?>
                            <a <?php $this->print_render_attribute_string( 'button' );?>><?php echo esc_html( $settings['button_text'] ); ?> <span><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] );?></span></a>
                            <?php endif;
                            endif;?>
                        <?php endif; ?>

                        <?php if ( !empty($settings['button_text2']) ): ?> 
                            <?php if ( $settings['button_text2'] && ( ( empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) && empty( $settings['button_icon2'] ) ) ) :
                                    printf( '<a %1$s>%2$s</a>',
                                        $this->get_render_attribute_string( 'button2' ),
                                        esc_html( $settings['button_text2'] )
                                        );
                                elseif ( empty( $settings['button_text2'] ) && ( ( !empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) || !empty( $settings['button_icon2'] ) ) ) : ?>
                                    <a <?php $this->print_render_attribute_string( 'button2' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2' ); ?></a>
                                <?php elseif ( $settings['button_text2'] && ( ( !empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) || !empty($settings['button_icon2']) ) ) :
                                    if ( $settings['button_icon_position2'] === 'before' ): ?>
                                        <a <?php $this->print_render_attribute_string( 'button2' ); ?>><span><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2'] ); ?></span> <?php echo esc_html($settings['button_text2']); ?></a>
                                        <?php
                                    else: ?>
                                        <a <?php $this->print_render_attribute_string( 'button2' ); ?>><?php echo esc_html($settings['button_text2']); ?> <span><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2'] ); ?></span></a>
                                    <?php
                                    endif;
                            endif; ?>
                        <?php endif; ?>

                        <?php if ( !empty( $settings['cta_info'] ) ): ?>
                            <p><?php echo bdevs_element_kses_basic( $settings['cta_info'] ); ?></p>
                        <?php endif;?>
                     </div>
                  </div>
               </div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_3' ):

            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'section__title text-white' );

            $this->add_render_attribute( 'button', 'class', 'm-btn m-btn-white-2 cta__btn bdevs-btn' );
            $this->add_render_attribute( 'button2', 'class', 'm-btn m-btn-border-4 cta__btn bdevs-btn-border' );

            if ( !empty( $settings['button_link'] ) ) {
                $this->add_link_attributes( 'button', $settings['button_link'] );
            }
            if ( !empty( $settings['button_link2'] ) ) {
                $this->add_link_attributes( 'button2', $settings['button_link2'] );
            }
        ?>

        <section class="cta__area">
            <div class="container">
               <div class="cta__bg cta__inner pt-90 pb-90">
                  <div class="row">
                     <div class="col-xxl-6 offset-xxl-3 col-lg-8 offset-lg-2 col-md-10 offset-md-1">
                        <div class="section__title-wrapper text-center mb-45 wow fadeInUp2" data-wow-delay=".3s">
                           <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                $title
                                );
                            ?>

                            <?php if ($settings['desccription']): ?>
                                <p class="text-white opacity-7"><?php echo bdevs_element_kses_intermediate($settings['desccription']); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
                  <div class="row">
                     <div class="col-xxl-6 offset-xxl-3">
                        <div class="cta__content text-center wow fadeInUp2" data-wow-delay=".5s">
                            <?php if ( !empty($settings['button_text']) ): ?> 
                                <?php if ( $settings['button_text'] && (  ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) && empty( $settings['button_icon'] ) ) ):
                                        printf( '<a %1$s>%2$s</a>',
                                            $this->get_render_attribute_string( 'button' ),
                                            esc_html( $settings['button_text'] )
                                        );
                                        elseif ( empty( $settings['button_text'] ) && (  ( !empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || !empty( $settings['button_icon'] ) ) ): ?>
                                        <a <?php $this->print_render_attribute_string( 'button' );?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon' );?></a>
                                        <?php elseif ( $settings['button_text'] && (  ( !empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || !empty( $settings['button_icon'] ) ) ):
                                        if ( $settings['button_icon_position'] === 'before' ): ?>
                                        <a <?php $this->print_render_attribute_string( 'button' );?>><span><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] );?></span> <?php echo esc_html( $settings['button_text'] ); ?></a>
                                        <?php
                                        else: ?>
                                        <a <?php $this->print_render_attribute_string( 'button' );?>><?php echo esc_html( $settings['button_text'] ); ?> <span><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] );?></span></a>
                                        <?php endif;
                                    endif;?>
                            <?php endif; ?>

                            <?php if ( !empty($settings['button_text2']) ): ?> 
                                <?php if ( $settings['button_text2'] && ( ( empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) && empty( $settings['button_icon2'] ) ) ) :
                                        printf( '<a %1$s>%2$s</a>',
                                            $this->get_render_attribute_string( 'button2' ),
                                            esc_html( $settings['button_text2'] )
                                            );
                                    elseif ( empty( $settings['button_text2'] ) && ( ( !empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) || !empty( $settings['button_icon2'] ) ) ) : ?>
                                        <a <?php $this->print_render_attribute_string( 'button2' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2' ); ?></a>
                                    <?php elseif ( $settings['button_text2'] && ( ( !empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) || !empty($settings['button_icon2']) ) ) :
                                        if ( $settings['button_icon_position2'] === 'before' ): ?>
                                            <a <?php $this->print_render_attribute_string( 'button2' ); ?>><span><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2'] ); ?></span> <?php echo esc_html($settings['button_text2']); ?></a>
                                            <?php
                                        else: ?>
                                            <a <?php $this->print_render_attribute_string( 'button2' ); ?>><?php echo esc_html($settings['button_text2']); ?> <span><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2'] ); ?></span></a>
                                        <?php
                                        endif;
                                    endif; ?>
                            <?php endif; ?>

                            <?php if ($settings['cta_info']): ?>
                                <p class="text-white opacity-7"><?php echo bdevs_element_kses_intermediate($settings['cta_info']); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </section>

        <?php elseif ( $settings['design_style'] === 'style_2' ):
            if ( !empty($settings['image']['id']) ){
                $image = wp_get_attachment_image_url( $settings['image']['id'], 'full' );
            }
            if ( !empty($settings['image2']['id']) ){
                $image2 = wp_get_attachment_image_url( $settings['image2']['id'], 'full' );
            }

            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'banner__title' );
            $this->add_inline_editing_attributes( 'title2', 'basic' );
            $this->add_render_attribute( 'title2', 'class', 'banner__title' );

            $this->add_render_attribute( 'button', 'class', 'm-btn m-btn-white banner__more bdevs-btn' );
            $this->add_render_attribute( 'button2', 'class', 'm-btn m-btn-white banner__more bdevs-btn-border' );

            if ( !empty( $settings['button_link'] ) ) {
                $this->add_link_attributes( 'button', $settings['button_link'] );
            }
            if ( !empty( $settings['button_link2'] ) ) {
                $this->add_link_attributes( 'button2', $settings['button_link2'] );
            }

            ?>

            <section class="banner__area">
                <div class="container">
                   <div class="row">
                      <div class="col-xxl-6 col-xl-6 col-md-6">
                         <div class="banner__item mb-30 wow fadeInUp2" data-wow-delay=".3s" style="background-image:url(<?php print esc_url($image); ?>);">
                           <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                $title
                                );
                            ?>

                            <?php if ($settings['desccription']): ?>
                                <p><?php echo bdevs_element_kses_intermediate($settings['desccription']); ?></p>
                            <?php endif; ?>

                            <?php if ( !empty($settings['button_text']) ): ?> 
                                <?php if ( $settings['button_text'] && (  ( empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) && empty( $settings['button_icon'] ) ) ):
                                printf( '<a %1$s>%2$s</a>',
                                    $this->get_render_attribute_string( 'button' ),
                                    esc_html( $settings['button_text'] )
                                );
                                elseif ( empty( $settings['button_text'] ) && (  ( !empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || !empty( $settings['button_icon'] ) ) ): ?>
                                <a <?php $this->print_render_attribute_string( 'button' );?>><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon' );?></a>
                                <?php elseif ( $settings['button_text'] && (  ( !empty( $settings['button_selected_icon'] ) || empty( $settings['button_selected_icon']['value'] ) ) || !empty( $settings['button_icon'] ) ) ):
                                if ( $settings['button_icon_position'] === 'before' ): ?>
                                <a <?php $this->print_render_attribute_string( 'button' );?>><span><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] );?></span> <?php echo esc_html( $settings['button_text'] ); ?></a>
                                <?php
                                else: ?>
                                <a <?php $this->print_render_attribute_string( 'button' );?>><?php echo esc_html( $settings['button_text'] ); ?> <span><?php bdevs_element_render_icon( $settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon'] );?></span></a>
                                <?php endif;
                                endif;?>
                            <?php endif; ?>

                         </div>
                      </div>
                      <div class="col-xxl-6 col-xl-6 col-md-6">
                         <div class="banner__item mb-30 wow fadeInUp2" data-wow-delay=".7s" style="background-image:url(<?php print esc_url($image2); ?>)">
                               <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                                    tag_escape( $settings['title_tag2'] ),
                                    $this->get_render_attribute_string( 'title2' ),
                                    $title2
                                    );
                                ?>
                                
                                <?php if ($settings['desccription2']): ?>
                                    <p><?php echo bdevs_element_kses_intermediate($settings['desccription2']); ?></p>
                                <?php endif; ?>

                            <?php if ( !empty($settings['button_text2']) ): ?>
                                <?php if ( $settings['button_text2'] && ( ( empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) && empty( $settings['button_icon2'] ) ) ) :
                                        printf( '<a %1$s>%2$s</a>',
                                            $this->get_render_attribute_string( 'button2' ),
                                            esc_html( $settings['button_text2'] )
                                            );
                                    elseif ( empty( $settings['button_text2'] ) && ( ( !empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) || !empty( $settings['button_icon2'] ) ) ) : ?>
                                        <a <?php $this->print_render_attribute_string( 'button2' ); ?>><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2' ); ?></a>
                                    <?php elseif ( $settings['button_text2'] && ( ( !empty( $settings['button_selected_icon2'] ) || empty( $settings['button_selected_icon2']['value'] ) ) || !empty($settings['button_icon2']) ) ) :
                                        if ( $settings['button_icon_position2'] === 'before' ): ?>
                                            <a <?php $this->print_render_attribute_string( 'button2' ); ?>><span><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2'] ); ?></span> <?php echo esc_html($settings['button_text2']); ?></a>
                                            <?php
                                        else: ?>
                                            <a <?php $this->print_render_attribute_string( 'button2' ); ?>><?php echo esc_html($settings['button_text2']); ?> <span><?php bdevs_element_render_icon( $settings, 'button_icon2', 'button_selected_icon2', ['class' => 'bdevs-btn-icon2'] ); ?></span></a>
                                        <?php
                                        endif;
                                endif; ?>
                            <?php endif; ?>
                         </div>
                      </div>
                   </div>
                </div>
            </section>


        <?php else:

            $this->add_inline_editing_attributes( 'title', 'basic' );
            $this->add_render_attribute( 'title', 'class', 'subscribe__title' );

            $this->add_render_attribute( 'button', 'class', 'w-btn w-btn-white bdevs-btn' );
            $this->add_render_attribute( 'button2', 'class', 'z-btn z-btn-transparent mb-30' );

            if ( !empty( $settings['button_link'] ) ) {
                $this->add_link_attributes( 'button', $settings['button_link'] );
            }
            if ( !empty( $settings['button_link2'] ) ) {
                $this->add_link_attributes( 'button2', $settings['button_link2'] );
            }
        ?>


        <section class="subscribe__area p-relative">
            <?php if ( !empty($settings['shape_switch']) ): ?>
            <div class="subscribe__icon">
               <img class="ps" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/ps.png" alt="img">
               <img class="wp" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/wp.png" alt="img">
               <img class="html" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/html.png" alt="img">
               <img class="f" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/f.png" alt="img">
               <img class="man" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/subscribe/man.png" alt="img">
            </div>
            <?php endif;?>
            <div class="container">
               <div class="row">
                  <div class="col-xxl-12">
                     <div class="subscribe__content text-center wow fadeInUp2" data-wow-delay=".5s">
                       <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['title_tag'] ),
                            $this->get_render_attribute_string( 'title' ),
                            $title
                            );
                        ?>
                        <?php if ($settings['desccription']): ?>
                            <p><?php echo bdevs_element_kses_intermediate($settings['desccription']); ?></p>
                        <?php endif; ?>

                        <div class="subscribe__form wow fadeInUp2" data-wow-delay=".7s">
                            <?php
                                if (!empty($settings['form_id'])) {
                                    echo bdevs_element_do_shortcode('contact-form-7', [
                                        'id' => $settings['form_id'],
                                        'html_class' => 'bdevs-cf7-form ' . bdevs_element_sanitize_html_class_param($settings['html_class']),
                                    ]);
                                }
                            ?>
                            <?php if ($settings['cta_info']): ?>
                                <p><?php echo bdevs_element_kses_intermediate($settings['cta_info']); ?></p>
                            <?php endif; ?>
                        </div>
                     </div>
                  </div>
               </div>
            </div>
        </section>

        <?php endif;?>
        <?php
    }
}

