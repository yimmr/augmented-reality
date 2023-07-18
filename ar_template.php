<?php

use MyWPAR\ARPage;

require_once __DIR__.'/ARPage.php';

$arPage = new ARPage;
$pageData = $arPage->getPageCurrentData();
$type = $pageData['type'];

if (empty($type)) {
    wp_die('Server Error');
}

add_action('wp_ajax_pl_ar_new_page', 'pl_ar_new_page');
add_action('wp_ajax_nopriv_pl_ar_new_page', 'pl_ar_new_page');

add_action('wp_enqueue_scripts', function () use ($type) {
    \wp_dequeue_script('aframe-ar');
    \wp_dequeue_script('aframe_min');
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

    // wp_enqueue_script('aframe-extras', PL_AR_LINK.'js/aframe-extras.loaders.min.js');
    // wp_enqueue_script( 'aframe-resize', PL_AR_LINK.'js/resize.js' );
});

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
    <?php wp_head(); ?>
</head>

<body style='margin: 0; overflow: hidden;'>
    <?php require_once 'views/'.$type.'.php'; ?>
</body>

</html>