 <a-scene embedded vr-mode-ui="enabled: false">
       <?php require_once __DIR__.'/assets.php'; ?>
       <?php foreach ($pageData['items'] as $item) {?>
       <?php echo $arPage->buildObjectHTML($item['object']); ?>
       <?php }?>
       <a-camera
                 gps-camera<?php echo isset($pageData['slonlat']) ? "=\"simulateLatitude: {$pageData['slonlat'][1]}; simulateLongitude: {$pageData['slonlat'][0]}\"" : ''; ?>
             rotation-reader></a-camera>
 </a-scene>