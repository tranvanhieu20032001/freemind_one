<?php

/**
 * Customizer theme
 * 
 * @package Freemind
 */

namespace FREEMIND_THEME\Inc;

use FREEMIND_THEME\Inc\Traits\Singleton;
use WP_Customize_Manager;

class Customizer
{
    use Singleton;

    protected function __construct()
    {
        $this->setup_hooks();
    }
    protected function setup_hooks()
    {
        add_action('customize_register', [$this, 'customize_register']);
    }

    public function customize_register(WP_Customize_Manager $wp_customize)
    {
        $slides = array(
            array(
                'image_default' => '/assets/images/slider1.jpg',
                'title_default' => __('Best House Plants', 'freemindone'),
                'subtitle_default' => 'Trees Have Aesthetic Value and Improve Property Values. They add beauty to their surroundings by adding color to an area'
            ),
            array(
                'image_default' => '/assets/images/slider2.jpg',
                'title_default' => 'Indoor Greenery',
                'subtitle_default' => 'Trees make life better. Spending time among trees and in green spaces has been shown to reduce the stress we carry in our daily lives.'
            ),
            array(
                'image_default' => '/assets/images/slider3.jpg',
                'title_default' => "Nature's Touch",
                'subtitle_default' => "Transform your home into a serene sanctuary with beautiful house plants"
            )
        );

        $wp_customize->add_section('change_slide', array(
            'title' => __('Change slide', 'freemind'),
            'description' => 'If you are interested to change or update image for slide, You can do it!'
        ));

        foreach ($slides as $index => $slide) {
            $slide_number = $index + 1;

            $wp_customize->add_setting("slide{$slide_number}_image", array(
                'default' => get_template_directory_uri() . $slide['image_default'],
            ));
            $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, "slide{$slide_number}_image", array(
                'label' => "Slide{$slide_number} Upload",
                'description' => "If you are interested to change or update slide, You can do it",
                'settings' => "slide{$slide_number}_image",
                'section' => 'change_slide',
            )));

            $wp_customize->add_setting("slide{$slide_number}_text", array(
                'default' => $slide['title_default'],
            ));
            $wp_customize->add_control("slide{$slide_number}_text", array(
                'label' => "Title-{$slide_number}",
                'section' => 'change_slide',
                'settings' => "slide{$slide_number}_text",
                'type' => 'textarea',
            ));

            $wp_customize->add_setting("slide{$slide_number}_text_subtitle", array(
                'default' => $slide['subtitle_default'],
            ));
            $wp_customize->add_control("slide{$slide_number}_text_subtitle", array(
                'label' => "Slide{$slide_number} Subtitle",
                'section' => 'change_slide',
                'settings' => "slide{$slide_number}_text_subtitle",
                'type' => 'text',
            ));
        }


        //<=====================================Setting section1 ==========================================================================================>
        $img_section1 = array(
            array(
                'image_default' => '/assets/images/section1.jpg',
            ),
            array(
                'image_default' => '/assets/images/senda.jpg',
            ),
            array(
                'image_default' => '/assets/images/xuongrong.jpg',
            ),
            array(
                'image_default' => '/assets/images/mongrong.jpg',
            ),
            array(
                'image_default' => '/assets/images/slider1.jpg',
            )
        );

        $wp_customize->add_section('change_section1', array(
            'title' => __('Change Section 1', 'freemindone'),
            'description' => 'If you are interested to change or update image for slide, You can do it!'
        ));

        // Add text settings and controls
        $wp_customize->add_setting('section1_title', array(
            'default' => 'Discover the beauty of bonsai.',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('section1_title', array(
            'label' => 'Title',
            'section' => 'change_section1',
            'type' => 'text',
        ));

        $wp_customize->add_setting('section1_description', array(
            'default' => 'Do you love cute, adorable mini ornamental plants that bring life to your space? Do you want to learn about the art of bonsai, a unique and sophisticated Japanese art of growing ornamental trees?',
            'sanitize_callback' => 'sanitize_textarea_field',
        ));

        $wp_customize->add_control('section1_description', array(
            'label' => 'Description',
            'section' => 'change_section1',
            'type' => 'textarea',
        ));

        foreach ($img_section1 as $index => $image) {
            $number = $index + 1;

            $wp_customize->add_setting("section_image{$number}", array(
                'default' => get_template_directory_uri() . $image['image_default'],
            ));

            $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, "section_image{$number}", array(
                'label' => "Image{$number} Upload",
                'description' => "If you are interested to change or update slide, You can do it",
                'settings' => "section_image{$number}",
                'section' => 'change_section1',
            )));
        }

        $wp_customize->add_setting('category_title', array(
            'default' => 'Plant Category',
            'sanitize_callback' => 'sanitize_text_field',
        ));

        $wp_customize->add_control('category_title', array(
            'label' => 'Category Title',
            'section' => 'change_section1',
            'type' => 'text',
        ));

        //<=====================================Setting section1 ==========================================================================================>

        $section_sale = array(
            array(
                'image_default' => '/assets/images/salebg1.png',
                'title_default' => 'Deal of the Day',
                'discount_default' => 'Sale Up To 50%',
            ),
            array(
                'image_default' => '/assets/images/salebg2.png',
                'title_default' => 'Indoor Plants Collection',
                'discount_default' => '50% OFF',
            ),
            array(
                'image_default' => '/assets/images/salebg3.png',
                'title_default' => 'Cactus Plants Collection',
                'discount_default' => '50% OFF',
            )
        );
        
        $wp_customize->add_section('change_section_sale', array(
            'title' => __('Change Section Sale', 'freemind'),
            'description' => 'If you are interested to change or update image for slide, You can do it!'
        ));
        
        foreach ($section_sale as $index => $sale) {
            $number = $index + 1;
        
            // Setting và control cho hình ảnh
            $wp_customize->add_setting("section_sale_image{$number}", array(
                'default' => get_template_directory_uri() . $sale['image_default'],
            ));
        
            $wp_customize->add_control(new \WP_Customize_Image_Control($wp_customize, "section_sale_image{$number}", array(
                'label' => "Image{$number} Upload",
                'description' => "If you are interested to change or update slide, You can do it",
                'settings' => "section_sale_image{$number}",
                'section' => 'change_section_sale',
            )));
        
            // Setting và control cho tiêu đề
            $wp_customize->add_setting("section_sale_title{$number}", array(
                'default' => $sale['title_default'],
                'sanitize_callback' => 'sanitize_text_field',
            ));
        
            $wp_customize->add_control("section_sale_title{$number}", array(
                'label' => "Title{$number}",
                'section' => 'change_section_sale',
                'type' => 'text',
            ));
        
            // Setting và control cho giảm giá
            $wp_customize->add_setting("section_sale_discount{$number}", array(
                'default' => $sale['discount_default'],
                'sanitize_callback' => 'sanitize_text_field',
            ));
        
            $wp_customize->add_control("section_sale_discount{$number}", array(
                'label' => "Discount{$number}",
                'section' => 'change_section_sale',
                'type' => 'text',
            ));
        }
    }
}
