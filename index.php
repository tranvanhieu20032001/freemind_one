<?php

/**
 * Main template file
 *
 * @package Freemind
 */
get_header();
?>
<div id="primary">
    <main id="main" class="site-main" role="main">
        <?php
        if (have_posts()) {
        ?>
            <div class="container">
                <?php
                if (is_home() && !is_front_page()) {
                ?>
                    <header class="mb-5">
                        <h2 class="text-center bg-title">
                            <?php single_post_title(); ?>
                        </h2>
                    </header>
                <?php
                }
                ?>

                <div class="row">
                    <?php
                    $index = 0;
                    $column = 3;
                    while (have_posts()) : the_post();
                    if (is_home() || is_archive() || is_single()) {
                        ?>
                        <div class="grid-post col-12 col-md-6 col-lg-3 mb-5">
                            <?php get_template_part('template-parts/content'); ?>
                        </div>
                        <?php
                    } else {
                        // Check if the current page is the My Account page and the user is not logged in
                        if (is_account_page() && !is_user_logged_in()) {
                            // Do not display the title
                            the_content();
                        } else {
                            ?>
                            <h2 class="text-center bg-title"><?php the_title(); ?></h2>
                            <?php the_content(); ?>
                            <?php
                        }
                    }
                    $index++;
                endwhile;
                
                    ?>
                </div>
            </div>
        <?php
        } else {
            get_template_part('template-parts/content-none');
        }
        freemind_pagination();
        ?>
    </main>
</div>

<?php
get_footer();
?>