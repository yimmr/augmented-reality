<?php if ('jpg' == $object_type_ext || 'png' == $object_type_ext) { ?>
<a-nft type="nft" url="<?php echo $markerURL; ?>">
    <a-image rotation="<?php echo $rotation; ?>"
             autoscale="<?php echo $autoscale; ?>"
             src="<?php echo $objectURL; ?>"></a-image>
</a-nft>
<?php } elseif ('gltf' == $object_type_ext) { ?>
<a-nft type="nft" url="<?php echo $markerURL; ?>"
       id="animated-marker">
    <a-entity rotation="<?php echo $rotation; ?>"
              autoscale="<?php echo $autoscale; ?>" position="0 0 0"
              animation-mixer
              gltf-model="#animated-asset<?php echo $objectId; ?>">
    </a-entity>
</a-nft>
<?php } ?>
<a-entity camera></a-entity>