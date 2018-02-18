<?php

include('php/build_ad_array.php');

echo '<div class="wrapper style2">';
echo '<section class="container">';
echo '<div class="row double">';
echo '<div class="11u">';

echo '<table>';
echo '<tr><td valign="top">';

include('php/display_ads.php');

echo '</td><td>'.$pad.$pad.'</td><td valign="top">';

include('php/greenbutton.php');

echo '<header class="major">';
echo '<H2><center>eMag Access</center></H2>';
echo '</header><center>';
echo '<p><b>How to access the eMagazine.</b></p></center><p>The eMagazine is hosted on the "Issuu" platform and is available to read on PC, MacOS, iPad (iOS 7.0 or later), iPhone (iOS 7.0 or later) & Android OS (v4.0 or later) Mobile Devices.To read the magazine on a mobile device just download the "Issuu App" for iPhone & iPad from the Apple App store and for Android from the Google Play Store.</p><p>Please remember that "Model Railway Express eMagazine" is produced by a group of Model Railway enthusiasts, such as yourself, none of us are professionals nor are we paid anything (in fact all of us have day jobs and do this in our spare time!) and we do this just for the love of railways and railway modelling.</p>';

echo '</td></tr>';
echo '</table>';

echo '</div>';
echo '</div>';
echo '</div>';
?>

