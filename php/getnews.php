<?php

include('php/build_ad_array.php');

echo '<div class="wrapper style2">';
echo '<section class="container">';
echo '<div class="row double">';
echo '<div class="11u">';

echo '<table>';
echo '<tr><td>';

include('php/display_ads.php');

echo '</td><td>'.$pad.$pad.'</td><td valign="top">';
#$current_link='<center><a href="#" onclick="javascript:MyPopUpWin('."'".fn_Get_Latest_Issue("url",$dbcn)."',900 ,900".');">';
$current_link='<center><a target="_blank" href="'.fn_Get_Latest_Issue("url",$dbcn).'">';
$current_link=$current_link.'<img border="0" width="200" src="images/view-latest-issue.png" alt="Link To Latest Issue"></a></center></br>';
echo $current_link;
$news_query='SELECT n.title, n.news, n.news_date FROM news n WHERE n.active = 1 ORDER BY n.news_date DESC';
$news_result=$dbcn->query($news_query);
while(list($title, $news, $news_date) = $news_result->fetch_row())
{
  $date_str=strtotime($news_date);
  echo '<header class="major">';
  echo '<h2>'.date("j F Y",$date_str).$pad.':-'.$pad.$title.'</h2>';
  echo '<span class="byline">'.$news.'</span>';
  echo '</header>';
  echo '<p>'.$pad.'</p>';
}
$news_result->free();

echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>
