<?php

/**
 * Single post template
 * 
 * @package Freemind
 */
get_header();
?>

<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <div class="container position-relative">
            <div class="back-button-container">
                <button class="back-button" onclick="history.back()"><i class="bi bi-caret-left-fill"></i>Back</button>
            </div>
            <div class="row">
                <div class="col-12">
                    <?php
                    if (have_posts()) :
                    ?>
                        <div class="post-wrap">
                            <?php
                            if (is_home() && !is_front_page()) {
                            ?>
                                <header class="mb-5">
                                    <h1 class="page-title screen-reader-text">
                                        <?php single_post_title(); ?>
                                    </h1>
                                </header>
                            <?php
                            }

                            while (have_posts()) : the_post();
                                get_template_part('template-parts/content');
                            endwhile;
                            ?>
                        </div>
                    <?php
                    else :
                        get_template_part('template-parts/content-none');
                    endif;
                    freemind_pagination();
                    ?>
                </div>
            </div>
        </div>
    </main>
</div>

<?php
get_footer();
?>