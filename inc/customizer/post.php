<?php
/**
* Posts Settings.
*
* @package Masonry Grid
*/

$masonry_grid_default = masonry_grid_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'posts_settings',
	array(
	'title'      => esc_html__( 'Posts Settings', 'masonry-grid' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_author',
    array(
        'default' => $masonry_grid_default['ed_post_author'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_author',
    array(
        'label' => esc_html__('Enable Posts Author', 'masonry-grid'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_date',
    array(
        'default' => $masonry_grid_default['ed_post_date'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_date',
    array(
        'label' => esc_html__('Enable Posts Date', 'masonry-grid'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_category',
    array(
        'default' => $masonry_grid_default['ed_post_category'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_category',
    array(
        'label' => esc_html__('Enable Posts Category', 'masonry-grid'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_post_tags',
    array(
        'default' => $masonry_grid_default['ed_post_tags'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_tags',
    array(
        'label' => esc_html__('Enable Posts Tags', 'masonry-grid'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);


$wp_customize->add_setting('ed_post_excerpt',
    array(
        'default' => $masonry_grid_default['ed_post_excerpt'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_excerpt',
    array(
        'label' => esc_html__('Enable Posts Excerpt', 'masonry-grid'),
        'section' => 'posts_settings',
        'type' => 'checkbox',
    )
);

// Enable Disable Post.
$wp_customize->add_setting('post_video_aspect_ration',
    array(
        'default' => $masonry_grid_default['post_video_aspect_ration'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_select',
    )
);
$wp_customize->add_control('post_video_aspect_ration',
    array(
        'label' => esc_html__('Global Video Aspect Ratio', 'masonry-grid'),
        'section' => 'posts_settings',
        'type' => 'select',
        'choices'               => array(
            'default' => esc_html__( 'Default', 'masonry-grid' ),
            'square' => esc_html__( 'Square', 'masonry-grid' ),
            'portrait' => esc_html__( 'Portrait', 'masonry-grid' ),
            'landscape' => esc_html__( 'Landscape', 'masonry-grid' ),
            ),
        )
);


$wp_customize->add_setting('ed_autoplay',
    array(
        'default' => $masonry_grid_default['ed_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_select',
    )
);
$wp_customize->add_control('ed_autoplay',
    array(
        'label' => esc_html__('Global Video Autoplay', 'masonry-grid'),
        'section' => 'posts_settings',
        'type' => 'select',
        'choices'               => array(
            'autoplay-enable' => esc_html__( 'Autoplay Enable', 'masonry-grid' ),
            'autoplay-disable' => esc_html__( 'Autoplay Disable', 'masonry-grid' ),
            ),
        )
);