<?php
/**
 * Default Values.
 *
 * @package Masonry Grid
 */

if ( ! function_exists( 'masonry_grid_get_default_theme_options' ) ) :

    /**
     * Get default theme options
     *
     * @since 1.0.0
     *
     * @return array Default theme options.
     */
    function masonry_grid_get_default_theme_options() {

        $masonry_grid_defaults = array();
        // Options.
        $masonry_grid_defaults['logo_width_range']                       = 230;
        $masonry_grid_defaults['masonry_grid_pagination_layout']      = 'numeric';
        $masonry_grid_defaults['footer_column_layout']                       = 3;
        $masonry_grid_defaults['footer_copyright_text']                      = esc_html__( 'All rights reserved.', 'masonry-grid' );
        $masonry_grid_defaults['ed_header_search']                           = 1;
        $masonry_grid_defaults['ed_image_content_inverse']                   = 0;
        $masonry_grid_defaults['ed_related_post']                            = 1;
        $masonry_grid_defaults['related_post_title']                         = esc_html__('Related Post','masonry-grid');
        $masonry_grid_defaults['twp_navigation_type']                        = 'norma-navigation';
        $masonry_grid_defaults['ed_post_author']                             = 1;
        $masonry_grid_defaults['ed_post_date']                               = 1;
        $masonry_grid_defaults['ed_post_category']                           = 1;
        $masonry_grid_defaults['ed_post_tags']                               = 1;
        $masonry_grid_defaults['ed_floating_next_previous_nav']               = 1;
        $masonry_grid_defaults['ed_footer_copyright']                        = 1;

        // Default Color
        $masonry_grid_defaults['background_color']          = 'ffffff';
        $masonry_grid_defaults['masonry_grid_primary_color']          = '#000000';
        $masonry_grid_defaults['masonry_grid_secondary_color']        = '#0027ff';
        $masonry_grid_defaults['masonry_grid_general_color']        = '#000000';

        // Simple Color
        $masonry_grid_defaults['masonry_grid_primary_color_dark']          = '#007CED';
        $masonry_grid_defaults['masonry_grid_secondary_color_dark']        = '#fb7268';
        $masonry_grid_defaults['masonry_grid_general_color_dark']        = '#ffffff';

        // Fancy Color
        $masonry_grid_defaults['masonry_grid_primary_color_fancy']          = '#017eff';
        $masonry_grid_defaults['masonry_grid_secondary_color_fancy']        = '#fc9285';
        $masonry_grid_defaults['masonry_grid_general_color_fancy']        = '#455d58';


        $masonry_grid_defaults['masonry_grid_color_schema']           = 'default';
        $masonry_grid_defaults['ed_desktop_menu']            = 1;
        $masonry_grid_defaults['ed_post_excerpt']            = 1;
        $masonry_grid_defaults['recent_post_title_search']                 = esc_html__('Recent Post','masonry-grid');
        $masonry_grid_defaults['top_category_title_search']                 = esc_html__('Top Category','masonry-grid');
        $masonry_grid_defaults['ed_header_search_recent_posts']             = 1;
        $masonry_grid_defaults['ed_header_search_top_category']             = 1;
        $masonry_grid_defaults['ed_day_night_mode_switch']             = 1;
        $masonry_grid_defaults['ed_carousel_section']             = 0;
        $masonry_grid_defaults['ed_carousel_autoplay']             = 1;
        $masonry_grid_defaults['ed_carousel_arrow']             = 1;
        $masonry_grid_defaults['ed_carousel_dots']             = 0;
        $masonry_grid_defaults['ed_post_filter']             = 0;

        $masonry_grid_defaults['ed_preloader']             = 1;
        $masonry_grid_defaults['ed_cursor_option']             = 1;
        
        $masonry_grid_defaults['ed_autoplay']             = 'autoplay-disable';
        $masonry_grid_defaults['global_sidebar_layout']             = 'right-sidebar';
        $masonry_grid_defaults['post_video_aspect_ration']             = 'default';


        $masonry_grid_defaults['ed_header_banner']                       = 0;
        $masonry_grid_defaults['ed_header_banner_overlay']               = 0;
        $masonry_grid_defaults['header_banner_title']                    = '';
        $masonry_grid_defaults['header_banner_sub_title']                = '';
        $masonry_grid_defaults['header_banner_description']              = '';
        $masonry_grid_defaults['header_banner_button_label']             = '';
        $masonry_grid_defaults['header_banner_button_link']              = '';

        // Pass through filter.
        $masonry_grid_defaults = apply_filters( 'masonry_grid_filter_default_theme_options', $masonry_grid_defaults );

        return $masonry_grid_defaults;

    }

endif;
