<?php
/**
 * Search result page for products.
 */

get_header();
global $wp_query;

$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;

$args = array(
    'post_type' => 'product',
    's'         => get_search_query(),
    'posts_per_page' => 12,
    'paged'     => $paged,
);

$products_query = new WP_Query($args);
?>
<div id="primary">
    <main id="main" class="site-main mt-5" role="main">
        <div class="container">
            <header class="mb-5">
            <?php
$search_query = get_search_query();

if (!empty($search_query)) {
    ?>
    <h1 class="page-title"> 
        <?php echo $products_query->found_posts; ?>
        <?php _e('Products Found For', 'locale'); ?>: "<?php echo esc_html($search_query); ?>"
    </h1>
    <?php
} else {
    ?>
    <h1 class="page-title"> 
        <?php echo $products_query->found_posts; ?>
        <?php _e('Products Found', 'locale'); ?>
    </h1>
    <?php
}
?>

            </header>

            <?php if ($products_query->have_posts()) { ?>

                <div class="container">
                    <div class="row">
                        <div class="col-lg-3">
                            <?php get_sidebar();?>
                        </div>
                        <div class="col-lg-9">
                        <div class="row">
                        <?php while ($products_query->have_posts()) {
                            $products_query->the_post();
                            global $product;
                        ?>
                            <div class="col-lg-3 col-md-4 col-sm-6">
                                <div class="card mb-5 pb-3">
                                    <div class="card-body">
                                        <div class="search-card-container">
                                            <?php if (has_post_thumbnail()) { ?>
                                                <div class="search-product-image">
                                                    <?php if ($product->is_on_sale()) { ?>
                                                        <span class="onsale">Sale!</span>
                                                    <?php } ?>
                                                    <a href="<?php the_permalink(); ?>">
                                                        <?php the_post_thumbnail('medium', array('class' => 'product-img')); ?>
                                                    </a>
                                                </div>
                                                <h6 class="card-title">
                                                    <a href="<?php echo esc_url(get_the_permalink()); ?>">
                                                        <?php the_title(); ?>
                                                    </a>
                                                </h6>
                                            <?php } ?>
                                            <div class="search-product-details">
                                                <p class="price"><?php echo $product->get_price_html(); ?></p>
                                                <div class="d-flex justify-content-center align-items-center">
                                                <?php woocommerce_template_loop_add_to_cart(); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                    <div class="d-flex justify-content-center my-4">
                    <div class="panigition-ct">
                    <?php
                    echo paginate_links(array(
                        'total' => $products_query->max_num_pages,
                        'current' => $paged,
                        'format' => '?paged=%#%',
                        'prev_text' => '<i class="bi bi-arrow-left-short"></i>',
                        'next_text' => '<i class="bi bi-arrow-right-short"></i>',
                    ));
                    ?>
                    </div>
                </div>
                        </div>
                    </div>
                </div>

                <!-- Pagination -->

            <?php } else { ?>
                <p><?php _e('No products found', 'freemindone'); ?></p>
            <?php } ?>
        </div>
    </main>
</div>
<?php 
// Reset the query to the original main query
wp_reset_postdata(); 
get_footer(); 
?>
