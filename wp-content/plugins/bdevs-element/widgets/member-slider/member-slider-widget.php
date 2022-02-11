<?php
namespace BdevsElement\Widget;

use \Elementor\Group_Control_Background;
use \Elementor\Repeater;
use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Image_Size;
use \Elementor\Group_Control_Typography;
use \Elementor\Group_Control_Box_Shadow;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Utils;

defined( 'ABSPATH' ) || die();

class Member_Slider extends BDevs_El_Widget {

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
        return 'member_slider';
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
        return __( 'Member Slider', 'bdevs-element' );
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
        return 'eicon-lock-user';
    }

    public function get_keywords() {
        return [ 'slider', 'memeber', 'gallery', 'carousel' ];
    }

    protected function register_content_controls() {

        $this->start_controls_section(
            '_section_design_style',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
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
            ]
        );

        $this->add_control(
            'sec_title_tag',
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
            'sec_align',
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


        $this->start_controls_section(
            '_section_button_style',
            [
                'label' => __( 'Button', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );  

        $this->add_control(
            'button_text',
            [
                'label' => __('Text', 'bdevs-element'),
                'type' => Controls_Manager::TEXT,
                'default' => __('Button Text', 'bdevs-element'),
                'placeholder' => __('Type button text here', 'bdevs-element'),
                'label_block' => true,
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'button_link',
            [
                'label' => __('Link', 'bdevs-element'),
                'type' => Controls_Manager::URL,
                'placeholder' => __('http://elementor.bdevs.net/', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        if (bdevs_element_is_elementor_version('<', '2.6.0')) {
            $this->add_control(
                'button_icon',
                [
                    'label' => __('Icon', 'bdevs-element'),
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
                'label' => __('Icon Position', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'label_block' => false,
                'options' => [
                    'before' => [
                        'title' => __('Before', 'bdevs-element'),
                        'icon' => 'eicon-h-align-left',
                    ],
                    'after' => [
                        'title' => __('After', 'bdevs-element'),
                        'icon' => 'eicon-h-align-right',
                    ],
                ],
                'default' => 'after',
                'toggle' => false,
                'condition' => $condition,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'button_icon_spacing',
            [
                'label' => __('Icon Spacing', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'size' => 10
                ],
                'condition' => $condition,
                'selectors' => [
                    '{{WRAPPER}} .btn--icon-before .btn-icon' => 'margin-right: {{SIZE}}{{UNIT}};',
                    '{{WRAPPER}} .btn--icon-after .btn-icon' => 'margin-left: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->end_controls_section();



        // member list
        $this->start_controls_section(
            '_section_slides',
            [
                'label' => __( 'Members List', 'bdevs-element' ),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $repeater = new Repeater();

        $repeater->start_controls_tabs(
            '_tab_style_member_box_slider'
        );

        $repeater->start_controls_tab(
            '_tab_member_info',
            [
                'label' => __( 'Information', 'bdevs-element' ),
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
            'title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'label' => __( 'Title', 'bdevs-element' ),
                'default' => __( 'BDevs Member Title', 'bdevs-element' ),
                'placeholder' => __( 'Type title here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'designation',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => true,
                'label' => __( 'Job Title', 'bdevs-element' ),
                'default' => __( 'BDevs Officer', 'bdevs-element' ),
                'placeholder' => __( 'Type designation here', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );   

        $repeater->add_control(
            'slide_url',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => true,
                'show_label' => false,
                'placeholder' => __( 'Type link here', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->end_controls_tab();

        $repeater->start_controls_tab(
            '_tab_member_links',
            [
                'label' => __( 'Links', 'bdevs-element' ),
            ]
        );

        $repeater->add_control(
            'show_social',
            [
                'label' => __( 'Show Options?', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __( 'Yes', 'bdevs-element' ),
                'label_off' => __( 'No', 'bdevs-element' ),
                'return_value' => 'yes',
                'style_transfer' => true,
            ]
        );

        $repeater->add_control(
            'web_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Website Address', 'bdevs-element' ),
                'placeholder' => __( 'Add your profile link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'email_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Email', 'bdevs-element' ),
                'placeholder' => __( 'Add your email link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );           

        $repeater->add_control(
            'phone_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Phone', 'bdevs-element' ),
                'placeholder' => __( 'Add your phone link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'facebook_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Facebook', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'Add your facebook link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );                

        $repeater->add_control(
            'twitter_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Twitter', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'Add your twitter link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'instagram_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Instagram', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'Add your instagram link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );       

        $repeater->add_control(
            'linkedin_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'LinkedIn', 'bdevs-element' ),
                'default' => __( '#', 'bdevs-element' ),
                'placeholder' => __( 'Add your linkedin link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'youtube_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Youtube', 'bdevs-element' ),
                'placeholder' => __( 'Add your youtube link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'googleplus_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Google Plus', 'bdevs-element' ),
                'placeholder' => __( 'Add your Google Plus link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'flickr_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Flickr', 'bdevs-element' ),
                'placeholder' => __( 'Add your flickr link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'vimeo_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Vimeo', 'bdevs-element' ),
                'placeholder' => __( 'Add your vimeo link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'behance_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Behance', 'bdevs-element' ),
                'placeholder' => __( 'Add your hehance link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'dribble_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Dribbble', 'bdevs-element' ),
                'placeholder' => __( 'Add your dribbble link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );        

        $repeater->add_control(
            'pinterest_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Pinterest', 'bdevs-element' ),
                'placeholder' => __( 'Add your pinterest link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $repeater->add_control(
            'gitub_title',
            [
                'type' => Controls_Manager::TEXT,
                'label_block' => false,
                'label' => __( 'Github', 'bdevs-element' ),
                'placeholder' => __( 'Add your github link', 'bdevs-element' ),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        ); 

        $repeater->end_controls_tab();
        $repeater->end_controls_tabs();

        // REPEATER
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
                    '{{WRAPPER}} .single-carousel-item' => 'text-align: {{VALUE}};'
                ]
            ]
        );

        $this->end_controls_section();

        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __( 'Design Style', 'bdevs-element' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'slider_active',
            [
                'label' => __( 'Slider active on/off', 'bdevs-element' ),
                'type' => Controls_Manager::SWITCHER,
                'default' =>true,
                'condition' => [
                    'design_style' => ['style_10']
                ],
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
                'condition' => [
                    'design_style' => ['style_10']
                ],
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
                'condition' => [
                    'design_style' => ['style_10']
                ],
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
                    'autoplay' => 'yes',
                    'design_style' => ['style_10']
                ],
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
                'condition' => [
                    'design_style' => ['style_10']
                ],
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
                'condition' => [
                    'design_style' => ['style_10']
                ],
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
                'condition' => [
                    'design_style' => ['style_10']
                ],
            ]
        );

        $this->end_controls_section();


    }

    protected function register_style_controls() {

        $this->start_controls_section(
            '_section_style_content',
            [
                'label' => __( 'Team Content', 'bdevs-element' ),
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
                    '{{WRAPPER}} .zt-item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
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
                    '{{WRAPPER}} .team-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team-title' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title',
                'selector' => '{{WRAPPER}} .team-title',
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
                    '{{WRAPPER}} .team__info span' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_control(
            'subtitle_color',
            [
                'label' => __( 'Text Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .team__info span' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'subtitle',
                'selector' => '{{WRAPPER}} .team__info span',
                'scheme' => Typography::TYPOGRAPHY_3,
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
            '_tab_service_button_hover',
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
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus' => 'color: {{VALUE}};',
                ],
            ]
        );

        $this->add_control(
            'button_hover_bg_color',
            [
                'label' => __( 'Background Color', 'bdevs-element' ),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus' => 'background-color: {{VALUE}};',
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
                    '{{WRAPPER}} .bdevs-btn:hover, {{WRAPPER}} .bdevs-btn:focus' => 'border-color: {{VALUE}};',
                ],
            ]
        );

        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->end_controls_section();




    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'team-title' );
        $this->add_render_attribute( 'name', 'class', 'name' );

        $this->add_inline_editing_attributes( 'description', 'intermediate' );
        $this->add_render_attribute( 'description', 'class', 'bdevs-card-text' );

        if (!empty($title)) {
            $title = bdevs_element_kses_basic( $settings['title' ] );
        }
        
        if ( empty( $settings['slides'] ) ) {
            return;
        }
        ?>

    <?php if ( $settings['design_style'] === 'style_1' ): 

        // bg_image
        if (!empty($settings['bg_shape_image']['id'])) {
            $bg_shape_image = wp_get_attachment_image_url( $settings['bg_shape_image']['id'], $settings['shape_size'] );
            if ( ! $bg_shape_image ) {
                $bg_shape_image = $settings['bg_shape_image']['url'];
            }  
        }  

        $slider_active = !empty($settings['slider_active']) ? 'team1__carousel owl-carousel' : '';

        $this->add_inline_editing_attributes( 'title_slider', 'basic' );
        $this->add_render_attribute( 'title_slider', 'class', 'team__title' );

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section__title section__title-2' );

        $this->add_inline_editing_attributes( 'designation', 'basic' );
        $this->add_render_attribute( 'designation', 'class', 'team__position' );

        $this->add_render_attribute('button', 'class', 'w-btn w-btn-blue w-btn-7 bdevs-btn');
        $this->add_link_attributes('button', $settings['button_link']);

        $title = bdevs_element_kses_basic( $settings['title'] );
    ?>


        <section class="team__area grey-bg-3 pt-120 pb-195 overflow-y-visible p-relative">
            <?php if ( !empty($settings['shape_switch']) ): ?>
            <div class="team__shape">
               <img class="team-dot" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/team/home-2/team-dot.png" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="team-triangle" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/team/home-2/team-triangle.png" alt="<?php print esc_attr__('image','wetland'); ?>">
            </div>
            <?php endif;?> 
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-8">
                     <div class="section__title-wrapper mb-70 wow fadeInUp2" data-wow-delay=".3s">
                         <?php if ( $settings['sub_title'] ): ?>
                            <span class="section__pre-title blue"><?php echo bdevs_element_kses_intermediate( $settings['sub_title'] ); ?></span>
                        <?php endif;?>

                        <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['sec_title_tag'] ),
                            $this->get_render_attribute_string( 'title' ),
                            $title
                            );
                        ?>
                     </div>
                  </div>
                  <div class="col-xxl-8 col-xl-7 col-lg-7 col-md-5 col-sm-4">
                     <div class="team__more text-sm-end mb-70">

                            <?php if ($settings['button_text'] && ((empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) && empty($settings['button_icon']))) :
                                printf('<a %1$s href="%3$s">%2$s</a>',
                                    $this->get_render_attribute_string('button'),
                                    esc_html($settings['button_text']),
                                    esc_url($settings['button_link']['url'])
                                );
                            elseif (empty($settings['button_text']) && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) : ?>
                                <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon'); ?></a>
                            <?php elseif ($settings['button_text'] && ((!empty($settings['button_selected_icon']) || empty($settings['button_selected_icon']['value'])) || !empty($settings['button_icon']))) :
                                if ($settings['button_icon_position'] === 'before'): ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>><?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                        <span><?php echo esc_html($settings['button_text']); ?></span></a>
                                <?php
                                else: ?>
                                    <a <?php $this->print_render_attribute_string('button'); ?>>
                                        <span><?php echo esc_html($settings['button_text']); ?></span>
                                        <?php bdevs_element_render_icon($settings, 'button_icon', 'button_selected_icon', ['class' => 'bdevs-btn-icon']); ?>
                                    </a>
                                <?php
                                endif;
                            endif; ?>
                     </div>
                  </div>
               </div>
               <div class="row">
                  
                  <div class="col-xxl-12">
                     <div class="team__slider owl-carousel wow fadeInUp2" data-wow-delay=".5s">
                        <?php foreach ( $settings['slides'] as $slide ) :
                        $title = bdevs_element_kses_basic( $slide['title' ] );
                        $slide_url = esc_url($slide['slide_url']);
                        
                        if (!empty($slide['image']['id'])) {
                            $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                            if ( ! $image ) {
                                $image = !empty($slide['image']['url']) ? $slide['image']['url'] : '' ;
                            }  
                        }          
                    ?>
                        <div class="team__item">
                            <div class="team__thumb w-img p-relative mb-20 fix">
                                <?php if( !empty( $image ) ) : ?>
                                <img src="<?php print esc_url($image); ?>" alt="<?php print esc_attr__('image','wetland'); ?>">
                                <?php endif; ?>

                                <?php if( !empty($slide['show_social'] ) ) : ?>
                                <div class="team__social">
                                    <ul>
                                        <?php if( !empty($slide['web_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>">
                                                <i class="far fa-globe"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['email_title'] ) ) : ?>
                                        <li>    
                                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>">
                                                <i class="fal fa-envelope"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>  

                                        <?php if( !empty($slide['phone_title'] ) ) : ?>
                                        <li>    
                                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>  

                                        <?php if( !empty($slide['facebook_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['twitter_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['instagram_title'] ) ) : ?>
                                        <li>     
                                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['youtube_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>">
                                                <i class="fab fa-google-plus-g"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['flickr_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>">
                                                <i class="fab fa-flickr"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>">
                                                <i class="fab fa-vimeo-v"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['behance_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>">
                                                <i class="fab fa-behance"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['dribble_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>">
                                                <i class="fab fa-dribbble"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>">
                                                <i class="fab fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['gitub_title'] ) ) : ?>
                                        <li>   
                                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                     </ul>
                                </div>
                                <?php endif; ?>
                            </div>

                           <div class="team__content">
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title_slider' ),
                                $title,
                                $slide_url
                                ); 
                            ?>

                            <?php if( !empty( $slide['designation'] ) ) : ?>
                                <span><?php echo bdevs_element_kses_basic( $slide['designation'] ); ?></span>
                            <?php endif; ?>
                           </div>
                        </div>
                        <?php endforeach; ?>
                     </div>
                  </div>
                  
               </div>
            </div>
        </section>


    <!-- style 2 -->
    <?php elseif ( $settings['design_style'] === 'style_2' ): 


        // bg_image
        if (!empty($settings['bg_shape_image']['id'])) {
            $bg_shape_image = wp_get_attachment_image_url( $settings['bg_shape_image']['id'], $settings['shape_size'] );
            if ( ! $bg_shape_image ) {
                $bg_shape_image = $settings['bg_shape_image']['url'];
            }  
        }  

        $slider_active = !empty($settings['slider_active']) ? 'team1__carousel owl-carousel' : '';

        $this->add_inline_editing_attributes( 'title_slider', 'basic' );
        $this->add_render_attribute( 'title_slider', 'class', 'team__title' );

        $this->add_inline_editing_attributes( 'title', 'basic' );
        $this->add_render_attribute( 'title', 'class', 'section__title section__title-2' );

        $this->add_inline_editing_attributes( 'designation', 'basic' );
        $this->add_render_attribute( 'designation', 'class', 'team__position' );

        $title = bdevs_element_kses_basic( $settings['title'] );

    ?>

        <section class="team__area grey-bg-3 pt-120 pb-70 overflow-y-visible p-relative">
            <?php if ( !empty($settings['shape_switch']) ): ?>
            <div class="team__shape">
               <img class="team-dot" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/team/home-2/team-dot.png" alt="<?php print esc_attr__('image','wetland'); ?>">
               <img class="team-triangle" src="<?php echo get_template_directory_uri(); ?>/assets/img/icon/team/home-2/team-triangle.png" alt="<?php print esc_attr__('image','wetland'); ?>">
            </div>
            <?php endif;?> 
            <div class="container">
               <div class="row align-items-end">
                  <div class="col-xxl-4 col-xl-5 col-lg-5 col-md-7 col-sm-8">
                     <div class="section__title-wrapper mb-70 wow fadeInUp2" data-wow-delay=".3s">
                        <?php if ( $settings['sub_title'] ): ?>
                            <span class="section__pre-title blue"><?php echo bdevs_element_kses_intermediate( $settings['sub_title'] ); ?></span>
                        <?php endif;?>

                        <?php printf( '<%1$s %2$s>%3$s</%1$s>',
                            tag_escape( $settings['sec_title_tag'] ),
                            $this->get_render_attribute_string( 'title' ),
                            $title
                            );
                        ?>

                        <?php if ( $settings['description'] ): ?>
                            <p><?php echo bdevs_element_kses_intermediate( $settings['description'] ); ?></p>
                        <?php endif;?>

                     </div>
                  </div>
               </div>
               <div class="row">
                    <?php foreach ( $settings['slides'] as $slide ) :
                        $title = bdevs_element_kses_basic( $slide['title' ] );
                        $slide_url = esc_url($slide['slide_url']);
                        
                        if (!empty($slide['image']['id'])) {
                            $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                            if ( ! $image ) {
                                $image = !empty($slide['image']['url']) ? $slide['image']['url'] : '' ;
                            }  
                        }          
                    ?>
                    <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 wow fadeInUp2" data-wow-delay=".3s">
                        <div class="team__item mb-40">
                            <div class="team__thumb w-img p-relative mb-20 fix">
                               <?php if( !empty( $image ) ) : ?>
                                    <img src="<?php print esc_url($image); ?>" alt="<?php print esc_attr__('image','wetland'); ?>">
                                <?php endif; ?>

                               <?php if( !empty($slide['show_social'] ) ) : ?>
                                <div class="team__social">
                                    <ul>
                                        <?php if( !empty($slide['web_title'] ) ) : ?>
                                        <li>
                                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>">
                                                <i class="far fa-globe"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['email_title'] ) ) : ?>
                                        <li>    
                                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>">
                                                <i class="fal fa-envelope"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>  

                                        <?php if( !empty($slide['phone_title'] ) ) : ?>
                                        <li>    
                                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>">
                                                <i class="fas fa-phone"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>  

                                        <?php if( !empty($slide['facebook_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>">
                                                <i class="fab fa-facebook-f"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['twitter_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>">
                                                <i class="fab fa-twitter"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['instagram_title'] ) ) : ?>
                                        <li>     
                                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>">
                                                <i class="fab fa-instagram"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>">
                                                <i class="fab fa-linkedin-in"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['youtube_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>">
                                                <i class="fab fa-youtube"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>">
                                                <i class="fab fa-google-plus-g"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['flickr_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>">
                                                <i class="fab fa-flickr"></i>
                                            </a>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>">
                                                <i class="fab fa-vimeo-v"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['behance_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>">
                                                <i class="fab fa-behance"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['dribble_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>">
                                                <i class="fab fa-dribbble"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                                        <li>    
                                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>">
                                                <i class="fab fa-pinterest-p"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>

                                        <?php if( !empty($slide['gitub_title'] ) ) : ?>
                                        <li>   
                                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>">
                                                <i class="fab fa-github"></i>
                                            </a>
                                        </li>
                                        <?php endif; ?>
                                     </ul>
                                </div>
                                <?php endif; ?>
                            </div>
                            <div class="team__content">
                                <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                    tag_escape( $settings['title_tag'] ),
                                    $this->get_render_attribute_string( 'title_slider' ),
                                    $title,
                                    $slide_url
                                    ); 
                                ?>
                                <?php if( !empty( $slide['designation'] ) ) : ?>
                                    <span class="team__position">UI UX Designer</span>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                    <?php endforeach; ?>
               </div>
            </div>
        </section>

    <!-- style 3 -->
    <?php elseif ( $settings['design_style'] === 'style_3' ): ?>
    <section class="our-expert-area our-expert-area-2 our-expert-area-3">
        <div class="container">
            <div class="row mt-none-30 team-center-active">
                <?php foreach ( $settings['slides'] as $slide ) :
                    $title = bdevs_element_kses_basic( $slide['title' ] );
                    $slide_url = esc_url($slide['slide_url']);

                    $image = wp_get_attachment_image_url( $slide['image']['id'], $settings['thumbnail_size'] );
                    if ( ! $image ) {
                        $image = $slide['image']['url'];
                    }            

                ?>
                <div class="col-xl-4 col-lg-6 col-sm-12 mt-30">
                    <div class="single-carousel-item">
                        <?php if(!empty($settings['background_overlay_opacity'])) : ?>
                        <div class="elementor-background-overlay"></div>
                        <?php endif;?>
                        <div class="thumb">
                            <?php if( !empty($image) ) : ?>
                            <img src="<?php print esc_url($image); ?>" alt="">
                            <?php endif; ?>

                            <?php if( !empty($badge_image) ) : ?>
                            <span class="icon">
                                <img src="<?php print esc_url($badge_image); ?>" alt="">
                            </span>
                            <?php endif; ?>
                        </div>
                        <div class="content">
                            <?php printf( '<%1$s %2$s><a href="%4$s">%3$s</a></%1$s>',
                                tag_escape( $settings['title_tag'] ),
                                $this->get_render_attribute_string( 'title' ),
                                $title,
                                $slide_url
                            ); ?>
                            <span class="sub-title"><?php echo bdevs_element_kses_basic( $slide['designation'] ); ?></span>
                            <p><?php echo bdevs_element_kses_basic( $slide['description'] ); ?></p>
                        </div>                        
                        <!-- socials -->
                        <?php if( !empty($slide['show_social'] ) ) : ?>
                        <div class="social-links">
                            <?php if( !empty($slide['web_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['web_title'] ); ?>"><i class="far fa-globe"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['email_title'] ) ) : ?>
                            <a href="mailto:<?php echo esc_url( $slide['email_title'] ); ?>"><i class="fal fa-envelope"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['phone_title'] ) ) : ?>
                            <a href="tell:<?php echo esc_url( $slide['phone_title'] ); ?>"><i class="fas fa-phone"></i></a>
                            <?php endif; ?>  

                            <?php if( !empty($slide['facebook_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['facebook_title'] ); ?>"><i class="fab fa-facebook-f"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['twitter_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['twitter_title'] ); ?>"><i class="fab fa-twitter"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['instagram_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['instagram_title'] ); ?>"><i class="fab fa-instagram"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['linkedin_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['linkedin_title'] ); ?>"><i class="fab fa-linkedin-in"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['youtube_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['youtube_title'] ); ?>"><i class="fab fa-youtube"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['googleplus_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['googleplus_title'] ); ?>"><i class="fab fa-google-plus-g"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['flickr_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['flickr_title'] ); ?>"><i class="fab fa-flickr"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['vimeo_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['vimeo_title'] ); ?>"><i class="fab fa-vimeo-v"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['behance_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['behance_title'] ); ?>"><i class="fab fa-behance"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['dribble_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['dribble_title'] ); ?>"><i class="fab fa-dribbble"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['pinterest_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['pinterest_title'] ); ?>"><i class="fab fa-pinterest-p"></i></a>
                            <?php endif; ?>

                            <?php if( !empty($slide['gitub_title'] ) ) : ?>
                            <a href="<?php echo esc_url( $slide['gitub_title'] ); ?>"><i class="fab fa-github"></i></a>
                            <?php endif; ?>
                        </div>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
    </section>
    <?php endif; ?>    

        <?php
    }
}
