<?php
$id_selector = get_option('pl_ar_current_id');
$autoscale = get_option('pl_ar_current_scale');
$rotation = get_option('pl_ar_current_rotation');
$type = get_option('pl_ar_current_type');
$gpsLocation = get_option('pl_ar_current_gps_location');

$lang = $gpsLocation['lang'] ?? 0;
$long = $gpsLocation['long'] ?? 0;

add_action('wp_enqueue_scripts', function () use ($type) {
    \wp_dequeue_script('aframe-ar');
    switch ($type) {
        case 'image':
            \wp_enqueue_script('aframe_min', PL_AR_LINK.'js/aframe-master.min.js', [], '1.3.0');
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

$html_marker = ['examples/image-tracking/nft/trex/trex-image/trex'];
$html_object = ['examples/image-tracking/nft/trex/scene.gltf'];

$type = 1 == $_GET['art'] ? 'image' : (2 == $_GET['art'] ? 'location' : 'marker');

$makerIdxs = array_keys($html_marker);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <title>Document</title>
    <?php wp_head(); ?>
</head>

<body style='margin : 0px; overflow: hidden;'>
    <?php foreach ($makerIdxs as $objectId) {
        $path_parts = pathinfo($html_object[$objectId]);
        $object_type_ext = $path_parts['extension'];
        $markerURL = PL_AR_LINK.$html_marker[$objectId];
        $objectURL = PL_AR_LINK.$html_object[$objectId];
        require_once 'views/'.$type.'.php';
    } ?>
</body>

</html>