<?php

function fn_build_return_button($page, $menutype)
{
   $url = "{$page}?mt={$menutype}";
   $link = '<center><a href="'.$url.'">';
   $link .= '<button>Return</button>';
   $link .= '</a></center></br>';
   return $link;
}

function fn_build_return_link($page, $menutype, $company_id, $protogauge_id)
{
   $url = "{$page}?mt={$menutype}&id={$company_id}";
   if(isset($protogauge_id)) {
     if($protogauge_id <> 1) {$url .= "&gu={$protogauge_id}";}
   }
   $link = '<center><a href="'.$url.'">';
   $link .= '<button>Return To Search Page</button>';
   $link .= '</a></center></br>';
   return $link;
}

function fn_no_results_help($dbcl, $engineer_list, $arrange_list, $class_list, $company_id, $pad)
{
  $arrange_name = "";
  $class_name = "";
  $comp_name = "";
  $eng_name = "";

  if(!isset($engineer_list)) {$engineer_list = "0";}
  if(!isset($arrange_list)) {$arrange_list = "0";}
  if(!isset($class_list)) {$class_list = "0";}
  if(!isset($company_id)) {$company_id = "0";}

  echo "{$engineer_list} - {$arrange_list} - {$class_list} - {$company_id}"; 

  # Parameter Detail Queries
  $query_1 = "SELECT name FROM opcompany WHERE id = $company_id";
  $query_2 = "SELECT name FROM engineeer WHERE id IN ($engineer_list)";
  $query_3 = "SELECT name FROM class WHERE id IN( $class_list)";
  $query_4 = "SELECT name FROM arrangement WHERE id IN ($arrange_list)";

  # Build and display help text
  echo "<H2><center>Sorry No Results Found!</center></H2><p>".$pad."</p>";
  
  if($company_id != "0"){
     $result_1 = $dbcl->query($query_1);
     while(list($name) = $result_1->fetch_row())
       {$comp_name = $name;}
     $result_1->free();
  } 

  if($engineer_list != "0"){
     $result_2 = $dbcl->query($query_2);
     echo "Result 2 = ".$result_2->num_rows." Rows";
     if($result_2->num_rows > 0) {
         while(list($name) = $result_2->fetch_row()) {
            $eng_name .= "{$eng_name} ,";
         }
         $eng_name = rtrim($eng_name,",");
     }
     $result_2->free();
  } 
  
  if($class_list != "0"){
     $result_3 = $dbcl->query($query_3);
     if($result_3->num_rows > 0) {
         while(list($name) = $result_3->fetch_row()) {
            $class_name .= "{$class_name} ,";
         }
         $class_name = rtrim($class_name,",");
     }
     $result_3->free();
  } 
  
  if($arrange_list != "0"){
     $result_4 = $dbcl->query($query_4);
     if($result_4->num_rows > 0) {
         while(list($name) = $result_4->fetch_row()) {
            $arrange_name .= "{$arrange_name} ,";
         }
         $arrange_name = rtrim($arrange_name,",");
     }
     $result_4->free();
  } 

  echo "Your search criteria were:<p>".$pad."</p>";
  echo "Operating Company: ".$comp_name.".<p>".$pad."</p>";
  if($loco_name != "") {echo "Loco Class: ".$loco_name.".<p>".$pad."</p>";}
  if($eng_name != "") {echo "Loco Engineer: ".$eng_name.".<p>".$pad."</p>";}
  if($arrange_name != "") {echo "Loco Wheel Arrangements: ".$arrange_name.".<p>".$pad."</p>";}
  echo "<p>While Loco's matching your criteria may exist, there are currently no models of that locomotive recorded in the database. Please try another search using different selection criteria.</p><p>".$pad."</P>";

}


function fn_display_results($dbcl, $id, $builder_id, $engineer_id, $company_id, $arrange_id, $protogauge_id, $fuel_id, $class_id, $description)
{
  $engineer = "Unknown";
  $loco_class = "Unknown";
  $parent = 0;
  $proto_desc = $description;

  # Prototype table queries;
  $query_1 = "SELECT name, location FROM builder WHERE id = $builder_id";
  $query_2 = "SELECT name FROM class WHERE id = $class_id AND company_id = $company_id";
  $query_3 = "SELECT name FROM engineer WHERE id = $engineer_id AND company_id = $company_id";
  $query_4 = "SELECT name FROM opcompany WHERE id = $company_id";
  $query_5 = "SELECT a.description, p.description FROM arrangement a LEFT JOIN powerclass p ON p.id = a.pclass_id WHERE  a.id = $arrange_id";
  $query_6 = "SELECT description FROM prototypegauge WHERE id = $protogauge_id";

  # Model table queries;
  $query_7 = "SELECT id, gauge_id, status_id, make_id, year, parent, children, description FROM model WHERE proto_id = $id ORDER BY id";

  if(!(is_null($builder_id)))
  {
    $result_1 = $dbcl->query($query_1);
    while(list($name,$location) = $result_1->fetch_row())
    {
      $builder = $name;
      $build_town = $location;
    }
    $result_1->free();
  } else {
    $builder = "Unknown";
    $build_town = "";
  }

  if(!(is_null($class_id)))
  {
    $result_2 = $dbcl->query($query_2);
    while(list($name) = $result_2->fetch_row())
    { $loco_class = $name; }
    $result_2->free();
  } else { $loco_class = "Unknown"; }

  if(!(is_null($engineer_id)))
  {
    $result_3 = $dbcl->query($query_3);
    while(list($name) = $result_3->fetch_row())
    { $engineer = $name; }
    $result_3->free();
  } else { $engineer = "Unknown";}

  if(!(is_null($company_id)))
  {
    $result_4 = $dbcl->query($query_4);
    while(list($name) = $result_4->fetch_row())
    { $op_company = $name; }
    $result_4->free();
  } else { $op_company = "Unknown"; }

  if(!(is_null($arrange_id)))
  {
    $result_5 = $dbcl->query($query_5);
    while(list($a_desc,$p_desc) = $result_5->fetch_row())
    {
      $arrangement = $a_desc;
      if(is_null($p_desc))
        {$arrange_alias = "";}
      else
        {$arrange_alias = '('.$p_desc.')';}
    }
    $result_5->free();
  } else {
      $arrangement = "Unknown";
      $arrange_alias = "";
  }

//  echo $arrangement.' '.$arrange_alias.'</br>';

  if(!(is_null($protogauge_id)))
  {
    $result_6 = $dbcl->query($query_6);
    while(list($description) = $result_6->fetch_row())
     { $gauge = $description; }
    $result_6->free();
  } else { $gauge = "Unknown";}

  
  # Output Loco detail header
  echo '<table cellpadding="10" valign="top">';
  echo '<tr><td>Company : '.$op_company.'</td>';
  echo '<td>Class : '.str_replace('Class','',$loco_class).'</td>';
  echo '<td>Wheel Arrangement : '.$arrangement.' '.$arrange_alias.'</td></tr>';
  echo '<tr><td>Engineer : '.$engineer.'</td>';
  echo '<td>Builder : '.$builder.', '.$build_town.'</td>';
  echo '<td>Gauge : '.$gauge.'</td></tr>';
  echo '<tr><td colspan="3">&nbsp;</td></tr>';
  echo '<tr><td colspan="3">'.htmlspecialchars($proto_desc,ENT_QUOTES).'</td></tr>';
  echo '</table>';

  # Sort out model information
  echo '<table cellspacing="4">';
  echo '<col width="20%" /><col width="10%" /><col width="10%" /><col width="20%" /><col width="40%" />';
#  echo '<tr align="left"><th>Make</th><th>Year</th><th>Scale</th><th>Status</th><th>Comment</th></td>';
  echo '<tr align="left"><th>Make</th><th>Year</th><th>Gauge</th><th>Status</th><th>Comment</th></td>';
  $result_7 = $dbcl->query($query_7);
    while(list($id, $gauge_id, $status_id, $make_id, $year, $parent, $children, $description) = $result_7->fetch_row())
    {
      $query_8= "SELECT gauge FROM gauge WHERE id = $gauge_id";
      $query_9 = "SELECT name FROM make WHERE id = $make_id";
      $query_10 = "SELECT status FROM status WHERE id = $status_id";

//  echo $query_8.'</br>'.$query_9.'</br>'.$query_10.'</br></nr>';;

      if(!(is_null($gauge_id)))
      {
        $result_8 = $dbcl->query($query_8);
        while(list($gauge) = $result_8->fetch_row())
        { $model_gauge = $gauge; }
        $result_8->free();
      } else { $model_gauge = 'Unknown'; }

      if(!(is_null($make_id)))
      {
        $result_9 = $dbcl->query($query_9);
        while(list($name) = $result_9->fetch_row())
        { $model_make = $name; }
        $result_9->free();
      } else { $model_make = 'Unknown'; }

     if(!(is_null($status_id)))
      {
        $result_10 = $dbcl->query($query_10);
        while(list($status) = $result_10->fetch_row())
        { $model_status = $status; }
        $result_10->free();
      } else { $model_make = 'Unknown'; }

     echo '<tr valign="top"><td>';
     if($parent <> 0){echo '&rarr;&nbsp;&nbsp;';}
     echo $model_make.'</td>';
     echo '<td>'.$year.'</td>';
     echo '<td>'.$model_gauge.'</td>';
     echo '<td>'.$model_status.'</td>';
     echo '<td>'.$description.'</td></tr>';
  }
  $result_7->free();
  echo '</table>';
  echo '<p><center>------------------------------------------------------------------------------------------</center></p>';
}

function fn_display_indev($dbcl, $id, $builder_id, $engineer_id, $company_id, $arrange_id, $protogauge_id, $fuel_id, $class_id, $description)
{
  $loco_class = "";
  $model_gauge = "";
  $proto_desc = $description;
  $parent = 0;

  # Prototype table queries;
  $query_1 = "SELECT name, location FROM builder WHERE id = $builder_id";
  $query_2 = "SELECT name FROM class WHERE id = $class_id AND company_id = $company_id";
  $query_3 = "SELECT name FROM engineer WHERE id = $engineer_id AND company_id = $company_id";
  $query_4 = "SELECT name FROM opcompany WHERE id = $company_id";
  $query_5 = "SELECT a.description, p.description FROM arrangement a LEFT JOIN powerclass p ON p.id = a.pclass_id WHERE  a.id = $arrange_id";
  $query_6 = "SELECT description FROM prototypegauge WHERE id = $protogauge_id";

  # Model table queries;
  $query_7 = "SELECT id, gauge_id, make_id, description FROM model WHERE proto_id = $id AND status_id = 4 ORDER BY id";

  if(!(is_null($builder_id)))
  {
    $result_1 = $dbcl->query($query_1);
    while(list($name,$location) = $result_1->fetch_row())
    {
      $builder = $name;
      $build_town = $location;
    }
    $result_1->free();
  } else {
    $builder = "Unknown";
    $build_town = "";
  }

  if(!(is_null($class_id)))
  {
    $result_2 = $dbcl->query($query_2);
    while(list($name) = $result_2->fetch_row())
    { $loco_class = $name; }
    $result_2->free();
  } else { $loco_class = "Unknown"; }

  if(!(is_null($engineer_id)))
  {
    $result_3 = $dbcl->query($query_3);
    while(list($name) = $result_3->fetch_row())
    { $engineer = $name; }
    $result_3->free();
  } else { $engineer = "Unknown";}

  if(!(is_null($company_id)))
  {
    $result_4 = $dbcl->query($query_4);
    while(list($name) = $result_4->fetch_row())
    { $op_company = $name; }
    $result_4->free();
  } else { $op_company = "Unknown"; }

  if(!(is_null($arrange_id)))
  {
    $result_5 = $dbcl->query($query_5);
    while(list($a_desc,$p_desc) = $result_5->fetch_row())
    {
      $arrangement = $a_desc;
      if(is_null($p_desc))
        {$arrange_alias = "";}
 else
        {$arrange_alias = '('.$p_desc.')';}
    }
    $result_5->free();
  } else {
      $arrangement = "Unknown";
      $arrange_alias = "";
  }

  if(!(is_null($protogauge_id)))
  {
    $result_6 = $dbcl->query($query_6);
    while(list($description) = $result_6->fetch_row())
     { $gauge = $description; }
    $result_6->free();
  } else { $gauge = "Unknown";}

  # Output Loco detail header
  echo '<table cellpadding="10" valign="top">';
  echo '<tr><td>Company : '.$op_company.'</td>';
  echo '<td>Class : '.str_replace('Class','',$loco_class).'</td>';
  echo '<td>Wheel Arrangement : '.$arrangement.' '.$arrange_alias.'</td></tr>';
  echo '<tr><td>Engineer : '.$engineer.'</td>';
  echo '<td>Builder : '.$builder.', '.$build_town.'</td>';
  echo '<td>Gauge : '.$gauge.'</td></tr>';
  echo '<tr><td colspan="3">&nbsp;</td></tr>';
  echo '<tr><td colspan="3">'.htmlspecialchars($proto_desc,ENT_QUOTES).'</td></tr>';
  echo '</table>';

  # Sort out model information
  echo '<table cellspacing="4">';
  echo '<col width="20%" /><col width="10%" /><col width="10%" /><col width="20%" /><col width="40%" />';
  echo '<tr align="left"><th>Make</th><th>Gauge</th><th>Comment</th></td>';
  $result_7 = $dbcl->query($query_7);
    while(list($id, $gauge_id, $make_id,$description) = $result_7->fetch_row())
    {
      $query_8= "SELECT gauge FROM gauge WHERE id = $gauge_id";
      $query_9 = "SELECT name FROM make WHERE id = $make_id";


      if(!(is_null($gauge_id)))
      {
        $result_8 = $dbcl->query($query_8);
        while(list($gauge) = $result_8->fetch_row())
        { $model_gauge = $gauge; }
        $result_8->free();
      } else { $model_gauge = 'Unknown'; }

      if(!(is_null($make_id)))
      {
        $result_9 = $dbcl->query($query_9);
        while(list($name) = $result_9->fetch_row())
        { $model_make = $name; }
        $result_9->free();
      } else { $model_make = 'Unknown'; }

     echo '<tr valign="top"><td>';
     if($parent <> 0){echo '&rarr;&nbsp;&nbsp;';}
     echo $model_make.'</td>';
     echo '<td>'.$model_gauge.'</td>';
     echo '<td>'.$description.'</td></tr>';
  }
  $result_7->free();
  echo '</table>';
  echo '<p><center>------------------------------------------------------------------------------------------</center></p>';
}

?>

