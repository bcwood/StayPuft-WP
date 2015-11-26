<?php
/**
 * Custom template tags for this theme.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package staypuft
 */

if ( ! function_exists( 'staypuft_entry_meta' ) ) :
/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
function staypuft_entry_meta() {
	// Hide entry date and byline for pages.
	if ( 'post' === get_post_type() ) {
		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$posted_on = sprintf( $time_string,
			esc_attr( get_the_date( 'c' ) ),
			esc_html( get_the_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		/*
		$posted_on = sprintf(
			esc_html_x( 'Posted on %s', 'post date', 'staypuft' ), $time_string
		);
		*/
		
		echo '<i class="fa fa-calendar"></i> <span class="posted-on">' . $posted_on . '</span>';
		
		$byline = sprintf(
			esc_html_x( 'by %s', 'post author', 'staypuft' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		echo '<span class="byline"> ' . $byline . '</span>&nbsp;&nbsp;';		
	}
	
	// Show edit link for posts and pages.
	edit_post_link(
		sprintf(
			/* translators: %s: Name of current post */
			esc_html__( 'Edit %s', 'staypuft' ),
			the_title( '<span class="screen-reader-text">"', '"</span>', false )
		),
		'<i class="fa fa-pencil"></i><span class="edit-link">',
		'</span>'
	);

	// Hide category and tag text for pages.
	if ( 'post' === get_post_type() ) {
		/* translators: used between list items, there is a space after the comma */
		/*
		$categories_list = get_the_category_list( esc_html__( ', ', 'staypuft' ) );
		if ( $categories_list && staypuft_categorized_blog() ) {
			printf( ' <span class="cat-links">' . esc_html__( 'in %1$s', 'staypuft' ) . '</span>', $categories_list ); // WPCS: XSS OK.
		}
		*/

		/* translators: used between list items, there is a middot */
		$tags_list = get_the_tag_list( '', esc_html__( ' &middot; ', 'staypuft' ) );
		if ( $tags_list ) {
			printf( '<br/><i class="fa fa-tag"></i> <span class="tags-links">' . esc_html__( '%1$s', 'staypuft' ) . '</span>', $tags_list ); // WPCS: XSS OK.
		}
	}
}
endif;

if ( ! function_exists( 'staypuft_entry_footer' ) ) :
/**
 * Prints HTML with meta information for the categories, tags and comments.
 */
function staypuft_entry_footer() {
	if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
		echo '<i class="fa fa-comment-o"></i> <span class="comments-link">';
		comments_popup_link( esc_html__( '0 Comments', 'staypuft' ), esc_html__( '1 Comment', 'staypuft' ), esc_html__( '% Comments', 'staypuft' ) );
		echo '</span>';
	}	
}
endif;

/**
 * Returns true if a blog has more than 1 category.
 *
 * @return bool
 */
function staypuft_categorized_blog() {
	if ( false === ( $all_the_cool_cats = get_transient( 'staypuft_categories' ) ) ) {
		// Create an array of all the categories that are attached to posts.
		$all_the_cool_cats = get_categories( array(
			'fields'     => 'ids',
			'hide_empty' => 1,
			// We only need to know if there is more than one category.
			'number'     => 2,
		) );

		// Count the number of categories that are attached to the posts.
		$all_the_cool_cats = count( $all_the_cool_cats );

		set_transient( 'staypuft_categories', $all_the_cool_cats );
	}

	if ( $all_the_cool_cats > 1 ) {
		// This blog has more than 1 category so staypuft_categorized_blog should return true.
		return true;
	} else {
		// This blog has only 1 category so staypuft_categorized_blog should return false.
		return false;
	}
}

/**
 * Flush out the transients used in staypuft_categorized_blog.
 */
function staypuft_category_transient_flusher() {
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}
	// Like, beat it. Dig?
	delete_transient( 'staypuft_categories' );
}
add_action( 'edit_category', 'staypuft_category_transient_flusher' );
add_action( 'save_post',     'staypuft_category_transient_flusher' );
