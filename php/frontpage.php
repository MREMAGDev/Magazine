<?php

include('php/build_ad_array.php');

echo '<div class="wrapper style2">';
echo '<section class="container">';
echo '<div class="row double">';
echo '<div class="11u">';

echo '<table>';
echo '<tr><td valign="top">';

include('php/display_ads.php');

echo '</td><td>'.$pad.$pad.'</td><td valign="top" >';
#$current_link='<center><a href="#" onclick="javascript:MyPopUpWin('."'".fn_Get_Latest_Issue("url",$dbcn)."',900 ,900".');">';
$current_link='<center><a target="_blank" href="'.fn_Get_Latest_Issue("url",$dbcn).'">';
$current_link=$current_link.'<img border="0" width="200" src="images/view-latest-issue.png" alt="Link To Latest Issue"></a></center></br>';
echo $current_link;
#$getfp_query='select title, message, text_date from frontpage where active = 1;';
$getfp_query='SELECT fp.title, fp.message, fp.text_date FROM frontpage fp WHERE fp.active = 1 ORDER BY fp.text_date DESC;';
$fp_result=$dbcn->query($getfp_query);
while(list($title, $message, $text_date) = $fp_result->fetch_row())
{
   $date_str=strtotime($text_date);
   echo '<header class="major">';
   echo '<h2>'.date("j F Y",$date_str).$pad.':-'.$pad.$title.'</h2>';
   echo '<span class="byline">'.$message.'</span>';
   echo '</header>';
   echo '<p>'.$pad.'</p>';
}
$fp_result->free();
echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>
