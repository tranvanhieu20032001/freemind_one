<div class="slider-wrapper theme-default">
    <div id="slider" class="nivoSlider">
        <img src="<?php echo esc_url(get_theme_mod('slide1_image', get_template_directory_uri() . '/assets/images/slider1.jpg')); ?>" alt="Image 1" title="#htmlcaption_1" />
        <img src="<?php echo esc_url(get_theme_mod('slide2_image', get_template_directory_uri() . '/assets/images/slider2.jpg')); ?>" alt="Image 2" title="#htmlcaption_2" />
        <img src="<?php echo esc_url(get_theme_mod('slide3_image', get_template_directory_uri() . '/assets/images/slider3.jpg')); ?>" alt="Image 3" title="#htmlcaption_3" />
        <!-- Add more images as needed -->
    </div>
    <div id="htmlcaption_1" class="nivo-html-caption">
        <h1 class="slide-h1"><?php echo __( get_theme_mod('slide1_text', 'Best House Plants'),'freemindone'); ?></h1>
        <h2 class="slide-h2"><?php echo  __(esc_html(get_theme_mod('slide1_text_subtitle', 'Trees Have Aesthetic Value and Improve Property Values. They add beauty to their surroundings by adding color to an area')),'freemindone'); ?></h2>
        <h3 class="slide-h3">
        <a class="btn btn-learn-more" href="<?php echo home_url('/shop'); ?>" title=""><?php echo __('Learn More', 'freemindone') ?> &raquo;</a>
        </h3>
    </div>
    <div id="htmlcaption_2" class="nivo-html-caption">
        <h1 class="slide-h1"><?php echo __(get_theme_mod('slide2_text', 'Indoor Greenery'),'freemindone'); ?></h1>
        <h2 class="slide-h2"><?php echo __(esc_html(get_theme_mod('slide2_text_subtitle', 'Trees make life better. Spending time among trees and in green spaces has been shown to reduce the stress we carry in our daily lives.')),'freemindone'); ?></h2>
        <h3 class="slide-h3">
        <a class="btn btn-learn-more" href="<?php echo home_url('/shop'); ?>" title=""><?php echo __('Learn More', 'freemindone') ?> &raquo;</a>
        </h3>
    </div>
    <div id="htmlcaption_3" class="nivo-html-caption">
        <h1 class="slide-h1"><?php echo __(get_theme_mod('slide3_text', "Nature's Touch"),'freemindone'); ?></h1>
        <h2 class="slide-h2"><?php echo __(esc_html(get_theme_mod('slide3_text_subtitle', 'Transform your home into a serene sanctuary with beautiful house plants')),'freemindone'); ?></h2>
        <h3 class="slide-h3">
            <a class="btn btn-learn-more" href="<?php echo home_url('/shop'); ?>" title=""><?php echo __('Learn More', 'freemindone') ?> &raquo;</a>
        </h3>
    </div>
</div>
