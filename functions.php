<?php
/**
* Main template file
*
* @package Freemind
*/

if ( ! defined( 'FREEMIND_DIR_PATH' ) ) {
  define( 'FREEMIND_DIR_PATH', str_replace( '\\', '/', untrailingslashit( get_template_directory() ) ) );
}

if(!defined('FREEMIND_DIR_URI')){
  define( 'FREEMIND_DIR_URI', str_replace( '\\', '/', untrailingslashit( get_template_directory_uri() ) ) );
}


require_once FREEMIND_DIR_PATH . '/inc/helpers/autoloader.php';
require_once FREEMIND_DIR_PATH . '/inc/helpers/template-tags.php';
require_once FREEMIND_DIR_PATH . '/inc/theme_function.php';
require_once FREEMIND_DIR_PATH . '/inc/ajax/wp_ajax.php';
function freemind_get_instance() {
  return \FREEMIND_THEME\Inc\FREEMIND_THEME::get_instance();
}

freemind_get_instance();

function add_woocommerce_support() {
  add_theme_support('woocommerce');
}
add_action('after_setup_theme', 'add_woocommerce_support');

// Shortcode for WooCommerce Mini Cart
function woocommerce_header_add_to_cart_fragment( $fragments ) {
  ob_start();
  ?>
  <div class="header-cart">
      <?php woocommerce_mini_cart(); ?>
  </div>
  <?php
  $fragments['div.header-cart'] = ob_get_clean();
  return $fragments;
}
add_filter( 'woocommerce_add_to_cart_fragments', 'woocommerce_header_add_to_cart_fragment' );

// Create shortcode for mini cart
function woocommerce_mini_cart_shortcode() {
  ob_start();
  woocommerce_mini_cart();
  return ob_get_clean();
}
add_shortcode( 'woocommerce_mini_cart', 'woocommerce_mini_cart_shortcode' );

?>