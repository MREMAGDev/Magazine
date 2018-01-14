<?php include('php/build_ad_array.php'); ?>
<div class="wrapper style2">
    <section class="container">
        <div class="11u">
            <table>
                <tr><td valign="top" >
                    <?php 
                        include('php/display_ads.php'); 
                        echo '</td><td>'.$pad.$pad.'</td><td valign="top" >';
                        $compheader_query="SELECT oc.name, oc.summary FROM opcompany oc WHERE oc.id = $compid";
                        $compheader_result=$dbcl->query($compheader_query);
                        while(list($compname,$summary) = $compheader_result->fetch_row()) {
                            echo  '<header class="major"><h2><center>Model Loco Database Search</br>'.$compname.'</center></h2></header>';
                            #echo '<span class="byline"><center>'.$summary.'</center></span>';
                            echo '<center>'.$summary.'</center>';
                        } 
                        $compheader_result->free();
  		    ?>
                    <form action="loco_results.php" name="ls_search" id="ls_form" method="post">
                        <?php
                            $query="SELECT id,description FROM arrangement WHERE id IN (SELECT distinct(arrange_id) FROM prototype WHERE company_id = $compid GROUP BY arrange_id HAVING COUNT(arrange_id) > 0) ORDER by description";
  		            $a_result = $dbcl->query($query);
                            $num_arrangements=$a_result->num_rows;
  			    $query="SELECT c.id, c.name FROM class c WHERE c.id IN (SELECT distinct(p.class_id) FROM prototype p WHERE p.company_id = $compid AND (SELECT COUNT(*) FROM model m WHERE m.proto_id = p.id) > 0 GROUP BY p.class_id HAVING COUNT(p.class_id) > 0) ORDER by c.name";
  			    $c_result = $dbcl->query($query);
                            $num_classes=$c_result->num_rows;
  			    $query="SELECT id,name FROM engineer WHERE id IN (SELECT distinct(engineer_id) FROM prototype WHERE company_id = $compid GROUP BY engineer_id HAVING COUNT(engineer_id) > 0) ORDER by name";
  			    $e_result = $dbcl->query($query);
                            $num_engineers=$e_result->num_rows;
                            if($num_classes == $num_arrangements) {
                               echo '<input type=hidden id="eclass" value="0">'; 
                            } else {
                                if($num_classes > 1) {
                                    if($num_classes > 3) {$list_size = 5;} else {$list_size = $num_classes + 1;}
                                    echo '<p><select id="eclass[]" name="eclass[]" size="'.$list_size.'" multiple="multiple" >';
                                    echo '<option value="0" selected>ALL</option>';
                                    while(list($id,$name) = $c_result->fetch_row()) {
    				    echo '<option value="'.$id.'">'.$name.'</option>';
                                    }
                                    echo '</select></p>';
                                } else { echo '<input type=hidden id="eclass" value="0">'; }
                            }
                            $c_result->free();
                            if($num_engineers > 1) {
                                if ($num_engineers > 3) {$list_size = 5;} else {$list_size = $num_engineers + 1;}
                                echo '<p><select id="engineer[]" name="engineer[]" size="'.$list_size.'" multiple="multiple" >';
                                echo '<option value="0" selected>ALL</option>';
                                while(list($id,$name) = $e_result->fetch_row()) {
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                }
                                echo '</select></p>';
                            } else { echo '<input type=hidden id="engineer" value="0">'; }
                            $e_result->free();
                            if($num_arrangements > 1) {
                                if($num_arrangements > 3) {$list_size = 5;} else {$list_size = $num_arrangements + 1;}
                                echo '<p><select id="arrangement[]" name="arrangement[]" size="'.$list_sixe.'" multiple="multiple" >';
                                echo '<option value="0" selected>ALL</option>';
                                while(list($id,$name) = $a_result->fetch_row()) {
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                }
                                echo '</select></p>';
                            } else { echo '<input type=hidden id="arrangement" value="0">'; }
                            $a_result->free();
                            if($num_classes < 2 && $num_engineers < 2 && $num_arrangements < 2) {
                                $button_text = "Select";
                                echo '<p><center>There seems only to be one class of locomotive available that is linked to this company. Press the "'.$button_text.'" button below to view the models of the locomotive used by this company.</center></p>';
                            } else {$button_text = "Submit";}
                            echo '<p><center><button type="submit" value="submit">'.$button_text.'</button></center></p>';
                        ?>
                    </form>
                </td></tr>
            </table>
        </div>
    </section>
</div>

