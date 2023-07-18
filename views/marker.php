<?php if ('jpg' == $object_type_ext || 'png' == $object_type_ext) { ?>
<a-marker type="pattern" url="<?php echo $markerURL; ?>">
    <a-image rotation="<?php echo $rotation; ?>"
             autoscale="<?php echo $autoscale; ?>"
             src="<?php echo $objectURL; ?>"></a-image>
</a-marker>
<?php } elseif ('gltf' == $object_type_ext) { ?>
<a-marker id="animated-marker" type="pattern"
          url="<?php echo $markerURL; ?>">
    <a-entity rotation="<?php echo $rotation; ?>"
              autoscale="<?php echo $autoscale; ?>" position="0 0 0"
              animation-mixer
              gltf-model="#animated-asset<?php echo $objectId; ?>">
    </a-entity>
</a-marker>
<?php } ?>
<a-entity camera></a-entity>