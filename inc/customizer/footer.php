<?php
/**
* Footer Settings.
*
* @package Masonry Grid
*/

$masonry_grid_default = masonry_grid_get_default_theme_options();


$wp_customize->add_section( 'footer_widget_area',
	array(
	'title'      => esc_html__( 'Footer Settings', 'masonry-grid' ),
	'priority'   => 200,
	'capability' => 'edit_theme_options',
	'panel'      => 'theme_option_panel',
	)
);


$wp_customize->add_setting( 'footer_column_layout',
	array(
	'default'           => $masonry_grid_default['footer_column_layout'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'masonry_grid_sanitize_select',
	)
);
$wp_customize->add_control( 'footer_column_layout',
	array(
	'label'       => esc_html__( 'Top Footer Column Layout', 'masonry-grid' ),
	'section'     => 'footer_widget_area',
	'type'        => 'select',
	'choices'               => array(
		'1' => esc_html__( 'One Column', 'masonry-grid' ),
		'2' => esc_html__( 'Two Column', 'masonry-grid' ),
		'3' => esc_html__( 'Three Column', 'masonry-grid' ),
	    ),
	)
);

$wp_customize->add_setting( 'footer_copyright_text',
	array(
	'default'           => $masonry_grid_default['footer_copyright_text'],
	'capability'        => 'edit_theme_options',
	'sanitize_callback' => 'sanitize_text_field',
	)
);
$wp_customize->add_control( 'footer_copyright_text',
	array(
	'label'    => esc_html__( 'Footer Copyright Text', 'masonry-grid' ),
	'section'  => 'footer_widget_area',
	'type'     => 'text',
	)
);