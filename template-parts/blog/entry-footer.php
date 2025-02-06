<?php
/**
 * Template for entry footer
 *
 * @package Freemind
 */
$the_post_id   = get_the_ID();
$article_terms = wp_get_post_terms( $the_post_id, [ 'category', 'post_tag' ] );

if ( empty( $article_terms ) || ! is_array( $article_terms ) ) {
	return;
}

?>

<div class="entry-footer my-2">
	<?php
		foreach ( $article_terms as $key => $article_term ) {
			?>
			<a class="entry-footer-link text-black-50 btn border border-secondary p-1 mb-1 mr-1" href="<?php echo esc_url( get_term_link( $article_term ) ); ?>">
					<?php echo esc_html( $article_term->name ); ?>
			</a>
			<?php
	}
	?>
</div>