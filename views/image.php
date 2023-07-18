<script src="https://cdn.jsdelivr.net/gh/aframevr/aframe@1.3.0/dist/aframe-master.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
<div class="arjs-loader">
    <div>Loading, please wait...</div>
</div>
<a-scene vr-mode-ui='enabled: false;' renderer="logarithmicDepthBuffer: true; precision: medium;" embedded
         arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: false;'>
    <?php require_once __DIR__.'/assets.php'; ?>
    <?php foreach ($pageData['items'] as $item) {?>
    <a-nft type="nft"
           url="https://ar-js-org.github.io/.github/profile/aframe/examples/image-tracking/nft/trex/trex-image/trex"
           smooth="true" smoothCount="10" smoothTolerance=".01" smoothThreshold="5">
        <?php echo $arPage->buildObjectHTML($item['object']); ?>
    </a-nft>
    <?php }?>
    <a-entity camera></a-entity>
</a-scene>