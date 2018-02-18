<?php

include('php/build_ad_array.php');

if($company_id == 0) {
   $return_link = "locoindex.php?mu=".$menutype;
} else {
   $return_link = "locosearch.php?mt=".$menutype."&id=".$company_id;
   if($guage_id >= 2) {$return_link .= "&gu=".$guage_id;}
}

echo '<div class="wrapper style2">';
echo '<section class="container">';
echo '<div class="row double">';
echo '<div class="11u">';

echo '<table>';
echo '<tr><td valign="top">';

include('php/display_ads.php');

echo '</td><td>'.$pad.$pad.'</td><td valign="top" >';
echo '<header class="major"><center>Loco Database Search Tips</center></header>';
echo '<p>1. Class Selector:</br>&nbsp;</br>This selection list allows you to choose one or several types (classes) of locomotives.  Using this section list also disables the Engineer and Wheel Arrangement selection lists on this page.  Reset this to ALL to reactivate the other selection lists.</p><p>2. Engineer Selector:</br>&nbsp;</br>This selection lists allows locomotives designed by the selected engineer or engineers to be listed. This can be used in conjunction with the wheel arrangement selector to further filter the results. Using this selector disables the Locomotive Class selection list.</p><p>3. Wheel Arrangement Selector:</br>&nbsp;</br>This selection lists allows locomotives with a specific wheel arrangement, Whyte notation is used, e.g 4-6-0, 0-4-0 , Bo-Bo ect. This can be used in conjunction with the engineer selector to further filter the results. Using this selector disables the Locomotive Class selection list.</p><p>Note:</br>&nbsp;</br>Both the Engineer selector and the Wheel arrangement selector must be reset to ALL in order to reactivate the Class Selection List.</p><p><center><a href="'.$return_link.'"><button>Return To Search Page</button></a>';
echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>
