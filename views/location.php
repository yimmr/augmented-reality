 <a-scene embedded vr-mode-ui="enabled: false"
          arjs="trackingMethod: best;sourceType: webcam; debugUIEnabled: true; detectionMode: mono_and_matrix; matrixCodeType: 3x3;">
     <?php require_once __DIR__.'/assets.php'; ?>
     <?php foreach ($pageData['items'] as $item) {?>
     <?php echo $arPage->buildObjectHTML($item); ?>
     <?php }?>
     <a-camera
               gps-camera<?php echo isset($pageData['slon'], $pageData['slat']) ? "=\"simulateLatitude: {$pageData['slon']}; simulateLongitude: {$pageData['slat']}\"" : ''; ?>
         rotation-reader></a-camera>
 </a-scene>