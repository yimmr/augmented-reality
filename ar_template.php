<?php /* Template Name: ar_template */ ?>
<?php  
add_action('wp_ajax_pl_ar_new_page','pl_ar_new_page');
add_action('wp_ajax_nopriv_pl_ar_new_page','pl_ar_new_page');

$id_selector = get_option('pl_ar_current_id');
$autoscale = get_option('pl_ar_current_scale');
$rotation = get_option('pl_ar_current_rotation');
global $wpdb;
//check if id exists in table
$count = $wpdb->get_var("SELECT COUNT(*) FROM {$wpdb->prefix}pl_ar_table WHERE shortcode_id={$id_selector}");
if ($count == 0 ){
  wp_die( $message = 'No item with id:'.$id_selector.' exists');
}
//prepare the markers
$html_marker = json_encode($wpdb->get_results("SELECT markers FROM {$wpdb->prefix}pl_ar_table WHERE shortcode_id={$id_selector}"));
$html_marker = json_decode( $html_marker, $assoc_array = true );
$html_marker = stripcslashes($html_marker[0]['markers']);
$html_marker = json_decode(str_replace("'",'"',$html_marker), true);

//prepare the objects
$html_object = json_encode($wpdb->get_results("SELECT objects FROM {$wpdb->prefix}pl_ar_table WHERE shortcode_id={$id_selector}"));
$html_object = json_decode( $html_object, $assoc_array = true ); 
$html_object = stripcslashes($html_object[0]['objects']);
$html_object = json_decode(str_replace("'",'"',$html_object), true);

//predifine assets
$assets='';
for ($j = 0; $j < sizeof($html_marker); $j++) {
  //check the file type
  $Apath_parts = pathinfo($html_object[$j]);
  $Aobject_type_ext = $Apath_parts['extension'];
  if ($Aobject_type_ext=='gltf') {
    $assets= $assets.'<a-asset-item id="animated-asset'.$j.'" src="'.PL_AR_LINK.$html_object[$j].'"></a-asset-item>';
  }
}

ob_start();
echo '<!doctype HTML>
        <html>';
echo '<head>';
wp_head();
echo '<meta name="viewport" content="width=device-width, user-scalable=no, minimum-scale=1.0, maximum-scale=1.0">';
echo '</head>';
echo '<body style="margin : 0px; overflow: hidden;">';
echo '<a-scene embedded vr-mode-ui="enabled: false" arjs="sourceType: webcam; debugUIEnabled: false; detectionMode: mono_and_matrix; matrixCodeType: 3x3;">
  <a-assets>
    '.$assets.'
  </a-assets>
';
for ($i = 0; $i < sizeof($html_marker); $i++) {
  //check the file type
  $path_parts = pathinfo($html_object[$i]);
  $object_type_ext = $path_parts['extension'];

  if($object_type_ext=='jpg' || $object_type_ext=='png'){
    echo '<a-marker type="pattern" url="'.PL_AR_LINK.$html_marker[$i].'">
          <a-image rotation="'.$rotation.'"autoscale="'.$autoscale.'" src="'.PL_AR_LINK.$html_object[$i].'"></a-image>
        </a-marker>';
  }
  elseif ($object_type_ext=='gltf') {
    echo '<a-marker id="animated-marker"  type="pattern" url="'.PL_AR_LINK.$html_marker[$i].'"></a-asset-item>
             <a-entity 
               rotation="'.$rotation.'"   
               autoscale="'.$autoscale.'"
               position="0 0 0"
               animation-mixer 
               gltf-model="#animated-asset'.$i.'">
            </a-entity>
          </a-marker>';
  } 
}
          
echo '<a-entity camera></a-entity>
      </a-scene>
      </body>
      </html>';
$sHTML_Content = ob_get_contents();
ob_end_clean();
echo $sHTML_Content;


?>