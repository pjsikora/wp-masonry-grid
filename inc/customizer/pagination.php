<?php
/**
 * Pagination Settings
 *
 * @package Masonry Grid
 */

$masonry_grid_default = masonry_grid_get_default_theme_options();

// Pagination Section.
$wp_customize->add_section( 'masonry_grid_pagination_section',
	array(
	'title'      => esc_html__( 'Pagination Settings', 'masonry-grid' ),
	'priority'   => 20,
	'capability' => 'edit_theme_options',
	'panel'		 => 'theme_option_panel',
	)
);

// Pagination Layout Settings
$wp_customize->add_setting( 'masonry_grid_pagination_layout',
	array(
	'default'           => $masonry_grid_default['masonry_grid_pagination_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'masonry_grid_pagination_layout',
	array(
	'label'       => esc_html__( 'Pagination Method', 'masonry-grid' ),
	'section'     => 'masonry_grid_pagination_section',
	'type'        => 'select',
	'choices'     => array(
		'next-prev' => esc_html__('Next/Previous Method','masonry-grid'),
		'numeric' => esc_html__('Numeric Method','masonry-grid'),
		'load-more' => esc_html__('Ajax Load More Button','masonry-grid'),
		'auto-load' => esc_html__('Ajax Auto Load','masonry-grid'),
	),
	)
);