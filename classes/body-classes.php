<?php
/**
* Body Classes.
*
* @package Masonry Grid
*/
 
 if (!function_exists('masonry_grid_body_classes')) :

    function masonry_grid_body_classes($classes) {

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        $masonry_grid_color_schema = get_theme_mod( 'masonry_grid_color_schema',$masonry_grid_default['masonry_grid_color_schema'] );
        $ed_desktop_menu = get_theme_mod( 'ed_desktop_menu',$masonry_grid_default['ed_desktop_menu'] );
        global $post;
        
        // Adds a class of hfeed to non-singular pages.
        if ( !is_singular() ) {
            $classes[] = 'hfeed';
        }
        if( $ed_desktop_menu ){

            $classes[] = 'enabled-desktop-menu';

        }else{

            $classes[] = 'disabled-desktop-menu';

        }

        if( has_header_image() ){

            $classes[] = 'has-header-image';

        }

        $classes[] = 'color-scheme-'.esc_attr( $masonry_grid_color_schema );

        return $classes;
    }

endif;

add_filter('body_class', 'masonry_grid_body_classes');