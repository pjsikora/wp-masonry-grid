<?php
/**
* Color Settings.
*
* @package Masonry Grid
*/

$masonry_grid_default = masonry_grid_get_default_theme_options();

$wp_customize->add_section( 'color_scheme',
    array(
    'title'      => esc_html__( 'Color Scheme', 'masonry-grid' ),
    'priority'   => 60,
    'capability' => 'edit_theme_options',
    'panel'      => 'theme_colors_panel',
    )
);

// Color Scheme.
$wp_customize->add_setting(
    'masonry_grid_color_schema',
    array(
        'default' 			=> $masonry_grid_default['masonry_grid_color_schema'],
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'masonry_grid_sanitize_select'
    )
);
$wp_customize->add_control(
    new Masonry_Grid_Custom_Radio_Color_Schema( 
        $wp_customize,
        'masonry_grid_color_schema',
        array(
            'settings'      => 'masonry_grid_color_schema',
            'section'       => 'color_scheme',
            'label'         => esc_html__( 'Color Scheme', 'masonry-grid' ),
            'choices'       => array(
                'default'  => array(
                	'color' => array('#f5f6f8','#000','#0027ff','#000'),
                	'title' => esc_html__('Default','masonry-grid'),
                ),
                'fancy'  => array(
                	'color' => array('#faf7f2','#017eff','#fc9285','#455d58'),
                	'title' => esc_html__('Fancy','masonry-grid'),
                ),
                'dark'  => array(
                    'color' => array('#222222','#007CED','#fb7268','#ffffff'),
                    'title' => esc_html__('Dark','masonry-grid'),
                ),
            )
        )
    )
);

$wp_customize->add_setting( 'masonry_grid_primary_color',
    array(
    'default'           => $masonry_grid_default['masonry_grid_primary_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'masonry_grid_primary_color', 
    array(
        'label'      => esc_html__( 'Primary Color', 'masonry-grid' ),
        'section'    => 'colors',
        'settings'   => 'masonry_grid_primary_color',
    ) ) 
);

$wp_customize->add_setting( 'masonry_grid_secondary_color',
    array(
    'default'           => $masonry_grid_default['masonry_grid_secondary_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'masonry_grid_secondary_color', 
    array(
        'label'      => esc_html__( 'Secondary Color', 'masonry-grid' ),
        'section'    => 'colors',
        'settings'   => 'masonry_grid_secondary_color',
    ) ) 
);

$wp_customize->add_setting( 'masonry_grid_general_color',
    array(
    'default'           => $masonry_grid_default['masonry_grid_general_color'],
    'capability'        => 'edit_theme_options',
    'sanitize_callback' => 'sanitize_hex_color',
    )
);
$wp_customize->add_control( 
    new WP_Customize_Color_Control( 
    $wp_customize, 
    'masonry_grid_general_color', 
    array(
        'label'      => esc_html__( 'General Color', 'masonry-grid' ),
        'section'    => 'colors',
        'settings'   => 'masonry_grid_general_color',
    ) ) 
);

$wp_customize->add_setting(
    'masonry_grid_premium_notice_color_schema',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Masonry_Grid_Premium_Notice_Control( 
        $wp_customize,
        'masonry_grid_premium_notice_color_schema',
        array(
            'label'      => esc_html__( 'Color Schemes', 'masonry-grid' ),
            'settings' => 'masonry_grid_premium_notice_color_schema',
            'section'       => 'color_scheme',
        )
    )
);


$wp_customize->add_setting(
    'masonry_grid_premium_notice_color',
    array(
        'default'           => '',
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field'
    )
);
$wp_customize->add_control(
    new Masonry_Grid_Premium_Notice_Control( 
        $wp_customize,
        'masonry_grid_premium_notice_color',
        array(
            'label'      => esc_html__( 'Color Options', 'masonry-grid' ),
            'settings' => 'masonry_grid_premium_notice_color',
            'section'       => 'colors',
        )
    )
);