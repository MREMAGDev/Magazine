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
                                                                        <li><a href="">Statements</a>
                                                                                <ul>
                                                                                        <li><a href="chair.php">Chairman's Statement</a></li>
                                                                                        <li class="active"><a href="tech.php">IT Statement</a></li>
                                                                                </ul>
                                                                        </li>
                                                                        <li><a href="news.php">News</a></li>
                                                                        <li><a target="_blank" href="phpBB3/index.php">Have Your Say</a></li>
                                                                        <li><a href="">eMagazine</a>
                                                                                <ul>
                                                                                        <li><a href="mag_access.php">How To Access</a></li>
                                                                                        <li><a target="_blank" href="https://issuu.com/drmepublishingltd/docs/model_railway_express_issue_one_dec?e=26483431/41082382">Issue 1: December 2016</a>
                                                                                           <ul>
                                                                                                <li><a target="_blank" href="https://issuu.com/drmepublishingltd/docs/model_railway_express_issue_one_dec?e=26483431/41082382">Go to Issue 1</a>
                                                                                                <li><a href="contents.php?ino=1">Contents</a></li>
                                                                                            </ul>
                                                                                        </li>
                                                                                        <li><a target="_blank" href="https://issuu.com/drmepublishingltd/docs/issue_two_30_jan_17?e=26483431/43750506">Issue 2: February 2017</a>
                                                                                                <ul>
                                                                                                        <li><a target="_blank" href="https://issuu.com/drmepublishingltd/docs/issue_two_30_jan_17?e=26483431/43750506">Go to Issue 2</a>
                                                                                                        <li><a href="contents.php?ino=2">Contents</a></li>
                                                                                                </ul>
                                                                                        </li>
                                                                                        <li><a target="_blank" href="https://issuu.com/drmepublishingltd/docs/issue_three_31_march_2017?e=26483431/46630109;">Issue 3: April 2017</a>
                                                                                                <ul>
                                                                                                        <li><a target="_blank" href="https://issuu.com/drmepublishingltd/docs/issue_three_31_march_2017?e=26483431/46630109">Go to Issue 3</a>
                                                                                                        <li><a href="contents.php?ino=3">Contents</a></li>
                                                                                                </ul>
                                                                                        </li>
                                                                                        <li><a href="magsearch.php">Search</a></li>
                                                                                </ul>
                                                                        </li>
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
                              <?php include('php/showtech.php'); ?>
	<!-- Footer -->
		<div id="footer">
		              <?php include('php/footer.php'); ?>	
		</div>

	</body>
</html>
