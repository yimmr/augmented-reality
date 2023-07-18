<a-assets><?php array_map(function ($i) use ($html_object) {
    if ('gltf' == pathinfo($html_object[$i], PATHINFO_EXTENSION)) {
        printf('<a-asset-item id="animated-asset%s" src="%s"></a-asset-item>', $i, PL_AR_LINK.$html_object[$i]);
    }
}, $makerIdxs); ?></a-assets>