<?php

echo '<table>';

# Display transparent placeholder GIF to override a "feature" of the CSS coding!
echo '<tr><td valign="top"><img border="0" src="images/Ad_Placeholder210x5.gif" alt="Transparent Place Holder GIF"></td></tr>';

foreach($ad_array as $id)
{
  $ad_query="SELECT account, image FROM adverts WHERE id = ".$id;
  $ad_result=$dbca->query($ad_query);
  while(list($account, $image) = $ad_result->fetch_row())
  {
    echo '<tr><td valign="top">';
#    $ad_str='<a target="_blank" href="'.$url.'">';
    $ad_str='<a href="click_counter.php?id='.$id.'">';
    $ad_str=$ad_str.'<img border="0" width="210" src="images/'.$image.'" alt="'.$account.' advert">';
    echo $ad_str.'</a></td></tr>';
  }
}
$ad_result->free();
unset($ad_array);

echo '</table>';

?>
