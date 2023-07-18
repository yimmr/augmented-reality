<?php

/* Template Name: ar_template */

use MyWPAR\ARPage;

require_once __DIR__.'/ARPage.php';

add_action('wp_ajax_pl_ar_new_page', 'pl_ar_new_page');
add_action('wp_ajax_nopriv_pl_ar_new_page', 'pl_ar_new_page');

$arPage = new ARPage;
$pageData = $arPage->getPageData(get_option('pl_ar_current_id'));

$lang = $gpsLocation['lang'] ?? 0;
$long = $gpsLocation['long'] ?? 0;

add_action('wp_enqueue_scripts', function () use ($type) {
    \wp_dequeue_script('aframe-ar');
    switch ($type) {
        case 'image':
            \wp_enqueue_script('aframe_min', PL_AR_LINK.'js/aframe-master.min.js'.[], '1.3.0');
            \wp_enqueue_script('aframe-ar-nft', PL_AR_LINK.'js/aframe-ar-nft.js');
            break;
        case 'location':
            \wp_enqueue_script('aframe_min', PL_AR_LINK.'js/aframe.min.js', [], '1.3.0');
            \wp_enqueue_script('aframe-look-at-component', PL_AR_LINK.'js/aframe-look-at-component.min.js', [], '0.8.0');
            \wp_enqueue_script('aframe-ar-nft', PL_AR_LINK.'js/aframe-ar-nft.js');
            break;
        case 'marker':
            \wp_enqueue_script('aframe_min', PL_AR_LINK.'js/aframe.min.js', [], '1.3.0');
            \wp_enqueue_script('aframe-ar', PL_AR_LINK.'js/aframe-ar.js');
            break;
        default:break;
    }
});

global $wpdb;
// check if id exists in table
$count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}pl_ar_table WHERE shortcode_id={$id_selector}");
if (0 == $count) {
    wp_die($message = 'No item with id:'.$id_selector.' exists');
}
// prepare the markers
$html_marker = json_encode($wpdb->get_results("SELECT markers FROM {$wpdb->prefix}pl_ar_table WHERE shortcode_id={$id_selector}"));
$html_marker = json_decode($html_marker, $assoc_array = true);
$html_marker = stripcslashes($html_marker[0]['markers']);
$html_marker = json_decode(str_replace("'", '"', $html_marker), true);

// prepare the objects
$html_object = json_encode($wpdb->get_results("SELECT objects FROM {$wpdb->prefix}pl_ar_table WHERE shortcode_id={$id_selector}"));
$html_object = json_decode($html_object, $assoc_array = true);
$html_object = stripcslashes($html_object[0]['objects']);
$html_object = json_decode(str_replace("'", '"', $html_object), true);

$makerIdxs = array_keys($html_marker);
