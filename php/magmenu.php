<?php

echo '<li><a href="">eMagazine</a><ul><li><a href="mag_access.php">How To Access</a></li>';

$gi_query = "SELECT mi.id, mi.issue, mi.year, mi.title, mi.link FROM mag_issue mi WHERE mi.published=1 ORDER BY mi.id";
$gi_result = $dbcn->query($gi_query);
while(list($gi_id,$gi_issue,$gi_year,$gi_title,$gi_link) = $gi_result->fetch_row())
{
    echo '<li><a target="_blank" href="'.$gi_link.'">Issue '.$gi_issue.': '.$gi_title.'</a><ul>';
    echo '<li><a target="_blank" href="'.$gi_link.'">Go to Issue '.$gi_issue.'</a></li>';
    echo '<li><a href="contents.php?ino='.$gi_issue.'">Contents</a></li></ul></li>';
}
$gi_result->free();

echo '<li><a href="magsearch.php">Search</a></li></ul></li>';
echo '<li><a href="locoindex.php?mu=0">Model Loco DB</a></li>';
?>
