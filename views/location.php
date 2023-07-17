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