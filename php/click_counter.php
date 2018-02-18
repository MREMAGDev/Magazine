<?php

  function getUserIP() {
    $client = @$_SERVER['HTTP_CLIENT_IP'];
    $forward = @$_SERVER['HTTP_X_FORWARDED_FOR'];
    $remote = $_SERVER['REMOTE_ADDR'];
    if(filter_var($client, FILTER_VALIDATE_IP))
      {$ip = $client;}
    elseif(filter_var($forward, FILTER_VALIDATE_IP))
      {$ip = $forward;} 
    else  
      {$ip = $remote;}
    return $ip;
  }

  # Set fall back URL
  $ad_link = "http://www.mremag.com";

  if(isset($_GET['id'])) {
    $ip=getUserIP();
    $id=(int)trim($_GET['id']);
    $ip_array=explode(".",$ip);
    $ip_number = (16777216 * $ip_array[0]) + (65536 * $ip_array[1]) + (256 * $ip_array[2]) + $ip_array[3];
    $ad_query="SELECT url FROM adverts WHERE id = ".$id;
    $ad_result=$dbca->query($ad_query);
    while(list($url) = $ad_result->fetch_row()) {$ad_link = $url;}
    $ad_result->free();
    $cc_query='INSERT INTO click_track(ad_id, ip_address, ip_number) VALUES('.$id.', "'.$ip.'", '.$ip_number.')';
    $cc_result=$dbca->query($cc_query);
    if($cc_result) {
      echo '<script type="text/javascript">';
      echo 'window.location.href = "'.$ad_link.'";';
      echo '</script>';
    } else {
      die('Error : ('.$dbca->errno.') '.$dbca->error);
    }
  }
?>
