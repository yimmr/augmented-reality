<!-- <script src="https://aframe.io/releases/1.3.0/aframe.min.js"></script>
<script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script> -->
<a-scene embedded vr-mode-ui="enabled: false"
         arjs="trackingMethod: best;sourceType: webcam; debugUIEnabled: true; detectionMode: mono_and_matrix; matrixCodeType: 3x3;">
    <?php require_once __DIR__.'/assets.php'; ?>
    <?php $objectAttrs = [
        'look-at'          => '[gps-camera]',
        'gps-entity-place' => 'latitude: 51.0491; longitude: -0.723;',
    ]; ?>
    <?php require_once __DIR__.'/show-object.php'; ?>
    <a-camera gps-camera='simulateLatitude: 51.049; simulateLongitude: -0.723' rotation-reader></a-camera>
</a-scene>
<?php return; ?>
<?php if ('jpg' == $object_type_ext || 'png' == $object_type_ext) { ?>
<a-image rotation="<?php echo $rotation; ?>"
         autoscale="<?php echo $autoscale; ?>"
         src="<?php echo $objectURL; ?>" look-at="[gps-camera]"
         gps-entity-place="latitude: <?php echo $lang; ?>; longitude: <?php echo $long; ?>;"></a-image>
<?php } elseif ('gltf' == $object_type_ext) { ?>
<a-entity rotation="<?php echo $rotation; ?>"
          autoscale="<?php echo $autoscale; ?>" position="0 0 0"
          animation-mixer
          gltf-model="#animated-asset<?php echo $objectId; ?>"
          look-at="[gps-camera]"
          gps-entity-place="latitude: <?php echo $lang; ?>; longitude: <?php echo $long; ?>;">
</a-entity>
<?php } ?>
<a-camera gps-camera rotation-reader> </a-camera>