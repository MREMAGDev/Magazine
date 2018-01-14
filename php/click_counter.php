<?php
  $id=trim($_GET['id']);
  $ad_query="SELECT url FROM adverts WHERE id = ".$id;
  $ad_result=$dbca->query($ad_query);
  while(list($url) = $ad_result->fetch_row())
  { $ad_link = $url; }
  $ad_result->free();
  $cc_query="INSERT INTO click_track(ad_id) VALUES($id)";
  $cc_result=$dbca->query($cc_query);
  if($cc_result) {
    echo '<script type="text/javascript">';
    echo 'window.location.href = "'.$ad_link.'";';
    echo '</script>';
  } else {
    die('Error : ('.$mysqli->errno.') '.$mysqli->error);
  }
?>