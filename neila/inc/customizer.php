<?php
/**
 * neila theme Customizer
 *
 * @package neila
 */

function neila_theme_options( $wp_customize ) {
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';
}

add_action( 'customize_register' , 'neila_theme_options' );

/**
 * Options for WordPress Theme Customizer.
 */
function neila_customizer( $wp_customize ) {

	global $neila_site_layout, $neila_thumbs_layout;

	/**
	 * Section: Color Settings
	 */

	// Change accent color
	$wp_customize->add_setting( 'neila_accent_color', array(
		'default'        => '#7daa83',
		'sanitize_callback' => 'neila_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'neila_accent_color', array(
		'label'     => __('Accent color','neila'),
		'section'   => 'colors',
		'priority'  => 1,
	)));

	// Change links color
	$wp_customize->add_setting( 'neila_links_color', array(
		'default'        => '#257214',
		'sanitize_callback' => 'neila_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'neila_links_color', array(
		'label'     => __('Links color','neila'),
		'section'   => 'colors',
		'priority'  => 2,
	)));

	// checkbox center menu
	$wp_customize->add_setting( 'neila_bold_links', array(
		'default'        => true,
		'transport'  =>  'refresh',
		'sanitize_callback' => 'neila_sanitize_checkbox'
	) );

	$wp_customize->add_control( 'neila_bold_links', array(
		'priority'  => 3,
		'label'     => __('Bold links?','neila'),
		'section'   => 'colors',
		'type'      => 'checkbox',
	) );

	// Change hover color
	$wp_customize->add_setting( 'neila_hover_color', array(
		'default'        => '#ab1e1e',
		'sanitize_callback' => 'neila_sanitize_hexcolor',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( new WP_Customize_Color_Control($wp_customize, 'neila_hover_color', array(
		'label'     => __('Links hover color','neila'),
		'section'   => 'colors',
		'priority'  => 4,
	)));

	/**
	 * Section: Post Settings
	 */

	$wp_customize->add_section('neila_post_section', 
		array(
			'priority' => 31,
			'title' => __('Post Settings', 'neila'),
			'description' => __('change post settings', 'neila'),
			)
		);

		// Post Thumbnail Layout
		$wp_customize->add_setting('neila_thumbs_layout', array(
			'default' => 'landscape',
			'sanitize_callback' => 'neila_sanitize_thumbs'
		));

		$wp_customize->add_control('neila_thumbs_layout', array(
			'priority'  => 2,
			'label' => __('Thumbnail Layout', 'neila'),
			'section' => 'neila_post_section',
			'type'    => 'select',
			'description' => __('Choose post thumbnail layout', 'neila'),
			'choices'    => $neila_thumbs_layout
		));

	/**
	 * Section: Theme layout options
	 */

	$wp_customize->add_section('neila_layout_section', 
		array(
			'priority' => 32,
			'title' => __('Layout options', 'neila'),
			'description' => __('Choose website layout', 'neila'),
			)
		);

		// Sidebar position
		$wp_customize->add_setting('neila_sidebar_position', array(
			'default' => 'mz-sidebar-right',
			'sanitize_callback' => 'neila_sanitize_layout'
		));

		$wp_customize->add_control('neila_sidebar_position', array(
			'priority'  => 1,
			'label' => __('Website Layout Options', 'neila'),
			'section' => 'neila_layout_section',
			'type'    => 'select',
			'description' => __('Choose between different layout options to be used as default', 'neila'),
			'choices'    => $neila_site_layout
		));

		// checkbox center menu
		$wp_customize->add_setting( 'neila_menu_center', array(
			'default'        => false,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'neila_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'neila_menu_center', array(
			'priority'  => 2,
			'label'     => __('Center Menu?','neila'),
			'section'   => 'neila_layout_section',
			'type'      => 'checkbox',
		) );

	/**
	 * Section: Change footer text
	 */

	// Change footer copyright text
	$wp_customize->add_setting( 'neila_footer_text', array(
		'default'        => '',
		'sanitize_callback' => 'neila_sanitize_input',
		'transport'  =>  'refresh',
	));

	$wp_customize->add_control( 'neila_footer_text', array(
		'label'     => __('Footer Copyright Text','neila'),
		'section'   => 'title_tagline',
		'priority'    => 31,
	));

	/**
	 * Section: Slider settings
	 */

	$wp_customize->add_section( 
		'neila_slider_options', 
		array(
			'priority'    => 33,
			'title'       => __( 'Slider Settings', 'neila' ),
			'capability'  => 'edit_theme_options',
			'description' => __('Change slider settings here.', 'neila'), 
		) 
	);

		// chose category for slider
		$wp_customize->add_setting( 'neila_slider_cat', array(
			'default' => 0,
			'transport'   => 'refresh',
			'sanitize_callback' => 'neila_sanitize_slidercat'
		) );	

		$wp_customize->add_control( 'neila_slider_cat', array(
			'priority'  => 1,
			'type' => 'select',
			'label' => __('Choose a category.', 'neila'),
			'choices' => neila_cats(),
			'section' => 'neila_slider_options',
		) );

		// checkbox show/hide slider
		$wp_customize->add_setting( 'show_neila_slider', array(
			'default'        => false,
			'transport'  =>  'refresh',
			'sanitize_callback' => 'neila_sanitize_checkbox'
		) );

		$wp_customize->add_control( 'show_neila_slider', array(
			'priority'  => 2,
			'label'     => __('Show Slider?','neila'),
			'section'   => 'neila_slider_options',
			'type'      => 'checkbox',
		) );

}

add_action( 'customize_register', 'neila_customizer' );

/**
 * Adds sanitization for text inputs
 */
function neila_sanitize_input($input ) {
	return wp_kses_post( force_balance_tags( $input ) );
}

/**
 * Adds sanitization callback function: Slider Category
 */
function neila_sanitize_slidercat( $input ) {
	if ( array_key_exists( $input, neila_cats()) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze checkbox for WordPress customizer
 */
function neila_sanitize_checkbox( $input ) {
	if ( $input == 1 ) {
		return 1;
	} else {
		return '';
	}
}

/**
 * Sanitze number for WordPress customizer
 */
function neila_sanitize_number($input) {
	if ( isset( $input ) && is_numeric( $input ) ) {
		return $input;
	}
}

/**
 * Sanitze blog layout
 */
function neila_sanitize_layout( $input ) {
	global $neila_site_layout;
	if ( array_key_exists( $input, $neila_site_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze thumbs layout
 */
function neila_sanitize_thumbs( $input ) {
	global $neila_thumbs_layout;
	if ( array_key_exists( $input, $neila_thumbs_layout ) ) {
		return $input;
	} else {
		return '';
	}
}

/**
 * Sanitze colors
 */
function neila_sanitize_hexcolor($color)
{
	if ($unhashed = sanitize_hex_color_no_hash($color)) {
		return '#'.$unhashed;
	}

	return $color;
}