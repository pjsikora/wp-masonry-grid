<?php
/**
 * Header file for the Masonry Grid WordPress theme.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Masonry Grid
 * @since 1.0.0
 */
?><!DOCTYPE html>
<html class="no-js" <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<?php
if( function_exists('wp_body_open') ){
    wp_body_open();
} ?>

<?php $masonry_grid_default = masonry_grid_get_default_theme_options();
$ed_preloader = get_theme_mod( 'ed_preloader', $masonry_grid_default['ed_preloader'] );
if ($ed_preloader) { ?>
    <div class="preloader hide-no-js <?php if( isset( $_COOKIE['MasonryGridNightDayMode'] ) && $_COOKIE['MasonryGridNightDayMode'] == 'true' ){ echo 'preloader-night-mode'; } ?>">
        <div class="loader">
            <span></span><span></span><span></span><span></span>
        </div>
    </div>
<?php } ?>

<?php $ed_cursor_option = get_theme_mod( 'ed_cursor_option', $masonry_grid_default['ed_cursor_option'] );
if ($ed_cursor_option) { ?>
    <div class="theme-custom-cursor theme-cursor-primary"></div>
    <div class="theme-custom-cursor theme-cursor-secondary"></div>
<?php } ?>


<div id="page" class="site">
    <a class="skip-link screen-reader-text" href="#content"><?php esc_html_e('Skip to the content', 'masonry-grid'); ?></a>

    <header id="site-header" class="theme-site-header" role="banner">
        <?php get_template_part('template-parts/header/header', 'content'); ?>
    </header>

    <?php get_template_part('template-parts/header/header', 'image'); ?>

    <div id="content" class="site-content">

    <?php if( is_home() || is_front_page() ){ masonry_grid_carousel_section(); } ?>