<?php
  include("cfg/loco_dcon.php");
  $dbcl = @mysqli_connect(LDB_H, LDB_U, LDB_P, LDB_N) or die ('Unable to connect to MySQL: '. mysqli_connect_error());
?>
