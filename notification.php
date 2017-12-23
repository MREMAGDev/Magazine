<!DOCTYPE HTML>
<!--
	Solarize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<html>
	<head>
<?php
		echo'<title>MREMag</title>'; 
?>
		<meta http-equiv="content-type" content="text/html; charset=utf-8" />
		<meta name="description" content="" />
		<meta name="keywords" content="" />
		<!--[if lte IE 8]><script src="css/ie/html5shiv.js"></script><![endif]-->
		<script src="js/jquery.min.js"></script>
		<script src="js/jquery.dropotron.min.js"></script>
		<script src="js/skel.min.js"></script>
		<script src="js/skel-layers.min.js"></script>
		<script src="js/init.js"></script>
		<noscript>
			<link rel="stylesheet" href="css/skel.css" />
			<link rel="stylesheet" href="css/style.css" />
		</noscript>
		<!--[if lte IE 8]><link rel="stylesheet" href="css/ie/v8.css" /><![endif]-->
	</head>
	<body class="homepage">

		<!-- Header Wrapper -->
			<div class="wrapper style1">
			
			<!-- Header -->
				<div id="header">
					<div class="container">
							
						<!-- Logo -->
					<?php		/* echo'<h1>MREMag</h1>'; */ ?>
						
						<!-- Nav -->
						
					</div>
				</div>
				
			<!-- Banner -->
				<div id="banner">
					<section class="container">
						<?php 
                                                    echo'<h2>MREMag</h2>'; 
						 ?>
					</section>
				</div>

			</div>
		
		<!-- Section One -->
		   <div class="wrapper style2">
                     <section class="container">
                     <div class="row double">
                       <div class="11u">
                         <header class="major">
                           <h2>Sorry!</h2>
                           <span class="byline">
                              <?php 
                                $textfile='downtext.txt';
                                if (file_exists($textfile))
                                {
                                  $fh = fopen($textfile, 'r');
                                  $filedata = fread($fh, 1);
                                  fclose($fh);
                                  echo $filedata;
                                } else {
                                  echo "Our Hosting Provider is currently experiencing technical issues, MREMag's IT team are aware of the problem and are working with the hosting provider to resolve the issue as soon as possible.";
                                  echo '</br>&nbsp;</br>';
                                  echo "Please try again later.";
				}                           
                              ?>
                          </span>
                        </header>
                      </div>
                    </div>
                  </div>
                              
                              
	<!-- Footer -->
		<div id="footer">
		              <?php include('php/footer.php'); ?>	
		</div>
        <!-- Usage Tracker --!>
        <?php include('html/tracker.html'); ?>
	</body>
</html>