<?php

  # Process authors
  # Process Selection List
  
  # Process Company ID
  if(isset($_POST['compid'])) {
    if ($_POST['compid'] != null) {
      $compid = (int)trim($_POST['compid']);
    } else { $compid = 1; }
  } else { $compid = 1; }
  # Process Gauge ID
  if(isset($_POST['gaugeid'])) {
     $gaugeid = $_POST['gaugeid'];
     if($gaugeid > 0) {
        $q_gauge = " AND protogauge_id = {$gaugeid}";
     } else {$q_gauge = ""; }
  } else {$q_gauge = ""; }
  #  echo "Gauge ID = {$gaugeid} Company ID = {$compid} Query Gauge Filter = {$q_gauge}";
  
  # Initialise variables
  $arrangement = "";
  $eclass = "";
  $engineer ="";
  # Process Loco Class Selection List
  $all=0;
  if(isset($_POST['eclass']) && !empty($_POST['eclass']))
  {$values = $_POST['eclass'];} else {$values[] =0;}
  foreach ($values as $val)
  {
    if ($val == 0) {$all=1;}
    $eclass.=$val.',';
  }
  # If not ALL drop the trailing comma, otherwise set to 0
  if($all == 1) {$eclass=0;} else {$eclass = rtrim($eclass,",");}

  # Process Loco Class Selection List
  $all=0;
  if(isset($_POST['engineer']) && !empty($_POST['engineer']))
  {$values = $_POST['engineer'];} else {$values[] =0;}
  foreach ($values as $val)
  {
    if ($val == 0) {$all=1;}
    $engineer.=$val.',';
  }
  # If not ALL drop the trailing comma, otherwise set to 0
  if($all == 1) {$engineer=0;} else {$engineer = rtrim($engineer,",");}

  # Process Wheel Assignment Selection List
  $all=0;
  if(isset($_POST['arrangement']) && !empty($_POST['arrangement']))
  {$values = $_POST['arrangement'];} else {$values[] =0;}
  foreach ($values as $val)
  {
    if ($val == 0) {$all=1;}
    $arrangement.=$val.',';
  }
  # If not ALL drop the trailing comma, otherwise set to 0
  if($all == 1) {$arrangement=0;} else {$arrangement = rtrim($arrangement,",");}

  #Build search strings;
  if ($arrangement == 0)
    {$q_arrangement = "";}
  else
    {$q_arrangement = ' AND arrange_id IN ('.$arrangement.')';}

  if ($eclass == 0)
    {$q_eclass = "";}
  else
    {$q_eclass = ' AND class_id IN ('.$eclass.')';}

  if ($engineer == 0)
    {$q_engineer = "";}
  else
    {$q_engineer = ' AND engineer_id IN ('.$engineer.')';}

  $query = "SELECT id, builder_id, engineer_id, company_id, arrange_id, protogauge_id, fuel_id, class_id, description FROM prototype WHERE company_id = $compid $q_arrangement $q_eclass $q_engineer $q_gauge AND loaded = 1 ORDER
 BY class_id";
  
# Show Advers & Search Results
  include('php/build_ad_array.php');

  echo '<div class="wrapper style2">';
  echo '<section class="container">';
  echo '<div class="row double">';
  echo '<div class="11u">';

  echo '<table>';
  echo '<tr><td valign="top">';

  # Process Adverts
  include('php/display_ads.php');

  echo '</td><td>'.$pad.$pad.'</td><td valign="top">';

  echo '<header class="major">';
  echo '<h2><center>Model Loco DB Search Results</center></h2>';
  echo '</header>';
  # Process Search Results
  $search_result = $dbcl->query($query);
  $result_count = $search_result->num_rows;
  if($result_count > 0) {
     while(list($id, $builder_id, $engineer_id, $company_id, $arrange_id, $protogauge_id, $fuel_id, $class_id, $description) = $search_result->fetch_row()) {
       fn_display_results($dbcl, $id, $builder_id, $engineer_id, $company_id, $arrange_id, $protogauge_id, $fuel_id, $class_id, $description);
     }
  }
  #} else {fn_no_results_help($dbcl, $engineer, $arrangment, $eclass, $compid, $pad);}
  $search_result->free();
  echo fn_build_return_link('locosearch.php',$menutype,$compid,$gaugeid);
  echo '</td></tr><tr><td>'.$pad.'</td><td>'.$pad.'</td></tr>';
  echo '</table>';

  echo '</div>';
  echo '</div>';
  echo '</div>';

?>
