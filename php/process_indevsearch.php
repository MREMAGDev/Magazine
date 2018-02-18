<?php

  # Process authors
  # Process Selection List
  if(isset($_POST['menutype'])) {
      $menutype = $_POST['menutype'];
  } else { $menutype = 0; }
  if(isset($_POST['opcompid'])) {
  # Process Company ID's
  $company_list = "";
  $company_count = count($_POST['opcompid']);
  foreach($_POST['opcompid'] as $selected){
      $company_list .= $selected.",";  
  }
  $company_list = rtrim($company_list,",");
 
  $query = "SELECT p.id, p.builder_id, p.engineer_id, p.company_id, c.name, p.arrange_id, p.protogauge_id, p.fuel_id, p.class_id, p.description, c.name, cl.name FROM prototype p, opcompany c, class cl WHERE c.id IN ($company_list) AND p.company_id = c.id AND p.id IN (SELECT DISTINCT(m.proto_id) FROM model m WHERE m.status_id = 4) AND cl.id = p.class_id ORDER BY c.name, cl.name";

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
  echo '<h2><center>Loco DB Planned Models Search Results</center></h2>';
  echo '</header>';
  

  # Process Search Results
  $comp_id = 0;
  $search_result = $dbcl->query($query);
  $result_count = $search_result->num_rows;
  if($result_count > 0) {
     while(list($id, $builder_id, $engineer_id, $company_id, $company_name, $arrange_id, $protogauge_id, $fuel_id, $class_id, $description) = $search_result->fetch_row()) {
       if($comp_id != $company_id) {
          $comp_id = $company_id;
          echo "<center><H1>$company_name</H1></ br>&nbsp;</ br></center>";
       }
       fn_display_indev($dbcl, $id, $builder_id, $engineer_id, $company_id, $arrange_id, $protogauge_id, $fuel_id, $class_id, $description);
     }
  }
  $search_result->free();
  echo fn_build_return_button('indevsearch.php',$menutype);
  } else {
  echo "<center>No selection made, please try again.</center></ br>";
  echo fn_build_return_button('indevsearch.php',$menutype);
    }
  echo '</td></tr><tr><td>'.$pad.'</td><td>'.$pad.'</td></tr>';
  echo '</table>';

  echo '</div>';
  echo '</div>';
  echo '</div>';

?>
