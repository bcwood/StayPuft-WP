<?php
/**
 * staypuft Theme Customizer.
 *
 * @package staypuft
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function staypuft_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
	
	$wp_customize->add_setting( 'sidebar_bgcolor' , array(
		'default'     => '#22313F',
		'transport'   => 'postMessage',
	) );
	
	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'sidebar_bgcolor', array(
		'label'        => __( 'Sidebar Background Color', 'staypuft' ),
		'section'    => 'colors',
		'settings'   => 'sidebar_bgcolor',
	) ) );
}
add_action( 'customize_register', 'staypuft_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function staypuft_customize_preview_js() {
	wp_enqueue_script( 'staypuft_customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20130508', true );
}
add_action( 'customize_preview_init', 'staypuft_customize_preview_js' );
