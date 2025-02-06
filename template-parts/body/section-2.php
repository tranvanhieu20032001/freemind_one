<div class="container">
    <div class="row">
        <div class="col-12 col-lg-6">
            <div class="block-sale row bg-sale">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <img src="<?php echo esc_url(get_theme_mod('section_sale_image1', get_template_directory_uri() . '/assets/images/salebg1.png')); ?>" alt="">
                </div>
                <div class="col-6 bg-sale">
                    <h3 class="sale-off"><?php echo __(esc_html(get_theme_mod('section_sale_discount1', 'Sale Up To 50%')),'freemindone'); ?></h3>
                    <h2 class="sale-title"><?php echo __(esc_html(get_theme_mod('section_sale_title1', 'Deal of the Day')),'freemindone'); ?></h2>
                    <a href="#section-deal-off" class="btn btn-learn-more"><?php echo __('Learn More','freemindone')?> &raquo;</a>
                </div>
            </div>

            <div class="block-sale row bg-sale">
                <div class="col-6 d-flex justify-content-center align-items-center">
                    <img src="<?php echo esc_url(get_theme_mod('section_sale_image2', get_template_directory_uri() . '/assets/images/salebg2.png')); ?>" alt="">
                </div>
                <div class="col-6 bg-sale">
                    <h3 class="sale-off"><?php echo  __(esc_html(get_theme_mod('section_sale_discount2', '50% OFF')),'freemindone'); ?></h3>
                    <h2 class="sale-title"><?php echo __(esc_html(get_theme_mod('section_sale_title2', 'Indoor Plants Collection')),'freemindone'); ?></h2>
                    <a href="#section-hot-product" class="btn btn-learn-more"><?php echo __('Learn More','freemindone')?> &raquo;</a>
                </div>
            </div>
        </div>
        <div class="col-12 col-lg-6 pd-0">
            <div class="block-sale-1 bg-sale text-center">
                <h1 class="sale-title"><?php echo __(esc_html(get_theme_mod('section_sale_title3', 'Cactus Plants Collection')),'freemindone'); ?></h1>
                <a href="<?php echo home_url('/shop'); ?>" class="btn btn-learn-more"><?php echo __('Shop Now','freemindone')?> &raquo;</a>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?php echo esc_url(get_theme_mod('section_sale_image3', get_template_directory_uri() . '/assets/images/salebg3.png')); ?>" alt="">
                </div>
            </div>
        </div>
    </div>
</div>
