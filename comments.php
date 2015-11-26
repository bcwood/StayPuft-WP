<?php
/**
 * The template for displaying comments.
 *
 * This is the template that displays the area of the page that contains both the current comments
 * and the comment form.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package staypuft
 */

/*
 * If the current post is protected by a password and
 * the visitor has not yet entered the password we will
 * return early without loading the comments.
 */
if ( post_password_required() ) {
	return;
}
?>

<div id="comments" class="comments-area">

	<?php if ( have_comments() ) : ?>
		<h3 class="comments-title">
			<?php
				printf( // WPCS: XSS OK.
					esc_html( _nx( 'One thought on &ldquo;%2$s&rdquo;', '%1$s thoughts on &ldquo;%2$s&rdquo;', get_comments_number(), 'comments title', 'staypuft' ) ),
					number_format_i18n( get_comments_number() ),
					'<span>' . get_the_title() . '</span>'
				);
			?>
		</h3>

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-above" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'staypuft' ); ?></h2>
				<div class="nav-links">
					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'staypuft' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'staypuft' ) ); ?></div>
				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-above -->
		<?php endif; // Check for comment navigation. ?>

		<ol class="comment-list">
			<?php
				/*wp_list_comments( array(
					'style'       => 'ol',
					'short_ping'  => true,
					'avatar_size' => 48,
				) );*/
			?>
			<?php foreach ($comments as $comment) : ?>
				<li id="comment-<?php comment_ID(); ?>" <?php comment_class(); ?>>
                    <div class="comment-meta">
                        <div class="comment-avatar">
                            <?php echo get_avatar($comment, 48); ?>
                        </div>
                        <div class="comment-author">
                            <?php comment_author_link(); ?>
                        </div>
                        <div class="comment-date">
                             <a href="<?php echo get_comment_link(); ?>" title="<?php echo get_comment_time('l, F jS, Y g:ia T'); ?>">
                                        <?php echo human_time_diff( get_comment_time('U') ); ?> ago</a>
                        </div>
                        <?php edit_comment_link( 'Edit', '<span class="comment-edit"><i class="fa fa-pencil"></i> ', '</span>' ); ?>
                        <?php if ($comment->comment_approved == '0') : ?>
                            <div class="comment-mod">
                                Your comment is awaiting moderation.
                            </div>
                        <?php endif; ?>
                    </div><!-- . -->
                    <div class="comment-content">
						<?php comment_text(); ?>
					</div><!-- . -->
				</li><!-- #comment-<?php comment_ID(); ?> -->
			<?php endforeach; ?>
		</ol><!-- .comment-list -->

		<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) : // Are there comments to navigate through? ?>
			<nav id="comment-nav-below" class="navigation comment-navigation" role="navigation">
				<h2 class="screen-reader-text"><?php esc_html_e( 'Comment navigation', 'staypuft' ); ?></h2>
				<div class="nav-links">
					<div class="nav-previous"><?php previous_comments_link( esc_html__( 'Older Comments', 'staypuft' ) ); ?></div>
					<div class="nav-next"><?php next_comments_link( esc_html__( 'Newer Comments', 'staypuft' ) ); ?></div>
				</div><!-- .nav-links -->
			</nav><!-- #comment-nav-below -->
		<?php endif; // Check for comment navigation. ?>

	<?php endif; // Check for have_comments(). ?>

	<?php
		// If comments are closed and there are comments, let's leave a little note, shall we?
		if ( ! comments_open() && get_comments_number() && post_type_supports( get_post_type(), 'comments' ) ) :
	?>
		<p class="no-comments"><?php esc_html_e( 'Comments are closed.', 'staypuft' ); ?></p>
	<?php endif; ?>

	<?php comment_form(); ?>

</div><!-- #comments -->
