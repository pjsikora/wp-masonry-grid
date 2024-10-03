<?php
/**
* Carousel Section
*
* @package Masonry Grid
*/

$masonry_grid_default = masonry_grid_get_default_theme_options();
$masonry_grid_post_category_list = masonry_grid_post_category_list();

// Slider Section.
$wp_customize->add_section( 'masonry_grid_carousel_section',
	array(
	'title'      => esc_html__( 'Carousel Section Settings', 'masonry-grid' ),
	'capability' => 'edit_theme_options',
    'priority'   => 15,
    'panel'      => 'theme_option_panel',
	)
);

$wp_customize->add_setting('ed_carousel_section',
    array(
        'default' => $masonry_grid_default['ed_carousel_section'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_section',
    array(
        'label' => esc_html__('Enable Carousel Section', 'masonry-grid'),
        'section' => 'masonry_grid_carousel_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('mg_carousel_section_cat',
    array(
        'default' => '',
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_select',
    )
);
$wp_customize->add_control('mg_carousel_section_cat',
    array(
        'label' => esc_html__('Enable Carousel Section', 'masonry-grid'),
        'section' => 'masonry_grid_carousel_section',
        'type' => 'select',
        'choices' => $masonry_grid_post_category_list,
    )
);

$wp_customize->add_setting('ed_carousel_autoplay',
    array(
        'default' => $masonry_grid_default['ed_carousel_autoplay'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_autoplay',
    array(
        'label' => esc_html__('Enable Autoplay', 'masonry-grid'),
        'section' => 'masonry_grid_carousel_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_carousel_arrow',
    array(
        'default' => $masonry_grid_default['ed_carousel_arrow'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_arrow',
    array(
        'label' => esc_html__('Enable Arrow', 'masonry-grid'),
        'section' => 'masonry_grid_carousel_section',
        'type' => 'checkbox',
    )
);

$wp_customize->add_setting('ed_carousel_dots',
    array(
        'default' => $masonry_grid_default['ed_carousel_dots'],
        'capability' => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_checkbox',
    )
);
$wp_customize->add_control('ed_carousel_dots',
    array(
        'label' => esc_html__('Enable Dots', 'masonry-grid'),
        'section' => 'masonry_grid_carousel_section',
        'type' => 'checkbox',
    )
);