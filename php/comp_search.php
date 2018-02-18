<?php
  $query = "SELECT id AS company_id FROM opcompany WHERE name = '".$page."'";
  $opcompany = $dbc->query($query);
  while(list($company_id) = $opcompany->fetch_row())
  { $comp_id = $company_id; }
  $opcompany->free();
?>
<form action="results.php" method="post">
<?php echo '<input type="hidden" name="comp_id" value="'.$comp_id.'">'; ?>
<div class="post">
   <div class="header"><h3>Loco' Class Search.</h3></div>
   <div class="content">
<?php

  $query="SELECT c.id, c.name FROM class c WHERE c.id IN (SELECT distinct(p.class_id) FROM prototype p WHERE p.company_id = $comp_id AND (SELECT COUNT(*) FROM model m WHERE m.proto_id = p.id) > 0 GROUP BY p.class_id HAVING COUNT(p.class_id) > 0) ORDER by c.name";
  
  echo '<select id="eclass[]" name="eclass[]" size="5" multiple="multiple" >';
  echo '<option value="0" selected>ALL</option>';

  $result = $dbc->query($query);

  while(list($id,$name) = $result->fetch_row())
  {
    echo '<option value="'.$id.'">'.$name.'</option>';
  }
  $result->free();
  echo '</select>';
?>
   </div>
</div>

<div class="post">
   <div class="header"><h3>Engineer Search.</h3></div>
   <div class="content">
<?php
  $query="SELECT id,name FROM engineer WHERE id IN (SELECT distinct(engineer_id) FROM prototype WHERE company_id = $comp_id GROUP BY engineer_id HAVING COUNT(engineer_id) > 0) ORDER by name";
  echo '<select id="engineer[]" name="engineer[]" size="5" multiple="multiple" >';
  echo '<option value="0" selected>ALL</option>';

  $result = $dbc->query($query);

  while(list($id,$name) = $result->fetch_row())
  {
    echo '<option value="'.$id.'">'.$name.'</option>';
  }
  $result->free();
  echo '</select>';
?>
   </div>
</div>

<div class="post">
   <div class="header"><h3>Wheel Arrangement Search.</h3></div>
   <div class="content">
<?php
  $query="SELECT id,description FROM arrangement WHERE id IN (SELECT distinct(arrange_id) FROM prototype WHERE company_id = $comp_id GROUP BY arrange_id HAVING COUNT(arrange_id) > 0) ORDER by description";
  echo '<select id="arrangement[]" name="arrangement[]" size="5" multiple="multiple" >';
  echo '<option value="0" selected>ALL</option>';

  $result = $dbc->query($query);

  while(list($id,$description) = $result->fetch_row())
  {
    echo '<option value="'.$id.'">'.$description.'</option>';
  }
  $result->free();
  echo '</select>';
?>
   </div>
</div>

<div class="post">
  <div class="content">
     <center><input type="submit" /></center>
  </div>
</div>

</form>
