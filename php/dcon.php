<?php
  include("cfg/news_dcon.php");
  $dbca = @mysqli_connect(ADB_H, ADB_U, ADB_P, ADB_N) or die ('Unable to connect to MySQL: '. mysqli_connect_error());
  $dbcn = @mysqli_connect(NDB_H, NDB_U, NDB_P, NDB_N) or die ('Unable to connect to MySQL: '. mysqli_connect_error());
?>

