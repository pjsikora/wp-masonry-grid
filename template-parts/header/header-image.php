<?php
/**
 * Header Image
 *
 * @package Masonry Grid
 */
$masonry_grid_default = masonry_grid_get_default_theme_options();
?>
<?php
if (!is_paged() && is_home() && has_header_image()) {
    $ed_header_banner = get_theme_mod('ed_header_banner', $masonry_grid_default['ed_header_banner']);
    if ($ed_header_banner) {
        $header_banner_title = get_theme_mod('header_banner_title', $masonry_grid_default['header_banner_title']);
        $header_banner_sub_title = get_theme_mod('header_banner_sub_title', $masonry_grid_default['header_banner_sub_title']);
        $header_banner_button_label = get_theme_mod('header_banner_button_label', $masonry_grid_default['header_banner_button_label']);
        $header_banner_button_link = get_theme_mod('header_banner_button_link');
        $header_banner_description = get_theme_mod('header_banner_description');
        ?>
        <section class="theme-block theme-block-custom-header">
            <div class="custom-header-media">
                <?php the_custom_header_markup(); ?>
            </div>
            <?php
            if ($header_banner_title || $header_banner_button_link) { ?>
                <div class="header-media-content">
                    <div class="wrapper">
                        <div class="header-media-wrapper">
                            <?php if ($header_banner_title) { ?>
                                <h2 class="entry-title entry-title-large"><?php echo esc_html($header_banner_title); ?></h2>
                            <?php } ?>

                            <?php if ($header_banner_sub_title) { ?>
                                <h3 class="entry-title entry-title-medium"><?php echo esc_html($header_banner_sub_title); ?></h3>
                            <?php } ?>

                            <?php if ($header_banner_description) { ?>
                                <div class="entry-content hidden-sm-screen">
                                    <?php echo esc_html($header_banner_description); ?>
                                </div>
                            <?php } ?>
                            <?php if ($header_banner_button_label) { ?>
                                <a href="<?php echo esc_url($header_banner_button_link); ?>" class="button button-filled">
                                    <?php echo esc_html($header_banner_button_label); ?>
                                </a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            <?php } ?>
        </section>
        <?php
    }
} ?>