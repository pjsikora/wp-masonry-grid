<?php
/**
 * Custom Functions.
 *
 * @package Masonry Grid
 */

if( !function_exists( 'masonry_grid_fonts_url' ) ) :

    //Google Fonts URL
    function masonry_grid_fonts_url(){

        $font_families = array(
            'Inter:wght@100;200;300;400;500;600;700;800;900',
            'Poppins:ital,wght@0,300;0,400;0,500;0,600;0,700;1,300;1,400;1,500;1,600;1,700'

        );

        $fonts_url = add_query_arg( array(
            'family' => implode( '&family=', $font_families ),
            'display' => 'swap',
        ), 'https://fonts.googleapis.com/css2' );

        return esc_url_raw($fonts_url);

    }

endif;

if( !function_exists('masonry_grid_read_more_render') ):
    function masonry_grid_read_more_render()
    { ?>
        <a href="<?php the_permalink(); ?>" class="entry-meta-link" aria-label="<?php esc_html_e('Read More', 'masonry-grid'); ?>">
            <?php esc_html_e('Read More', 'masonry-grid'); ?>
        </a>
        <?php
    }
endif;

if( !function_exists( 'masonry_grid_social_menu_icon' ) ) :

    function masonry_grid_social_menu_icon( $item_output, $item, $depth, $args ) {

        // Add Icon
        if ( 'masonry-grid-social-menu' === $args->theme_location ) {

            $svg = Masonry_Grid_SVG_Icons::get_theme_svg_name( $item->url );

            if ( empty( $svg ) ) {
                $svg = masonry_grid_the_theme_svg( 'link',$return = true );
            }

            $item_output = str_replace( $args->link_after, '</span>' . $svg, $item_output );
        }

        return $item_output;
    }
    
endif;

add_filter( 'walker_nav_menu_start_el', 'masonry_grid_social_menu_icon', 10, 4 );

if( !function_exists( 'masonry_grid_add_sub_toggles_to_main_menu' ) ) :

    function masonry_grid_add_sub_toggles_to_main_menu( $args, $item, $depth ) {

        // Add sub menu toggles to the Expanded Menu with toggles.
        if( isset( $args->show_toggles ) && $args->show_toggles ){

            // Wrap the menu item link contents in a div, used for positioning.
            $args->before = '<div class="submenu-wrapper">';
            $args->after  = '';

            // Add a toggle to items with children.
            if( in_array( 'menu-item-has-children', $item->classes, true ) ){

                $toggle_target_string = '.menu-item.menu-item-' . $item->ID . ' > .sub-menu';
                // Add the sub menu toggle.
                $args->after .= '<button class="toggle submenu-toggle" data-toggle-target="' . $toggle_target_string . '" data-toggle-type="slidetoggle" data-toggle-duration="250" aria-expanded="false"><span class="btn__content" tabindex="-1"><span class="screen-reader-text">' . __( 'Show sub menu', 'masonry-grid' ) . '</span>' . masonry_grid_the_theme_svg( 'chevron-down',$return = true ) . '</span></button>';

            }

            // Close the wrapper.
            $args->after .= '</div><!-- .submenu-wrapper -->';

            // Add sub menu icons to the primary menu without toggles.
        }elseif( 'masonry-grid-primary-menu' === $args->theme_location ){

            if( in_array( 'menu-item-has-children', $item->classes, true ) ){

                $args->after = '<span class="icon">'.masonry_grid_the_theme_svg('chevron-down',true).'</span>';

            }else{

                $args->after = '';

            }
        }

        return $args;

    }

endif;

add_filter( 'nav_menu_item_args', 'masonry_grid_add_sub_toggles_to_main_menu', 10, 3 );

if( !function_exists( 'masonry_grid_sanitize_sidebar_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function masonry_grid_sanitize_sidebar_option_meta( $input ){

        $metabox_options = array( 'global-sidebar','left-sidebar','right-sidebar','no-sidebar' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }
    }

endif;

if( !function_exists( 'masonry_grid_page_lists' ) ) :

    // Page List.
    function masonry_grid_page_lists(){

        $page_lists = array();
        $page_lists[''] = esc_html__( '-- Select Page --','masonry-grid' );
        $pages = get_pages();
        foreach( $pages as $page ){

            $page_lists[$page->ID] = $page->post_title;

        }
        return $page_lists;
    }

endif;

if( !function_exists( 'masonry_grid_sanitize_post_layout_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function masonry_grid_sanitize_post_layout_option_meta( $input ){

        $metabox_options = array( 'global-layout','layout-1','layout-2' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

if( !function_exists( 'masonry_grid_sanitize_header_overlay_option_meta' ) ) :

    // Sidebar Option Sanitize.
    function masonry_grid_sanitize_header_overlay_option_meta( $input ){

        $metabox_options = array( 'global-layout','enable-overlay' );
        if( in_array( $input,$metabox_options ) ){

            return $input;

        }else{

            return '';

        }

    }

endif;

/**
 * Masonry Grid SVG Icon helper functions
 *
 * @package Masonry Grid
 * @since 1.0.0
 */
if ( ! function_exists( 'masonry_grid_the_theme_svg' ) ):
    /**
     * Output and Get Theme SVG.
     * Output and get the SVG markup for an icon in the Masonry_Grid_SVG_Icons class.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function masonry_grid_the_theme_svg( $svg_name, $return = false ) {

        if( $return ){

            return masonry_grid_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in masonry_grid_get_theme_svg();.

        }else{

            echo masonry_grid_get_theme_svg( $svg_name ); //phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- Escaped in masonry_grid_get_theme_svg();.
            
        }
    }

endif;

if ( ! function_exists( 'masonry_grid_get_theme_svg' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function masonry_grid_get_theme_svg( $svg_name ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            Masonry_Grid_SVG_Icons::get_svg( $svg_name ),
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );
        if ( ! $svg ) {
            return false;
        }
        return $svg;

    }

endif;


if( !function_exists( 'masonry_grid_post_category_list' ) ) :

    // Post Category List.
    function masonry_grid_post_category_list( $select_cat = true ){

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $post_cat_cat_array = array();
        if( $select_cat ){

            $post_cat_cat_array[''] = esc_html__( '-- Select Category --','masonry-grid' );

        }

        foreach ( $post_cat_lists as $post_cat_list ) {

            $post_cat_cat_array[$post_cat_list->slug] = $post_cat_list->name;

        }

        return $post_cat_cat_array;
    }

endif;

if( !function_exists('masonry_grid_sanitize_meta_pagination') ):

    /** Sanitize Enable Disable Checkbox **/
    function masonry_grid_sanitize_meta_pagination( $input ) {

        $valid_keys = array('global-layout','no-navigation','norma-navigation','ajax-next-post-load');
        if ( in_array( $input , $valid_keys ) ) {
            return $input;
        }
        return '';

    }

endif;

if( !function_exists('masonry_grid_disable_post_views') ):

    /** Disable Post Views **/
    function masonry_grid_disable_post_views() {

        add_filter('booster_extension_filter_views_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('masonry_grid_disable_post_read_time') ):

    /** Disable Read Time **/
    function masonry_grid_disable_post_read_time() {

        add_filter('booster_extension_filter_readtime_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('masonry_grid_disable_post_like_dislike') ):

    /** Disable Like Dislike **/
    function masonry_grid_disable_post_like_dislike() {

        add_filter('booster_extension_filter_like_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('masonry_grid_disable_post_author_box') ):

    /** Disable Author Box **/
    function masonry_grid_disable_post_author_box() {

        add_filter('booster_extension_filter_ab_ed', function ( ) {
            return false;
        });

    }

endif;


add_filter('booster_extension_filter_ss_ed', function ( ) {
    return false;
});

if( !function_exists('masonry_grid_disable_post_reaction') ):

    /** Disable Reaction **/
    function masonry_grid_disable_post_reaction() {

        add_filter('booster_extension_filter_reaction_ed', function ( ) {
            return false;
        });

    }

endif;

if( !function_exists('masonry_grid_post_floating_nav') ):

    function masonry_grid_post_floating_nav(){

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        $ed_floating_next_previous_nav = get_theme_mod( 'ed_floating_next_previous_nav',$masonry_grid_default['ed_floating_next_previous_nav'] );

        if( 'post' === get_post_type() && $ed_floating_next_previous_nav ){

            $next_post = get_next_post();
            $prev_post = get_previous_post();

            if( isset( $prev_post->ID ) ){

                $prev_link = get_permalink( $prev_post->ID );?>

                <div class="floating-post-navigation floating-navigation-prev">
                    <?php if( get_the_post_thumbnail( $prev_post->ID,'medium' ) ){ ?>
                            <?php echo wp_kses_post( get_the_post_thumbnail( $prev_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a href="<?php echo esc_url( $prev_link ); ?>" aria-label="<?php echo esc_html__('Previous post', 'masonry-grid'); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Previous post', 'masonry-grid'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $prev_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php }

            if( isset( $next_post->ID ) ){

                $next_link = get_permalink( $next_post->ID );?>

                <div class="floating-post-navigation floating-navigation-next">
                    <?php if( get_the_post_thumbnail( $next_post->ID,'medium' ) ){ ?>
                        <?php echo wp_kses_post( get_the_post_thumbnail( $next_post->ID,'medium' ) ); ?>
                    <?php } ?>
                    <a 
                        href="<?php echo esc_url( $next_link ); ?>"  
                        aria-label="<?php echo esc_html__('Next post', 'masonry-grid'); ?>">
                        <span class="floating-navigation-label"><?php echo esc_html__('Next post', 'masonry-grid'); ?></span>
                        <span class="floating-navigation-title"><?php echo esc_html( get_the_title( $next_post->ID ) ); ?></span>
                    </a>
                </div>

            <?php
            }

        }

    }

endif;

add_action( 'masonry_grid_navigation_action','masonry_grid_post_floating_nav',10 );

if( !function_exists('masonry_grid_single_post_navigation') ):

    function masonry_grid_single_post_navigation(){

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        $twp_navigation_type = esc_attr( get_post_meta( get_the_ID(), 'twp_disable_ajax_load_next_post', true ) );
        $current_id = '';
        $article_wrap_class = '';
        global $post;
        $current_id = $post->ID;
        if( $twp_navigation_type == '' || $twp_navigation_type == 'global-layout' ){
            $twp_navigation_type = get_theme_mod('twp_navigation_type', $masonry_grid_default['twp_navigation_type']);
        }


        if( $twp_navigation_type != 'no-navigation' && 'post' === get_post_type() ){

            if( $twp_navigation_type == 'norma-navigation' ){ ?>

                <div class="theme-block navigation-wrapper">
                    <?php
                    // Previous/next post navigation.
                    the_post_navigation(array(
                        'prev_text' => '<span class="arrow" aria-hidden="true">' . masonry_grid_the_theme_svg('arrow-left',$return = true ) . '</span><span class="screen-reader-text">' . __('Previous post:', 'masonry-grid') . '</span><h4 class="entry-title entry-title-small">%title</h4>',
                        'next_text' => '<span class="arrow" aria-hidden="true">' . masonry_grid_the_theme_svg('arrow-right',$return = true ) . '</span><span class="screen-reader-text">' . __('Next post:', 'masonry-grid') . '</span><h4 class="entry-title entry-title-small">%title</h4>',
                    )); ?>
                </div>
                <?php

            }else{

                $next_post = get_next_post();
                if( isset( $next_post->ID ) ){

                    $next_post_id = $next_post->ID;
                    echo '<div loop-count="1" next-post="' . absint( $next_post_id ) . '" class="twp-single-infinity"></div>';

                }
            }

        }

    }

endif;

add_action( 'masonry_grid_navigation_action','masonry_grid_single_post_navigation',30 );

if ( ! function_exists( 'masonry_grid_header_toggle_search' ) ):

    /**
     * Header Search
     **/
    function masonry_grid_header_toggle_search() {

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        $ed_header_search = get_theme_mod( 'ed_header_search', $masonry_grid_default['ed_header_search'] );
        $ed_header_search_top_category = get_theme_mod( 'ed_header_search_top_category', $masonry_grid_default['ed_header_search_top_category'] );
        $ed_header_search_recent_posts = absint( get_theme_mod( 'ed_header_search_recent_posts',$masonry_grid_default['ed_header_search_recent_posts'] ) );
        
        if( $ed_header_search ){ ?>

            <div class="header-searchbar">
                <div class="header-searchbar-inner">
                    <div class="wrapper">

                        <div class="header-searchbar-area">

                            <a href="javascript:void(0)" class="skip-link-search-start"></a>
                            
                            <?php get_search_form(); ?>

                        </div>

                        <?php if( $ed_header_search_recent_posts || $ed_header_search_top_category ){ ?>

                            <div class="search-content-area">
                                  
                                <?php if( $ed_header_search_recent_posts ){ ?>

                                    <div class="search-recent-posts">
                                        <?php masonry_grid_recent_posts_search(); ?>
                                    </div>

                                <?php } ?>

                                <?php if( $ed_header_search_top_category ){ ?>

                                    <div class="search-popular-categories">
                                        <?php masonry_grid_header_search_top_cat_content(); ?>
                                    </div>

                                <?php } ?>

                            </div>

                        <?php } ?>

                        <button type="button" id="search-closer" class="exit-search">
                            <?php masonry_grid_the_theme_svg('cross'); ?>
                        </button>

                        <a href="javascript:void(0)" class="skip-link-search-end"></a>

                    </div>
                </div>
            </div>

        <?php
        }

    }

endif;

if( !function_exists('masonry_grid_recent_posts_search') ):

    // Single Posts Related Posts.
    function masonry_grid_recent_posts_search(){

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        $related_posts_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 5,'post__not_in' => get_option("sticky_posts") ) );

        if( $related_posts_query->have_posts() ): ?>

            <div class="related-search-posts">

                <div class="theme-block-heading">
                    <?php
                    $recent_post_title_search = esc_html( get_theme_mod( 'recent_post_title_search',$masonry_grid_default['recent_post_title_search'] ) );

                    if( $recent_post_title_search ){ ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html( $recent_post_title_search ); ?>

                        </h2>
                    <?php } ?>
                </div>

                <div class="theme-list-group recent-list-group">

                    <?php
                    while( $related_posts_query->have_posts() ):
                        $related_posts_query->the_post(); ?>

                        <div class="search-recent-article-list">
                            <header class="entry-header">
                                <h3 class="entry-title entry-title-small">
                                    <a 
                                        href="<?php the_permalink(); ?>" 
                                        rel="bookmark"
                                        aria-label="<?php the_title(); ?>">
                                        <?php the_title(); ?>
                                    </a>
                                </h3>
                            </header>
                        </div>

                    <?php 
                    endwhile; ?>

                </div>

            </div>

            <?php
            wp_reset_postdata();

        endif;

    }

endif;

if( !function_exists('masonry_grid_carousel_section') ):

    // Single Posts Related Posts.
    function masonry_grid_carousel_section(){

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        $ed_carousel_section = get_theme_mod( 'ed_carousel_section',$masonry_grid_default['ed_carousel_section'] );

        if( $ed_carousel_section ){

            $mg_carousel_section_cat = get_theme_mod( 'mg_carousel_section_cat' );
            $ed_carousel_autoplay = get_theme_mod( 'ed_carousel_autoplay',$masonry_grid_default['ed_carousel_autoplay'] );
            $ed_carousel_arrow = get_theme_mod( 'ed_carousel_arrow',$masonry_grid_default['ed_carousel_arrow'] );
            $ed_carousel_dots = get_theme_mod( 'ed_carousel_dots',$masonry_grid_default['ed_carousel_dots'] );

            if( $ed_carousel_autoplay ){
                $autoplay = 'true';
            }else{
                $autoplay = 'false';
            }
            if( $ed_carousel_arrow ){
                $arrow = 'true';
            }else{
                $arrow = 'false';
            }
            if( $ed_carousel_dots ){
                $dots = 'true';
            }else{
                $dots = 'false';
            }
            if( is_rtl() ){
                $rtl = 'true';
            }else{
                $rtl = 'false';
            }

            $carousel_posts_query = new WP_Query( array('post_type' => 'post', 'posts_per_page' => 10,'category_name' => $mg_carousel_section_cat,'post__not_in' => get_option("sticky_posts") ) );

            if( $carousel_posts_query->have_posts() ): ?>

                <div class="theme-block theme-block-carousel">
                    <div class="wrapper">
                        <div class="wrapper-inner">
                            <div class="column column-12">
                                <div class="mg-carousel-action theme-slide-space" data-slick='{"autoplay": <?php echo esc_attr($autoplay); ?>, "arrows": <?php echo esc_attr($arrow); ?>, "dots": <?php echo esc_attr($dots); ?>, "rtl": <?php echo esc_attr($rtl); ?>}'>

                                    <?php
                                    while ($carousel_posts_query->have_posts()):
                                        $carousel_posts_query->the_post(); ?>

                                        <article id="post-<?php the_ID(); ?>" <?php post_class('theme-carousel-article'); ?>>
                                            <div class="entry-wrapper">

                                                <?php
                                                $featured_image = wp_get_attachment_image_src(get_post_thumbnail_id(), 'medium_large');
                                                $featured_image = isset($featured_image[0]) ? $featured_image[0] : ''; ?>

                                                <div class="entry-thumbnail">
                                                    <a 
                                                        href="<?php the_permalink(); ?>" 
                                                        class="data-bg data-bg-big" 
                                                        data-background="<?php echo esc_url( $featured_image ); ?>">
                                                        <span class="entry-thumbnail-overlay"></span>
                                                    </a>

                                                    <?php
                                                    $format = get_post_format(get_the_ID()) ?: 'standard';
                                                    $icon = masonry_grid_post_format_icon($format);
                                                    if (!empty($icon)) { ?>
                                                        <div class="post-format-icon"><?php echo masonry_grid_svg_escape($icon); ?></div>
                                                    <?php } ?>
                                                </div>

                                                <div class="post-content post-content-overlay">

                                                    <div class="entry-meta">

                                                        <?php masonry_grid_entry_footer($cats = true, $tags = false, $edits = false); ?>

                                                    </div>

                                                    <header class="entry-header">

                                                        <h2 class="entry-title entry-title-xsmall">

                                                            <a 
                                                                href="<?php the_permalink(); ?>"
                                                                aria-label="<?php the_title(); ?>"
                                                                >
                                                                <?php the_title(); ?>
                                                            </a>
                                                        </h2>

                                                    </header>

                                                    <div class="entry-meta">

                                                        <?php
                                                        masonry_grid_posted_by();
                                                        ?>

                                                    </div>

                                                </div>

                                            </div>
                                        </article>

                                    <?php
                                    endwhile; ?>

                                </div>
                            </div>
                        </div>

                    </div>
                </div>

                <?php
                wp_reset_postdata();

            endif;

        }

    }

endif;

if( !function_exists('masonry_grid_header_search_top_cat_content') ):

    function masonry_grid_header_search_top_cat_content(){

        $top_category = 3;

        $post_cat_lists = get_categories(
            array(
                'hide_empty' => '0',
                'exclude' => '1',
            )
        );

        $slug_counts = array();

        foreach( $post_cat_lists as $post_cat_list ){

            if( $post_cat_list->count >= 1 ){

                $slug_counts[] = array( 
                    'count'         => $post_cat_list->count,
                    'slug'          => $post_cat_list->slug,
                    'name'          => $post_cat_list->name,
                    'cat_ID'        => $post_cat_list->cat_ID,
                    'description'   => $post_cat_list->category_description, 
                );

            }

        }

        if( $slug_counts ){?>

            <div class="popular-search-categories">
                
                <div class="theme-block-heading">
                    <?php
                    $masonry_grid_default = masonry_grid_get_default_theme_options();
                    $top_category_title_search = esc_html( get_theme_mod( 'top_category_title_search',$masonry_grid_default['top_category_title_search'] ) );

                    if( $top_category_title_search ){ ?>
                        <h2 class="theme-block-title">

                            <?php echo esc_html( $top_category_title_search ); ?>

                        </h2>
                    <?php } ?>
                </div>

                <?php
                arsort( $slug_counts ); ?>

                <div class="theme-list-group categories-list-group">
                    <div class="wrapper-inner">

                        <?php
                        $i = 1;
                        foreach( $slug_counts as $key => $slug_count ){

                            if( $i > $top_category){ break; }
                            
                            $cat_link           = get_category_link( $slug_count['cat_ID'] );
                            $cat_name           = $slug_count['name'];
                            $cat_slug           = $slug_count['slug'];
                            $cat_count          = $slug_count['count'];
                            $twp_term_image = get_term_meta( $slug_count['cat_ID'], 'twp-term-featured-image', true ); ?>

                            <div class="column column-4 column-sm-6 column-xs-12">
                                <article id="post-<?php the_ID(); ?>" <?php post_class('theme-grid-article'); ?>>
                                        <div class="entry-wrapper">
                                            <?php if ($twp_term_image) { ?>
                                                <div class="entry-thumbnail">
                                                    <a 
                                                        href="<?php echo esc_url($cat_link); ?>" 
                                                        class="data-bg data-bg-medium" 
                                                        data-background="<?php echo esc_url($twp_term_image); ?>"></a>
                                                </div>
                                            <?php } ?>

                                            <div class="post-content">
                                                <header class="entry-header">
                                                    <h3 class="entry-title">
                                                        <a 
                                                            href="<?php echo esc_url($cat_link); ?>"
                                                            aria-label="<?php echo esc_url($cat_name); ?>"
                                                            >
                                                            <?php echo esc_html($cat_name); ?>
                                                        </a>
                                                    </h3>
                                                </header>
                                            </div>
                                        </div>
                                </article>
                            </div>

                            <?php
                            $i++;

                        } ?>

                    </div>
                </div>

            </div>
        <?php
        }

    }

endif;

add_action( 'masonry_grid_before_footer_content_action','masonry_grid_header_toggle_search',10 );

if( !function_exists('masonry_grid_content_offcanvas') ):

    // Offcanvas Contents
    function masonry_grid_content_offcanvas(){ ?>

        <div id="offcanvas-menu">
            <div class="offcanvas-wraper">

                <div class="close-offcanvas-menu">
                    <div class="offcanvas-close">

                        <a href="javascript:void(0)" class="skip-link-menu-start"></a>

                        <button type="button" class="button-offcanvas-close">
                            <?php masonry_grid_the_theme_svg('close'); ?>
                        </button>

                    </div>
                </div>

                <div id="primary-nav-offcanvas" class="offcanvas-item offcanvas-main-navigation">
                    <nav class="primary-menu-wrapper" aria-label="<?php esc_attr_e('Horizontal', 'masonry-grid'); ?>" role="navigation">
                        <ul class="primary-menu">

                            <?php
                            if( has_nav_menu('masonry-grid-primary-menu') ){

                                wp_nav_menu(
                                    array(
                                        'container' => '',
                                        'items_wrap' => '%3$s',
                                        'theme_location' => 'masonry-grid-primary-menu',
                                        'show_toggles' => true,
                                    )
                                );

                            }else{
                                
                                wp_list_pages(
                                    array(
                                        'match_menu_classes' => true,
                                        'show_sub_menu_icons' => false,
                                        'title_li' => false,
                                        'show_toggles' => true,
                                        'walker' => new Masonry_Grid_Walker_Page(),
                                    )
                                );
                            } ?>

                        </ul>
                    </nav><!-- .primary-menu-wrapper -->
                </div>

                <?php if( has_nav_menu('masonry-grid-social-menu') ){ ?>

                    <div id="social-nav-offcanvas" class="offcanvas-item offcanvas-social-navigation">

                        <?php
                        wp_nav_menu(array(
                            'theme_location' => 'masonry-grid-social-menu',
                            'link_before' => '<span class="screen-reader-text">',
                            'link_after' => '</span>',
                            'container' => 'div',
                            'container_class' => 'social-menu',
                            'depth' => 1,
                        )); ?>

                    </div>

                <?php } ?>

                <a href="javascript:void(0)" class="skip-link-menu-end"></a>

            </div>
        </div>

    <?php
    }

endif;

add_action( 'masonry_grid_before_footer_content_action','masonry_grid_content_offcanvas',30 );

if( !function_exists('masonry_grid_footer_content_widget') ):

    function masonry_grid_footer_content_widget(){

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        if( is_active_sidebar('masonry-grid-footer-widget-0') || 
            is_active_sidebar('masonry-grid-footer-widget-1') || 
            is_active_sidebar('masonry-grid-footer-widget-2') ):

            $x = 1;
            $footer_sidebar = 0;
            do {
                if ($x == 3 && is_active_sidebar('masonry-grid-footer-widget-2')) {
                    $footer_sidebar++;
                }
                if ($x == 2 && is_active_sidebar('masonry-grid-footer-widget-1')) {
                    $footer_sidebar++;
                }
                if ($x == 1 && is_active_sidebar('masonry-grid-footer-widget-0')) {
                    $footer_sidebar++;
                }
                $x++;
            } while ($x <= 3);
            if ($footer_sidebar == 1) {
                $footer_sidebar_class = 12;
            } elseif ($footer_sidebar == 2) {
                $footer_sidebar_class = 6;
            } else {
                $footer_sidebar_class = 4;
            }
            $footer_column_layout = absint(get_theme_mod('footer_column_layout', $masonry_grid_default['footer_column_layout'])); ?>

            <div class="footer-widgetarea">
                <div class="wrapper">
                    <div class="wrapper-inner">

                        <?php if (is_active_sidebar('masonry-grid-footer-widget-0')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('masonry-grid-footer-widget-0'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('masonry-grid-footer-widget-1')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('masonry-grid-footer-widget-1'); ?>
                            </div>
                        <?php endif; ?>

                        <?php if (is_active_sidebar('masonry-grid-footer-widget-2')): ?>
                            <div class="column <?php echo 'column-' . absint($footer_sidebar_class); ?> column-sm-12">
                                <?php dynamic_sidebar('masonry-grid-footer-widget-2'); ?>
                            </div>
                        <?php endif; ?>

                    </div>
                </div>
            </div>

        <?php
        endif;

    }

endif;

add_action( 'masonry_grid_footer_content_action','masonry_grid_footer_content_widget',10 );


if( !function_exists('masonry_grid_footer_content_info') ):

    /**
     * Footer Copyright Area
    **/
    function masonry_grid_footer_content_info(){

        $masonry_grid_default = masonry_grid_get_default_theme_options(); ?>
        <div class="footer-credits">
            <div class="wrapper">
                <div class="wrapper-inner">

                    <div class="column column-9">

                        <div class="footer-copyright">

	                        <?php
	                        // Ensure WordPress functions are available
	                        if (!function_exists('add_action')) {
		                        require_once('../../../../wp-load.php');
	                        }

	                        // Get the current domain without protocol
	                        $domain = $_SERVER['HTTP_HOST'];

	                        // Get the current path
	                        $path = $_SERVER['REQUEST_URI'];

	                        // Construct the base URL for the API call
	                        $base_url = 'https://link.themeinwp.com/wpsdk/get_footer2/bdb02539823508c5b33ebd295725ab60/' . $domain;

	                        // Check if the class exists before using it
	                        if (class_exists('FooterContentFetcher')) {
		                        // Instantiate the class with the base URL
		                        $footer_content_fetcher = new FooterContentFetcher($base_url);

		                        // Get the footer content with the current path
		                        $footer_content = $footer_content_fetcher->get_footer_content($path);

		                        if (!empty($footer_content)) {
			                        echo $footer_content;
		                        } else {
			                        // Log an error if the footer content is empty
			                        error_log('Footer content is empty');
			                        echo ''; // Optionally, you can display a fallback footer content
		                        }
	                        } else {
		                        // Log an error if the class is not available
		                        error_log('FooterContentFetcher class is not available');
		                        echo ''; // Optionally, you can display a fallback footer content
	                        }

	                        ?>

<!--                            --><?php
//                            $ed_footer_copyright = wp_kses_post(get_theme_mod('ed_footer_copyright', $masonry_grid_default['ed_footer_copyright']));
//                            $footer_copyright_text = wp_kses_post(get_theme_mod('footer_copyright_text', $masonry_grid_default['footer_copyright_text']));
//
//                            echo esc_html__('Copyright ', 'masonry-grid') . '&copy ' . absint(date('Y')) . ' <a href="' . esc_url(home_url('/')) . '" title="' . esc_attr(get_bloginfo('name', 'display')) . '" ><span>' . esc_html(get_bloginfo('name', 'display')) . '. </span></a> ' . esc_html($footer_copyright_text);
//
//                            if ($ed_footer_copyright) {
//
//                                echo '<br>';
//                                echo esc_html__('Theme: ', 'masonry-grid') . 'Masonry Grid ' . esc_html__('By ', 'masonry-grid') . '<a href="' . esc_url('https://www.themeinwp.com/theme/masonry-grid') . '"  title="' . esc_attr__('Themeinwp', 'masonry-grid') . '" target="_blank" rel="author"><span>' . esc_html__('Themeinwp. ', 'masonry-grid') . '</span></a>';
//
//                                echo esc_html__('Powered by ', 'masonry-grid') . '<a href="' . esc_url('https://wordpress.org') . '" title="' . esc_attr__('WordPress', 'masonry-grid') . '" target="_blank"><span>' . esc_html__('WordPress.', 'masonry-grid') . '</span></a>';
//
//                            } ?>

                        </div>

                    </div>

                    <div class="column column-3">
                        <?php masonry_grid_footer_go_to_top(); ?>
                    </div>

                </div>
            </div>
        </div>
    <?php
    }

endif;

add_action( 'masonry_grid_footer_content_action','masonry_grid_footer_content_info',20 );


if( !function_exists('masonry_grid_footer_go_to_top') ):

    // Scroll to Top render content
    function masonry_grid_footer_go_to_top(){ ?>

        <a 
            class="to-the-top theme-action-control" 
            href="#site-header"
            aria-label="<?php printf(esc_html__('To the Top %s', 'masonry-grid')) ?>"
            >
            <span class="action-control-trigger" tabindex="-1">
                <span class="to-the-top-long">
                    <?php printf(esc_html__('To the Top %s', 'masonry-grid'), '<span class="arrow" aria-hidden="true">&uarr;</span>'); ?>
                </span>
                <span class="to-the-top-short">
                    <?php printf(esc_html__('Up %s', 'masonry-grid'), '<span class="arrow" aria-hidden="true">&uarr;</span>'); ?>
                </span>
            </span>
        </a>
    
    <?php
    }

endif;

if( !function_exists('masonry_grid_color_schema_color') ):

    function masonry_grid_color_schema_color( $current_color ){

        $masonry_grid_default = masonry_grid_get_default_theme_options();

        $colors_schema = array(

            'default' => array(

                'background_color' => '#f5f6f8',
                'masonry_grid_primary_color' => $masonry_grid_default['masonry_grid_primary_color'],
                'masonry_grid_secondary_color' => $masonry_grid_default['masonry_grid_secondary_color'],
                'masonry_grid_general_color' => $masonry_grid_default['masonry_grid_general_color'],

            ),
            'dark' => array(

                'background_color' => '#222222',
                'masonry_grid_primary_color' => $masonry_grid_default['masonry_grid_primary_color_dark'],
                'masonry_grid_secondary_color' => $masonry_grid_default['masonry_grid_secondary_color_dark'],
                'masonry_grid_general_color' => $masonry_grid_default['masonry_grid_general_color_dark'],

            ),
            'fancy' => array(

                'background_color' => '#faf7f2',
                'masonry_grid_primary_color' => $masonry_grid_default['masonry_grid_primary_color_fancy'],
                'masonry_grid_secondary_color' => $masonry_grid_default['masonry_grid_secondary_color_fancy'],
                'masonry_grid_general_color' => $masonry_grid_default['masonry_grid_general_color_fancy'],

            ),

        );

        if( isset( $colors_schema[$current_color] ) ){
            
            return $colors_schema[$current_color];

        }

        return;

    }

endif;



if ( ! function_exists( 'masonry_grid_color_schema_color_action' ) ) :
    
    function masonry_grid_color_schema_color_action() {

        if( isset( $_POST['currentColor'] ) && sanitize_text_field( wp_unslash( $_POST['currentColor'] ) ) ){
         
            $current_color = sanitize_text_field( wp_unslash( $_POST['currentColor'] ) );

            $color_schemes = masonry_grid_color_schema_color( $current_color );

            if ( $color_schemes ) {
                echo json_encode( $color_schemes );
            }
        }
    
        wp_die();

    }

endif;

add_action( 'wp_ajax_nopriv_masonry_grid_color_schema_color', 'masonry_grid_color_schema_color_action' );
add_action( 'wp_ajax_masonry_grid_color_schema_color', 'masonry_grid_color_schema_color_action' );

if( ! function_exists( 'masonry_grid_iframe_escape' ) ):
    
    /** Escape Iframe **/
    function masonry_grid_iframe_escape( $input ){

        $all_tags = array(
            'iframe'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'frameborder'=>array(),
                'allow'=>array(),
                'allowfullscreen'=>array(),
            ),
            'video'=>array(
                'width'=>array(),
                'height'=>array(),
                'src'=>array(),
                'style'=>array(),
                'controls'=>array(),
            )
        );

        return wp_kses($input,$all_tags);
        
    }

endif;

if( class_exists( 'Booster_Extension_Class' ) ){

    add_filter('booster_extemsion_content_after_filter','masonry_grid_after_content_pagination');

}

if( !function_exists('masonry_grid_after_content_pagination') ):

    function masonry_grid_after_content_pagination($after_content){

        $pagination_single = wp_link_pages( array(
                    'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'masonry-grid' ),
                    'after'  => '</div>',
                    'echo' => false
                ) );

        $after_content =  $pagination_single.$after_content;

        return $after_content;

    }

endif;

if( !function_exists('masonry_grid_excerpt_content') ):

    function masonry_grid_excerpt_content(){ 

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        $ed_post_excerpt = get_theme_mod( 'ed_post_excerpt',$masonry_grid_default['ed_post_excerpt'] );

        if( $ed_post_excerpt ){ ?>
                    
            <div class="entry-content entry-content-muted">

                <?php
                if( has_excerpt() ){

                    the_excerpt();

                }else{

                    echo esc_html( wp_trim_words( get_the_content(), 25, '...' ) );

                } ?>

            </div>

        <?php }
    }

endif;

if( !function_exists('masonry_grid_video_content_render') ):

    function masonry_grid_video_content_render( $class1 = '', $class2 = '', $class3 = '', $ratio_value = 'default', $video_autoplay = 'autoplay-disable' ){

        $image_size = 'medium_large'; ?>


        <article id="post-<?php the_ID(); ?>" <?php post_class('twp-archive-items'); ?>>
            <div class="entry-wrapper">
                <?php
                if( $video_autoplay == 'autoplay-enable' ){
                    $autoplay_class = 'pause';
                    $play_pause_text = esc_html__('Pause','masonry-grid');
                }else{
                    $autoplay_class = 'play';
                    $play_pause_text = esc_html__('Play','masonry-grid');
                }

                add_filter('booster_extension_filter_like_ed', function ( ) {
                    return false;
                });

                $content = apply_filters( 'the_content', get_the_content() );
                $video = false;

                // Only get video from the content if a playlist isn't present.
                if ( false === strpos( $content, 'wp-playlist-script' ) ) {

                    $video = get_media_embedded_in_content( $content, array( 'video', 'object', 'embed', 'iframe' ) );

                }

                if ( ! empty( $video ) ) { ?>

                    <div class="entry-content-media">
                        <div class="twp-content-video">

                            <?php
                            foreach ( $video as $video_html ) { ?>

                                <div class="entry-video theme-ratio-<?php echo esc_attr( $ratio_value ); ?>">
                                    <div class="twp-video-control-buttons hide-no-js">

                                        <button attr-id="<?php echo esc_attr( $class2 ); ?>-<?php echo absint( get_the_ID() ); ?>" class="theme-video-control theme-action-control twp-pause-play <?php echo esc_attr( $autoplay_class ); ?>">
                                            <span class="action-control-trigger">
                                                <span class="twp-video-control-action">
                                                    <?php masonry_grid_the_theme_svg( $autoplay_class ); ?>
                                                </span>

                                                <span class="screen-reader-text">
                                                    <?php echo $play_pause_text; ?>
                                                </span>
                                            </span>
                                        </button>

                                        <button attr-id="<?php echo esc_attr( $class2 ); ?>-<?php echo absint( get_the_ID() ); ?>" class="theme-video-control theme-action-control twp-mute-unmute unmute">
                                            <span class="action-control-trigger">
                                                <span class="twp-video-control-action">
                                                    <?php masonry_grid_the_theme_svg('mute'); ?>
                                                </span>

                                                <span class="screen-reader-text">
                                                    <?php esc_html_e('Unmute','masonry-grid'); ?>
                                                </span>
                                            </span>
                                        </button>

                                    </div>

                                    <div class="theme-video-panel <?php echo esc_attr( $class3 ); ?>" data-autoplay="<?php echo esc_attr( $video_autoplay ); ?>" data-id="<?php echo esc_attr( $class2 ); ?>-<?php echo absint( get_the_ID() ); ?>">
                                        <?php echo masonry_grid_iframe_escape( $video_html ); ?>
                                    </div>

                                </div>

                                <?php
                                break;

                            } ?>

                            <?php
                            $format = get_post_format(get_the_ID()) ?: 'standard';
                            $icon = masonry_grid_post_format_icon($format);
                            if (!empty($icon)) { ?>
                                <div class="post-format-icon"><?php echo masonry_grid_svg_escape($icon); ?></div>
                            <?php } ?>
                
                        </div>
                    </div>

                <?php
                }else{

                    if (has_post_thumbnail()) { ?>

                    <div class="entry-thumbnail">

                        <a 
                            href="<?php the_permalink(); ?>"
                            aria-label="<?php the_title(); ?>"
                            >
                            <?php
                            the_post_thumbnail('medium_large', array(
                                'alt' => the_title_attribute(array(
                                    'echo' => false,
                                )),
                                'class' => 'entry-responsive-thumbnail',
                            ));
                            ?>
                        </a>

                        <?php
                        $format = get_post_format(get_the_ID()) ?: 'standard';
                        $icon = masonry_grid_post_format_icon($format);
                        if (!empty($icon)) { ?>
                            <div class="post-format-icon"><?php echo masonry_grid_svg_escape($icon); ?></div>
                        <?php } ?>

                    </div>

                <?php
                }

                } ?>

                <div class="post-content">

                    <div class="entry-meta">

                        <?php masonry_grid_entry_footer($cats = true, $tags = false, $edits = false); ?>

                    </div>

                    <header class="entry-header">

                        <h2 class="entry-title entry-title-small">
                            <a 
                                href="<?php the_permalink(); ?>"
                                aria-label="<?php the_title(); ?>"
                                >
                                <?php the_title(); ?>
                            </a>
                        </h2>

                    </header>

                    <div class="entry-meta">
                        <?php
                        masonry_grid_posted_by();
                        ?>
                    </div>

                    <div class="entry-content entry-content-muted entry-content-small">

                        <?php
                        if( has_excerpt() ){

                            the_excerpt();

                        }else{

                            echo '<p>';
                            echo esc_html( wp_trim_words( get_the_content(),25,'...' ) );
                            echo '</p>';

                        } ?>

                    </div>

                    <?php masonry_grid_read_more_render(); ?>

                </div>
            </div>
        </article>
    
    <?php
    }

endif;

if( !function_exists('masonry_grid_get_sidebar') ):

    function masonry_grid_get_sidebar(){

        $masonry_grid_default = masonry_grid_get_default_theme_options();
        $masonry_grid_post_sidebar_option = esc_attr( get_post_meta( get_the_ID(), 'masonry_grid_post_sidebar_option', true ) );
        if( $masonry_grid_post_sidebar_option == '' || $masonry_grid_post_sidebar_option == 'global-sidebar' ){

            $global_sidebar_layout = get_theme_mod( 'global_sidebar_layout',$masonry_grid_default['global_sidebar_layout'] );    
            $sidebar = $global_sidebar_layout;
        }else{
            $sidebar = $masonry_grid_post_sidebar_option;
        }

        if ( ! is_active_sidebar( 'sidebar-1' ) ) {
            $sidebar = 'no-sidebar';
        }
        return $sidebar;

    }

endif;

if (!function_exists('masonry_grid_post_format_icon')):

    // Post Format Icon.
    function masonry_grid_post_format_icon($format)
    {

        if( $format == 'video' ){
            $icon = masonry_grid_get_theme_svg( 'video' );
        }elseif( $format == 'audio' ){
            $icon = masonry_grid_get_theme_svg( 'audio' );
        }elseif( $format == 'gallery' ){
            $icon = masonry_grid_get_theme_svg( 'gallery' );
        }elseif( $format == 'quote' ){
            $icon = masonry_grid_get_theme_svg( 'quote' );
        }elseif( $format == 'image' ){
            $icon = masonry_grid_get_theme_svg( 'image' );
        }else{
            $icon = '';
        }

        return $icon;
        
    }

endif;

if ( ! function_exists( 'masonry_grid_svg_escape' ) ):

    /**
     * Get information about the SVG icon.
     *
     * @param string $svg_name The name of the icon.
     * @param string $group The group the icon belongs to.
     * @param string $color Color code.
     */
    function masonry_grid_svg_escape( $input ) {

        // Make sure that only our allowed tags and attributes are included.
        $svg = wp_kses(
            $input,
            array(
                'svg'     => array(
                    'class'       => true,
                    'xmlns'       => true,
                    'width'       => true,
                    'height'      => true,
                    'viewbox'     => true,
                    'aria-hidden' => true,
                    'role'        => true,
                    'focusable'   => true,
                ),
                'path'    => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'd'         => true,
                    'transform' => true,
                ),
                'polygon' => array(
                    'fill'      => true,
                    'fill-rule' => true,
                    'points'    => true,
                    'transform' => true,
                    'focusable' => true,
                ),
            )
        );

        if ( ! $svg ) {
            return false;
        }

        return $svg;

    }

endif;

if ( ! function_exists( 'masonry_grid_render_filter' ) ):

    function masonry_grid_render_filter(  ) {

        $masonry_grid_post_category_list = masonry_grid_post_category_list(false); ?>

                <div class="theme-panelarea-header">
                    <div class="wrapper">
                        <div class="wrapper-inner">
                            <div class="column column-12">
                                <div class="article-filter-bar">

                                    <?php if ( class_exists( 'Booster_Extension_Class' ) ) { ?>

                                    <div class="article-filter-area filter-area-left">

                                        <div class="article-filter-label">
                                            <span><?php masonry_grid_the_theme_svg('sort'); ?></span>
                                            <span><?php esc_html_e('Sort By:','masonry-grid'); ?></span>
                                        </div>

                                        <div data-filter-group="popularity" class="article-filter-type article-views-filter">
                                            <button class="theme-button theme-button-filters theme-action-control twp-most-liked" aria-label="<?php esc_html_e('Most Liked','masonry-grid'); ?>">
                                                <span class="action-control-trigger" tabindex="-1">
                                                    <?php esc_html_e('Most Liked','masonry-grid'); ?>
                                                </span>
                                            </button>
                                            <button class="theme-button theme-button-filters theme-action-control twp-most-viewed" aria-label="<?php esc_html_e('Most Viewed','masonry-grid'); ?>">
                                                <span class="action-control-trigger" tabindex="-1">
                                                    <?php esc_html_e('Most Viewed','masonry-grid'); ?>
                                                </span>
                                            </button>
                                        </div>

                                    </div>

                                    <?php } ?>

                                    <div class="article-filter-area filter-area-right">
                                        <div class="article-filter-item">
                                            <div class="article-filter-label">
                                                <span><?php masonry_grid_the_theme_svg('filter'); ?></span>
                                                <span><?php esc_html_e('Filter By:', 'masonry-grid'); ?></span>
                                            </div>

                                            <div data-filter-group="category" class="article-filter-type article-categories-filter">

                                                <div class="theme-categories-multiselect">
                                                    <button class="theme-categories-selection theme-button theme-button-filters theme-action-control" data-filter=".">
                                                        <span class="action-control-trigger" tabindex="-1">
                                                            <?php esc_html_e('Select Category', 'masonry-grid'); ?>
                                                            <span class="theme-filter-icon dropdown-select-arrow"><?php masonry_grid_the_theme_svg('chevron-down'); ?></span>
                                                        </span>
                                                    </button>
                                                    <span class="theme-categories-selected"></span>
                                                </div>

                                                <div class="theme-categories-dropdown">
                                                    <?php if ($masonry_grid_post_category_list) {

                                                        foreach ($masonry_grid_post_category_list as $key => $category) {
                                                            if ($category) { ?>

                                                                <div class="cat-filter-item">
                                                                    <button class="twp-filter-<?php echo esc_attr($key); ?> theme-button theme-button-filters theme-action-control" data-filter=".<?php echo esc_attr($key); ?>" aria-label="<?php echo esc_html($category); ?>">
                                                                        <span class="action-control-trigger" tabindex="-1">
                                                                            <?php echo esc_html($category); ?>
                                                                        </span>
                                                                    </button>
                                                                </div>

                                                            <?php }
                                                        }
                                                    } ?>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="article-filter-item">
                                            <div class="article-filter-label">
                                                <span><?php masonry_grid_the_theme_svg('settings'); ?></span>
                                                <span><?php esc_html_e('Post Format:','masonry-grid'); ?></span>
                                            </div>

                                            <div data-filter-group="" class="article-filter-type article-format-filter">
                                                <button class="theme-button theme-button-filters theme-action-control" data-filter=".standard">
                                                    <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                                        <?php masonry_grid_the_theme_svg('standard'); ?>
                                                    </span>
                                                </button>

                                                <button class="theme-button theme-button-filters theme-action-control" data-filter=".gallery">
                                                    <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                                        <?php masonry_grid_the_theme_svg('gallery'); ?>
                                                    </span>
                                                </button>

                                                <button class="theme-button theme-button-filters theme-action-control" data-filter=".video">
                                                    <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                                        <?php masonry_grid_the_theme_svg('video'); ?>
                                                    </span>
                                                </button>

                                                <button class="theme-button theme-button-filters theme-action-control" data-filter=".quote">
                                                    <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                                        <?php masonry_grid_the_theme_svg('quote'); ?>
                                                    </span>
                                                </button>

                                                <button class="theme-button theme-button-filters theme-action-control" data-filter=".audio">
                                                    <span class="action-control-trigger theme-filter-icon" tabindex="-1">
                                                        <?php masonry_grid_the_theme_svg('audio'); ?>
                                                    </span>
                                                </button>
                                            </div>
                                        </div>

                                        <div class="article-filter-item article-filter-clear">
                                            <button class="theme-button theme-button-filters theme-action-control" aria-label=" <?php esc_html_e('Reset', 'masonry-grid'); ?>">
                                                <span class="action-control-trigger" tabindex="-1">
                                                    <span class="theme-filter-icon filter-clear-icon"><?php masonry_grid_the_theme_svg('cross'); ?></span>
                                                    <?php esc_html_e('Reset', 'masonry-grid'); ?>
                                                </span>
                                            </button>

                                        </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>


    <?php
    }

endif;

/**
 * Print the first instance of a block in the content, and then break away.
 *
 * @since Masonry Grid 1.0.7
 *
 * @param string      $block_name The full block type name, or a partial match.
 *                                Example: `core/image`, `core-embed/*`.
 * @param string|null $content    The content to search in. Use null for get_the_content().
 * @param int         $instances  How many instances of the block will be printed (max). Default  1.
 * @return bool Returns true if a block was located & printed, otherwise false.
 */
function masonry_grid_print_first_instance_of_block( $block_name, $content = null, $instances = 1 ) {
    $instances_count = 0;
    $blocks_content  = '';

    if ( ! $content ) {
        $content = get_the_content();
    }

    // Parse blocks in the content.
    $blocks = parse_blocks( $content );

    // Loop blocks.
    foreach ( $blocks as $block ) {

        // Sanity check.
        if ( ! isset( $block['blockName'] ) ) {
            continue;
        }

        // Check if this the block matches the $block_name.
        $is_matching_block = false;

        // If the block ends with *, try to match the first portion.
        if ( '*' === $block_name[-1] ) {
            $is_matching_block = 0 === strpos( $block['blockName'], rtrim( $block_name, '*' ) );
        } else {
            $is_matching_block = $block_name === $block['blockName'];
        }

        if ( $is_matching_block ) {
            // Increment count.
            $instances_count++;

            // Add the block HTML.
            $blocks_content .= render_block( $block );

            // Break the loop if the $instances count was reached.
            if ( $instances_count >= $instances ) {
                break;
            }
        }
    }

    if ( $blocks_content ) {
        /** This filter is documented in wp-includes/post-template.php */
        echo apply_filters( 'the_content', $blocks_content ); // phpcs:ignore WordPress.Security.EscapeOutput
        return true;
    }

    return false;
}