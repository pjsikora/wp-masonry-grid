<?php
/**
 * The default template for displaying content
 *
 * Used for both singular and index.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
* @package Masonry Grid
 * @since 1.0.0
 */

$masonry_grid_default = masonry_grid_get_default_theme_options();
$video_autoplay = esc_attr( get_post_meta(get_the_ID(), 'twp_video_autoplay', true) );
if( $video_autoplay == '' || $video_autoplay == 'global' ){

    $video_autoplay = isset($masonry_grid_home_section->section_video_autoplay) ? $masonry_grid_home_section->section_video_autoplay : '';
    if( $video_autoplay == '' || $video_autoplay == 'global' ){
        $video_autoplay = get_theme_mod( 'ed_autoplay', $masonry_grid_default['ed_autoplay'] );
    }

}

$ratio_value = get_post_meta( get_the_ID(), 'twp_aspect_ratio', true );
if( $ratio_value == '' || $ratio_value == 'global' ){
    
    $ratio_value = isset( $masonry_grid_home_section->section_video_ratio ) ? $masonry_grid_home_section->section_video_ratio : '';

    if( $ratio_value == '' || $ratio_value == 'global' ){
        $ratio_value = get_theme_mod( 'post_video_aspect_ration', $masonry_grid_default['post_video_aspect_ration'] );
    }

}

masonry_grid_video_content_render( $class1 = 'post', $class2 = 'video-id', $class3 = 'video-main-wraper', $ratio_value, $video_autoplay );