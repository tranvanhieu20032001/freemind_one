<?php
/**
 * Front Page template
 *
 * @package Freemind
 */
get_header();
?>

 <section id="main-slider" class="container-fluid">
 <?php get_template_part( 'template-parts/body/main-slider' ); ?>
 </section>
 <section id="section-1" class="container">
    <?php get_template_part('template-parts/body/section-1'); ?>
 </section>

 <section id="section-categories" class="container-fluid">
    <?php get_template_part('template-parts/body/categories'); ?>
 </section>

 <section id="section-2" class="container-fluid">
    <?php get_template_part('template-parts/body/section-2'); ?>
 </section>

 <section id="section-hot-product" class="container">
    <?php get_template_part('template-parts/body/hot-product'); ?>
 </section>

 <section id="section-deal-off" class="container-fluid">
    <?php get_template_part('template-parts/body/section-3'); ?>
 </section>

 <?php get_footer(); ?>