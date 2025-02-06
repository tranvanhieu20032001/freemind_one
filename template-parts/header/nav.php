<?php

/**
 * Header Navigation template.
 * 
 * @package Freemind
 */

$menu_class = FREEMIND_THEME\Inc\Menus::get_instance();
$header_menu_id = $menu_class->get_menu_id('freemind-header-menu');
$header_menus   = wp_get_nav_menu_items($header_menu_id);
?>
<nav class="navbar navbar-expand-lg">
    <div class="container-fluid header">
        <?php
        // Check if the_custom_logo function exists and a custom logo is set
        if (function_exists('the_custom_logo') && has_custom_logo()) {
            the_custom_logo();
        } else {
            $default_logo = 'https://freemind.vn/uploads/logofreemind.svg';
        ?>
            <a href="<?php echo esc_url(home_url('/')); ?>" class="custom-logo-link" rel="home" itemprop="url">
                <img src="<?php echo esc_url($default_logo); ?>" class="custom-logo" alt="<?php bloginfo('name'); ?>">
            </a>
        <?php
        }
        ?>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex justify-content-around align-items-center">
                <?php get_search_form(); ?>
                <?php
                if (!empty($header_menus) && is_array($header_menus)) {
                    foreach ($header_menus as $menu_item) {
                        if ('Cart' === $menu_item->title) {
                            $link_target = !empty($menu_item->target) && '_blank' === $menu_item->target ? '_blank' : '_self';
                ?>
                            <a class="nav-link cart-icon d-block d-lg-none" href="<?php echo esc_url($menu_item->url); ?>" target="<?php echo esc_attr($link_target); ?>" title="<?php echo esc_attr($menu_item->title); ?>">
                                <i class="bi bi-cart menu-icon"></i>
                            </a>
                <?php
                            break;
                        }
                    }
                }
                ?>
            </div>

            <?php
            if (!empty($header_menus) && is_array($header_menus)) {
                $cart_menu_item = null;
            ?>
                <ul class="navbar-nav mb-2 mb-lg-0">
                    <?php
                    foreach ($header_menus as $menu_item) {
                        if (!$menu_item->menu_item_parent) {
                            $child_menu_items = $menu_class->get_child_menu_items($header_menus, $menu_item->ID);
                            $has_children = !empty($child_menu_items) && is_array($child_menu_items);
                            $link_target = !empty($menu_item->target) && '_blank' === $menu_item->target ? '_blank' : '_self';

                            // Check for specific menu items and store "Cart" for later
                            if ('Cart' === $menu_item->title) {
                                $cart_menu_item = $menu_item;
                                continue;
                            }
                            if (('My account' === $menu_item->title || 'Tài khoản' === $menu_item->title) && is_user_logged_in()) {
                                $current_user = wp_get_current_user();
                                $display_name = $current_user->display_name;
                                    $name = $display_name;
                                // Wrap name in custom HTML
                                $menu_item->title = 'Hello, <span class="custom-name">' . esc_html($name) . '</span>';
                            }

                            if (!$has_children) {
                    ?>
                                <li class="nav-item">
                                    <a class="nav-link" href="<?php echo esc_url($menu_item->url); ?>" target="<?php echo esc_attr($link_target); ?>" title="<?php echo esc_attr($menu_item->title); ?>">
                                        <?php echo $menu_item->title; ?>
                                    </a>
                                </li>
                            <?php
                            } else {
                            ?>
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="<?php echo esc_url($menu_item->url); ?>" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" target="<?php echo esc_attr($link_target); ?>" title="<?php echo esc_attr($menu_item->title); ?>">
                                        <?php echo $menu_item->title; ?>
                                    </a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <?php
                                        foreach ($child_menu_items as $child_menu_item) {
                                            $link_target = !empty($child_menu_item->target) && '_blank' === $child_menu_item->target ? '_blank' : '_self';
                                        ?>
                                            <a class="dropdown-item" href="<?php echo esc_url($child_menu_item->url); ?>" target="<?php echo esc_attr($link_target); ?>" title="<?php echo esc_attr($child_menu_item->title); ?>">
                                                <?php echo esc_html($child_menu_item->title); ?>
                                            </a>
                                        <?php
                                        }
                                        ?>
                                    </div>
                                </li>
                        <?php
                            }
                        }
                    }

                    // Add "Cart" menu item at the end
                    if ($cart_menu_item) {
                        $link_target = !empty($cart_menu_item->target) && '_blank' === $cart_menu_item->target ? '_blank' : '_self';
                        $cart_count = WC()->cart->get_cart_contents_count();
                        $cart_total_price = WC()->cart->get_cart_subtotal();
                        ?>
                        <li class="nav-item cart-icon d-none d-lg-block">
                            <a class="nav-link d-flex align-items-center gap-2" href="<?php echo esc_url($cart_menu_item->url); ?>" target="<?php echo esc_attr($link_target); ?>" title="<?php echo esc_attr($cart_menu_item->title); ?>">
                                <span class="position-relative block-cart">
                                    <i class="bi bi-cart-check menu-icon"></i>
                                    <span class="cart-count-wrapper position-absolute d-none">
                                        <span class="cart-count position-relative"><?php echo esc_html($cart_count); ?></span>
                                    </span>
                                </span>
                                <span class="cart-total-price d-none"><?php echo wp_kses_post($cart_total_price); ?></span>
                            </a>
                            <div class="mini-cart-content position-absolute" id="mini-cart-content">
                                <?php woocommerce_mini_cart(); ?>
                            </div>
                        </li>
                    <?php
                    }
                    ?>
                </ul>

            <?php
            }
            ?>
        </div>
    </div>
</nav>