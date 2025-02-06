<h6 class="subtitle-section"><?php echo __('Discover', 'freemindone') ?></h6>
<h1 class="title-section"><?php echo __(esc_html(get_theme_mod('category_title', 'Plant Category')), 'freemindone'); ?></h1>
<div class="swiper mySwiper overflow-hidden">
    <div class="swiper-wrapper">
        <?php
        $categories = get_terms(array(
            'taxonomy' => 'product_cat',
            'parent' => 0,
            'hide_empty' => false,
        ));
        if (!empty($categories)) {
            foreach ($categories as $category) {
                $thumbnail_id = get_term_meta($category->term_id, 'thumbnail_id', true);
                $image_url = wp_get_attachment_url($thumbnail_id);
                if (!$image_url) {
                    $image_url = get_template_directory_uri() . '/assets/images/caydeban.jpg'; // Use default image if no category image is set
                }
                $category_link = get_category_link($category->term_id);
        ?>
                <div class="swiper-slide">
                    <a href="<?php echo esc_url($category_link); ?>">
                        <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($category->name); ?>">
                        <h3 class="title-category"><?php echo esc_html($category->name); ?></h3>
                    </a>
                </div>
        <?php
            }
        } else {
            echo '<p>No categories found</p>';
        }
        ?>
    </div>
    <div class="swiper-pagination"></div>
</div>