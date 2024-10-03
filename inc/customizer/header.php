<?php
/**
* Header Options.
*
* @package Masonry Grid
*/

$masonry_grid_default = masonry_grid_get_default_theme_options();

// Header Advertise Area Section.
$wp_customize->add_section( 'main_header_setting',
	array(
	'title'      => esc_html__( 'Header Settings', 'masonry-grid' ),
	'priority'   => 10,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

// Enable Disable Search.
$wp_customize->add_setting('ed_header_search',
    array(
        'default' => $masonry_grid_default['ed_header_search'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search',
    array(
        'label' => esc_html__('Enable Search', 'masonry-grid'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_desktop_menu',
    array(
        'default' => $masonry_grid_default['ed_desktop_menu'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_desktop_menu',
    array(
        'label' => esc_html__('Enable Primary Desktop Menu', 'masonry-grid'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_header_search_recent_posts',
    array(
        'default' => $masonry_grid_default['ed_header_search_recent_posts'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_recent_posts',
    array(
        'label' => esc_html__('Enable Recent Posts on Search Area', 'masonry-grid'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'recent_post_title_search',
    array(
    'default'           => $masonry_grid_default['recent_post_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'recent_post_title_search',
    array(
    'label'    => esc_html__( 'Related Posts Section Title', 'masonry-grid' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);
$wp_customize->add_setting('ed_header_search_top_category',
    array(
        'default' => $masonry_grid_default['ed_header_search_top_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_header_search_top_category',
    array(
        'label' => esc_html__('Enable Top Category on Search Area', 'masonry-grid'),
        'section' => 'main_header_setting',
        'type' => 'checkbox',
    )
);
$wp_customize->add_setting( 'top_category_title_search',
    array(
    'default'           => $masonry_grid_default['top_category_title_search'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_text_field',
    )
);
$wp_customize->add_control( 'top_category_title_search',
    array(
    'label'    => esc_html__( 'Top Category Section Title', 'masonry-grid' ),
    'section'  => 'main_header_setting',
    'type'     => 'text',
    )
);