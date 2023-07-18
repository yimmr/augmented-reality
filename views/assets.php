<?php

if (!empty($pageData['preload'])) {
    echo '<a-assets>';
    array_walk($pageData['preload'], function ($src, $id) {
        printf('<a-asset-item id="%s" src="%s"></a-asset-item>', $id, $src);
    });
    echo '</a-assets>';
}
