<?php include('php/build_ad_array.php'); ?>
<div class="wrapper style2">
    <section class="container">
        <div class="11u">
            <table>
                <tr><td style="vertical-align: top;"  >
                    <?php 
                        include('php/display_ads.php'); 
                        echo '</td><td>'.$pad.$pad.'</td><td style="vertical-align: top;" >';
                    ?>
                    <form action="indev_results.php" name="pipe_search" id="pipe_form" method="post">
                    <?php
                       echo '<input type=hidden name="menutype" value="'.$menutype.'" />';
                       if($gauge_id > 1) {
                          $gauge_filter = "p.protogauge_id > 1";
                          $gauge_desc = "Narrow";
                       } else {
                          $gauge_filter = "p.protogauge_id < 2";
                          $gauge_desc = "Standard";
                       }
                       echo  '<header class="major"><h2><center>Model Loco Database</br>'.$gauge_desc.' Gauge Model Planned Releases.</center></h2></header>';
                       $company_query="SELECT c.name, c.id FROM opcompany c WHERE c.id in(SELECT DISTINCT(p.company_id) FROM prototype p WHERE $gauge_filter AND p.id in(SELECT DISTINCT(m.proto_id) FROM model m WHERE m.status_id = 4)) ORDER BY c.name";
                       #$company_query="SELECT c.name, c.id FROM opcompany c WHERE c.id in(SELECT DISTINCT(p.company_id) FROM prototype p WHERE $gauge_filter AND p.id in(SELECT DISTINCT(m.proto_id) FROM model m WHERE m.status_id = 4)) AND c.id NOT IN (8,11) ORDER BY c.name";
                       $company_result = $dbcl->query($company_query);
                       $company_count = $company_result->num_rows;
                       if($company_count > 0) {
                         if($company_count > 1) {
                           echo "<center>Please select the the train companies whose planned models you wish to view from the list below.</center></br>".$pad."</br>";
                         }
                         while(list($company_name,$company_id) = $company_result->fetch_row()) {
                             if($company_count > 1) {
                                 echo '<input type="checkbox" name="opcompid[]" value="'.$company_id.'">'.$pad.$pad.$company_name.'</br>';
                             } else {
                                 echo "<center>These seems that ".$company_name." is the only ".strtolower($guage_desc)." gauge train company currently with pending models.</center></ br>";
                                 echo '<input type=hidden name="opcompid[]" value="'.$company_id.'" />';                               
                             }
                         }
                         $company_result->free();
                         echo '<p><center>Click the button below to view the pending models.</center></p>';
                         echo '<p><center><button type="submit" value="submit">Submit</button></center></p>';
                       } else { 
                         echo "Sorry there seem to be no ".strtolower($guage_desc)." gauge models pending at the moment.";
                         echo '<p><center><button onclick="history.back(-1)">Return</button></center></p>';
                       }
                    ?>
                    </form>
                </td></tr>
            </table>
        </div>
    </section>
</div>

