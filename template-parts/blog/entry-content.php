<?php

/**
 * Template for entry content
 *
 * @package freemind
 */
?>
<div class="entry-content">
    <?php
    if (is_single()) {
        the_content(
            sprintf(
                wp_kses(
                    __('Read more %s <span class="meta-nav">&rarr;</span>', 'freemind'),
                    [
                        'span' => [
                            'class' => []
                        ]
                    ]
                ),
                the_title( '<span class="screen-reader-text">"', '"</span>', false )
            )
        );
    }
    // } else {
    //     freemind_the_excerpt(200);
    //     freemind_excerpt_more();
    // }
    ?>
</div>