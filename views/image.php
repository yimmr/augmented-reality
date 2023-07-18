<div class="arjs-loader">
    <div>Loading, please wait...</div>
</div>
<a-scene vr-mode-ui='enabled: false;' renderer="logarithmicDepthBuffer: true; precision: medium;" embedded
         arjs='trackingMethod: best; sourceType: webcam; debugUIEnabled: true;'>
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