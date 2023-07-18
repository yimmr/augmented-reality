 <a-scene embedded vr-mode-ui="enabled: false"
          arjs="trackingMethod: best;sourceType: webcam; debugUIEnabled: true; detectionMode: mono_and_matrix; matrixCodeType: 3x3;">
     <?php require_once __DIR__.'/assets.php'; ?>
     <?php foreach ($pageData['items'] as $item) {?>
     <?php echo $arPage->buildObjectHTML($item['object']); ?>
     <?php }?>
     <a-camera
               gps-camera<?php echo isset($pageData['slonlat']) ? "=\"simulateLatitude: {$pageData['slonlat'][1]}; simulateLongitude: {$pageData['slonlat'][0]}\"" : ''; ?>
         rotation-reader></a-camera>
 </a-scene>