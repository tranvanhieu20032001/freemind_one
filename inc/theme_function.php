<?php

/**
 * Theme functions
 * 
 * @package Freemind
 */

 function custom_reorder_product_summary() {
    // Remove the default hook
    remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );

    // Add the price hook after the excerpt
    add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 25 );
}
add_action( 'woocommerce_init', 'custom_reorder_product_summary' );

add_action('init', 'custom_remember_me_login');
function custom_remember_me_login() {
    if (isset($_POST['username']) && isset($_POST['rememberme'])) {
        setcookie('username', sanitize_text_field($_POST['username']), time() + (86400 * 30), "/"); // 30 ngày
        // Debugging line
        error_log("Cookie 'username' set with value: " . sanitize_text_field($_POST['username']));
    } else {
        // Debugging lines
        if (!isset($_POST['username'])) {
            error_log("Username not set in POST data");
        }
        if (!isset($_POST['rememberme'])) {
            error_log("Remember me not set in POST data");
        }
    }
}


add_action('wp_logout', 'custom_remember_me_logout');
function custom_remember_me_logout() {
    // setcookie('username', '', time() - 3600, "/");
    error_log("User logged out but 'username' cookie was not cleared");
}


add_filter('woocommerce_pagination_args', 'custom_woocommerce_pagination');

function custom_woocommerce_pagination($args) {
    $args['next_text'] = '<i class="bi bi-arrow-right-short"></i>'; // Thay đổi biểu tượng mũi tên next
    $args['prev_text'] = '<i class="bi bi-arrow-left-short"></i>'; // Thay đổi biểu tượng mũi tên prev (nếu cần)
    return $args;
}

function check_view_order_page() {
    if (is_wc_endpoint_url('view-order')) {
        ?>
        <div class="block-back-order">
            <button class="back-button" onclick="history.back()">
                <i class="bi bi-caret-left-fill"></i> Back
            </button>
        </div>
        <?php
    }
}
add_action('woocommerce_account_content', 'check_view_order_page', 5);

function modify_woocommerce_cart_total_action() {
    remove_action('woocommerce_widget_shopping_cart_total', 'woocommerce_widget_shopping_cart_subtotal', 10);
    add_action('woocommerce_widget_shopping_cart_total', 'my_custom_shopping_cart_total');
}

function my_custom_shopping_cart_total() {
    echo '<p class="total"><strong>' . __('Totals', 'woocommerce') . ':</strong> ' . WC()->cart->get_cart_subtotal() . '</p>';
}
add_action('init', 'modify_woocommerce_cart_total_action');




function freemindone_load_textdomain() {
    load_theme_textdomain('freemindone', get_template_directory() . '/languages');
}
add_action('after_setup_theme', 'freemindone_load_textdomain');

function change_my_account_menu_order()
{
    $menuOrder = array(
        'dashboard'          => __('Dashboard', 'woocommerce'),
        'orders'             => __('Orders', 'woocommerce'),
        'checkout'   => __('Payment', 'woocommerce'),
        'edit-address'       => __('Addresses', 'woocommerce'),
        'edit-account'        => __('Account Details', 'woocommerce'),
        'customer-logout'    => __('Logout', 'woocommerce')
    );
    return $menuOrder;
}
add_filter('woocommerce_account_menu_items', 'change_my_account_menu_order');


function wc_cart_totals_coupon_label_ct( $coupon, $echo = true ) {
    if ( is_string( $coupon ) ) {
        $coupon = new WC_Coupon( $coupon );
    }

    /* translators: %s: coupon code */
    $label = sprintf( 'Coupon: <span class="coupon-code">%s</span>', esc_html( $coupon->get_code() ) );

    // Allow <span> tags
    $allowed_html = array(
        'span' => array(
            'class' => array('') // Cho phép thuộc tính class
        )
    );

    $label = wp_kses( $label, $allowed_html );

    if ( $echo ) {
        echo $label; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
    } else {
        return $label;
    }
}


// Function to handle shipping calculator fields update
function custom_update_shipping_calculator_fields() {
    if ( isset( $_POST['calc_shipping'] ) ) {
        // Check nonce for security
        if ( ! isset( $_POST['woocommerce-shipping-calculator-nonce'] ) || ! wp_verify_nonce( $_POST['woocommerce-shipping-calculator-nonce'], 'woocommerce-shipping-calculator' ) ) {
            return;
        }

        // Update shipping address
        if ( isset( $_POST['calc_shipping_address'] ) ) {
            WC()->customer->set_shipping_address( sanitize_text_field( wp_unslash( $_POST['calc_shipping_address'] ) ) );
        }

        // Update shipping city
        if ( isset( $_POST['calc_shipping_city'] ) ) {
            WC()->customer->set_shipping_city( sanitize_text_field( wp_unslash( $_POST['calc_shipping_city'] ) ) );
        }

        // Update shipping postcode
        if ( isset( $_POST['calc_shipping_postcode'] ) ) {
            WC()->customer->set_shipping_postcode( sanitize_text_field( wp_unslash( $_POST['calc_shipping_postcode'] ) ) );
        }

        // Save customer data
        WC()->customer->save();
    }
}
add_action( 'woocommerce_calculated_shipping', 'custom_update_shipping_calculator_fields' );


// Remove the default hooks
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5);
remove_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

// Add the price first
add_action('woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_price', 10);

// Add the rating and comment count
add_action('woocommerce_after_shop_loop_item_title', 'custom_template_loop_rating_with_comment_count', 15);

function custom_template_loop_rating_with_comment_count() {
    global $product;

    // Display the rating
    if ( function_exists( 'woocommerce_template_loop_rating' ) ) {
        echo '<div class="custom-rating-container">';
        woocommerce_template_loop_rating();
    }

    // Display the comment count
    $comment_count = $product->get_review_count();
    if ( $comment_count > 0 ) {
        echo '<span class="comment-count">(' . $comment_count . ' ' . _n('review', 'reviews', $comment_count, 'woocommerce') . ')</span>';
    }
    echo '</div>';
}


add_action('woocommerce_register_post', 'validate_privacy_policy_checkbox', 10, 3);

function validate_privacy_policy_checkbox($username, $email, $validation_errors) {
    if (!isset($_POST['terms'])) {
        if (!$validation_errors->get_error_message('terms_error')) {
            $validation_errors->add('terms_error', __('You must accept the terms and conditions to register.', 'woocommerce'));
        }
    }
    return $validation_errors;
}

// Remove the display_privacy_policy_error_message function if not needed
// Otherwise, ensure it does not add the same error again
remove_action('woocommerce_registration_errors', 'display_privacy_policy_error_message', 10, 1);

function display_privacy_policy_error_message($validation_errors) {
    $terms_error_message = $validation_errors->get_error_message('terms_error');
    if ($terms_error_message && !wc_has_notice($terms_error_message, 'error')) {
        wc_add_notice($terms_error_message, 'error');
    }
    return $validation_errors;
}

// If you still need to add this function, ensure you don't add duplicate errors
// add_action('woocommerce_registration_errors', 'display_privacy_policy_error_message', 10, 1);
