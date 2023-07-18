<?php

namespace MyWPAR;

class ARPage
{
    public function buildObjectHTML($data)
    {
        $type = $data['type'];
        unset($data['type']);
        $attrStr = '';

        foreach ($data as $key => $value) {
            if (null !== $value) {
                $attrStr .= ' '.(true === $value ? $key : "{$key}=\"{$value}\"");
            }
        }

        return "<a-{$type}{$attrStr}></a-{$type}>";
    }

    public function getPageCurrentData()
    {
        global $wpdb;

        $data = [];
        $sortcodeId = \get_option('pl_ar_current_id');
        $attrs = (array) \get_option('pl_ar_current_options', []);

        foreach (['type', 'slon', 'slat'] as $key) {
            if (isset($attrs[$key])) {
                $data[$key] = $attrs[$key];
                unset($attrs[$key]);
            }
        }

        $table = $wpdb->prefix.'pl_ar_table';
        $count = $wpdb->get_var("SELECT COUNT(*) FROM {$table} WHERE shortcode_id={$sortcodeId}");

        if (0 == $count) {
            \wp_die('No item with id:'.$sortcodeId.' exists');
        }

        $rawData = $wpdb->get_row("SELECT markers,objects FROM {$table} WHERE shortcode_id={$sortcodeId}");
        $markers = $this->parseJSONColumn($rawData, 'markers');
        $objects = $this->parseJSONColumn($rawData, 'objects');
        $items = [];
        $preload = [];

        $markers = ['examples/image-tracking/nft/trex/trex-image/trex'];
        $objects = ['examples/image-tracking/nft/trex/scene.gltf'];
        $data['type'] = 1 == $_GET['art'] ? 'image' : (2 == $_GET['art'] ? 'location' : 'marker');
        $attrs['lat'] = $data['slat'] = 51.049;
        $attrs['lon'] = $data['slon'] = -0.723;

        if ('location' === $data['type']) {
            $lat = $attrs['lat'] ?? 0;
            $lon = $attrs['lon'] ?? 0;
            $attrs['look-at'] = $attrs['look-at'] ?? '[gps-camera]';
            $attrs['gps-entity-place'] = "latitude: {$lat}; longitude: {$lon};";
        }

        foreach ($markers as $key => $value) {
            $object = $objects[$key];
            $objectURL = \PL_AR_LINK.$object;
            $ext = pathinfo($object, PATHINFO_EXTENSION);

            if ('gltf' == $ext) {
                $srcId = "animated-asset{$key}";
                $preload[$srcId] = $objectURL;
            }

            $item = array_merge($this->parseObjectAttrs($objectURL, $srcId), $attrs);
            $item['marker_url'] = \PL_AR_LINK.$value;
            $items[] = $item;
        }

        $data['items'] = $items;
        $data['preload'] = $preload;

        // dump($data);

        return $data;
    }

    protected function parseObjectAttrs($src, $id)
    {
        $ext = pathinfo($src, PATHINFO_EXTENSION);

        switch ($ext) {
            case 'jpg':
            case 'png':
                return ['type' => 'image', 'src' => $src];
                break;
            case 'gltf':
                return [
                    'type'            => 'entity',
                    'animation-mixer' => true,
                    'gltf-model'      => '#'.$id,
                    'position'        => '0 0 0',
                ];
                break;
            default:break;
        }

        return [];
    }

    public function parseJSONColumn(&$data, $column, $default = [])
    {
        if (!empty($data->{$column})) {
            $string = $data->{$column};
            return json_decode(str_replace("'", '"', stripcslashes($string)), true) ?: $default;
        }

        return $default;
    }
}
