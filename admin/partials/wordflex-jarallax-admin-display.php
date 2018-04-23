<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       #
 * @since      1.0.0
 *
 * @package    Wordflex_Jarallax
 * @subpackage Wordflex_Jarallax/admin/partials
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
    die;
}


/**
 * Register admin Meta boxes callback
 */
function WordFlex_Jarallax_register_metabox() {
    add_meta_box( 
        'wordflex_main_admin_metabox', 
        __('Hey there!', 'wordflex-jarallax' ), 
        'WordFlex_Jarallax_main_display', 
        'wordflex-jarallax', 
        'normal', 
        'high' 
    );
    add_meta_box( 
        'wordflex_side_admin_metabox', 
        __( 'Need help?', 'wordflex-jarallax' ), 
        'WordFlex_Jarallax_author_display', 
        'wordflex-jarallax', 
        'side', 
        'high' 
    );
}

/**
 * Main admin area
 */
function WordFlex_Jarallax_main_display() { 
    ?>
    <!-- Start jarallax content -->
    <div class="inside">
        <p class="lead"><?php _e('WordFlex Jarallax is a light weighted plugin lets you create responsive parallax backgrounds, videos on your page or posts. This plugin is based on <a href="' . esc_url( 'https://github.com/nk-o/jarallax' ) . '">Jarallax</a> plugin by <a href="' . esc_url('https://nkdev.info') . '">nK</a> with some cool extended UI.', 'wordflex-jarallax') ?></p>
        <h2 class="inside-heading p-0"><?php _e('Features', 'wordflex-jarallax') ?></h2>
        <ul class="wp-jarallax-list">
            <li><?php _e( ' - Easiest way to create Images, Videos backgrounds with different Parllax effect.', 'wordflex-jarallax' ) ?></li>
            <li><?php _e( ' - Support Youtube / Vimeo and Local Hosted Videos (mp4, webm).', 'wordflex-jarallax' ) ?></li>
            <li><?php _e( ' - Option to custom video start & end time.', 'wordflex-jarallax' ) ?></li>
            <li><?php _e( ' - Option to Enable / Disable on mobile devices.', 'wordflex-jarallax' ) ?></li>
            <li><?php _e( ' - Option to add Overlay Pattern images and/or colors.', 'wordflex-jarallax' ) ?></li>
            <li><?php _e( ' - Add multiple backgrounds in your posts/pages and as many as you need.', 'wordflex-jarallax' ) ?></li>
            <li><?php _e( ' - Easy to use with simple user interface.', 'wordflex-jarallax' ) ?></li>
            <li><?php _e( ' - Browsers support: Chrome v65, Firefox v59, Safari v11, Edge v15, Opera v50, Chrome Android and Safari on iOs.', 'wordflex-jarallax' ) ?></li>
        </ul>
        <hr class="my-2">
        <h2 class="inside-heading p-0"><?php _e('How to use?', 'wordflex') ?></h2>
        <p><?php _e('To display the WordFlex Jarallax background, simply fill this form below then click publish/update and finally add the following shortcode to your post/page.', 'wordflex-jarallax') ?>
        </p>
        <div class="copy-to-clipboard">
            <input class="shortcode-input" type="text" value='[jarallax id="<?php echo get_the_ID() ?>"]' readonly>
            <span class="copy"><a href="#" class="copy"><?php _e( 'Copy', 'display' ); ?></a></span>
            <span class="copied"><?php _e( 'Copied!', 'display' ); ?></span>
        </div>
        <p><?php _e('Please note that this shortcode will always refers to this page and the parameter ID - which is dynamically generated - is refers to this page ID, and so, you can create as many pages as you need with your desired settings and save them for later edit/use.') ?></p>
    </div>
    <!-- End jarallax content -->
    <?php
}

/**
 * Side admin area
 */
function WordFlex_Jarallax_author_display() {
    ?>
    <!-- Start jarallax sidebar -->
    <div class="sidebar-element">
        <span class="dashicons dashicons-admin-home"></span>
        <a class="no-underline" target="_blank" title="Plugin Homepage" href="<?php echo esc_url( 'https://github.com/awran5/wordflex-jarallax' ); ?>"><?php _e('Plugin Homepage', 'wordflex-jarallax');?></a>
    </div>
    <div class="sidebar-element">
        <span class="dashicons dashicons-flag"></span>
        <a class="no-underline" target="_blank" title="Issue tracker" href="<?php echo esc_url( 'https://github.com/awran5/wordflex-jarallax/issues' ); ?>"><?php _e('Report issue', 'wordflex-jarallax');?></a>
    </div>
    <div class="sidebar-element">
        <span class="dashicons dashicons-heart"></span>
        <span><?php _e('Credits:', 'wordflex-jarallax') ?></span>
        <a class="no-underline" target="_blank" title="Jarallax" href="<?php echo esc_url('https://github.com/nk-o/jarallax') ?>"><?php echo esc_html('Jarallax, ') ?> </a></li>
        <a class="no-underline" target="_blank" title="CMB2" href="<?php echo esc_url('https://github.com/CMB2/CMB2') ?>"><?php echo esc_html('CMB2') ?></a>
    </div>
    <hr>
    <div class="sidebar-element">
        <?php _e( 'If like to Support me Please consider a <a href="' . esc_url( 'https://www.paypal.me/awran5' ) . '">' . esc_html( 'Donation' ) . '</a> to help me cover the costs and keep non-profit work.', 'wordflex-jarallax') ?>
    </div>
    <hr>
    <div class="sidebar-element">
        &copy; <?php echo date('Y'); ?><a class="no-underline" target="_blank" href="<?php echo esc_url( 'https://github.com/awran5/' ); ?>" title="Awran5" target="_blank"><?php echo esc_html(' Awran5') ?></a>
    </div>
    <!-- End jarallax sidebar -->
    <?php 
}