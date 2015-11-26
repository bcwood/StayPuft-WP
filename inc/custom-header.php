<?php
/**
 * Sample implementation of the Custom Header feature.
 *
 * You can add an optional custom header image to header.php like so ...
 *
	<?php if ( get_header_image() ) : ?>
	<a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
		<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="">
	</a>
	<?php endif; // End header image check. ?>
 *
 * @link http://codex.wordpress.org/Custom_Headers
 *
 * @package staypuft
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses staypuft_header_style()
 * @uses staypuft_admin_header_style()
 * @uses staypuft_admin_header_image()
 */
function staypuft_custom_header_setup() {
	add_theme_support( 'custom-header', apply_filters( 'staypuft_custom_header_args', array(
		'default-image'         => get_template_directory_uri() . '/images/staypuft.png',
		'width'                 => 128,
		'height'                => 128,
		'default-text-color' 	=> '#ffffff',
		'header-text' 			=> true,
		'wp-head-callback' 		=> 'staypuft_header_style',
	) ) );
}
add_action( 'after_setup_theme', 'staypuft_custom_header_setup' );

if ( ! function_exists( 'staypuft_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @see staypuft_custom_header_setup().
 */
function staypuft_header_style() {
	?>
	<style type="text/css">
        .site-title a {
			color: #<?php echo esc_attr( get_header_textcolor() ); ?>;
		}
		#secondary {
			background-color: <?php echo esc_attr( get_theme_mod( 'sidebar_bgcolor' ) ); ?>;
		}
	</style>
	<?php
}
endif; // staypuft_header_style

if ( ! function_exists( 'staypuft_admin_header_style' ) ) :
/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * @see staypuft_custom_header_setup().
 */
function staypuft_admin_header_style() {
	return;
?>
	<style type="text/css">
		.appearance_page_custom-header #headimg {
			border: none;
		}
		#headimg h1,
		#desc {
		}
		#headimg h1 {
		}
		#headimg h1 a {
		}
		#desc {
		}
		#headimg img {
		}
	</style>
<?php
}
endif; // staypuft_admin_header_style

if ( ! function_exists( 'staypuft_admin_header_image' ) ) :
/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * @see staypuft_custom_header_setup().
 */
function staypuft_admin_header_image() {
	return;
?>
	<div id="headimg">
		<h1 class="displaying-header-text">
			<a id="name" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>" onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<div class="displaying-header-text" id="desc" style="<?php echo esc_attr( 'color: #' . get_header_textcolor() ); ?>"><?php bloginfo( 'description' ); ?></div>
		<?php if ( get_header_image() ) : ?>
			<img src="<?php header_image(); ?>" alt="">
		<?php endif; ?>
	</div>
<?php
}
endif; // staypuft_admin_header_image
