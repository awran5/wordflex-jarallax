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
 * Load shortcode arguments
 */
require_once 'wordflex-jarallax-shortcode-arg.php';

/**
 * jarallax Shortcode
 */
add_shortcode( 'jarallax', function( $attr, $content = '' ) {

    $attr = shortcode_atts( 
        array( 
            'id' => get_the_ID()
        ), $attr );
    // Get current jarallax post ID
    $id = esc_attr($attr['id']);  
    $prefix  = 'cmb_jarallax_';
        
    $bg_type = get_post_meta( $id, $prefix . 'bg_type', true );     
    $jarallaxSource = '';

    if( !empty($bg_type) ) {

        $height = get_post_meta( $id, $prefix . 'height', true );
        $height = is_numeric($height) && !empty($height) ? 'height: ' . $height . 'px;' : '';

        if( $bg_type === 'image' ) {
            $img = get_post_meta( $id, $prefix . 'bg_img_src', true );
            $jarallaxSource = !empty($img) ? 'style="background-image: url(' . esc_url($img) . '); ' . $height . '"' : '';
        }

        elseif ( $bg_type === 'self' ) {
            $poster = get_post_meta( $id, $prefix . 'self_video_poster', true );
            $poster = !empty($poster) ? 'style="background-image: url(' . esc_url($poster) . '); ' . $height . '"' : '';
            
            $mp4    = get_post_meta( $id, $prefix . 'self_mp4_src', true );
            $webm   = get_post_meta( $id, $prefix . 'self_webm_src', true );

            $video = '';
            if( !empty($mp4) && empty($webm) ) {
                $video = 'data-jarallax-video="mp4:' . esc_url($mp4) . '';
            }
            elseif ( empty($mp4) && !empty($webm) ) {
                $video = 'data-jarallax-video="webm:' . esc_url($webm) . '';
            }
            elseif ( !empty($mp4) && !empty($webm) ) {
                $video = 'data-jarallax-video="mp4:' . esc_url($mp4) . ',webm:' . esc_url($webm) . '';
            }           
            $jarallaxSource = $poster . $video . '"';
        }

        elseif ( $bg_type === 'embed' ) {
            $online = get_post_meta( $id, $prefix . 'bg_online_src', true );
            $style = !empty($height) ? ' style="' . $height . '"' : '';
            $jarallaxSource = !empty($online) ? 'data-jarallax-video="' . esc_url($online) . '" ' . $style . '' : '';
        }
    }  

    // Parallax options
    $ParallaxType   = get_post_meta( $id, $prefix . 'parallax_type', true );
    $ParallaxSpeed  = get_post_meta( $id, $prefix . 'parallax_speed', true );
    // Mobile options
    $mobileParallax = get_post_meta( $id, $prefix . 'mobile_parallax', true );
    // Video options
    $mobileVideo    = get_post_meta( $id, $prefix . 'mobile_video', true );
    $videoStart     = get_post_meta( $id, $prefix . 'video_start_time', true );
    $videoStartTime = is_numeric($videoStart) ? $videoStart : 0;
    $videoEnd       = get_post_meta( $id, $prefix . 'video_end_time', true );
    $videoEndTime   = is_numeric($videoEnd) ? $videoEnd : 0;
    $videoVolume    = get_post_meta( $id, $prefix . 'volume', true );
    // Overlay
    $overlayBG      = get_post_meta( $id, $prefix . 'overlay_bg', true );
    $overlayColor   = get_post_meta( $id, $prefix . 'overlay_color', true );
    $overlay        = get_post_meta( $id, $prefix . 'overlay', true );
    // Content
    $content        = get_post_meta( $id, $prefix . 'content', true );

    ob_start();
    ?>
    <!-- Start Jarallax Background -->
    <div class="section-jarallax">
        <div class="jarallax" <?php echo $jarallaxSource ?>>
            <?php if( $overlay === 'yes' && ( !empty($overlayBG) || !empty($overlayColor) ) ) { 
                $overlayBG    = !empty($overlayBG) ? 'background-image: url(' . esc_url($overlayBG) . ');' : '';
                $overlayColor = !empty($overlayColor) ? 'background-color:' . esc_html($overlayColor) . ';' : '';
                echo '<div class="jarallax-overlay" style="' . $overlayColor . '' . $overlayBG . '"></div>';
            } ?>
            <div class="jarallax-content">
                <div class="container">
                    <?php if( !empty( $content ) ) echo $content; ?>
                </div>
            </div>
        </div>
    </div>
    <!-- End Jarallax Background -->
    <!-- Start Jarallax script -->
    <script>
        (function($){
            $('.jarallax').jarallax({
                type: '<?php echo $ParallaxType ?>',
                speed: <?php echo !empty($ParallaxSpeed) ? $ParallaxSpeed : 0.2 ?>,
                <?php echo ($mobileParallax === 'no') ? 'disableParallax: /iPad|iPhone|iPod|Android/, ' : ''; ?>
                <?php if($bg_type === 'self' || $bg_type === 'embed') {
                    echo ($mobileVideo === 'no') ? 'disableVideo: /iPad|iPhone|iPod|Android/, ' : '';
                    echo !empty( $videoVolume ) ? 'videoVolume: ' . $videoVolume . ', ' : '';
                    echo !empty( $videoStartTime ) ? 'videoStartTime: ' . $videoStartTime . ', ' : '';
                    echo !empty( $videoEndTime ) ? 'videoEndTime: ' . $videoEndTime . ', ' : '';
                } ?>
            });
        })(jQuery);
    </script>
    <!-- End Jarallax script -->
    <?php
    return ob_get_clean();
});

add_filter( 'the_content', 'wordflex_jarallax_shortcode_fix' );
/**
 * Filters the content to remove any extra paragraph or break tags
 * caused by shortcodes.
 *
 * @since 1.0.0
 *
 * @param string $content  String of HTML content.
 * @return string $content Amended string of HTML content.
 */
function wordflex_jarallax_shortcode_fix( $content ) {
 
    $array = array(
        '<p>['    => '[',
        ']</p>'   => ']',
        ']<br />' => ']'
    );
    return strtr( $content, $array );
 
}