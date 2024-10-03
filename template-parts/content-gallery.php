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
masonry_grid_disable_post_views();
masonry_grid_disable_post_read_time();
masonry_grid_disable_post_like_dislike();
masonry_grid_disable_post_author_box();
masonry_grid_disable_post_reaction();
?>
<article id="post-<?php the_ID(); ?>" <?php post_class('twp-archive-items'); ?>>
    <div class="entry-wrapper">
        <?php
        if (has_block('core/gallery', get_the_content())) { ?>
            <div class="entry-content-media">
                <div class="twp-content-gallery">
                    <?php masonry_grid_print_first_instance_of_block('core/gallery', get_the_content()); ?>
                </div>
            </div>
            <?php
        } elseif ((function_exists('has_block') && has_block('gallery', get_the_content())) || get_post_gallery()) { ?>
            <div class="entry-content-media">
                <div class="twp-content-gallery">
                    <?php
                    if (function_exists('has_block') && has_block('gallery', get_the_content())) {
                        $post_blocks = parse_blocks(get_the_content());
                        if ($post_blocks) {
                            foreach ($post_blocks as $post_block) {
                                if (isset($post_block['blockName']) &&
                                    isset($post_block['innerHTML']) &&
                                    $post_block['blockName'] == 'core/gallery') {
                                    echo '<div class="entry-gallery">';
                                    echo wp_kses_post($post_block['innerHTML']);
                                    echo '</div>';
                                    break;
                                }
                            }
                        }
                    } else {
                        if (get_post_gallery()) {
                            echo '<div class="entry-gallery">';
                            echo wp_kses_post(get_post_gallery());
                            echo '</div>';
                        }
                    } ?>
                </div>
                <?php
                $format = get_post_format(get_the_ID()) ?: 'standard';
                $icon = masonry_grid_post_format_icon($format);
                if (!empty($icon)) { ?>
                    <div class="post-format-icon"><?php echo masonry_grid_svg_escape($icon); ?></div>
                <?php } ?>
            </div>
            <?php
        } else {
            if (has_post_thumbnail()): ?>
                <div class="entry-thumbnail">
                    <a href="<?php the_permalink() ?>">
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
            <?php endif; ?>
        <?php } ?>
        <div class="post-content">
            <div class="entry-meta">
                <?php masonry_grid_entry_footer($cats = true, $tags = false, $edits = false); ?>
            </div>
            <header class="entry-header">
                <h2 class="entry-title entry-title-small">
                    <a href="<?php the_permalink(); ?>">
                        <?php the_title(); ?>
                    </a>
                </h2>
            </header>
            <div class="entry-meta">
                <?php masonry_grid_posted_by(); ?>
            </div>
            <?php masonry_grid_read_more_render(); ?>
        </div>
    </div>
</article>