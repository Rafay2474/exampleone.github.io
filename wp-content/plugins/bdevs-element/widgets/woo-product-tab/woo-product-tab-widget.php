<?php

namespace BdevsElement\Widget;

use \Elementor\Controls_Manager;
use \Elementor\Group_Control_Border;
use \Elementor\Group_Control_Box_Shadow;
use \Elementor\Group_Control_Typography;
Use \Elementor\Core\Schemes\Typography;
use \Elementor\Group_Control_Background;
use \BdevsElementor\BDevs_El_Select2;

defined('ABSPATH') || die();


class Woo_Product_Tab extends BDevs_El_Widget
{

    /**
     * Get widget name.
     *
     * Retrieve Bdevs Element widget name.
     *
     * @return string Widget name.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_name()
    {
        return 'woo_product_tab';
    }


    /**
     * Get widget title.
     *
     * @return string Widget title.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_title()
    {
        return __('Woo Product Tab', 'bdevs-element');
    }

    public function get_custom_help_url()
    {
        return 'http://elementor.bdevs.net//widgets/post-tab/';
    }

    /**
     * Get widget icon.
     *
     * @return string Widget icon.
     * @since 1.0.0
     * @access public
     *
     */
    public function get_icon()
    {
        return 'eicon-product-tabs';
    }

    public function get_keywords()
    {
        return ['posts', 'post', 'post-tab', 'tab', 'news'];
    }

    /**
     * Get a list of All Post Types
     *
     * @return array
     */
    public static function get_post_types()
    {
        $diff_key = [
            'elementor_library' => '',
            'attachment' => '',
            'page' => ''
        ];
        $post_types = bdevs_element_get_post_types([], $diff_key);

        return $post_types;
    }

    /**
     * Get a list of Taxonomy
     *
     * @return array
     */
    public static function get_taxonomies($post_type = '')
    {
        $list = [];
        if ($post_type) {
            $tax = bdevs_element_get_taxonomies([
                'public' => true,
                "object_type" => [$post_type]
            ], 'object', true);
            $list[$post_type] = count($tax) !== 0 ? $tax : '';
        } else {
            $list = bdevs_element_get_taxonomies(['public' => true], 'object', true);
        }

        return $list;
    }

    protected function register_content_controls()
    {
        $this->start_controls_section(
            '_section_title',
            [
                'label' => __('Title & Description', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'sub_title',
            [
                'label' => __('Sub Title', 'bdevs-element'),
                'label_block' => true,
                'type' => Controls_Manager::TEXT,
                'default' => 'Heading Sub Title',
                'placeholder' => __('Heading Sub Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title',
            [
                'label' => __('Title', 'bdevs-element'),
                'type' => Controls_Manager::TEXTAREA,
                'default' => 'Heading Title',
                'placeholder' => __('Heading Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'description',
            [
                'label' => __('Description', 'bdevs-element'),
                'type' => Controls_Manager::TEXTAREA,
                'placeholder' => __('Heading Description Text', 'bdevs-element'),
                'dynamic' => [
                    'active' => true,
                ]
            ]
        );

        $this->add_control(
            'title_tag',
            [
                'label' => __('Title HTML Tag', 'elementor'),
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
                'default' => 'h4',
            ]
        );

        $this->add_responsive_control(
            'align',
            [
                'label' => __('Alignment', 'bdevs-element'),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __('Left', 'bdevs-element'),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __('Center', 'bdevs-element'),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __('Right', 'bdevs-element'),
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
            '_section_post_tab_query',
            [
                'label' => __('Query', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'post_type',
            [
                'label' => __('Source', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => $this->get_post_types(),
                'default' => key($this->get_post_types()),
            ]
        );

        foreach (self::get_post_types() as $key => $value) {
            $taxonomy = self::get_taxonomies($key);
            if (!$taxonomy[$key]) {
                continue;
            }
            $this->add_control(
                'tax_type_' . $key,
                [
                    'label' => __('Taxonomies', 'bdevs-element'),
                    'type' => Controls_Manager::SELECT,
                    'options' => $taxonomy[$key],
                    'default' => key($taxonomy[$key]),
                    'condition' => [
                        'post_type' => $key
                    ],
                ]
            );

            foreach ($taxonomy[$key] as $tax_key => $tax_value) {

                $this->add_control(
                    'tax_ids_' . $tax_key,
                    [
                        'label' => __('Select ', 'bdevs-element') . $tax_value,
                        'label_block' => true,
                        'type' => 'bdevselement-select2',
                        'multiple' => true,
                        'placeholder' => 'Search ' . $tax_value,
                        'data_options' => [
                            'tax_id' => $tax_key,
                            'action' => 'bdevs_element_post_tab_select_query'
                        ],
                        'condition' => [
                            'post_type' => $key,
                            'tax_type_' . $key => $tax_key
                        ],
                        'render_type' => 'template',
                    ]
                );
            }
        }

        $this->add_control(
            'item_limit',
            [
                'label' => __('Item Limit', 'bdevs-element'),
                'type' => Controls_Manager::NUMBER,
                'default' => 3,
                'dynamic' => ['active' => true],
            ]
        );

        $this->end_controls_section();

        //Settings
        $this->start_controls_section(
            '_section_settings',
            [
                'label' => __('Settings', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
            'design_style',
            [
                'label' => __('Design Style', 'bdevs-element'),
                'type' => Controls_Manager::SELECT,
                'options' => [
                    'style_1' => __('Style 1', 'bdevs-element'),
                ],
                'default' => 'style_1',
                'frontend_available' => true,
                'style_transfer' => true,
            ]
        );

        $this->add_control(
            'excerpt',
            [
                'label' => __('Show Excerpt', 'bdevs-element'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevs-element'),
                'label_off' => __('Hide', 'bdevs-element'),
                'return_value' => 'yes',
                'default' => '',
            ]
        );

        $this->add_control(
            'product_zoom_switch',
            [
                'label' => __('Product Zoom Show/Hide', 'bdevselement'),
                'type' => Controls_Manager::SWITCHER,
                'label_on' => __('Show', 'bdevselement'),
                'label_off' => __('Hide', 'bdevselement'),
                'return_value' => 'yes',
                'default' => 'yes',
                'style_transfer' => true,
            ]
        );

        $this->end_controls_section();
    }

    protected function register_style_controls()
    {

        $this->start_controls_section(
            '_section_post_tab_filter',
            [
                'label' => __('Tab', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'tab_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'filter_pos' => 'top',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'tab_shadow',
                'label' => __('Box Shadow', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter',
            ]
        );

        $this->add_responsive_control(
            'tab_item',
            [
                'label' => __('Tab Item', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );

        $this->add_responsive_control(
            'tab_item_margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'tab_item_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->start_controls_tabs('tab_item_tabs');
        $this->start_controls_tab(
            'tab_item_normal_tab',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'tab_item_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li' => 'color: {{VALUE}}',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_background',
                'label' => __('Background', 'bdevs-element'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li',
            ]
        );

        $this->end_controls_tab();

        $this->start_controls_tab(
            'tab_item_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'tab_item_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li.active' => 'color: {{VALUE}}',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li:hover' => 'color: {{VALUE}}',
                ],
            ]
        );


        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'tab_item_hvr_background',
                'label' => __('Background', 'bdevs-element'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li.active,{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li:hover',
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'tab_item_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'tab_item_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li',
            ]
        );

        $this->add_responsive_control(
            'tab_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-filter li' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();

        //Column
        $this->start_controls_section(
            '_section_post_tab_column',
            [
                'label' => __('Column', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_item_space',
            [
                'label' => __('Space Between', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item' => 'padding-left: {{SIZE}}{{UNIT}};padding-right: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 30,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_item_padding',
            [
                'label' => __('Padding', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'post_item_background',
                'label' => __('Background', 'bdevs-element'),
                'types' => ['classic', 'gradient'],
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'post_item_box_shadow',
                'label' => __('Box Shadow', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'post_item_border',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner',
            ]
        );

        $this->add_responsive_control(
            'post_item_border_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', 'em', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );
        $this->end_controls_section();

        //Content Style
        $this->start_controls_section(
            '_section_post_tab_content',
            [
                'label' => __('Content', 'bdevs-element'),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );

        $this->add_responsive_control(
            'post_content_image',
            [
                'label' => __('Image', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
            ]
        );

        $this->add_responsive_control(
            'post_item_content_img_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'image_boder',
                'label' => __('Border', 'bdevs-element'),
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb img',
            ]
        );

        $this->add_responsive_control(
            'image_boder_radius',
            [
                'label' => __('Border Radius', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-thumb img' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
            ]
        );

        $this->add_responsive_control(
            'post_content_title',
            [
                'label' => __('Title', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_responsive_control(
            'post_content_margin_btm',
            [
                'label' => __('Margin Bottom', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 10,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title' => 'margin-bottom: {{SIZE}}{{UNIT}};',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'title_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_2,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title',
            ]
        );

        $this->start_controls_tabs('title_tabs');
        $this->start_controls_tab(
            'title_normal_tab',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'title_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title a' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'title_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'title_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-item-inner .bdevselement-post-tab-title a:hover' => 'color: {{VALUE}}',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'post_content_meta',
            [
                'label' => __('Meta', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before'
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'meta_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span',
            ]
        );

        $this->start_controls_tabs('meta_tabs');
        $this->start_controls_tab(
            'meta_normal_tab',
            [
                'label' => __('Normal', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'meta_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();

        $this->start_controls_tab(
            'meta_hover_tab',
            [
                'label' => __('Hover', 'bdevs-element'),
            ]
        );

        $this->add_control(
            'meta_hvr_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span:hover a' => 'color: {{VALUE}};',
                ],
            ]
        );
        $this->end_controls_tab();
        $this->end_controls_tabs();

        $this->add_responsive_control(
            'meta__margin',
            [
                'label' => __('Margin', 'bdevs-element'),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => ['px', '%'],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-meta span' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ]
            ]
        );

        $this->add_responsive_control(
            'post_content_excerpt',
            [
                'label' => __('Excerpt', 'bdevs-element'),
                'type' => Controls_Manager::HEADING,
                'separator' => 'before',
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'excerpt_typography',
                'label' => __('Typography', 'bdevs-element'),
                'scheme' => Typography::TYPOGRAPHY_3,
                'selector' => '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt p',
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_control(
            'excerpt_color',
            [
                'label' => __('Color', 'bdevs-element'),
                'type' => Controls_Manager::COLOR,
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt p' => 'color: {{VALUE}};',
                ],
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->add_responsive_control(
            'excerpt_margin_top',
            [
                'label' => __('Margin Top', 'bdevs-element'),
                'type' => Controls_Manager::SLIDER,
                'default' => [
                    'unit' => 'px',
                    'size' => 15,
                ],
                'selectors' => [
                    '{{WRAPPER}} .bdevselement-post-tab .bdevselement-post-tab-excerpt' => 'margin-top: {{SIZE}}{{UNIT}};',
                ],
                'condition' => [
                    'excerpt' => 'yes',
                ],
            ]
        );

        $this->end_controls_section();
    }

    protected function render()
    {

        $settings = $this->get_settings_for_display();
        if (!$settings['post_type']) {
            return;
        }

        $taxonomy = $settings['tax_type_' . $settings['post_type']];
        $terms_ids = $settings['tax_ids_' . $taxonomy];
        $terms_args = [
            'taxonomy' => $taxonomy,
            'hide_empty' => true,
            'include' => $terms_ids,
            'orderby' => 'term_id',
        ];
        $filter_list = get_terms($terms_args);

        $post_args = [
            'post_status' => 'publish',
            'post_type' => $settings['post_type'],
            'posts_per_page' => $settings['item_limit'],
            'tax_query' => array(
                array(
                    'taxonomy' => $taxonomy,
                    'field' => 'term_id',
                    'terms' => $terms_ids ? $terms_ids : '',
                ),
            ),
        ];
        $posts = get_posts($post_args);
        ?>
        <?php if (!empty($settings['design_style']) and $settings['design_style'] == 'style_2'): ?>
        <div class="all__product pt-50 pb-25">
            <div class="all__product--nav">
                <div class="container">
                    <div class="row all__product--row align-items-center justify-content-between">
                        <div class="col-xl-12">
                            <div class="all__product--menu mb-30 text-center">
                                <nav>
                                    <div class="nav nav-tabs" id="product-tab-nav-3" role="tablist">
                                        <?php
                                        $i = 1;
                                        foreach ($filter_list as $list):
                                            ?>
                                            <?php if ($i === 1): ?>
                                            <a class="nav-item nav-link btn orange-bg-btn pure__black-color active"
                                               id="product-tab-<?php print $i; ?>"
                                               data-toggle="tab"
                                               href="#product-tabs-<?php print $i; ?>" role="tab"
                                               aria-controls="product-tabs-<?php print $i; ?>"
                                               aria-selected="true">
                                                <?php echo esc_html($list->name); ?>
                                            </a>
                                        <?php else: ?>
                                            <a class="nav-item nav-link btn gray-bg-btn pure__black-color"
                                               id="product-tab-<?php print $i; ?>"
                                               data-toggle="tab"
                                               href="#product-tabs-<?php print $i; ?>" role="tab"
                                               aria-controls="product-tabs-<?php print $i; ?>"
                                               aria-selected="false">
                                                <?php echo esc_html($list->name); ?>
                                            </a>
                                        <?php endif; ?>
                                            <?php $i++; endforeach; ?>
                                    </div>
                                </nav>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="all__product--body">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="product-tap-wrapper">
                                <div class="tab-content" id="product-tab-content-3">
                                    <?php
                                    $i = 1;
                                    foreach ($filter_list as $list):
                                        ?>
                                        <?php if ($i === 1): ?>
                                        <div class="tab-pane fade active show" id="product-tabs-<?php print $i; ?>"
                                             role="tabpanel"
                                             aria-labelledby="product-tab-<?php print $i; ?>">
                                            <div class="product-tab-contents">
                                                <?php
                                                $post_args = [
                                                    'post_status' => 'publish',
                                                    'post_type' => $settings['post_type'],
                                                    'posts_per_page' => $settings['item_limit'],
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => $taxonomy,
                                                            'field' => 'term_id',
                                                            'terms' => !empty($list->term_id) ? $list->term_id : '',
                                                        ),
                                                    ),
                                                ];
                                                $posts = get_posts($post_args);
                                                ?>
                                                <div class="product__active owl-carousel">
                                                    <?php
                                                    foreach ($posts as $post): ?>
                                                        <div class="product__single">
                                                            <div class="product__box">
                                                                <?php if (has_post_thumbnail($post->ID)): ?>
                                                                    <div class="product__thumb">
                                                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                                                            <?php echo get_the_post_thumbnail($post->ID, 'full', ['class' => 'img']); ?>
                                                                        </a>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <div class="product__content--top">
																			<span class="cate-name">
																				<?php
                                                                                $item_cats = get_the_terms($post->ID, $taxonomy);
                                                                                if (!empty($item_cats)):
                                                                                    $cat_link = get_term_link($item_cats[0]);
                                                                                    echo '<a href="' . esc_url($cat_link) . '">' . $item_cats[0]->name . '</a>';
                                                                                endif;
                                                                                ?>
																			</span>

                                                                    <h6 class="product__title mine__shaft-color f-700 mb-0">
                                                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                                                            <?php echo esc_html($post->post_title); ?>
                                                                        </a>
                                                                    </h6>

                                                                    <?php if ('yes' === $settings['excerpt'] && !empty($post->post_excerpt)): ?>
                                                                        <div class="project-excerpt">
                                                                            <p><?php echo esc_html($post->post_excerpt); ?></p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="product__content--rating d-flex justify-content-between">
                                                                    <div class="rating">
                                                                        <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating($post->ID); ?>
                                                                    </div>
                                                                    <div class="price">
                                                                        <h5 class="grenadier-color f-600">
                                                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-action">
                                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($post->ID); ?>
                                                                <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                                                    <i class="lnr lnr-eye"></i>
                                                                </a>
                                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>
                                                                <!--																	<a href="#"><span class="lnr lnr-sync"></span></a>-->
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php else: ?>
                                        <div class="tab-pane fade" id="product-tabs-<?php print $i; ?>" role="tabpanel"
                                             aria-labelledby="product-tab-<?php print $i; ?>">
                                            <div class="product-tab-contents">
                                                <?php
                                                $post_args = [
                                                    'post_status' => 'publish',
                                                    'post_type' => $settings['post_type'],
                                                    'posts_per_page' => $settings['item_limit'],
                                                    'tax_query' => array(
                                                        array(
                                                            'taxonomy' => $taxonomy,
                                                            'field' => 'term_id',
                                                            'terms' => !empty($list->term_id) ? $list->term_id : '',
                                                        ),
                                                    ),
                                                ];
                                                $posts = get_posts($post_args);
                                                ?>
                                                <div class="product__active owl-carousel">
                                                    <?php foreach ($posts as $post): ?>
                                                        <div class="product__single">
                                                            <div class="product__box">
                                                                <?php if (has_post_thumbnail($post->ID)): ?>
                                                                    <div class="product__thumb">
                                                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                                                            <?php echo get_the_post_thumbnail($post->ID, 'full', ['class' => 'img']); ?>
                                                                        </a>
                                                                    </div>
                                                                <?php endif; ?>

                                                                <div class="product__content--top">
																			<span class="cate-name">
																				<?php
                                                                                $item_cats = get_the_terms($post->ID, $taxonomy);
                                                                                if (!empty($item_cats)):
                                                                                    $cat_link = get_term_link($item_cats[0]);
                                                                                    echo '<a href="' . esc_url($cat_link) . '">' . $item_cats[0]->name . '</a>';
                                                                                endif;
                                                                                ?>
																			</span>

                                                                    <h6 class="product__title mine__shaft-color f-700 mb-0">
                                                                        <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                                                            <?php echo esc_html($post->post_title); ?>
                                                                        </a>
                                                                    </h6>

                                                                    <?php if ('yes' === $settings['excerpt'] && !empty($post->post_excerpt)): ?>
                                                                        <div class="project-excerpt">
                                                                            <p><?php echo esc_html($post->post_excerpt); ?></p>
                                                                        </div>
                                                                    <?php endif; ?>
                                                                </div>

                                                                <div class="product__content--rating d-flex justify-content-between">
                                                                    <div class="rating">
                                                                        <?php echo \BdevsElement\BDevs_El_Woocommerce::product_rating($post->ID); ?>
                                                                    </div>
                                                                    <div class="price">
                                                                        <h5 class="grenadier-color f-600">
                                                                            <?php echo \BdevsElement\BDevs_El_Woocommerce::product_price($post->ID, true); ?>
                                                                        </h5>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="product-action">
                                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::yith_wishlist($post->ID); ?>
                                                                <a href="<?php echo esc_url(get_the_permalink($post->ID)); ?>">
                                                                    <i class="lnr lnr-eye"></i>
                                                                </a>
                                                                <?php echo \BdevsElement\BDevs_El_Woocommerce::add_to_cart_button($post->ID); ?>
                                                                <!--																	<a href="#"><span class="lnr lnr-sync"></span></a>-->
                                                            </div>
                                                        </div>
                                                    <?php endforeach; ?>
                                                </div>
                                            </div>
                                        </div>
                                    <?php endif; ?>
                                        <?php $i++; endforeach; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <?php else: ?>

    <section class="category__area">
        <div class="container">
           <div class="new-product-tab">
                <nav>
                  <div class="nav new-tab-wrapper justify-content-center mb-20" id="nav-tab" role="tablist">
                    <button class="nav-links active" id="nav-home-tab-all" data-bs-toggle="tab" data-bs-target="#nav-home-all" type="button" role="tab" aria-controls="nav-home-all" aria-selected="true">All</button>

                    <?php foreach ($filter_list as $key => $list):
                        $cat_icon = get_term_meta( $list->term_id, 'product_icon', true );
                        $active_class = $key == 0 ? 'active' : '';
                    ?>
                    <button class="nav-links" id="nav-home-tab-<?php print esc_attr($key); ?>" data-bs-toggle="tab" data-bs-target="#nav-home-<?php print esc_attr($key); ?>" type="button" role="tab" aria-controls="nav-home-<?php print esc_attr($key); ?>" aria-selected="true"><?php echo esc_html($list->name); ?></button>

                    <?php endforeach; ?>
                  </div>
                </nav>
                <div class="tab-content" id="nav-tabContent">
                  <div class="tab-pane fade active show" id="nav-home-all" role="tabpanel" aria-labelledby="nav-home-tab-all">
                        <?php
                        $post_args = [
                            'post_status' => 'publish',
                            'post_type' => $settings['post_type'],
                            'posts_per_page' => $settings['item_limit']
                        ];
                        $posts = get_posts($post_args);
                        ?>
                       <div class="row justify-content-center g-0">

                        <?php foreach ($posts as $list): 
                            $featured_img_url = get_the_post_thumbnail_url($list->ID,'full');
                            $categories = get_the_terms( $list->ID, 'product_cat' );
                            $title = $list->post_title;
                            $product_sm_thumb = function_exists('get_field') && get_field( 'product_sm_thumb',$list->ID ) ? get_field( 'product_sm_thumb',$list->ID ) : NULL; 
                            $price_value =  \BdevsElement\BDevs_El_Woocommerce::product_price($list->ID, true);            
                        ?>
                          <div class="col-auto">
                             <div class="product_new_item">
                                <a href="<?php echo esc_url(get_the_permalink($list->ID)); ?>">
                                    <?php if ( !empty($settings['product_zoom_switch']) ): ?>
                                    <div class="site-preview"  data-preview-url="<?php echo esc_url($featured_img_url); ?>"
                                    data-item-cost="<?php print esc_attr($price_value); ?>" data-item-category="<?php echo esc_html($categories[0]->name); ?>" data-item-author="<?php print get_the_author(); ?>" alt="<?php echo esc_attr($title); ?>"></div>
                                    <?php endif; ?>
                                    <img src="<?php echo esc_url($product_sm_thumb['url']); ?>" alt="Thumb">
                                </a>
                             </div>
                          </div>
                        <?php endforeach; ?>
                        
                       </div>
                  </div>

                    <?php
                        $i = 1;
                        foreach ($filter_list as $key => $list):
                        $active_class = $key == 0 ? 'active show' : '';
                    ?>
                  <div class="tab-pane fade" id="nav-home-<?php print esc_attr($key); ?>" role="tabpanel" aria-labelledby="nav-home-tab-<?php print esc_attr($key); ?>">

                        <?php
                        $post_args = [
                            'post_status' => 'publish',
                            'post_type' => $settings['post_type'],
                            'posts_per_page' => $settings['item_limit'],
                            'tax_query' => array(
                                array(
                                    'taxonomy' => $taxonomy,
                                    'field' => 'term_id',
                                    'terms' => !empty($list->term_id) ? $list->term_id : '',
                                ),
                            ),
                        ];
                        $posts = get_posts($post_args);
                        ?>
                       <div class="row justify-content-center g-0">

                        <?php foreach ($posts as $list): 
                            $featured_img_url = get_the_post_thumbnail_url($list->ID,'full');
                            $categories = get_the_terms( $list->ID, 'product_cat' );
                            $title = $list->post_title;
                            $product_sm_thumb = function_exists('get_field') && get_field( 'product_sm_thumb',$list->ID ) ? get_field( 'product_sm_thumb',$list->ID ) : NULL; 
                            $price_value =  \BdevsElement\BDevs_El_Woocommerce::product_price($list->ID, true);            
                        ?>
                          <div class="col-auto">
                             <div class="product_new_item">
                                <a href="<?php echo esc_url(get_the_permalink($list->ID)); ?>">
                                    <?php if ( !empty($settings['product_zoom_switch']) ): ?>
                                    <div class="site-preview"  data-preview-url="<?php echo esc_url($featured_img_url); ?>"
                                    data-item-cost="<?php print esc_attr($price_value); ?>" data-item-category="<?php echo esc_html($categories[0]->name); ?>" data-item-author="<?php print get_the_author(); ?>" alt="<?php echo esc_attr($title); ?>"></div>
                                    <?php endif; ?>
                                    <img src="<?php echo esc_url($product_sm_thumb['url']); ?>" alt="Thumb">
                                </a>
                             </div>
                          </div>
                        <?php endforeach; ?>
                       </div>
                  </div>
                  <?php endforeach; ?>
                </div>
           </div>
        </div>
    </section>
    <?php
    endif;
    }
}
