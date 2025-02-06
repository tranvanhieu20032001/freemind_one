<h6 class="subtitle-section"><?php echo __('Discover','freemindone') ?></h6>
<h1 class="title-section"><?php echo __('Hot Products','freemindone') ?></h1>

<div class="hot-products row">
    <?php
    $args = array(
        'post_type' => 'product', // Loại sản phẩm
        'posts_per_page' => -1, // Số lượng sản phẩm (sử dụng -1 để lấy tất cả)
        'tax_query' => array(
            array(
                'taxonomy' => 'product_tag', // Thuộc tính cần lọc (tag của sản phẩm)
                'field'    => 'slug',
                'terms'    => 'hot', // Slug của tag cần lấy
            ),
        ),
    );

    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) : $query->the_post();
            global $product;
            $product_id = get_the_ID();
    ?>
            <div class="col-6 col-md-4 col-lg-3 hot-item gy-3 position-relative">
                <?php
                global $product;
                if ($product->is_on_sale()) {
                    // Lấy giá gốc và giá bán
                    $regular_price = $product->get_regular_price();
                    $sale_price = $product->get_sale_price();

                    // Tính phần trăm giảm giá
                    $discount_percentage = round((($regular_price - $sale_price) / $regular_price) * 100);
                ?>
                    <span class="onsale"> - <?php echo $discount_percentage; ?>%</span>
                <?php } ?>

                <a href="<?php the_permalink(get_the_ID()); ?>">
                    <?php echo woocommerce_get_product_thumbnail(); ?>
                    <h2 class="product-title"><?php the_title(); ?></h2>
                    <span class="product-price"><?php echo $product->get_price_html(); ?></span>
                </a>
                <span class="position-absolute btn-add-to-cart text-center">
                    <?php woocommerce_template_loop_add_to_cart(array('product_id' => $product_id)); ?>
                </span>
            </div>
    <?php
        endwhile;
        wp_reset_postdata(); // Đặt lại trạng thái post
    else :
        echo '<p>Không có sản phẩm nào có tag "hot".</p>';
    endif;
    ?>
</div>