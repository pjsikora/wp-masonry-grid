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
$masonry_grid_ed_feature_image = esc_html(get_post_meta(get_the_ID(), 'masonry_grid_ed_feature_image', true));
$masonry_grid_ed_post_views = esc_html(get_post_meta(get_the_ID(), 'masonry_grid_ed_post_views', true));
$masonry_grid_ed_post_read_time = esc_html(get_post_meta(get_the_ID(), 'masonry_grid_ed_post_read_time', true));
$masonry_grid_ed_post_like_dislike = esc_html(get_post_meta(get_the_ID(), 'masonry_grid_ed_post_like_dislike', true));
$masonry_grid_ed_post_author_box = esc_html(get_post_meta(get_the_ID(), 'masonry_grid_ed_post_author_box', true));
$masonry_grid_ed_post_social_share = esc_html(get_post_meta(get_the_ID(), 'masonry_grid_ed_post_social_share', true));
$masonry_grid_ed_post_reaction = esc_html(get_post_meta(get_the_ID(), 'masonry_grid_ed_post_reaction', true));
masonry_grid_disable_post_views();
masonry_grid_disable_post_read_time();
if ($masonry_grid_ed_post_like_dislike) {
    masonry_grid_disable_post_like_dislike();
}
if ($masonry_grid_ed_post_author_box) {
    masonry_grid_disable_post_author_box();
}
if ($masonry_grid_ed_post_reaction) {
    masonry_grid_disable_post_reaction();
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
    <?php masonry_grid_breadcrumb(); ?>
    <?php
    if (has_post_thumbnail()) {
        if (empty($masonry_grid_ed_feature_image)) { ?>
            <div class="entry-featured-thumbnail">
                <div class="entry-thumbnail">
                    <?php
                    the_post_thumbnail('full', array(
                        'alt' => the_title_attribute(array(
                            'echo' => false,
                        )),
                        'class' => 'entry-responsive-thumbnail',
                    ));
                    ?>
                </div>
                <?php if ('post' === get_post_type() && class_exists('Booster_Extension_Class') && (empty($masonry_grid_ed_post_views) || empty($masonry_grid_ed_post_read_time))) { ?>
                    <div class="theme-page-vitals">
                        <?php
                        if (empty($masonry_grid_ed_post_read_time)) {
                            echo do_shortcode('[booster-extension-read-time]');
                        } ?>
                        <?php
                        if (empty($masonry_grid_ed_post_views)) {
                            echo do_shortcode('[booster-extension-visit-count container="true"]');
                        } ?>
                    </div>
                <?php } ?>
            </div>
            <?php
        }
    }
    if (is_singular()) { ?>
        <?php
        if ('post' === get_post_type()) { ?>
            <div class="entry-meta">
                <?php masonry_grid_entry_footer($cats = true, $tags = false, $edits = false); ?>
            </div>
        <?php } ?>
        <header class="entry-header">
            <h1 class="entry-title entry-title-large">
                <?php the_title(); ?>
            </h1>
        </header>
    <?php }
    if (is_single() && 'post' === get_post_type()) { ?>
        <div class="entry-meta">
            <?php
            masonry_grid_posted_by();
            ?>
        </div>
    <?php } ?>
    <div class="post-content-wrap">
        <?php if (is_singular() && empty($masonry_grid_ed_post_social_share) && class_exists('Booster_Extension_Class') && 'post' === get_post_type()) { ?>
            <div class="post-content-share">
                <?php echo do_shortcode('[booster-extension-ss layout="layout-1" status="enable"]'); ?>
            </div>
        <?php } ?>
        <div class="post-content">
            <div class="entry-content">
                <?php
                the_content(sprintf(
                /* translators: %s: Name of current post. */
                    wp_kses(__('Continue reading %s <span class="meta-nav">&rarr;</span>', 'masonry-grid'), array('span' => array('class' => array()))),
                    the_title('<span class="screen-reader-text">"', '"</span>', false)
                ));
                if (!class_exists('Booster_Extension_Class')) {
                    wp_link_pages(array(
                        'before' => '<div class="page-links">' . esc_html__('Pages:', 'masonry-grid'),
                        'after' => '</div>',
                    ));
                } ?>
            </div>
            <?php
            if (is_singular() && 'post' === get_post_type()) { ?>
                <div class="entry-footer">
                    <div class="entry-meta">
                        <?php masonry_grid_entry_footer($cats = false, $tags = true, $edits = true); ?>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</article>