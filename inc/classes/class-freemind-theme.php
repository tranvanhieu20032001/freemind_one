<?php

/**
 * Main template file
 *
 * @package Freemind
 */

namespace FREEMIND_THEME\Inc;

use FREEMIND_THEME\Inc\Traits\Singleton;

class FREEMIND_THEME
{
    use Singleton;

    protected function __construct()
    {
        Assets::get_instance();
        Menus::get_instance();
        Customizer::get_instance();
        Sidebars::get_instance();
        Meta_Boxes::get_instance();
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        /**
         * Actions.
         */
        add_action('after_setup_theme', [$this, 'setup_theme']);
    }

    public function setup_theme()
    {
        add_theme_support('title-tag');

        add_theme_support('custom-logo', [
            'header-text' => ['site-title', 'site-description'],
            'height' => 350,
            'width' => 350,
            'flex-height' => true,
            'flex-width' => true
        ]);

        add_theme_support('custom-background', [
            'default-color' => '#ffffff',
            'default-image' => '',
            'default-repeat' => 'no-repeat',
        ]);

        add_theme_support('post-thumbnails');
        
        /**
		 * Register image sizes.
		 */
		add_image_size( 'featured-thumbnail', 350, 350, true );

        add_theme_support('customize-selective-refresh-widgets');

        add_theme_support('automatic-feed-links');

        add_theme_support(
            'html5',
            [
                'search-form',
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
                'style',
            ]
        );

        add_editor_style();
        add_theme_support('wp-block-styles');
        add_theme_support('align-wide');

        global $content_width;
        if (!isset($content_width)) {
            $content_width = 1240;
        }

        add_theme_support("wc-product-gallery-zoom");
        add_theme_support("wc-product-gallery-lightbox");
        add_theme_support("wc-product-gallery-slider");
    }
}
