<script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1.3.0/dist/aframe-master.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
<a-scene vr-mode-ui="enabled: false;" renderer="logarithmicDepthBuffer: true; precision: medium;" embedded
         arjs="trackingMethod: best; sourceType: webcam;debugUIEnabled: false;">
    <a-nft type="nft" url="<?php echo $markerURL; ?>" smooth="true"
           smoothCount="10" smoothTolerance=".01" smoothThreshold="5">
        <a-entity gltf-model="<?php echo $objectURL; ?>"
                  scale="5 5 5" position="150 300 -100">
        </a-entity>
    </a-nft>
    <a-entity camera></a-entity>
</a-scene>
<?php return; ?>
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