<?php
/**
 * Social Link Widgets.
 *
 * @package Masonry Grid
 */
if ( !function_exists('masonry_grid_social_link_widget') ) :
    /**
     * Load widgets.
     *
     * @since 1.0.0
     */
    function masonry_grid_social_link_widget(){
        // Social Link Widget.
        register_widget('Masonry_Grid_Social_Link_widget');
    }
endif;
add_action('widgets_init', 'masonry_grid_social_link_widget');
/*Social widget*/
if ( !class_exists( 'Masonry_Grid_Social_Link_widget' ))  :
    /**
     * Social widget Class.
     *
     * @since 1.0.0
     */
    class Masonry_Grid_Social_Link_widget extends Masonry_Grid_Widget_Base
    {
        /**
         * Sets up a new widget instance.
         *
         * @since 1.0.0
         */
        function __construct()
        {
            $opts = array(
                'classname' => 'masonry_grid_social_widget',
                'description' => esc_html__('Displays Social share.', 'masonry-grid'),
                'customize_selective_refresh' => true,
            );
            $fields = array(
                'title' => array(
                    'label' => esc_html__('Title:', 'masonry-grid'),
                    'type' => 'text',
                    'class' => 'widefat',
                ),
                'url-fb' => array(
                   'label' => esc_html__('Facebook URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tw' => array(
                   'label' => esc_html__('Twitter URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-lt' => array(
                   'label' => esc_html__('Linkedin URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-ig' => array(
                   'label' => esc_html__('Instagram URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-pt' => array(
                   'label' => esc_html__('Pinterest URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-rt' => array(
                   'label' => esc_html__('Reddit URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-sk' => array(
                   'label' => esc_html__('Skype URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-dc' => array(
                    'label' => esc_html__('Discord URL:', 'masonry-grid'),
                    'type' => 'url',
                    'class' => 'widefat',
                ),
                'url-sc' => array(
                   'label' => esc_html__('Snapchat URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-tr' => array(
                   'label' => esc_html__('Tumblr URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-th' => array(
                   'label' => esc_html__('Twitch URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-yt' => array(
                   'label' => esc_html__('Youtube URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-vo' => array(
                   'label' => esc_html__('Vimeo URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-wa' => array(
                   'label' => esc_html__('Whatsapp URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-wp' => array(
                   'label' => esc_html__('WordPress URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-gh' => array(
                   'label' => esc_html__('Github URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-fs' => array(
                   'label' => esc_html__('FourSquare URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-db' => array(
                   'label' => esc_html__('Dribbble URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
                'url-vk' => array(
                   'label' => esc_html__('VK URL:', 'masonry-grid'),
                   'type' => 'url',
                   'class' => 'widefat',
                    ),
            );
            parent::__construct( 'masonry-grid-social-layout', esc_html__('MP: Social Widget', 'masonry-grid'), $opts, array(), $fields );
        }
        /**
         * Outputs the content for the current widget instance.
         *
         * @since 1.0.0
         *
         * @param array $args Display arguments.
         * @param array $instance Settings for the current widget instance.
         */
        function widget( $args, $instance )
        {
            $params = $this->get_params( $instance );
            echo $args['before_widget'];
            if ( ! empty( $params['title'] ) ) {
                echo $args['before_title'] . esc_html( $params['title'] ) . $args['after_title'];
            } ?>
            <div class="twp-social-widget">
                <ul class="social-widget-wrapper">
                    <?php if ( !empty( $params['url-fb'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fb']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('facebook'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-tw'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tw']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('twitter'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-lt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-lt']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('linkedin'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-ig'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-ig']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('instagram'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-pt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-pt']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('pinterest'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-rt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-rt']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('reddit'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-sk'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sk']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('skype'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if (!empty($params['url-dc'])) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-dc']); ?>" target="_blank">
                                <?php masonry_grid_the_theme_svg('discord'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-sc'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-sc']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('snapchat'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-tr'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-tr']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('tumblr'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-th'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-th']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('twitch'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-yt'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-yt']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('youtube'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-vo'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-vo']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('vimeo'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-wa'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wa']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('whatsapp'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-wp'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-wp']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('WordPress'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-gh'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-gh']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('github'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-fs'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-fs']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('foursquare'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-db'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-db']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('dribbble'); ?>
                            </a>
                        </li>
                    <?php } ?>
                    <?php if ( !empty( $params['url-vk'] ) ) { ?>
                        <li>
                            <a href="<?php echo esc_url($params['url-vk']); ?>" target="_blank">
                              <?php masonry_grid_the_theme_svg('vk'); ?>
                            </a>
                        </li>
                    <?php } ?>
                </ul>
            </div>
            <?php echo $args['after_widget'];
        }
    }
endif;
