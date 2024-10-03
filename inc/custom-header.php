<?php
/**
 * Sample implementation of the Custom Header feature
 * http://codex.wordpress.org/Custom_Headers
 *
 * You can add an optional custom header image to header.php like so ...
 *
 * @package Minimal Grid
 */

/**
 * Set up the WordPress core custom header feature.
 *
 * @uses masonry_grid_header_style()
 */
function masonry_grid_custom_header_setup()
{

    add_theme_support('custom-header', array(
        'default-text-color' => '000000',
        'wp-head-callback' => 'masonry_grid_header_style',
    ));

}

add_action('after_setup_theme', 'masonry_grid_custom_header_setup');

if (!function_exists('masonry_grid_header_style')) :
    /**
     * Styles the header image and text displayed on the blog
     *
     * @see masonry_grid_custom_header_setup().
     */
    function masonry_grid_header_style()
    {
        $header_text_color = get_header_textcolor();

        // If no custom options for text are set, let's bail
        // get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value.
        if (get_theme_support('custom-header', 'default-text-color') === $header_text_color) {
            return;
        }

        // If we get this far, we have custom styles. Let's do this.
        ?>
        <style type="text/css">
            <?php
                // Has the text been hidden?
                if ( 'blank' == $header_text_color ) :
            ?>
            .header-titles .custom-logo-name,
            .site-description {
                display: none;
                position: absolute;
                clip: rect(1px, 1px, 1px, 1px);
            }

            <?php
                // If the user has set a custom color for the text use that.
                else :
            ?>
            .header-titles .custom-logo-name,
            .site-description {
                color: #<?php echo esc_attr( $header_text_color ); ?>;
            }

            <?php endif; ?>
        </style>
        <?php
    }
endif; // masonry_grid_header_style