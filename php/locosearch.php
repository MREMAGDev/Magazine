<?php include('php/build_ad_array.php'); ?>
<div class="wrapper style2">
    <section class="container">
        <div class="11u">
            <table>
                <tr><td style="vertical-align: top;"  >
                    <?php 
                        include('php/display_ads.php'); 
                        $all_present = 0;
                        echo '</td><td>'.$pad.$pad.'</td><td style="vertical-align: top;" >';
                        $compheader_query="SELECT oc.name, oc.summary FROM opcompany oc WHERE oc.id = $compid";
                        $compheader_result=$dbcl->query($compheader_query);
                        while(list($compname,$summary) = $compheader_result->fetch_row()) {
                            echo  '<header class="major"><h2><center>Model Loco Database Search</br>'.$compname.'</center></h2></header>';
                            if(isset($summary)) {echo '<center>'.$summary.'</center><p>&nbsp;</p>';}
                        } 
                        $compheader_result->free();
                        echo '<center><a href="locohelp.php?mt='.$menutype.'&id='.$compid.'&gu='.$gauge_id.'"><button>Search Help Tips</button></a></center><p>'.$pad.'</p>';
                    ?>
                    <form action="loco_results.php" name="ls_search" id="ls_form" method="post">
                        <?php
                            if($gauge_id > 0) {$gauge_filter = "AND p.protogauge_id = {$gauge_id}";} else {$gauge_filter = "";}
                            #echo "Gauge_Filiter = ".$gauge_filter." - Gauge_id = ".$gauge_id;
                            $query="SELECT a.id, a.description FROM arrangement a WHERE a.id IN (SELECT distinct(p.arrange_id) FROM prototype p WHERE p.company_id = $compid $gauge_filter GROUP BY p.arrange_id HAVING COUNT(p.arrange_id) > 0) ORDER by a.description";
  		            $a_result = $dbcl->query($query);
                            $num_arrangements=$a_result->num_rows;
                            if($num_arrangements > 1) {$all_present++;}
  			    $query="SELECT c.id, c.name FROM class c WHERE c.id IN (SELECT distinct(p.class_id) FROM prototype p WHERE p.company_id = $compid $gauge_filter AND (SELECT COUNT(*) FROM model m WHERE m.proto_id = p.id) > 0 GROUP BY p.class_id HAVING COUNT(p.class_id) > 0) ORDER by c.name";
  			    $c_result = $dbcl->query($query);
                            $num_classes=$c_result->num_rows;
                            if($num_classes > 1) {$all_present++;}
  			    $query="SELECT e.id, e.name FROM engineer e WHERE e.id IN (SELECT distinct(p.engineer_id) FROM prototype p WHERE p.company_id = $compid $gauge_filter GROUP BY p.engineer_id HAVING COUNT(p.engineer_id) > 0) ORDER by e.name";
  			    $e_result = $dbcl->query($query);
                            $num_engineers=$e_result->num_rows;
                            if($num_engineers > 1) {$all_present++;}
			    $arrangement_help="Use the selection list opposite to restrict the search to Locomotives having a specific wheel configuration of a set of configurations.";
                            if($num_classes > 1) {$arrangement_help .= " Selecting any value other than ALL from this list will disable Loco Class selector.";}
                            $class_help="Use the selection list opposite to restrict the search to a single or list of locomotive classes.";
                            if($num_arrangements > 1 OR $num_engineers > 1) {
                               $class_help .= " Selecting any value other than ALL will disable both the Engineer and Wheel Arrangement selection lists.";
                            }
                            $engineer_help="Use the selection list opposite to restrict the search to Locomotives designed by a specific engineer, or a list of engineers.";
                            if($num_classes > 1) {$engineer_help .= " Selecting any value other than ALL from this list will disable the Loco Class selector.";}
                            echo '<table>';
                            if($all_present == 3) {$disabled = "disabled";} else {$disabled="";}
                            if($num_classes > 1) {
                                if($num_classes > 6) {$list_size = 7;} else {$list_size = $num_classes + 1;}
                                echo '<tr><td colspan="2"><center>Select Loco Class</center></td></tr><tr><td style="vertical-align: center;">';
                                echo '<p><select id="eclass[]" name="eclass[]" size="'.$list_size.'" multiple="multiple" width="300" style="width: 300px" '.$disabled.'>';
                                echo '<option value="0" selected>ALL</option>';
                                while(list($id,$name) = $c_result->fetch_row()) {
    				    echo '<option value="'.$id.'">'.$name.'</option>';
                                }
                                echo '</select></p>';
                                echo '</td><td style="vertical-align: top;padding: 10px;">'.$class_help.'</td></tr>';
                            } else { echo '<input type=hidden name="eclass[]" value="0" />'; }
                            $c_result->free();
                            if($num_engineers > 1) {
                                if ($num_engineers > 6) {$list_size = 7;} else {$list_size = $num_engineers + 1;}
                                echo '<tr><td colspan="2"><center>Select Engineer</center></td></tr><tr><td style="vertical-align: center;">';
                                echo '<p><select id="engineer[]" name="engineer[]" size="'.$list_size.'" multiple="multiple" width="300" style="width: 300px" '.$disabled.'>';
                                echo '<option value="0" selected>ALL</option>';
                                while(list($id,$name) = $e_result->fetch_row()) {
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                }
                                echo '</select></p>';
                                echo '</td><td valign="top" style="vertical-align: top;padding: 10px;">'.$engineer_help.'</td></tr>';
                            } else { echo '<input type=hidden name="engineer[]" value="0" />'; }
                            $e_result->free();
                            if($num_arrangements > 1) {
                                if($num_arrangements > 6) {$list_size = 7;} else {$list_size = $num_arrangements + 1;}
                                echo '<tr><td colspan="2"><center>Select Wheel Arrangement</center></td></tr><tr><td style="vertical-align: center;">';
                                echo '<p><select id="arrangement[]" name="arrangement[]" size="'.$list_size.'" multiple="multiple" width="300" style="width: 300px" ',$disabled.'>';
                                echo '<option value="0" selected>ALL</option>';
                                while(list($id,$name) = $a_result->fetch_row()) {
                                    echo '<option value="'.$id.'">'.$name.'</option>';
                                }
                                echo '</select></p>';
                                echo '</td><td valign="top" style="vertical-align: top;padding: 10px;">'.$arrangement_help.'</td></tr>';
                            } else { echo '<input type=hidden name="arrangement[]" value="0" />'; }
                            echo '</table>';
                            $a_result->free();
                            if($num_classes < 2 && $num_engineers < 2 && $num_arrangements < 2) {
                                $button_text = "Select";
                                echo '<p><center>There seems only to be one class of locomotive available that is linked to this company. Press the "'.$button_text.'" button below to view the models of the locomotive used by this company.</center></p>';
                            } else {$button_text = "Submit";}
                            echo '<input type=hidden name="compid" value="'.$compid.'" />';
                            echo '<input type=hidden name="gaugeid" value="'.$gauge_id.'" />';
                            echo '<input type=hidden name="menutype" value="'.$menutype.'" />';
                            echo '<p><center><button type="submit" value="submit">'.$button_text.'</button></center></p>';
                        ?>
                    </form>
                </td></tr>
            </table>
        </div>
    </section>
</div>
