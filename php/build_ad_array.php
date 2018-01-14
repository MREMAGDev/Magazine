<?php
$ad_array = array();
$sub_ad_array1 = array();
$sub_ad_array2 = array();

$range_query1="SELECT id FROM adverts WHERE priority = 1 AND expiry >= CURDATE()";
$range_result1=$dbca->query($range_query1);
if ($range_result1->num_rows > 0)
{
  while(list($id) = $range_result1->fetch_row())
  {
    $sub_ad_array1[] = $id;
  }
  shuffle($sub_ad_array1);
  foreach($sub_ad_array1 as $id)
  {
    $ad_array[] = $id;
  }
}
unset($sub_ad_array1);
$range_result1->free();

$range_query2="SELECT id FROM adverts WHERE priority = 0 AND expiry >= CURDATE()";
$range_result2=$dbca->query($range_query2);
if ($range_result2->num_rows > 0)
{
  while(list($id) = $range_result2->fetch_row())
  {
    $sub_ad_array2[] = $id;
  }
  shuffle($sub_ad_array2);
  foreach($sub_ad_array2 as $id)
  {
    $ad_array[] = $id;
  }
}
unset($sub_ad_array2);
$range_result2->free();
?>
