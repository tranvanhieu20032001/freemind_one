<?php

/**
 * Register Sidebars
 * 
 * @package Freemind
 */

namespace FREEMIND_THEME\Inc;

use FREEMIND_THEME\Inc\Traits\Singleton;

class Sidebars
{
    use Singleton;

    protected function __construct()
    {
        $this->setup_hooks();
    }

    protected function setup_hooks()
    {
        /**
         * Actions.
         */
        add_action( 'widgets_init', [ $this, 'register_sidebars' ] );
    }

    public function register_sidebars()
    {
        register_sidebar([
            'name'          => __('Sidebar', 'freemindone'),
            'id'            => 'sidebar-1',
            'description'   => __('Add widgets here.', 'freemindone'),
            'before_widget' => '<div id="%1$s" class="widget widget-footer cell column %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ]);

        register_sidebar([
            'name'          => __('Sidebar-2', 'freemindone'),
            'id'            => 'sidebar-2',
            'description'   => __('Add more widgets here.', 'freemindone'),
            'before_widget' => '<div id="%1$s" class="widget widget-footer cell column %2$s">',
            'after_widget'  => '</div>',
            'before_title'  => '<h2 class="widget-title">',
            'after_title'   => '</h2>',
        ]);
    }
}
