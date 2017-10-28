<?php
/**
 * SRCC Theme Customizer
 *
 * @package SRCC
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function srcc_customize_register( $wp_customize ) {
	$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	if ( isset( $wp_customize->selective_refresh ) ) {
		$wp_customize->selective_refresh->add_partial( 'blogname', array(
			'selector'        => '.site-title a',
			'render_callback' => 'srcc_customize_partial_blogname',
		) );
		$wp_customize->selective_refresh->add_partial( 'blogdescription', array(
			'selector'        => '.site-description',
			'render_callback' => 'srcc_customize_partial_blogdescription',
		) );
	}

	$wp_customize->add_panel( 'theme_options', array(
		'priority'			=> 10,
		'capability'		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'				=> __( 'Theme Options', 'srcc' ),
		'description'		=> __( 'Custom options built for this theme.' ),
	) );

	$wp_customize->add_section( 'social_media', array(
		'priority'			=> 10,
		'capability'		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'				=> __( 'Social Media', 'srcc' ),
		'description'		=> 'Filled in fields will show a social media FontAwesome icon in certain areas.',
		'panel'				=> 'theme_options',
	) );

	$wp_customize->add_setting( 'url_facebook', array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_facebook', array(
		'type'				=> 'url',
		'priority'			=> 10,
		'section'			=> 'social_media',
		'label'				=> __( 'Facebook URL', 'srcc' ),
		'description'		=> '',
	) );

	$wp_customize->add_setting( 'url_twitter', array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_twitter', array(
		'type'				=> 'url',
		'priority'			=> 10,
		'section'			=> 'social_media',
		'label'				=> __( 'Twitter URL', 'srcc' ),
		'description'		=> '',
	) );

	$wp_customize->add_setting( 'url_instagram', array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_instagram', array(
		'type'				=> 'url',
		'priority'			=> 10,
		'section'			=> 'social_media',
		'label'				=> __( 'Instagram URL', 'srcc' ),
		'description'		=> '',
	) );

	$wp_customize->add_setting( 'url_youtube', array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_youtube', array(
		'type'				=> 'url',
		'priority'			=> 10,
		'section'			=> 'social_media',
		'label'				=> __( 'YouTube URL', 'srcc' ),
		'description'		=> '',
	) );

	$wp_customize->add_setting( 'url_linkedin', array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'esc_url',
	) );

	$wp_customize->add_control( 'url_linkedin', array(
		'type'				=> 'url',
		'priority'			=> 10,
		'section'			=> 'social_media',
		'label'				=> __( 'LinkedIn URL', 'srcc' ),
		'description'		=> '',
	) );

	$wp_customize->add_section( 'business_info', array(
		'priority'			=> 10,
		'capability'		=> 'edit_theme_options',
		'theme_supports'	=> '',
		'title'				=> __( 'Business Info', 'srcc' ),
		'description'		=> 'General organization information used to populate various areas on the website.',
		'panel'				=> 'theme_options',
	) );

	$wp_customize->add_setting( 'phone_number', array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'phone_number', array(
		'type'				=> 'text',
		'priority'			=> 10,
		'section'			=> 'business_info',
		'label'				=> __( 'Phone Number', 'srcc' ),
		'description'		=> '',
	) );

	$wp_customize->add_setting( 'email_address', array(
		'default'			=> '',
		'type'				=> 'theme_mod',
		'capability'		=> 'edit_theme_options',
		'transport'			=> '',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'email_address', array(
		'type'				=> 'text',
		'priority'			=> 10,
		'section'			=> 'business_info',
		'label'				=> __( 'Email Address', 'srcc' ),
		'description'		=> '',
	) );
}
add_action( 'customize_register', 'srcc_customize_register' );

/**
 * Render the site title for the selective refresh partial.
 *
 * @return void
 */
function srcc_customize_partial_blogname() {
	bloginfo( 'name' );
}

/**
 * Render the site tagline for the selective refresh partial.
 *
 * @return void
 */
function srcc_customize_partial_blogdescription() {
	bloginfo( 'description' );
}

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function srcc_customize_preview_js() {
	wp_enqueue_script( 'srcc-customizer', get_template_directory_uri() . '/js/customizer.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'srcc_customize_preview_js' );
