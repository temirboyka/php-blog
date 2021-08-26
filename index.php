<?php 

include_once("inc/functions.php");
 ?>


<!DOCTYPE html>
<html>
	<head>
		<title>Husniddin Temirov web saytiga hush kelibsiz!</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" type="text/css" href="main.css">
		<!--[if lt IE 9]>
		<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
		<![endif]-->
        <link rel="Stylesheet" type="text/css" href="style.css" />
		<link rel="Stylesheet" type="text/css" href="./bootstrap/css/bootstrap.min.css" />

		<script type="text/javascript" src="yoxview/yoxview-init.js"></script>

		
	</head>
	<body>
		
		<div class="container wrapper">
			<?php  include("inc/menu.php")     ?>
			<section class="courses">
				<?php 
				include("inc/content.php");


             
				 ?>  

            
			</section>
			<aside>

			<br> <br>
				<form action="index.php" method="GET">
					<input name="kalit_soz" type="text" size=30 >
					<input type="submit" value="Izlash">
				</form>
				<hr>

				<?php include ('inc/popular.php'); ?>

		

			
				<section class="contact-details">
					<h2>Foydali manbalar</h2>
					
					<a href="http://www.ziyonet.uz" target="_blank">ZIYONET</a>
					<a href="http://www.rtm.uz" target="_blank">RTM</a>
					<a href="http://www.multimedia.uz" target="_blank">MULTIMEDIA</a>
					<a href="http://www.edu.uz" target="_blank">EDU</a>

				</section>
					
			</aside>
			<footer>
		
				  Manzil: Namangan viloyati, Chortoq tumani, 
					Iftihor MFY, Shodlik ko'chasi <br>
					Web sayt: http://www.husniddin.uz <br>
					e-mail: temirov_husniddin@mail.ru<br>
					
					
			</footer>
		</div><!-- .wrapper -->
		<link rel="Stylesheet" type="text/css" href="./bootstrap/js/bootstrap.bundle.js" />

	<script type="text/javascript">
		    $(document).ready(function(){
		        $(".yoxview").yoxview();
		    });
		</script>


	
	</body>
</html>