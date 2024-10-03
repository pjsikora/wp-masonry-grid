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
$masonry_grid_default = masonry_grid_get_default_theme_options(); ?>
<article id="post-<?php the_ID(); ?>" <?php post_class('twp-archive-items'); ?>>
    <div class="entry-wrapper">
        <?php if (has_post_thumbnail()): ?>
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
                <?php
                masonry_grid_posted_by();
                ?>
            </div>
            <?php masonry_grid_excerpt_content(); ?>
            <?php masonry_grid_read_more_render(); ?>
        </div>
    </div>
</article>