<?php

include('php/build_ad_array.php');

echo '<div class="wrapper style2">';
echo '<section class="container">';
echo '<div class="row double">';
echo '<div class="11u">';

echo '<table>';
echo '<tr><td valign="top" >';

include('php/display_ads.php');

echo '</td><td>'.$pad.$pad.'</td><td valign="top" >';

echo '<header class="major">';
echo '<h2><center>Magazine Content Search</center></h2>';
echo '<span class="byline"><center>Search the magazine indexes to find articals that may be of interest, not only in the current issue, but in past issues as well. When picking search strings please be aware that your choice
s may not return any results, if this happens try again being a little less specific.</center></span>';
echo '</header>';

echo '<form action="ms_results.php" name="ms_search" id="ms_form" method="post">';
echo '<table>';
echo '<tr><td align="center">';
echo $pad.$pad.'Select Author</br>';
echo $pad.$pad.'<select id="authstr[]" name="authstr[]" size="5" multiple="multiple" >';
echo '<option value="0" selected>ALL</option>';
$author_query='select id, author from  authors';
$author_result=$dbcn->query($author_query);
while(list($auth_id, $author) = $author_result->fetch_row())
{
  echo '<option value="'.$auth_id.'">'.$author.'</option>';
}
$author_result->free();
echo '</select>';

echo '</td><td>'.$pad.'</td><td>Search for articals by a specific author or authors.</td></tr>';
echo '<tr><td align="center">';
echo $pad.$pad.'Select Issue</br>';
echo $pad.$pad.'<select id="issuestr[]" name="issuestr[]" size="5" multiple="multiple" >';
echo '<option value="0" selected>ALL</option>';
$issue_query='select id, title from  mag_issue';
$issue_result=$dbcn->query($issue_query);
while(list($issue_id, $title) = $issue_result->fetch_row())
{
  echo '<option value="'.$issue_id.'">Issue '.$issue_id.' '.$title.'</option>';
}
$issue_result->free();
echo '</select>';
echo '</td><td>'.$pad.'</td><td>Search specific magazine issues.</td></tr>';
/*
   echo '<tr><td center>';
   echo 'Keyword Search</br>';
   echo '<input type="text" width="25" name="kword>';
   echo '</td><td>&nbsp;&nbsp;</td><td>Search articles for keywords.</td></tr>';
*/
echo '</table>';

echo '<center><button type="submit" value="Submit">Submit</button></center>';
echo '</form>';
echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>