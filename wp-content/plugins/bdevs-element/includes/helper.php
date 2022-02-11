<?php 
namespace BdevsElement;

class Helper {

    /** 
    * Get widgets list
    */
    public static function get_widgets() {

        return [
            'advanced-price' => [
                'title' => __( 'Advanced Price', 'bdevs-element' ),
                'icon' => 'eicon-tabs',
                'ispro' =>true
            ],
            'advanced-faq' => [
                'title' => __( 'Advanced Faq', 'bdevs-element' ),
                'icon' => 'eicon-tabs',
                'ispro' =>true
            ],
            'hero' => [
                'title' => __( 'Hero', 'bdevs-element' ),
                'icon' => 'eicon-tabs',
                'ispro' =>true
            ],

            'cta' => [
                'title' => __( 'CTA', 'bdevs-element' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ], 

            'mbtn' => [
                'title' => __( 'My Btn', 'bdevs-element' ),
                'icon' => 'fa fa-time',
                'ispro' =>true
            ], 
            
            'faq' => [
                'title' => __( 'FAQ', 'bdevs-element' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],                                                        

            'about' => [
                'title' => __( 'About', 'bdevs-element' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],
            // 'about-tab' => [
            //     'title' => __( 'About Tab', 'bdevs-element' ),
            //     'icon' => 'fa fa-card',
            //     'ispro' =>true
            // ], 

            'brand' => [
                'title' => __( 'Brand', 'bdevs-element' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],

            'service' => [
                'title' => __( 'Service', 'bdevs-element' ),
                'icon' => 'fa fa-card',
                'ispro' =>true
            ],          

            // 'services-tab' => [
            //     'title' => __( 'Services Tab', 'bdevs-element' ),
            //     'icon' => 'fa fa-card',
            //     'ispro' =>true
            // ],

            'cf7' => [
                'title' => __( 'Contact Form 7', 'bdevs-element' ),
                'icon' => 'fa fa-form',
            ],

            'contact-info' => [
                'title' => __( 'Contact Info', 'bdevs-element' ),
                'icon' => 'fa fa-form',
            ],

            'heading' => [
                'title' => __( 'Heading Title', 'bdevs-element' ),
                'icon' => 'fa fa-icon-box',
            ],

            'icon-box' => [
                'title' => __( 'Icon box', 'bdevs-element' ),
                'icon' => 'fa fa-blog-content',
            ], 

            // 'video-info' => [
            //     'title' => __( 'Video Info', 'bdevs-element' ),
            //     'icon' => 'fa fa-blog-content',
            // ],

            'infobox' => [
                'title' => __( 'Info Box', 'bdevs-element' ),
                'icon' => 'fa fa-blog-content',
            ],            

            // 'member' => [
            //     'title' => __( 'Team Member', 'bdevs-element' ),
            //     'icon' => 'fa fa-team-member',
            // ],            

            // 'member-slider' => [
            //     'title' => __( 'Team Member Slider', 'bdevs-element' ),
            //     'icon' => 'fa fa-team-member',
            // ],             

            // 'member-details' => [
            //     'title' => __( 'Member Details', 'bdevs-element' ),
            //     'icon' => 'fa fa-team-member',
            // ], 


            'fact' => [
                'title' => __( 'Fact', 'bdevs-element' ),
                'icon' => 'fa fa-team-member',
            ],

            'pricing-table' => [
                'title' => __( 'Pricing Table', 'bdevs-element' ),
                'icon' => 'fa fa-file-cabinet',
            ],

            // 'slider' => [
            //     'title' => __( 'Slider', 'bdevs-element' ),
            //     'icon' => 'fa fa-image-slider',
            // ],

            // 'featured-list' => [
            //     'title' => __( 'Featured List', 'bdevs-element' ),
            //     'icon' => 'fa fa-flip-card',
            // ],            

            'post-list' => [
                'title' => __( 'Post List', 'bdevs-element' ),
                'icon' => 'fa fa-post-list',
            ],

            // 'post-tab' => [
            //     'title' => __( 'Post Tab', 'bdevs-element' ),
            //     'icon' => 'fa fa-post-tab',
            // ], 

            // 'project-slider' => [
            //     'title' => __( 'Project Slider', 'bdevs-element' ),
            //     'icon' => 'fa fa-post-tab',
            // ],        

            'testimonial-slider' => [
                'title' => __( 'Testimonial Slider', 'bdevs-element' ),
                'icon' => 'fa fa-testimonial',
                'css' => ['testimonial'],
                'js' => [],
                'vendor' => [
                    'css' => [],
                    'js' => [],
                ],
            ],
            
            'woo-product' => [
                'title' => __( 'Woo Product', 'bdevs-element' ),
                'icon' => 'fa fa-card'
            ],
            'woo-product-tab' => [
                'title' => __( 'Woo Product Tab', 'bdevs-element' ),
                'icon' => 'fa fa-card'
            ]

        ];
    }

    /**
    *  Get WooCommerce widgets list   
    **/
    public static function get_woo_widgets() { 

        return [
            // 'woo-product' => [
            //     'title' => __( 'Woo Product', 'bdevs-element' ),
            //     'icon' => 'fa fa-card'
            // ]

        ];
    }
}


