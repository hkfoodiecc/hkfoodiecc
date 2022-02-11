<?php
/**
 *
 * @package neila
 */

global $neila_site_layout;
$neila_site_layout = array(
					'mz-sidebar-left' =>  esc_html__('Left Sidebar','neila'),
					'mz-sidebar-right' => esc_html__('Right Sidebar','neila'),
					'no-sidebar' => esc_html__('No Sidebar','neila')
					);
$neila_thumbs_layout = array(
					'landscape' =>  esc_html__('Landscape','neila'),
					'portrait' => esc_html__('Portrait','neila')
					);

if ( ! function_exists( 'neila_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function neila_setup() {

	/*
	* Make theme available for translation.
	* Translations can be filed in the /languages/ directory.
	*/
	load_theme_textdomain( 'neila', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/**
	* Enable support for Post Thumbnails on posts and pages.
	*
	* @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	*/
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'neila-slider-thumbnail', 1140, 515, true );
	add_image_size( 'neila-large-thumbnail', 1140, 640, true );
	add_image_size( 'neila-landscape-thumbnail', 750, 490, true );
	add_image_size( 'neila-portrait-thumbnail', 750, 750, true );
	add_image_size( 'neila-author-thumbnail', 170, 170, true );
	add_image_size( 'neila-small-thumbnail', 100, 80, true );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'top-menu' => esc_html__( 'Top Menu', 'neila' ),
		'primary' => esc_html__( 'Primary Menu', 'neila' ),
	) );

	// Set the content width based on the theme's design and stylesheet.
	global $content_width;
	if ( ! isset( $content_width ) ) {
	$content_width = 1140; /* pixels */
	} 

	/*
	* Switch default core markup for search form, comment form, and comments
	* to output valid HTML5.
	*/
	add_theme_support( 'html5', array(
		'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	// Setup the WordPress core custom background feature.
	add_theme_support( 'custom-background', apply_filters( 'neila_custom_background_args', array(
		'default-color' => 'FFFFFF',
		'default-image' => '',
	) ) );

	/*
	* Let WordPress manage the document title.
	* By adding theme support, we declare that this theme does not use a
	* hard-coded <title> tag in the document head, and expect WordPress to
	* provide it for us.
	*/
	add_theme_support( 'title-tag' );

	add_theme_support( 'custom-logo', array(
		'height'      => 160,
		'width'       => 500,
		'flex-height' => true,
	) );

}
endif; // neila_setup
add_action( 'after_setup_theme', 'neila_setup' );


/**
 * Displays the optional custom logo.
 *
 * Does nothing if the custom logo is not available.
 *
 */
if ( ! function_exists( 'neila_the_custom_logo' ) ) :
function neila_the_custom_logo() {
	// Try to retrieve the Custom Logo
	if ((function_exists('the_custom_logo'))&&(has_custom_logo())) {
		the_custom_logo();
	} else {
		// Nothing in the output: Custom Logo is not supported, or there is no selected logo
		// In both cases we display the site's name
		echo '<hgroup><h1><a href="' . esc_url(home_url('/')) . '" rel="home">' . esc_html(get_bloginfo('name')) . '</a></h1><div class="description">'.esc_html(get_bloginfo('description')).'</div></hgroup>';
	}

}
endif; // neila_content_bootstrap_classes


/*
 * Add Bootstrap classes to the main-content-area wrapper.
 */
if ( ! function_exists( 'neila_content_bootstrap_classes' ) ) :
function neila_content_bootstrap_classes() {
	if ( is_page_template( 'template-fullwidth.php' ) ) {
		return 'col-md-12';
	}
	return 'col-md-8';
}
endif; // neila_content_bootstrap_classes

/*
 * Checked if function is exits, if not exits then make a function called wp_body_open();
 */
if ( ! function_exists( 'wp_body_open' ) ) {
    function wp_body_open() {
        do_action( 'wp_body_open' );
    }
}

/*
 * Generate categories for slider customizer
 */
function neila_cats() {
	$cats = array();
	$cats[0] = esc_html__("All", "neila");
	
	foreach ( get_categories() as $categories => $category ) {
		$cats[$category->term_id] = $category->name;
	}

	return $cats;
}

/*
 * generate navigation from default bootstrap classes
 */
include( get_template_directory() . '/inc/wp_bootstrap_navwalker.php');

if ( ! function_exists( 'neila_header_menu' ) ) :
/*
 * Header menu (should you choose to use one)
 */
function neila_header_menu() {

	$neila_menu_center = get_theme_mod( 'neila_menu_center' );

	/* display the WordPress Custom Menu if available */
	$neila_add_center_class = "";
	if ( true == $neila_menu_center ) {
		$neila_add_center_class = " navbar-center";
	}

	wp_nav_menu(array(
		'theme_location'    => 'primary',
		'depth'             => 3,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse navbar-ex2-collapse'.$neila_add_center_class,
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'neila_bootstrap_navwalker::fallback',
		'walker'            => new neila_bootstrap_navwalker()
	));
} /* end header menu */
endif;

if ( ! function_exists( 'neila_top_menu' ) ) :
/*
 * Header menu (should you choose to use one)
 */
function neila_top_menu() {

	wp_nav_menu(array(
		'theme_location'    => 'top-menu',
		'depth'             => 2,
		'container'         => 'div',
		'container_class'   => 'collapse navbar-collapse navbar-ex1-collapse',
		'menu_class'        => 'nav navbar-nav',
		'fallback_cb'       => 'neila_bootstrap_navwalker::fallback',
		'walker'            => new neila_bootstrap_navwalker()
	));
} /* end header menu */
endif;

/*
 * Register Google fonts for theme.
 */
if ( ! function_exists( 'neila_fonts_url' ) ) :
/**
 * Create your own neila_fonts_url() function to override in a child theme.
 *
 * @since neila 1.0
 *
 * @return string Google fonts URL for the theme.
 */
function neila_fonts_url() {
	$fonts_url = '';
	$fonts     = array();
	$subsets   = 'latin,latin-ext';

	/* translators: If there are characters in your language that are not supported by Crimson Text, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Karla font: on or off', 'neila' ) ) {
		$fonts[] = 'Karla:400,500,600,700';
	}

	/* translators: If there are characters in your language that are not supported by Crimson Text, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Overpass font: on or off', 'neila' ) ) {
		$fonts[] = 'Amiri:400,700';
	}

	/* translators: If there are characters in your language that are not supported by Noto Sans, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Open Sans font: on or off', 'neila' ) ) {
		$fonts[] = 'Open Sans:400,500,700';
	}

	/* translators: If there are characters in your language that are not supported by Playfair Display, translate this to 'off'. Do not translate into your own language. */
	if ( 'off' !== _x( 'on', 'Raleway font: on or off', 'neila' ) ) {
		$fonts[] = 'Raleway:400,400italic,700,700italic';
	}

	if ( $fonts ) {
		$fonts_url = add_query_arg( array(
			'family' => urlencode( implode( '|', $fonts ) ),
			'subset' => urlencode( $subsets ),
		), '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}
endif;

/*
 * load css/js
 */
function neila_scripts() {

	// Add Google Fonts
	wp_enqueue_style( 'neila-webfonts', neila_fonts_url(), array(), null, null );

	// Add Bootstrap default CSS
	wp_enqueue_style( 'bootstrap', get_template_directory_uri() . '/css/bootstrap.css' );
	wp_enqueue_style( 'font-awesome', get_template_directory_uri().'/css/font-awesome.css' );

	// Add main theme stylesheet
	wp_enqueue_style( 'neila-style', get_stylesheet_uri() );

	// Add JS Files
	wp_enqueue_script( 'bootstrap', get_template_directory_uri().'/js/bootstrap.js', array('jquery') );
	wp_enqueue_script( 'jquery-slick', get_template_directory_uri() . '/js/slick.js', array('jquery') );
	wp_enqueue_script( 'neila-js', get_template_directory_uri().'/js/neila.js', array('jquery') );

	// Threaded comments
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
	wp_enqueue_script( 'comment-reply' );
	}

}
add_action( 'wp_enqueue_scripts', 'neila_scripts' );

/*
 * Add custom colors css to header
 */
if (!function_exists('neila_custom_css_output'))  {
	function neila_custom_css_output() {

		$neila_accent_color = get_theme_mod( 'neila_accent_color' );
		$neila_hover_color = get_theme_mod( 'neila_hover_color' );
		$neila_links_color = get_theme_mod( 'neila_links_color' );
		$neila_bold_links = get_theme_mod( 'neila_bold_links' );

		echo '<style type="text/css" id="neila-custom-theme-css">';

		if ( $neila_accent_color != "") {
			echo '.post-cats span { background-color: ' . esc_attr($neila_accent_color) . ' ;}' .
			'.post-cats span:before { border-top-color: ' . esc_attr($neila_accent_color) . ' ;}' .
			'.mz-footer .widget-title span { box-shadow: ' . esc_attr($neila_accent_color) . ' 0px -2px 0px inset ;}' .
			'.post-meta span i, .post-header span i { color: ' . esc_attr($neila_accent_color) . ' ;}' .
			'.navbar-top .navbar-toggle { background-color: ' . esc_attr($neila_accent_color) . ' ;}' .
			'.page-numbers .current {background-color: ' . esc_attr($neila_accent_color) . '; border-color: ' . esc_attr($neila_accent_color) . ';}';
		}
		if ( $neila_links_color != "") {
			echo '.post-entry a { color: ' . esc_attr($neila_links_color) . ' ;}';
		}

		/* display the WordPress Custom Menu if available */
		if ( true == $neila_bold_links ) {
			echo '.post-entry a { font-weight: bold ;}';
		}

		if ( $neila_hover_color != "" ) {
			echo 'a:hover, a:focus, a:active, a.active, .post-header h1 a:hover, .post-header h2 a:hover { color: ' . esc_attr($neila_hover_color) . '; }' .
			'.dropdown-menu>li>a:focus, .dropdown-menu>li>a:hover, .post-image .cat a:hover, .post-header .cat a:hover, #back-top a:hover { background-color: ' . esc_attr($neila_hover_color) . ';}' .
			'.read-more a:hover, .ot-widget-about-author .author-post .read-more a:hover, .null-instagram-feed p a:hover, button:hover, input[type="button"]:hover, input[type="reset"]:hover, input[type="submit"]:hover, .page-numbers li a:hover {background-color: ' . esc_attr($neila_hover_color) . '; border-color: ' . esc_attr($neila_hover_color) . ';}';
		}

		echo '</style>';

	}
}
add_action( 'wp_head', 'neila_custom_css_output');

/*
 * Customizer additions.
 */
require get_template_directory() . '/inc/extras.php';
require get_template_directory() . '/inc/customizer.php';

/*
 * Register widget areas.
 */

// if no title then add widget content wrapper to before widget
add_filter( 'dynamic_sidebar_params', 'neila_check_sidebar_params' );
function neila_check_sidebar_params( $params ) {
	global $wp_registered_widgets;

	$settings_getter = $wp_registered_widgets[ $params[0]['widget_id'] ]['callback'][0];
	$settings = $settings_getter->get_settings();
	$settings = $settings[ $params[1]['number'] ];

	if ( $params[0][ 'after_widget' ] == '</div></div>' && isset( $settings[ 'title' ] ) && empty( $settings[ 'title' ] ) )
		$params[0][ 'before_widget' ] .= '<div class="content">';

	return $params;
}

function neila_widgets_init() {

	register_sidebar( array(
		'name'          => esc_html__( 'Primary Sidebar', 'neila' ),
		'id'            => 'sidebar-1',
		'description'   => esc_html__( 'Main sidebar that appears on the left.', 'neila' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 1', 'neila' ),
		'id'            => 'footer-widget-1',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'neila' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 2', 'neila' ),
		'id'            => 'footer-widget-2',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'neila' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Footer Widget 3', 'neila' ),
		'id'            => 'footer-widget-3',
		'description'   => esc_html__( 'Appears in the footer section of the site.', 'neila' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );
	register_sidebar( array(
		'name'          => esc_html__( 'Full Width Footer', 'neila' ),
		'id'            => 'footer-wide-widget',
		'description'   => esc_html__( 'Full width footer area for Instagram, etc. Appears in the footer section after widgets.', 'neila' ),
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget'  => '</div>',
		'before_title'  => '<div class="widget-title"><span>',
		'after_title'   => '</span></div>',
	) );

}
add_action( 'widgets_init', 'neila_widgets_init' );

/*
 * Misc. functions
 */

/**
 * Footer credits
 */
function neila_footer_credits() {
	$neila_footer_text = get_theme_mod( 'neila_footer_text' );
	?>
	<div class="site-info">
	<?php if ($neila_footer_text == '') { ?>
	&copy; <?php bloginfo( 'name' ); ?><?php esc_html_e('. All rights reserved.', 'neila'); ?>
	<?php } else { echo esc_html( $neila_footer_text ); } ?>
	</div><!-- .site-info -->

	<?php
	printf( esc_html__( 'Theme by %1$s Powered by %2$s', 'neila' ) , '<a href="https://www.mooz.reviews" rel="nofollow" target="_blank">MOOZ</a>', '<a href="http://wordpress.org/" target="_blank">WordPress</a>');
}
add_action( 'neila_footer', 'neila_footer_credits' );

/* Wrap Post count in a span */
add_filter('wp_list_categories', 'neila_cat_count_span');
function neila_cat_count_span($links) {
	$links = str_replace('</a> (', '</a> <span>', $links);
	$links = str_replace(')', '</span>', $links);
	return $links;
}