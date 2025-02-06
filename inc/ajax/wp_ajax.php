<?php

/**
 * Main template file
 *
 * @package Freemind
 */

function ajax_live_search()
{
    $query = isset($_GET['query']) ? sanitize_text_field($_GET['query']) : '';

    $args = array(
        's' => $query,
        'post_type' => array('product'),
        'posts_per_page' => -1
    );

    $search_query = new WP_Query($args);

    if ($search_query->have_posts()) {
        while ($search_query->have_posts()) {
            $search_query->the_post();
            $thumbnail_url = get_the_post_thumbnail_url(get_the_ID(), 'thumbnail'); // Lấy URL của ảnh đính kèm, 'thumbnail' là kích thước của ảnh (có thể thay đổi)
            echo '<li class="search-item">';
            echo '<a href="' . get_permalink() . '">';
            if ($thumbnail_url) {
                echo '<img src="' . esc_url($thumbnail_url) . '" alt="' . esc_attr(get_the_title()) . '" />';
            }
            echo '<span>' . get_the_title() . '</span>';
            echo '</a>';
            echo '</li>';
        }
    } else {
        echo '<li class="search-item">No results found</li>';
    }


    wp_reset_postdata();

    wp_die();
}
add_action('wp_ajax_live_search', 'ajax_live_search');
add_action('wp_ajax_nopriv_live_search', 'ajax_live_search');


function update_mini_cart2() {
    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();

    $response = array(
        'mini_cart' => $mini_cart,
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_subtotal()
    );

    wp_send_json($response);
    wp_die(); // Ensure the script terminates
}

add_action('wp_ajax_update_mini_cart2', 'update_mini_cart2');
add_action('wp_ajax_nopriv_update_mini_cart2', 'update_mini_cart2');
// Xử lý Ajax khi update giỏ hàng nhỏ
function update_mini_cart() {
    ob_start();
    woocommerce_mini_cart();
    $mini_cart = ob_get_clean();
    
    $response = array(
        'mini_cart' => $mini_cart,
        'cart_count' => WC()->cart->get_cart_contents_count(),
        'cart_total' => WC()->cart->get_cart_subtotal()
    );
    
    wp_send_json($response);
}

add_action('wp_ajax_update_mini_cart', 'update_mini_cart');
add_action('wp_ajax_nopriv_update_mini_cart', 'update_mini_cart');

// Xử lý Ajax khi xóa sản phẩm khỏi giỏ hàng
add_action('wp_ajax_remove_from_cart', 'remove_from_cart_ajax');
add_action('wp_ajax_nopriv_remove_from_cart', 'remove_from_cart_ajax');

function remove_from_cart_ajax() {
    $cart_item_key = sanitize_text_field($_POST['cart_item_key']);
    
    WC()->cart->remove_cart_item($cart_item_key);
    
    // Update mini cart
    update_mini_cart();
    
    die();
}

// Xử lý Ajax khi thêm sản phẩm vào giỏ hàng
add_action('wp_ajax_add_to_cart', 'add_to_cart_ajax');
add_action('wp_ajax_nopriv_add_to_cart', 'add_to_cart_ajax');

function add_to_cart_ajax() {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    $quantity = isset($_POST['quantity']) ? intval($_POST['quantity']) : 1;
    
    if ($product_id > 0) {
        $result = WC()->cart->add_to_cart($product_id, $quantity);
        
        if ($result) {
            // Update mini cart
            update_mini_cart();
            wp_send_json_success();
        } else {
            wp_send_json_error();
        }
    } else {
        wp_send_json_error();
    }
}
