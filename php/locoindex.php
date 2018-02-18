<?php

include('php/build_ad_array.php');

echo '<div class="wrapper style2">';
echo '<section class="container">';
echo '<div class="row double">';
echo '<div class="11u">';

echo '<table>';
echo '<tr><td valign="top">';

include('php/display_ads.php');

echo '</td><td>'.$pad.$pad.'</td><td valign="top" >';
include('php/greenbutton.php');
echo '<header class="major">';
if($menutype == 0) {
echo '<center><h2>Welcome to the Model Locomotive Database</h2></center>';
echo '<span class="byline"><p>These pages will contain a searchable index of model locomotives in all gauges both current and historic and we will endeavour to keep it up to date with updates on a regular basis.</p><p>Currently our oldest entry dates from 1901; a gauge 1 model of a LNER Class D16, former GER Class H88 Holden 4-4-0 made by Carette for Bassett-Lowke however, the database also contains twenty-four entries for other models produced of this locomotive the latest being produced in 2015.</p><p>Searches are available by Gauge (e.g. Standard, Narrow Gauge etc.) , Engineer (e.g. Collett, Stanier, Gresley, Riddles etc.), Class (e.g. Castle, Princess, A4, etc), and Wheel Configuration (e.g.  0-6-0, 4-6-0, Co-Co etc.).</p><p>Please be careful when using multiple search filters as you may not get any results, similarly selecting no filters is likely return a lot of models. The advised method is to select an item in one of the search fields and leave the other search fields set to "ALL".</p><p>To get started using the database click on a menu tab for the company or grouping you want at the top of the page then follow the menu choices and apply your filters. It sounds complex but is easy to use and you will quickly get the hang of it.</p><p>The "Model Locomotive Database" has been derived from freely available data that has been collected, collated, compiled and then gifted to MRE-Mag by Dennis Lovett. His outstanding work was delivered in series of a Word documents that have been successfully converted into a searchable database format by our excellent Web Site and Database guy, Robert Bradford. This is still a work in progress as we hope to add updates and more data fields.</p><p>Good luck with your searches and we hope you enjoy the results and find the database useful.</p></span>';
} else {
echo '<center><h2>Welcome Model Locomotive Database Narrow Gauge Section</h2></center>';
echo '<span class="byline"><p>It is a hope that these pages will contain a searchable index of model narrow gauge locomotives in all gauges both current and historic. Searches are available by Gauge, Engineer, Class, and Wheel Configuration 0-6-0, 4-6-0, Co-Co ect. Please be carefull when using multiple search filters as you may not get any results, similarly selecting no filters is likely return a lot of models.  The best method is probably to select one or two filters and leave the rest set to ALL. To get started click on a menu tab above for the company or grouping you want then folow the menu choices and apply your filters. Sounds complex but is easy to use.<p/><p>The "Model Locomotive Database" has been derived from freely available data that has been collected, collated, compiled and then gifted to MRE-Mag by Dennis Lovett. His outstanding work was delivered in series of a Word documents that have been successfully converted into a searchable database format by our excellent Web Site and Database guy, Robert Bradford. This is still a work in progress as we hope to add updates and more data fields.</p><p>Good luck with your searches and enjoy the results.</p></span>';
}
echo '</header>';
echo '<p>'.$pad.'</p>';
echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>
