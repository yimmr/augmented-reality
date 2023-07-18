<!-- <script src="https://aframe.io/releases/1.3.0/aframe.min.js"></script>
<script src="https://raw.githack.com/AR-js-org/AR.js/master/aframe/build/aframe-ar.js"></script> -->
<a-scene embedded arjs>
    <?php require_once __DIR__.'/assets.php'; ?>
    <a-marker preset="hiro">
        <?php require_once __DIR__.'/show-object.php'; ?>
    </a-marker>
    <a-entity camera></a-entity>
</a-scene>