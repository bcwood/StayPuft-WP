<?php
/**
 * The sidebar containing the main widget area.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package staypuft
 */
?>

<div id="secondary">
	<div id="secondary-content" class="inner widget-area" role="complementary">
		
		<header id="masthead" class="site-header" role="banner">
			<div class="site-branding">
				
				<?php if ( get_header_image() ) : ?>
					<a class="site-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home">
						<img src="<?php header_image(); ?>" width="<?php echo esc_attr( get_custom_header()->width ); ?>" height="<?php echo esc_attr( get_custom_header()->height ); ?>" alt="<?php bloginfo( 'name' ); ?>"></a>
				<?php endif; ?>
				
				<?php if ( is_front_page() && is_home() ) : ?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
				<?php else : ?>
					<p class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></p>
				<?php endif;
	
				$description = get_bloginfo( 'description', 'display' );
				if ( $description || is_customize_preview() ) : ?>
					<p class="site-description"><?php echo $description; /* WPCS: xss ok. */ ?></p>
				<?php endif; ?>
			</div><!-- .site-branding -->
	
			<!--
			<nav id="site-navigation" class="main-navigation" role="navigation">
				<button class="menu-toggle" aria-controls="primary-menu" aria-expanded="false"><?php /*esc_html_e( 'Primary Menu', 'staypuft' );*/ ?></button>
				<?php /*wp_nav_menu( array( 'theme_location' => 'primary', 'menu_id' => 'primary-menu' ) );*/ ?>
			</nav>--><!-- #site-navigation -->			
		</header><!-- #masthead -->
		
		<!--
		<?php /*if ( is_active_sidebar( 'sidebar-1' ) ) { dynamic_sidebar( 'sidebar-1' ); }*/ ?>		
		-->
		
		<aside class="widget search">
			<?php require get_template_directory() . '/searchform.php'; ?>
		</aside>
		
		<?php
			$social_icons = get_option( 'staypuft_options_social_icons' );
			if ( !empty( $social_icons ) ) : 
		?>            
				<aside class="widget social-icons">
					<ul>
						<?php foreach ($social_icons as $key => $icon) : ?>
							<li class="<?php echo strtolower($icon["name"]); ?>"><a href="<?php echo $icon["prefix"] . $icon["value"]; ?>">
								<i class="<?php echo $icon["icon_class"]; ?>"></i> <?php echo $icon["name"]; ?></a></li>
						<?php endforeach; ?>
					</ul>
				</aside>
		<?php endif; ?>
		
		<footer id="colophon" class="site-footer" role="contentinfo">
			<div class="site-info">
				<section class="copyright">
					&copy; <?php echo date("Y"); ?> <a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a>
				</section>
				<section class="poweredby">
					<i class="fa fa-wordpress"></i> <a href="<?php echo esc_url( __( 'https://wordpress.org/', 'staypuft' ) ); ?>"><?php esc_html_e( 'WordPress', 'staypuft' ); ?></a> -
					<a href="<?php echo esc_url( __( 'https://github.com/bcwood/StayPuft-WP', 'staypuft' ) ); ?>"><?php esc_html_e( 'StayPuft theme', 'staypuft' ); ?></a>
				</section>
			</div><!-- .site-info -->
		</footer><!-- #colophon -->
	</div><!-- #secondary-content -->
</div><!-- #secondary -->
