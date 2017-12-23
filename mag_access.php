<!DOCTYPE HTML>
<!--
	Solarize by TEMPLATED
	templated.co @templatedco
	Released for free under the Creative Commons Attribution 3.0 license (templated.co/license)
-->

<script type="text/javascript">
function MyPopUpWin(url, width, height) {
    var leftPosition, topPosition;
    //Allow for borders.
    leftPosition = (window.screen.width / 2) - ((width / 2) + 10);
    //Allow for title and status bars.
    topPosition = (window.screen.height / 2) - ((height / 2) + 50);
    //Open the window.
    window.open(url, "Window2",
    "status=no,height=" + height + ",width=" + width + ",resizable=yes,left="
    + leftPosition + ",top=" + topPosition + ",screenX=" + leftPosition + ",screenY="
    + topPosition + ",toolbar=no,menubar=no,scrollbars=yes,location=no,directories=no");
}
</script/>

<?php
  include('php/essentials.php');
?>
<html>
	<head>
<?php
		echo'<title>'.SITE_NAME.'</title>';
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
					<?php	/*	echo'<h1>'.SITE_NAME.'</h1>'; */ ?>
						
						<!-- Nav -->
						 <nav id="nav">
                                                               <ul>
                                                                        <li><a href="index.php">Home</a></li>
                                                                        
                                                                        <li><a href="news.php">News</a></li>
                                                                        <li><a target="_blank" href="phpBB3/index.php">Have Your Say</a></li>
                                                                        <?php include('php/magmenu.php'); ?>
                                                                        <li><a target="_blank" href="https://shop.spreadshirt.co.uk/MREMag">MREMag Shop</a></li>
                                                                </ul>
                                                        </nav>
					</div>
				</div>
				
			<!-- Banner -->
				<div id="banner">
					<section class="container">
						<?php 
                                                    echo'<h2>'.SITE_NAME.'</h2>'; 
						    echo'<span>'.STRAP_LINE.'</span>';
                                                ?>
					</section>
				</div>

			</div>
		
		<!-- Section One -->
                              <?php include('php/show_magaccess.php'); ?>
	<!-- Footer -->
		<div id="footer">
		              <?php include('php/footer.php'); ?>	
		</div>
        <!-- Usage Tracker --!>
        <?php include('html/tracker.html'); ?>
	</body>
</html>
