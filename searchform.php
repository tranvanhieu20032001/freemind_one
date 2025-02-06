<?php

/**
 * Custom search form
 */
?>

<form role="search" method="get" class="position-relative form-search" action="<?php echo esc_url( home_url( '/' ) ); ?>">
    <span class="screen-reader-text"><?php echo _x( 'Search for:', 'label', 'freemindone' ); ?></span>
    <input class="form-control me-2 input-search" type="search" placeholder="<?php echo esc_attr_x( 'Search...', 'placeholder', 'freemindone' ); ?>" value="<?php the_search_query(); ?>" aria-label="Search" name="s">
    <button class="btn btn-search position-absolute top-0 end-0" type="submit"><i class="bi bi-search"></i></button>
    <ul class="list-result d-none">
    </ul>
    <div class="block-sppiner position-absolute top-0 end-0 d-none justify-content-center align-items-center">
        <div class="spinner"></div>
    </div>
</form>
