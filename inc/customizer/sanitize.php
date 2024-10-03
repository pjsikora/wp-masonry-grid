<?php
/**
* Custom Functions.
*
* @package Masonry Grid
*/

if( !function_exists( 'masonry_grid_sanitize_sidebar_option' ) ) :

    // Sidebar Option Sanitize.
    function masonry_grid_sanitize_sidebar_option( $masonry_grid_input ){

        $masonry_grid_metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $masonry_grid_input,$masonry_grid_metabox_options ) ){

            return $masonry_grid_input;

        }

        return;

    }

endif;

if( !function_exists( 'masonry_grid_sanitize_single_pagination_layout' ) ) :

    // Sidebar Option Sanitize.
    function masonry_grid_sanitize_single_pagination_layout( $masonry_grid_input ){

        $masonry_grid_single_pagination = array( 'no-navigation','norma-navigation','ajax-next-post-load' );
        if( in_array( $masonry_grid_input,$masonry_grid_single_pagination ) ){

            return $masonry_grid_input;

        }

        return;

    }

endif;

if( !function_exists( 'masonry_grid_sanitize_archive_layout' ) ) :

    // Sidebar Option Sanitize.
    function masonry_grid_sanitize_archive_layout( $masonry_grid_input ){

        $masonry_grid_archive_option = array( 'default','full','grid','masonry' );
        if( in_array( $masonry_grid_input,$masonry_grid_archive_option ) ){

            return $masonry_grid_input;

        }

        return;

    }

endif;

if( !function_exists( 'masonry_grid_sanitize_header_layout' ) ) :

    // Sidebar Option Sanitize.
    function masonry_grid_sanitize_header_layout( $masonry_grid_input ){

        $masonry_grid_header_options = array( 'layout-1','layout-2','layout-3' );
        if( in_array( $masonry_grid_input,$masonry_grid_header_options ) ){

            return $masonry_grid_input;

        }

        return;

    }

endif;

if( !function_exists( 'masonry_grid_sanitize_single_post_layout' ) ) :

    // Single Layout Option Sanitize.
    function masonry_grid_sanitize_single_post_layout( $masonry_grid_input ){

        $masonry_grid_single_layout = array( 'layout-1','layout-2' );
        if( in_array( $masonry_grid_input,$masonry_grid_single_layout ) ){

            return $masonry_grid_input;

        }

        return;

    }

endif;

if ( ! function_exists( 'masonry_grid_sanitize_checkbox' ) ) :

	/**
	 * Sanitize checkbox.
	 */
	function masonry_grid_sanitize_checkbox( $masonry_grid_checked ) {

		return ( ( isset( $masonry_grid_checked ) && true === $masonry_grid_checked ) ? true : false );

	}

endif;


if ( ! function_exists( 'masonry_grid_sanitize_select' ) ) :

    /**
     * Sanitize select.
     */
    function masonry_grid_sanitize_select( $masonry_grid_input, $masonry_grid_setting ) {

        // Ensure input is a slug.
        $masonry_grid_input = sanitize_text_field( $masonry_grid_input );

        // Get list of choices from the control associated with the setting.
        $choices = $masonry_grid_setting->manager->get_control( $masonry_grid_setting->id )->choices;

        // If the input is a valid key, return it; otherwise, return the default.
        return ( array_key_exists( $masonry_grid_input, $choices ) ? $masonry_grid_input : $masonry_grid_setting->default );

    }

endif;

if ( ! function_exists( 'masonry_grid_sanitize_repeater' ) ) :
    
    /**
    * Sanitise Repeater Field
    */
    function masonry_grid_sanitize_repeater($input){
        $input_decoded = json_decode( $input, true );
        
        if(!empty($input_decoded)) {

            foreach ($input_decoded as $boxes => $box ){

                foreach ($box as $key => $value){

                    if( $key == 'category_color' ){

                        $input_decoded[$boxes][$key] = sanitize_hex_color( $value );

                    }else{

                        $input_decoded[$boxes][$key] = sanitize_text_field( $value );

                    }
                    
                }

            }
           
            return json_encode($input_decoded);

        }

        return $input;
    }
endif;