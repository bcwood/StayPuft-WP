<?php
/**
 * Template part for displaying attachments.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 * @package staypuft
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>

	<?php echo wp_get_attachment_image( get_the_ID(), 'large' ); ?>

	<header class="entry-header">
		<?php the_title( '<h1 class="entry-title">', '</h1>' ); ?>
		
		<div class="entry-meta">
			<?php staypuft_entry_meta(); ?>
		</div><!-- .entry-meta -->
	</header><!-- .entry-header -->	
	
	<div class="entry-content">
		<?php the_content(); ?>
	</div><!-- .entry-content -->

	<footer class="entry-footer">
		<?php staypuft_entry_footer(); ?>
	</footer><!-- .entry-footer -->
</article><!-- #post-<?php the_ID(); ?> -->
