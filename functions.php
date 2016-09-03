<?php
/**
 * @name Functions
 * @description Wordpress theme default functions file
 * @version     1.0.0
 * @author      mufeng (http://mufeng.me)
 * @url https://mufeng.me/wordpress-mobile-theme-kunkka.html
 * @package     Kunkka
 **/

/**
 * Define constants
 */
define( 'MUTHEME_NAME', 'Kunkka' );
define( 'MUTHEME_VERSION', '1.0.6' );
define( 'MUTHEME_PATH', dirname( __FILE__ ) );
define( "MUTHEME_THEME_URL", get_bloginfo( 'template_directory' ) );

/**
 * Import core function files
 */
get_template_part( 'functions/mutheme-basic' );
get_template_part( 'functions/mutheme-function' );
get_template_part( 'functions/mutheme-widget' );
get_template_part( 'functions/mutheme-main' );

/**
 * Add rss feed
 */
add_theme_support( 'automatic-feed-links' );

/**
 * Enable link manager
 */
add_filter( 'pre_option_link_manager_enabled', '__return_true' );

/**
 * Add post thumbnail
 */
add_theme_support( 'post-thumbnails' );

/**
 * Disable symbol automatically converted to full ban
 */
remove_filter( 'the_content', 'wptexturize' );

/**
 * Remove invalid information display at head tag
 */
remove_action( 'wp_head', 'rsd_link' );
remove_action( 'wp_head', 'wlwmanifest_link' );
remove_action( 'wp_head', 'wp_generator' );
remove_action( 'wp_head', 'start_post_rel_link' );
remove_action( 'wp_head', 'index_rel_link' );
remove_action( 'wp_head', 'adjacent_posts_rel_link' );

/**
 * Remove default wordpress widgets
 */
if( !mutheme_settings('register_widget') ){
    add_action( 'widgets_init', 'mutheme_unregister_default_widgets', 1 );
}
function mutheme_unregister_default_widgets() {
    unregister_widget( 'WP_Widget_Pages' );
    unregister_widget( 'WP_Widget_Calendar' );
    unregister_widget( 'WP_Widget_Archives' );
    unregister_widget( 'WP_Widget_Links' );
    unregister_widget( 'WP_Widget_Meta' );
    unregister_widget( 'WP_Widget_Search' );
    unregister_widget( 'WP_Widget_Text' );
    unregister_widget( 'WP_Widget_Categories' );
    unregister_widget( 'WP_Widget_Recent_Posts' );
    unregister_widget( 'WP_Widget_Recent_Comments' );
    unregister_widget( 'WP_Widget_RSS' );
    unregister_widget( 'WP_Nav_Menu' );
    unregister_widget( 'WP_Widget_Tag_Cloud' );
}

/**
 * Post thumbnail custom sizes
 */
if ( function_exists( 'add_image_size' ) ) {
    add_image_size( 'index-thumbnail', 250, 250, true );
}

/**
 * Register wordpress menu
 */
if ( function_exists( 'register_nav_menus' ) ) {
    register_nav_menus( array(
        'top-menu'    => __( 'Top menu', MUTHEME_NAME ),
        'global-menu' => __( 'Dropdown menu', MUTHEME_NAME )
    ) );
}

/**
 * Register sidebar
 */
if ( function_exists( 'register_sidebar' ) ) {
    register_sidebar( array(
        'name'          => 'sidebar',
        'id'            => 'sidebar-page',
        'before_widget' => '<div></div>',
        'before_title'  => '<h1>',
        'after_title'   => '</h1>'
    ) );
}

/**
 * Register theme languages files
 */
load_theme_textdomain( MUTHEME_NAME, mutheme_path( 'languages' ) );

/**
 * Plugin Name: Add Custom Smilies
 * Plugin URI: http://zhuli.me/2012/05/04/add-custom-smilies-to-wordpress.html
 * Description: Add More Smilies to your WP.
 * Version: 0.0.1
 * Author: Leigh
 * Author URI: http://zhuli.me/
 */
function evolz_smilies_init() {
    global $wpsmiliestrans, $wp_smiliessearch, $wp_smiliesreplace;

    // don't bother setting up smilies if they are disabled
    if ( !get_option( 'use_smilies' ) )
        return;

    if ( !isset( $wpsmiliestrans ) ) {
        $wpsmiliestrans = array(
                ':mrgreen:' => 'icon_mrgreen.png',
                ':neutral:' => 'icon_neutral.png',
                ':twisted:' => 'icon_twisted.png',
                  ':arrow:' => 'icon_arrow.png',
                  ':shock:' => 'icon_eek.png',
                  ':smile:' => 'icon_smile.png',
                    ':???:' => 'icon_confused.png',
                   ':cool:' => 'icon_cool.png',
                   ':evil:' => 'icon_evil.png',
                   ':grin:' => 'icon_biggrin.png',
                   ':idea:' => 'icon_idea.png',
                   ':oops:' => 'icon_redface.png',
                   ':razz:' => 'icon_razz.png',
                   ':roll:' => 'icon_rolleyes.png',
                   ':wink:' => 'icon_wink.png',
                    ':cry:' => 'icon_cry.png',
                    ':eek:' => 'icon_surprised.png',
                    ':lol:' => 'icon_lol.png',
                    ':mad:' => 'icon_mad.png',
                    ':sad:' => 'icon_sad.png',
                      '8-)' => 'icon_cool.png',
                      '8-O' => 'icon_eek.png',
                      ':-(' => 'icon_sad.png',
                      ':-)' => 'icon_smile.png',
                      ':-?' => 'icon_confused.png',
                      ':-D' => 'icon_biggrin.png',
                      ':-P' => 'icon_razz.png',
                      ':-o' => 'icon_surprised.png',
                      ':-x' => 'icon_mad.png',
                      ':-|' => 'icon_neutral.png',
                      ';-)' => 'icon_wink.png',
                       //'8)' => 'icon_cool.png',
                       //'8O' => 'icon_eek.png',
                       ':(' => 'icon_sad.png',
                       ':)' => 'icon_smile.png',
                       ':?' => 'icon_confused.png',
                       ':D' => 'icon_biggrin.png',
                       ':P' => 'icon_razz.png',
                       ':o' => 'icon_surprised.png',
                       ':x' => 'icon_mad.png',
                       ':|' => 'icon_neutral.png',
                       ';)' => 'icon_wink.png',
                      ':!:' => 'icon_exclaim.png',
                      ':?:' => 'icon_question.png',
        );
    }
    $siteurl = get_option( 'siteurl' );
    foreach ( (array) $wpsmiliestrans as $smiley => $img ) {
    $wp_smiliessearch[] = '/(\s|^)' . preg_quote( $smiley, '/' ) . '(\s|$)/';
    $smiley_masked = attribute_escape( trim( $smiley ) );
    $wp_smiliesreplace[] = " <img src='$siteurl/wp-content/themes/Kunkka/smiley/$img' alt='$smiley_masked' class='wp-smiley' /> ";
    }
}

remove_action('init', 'smilies_init', 5);
add_action('init', 'evolz_smilies_init', 5);

/**
 * Plugin Name: Custom Smilies Src
 * Plugin URI: http://fairyfish.net/m/custom_smilies_src/
 * Description: Custome Smiles Src
 * Version: 0.1
 * Author: Denis
 * Author URI: http://fairyfish.net/
 */
add_filter('smilies_src','custom_smilies_src',1,10);
function custom_smilies_src ($img_src, $img, $siteurl){
    return $siteurl.'/wp-content/themes/Kunkka/smiley/'.$img;
}

//替换Gavatar头像地址
function get_ssl_avatar($avatar) {
    if (preg_match_all(
        '/(src|srcset)=["\']https?.*?\/avatar\/([^?]*)\?s=([\d]+)&([^"\']*)?["\']/i',
        $avatar,
        $matches
    ) > 0) {
        $url = 'https://secure.gravatar.com';
        $size = $matches[3][0];
        $vargs = array_pad(array(), count($matches[0]), array());
        for ($i = 1; $i < count($matches); $i++) {
            for ($j = 0; $j < count($matches[$i]); $j++) {
                $tmp = strtolower($matches[$i][$j]);
                $vargs[$j][] = $tmp;
                if ($tmp == 'src') {
                    $size = $matches[3][$j];
                }
            }
        }
        $buffers = array();
        foreach ($vargs as $varg) {
            $buffers[] = vsprintf(
            '%s="%s/avatar/%s?s=%s&%s"',
            array($varg[0], $url, $varg[1], $varg[2], $varg[3])
           );
        }
        return sprintf(
                '<img alt="avatar" %s class="avatar avatar-%s" height="%s" width="%s" />',
                implode(' ', $buffers), $size, $size, $size
            );
    } else {
        return false;
    }
}
add_filter('get_avatar', 'get_ssl_avatar');
