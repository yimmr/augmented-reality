 <a-scene embedded arjs>
     <?php require_once __DIR__.'/assets.php'; ?>
     <?php foreach ($pageData['items'] as $item) {?>
     <a-marker preset="hiro">
         <?php echo $arPage->buildObjectHTML($item['object']); ?>
     </a-marker>
     <?php }?>
     <a-entity camera></a-entity>
 </a-scene>