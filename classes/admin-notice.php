<?php
if ( !class_exists('Masonry_Grid_Dashboard_Notice') ):

    class Masonry_Grid_Dashboard_Notice
    {
        function __construct()
        {   
            global $pagenow;

            if( $this->masonry_grid_show_hide_notice() ){

                add_action( 'admin_notices',array( $this,'masonry_grid_admin_notice' ) );
            }
            add_action( 'wp_ajax_masonry_grid_notice_dismiss', array( $this, 'masonry_grid_notice_dismiss' ) );
            add_action( 'switch_theme', array( $this, 'masonry_grid_notice_clear_cache' ) );
        
            if( isset( $_GET['page'] ) && $_GET['page'] == 'masonry-grid-about' ){

                add_action('in_admin_header', array( $this,'masonry_grid_hide_all_admin_notice' ),1000 );

            }
        }

        public function masonry_grid_hide_all_admin_notice(){

            remove_all_actions('admin_notices');
            remove_all_actions('all_admin_notices');

        }
        
        public static function masonry_grid_show_hide_notice(){

            // Check If current Page 
            if ( isset( $_GET['page'] ) && $_GET['page'] == 'masonry-grid-about'  ) {
                return false;
            }

            // Hide if dismiss notice
            if( get_option('masonry_grid_admin_notice') ){
                return false;
            }
            // Hide if all plugin active
            if ( class_exists( 'Booster_Extension_Class' ) && class_exists( 'Demo_Import_Kit_Class' ) && class_exists( 'Themeinwp_Import_Companion' ) ) {
                return false;
            }
            // Hide On TGMPA pages
            if ( ! empty( $_GET['tgmpa-nonce'] ) ) {
                return false;
            }
            // Hide if user can't access
            if ( current_user_can( 'manage_options' ) ) {
                return true;
            }
            
        }

        // Define Global Value
        public static function masonry_grid_admin_notice(){

            $theme_info      = wp_get_theme();
            $theme_name            = $theme_info->__get( 'Name' );
            ?>
            <div class="updated notice is-dismissible twp-masonry-grid-notice">

                <p class="notice-text">
                    <?php
                    $current_user = wp_get_current_user();

                    printf(
                    /* Translators: %1$s current user display name., %2$s this theme name., %3$s discount coupon code., %4$s discount percentage. */
                        esc_html__(
                            'Dear %1$s, We hope you are enjoying using our %2$s WordPress theme. We are constantly working to improve and enhance the user experience, and we are excited to announce that we now have a pro version available. If you are interested in upgrading to pro, simply click the link below to upgrade.',
                            'masonry-grid'
                        ),
                        '<strong>' . esc_html( $current_user->display_name ) . '</strong>',
                        '<strong>' . esc_html( $theme_name ) . '</strong>'
                    );

                    ?>
                </p>

                <p class="notice-text"><?php esc_html_e('Thank you for your continued support and we hope you consider upgrading to pro.','masonry-grid'); ?></p>

                <p>
                    <a target="_blank" class="button button-primary button-primary-upgrade" href="<?php echo esc_url( 'https://www.themeinwp.com/theme/masonry-grid-pro/' ); ?>">
                        <span class="dashicons dashicons-thumbs-up"></span>
                        <span><?php esc_html_e('Upgrade to Pro','masonry-grid'); ?></span>
                    </a>

                    <a class="button button-secondary twp-install-active" href="javascript:void(0)">
                        <span class="dashicons dashicons-admin-plugins"></span>
                        <span><?php esc_html_e('Install and enable all recommended plugins','masonry-grid'); ?></span>
                    </a>
                    <span class="quick-loader-wrapper"><span class="quick-loader"></span></span>

                    <a target="_blank" class="button button-secondary" href="<?php echo esc_url( 'https://demo.themeinwp.com/masonry-grid/' ); ?>">
                        <span class="dashicons dashicons-welcome-view-site"></span>
                        <span><?php esc_html_e('View Demo','masonry-grid'); ?></span>
                    </a>

                    <a target="_blank" class="button button-primary" href="<?php echo esc_url('https://wordpress.org/support/theme/masonry-grid/reviews/?filter=5'); ?>">
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span class="dashicons dashicons-star-filled"></span>
                        <span><?php esc_html_e('Leave a review', 'masonry-grid'); ?></span>
                    </a>

                    <a class="btn-dismiss twp-custom-setup" href="javascript:void(0)"><?php esc_html_e('Dismiss this notice.','masonry-grid'); ?></a>

                </p>

            </div>

        <?php
        }

        public function masonry_grid_notice_dismiss(){

            check_ajax_referer( 'masonry_grid_ajax_nonce', 'security' );
            update_option('masonry_grid_admin_notice','hide');

            die();

        }

        public function masonry_grid_notice_clear_cache(){

            update_option('masonry_grid_admin_notice','');

        }

    }
    new Masonry_Grid_Dashboard_Notice();
endif;