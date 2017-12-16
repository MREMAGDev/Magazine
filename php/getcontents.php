/* 22/07/2017  RTB Fixed PHP warning by amending DB $issue_query SQL and results loop */

<?php

include('php/build_ad_array.php');

$issue_no = $_GET["ino"];

echo '<div class="wrapper style2">';
echo '<section class="container">';
echo '<div class="row double">';
echo '<div class="11u">';

echo '<table>';
echo '<tr><td valign="top">';

include('php/display_ads.php');

echo '</td><td>'.$pad.$pad.'</td><td align="top">';

#$issue_query='select title, link from mag_issue where issue = '.$issue_no;
$issue_query='select title from mag_issue where issue = '.$issue_no;
$result1=$dbcn->query($issue_query);
#while(list($title, $news, $mag_link) = $result1->fetch_row())
while(list($title) = $result1->fetch_row())
{
  echo '<header class="major">';
  echo '<h2>Issue '.$issue_no.' '.$title.'</h2>';
  echo '<span class="byline">Contents</span>';
  echo '</header>';
}
$result1->free();

echo '<table>';
$content_query='select author, article, page from mag_search where issue = '.$issue_no;
$result2=$dbcn->query($content_query);
while(list($author, $article, $page_no) = $result2->fetch_row())
{
  echo '<tr><td>Page '.$page_no.'</td><td>&nbsp;'.$author.'&nbsp;</td><td>&nbsp;'.$article.'</td></tr>';
}
$result2->free();
echo '</table>';

echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>

