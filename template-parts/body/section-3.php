<div class="row bg-section-3 p-4">
    <div class="col-12 col-md-6 row">
        <?php
        $args = array(
            'post_type' => 'product',
            'posts_per_page' => 1,
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_tag',
                    'field' => 'slug',
                    'terms' => 'Deal of the Day',
                ),
            ),
        );
        $query = new WP_Query($args);
        if ($query->have_posts()) :
            while ($query->have_posts()) : $query->the_post();
                global $product;
                $product_id = get_the_ID();
        ?>
                <div class="col-12 col-md-6 d-flex align-items-center">
                    <div class="product-image">
                        <?php echo get_the_post_thumbnail($product_id, 'large'); ?>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <h1><?php echo __('Deal of the Day', 'freemindone') ?></h1>
                    <p><?php echo __('This special promotion lasts for just one day, providing customers with an exclusive opportunity to purchase selected products at significantly reduced prices.', 'freemindone') ?></p>
                    <div class="product">
                        <h2><?php the_title(); ?></h2>
                        <?php echo get_the_excerpt(); ?>
                        <div class="product-price">
                            <?php echo $product->get_price_html(); ?>
                        </div>
                        <span class="">
                            <?php woocommerce_template_loop_add_to_cart(array('product_id' => $product_id)); ?>
                        </span>
                    </div>
                </div>

        <?php
            endwhile;
            wp_reset_postdata();
        endif;
        ?>
    </div>
    <div class="col-12 col-md-6 d-flex flex-column justify-content-around">
        <div class="d-flex service p-3 gap-4 service-1">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/service1.png'; ?>" alt="">
            <div class="service-content d-flex flex-column justify-content-center">
                <h2><?php echo __('Free Shipping','freemindone') ?></h2>
                <span><?php echo __('All orders over 1 milion vnd','freemindone') ?></span>
            </div>
        </div>
        <div class="d-flex service p-3 gap-4 service-2">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/service2.png'; ?>" alt="">
            <div class="service-content d-flex flex-column justify-content-center">
                <h2><?php echo __('SECURE PAYMENTS','freemindone') ?></h2>
                <span><?php echo __('CONFIDENCE ON ALL DEVICES','freemindone') ?></span>
            </div>
        </div>
        <div class="d-flex service p-3 gap-4 service-3">
            <img src="<?php echo get_template_directory_uri() . '/assets/images/service3.png'; ?>" alt="">
            <div class="service-content d-flex flex-column justify-content-center">
                <h2><?php echo __('MONEY BACK','freemindone') ?></h2>
                <span><?php echo __('IF THE ITEM DIDN’T SUIT YOU','freemindone') ?></span>
            </div>
        </div>
    </div>

</div>