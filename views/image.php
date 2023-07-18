<a-scene vr-mode-ui='enabled: false;' renderer="logarithmicDepthBuffer: true; precision: medium;" embedded
         arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;'>
    <?php // require_once __DIR__.'/assets.php';?>
    <a-nft type='nft' url='<?php echo $markerURL; ?>' smooth='true'
           smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>
        <?php // require_once __DIR__.'/show-object.php';?>
        <a-box position='0 0.5 0' color="yellow"></a-box>
    </a-nft>
    <a-entity camera></a-entity>
</a-scene>