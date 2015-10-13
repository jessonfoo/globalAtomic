<?php
function dta($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = '') {
  $arrayItems = array();
  $skipByExclude = false;
  $handle = opendir($directory);
  if ($handle) {
    while (false !== ($file = readdir($handle))) {
      preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
      if($exclude){
        preg_match($exclude, $file, $skipByExclude);
      }
      if (!$skip && !$skipByExclude) {
        if (is_dir($directory. DIRECTORY_SEPARATOR . $file)) {
          if($recursive) {
            $arrayItems = array_merge($arrayItems, dta($directory. DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
          }
          if($listDirs){
            $file = $directory . DIRECTORY_SEPARATOR . $file;
            $arrayItems[] = $file;
          }
        } else {
          if($listFiles){
            $file = $directory . DIRECTORY_SEPARATOR . $file;
            $arrayItems[] = $file;
          }
        }
      }
    }
    closedir($handle);
  }
  return $arrayItems;
} 


function get_img($str){
  $args = explode(',',$str);
  $size = count($args);
  $fName = $args[0];
  if (!function_exists(dta)){
    function dta($directory, $recursive = true, $listDirs = false, $listFiles = true, $exclude = '') {
      $arrayItems = array();
      $skipByExclude = false;
      $handle = opendir($directory);
      if ($handle) {
        while (false !== ($file = readdir($handle))) {
          preg_match("/(^(([\.]){1,2})$|(\.(svn|git|md))|(Thumbs\.db|\.DS_STORE))$/iu", $file, $skip);
          if($exclude){
            preg_match($exclude, $file, $skipByExclude);
          }
          if (!$skip && !$skipByExclude) {
            if (is_dir($directory. DIRECTORY_SEPARATOR . $file)) {
              if($recursive) {
                $arrayItems = array_merge($arrayItems, dta($directory. DIRECTORY_SEPARATOR . $file, $recursive, $listDirs, $listFiles, $exclude));
              }
              if($listDirs){
                $file = $directory . DIRECTORY_SEPARATOR . $file;
                $arrayItems[] = $file;
              }
            } else {
              if($listFiles){
                $file = $directory . DIRECTORY_SEPARATOR . $file;
                $arrayItems[] = $file;
              }
            }
          }
        }
        closedir($handle);
      }
      return $arrayItems;
    } 
  } else {
    $fMonth = $args[1];
    if($size == 2){ $fYear= date('Y'); } else { $fYear= $args[2];}
    if (function_exists('wp_upload_dir')){
      $d = wp_upload_dir();   // returns arr with [path],[url],[subdir],[basedir],[baseurl] 
      $bd= $d['basedir'].'/'. $fYear.'/' . $fMonth;
      $files = dta($bd);
      $file = scandir($bd);
      foreach($files as $gkey => $gval){
        if (strstr($gval,$fName) == $fName){
          return get_site_url() . strstr($gval,'/wp-content');
        } else {
          $file = scandir($d){

        }
        }
      }
    }
    if ($size == 1 ){
      return get_site_url() . '/wp-content/uploads/' . $fName;
      // return get_site_url() . '/wp-content/uploads/' . date('Y') .'/'.date('m').'/' . $fName; 
    }
  }
}

  function gcbpid ($id){
    $output= [];
    $args = array( 'number'=> $number, 'orderby'=> $orderby, 'order'=> $order, 'hide_empty'=> $hide_empty, 'include'=> $ids);
    $product_categories = get_terms( 'product_cat', $args );
    foreach($product_categories as $p) {
      $pid = $p -> parent;
      if ($pid == $id) {
        $output[]= $p;
      }
    }
    return $output;
  }

  function iBanner($title) {
    $img='girlpic.jpg,08';
    echo " <div class='vb-b test full-width f-play color-white' style='background:url("; echo get_img($img); echo ") no-repeat 0% 0%;height:135px;padding-top:10px;'>";
    echo "<div class='container p-rel mt-50 a-center'>";
    echo "<h1 class='t-bot f-play color-white'>".$title."</h1></div> </div> ";
  }
  function gznHeader($args=null){
    $arr = explode(',',$args);
    $size = sizeof($arr);
    if ($size > 1){ $str = $arr[2]; }
    if ($size == 1 ){$img = $args;}
    if ($str!=''){
      $string= $str;
      $sA = explode(' ',$string[0]);
      $sS = sizeof($sA) - 1;
      echo '<div class="container mt-30 pb-40 mh-700"> <h1 class="gznH1 f-play" style="font-family:play;">';
      for($i = 0; $i < $sS; $i++) {
        echo $sA[$i];
        echo ' ';
      }
      echo '<strong style="display:inline-block;font-family:play;">' . $sA[$sS] . '</strong>   ';
      if (strlen($img) > 3){
        echo '<img style="vertical-align: sub;" src="'; echo get_img($img); echo '">';
      }
      echo '</h1><div>';
    } elseif (strlen(get_post_custom_values('content_2')) >= 5 ){ $string=get_post_custom_values('content_2'); }
    if ($string != ''){
      $sA = explode(' ',$string[0]);
      $sS = sizeof($sA) - 1;
      echo '<div class="container mt-30 pb-40 mh-700"> <h1 class="gznH1 f-play" style="font-family:play;">';
      for($i = 0; $i < $sS; $i++){
        echo $sA[$i];
        echo ' ';
      }
      echo '<strong style="display:inline-block;font-family:play;">' . $sA[$sS] . '</strong>   ';
      if (strlen($img) > 3){
        echo '<img style="vertical-align: sub;" src="'; echo get_img($img); echo '">';
      }
      echo'</h1><div>';
    } else {
    }
  }
  function_exists('get_the_title'){
  $string = get_the_title();
  $sA = explode(' ',$string);
  $sS = sizeof($sA) - 1;
  echo '<div class="container mt-30 pb-40 mh-700"> <h1 class="gznH1 f-play" style="font-family:play;">';
  for($i = 0; $i < $sS; $i++) {
    echo $sA[$i] . ' ';
  }
  echo '<strong style="display:inline-block;font-family:play;">' . $sA[$sS] . '</strong>   ';
  if (strlen($img) > 3){
    echo '<img style="vertical-align: sub;" src="'; echo get_img($img); echo '">';
  }
  }
  echo'</h1><div></div>';
}
?>
