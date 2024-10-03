<?php
/**
 * Header Layout 1
 *
 * @package Masonry Grid
 */
$masonry_grid_default = masonry_grid_get_default_theme_options();
$ed_desktop_menu = get_theme_mod( 'ed_desktop_menu',$masonry_grid_default['ed_desktop_menu'] );
?>


<div class="wrapper">
    <div class="wrapper-inner">

        <div class="header-component header-component-left">
            <div class="header-titles">

                <?php
                // Site title or logo.
                masonry_grid_site_logo();
                // Site description.
                masonry_grid_site_description();
                ?>

            </div><!-- .header-titles -->
        </div><!-- .header-component-left -->

        <div class="header-component header-component-right">
            <?php if( $ed_desktop_menu ){ ?>

                <div class="navbar-components">
                    <div class="site-navigation">
                        <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'masonry-grid'); ?>" role="navigation">

                            <ul class="primary-menu">

                                <?php
                                if( has_nav_menu('masonry-grid-primary-menu') ){

                                    wp_nav_menu(
                                        array(
                                            'container' => '',
                                            'items_wrap' => '%3$s',
                                            'theme_location' => 'masonry-grid-primary-menu',
                                        )
                                    );

                                }else{

                                    wp_list_pages(
                                        array(
                                            'match_menu_classes' => true,
                                            'show_sub_menu_icons' => true,
                                            'title_li' => false,
                                            'walker' => new Masonry_Grid_Walker_Page(),
                                        )
                                    );

                                } ?>

                            </ul>

                        </nav><!-- .primary-menu-wrapper -->
                    </div><!-- .site-navigation -->
                </div>

            <?php } ?>
            <div class="navbar-controls hide-no-js">

                <?php
                $ed_day_night_mode_switch = get_theme_mod( 'ed_day_night_mode_switch', $masonry_grid_default['ed_day_night_mode_switch'] );
                if( $ed_day_night_mode_switch ){ ?>

                    <button 
                        type="button" 
                        class="navbar-control theme-action-control navbar-day-night navbar-day-on" 
                        aria-label="Dark or light mode">
                        <span class="action-control-trigger day-night-toggle-icon" tabindex="-1">
                            <span class="moon-toggle-icon">
                                <i class="moon-icon">
                                    <?php masonry_grid_the_theme_svg('moon'); ?>
                                </i>
                            </span>

                            <span class="sun-toggle-icon">
                                <i class="sun-icon">
                                    <?php masonry_grid_the_theme_svg('sun'); ?>
                                </i>
                            </span>
                        </span>
                    </button>

                <?php }

                $ed_header_search = get_theme_mod('ed_header_search', $masonry_grid_default['ed_header_search']);
                if ($ed_header_search) { ?>

                <button 
                    type="button" 
                    class="navbar-control theme-action-control navbar-control-search" 
                    aria-label="Search">
                        <span class="action-control-trigger" tabindex="-1">
                        <?php masonry_grid_the_theme_svg('search'); ?>
                        </span>
                </button>

                <?php } ?>

                <button 
                    type="button" 
                    class="navbar-control theme-action-control navbar-control-offcanvas" 
                    aria-label="Menu">
                     <span class="action-control-trigger" tabindex="-1">
                        <?php masonry_grid_the_theme_svg('menu'); ?>
                     </span>
                </button>

            </div>

        </div><!-- .header-component-right -->

    </div>
</div>
