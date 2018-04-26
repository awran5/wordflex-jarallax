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
 * WordFlex Carousel Metabox
 * @return Argument arrays
 */
function WordFlex_Jarallax_CMB2() {

    $prefix = 'cmb_jarallax_';

    $cmb_jarallax = new_cmb2_box( array(
        'id'                => $prefix . 'metabox',
        'title'   		    => __( 'Jarallax Settings', 'wordflex-jarallax' ),
        'object_types'      => array( 'wordflex-jarallax' ),
        'priority'          => 'low',
        'context'           => 'normal',
    ) );
    // Title Break - Type
    $cmb_jarallax->add_field( array(
        'name'              => __('Background type', 'wordflex-jarallax'),
        'desc'              => __('Select background type, Jarallax support: Image, Embed and self hosted video', 'wordflex-jarallax'),
        'type'              => 'title',
        'id'                => 'break_background',
    ) );
    // Background type select
    $cmb_jarallax->add_field( array(
        'name'             => __('Background type', 'wordflex-jarallax' ),
        'desc'             => __('Please select the background type', 'wordflex-jarallax' ),
        'id'               => $prefix . 'bg_type',
        'type'             => 'select',
        'show_option_none' => true,
        'options'          => array(
            'image'   => 'Image',
            'embed'   => 'Embed Video (YouTube, Vimeo)',
            'self'    => 'Self Hosted Video',
        ),
    ) );
    // image background
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Background Image', 'wordflex-jarallax' ),
        'desc'              => __( 'Select an image', 'wordflex-jarallax' ),
        'id'                => $prefix . 'bg_img_src',
        'type'              => 'file',
        'attributes'        => array(
            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => 'image',
        ),
        'options' => array( 'add_upload_file_text' => 'Upload image' ),
    ) );
    // online video
    $cmb_jarallax->add_field( array(
        'name'               => __( 'video url:', 'wordflex-jarallax' ),
        'desc'               => __( 'Enter full YouTube / Vimeo link.', 'wordflex-jarallax' ),
        'id'                 => $prefix . 'bg_online_src',
        'type'               => 'text_url',
        'attributes'         => array(
            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => 'embed',
        ),
    ) );
    // fallback image
    $cmb_jarallax->add_field( array(
        'name'                => __( 'Fallback image', 'wordflex-jarallax' ),
        'desc'                => __( 'Add an image that will be shown on unsuported devices (Recommended)', 'wordflex-jarallax' ),
        'id'                  => $prefix . 'self_video_poster',
        'type'                => 'file',
        'attributes'          => array(

            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => 'self',
        ),
        'options' => array( 'add_upload_file_text' => 'Upload image' ),
    ) );
    // mp4
    $cmb_jarallax->add_field( array(
        'name'                => __( 'mp4 video source', 'wordflex-jarallax' ),
        'desc'                => __( 'Add the MP4 video source for your local/external video (Recommended)', 'wordflex-jarallax' ),
        'id'                  => $prefix . 'self_mp4_src',
        'type'                => 'file',
        'attributes'          => array(
            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => 'self',
        ),
        'options' => array( 'add_upload_file_text' => 'Upload mp4 video' ),
    ) );
    
    // webm
    $cmb_jarallax->add_field( array(
        'name'                => __( 'webm video source', 'wordflex-jarallax' ),
        'desc'                => __( 'Add the Webm video source for your local/external video (Optional)', 'wordflex-jarallax' ),
        'id'                  => $prefix . 'self_webm_src',
        'type'                => 'file',
        'attributes'          => array(
            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => 'self',
        ),
        'options' => array( 'add_upload_file_text' => 'Upload webm video' ),
    ) );
    // Video Mobile
    $cmb_jarallax->add_field( array(
        'name'              => 'Video on mobile:',
        'desc'              => __( 'Enable video background on mobile devices. <br>Default value = True', 'wordflex-jarallax' ),
        'id'                => $prefix . 'mobile_video',
        'type'              => 'radio_inline',
        'options'           => array(
            'yes' => __( 'Yes', 'wordflex-jarallax' ),
            'no'  => __( 'No', 'wordflex-jarallax' ),
        ),
        'attributes' => array(
            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => wp_json_encode( array( 'embed', 'self' ) ),
        ),
        'default'           => 'yes',
        'classes'           => 'switch-field',
    ) );
    // Video Volume
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Video volume:', 'wordflex-jarallax' ),
        'desc'              => __( 'Video volume from 0 to 100. (0 = no sound).<br>Default value = 0', 'wordflex-jarallax' ),
        'id'                => $prefix . 'volume',
        'type'              => 'range',
        'min'               => '0',
        'step'              => '1',
        'max'               => '100',
        'default'           => '0',
        'value_label'       => 'Volume:',
        'attributes'        => array(
            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => wp_json_encode( array( 'embed', 'self' ) ),
        ),
    ) );
    // Video start time
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Video start time:', 'wordflex-jarallax' ),
        'desc'              => __( 'Start video time in seconds.<br>Default value = 0', 'wordflex-jarallax' ),
        'id'                => $prefix . 'video_start_time',
        'type'              => 'text_small',
        'attributes'        => array(
            'type'                   => 'number',
            'pattern'                => '\d*',
            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => wp_json_encode( array( 'embed', 'self' ) ),
            'min'                    => '0',
        ),
        'sanitization_cb'        => 'absint',
        'escape_cb'              => 'absint',
    ) );
    // Video end time
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Video end time:', 'wordflex-jarallax' ),
        'desc'              => __( 'End video time in seconds.<br>Default value = 0', 'wordflex-jarallax' ),
        'id'                => $prefix . 'video_end_time',
        'type'              => 'text_small',
        'attributes'        => array(
            'type'                   => 'number',
            'pattern'                => '\d*',
            'data-conditional-id'    => $prefix . 'bg_type',
            'data-conditional-value' => wp_json_encode( array( 'embed', 'self' ) ),
            'min'                    => '0',
        ),
        'sanitization_cb'        => 'absint',
        'escape_cb'              => 'absint',
    ) );
    // Title Break - general
    $cmb_jarallax->add_field( array(
        'name'              => __('Background settings', 'wordflex-jarallax'),
        'desc'              => 'General settings to add/edit backgrounds',
        'type'              => 'title',
        'id'                => 'break_settings',
    ) );
    // Height
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Background height:', 'wordflex-jarallax' ),
        'desc'              => __( 'Set height in pixels. (Empty or 0) will set Minimum Height 360px', 'wordflex-jarallax' ),
        'id'                => $prefix . 'height',
        'type'              => 'text_small',
        'attributes'        => array(
            'type'     => 'number',
            'pattern'  => '\d*',
        ),
        'sanitization_cb'   => 'absint',
        'escape_cb'         => 'absint',
    ) );
    // Parallax Type
    $cmb_jarallax->add_field( array(
        'name'              => 'Parallax type:',
        'desc'              => __( 'Chnage Parallax effect (scroll, scale, opacity, scroll-opacity, scale-opacity).<br>Default value = Scroll', 'wordflex-jarallax' ),
        'id'                => $prefix . 'parallax_type',
        'type'              => 'select',
        'options'           => array(
            'scroll'        => __( 'Scroll', 'wordflex-jarallax' ),
            'scale'         => __( 'Scale', 'wordflex-jarallax' ),
            'opacity'       => __( 'Opacity', 'wordflex-jarallax' ),
            'scroll-opacity'=> __( 'Scroll with opacity', 'wordflex-jarallax' ),
            'scale-opacity' => __( 'Scale with opacity', 'wordflex-jarallax' ),
        ),
        'default'           => 'scroll',
    ) );
    // Speed
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Parallax speed:', 'wordflex-jarallax' ),
        'desc'              => __( 'Provide numbers from 0.1 to 2 in (decimal) i.e. 0.5 <br>Default value = 0.2', 'wordflex-jarallax' ),
        'id'                => $prefix . 'parallax_speed',
        'type'              => 'text_small',
        'attributes'        => array(
            'placeholder'   => '0.2',
            'type'          => 'number',
            //'pattern'       => '\d{0}[0-2]\.\d{1}$',
            'step'          => '.1',
            'max'           => '2',
        ),
    ) );

    // Parallax Mobile
    $cmb_jarallax->add_field( array(
        'name'              => __('Parallax on mobile:', 'wordflex-jarallax' ),
        'desc'              => __( 'Enable Parallax effect on mobile devices. <br>Default value = True', 'wordflex-jarallax' ),
        'id'                => $prefix . 'mobile_parallax',
        'type'              => 'radio_inline',
        'options'           => array(
            'yes'   => __( 'Yes', 'wordflex-jarallax' ),
            'no'    => __( 'No', 'wordflex-jarallax' ),
        ),
        'default'           => 'yes',
        'classes'           => 'switch-field',
    ) );
    // Overlay
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Background overlay', 'wordflex-jarallax' ),
        'desc'              => __( 'Enable background overlay. You can set colors and/or images.', 'wordflex-jarallax' ),
        'id'                => $prefix . 'overlay',
        'type'              => 'radio_inline',
        'options'           => array(
            'yes'   => __( 'Yes', 'wordflex-jarallax' ),
            'no'    => __( 'No', 'wordflex-jarallax' ),
        ),
        'default'           => 'no',
        'classes'           => 'switch-field',
    ) );
    // Overlay image
    $cmb_jarallax->add_field( array(
        'name'               => __( 'Overlay image', 'wordflex-jarallax' ),
        'desc'               => __( 'Add your overlay background image.', 'wordflex-jarallax' ),
        'id'                 => $prefix . 'overlay_bg',
        'type'               => 'file',
        'attributes'         => array(
            'data-conditional-id'    => $prefix . 'overlay',
            'data-conditional-value' => 'yes',
        ),
        'options'            => array( 'add_upload_file_text' => 'Upload image' ),
    ) );
    // Overlay color
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Overlay color:', 'wordflex-jarallax' ),
        'desc'              => __( 'Default color is rgba(0,0,0,0.25). Ckick on (clear) if you don\'t need.', 'wordflex-jarallax' ),
        'id'                => $prefix . 'overlay_color',
        'type'              => 'colorpicker',
        'default'           => 'rgba(0,0,0,0.25)',
        'attributes'        => array(
            'data-conditional-id'    => $prefix . 'overlay',
            'data-conditional-value' => 'yes',
        ),
        'options'           => array( 'alpha' => true ),
    ) );
    // Title Break - Content
    $cmb_jarallax->add_field( array(
        'name'              => __('Background content', 'wordflex-jarallax'),
        'desc'              => __('Use the default WordPress Editor to add your content. Please note that the content will be always vertically centered.', 'wordflex-jarallax'),
        'type'              => 'title',
        'id'                => 'break_content',
    ) );
    // Content
    $cmb_jarallax->add_field( array(
        'name'              => __( 'Content:', 'wordflex-jarallax' ),
        'desc'              => __( 'Leave it empty to hide the content.', 'wordflex-jarallax' ),
        'id'                => $prefix . 'content',
        'type'              => 'wysiwyg',
    ) );
}
add_action( 'cmb2_init', 'WordFlex_Jarallax_CMB2' );
