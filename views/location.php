<script src="https://aframe.io/releases/1.3.0/aframe.min.js"></script>
<script src="https://unpkg.com/aframe-look-at-component@0.8.0/dist/aframe-look-at-component.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar-nft.js"></script>
<a-scene vr-mode-ui="enabled: false" arjs="sourceType: webcam; videoTexture: true; debugUIEnabled: false;">
    <a-text value="This content will always face you." look-at="[gps-new-camera]" scale="120 120 120"
            gps-new-entity-place="latitude: 30; longitude: 30;"></a-text>
    <a-camera gps-new-camera="simulateLatitude:30; simulateLongitude:30;" rotation-reader> </a-camera>
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