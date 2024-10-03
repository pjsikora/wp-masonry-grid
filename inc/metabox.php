<?php
/**
* Sidebar Metabox.
*
* @package Masonry Grid
*/
 
add_action( 'add_meta_boxes', 'masonry_grid_metabox' );

if( ! function_exists( 'masonry_grid_metabox' ) ):


    function  masonry_grid_metabox() {
        
        add_meta_box(
            'masonry-grid-custom-metabox',
            esc_html__( 'Layout Settings', 'masonry-grid' ),
            'masonry_grid_post_metafield_callback',
            'post', 
            'normal', 
            'high'
        );
        add_meta_box(
            'masonry-grid-custom-metabox',
            esc_html__( 'Layout Settings', 'masonry-grid' ),
            'masonry_grid_post_metafield_callback',
            'page',
            'normal', 
            'high'
        ); 
    }

endif;

$masonry_grid_post_sidebar_fields = array(
    'global-sidebar' => array(
                    'id'        => 'post-global-sidebar',
                    'value' => 'global-sidebar',
                    'label' => esc_html__( 'Global sidebar', 'masonry-grid' ),
                ),
    'right-sidebar' => array(
                    'id'        => 'post-left-sidebar',
                    'value' => 'right-sidebar',
                    'label' => esc_html__( 'Right sidebar', 'masonry-grid' ),
                ),
    'left-sidebar' => array(
                    'id'        => 'post-right-sidebar',
                    'value'     => 'left-sidebar',
                    'label'     => esc_html__( 'Left sidebar', 'masonry-grid' ),
                ),
    'no-sidebar' => array(
                    'id'        => 'post-no-sidebar',
                    'value'     => 'no-sidebar',
                    'label'     => esc_html__( 'No sidebar', 'masonry-grid' ),
                ),
);

/**
 * Callback function for post option.
*/
if( ! function_exists( 'masonry_grid_post_metafield_callback' ) ):
    
	function masonry_grid_post_metafield_callback() {
		global $post, $masonry_grid_post_sidebar_fields;
        $post_type = get_post_type($post->ID);
		wp_nonce_field( basename( __FILE__ ), 'masonry_grid_post_meta_nonce' ); ?>
        
        <div class="metabox-main-block">

            <div class="metabox-navbar">
                <ul>

                    <li>
                        <a id="metabox-navbar-general" class="metabox-navbar-active" href="javascript:void(0)">

                            <?php esc_html_e('General Settings', 'masonry-grid'); ?>

                        </a>
                    </li>

                    <?php if( $post_type == 'post' ): ?>
                        <li>
                            <a id="metabox-navbar-appearance" href="javascript:void(0)">

                                <?php esc_html_e('Appearance Settings', 'masonry-grid'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                    <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ): ?>
                        <li>
                            <a id="twp-tab-booster" href="javascript:void(0)">

                                <?php esc_html_e('Booster Extension Settings', 'masonry-grid'); ?>

                            </a>
                        </li>
                    <?php endif; ?>

                </ul>
            </div>

            <div class="twp-tab-content">

                <div id="metabox-navbar-general-content" class="metabox-content-wrap metabox-content-wrap-active">

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Sidebar Layout','masonry-grid'); ?></h3>

                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <?php
                            $masonry_grid_post_sidebar = esc_html( get_post_meta( $post->ID, 'masonry_grid_post_sidebar_option', true ) ); 
                            if( $masonry_grid_post_sidebar == '' ){ $masonry_grid_post_sidebar = 'global-sidebar'; }

                            foreach ( $masonry_grid_post_sidebar_fields as $masonry_grid_post_sidebar_field) { ?>

                                <label class="description">

                                    <input type="radio" name="masonry_grid_post_sidebar_option" value="<?php echo esc_attr( $masonry_grid_post_sidebar_field['value'] ); ?>" <?php if( $masonry_grid_post_sidebar_field['value'] == $masonry_grid_post_sidebar ){ echo "checked='checked'";} if( empty( $masonry_grid_post_sidebar ) && $masonry_grid_post_sidebar_field['value']=='right-sidebar' ){ echo "checked='checked'"; } ?>/>&nbsp;<?php echo esc_html( $masonry_grid_post_sidebar_field['label'] ); ?>

                                </label>

                            <?php } ?>

                        </div>

                    </div>

                    <div class="metabox-opt-panel">

                        <h3 class="meta-opt-title"><?php esc_html_e('Navigation Setting','masonry-grid'); ?></h3>

                        <?php $twp_disable_ajax_load_next_post = esc_attr( get_post_meta($post->ID, 'twp_disable_ajax_load_next_post', true) ); ?>
                        <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                            <label><b><?php esc_html_e( 'Navigation Type','masonry-grid' ); ?></b></label>

                            <select name="twp_disable_ajax_load_next_post">

                                <option <?php if( $twp_disable_ajax_load_next_post == '' || $twp_disable_ajax_load_next_post == 'global-layout' ){ echo 'selected'; } ?> value="global-layout"><?php esc_html_e('Global Layout','masonry-grid'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'no-navigation' ){ echo 'selected'; } ?> value="no-navigation"><?php esc_html_e('Disable Navigation','masonry-grid'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'norma-navigation' ){ echo 'selected'; } ?> value="norma-navigation"><?php esc_html_e('Next Previous Navigation','masonry-grid'); ?></option>
                                <option <?php if( $twp_disable_ajax_load_next_post == 'ajax-next-post-load' ){ echo 'selected'; } ?> value="ajax-next-post-load"><?php esc_html_e('Ajax Load Next 3 Posts Contents','masonry-grid'); ?></option>

                            </select>

                        </div>
                    </div>

                </div>

                <?php if( $post_type == 'post' ): ?>

                    <div id="metabox-navbar-appearance-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Feature Image Setting','masonry-grid'); ?></h3>

                                <?php
                                $masonry_grid_ed_feature_image = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_feature_image', true ) ); ?>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="masonry-grid-ed-feature-image" name="masonry_grid_ed_feature_image" value="1" <?php if( $masonry_grid_ed_feature_image ){ echo "checked='checked'";} ?>/>
                                <label for="masonry-grid-ed-feature-image"><?php esc_html_e( 'Disable Feature Image','masonry-grid' ); ?></label>

                            </div>

                        </div>

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Video Aspect Ration Setting','masonry-grid'); ?></h3>

                            <?php $twp_aspect_ratio = esc_attr( get_post_meta($post->ID, 'twp_aspect_ratio', true) ); ?>
                            <div class="metabox-opt-wrap metabox-opt-wrap-alt">

                                <label><b><?php esc_html_e( 'Video Aspect Ratio','masonry-grid' ); ?></b></label>

                                <select name="twp_aspect_ratio">

                                    <option <?php if( $twp_aspect_ratio == '' || $twp_aspect_ratio == 'default' ){ echo 'selected'; } ?> value="default"><?php esc_html_e('Default','masonry-grid'); ?></option>

                                    <option <?php if( $twp_aspect_ratio == 'square' ){ echo 'selected'; } ?> value="square"><?php esc_html_e('Square','masonry-grid'); ?></option>

                                    <option <?php if( $twp_aspect_ratio == 'portrait' ){ echo 'selected'; } ?> value="portrait"><?php esc_html_e('  Portrait','masonry-grid'); ?></option>

                                    <option <?php if( $twp_aspect_ratio == 'landscape' ){ echo 'selected'; } ?> value="landscape"><?php esc_html_e('Landscape','masonry-grid'); ?></option>

                                </select>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>

                <?php if( $post_type == 'post' && class_exists('Booster_Extension_Class') ):

                    
                    $masonry_grid_ed_post_views = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_post_views', true ) );
                    $masonry_grid_ed_post_read_time = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_post_read_time', true ) );
                    $masonry_grid_ed_post_like_dislike = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_post_like_dislike', true ) );
                    $masonry_grid_ed_post_author_box = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_post_author_box', true ) );
                    $masonry_grid_ed_post_social_share = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_post_social_share', true ) );
                    $masonry_grid_ed_post_reaction = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_post_reaction', true ) );
                    $masonry_grid_ed_post_rating = esc_html( get_post_meta( $post->ID, 'masonry_grid_ed_post_rating', true ) );
                    ?>

                    <div id="twp-tab-booster-content" class="metabox-content-wrap">

                        <div class="metabox-opt-panel">

                            <h3 class="meta-opt-title"><?php esc_html_e('Booster Extension Plugin Content','masonry-grid'); ?></h3>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="masonry-grid-ed-post-views" name="masonry_grid_ed_post_views" value="1" <?php if( $masonry_grid_ed_post_views ){ echo "checked='checked'";} ?>/>
                                <label for="masonry-grid-ed-post-views"><?php esc_html_e( 'Disable Post Views','masonry-grid' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="masonry-grid-ed-post-read-time" name="masonry_grid_ed_post_read_time" value="1" <?php if( $masonry_grid_ed_post_read_time ){ echo "checked='checked'";} ?>/>
                                <label for="masonry-grid-ed-post-read-time"><?php esc_html_e( 'Disable Post Read Time','masonry-grid' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="masonry-grid-ed-post-like-dislike" name="masonry_grid_ed_post_like_dislike" value="1" <?php if( $masonry_grid_ed_post_like_dislike ){ echo "checked='checked'";} ?>/>
                                <label for="masonry-grid-ed-post-like-dislike"><?php esc_html_e( 'Disable Post Like Dislike','masonry-grid' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="masonry-grid-ed-post-author-box" name="masonry_grid_ed_post_author_box" value="1" <?php if( $masonry_grid_ed_post_author_box ){ echo "checked='checked'";} ?>/>
                                <label for="masonry-grid-ed-post-author-box"><?php esc_html_e( 'Disable Post Author Box','masonry-grid' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="masonry-grid-ed-post-social-share" name="masonry_grid_ed_post_social_share" value="1" <?php if( $masonry_grid_ed_post_social_share ){ echo "checked='checked'";} ?>/>
                                <label for="masonry-grid-ed-post-social-share"><?php esc_html_e( 'Disable Post Social Share','masonry-grid' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="masonry-grid-ed-post-reaction" name="masonry_grid_ed_post_reaction" value="1" <?php if( $masonry_grid_ed_post_reaction ){ echo "checked='checked'";} ?>/>
                                <label for="masonry-grid-ed-post-reaction"><?php esc_html_e( 'Disable Post Reaction','masonry-grid' ); ?></label>

                            </div>

                            <div class="metabox-opt-wrap twp-checkbox-wrap">

                                <input type="checkbox" id="masonry-grid-ed-post-rating" name="masonry_grid_ed_post_rating" value="1" <?php if( $masonry_grid_ed_post_rating ){ echo "checked='checked'";} ?>/>
                                <label for="masonry-grid-ed-post-rating"><?php esc_html_e( 'Disable Post Rating','masonry-grid' ); ?></label>

                            </div>

                        </div>

                    </div>

                <?php endif; ?>
                
            </div>

        </div>  
            
    <?php }
endif;

// Save metabox value.
add_action( 'save_post', 'masonry_grid_save_post_meta' );

if( ! function_exists( 'masonry_grid_save_post_meta' ) ):

    function masonry_grid_save_post_meta( $post_id ) {

        global $post, $masonry_grid_post_sidebar_fields;

        if( !isset( $_POST[ 'masonry_grid_post_meta_nonce' ] ) || !wp_verify_nonce( sanitize_text_field( wp_unslash( $_POST['masonry_grid_post_meta_nonce'] ) ), basename( __FILE__ ) ) ){

            return;

        }

        if( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ){

            return;

        }
            
        if( isset(  $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {  

            if ( !current_user_can( 'edit_page', $post_id ) ){  

                return $post_id;

            }

        }elseif( !current_user_can( 'edit_post', $post_id ) ) {

            return $post_id;

        }

        foreach ( $masonry_grid_post_sidebar_fields as $masonry_grid_post_sidebar_field ) {  
            
            $old = esc_attr( get_post_meta( $post_id, 'masonry_grid_post_sidebar_option', true ) ); 
            $new = sanitize_text_field( wp_unslash( $_POST['masonry_grid_post_sidebar_option'] ) );

            if ( $new && $new != $old ){

                update_post_meta ( $post_id, 'masonry_grid_post_sidebar_option', $new );

            }elseif( '' == $new && $old ) {

                delete_post_meta( $post_id,'masonry_grid_post_sidebar_option', $old );

            }
            
        }

        $twp_disable_ajax_load_next_post_old = esc_attr( get_post_meta( $post_id, 'twp_disable_ajax_load_next_post', true ) ); 

        $twp_disable_ajax_load_next_post_new = '';

        if( isset( $_POST['twp_disable_ajax_load_next_post'] ) ){
            $twp_disable_ajax_load_next_post_new = masonry_grid_sanitize_meta_pagination( wp_unslash( $_POST['twp_disable_ajax_load_next_post'] ) );
        }

        if( $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_new != $twp_disable_ajax_load_next_post_old ){

            update_post_meta ( $post_id, 'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_new );

        }elseif( '' == $twp_disable_ajax_load_next_post_new && $twp_disable_ajax_load_next_post_old ) {

            delete_post_meta( $post_id,'twp_disable_ajax_load_next_post', $twp_disable_ajax_load_next_post_old );

        }

        $masonry_grid_ed_feature_image_old = absint( get_post_meta( $post_id, 'masonry_grid_ed_feature_image', true ) );

        $masonry_grid_ed_feature_image_new = '';
        if( isset( $_POST['masonry_grid_ed_feature_image'] ) ){
            $masonry_grid_ed_feature_image_new = absint( wp_unslash( $_POST['masonry_grid_ed_feature_image'] ) );
        }

        if ( $masonry_grid_ed_feature_image_new && $masonry_grid_ed_feature_image_new != $masonry_grid_ed_feature_image_old ){

            update_post_meta ( $post_id, 'masonry_grid_ed_feature_image', $masonry_grid_ed_feature_image_new );

        }elseif( '' == $masonry_grid_ed_feature_image_new && $masonry_grid_ed_feature_image_old ) {

            delete_post_meta( $post_id,'masonry_grid_ed_feature_image', $masonry_grid_ed_feature_image_old );

        }

        $masonry_grid_ed_post_views_old = absint( get_post_meta( $post_id, 'masonry_grid_ed_post_views', true ) );

        $masonry_grid_ed_post_views_new = '';
        if( isset( $_POST['masonry_grid_ed_post_views'] ) ){

            $masonry_grid_ed_post_views_new = absint( wp_unslash( $_POST['masonry_grid_ed_post_views'] ) );

        }

        if( $masonry_grid_ed_post_views_new && $masonry_grid_ed_post_views_new != $masonry_grid_ed_post_views_old ){

            update_post_meta ( $post_id, 'masonry_grid_ed_post_views', $masonry_grid_ed_post_views_new );

        }elseif( '' == $masonry_grid_ed_post_views_new && $masonry_grid_ed_post_views_old ) {

            delete_post_meta( $post_id,'masonry_grid_ed_post_views', $masonry_grid_ed_post_views_old );

        }

        $masonry_grid_ed_post_read_time_old = absint( get_post_meta( $post_id, 'masonry_grid_ed_post_read_time', true ) );

        $masonry_grid_ed_post_read_time_new = '';
        if( isset( $_POST['masonry_grid_ed_post_read_time'] ) ){

            $masonry_grid_ed_post_read_time_new = absint( wp_unslash( $_POST['masonry_grid_ed_post_read_time'] ) );

        }

        if( $masonry_grid_ed_post_read_time_new && $masonry_grid_ed_post_read_time_new != $masonry_grid_ed_post_read_time_old ){

            update_post_meta ( $post_id, 'masonry_grid_ed_post_read_time', $masonry_grid_ed_post_read_time_new );

        }elseif( '' == $masonry_grid_ed_post_read_time_new && $masonry_grid_ed_post_read_time_old ) {

            delete_post_meta( $post_id,'masonry_grid_ed_post_read_time', $masonry_grid_ed_post_read_time_old );

        }

        $masonry_grid_ed_post_like_dislike_old = absint( get_post_meta( $post_id, 'masonry_grid_ed_post_like_dislike', true ) );

        $masonry_grid_ed_post_like_dislike_new = '';
        if( isset( $_POST['masonry_grid_ed_post_like_dislike'] ) ){

            $masonry_grid_ed_post_like_dislike_new = absint( wp_unslash( $_POST['masonry_grid_ed_post_like_dislike'] ) );

        }

        if( $masonry_grid_ed_post_like_dislike_new && $masonry_grid_ed_post_like_dislike_new != $masonry_grid_ed_post_like_dislike_old ){

            update_post_meta ( $post_id, 'masonry_grid_ed_post_like_dislike', $masonry_grid_ed_post_like_dislike_new );

        }elseif( '' == $masonry_grid_ed_post_like_dislike_new && $masonry_grid_ed_post_like_dislike_old ) {

            delete_post_meta( $post_id,'masonry_grid_ed_post_like_dislike', $masonry_grid_ed_post_like_dislike_old );

        }

        $masonry_grid_ed_post_author_box_old = absint( get_post_meta( $post_id, 'masonry_grid_ed_post_author_box', true ) );

        $masonry_grid_ed_post_author_box_new = '';
        if( isset( $_POST['masonry_grid_ed_post_like_dislike'] ) ){

            $masonry_grid_ed_post_author_box_new = absint( wp_unslash( $_POST['masonry_grid_ed_post_like_dislike'] ) );

        }

        if( $masonry_grid_ed_post_author_box_new && $masonry_grid_ed_post_author_box_new != $masonry_grid_ed_post_author_box_old ){

            update_post_meta ( $post_id, 'masonry_grid_ed_post_author_box', $masonry_grid_ed_post_author_box_new );

        }elseif( '' == $masonry_grid_ed_post_author_box_new && $masonry_grid_ed_post_author_box_old ) {

            delete_post_meta( $post_id,'masonry_grid_ed_post_author_box', $masonry_grid_ed_post_author_box_old );

        }

        $masonry_grid_ed_post_social_share_old = absint( get_post_meta( $post_id, 'masonry_grid_ed_post_social_share', true ) );

        $masonry_grid_ed_post_social_share_new = '';
        if( isset( $_POST['masonry_grid_ed_post_social_share'] ) ){

            $masonry_grid_ed_post_social_share_new = absint( wp_unslash( $_POST['masonry_grid_ed_post_social_share'] ) );

        }

        if( $masonry_grid_ed_post_social_share_new && $masonry_grid_ed_post_social_share_new != $masonry_grid_ed_post_social_share_old ){

            update_post_meta ( $post_id, 'masonry_grid_ed_post_social_share', $masonry_grid_ed_post_social_share_new );

        }elseif( '' == $masonry_grid_ed_post_social_share_new && $masonry_grid_ed_post_social_share_old ) {

            delete_post_meta( $post_id,'masonry_grid_ed_post_social_share', $masonry_grid_ed_post_social_share_old );

        }

        $masonry_grid_ed_post_reaction_old = absint( get_post_meta( $post_id, 'masonry_grid_ed_post_reaction', true ) );

        $masonry_grid_ed_post_reaction_new = '';
        if( isset( $_POST['masonry_grid_ed_post_reaction'] ) ){

            $masonry_grid_ed_post_reaction_new = absint( wp_unslash( $_POST['masonry_grid_ed_post_reaction'] ) );

        }

        if( $masonry_grid_ed_post_reaction_new && $masonry_grid_ed_post_reaction_new != $masonry_grid_ed_post_reaction_old ){

            update_post_meta ( $post_id, 'masonry_grid_ed_post_reaction', $masonry_grid_ed_post_reaction_new );

        }elseif( '' == $masonry_grid_ed_post_reaction_new && $masonry_grid_ed_post_reaction_old ) {

            delete_post_meta( $post_id,'masonry_grid_ed_post_reaction', $masonry_grid_ed_post_reaction_old );

        }

        $masonry_grid_ed_post_rating_old = absint( get_post_meta( $post_id, 'masonry_grid_ed_post_rating', true ) );

        $masonry_grid_ed_post_rating_new = '';
        if( isset( $_POST['masonry_grid_ed_post_rating'] ) ){

            $masonry_grid_ed_post_rating_new = absint( wp_unslash( $_POST['masonry_grid_ed_post_rating'] ) );

        }

        if ( $masonry_grid_ed_post_rating_new && $masonry_grid_ed_post_rating_new != $masonry_grid_ed_post_rating_old ){

            update_post_meta ( $post_id, 'masonry_grid_ed_post_rating', $masonry_grid_ed_post_rating_new );

        }elseif( '' == $masonry_grid_ed_post_rating_new && $masonry_grid_ed_post_rating_old ) {

            delete_post_meta( $post_id,'masonry_grid_ed_post_rating', $masonry_grid_ed_post_rating_old );

        }

        $twp_aspect_ratio_old = esc_attr( get_post_meta( $post_id, 'twp_aspect_ratio', true ) );

        $twp_aspect_ratio_new = '';
        if( isset( $_POST['twp_aspect_ratio'] ) ){

            $twp_aspect_ratio_new = esc_attr( wp_unslash( $_POST['twp_aspect_ratio'] ) );

        }

        if( $twp_aspect_ratio_new && $twp_aspect_ratio_new != $twp_aspect_ratio_old ){

            update_post_meta ( $post_id, 'twp_aspect_ratio', $twp_aspect_ratio_new );

        }elseif( '' == $twp_aspect_ratio_new && $twp_aspect_ratio_old ) {

            delete_post_meta( $post_id,'twp_aspect_ratio', $twp_aspect_ratio_old );

        }


    }

endif;   