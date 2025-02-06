<?php

/**
 * Custom template tags for the theme.
 *
 * @package Freemind
 */

/**
 * Gets the thumbnail with Lazy Load.
 * Should be called in the WordPress Loop.
 *
 * @param int|null $post_id               Post ID.
 * @param string   $size                  The registered image size.
 * @param array    $additional_attributes Additional attributes.
 *
 * @return string
 */
function get_the_post_custom_thumbnail($post_id, $size = 'featured-thumbnail', $additional_attributes = [])
{
	$custom_thumbnail = '';

	if (null === $post_id) {
		$post_id = get_the_ID();
	}

	if (has_post_thumbnail($post_id)) {
		$default_attributes = [
			'loading' => 'lazy'
		];

		$attributes = array_merge($additional_attributes, $default_attributes);

		$custom_thumbnail = wp_get_attachment_image(
			get_post_thumbnail_id($post_id),
			$size,
			false,
			$attributes
		);
	}

	return $custom_thumbnail;
}

/**
 * Renders Custom Thumbnail with Lazy Load.
 *
 * @param int    $post_id               Post ID.
 * @param string $size                  The registered image size.
 * @param array  $additional_attributes Additional attributes.
 */
function the_post_custom_thumbnail($post_id, $size = 'featured-thumbnail', $additional_attributes = [])
{
	echo get_the_post_custom_thumbnail($post_id, $size, $additional_attributes);
}

function freemind_posted_on()
{
	$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
	if (get_the_time('U') !== get_the_modified_time('U')) {
		$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
	}

	$time_string = sprintf(
		$time_string,
		esc_attr(get_the_date(DATE_W3C)), //%1$s
		esc_html(get_the_date()), //%2$s
		esc_attr(get_the_modified_date(DATE_W3C)), //%3$s
		esc_html(get_the_modified_date()) //%4$s
	);

	$posted_on = sprintf(
		/* translators: %s: post date. */
		esc_html_x('%s', 'post date', 'freemindone'),
		'<a href="' . esc_url(get_permalink()) . '" rel="bookmark"><i class="bi bi-calendar2-check"></i> ' . $time_string . '</a>'
	);

	echo '<span class="posted-on text-secondary">' . $posted_on . '</span>';
}

function freemind_post_by()
{
	$author_meta = get_the_author_meta('ID'); // Get author ID
	$byline = sprintf(
		/* translators: %s: post author name */
		esc_html_x('%s', 'post author', 'freemindone'),
		'<span class="author vcard"><a href="' . esc_url(get_author_posts_url($author_meta)) . '"><i class="bi bi-person"></i>' . esc_html(get_the_author()) . '</a></span>'
	);

	echo '<span class="byline text-secondary">' . $byline . '</span>';
}


function freemind_the_excerpt($strim_character_count = 0)
{
	if (!has_excerpt() || 0 === $strim_character_count) {
		the_excerpt();
		return;
	}
	$excerpt = wp_strip_all_tags(get_the_excerpt());
	$excerpt = substr($excerpt, 0, $strim_character_count);
	$excerpt = substr($excerpt, 0, strrpos($excerpt, ' '));
	echo $excerpt . '[...]';
}

function freemind_excerpt_more($more = ''){
	if(!is_single()){
		$more = sprintf('<button class="mt-4 btn btn-info"><a href="%1$s" class="freemind-read-more text-white">%2$s</a></button>', 
		get_permalink(get_the_ID()),
		 __('Read More', 'freemind')
		 );
	}
	echo $more;
}

function freemind_pagination() {

	$allowed_tags = [
		'span' => [
			'class' => []
		],
		'a' => [
			'class' => [],
			'href' => [],
		]
	];

	$args = [
		'before_page_number' => '<span class="btn border border-secondary mr-2 mb-2">',
		'after_page_number' => '</span>',
	];

	printf( '<nav class="freemind-pagination clearfix">%s</nav>', wp_kses( paginate_links( $args ), $allowed_tags ) );
}

/**
 * Display Post pagination with prev next, first last, to, from
 *
 * @param $current_page_no
 * @param $posts_per_page
 * @param $article_query
 * @param $first_page_url
 * @param $last_page_url
 * @param bool $is_query_param_structure
 */
function freemind_the_post_pagination( $current_page_no, $posts_per_page, $article_query, $first_page_url, $last_page_url, bool $is_query_param_structure = true ) {
	$prev_posts = ( $current_page_no - 1 ) * $posts_per_page;
	$from       = 1 + $prev_posts;
	$to         = count( $article_query->posts ) + $prev_posts;
	$of         = $article_query->found_posts;
	$total_pages = $article_query->max_num_pages;

	$base = ! empty( $is_query_param_structure ) ? add_query_arg( 'page', '%#%' ) :  get_pagenum_link( 1 ) . '%_%';
	$format = ! empty( $is_query_param_structure ) ? '?page=%#%' : 'page/%#%';

	?>
	<div class="mt-0 md:mt-10 mb-10 lg:my-5 flex items-center justify-end posts-navigation">
		<?php
		if ( 1 < $total_pages && !empty( $first_page_url ) ) {
			printf(
				'<span class="mr-2">Showing %1$s - %2$s Of %3$s</span>',
				$from,
				$to,
				$of
			);
		}


		// First Page
		if ( 1 !== $current_page_no && ! empty( $first_page_url ) ) {
			printf( '<a class="first-pagination-link btn border border-secondary mr-2" href="%1$s" title="first-pagination-link">%2$s</a>', esc_url( $first_page_url ), __( 'First', 'freemind' ) );
		}

		echo paginate_links( [
			'base'      => $base,
			'format'    => $format,
			'current'   => $current_page_no,
			'total'     => $total_pages,
			'prev_text' => __( 'Prev', 'freemind' ),
			'next_text' => __( 'Next', 'freemind' ),
		] );

		// Last Page
		if ( $current_page_no < $total_pages && !empty( $last_page_url ) ) {

			printf( '<a class="last-pagination-link btn border border-secondary ml-2" href="%1$s" title="last-pagination-link">%2$s</a>', esc_url( $last_page_url ), __( 'Last', 'freemind' ) );
		}

		?>
	</div>
	<?php
}
