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
echo '<h2>Welcome to the Model Locomotive Database</h2>';
echo '<span class="byline"><p>It is a hope that these pages will contain a searchable index of model locomotives in all gauges both current and historic. Currently our oldest entry dates from 1901; a gauge 1 model of a LNER Class D16, former GER Class H88 Holden 4-4-0 made by Carette for Bassett-Lowke. The database also contains twenty-four entries for other models of this locomotive the latest being dated 2015.</p><p>Searches are available by Gauge, Engineer, Class, Fuel Type and Wheel Configuration 0-6-0, 4-6-0, Co-Co ect. Please be carefull when using multiple search filters as you may not get any results, similarly selecting no filters is likely return a lot of models.  The best method is probably to select one or two filters and leave the rest set to ALL. To get started click on a menu tab above for the company or grouping you want then folow the menu choices and apply your filters. Sounds complex but is easy to use.<p/><p>Good luck with your searches and enjoy the results, if you are unable find what you are looking for please be patient as more operating companies will be added to the menu selectionsshortly.</p></span>';
echo '</header>';
echo '<p>'.$pad.'</p>';
echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>
