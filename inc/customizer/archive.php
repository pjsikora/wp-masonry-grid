<?php
/**
* Archive Settings.
*
* @package Masonry Grid
*/

$masonry_grid_default = masonry_grid_get_default_theme_options();

// Single Post Section.
$wp_customize->add_section( 'archive_settings',
	array(
	'title'      => esc_html__( 'Archive Settings', 'masonry-grid' ),
	'priority'   => 35,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_post_filter',
    array(
        'default' => $masonry_grid_default['ed_post_filter'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_post_filter',
    array(
        'label' => esc_html__('Enable Archive Post Filter', 'masonry-grid'),
        'section' => 'archive_settings',
        'type' => 'checkbox',
    )
);
