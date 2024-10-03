<?php
/**
 * Masonry Grid About Page
 * @package Masonry Grid
 *
 */
if (!class_exists('Masonry_Grid_About_page')):
    class Masonry_Grid_About_page
    {
        function __construct()
        {
            add_action('admin_menu', array($this, 'masonry_grid_backend_menu'), 999);
        }
        // Add Backend Menu
        function masonry_grid_backend_menu()
        {
            add_theme_page(esc_html__('Masonry Grid', 'masonry-grid'), esc_html__('Masonry Grid', 'masonry-grid'), 'activate_plugins', 'masonry-grid-about', array($this, 'masonry_grid_main_page'), 1);
        }
        // Settings Form
        function masonry_grid_main_page()
        {
            require get_template_directory() . '/classes/about-render.php';
        }
    }
    new Masonry_Grid_About_page();
endif;