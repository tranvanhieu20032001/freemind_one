<?php
/**
 * Enqueue theme assets
 * 
 * @package Freemind
 */

namespace FREEMIND_THEME\Inc;

use FREEMIND_THEME\Inc\Traits\Singleton;
class Assets {
    use Singleton;

    protected function __construct() {
        $this->setup_hooks();
    }

    protected function setup_hooks() {
        add_action('after_setup_theme', [$this, 'add_woocommerce_support']);
        add_action('wp_enqueue_scripts', [$this, 'register_style']);
        add_action('wp_enqueue_scripts', [$this, 'register_scripts']);
    }

    public function add_woocommerce_support() {
        if (class_exists('WooCommerce')) {
            add_theme_support('woocommerce');
        }
    }

    public function register_style() {
        // Register styles
        wp_register_style('style-css', get_template_directory_uri() . '/style.css', [], filemtime(get_template_directory() . '/style.css'), 'all');
        wp_register_style('bootstrap-css', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css', [], '5.3.3');
        wp_register_style('font-awesome', 'https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css', [], '5.15.4');
        wp_register_style('bootstrap-icons', 'https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.3/font/bootstrap-icons.min.css', [], '1.10.3');
        wp_register_style('nivo-slider-css', 'https://cdn.jsdelivr.net/npm/nivo-slider@3.2.0/nivo-slider.min.css', [], '3.2.0');
        wp_register_style('nivo-slider-theme', 'https://cdn.jsdelivr.net/npm/nivo-slider@3.2.0/themes/default/default.css', [], '3.2.0');
        wp_register_style('swiper-css', 'https://cdn.jsdelivr.net/npm/swiper@6.8.4/swiper-bundle.min.css', [], '6.8.4');

        // Enqueue styles
        wp_enqueue_style('bootstrap-css');
        wp_enqueue_style('font-awesome');
        wp_enqueue_style('bootstrap-icons');
        wp_enqueue_style('nivo-slider-css');
        wp_enqueue_style('nivo-slider-theme');
        wp_enqueue_style('swiper-css');
        wp_enqueue_style('style-css');
    }

    public function register_scripts() {
        // Register scripts
        wp_register_script('main-js', get_template_directory_uri() . '/assets/js/main.js', [], filemtime(get_template_directory() . '/assets/js/main.js'), true);
        wp_register_script('search-js', get_template_directory_uri() . '/assets/js/search.js', [], filemtime(get_template_directory() . '/assets/js/search.js'), true);
        wp_register_script('update-mini-cart-js', get_template_directory_uri() . '/assets/js/update_mini_cart.js', [], filemtime(get_template_directory() . '/assets/js/update_mini_cart.js'), true);

        wp_register_script('jquery', 'https://code.jquery.com/jquery-3.6.3.min.js', [], '3.6.3', true);
        wp_register_script('swiper', 'https://cdn.jsdelivr.net/npm/swiper@6.8.4/swiper-bundle.min.js', ['jquery'], '6.8.4', true);
        wp_register_script('nivo-slider-js', 'https://cdn.jsdelivr.net/npm/nivo-slider@3.2.0/jquery.nivo.slider.min.js', ['jquery'], '3.2.0', true);
        wp_register_script('bootstrap', 'https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js', ['jquery'], '5.3.0', true);

        // Enqueue scripts
        wp_enqueue_script('jquery');
        wp_enqueue_script('swiper');
        wp_enqueue_script('nivo-slider-js');
        wp_enqueue_script('bootstrap');
        wp_enqueue_script('main-js');
        wp_enqueue_script('search-js');
        wp_enqueue_script('update-mini-cart-js');


        wp_localize_script( 'search-js', 'ajax_search', array(
            'ajax_url' => admin_url( 'admin-ajax.php' )
        ));
    } 
}