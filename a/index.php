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
?>
<script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1.3.0/dist/aframe-master.min.js"></script>
<style>
  .arjs-loader {
    height: 100%;
    width: 100%;
    position: absolute;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.8);
    z-index: 9999;
    display: flex;
    justify-content: center;
    align-items: center;
  }

  .arjs-loader div {
    text-align: center;
    font-size: 1.25em;
    color: white;
  }
</style>
<!-- rawgithack development URL -->
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>

<body style='margin : 0px; overflow: hidden;'>
  <!-- minimal loader shown until image descriptors are loaded -->
  <div class="arjs-loader">
    <div>Loading, please wait...</div>
  </div>
  <a-scene vr-mode-ui='enabled: false;' renderer="logarithmicDepthBuffer: true; precision: medium;" embedded
           arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;'>
    <!-- use rawgithack to retrieve the correct url for nft marker (see 'trex' below) -->
    <a-nft type='nft'
           url='<?php echo PL_AR_LINK; ?>examples/image-tracking/nft/trex/trex-image/trex'
           smooth='true' smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>
      <a-entity gltf-model='<?php echo PL_AR_LINK; ?>file_manager/objects/nes_controller/scene.gltf'
                scale="5 5 5" position="150 300 -100">
      </a-entity>
    </a-nft>
    <a-entity camera></a-entity>
  </a-scene>
</body>