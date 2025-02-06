<?php
/**
 *  Content post
 * 
 * @package Freemind
 */
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('post p-2'); ?>>
        <?php
            get_template_part('template-parts/blog/entry-header');
            get_template_part('template-parts/blog/entry-meta');
            // get_template_part('template-parts/blog/entry-footer');
            get_template_part('template-parts/blog/entry-content');
        ?>
</article>