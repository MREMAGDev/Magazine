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
include('php/greenbutton.php');
$headline_query="SELECT title, message, text_date FROM headlines WHERE (type = 0 OR type = $news_type) AND active = 1 AND text_date < SYSDATE() ORDER BY text_date DESC";
$headline_result=$dbcn->query($headline_query);
while(list($title, $message, $text_date) = $headline_result->fetch_row())
{
   $date_str=strtotime($text_date);
   echo '<header class="major">';
   echo '<h2>'.date("j F Y",$date_str).$pad.':-'.$pad.$title.'</h2>';
   echo '<span class="byline">'.$message.'</span>';
   echo '</header>';
   echo '<p>'.$pad.'</p>';
}
$headline_result->free();
echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>
