<?php
if (!defined('ABSPATH')) {
    die();
}

global $avia_config;

$lightbox_option = avia_get_option('lightbox_active');
$avia_config['use_standard_lightbox'] = empty($lightbox_option) || ('lightbox_active' == $lightbox_option) ? 'lightbox_active' : 'disabled';
/**
 * Allow to overwrite the option setting for using the standard lightbox
 * Make sure to return 'disabled' to deactivate the standard lightbox - all checks are done against this string
 *
 * @added_by Günter
 * @since 4.2.6
 * @param string $use_standard_lightbox 'lightbox_active' | 'disabled'
 * @return string                                    'lightbox_active' | 'disabled'
 */
$avia_config['use_standard_lightbox'] = apply_filters('avf_use_standard_lightbox', $avia_config['use_standard_lightbox']);

$style = $avia_config['box_class'];
$responsive = avia_get_option('responsive_active') != "disabled" ? "responsive" : "fixed_layout";
$blank = isset($avia_config['template']) ? $avia_config['template'] : "";
$av_lightbox = $avia_config['use_standard_lightbox'] != "disabled" ? 'av-default-lightbox' : 'av-custom-lightbox';
$preloader = avia_get_option('preloader') == "preloader" ? 'av-preloader-active av-preloader-enabled' : 'av-preloader-disabled';
$sidebar_styling = avia_get_option('sidebar_styling');
$filterable_classes = avia_header_class_filter(avia_header_class_string());
$av_classes_manually = "av-no-preview"; /*required for live previews*/

/**
 * Allows to alter default settings Enfold-> Main Menu -> General -> Menu Items for Desktop
 * @since 4.4.2
 */
$is_burger_menu = apply_filters('avf_burger_menu_active', avia_is_burger_menu(), 'header');
$av_classes_manually .= $is_burger_menu ? " html_burger_menu_active" : " html_text_menu_active";

/**
 * Add additional custom body classes
 * e.g. to disable default image hover effect add av-disable-avia-hover-effect
 *
 * @since 4.4.2
 */
$custom_body_classes = apply_filters('avf_custom_body_classes', '');

/**
 * @since 4.2.3 we support columns in rtl order (before they were ltr only). To be backward comp. with old sites use this filter.
 */
$rtl_support = 'yes' == apply_filters('avf_rtl_column_support', 'yes') ? ' rtl_columns ' : '';

?><!DOCTYPE html>
<html <?php language_attributes(); ?>
        class="<?php echo "html_{$style} " . $responsive . " " . $preloader . " " . $av_lightbox . " " . $filterable_classes . " " . $av_classes_manually ?> ">
<head>
    <meta charset="<?php bloginfo('charset'); ?>"/>
    <?php
    /*
     * outputs a rel=follow or nofollow tag to circumvent google duplicate content for archives
     * located in framework/php/function-set-avia-frontend.php
     */
    if (function_exists('avia_set_follow')) {
        echo avia_set_follow();
    }

    ?>


    <!-- mobile setting -->
    <?php

    if (strpos($responsive, 'responsive') !== false) echo '<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">';
    ?>


    <!-- Scripts/CSS and wp_head hook -->
    <?php
    /* Always have wp_head() just before the closing </head>
     * tag of your theme, or you will break many plugins, which
     * generally use this hook to add elements to <head> such
     * as styles, scripts, and meta tags.
     */

    wp_head();

    ?>
    <style type="text/css">
        .box-download-post {
            background: #f8f8f8;
            padding: 5px 12px;
            margin-top: 15px;
            margin-bottom: 20px;
            border: 1px solid #e5e5e5 !important;
            font-size: 14px;
            float: left;
            width: 100%;
        }

        .box-download-post b {
            color: #145883;
        }

        /* Đây là phần ae mình làm ở cafe */
        .wpml-ls-statics-post_translations {
            display: none;
        }

        ul.wg-pk-ctdh-ul {
            margin-bottom: 14px;
            list-style: none;
        }

        ul.wg-pk-ctdh-ul li {
            width: 300px;
            height: 30px;
            margin: 0 0 7px 0;
        }

        ul.wg-pk-ctdh-ul li a {
            display: block;
            margin: 0 0 7px 0;
            background: #F7F5F2 center no-repeat;
            font-size: 18px;
            color: #333;
            padding: 5px 0 0 5px;
            text-decoration: none;
        }

        ul.wg-pk-ctdh-ul li a:hover {
            background-color: #EFEFEF;
        }

        .orange {
            border-left: 5px solid #F5876E !important;
        }

        .blue {
            border-left: 5px solid #61A8DC !important;
        }

        .green {
            border-left: 5px solid #8EBD40 !important;
        }

        .purple {
            border-left: 5px solid #988CC3 !important;
        }

        #custom_html-2 h3.widgettitle, #custom_html-3 h3.widgettitle, #custom_html-4 h3.widgettitle {
            padding: 10px 5px;
            text-align: center;
            background: linear-gradient(to bottom right, #145882, #981c33);
            color: #fff;
            border-top-left-radius: 10px;
            border-top-right-radius: 10px;
        }

        #box-btn-contact-right {
            position: fixed;
            top: 100px;
            right: 0px;
            background: #eb2227;
            z-index: 9999;
            border-radius: 5px;
            border-top-right-radius: 0px;
            border-bottom-right-radius: 0px;
            text-align: center;
        }

        #box-btn-contact-right a {
            color: white;
            padding: 3px 10px;
            float: left;
            font-size: 10px;
        }

        #box-btn-contact-right a:hover, #box-btn-contact-right a:focus, #box-btn-contact-right a:active {
            text-decoration: none;
        }

        #content-popup-contact {
            display: none;
            top: 100px;
            left: 0px;
            width: 100%;
            z-index: 99999;
            position: fixed;
        }

        #content-popup-contact #content-popup-contact-detail {
            margin: auto;
            width: 100%;
            max-width: 380px;
            background: white;
            position: relative;
            padding: 10px;
        }

        #content-popup-contact #content-popup-contact-detail h2 {
            font-size: 17px;
            font-weight: 500;
            background: #145782;
            color: white;
            margin-top: -10px;
            margin-left: -10px;
            width: calc(100% + 20px);
            padding: 12px 10px;
        }

        #content-popup-contact #content-popup-contact-detail label {
            color: black !important;
            font-weight: 500;
            font-size: 13px;
        }

        #btn-close-popup {
            position: absolute;
            top: 8px;
            right: 12px;
        }

        #btn-close-popup span {
            color: white;
        }

        #btn-close-popup:active, #btn-close-popup:focus, #btn-close-popup:hover {
            text-decoration: none;
        }

        #content-popup-contact.active {
            display: block;
        }

        #overlay-popup {
            top: 0px;
            left: 0px;
            position: fixed;
            width: 100%;
            height: 100%;
            background: black;
            opacity: 0.7;
            z-index: 9999;
            display: none;
        }

        #overlay-popup.show {
            display: block;
        }

        #nav-mobile-footer {
            width: 100%;
            bottom: 0px;
            left: 0px;
            padding: 10px 0px;
            background: #00000073;
            position: fixed;
            z-index: 9999;
            display: none;
        }

        #nav-mobile-footer .item-btn-footer {
            float: left;
            width: calc(33.333% - 10px);
            margin-left: 5px;
            margin-right: 5px;
            color: white;
            font-weight: 600;
            font-size: 14px;
            text-align: center;
            border-radius: 3px;
            padding: 10px;
        }

        #nav-mobile-footer .item-btn-footer:hover, #nav-mobile-footer .item-btn-footer:focus, #nav-mobile-footer .item-btn-footer:active {
            text-decoration: none;
        }

        #nav-mobile-footer .item-btn-footer span {
            padding-right: 6px;
        }

        #nav-mobile-footer .item-btn-footer.item-btn-footer-fb {
            background: #002147;
        }

        #nav-mobile-footer .item-btn-footer.item-btn-footer-call {
            background: #d00;
        }

        #nav-mobile-footer .item-btn-footer.item-btn-footer-zalo {
            background: #002147;
        }

        @media only screen and (max-width: 768px) {
            #nav-mobile-footer {
                display: block;
            }
        }

        @media only screen and (max-width: 385px) {
            #nav-mobile-footer .item-btn-footer {
                font-size: 12px;
            }

            #nav-mobile-footer .item-btn-footer span {
                padding-right: 3px;
            }
        }

        #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div {
            display: none;
        }

        #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div + div {
            margin-left: 0px !important;
        }

        #section-box-home .av_one_fourth {
            width: 29.3% !important;
            margin-left: 6% !important;
            margin-bottom: 50px;
        }

        .page-id-3688 .av-active-tab-title,
        .page-id-3688 .av-active-tab-title span,
        .page-id-4034 .av-active-tab-title,
        .page-id-4034 .av-active-tab-title span,
        .av-tab-no-icon.av-tab-no-image:hover{
            background: #1c446f !important;
            color: white !important;
        }

        .page-id-3688 .av-tab-section-tab-title-container,
        .page-id-4034 .av-tab-section-tab-title-container {
            margin-top: 0px !important;
            padding-top: 0px !important;
        }

        .page-id-3688 .av-tab-arrow-container,
        .page-id-4034 .av-tab-arrow-container {
            display: none;
        }

        .page-id-3688 .av-tab-no-icon.av-tab-no-image .av-inner-tab-title,
        .page-id-4034 .av-tab-no-icon.av-tab-no-image .av-inner-tab-title {
            margin-bottom: 15px;
        }

        @media only screen and (max-width: 990px) {
            #section-box-home {
                margin-bottom: -50px !important;
            }

            #section-box-home-2 .container:after {
                display: none !important;
            }

            #section-box-home-2 .container {
                background: linear-gradient(45deg, #145882, #981c33);
                width: 100% !important;
                max-width: 100% !important;
                padding: 0px 20px !important;
            }

            #section-box-home-2 .container .template-page {
                padding-top: 0px !important;
                padding-bottom: 0px !important;
            }

            #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div {
                display: block;
                margin-bottom: 50px !important;
            }

            #section-box-home-2 {
                background: linear-gradient(45deg, #145882, #981c33) !important;
                background-image: none !important;
            }

            #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div + div + div {
                display: none;
            }

            #section-box-home .av_one_fourth {
                width: 100% !important;
                margin-bottom: 30px !important;
                margin-left: 0px !important;
            }

            #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div + div,
            #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div + div + div + div {
                margin-left: -40px !important;
                width: calc(100% + 80px) !important;
            }
        }

        @media only screen and (max-width: 625px) {
            #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div + div,
            #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div + div + div + div {
                margin-left: -15px !important;
                width: calc(100% + 30px) !important;
            }
        }

        @media only screen and (max-width: 360px) {
            #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div + div,
            #section-box-home .template-page .entry-content-wrapper.clearfix > div:first-child + div + div + div + div + div {
                margin-left: -12px !important;
                width: calc(100% + 24px) !important;
            }
        }

        /* đây là phần response */
        p.wpml-ls-statics-post_translations {
            display: none;
        }

        @media only screen and (max-width: 768px) {
            .home.page-template-default #av_section_1 > .container {
                width: 100% !important;
                max-width: 100% !important;
            }

            .home.page-template-default #av_section_1 > .container .flex_column.av_one_third.flex_column_div.first.avia-builder-el-4 {
                margin-bottom: 25px !important;
            }

            .home.page-template-default #av_section_1 > .container .hr.hr-invisible.avia-builder-el-7.el_after_av_slideshow.el_before_av_button,
            .home.page-template-default #av_section_1 > .container .hr.hr-invisible.avia-builder-el-17.el_after_av_video.el_before_av_button {
                height: 0px !important;
            }

            .home.page-template-default #av_section_2 {
                margin-top: 110px !important;
            }

            .home.page-template-default #av_section_2 .template-page.content.av-content-full {
                padding-top: 35px !important;
                padding-bottom: 35px !important;

            }

            .home.page-template-default #av_section_2 img.avia_image,
            .home.page-template-default #av_section_2 .avia-image-container-inner {
                width: 100% !important;
            }

            .page-id-1195 #av-layout-grid-1 .flex_cell.no_margin.av_one_half.avia-builder-el-16.el_before_av_cell_one_half,
            .page-id-4036 #av-layout-grid-1 .flex_cell.no_margin.av_one_half.avia-builder-el-16.el_before_av_cell_one_half {
                padding-top: 70px !important;
            }

            .page-id-1195 #av-layout-grid-1 .flex_cell.no_margin.av_one_half.avia-builder-el-16.el_before_av_cell_one_half h3,
            .page-id-4036 #av-layout-grid-1 .flex_cell.no_margin.av_one_half.avia-builder-el-16.el_before_av_cell_one_half h3 {
                line-height: 58px;
            }

            .page-id-1195 #av-layout-grid-1 .flex_cell.no_margin.av_one_half.avia-builder-el-16.el_before_av_cell_one_half .avia-animated-number,
            .page-id-4036 #av-layout-grid-1 .flex_cell.no_margin.av_one_half.avia-builder-el-16.el_before_av_cell_one_half .avia-animated-number {
                margin-bottom: 20px !important;
            }

            .page-id-1195 #av-layout-grid-1 .flex_cell.no_margin.av_one_half.avia-builder-el-16.el_before_av_cell_one_half .avia-animated-number div.avia-animated-number-content,
            .page-id-4036 #av-layout-grid-1 .flex_cell.no_margin.av_one_half.avia-builder-el-16.el_before_av_cell_one_half .avia-animated-number div.avia-animated-number-content {
                margin-top: 10px;
                margin-bottom: 30px;
            }

            .page-id-1195 .av-subheading.av-subheading_below.av_custom_color,
            .page-id-4036 .av-subheading.av-subheading_below.av_custom_color {
                margin-top: 15px !important;
            }

            .page-id-3747 .flex_cell,
            .page-id-4053 .flex_cell,
            .page-id-3526 .flex_cell,
            .page-id-4038 .flex_cell,
            .page-id-3607 .flex_cell,
            .page-id-4050 .flex_cell,
            .page-id-3561 .flex_cell,
            .page-id-4048 .flex_cell {
                min-height: 0px !important;
            }

            .page-id-3747 .avia-content-slider .slide-entry-title,
            .page-id-4053 .avia-content-slider .slide-entry-title {
                margin-top: 12px !important;
            }

            .page-id-3688 #av-tab-section-1 .flex_column.av_two_fifth,
            .page-id-4034 #av-tab-section-1 .flex_column.av_two_fifth {
                background: white !important;
                color: black !important;
            }

            .page-id-3688 #av-tab-section-1 .flex_column.av_two_fifth h3,
            .page-id-4034 #av-tab-section-1 .flex_column.av_two_fifth h3 {
                color: black !important;
            }

            .w-50 {
                width: 100% !important;
                margin-bottom: 35px !important;
            }

            .description-branch .w-50 {
                margin-bottom: 0px !important;
            }
        }

    </style>
</head>


<body id="top" <?php body_class($custom_body_classes . ' ' . $rtl_support . $style . " " . $avia_config['font_stack'] . " " . $blank . " " . $sidebar_styling);
avia_markup_helper(array('context' => 'body')); ?>>

<?php

/**
 * WP 5.2 add a new function - stay backwards compatible with older WP versions and support plugins that use this hook
 * https://make.wordpress.org/themes/2019/03/29/addition-of-new-wp_body_open-hook/
 *
 * @since 4.5.6
 */
if (function_exists('wp_body_open')) {
    wp_body_open();
} else {
    do_action('wp_body_open');
}

do_action('ava_after_body_opening_tag');

if ("av-preloader-active av-preloader-enabled" === $preloader) {
    echo avia_preload_screen();
}

?>

<div id='wrap_all'>

    <?php
    if (!$blank) //blank templates dont display header nor footer
    {
        //fetch the template file that holds the main menu, located in includes/helper-menu-main.php
        get_template_part('includes/helper', 'main-menu');

    } ?>

    <div id='main' class='all_colors' data-scroll-offset='<?php echo avia_header_setting('header_scroll_offset'); ?>'>

<?php

if (isset($avia_config['temp_logo_container'])) echo $avia_config['temp_logo_container'];
do_action('ava_after_main_container');
		
