<a-scene vr-mode-ui='enabled: false;' renderer="logarithmicDepthBuffer: true; precision: medium;" embedded
         arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;'>
    <?php require_once 'assets.php'; ?>
    <a-nft type='nft' url='<?php echo $markerURL; ?>' smooth='true'
           smoothCount='10' smoothTolerance='0.01' smoothThreshold='5'>
        <?php require_once 'show-object.php'; ?>
    </a-nft>
    <a-entity camera></a-entity>
</a-scene>