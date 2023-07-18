<?php

add_filter('pl_wpar_page_current_data', function ($data) {
    $markers = ['examples/image-tracking/nft/trex/trex-image/trex'];
    $objects = ['examples/image-tracking/nft/trex/scene.gltf'];
    $data['type'] = 1 == $_GET['art'] ? 'image' : (2 == $_GET['art'] ? 'location' : 'marker');

    if ('location' == $data['type']) {
        $data['lonlat'] = $data['slonlat'] = '-0.723,51.049';
    }

    return $data;
});

require_once __DIR__.'/ar_template.php';
