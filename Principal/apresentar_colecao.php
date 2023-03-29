<?php
 	include "connection.php"; 

	if(isset($_GET['nome_colecao']))
	{
		$colecao = $_GET['nome_colecao'];
	}
?>

<!DOCTYPE html>
<html lang="pt-pt" class="no-js" class="dark-mode">
<head>
	<!-- meta character set -->
	<meta charset="UTF-8">
	<!-- Favicon-->
	<link rel="shortcut icon" href="img/favicon verde.png">
	<!-- Meta do autor -->
	<meta name="author" content="codepixer, Hugo Guimarães">
	<!-- Meta Keyword -->
	<meta name="keywords" content="Museu AEFH, ESFH, AEFH, Francisco de Holanda, Museu Francisco de Holanda">
	<!-- Meta Descruption -->
	<meta name="Description" content="Página Oficial do museu do Agrupamento de Escolas Francisco de Holanda">
	<!-- Meta para os telemóveis -->
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	
	
	<!-- Título -->
	<title>Museu AEFH</title>

	<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,400,300,500,600,700" rel="stylesheet"> 
		<!--
		CSS
		============================================= -->
		<link rel="stylesheet" href="css/linearicons.css">
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<link rel="stylesheet" href="fonts/Fork-Awesome-1.2.0/css/fork-awesome.min.css">
		<link rel="stylesheet" href="css/bootstrap.css">
		<link rel="stylesheet" href="css/magnific-popup.css">
		<link rel="stylesheet" href="css/nice-select.css">					
		<link rel="stylesheet" href="css/animate.min.css">
		<link rel="stylesheet" href="css/owl.carousel.css">
		<link rel="stylesheet" href="css/main.css">
		<link rel="stylesheet" href="css/dark-mode.css">
		<link rel="stylesheet" href="css/icon.css">

	</head>
	<body onload="data();">
		<!-- #header -->
		<header id="header" id="home" style="padding-top: 10px;">
		<div class="container">
			<div class="row align-items-center justify-content-between d-flex">
				
				<div id="logo">
					<a href="index.php"><img src="img/LOGO MEU.png" class="logo" alt="museu AEFH"></a>
				</div>

				<nav id="nav-menu-container">
				<div class="underlineEffects">
					<ul class="nav-menu">
						<li class="menu-active"><a href="#home">Início</a></li>
						<li><a href="index.php#sobre" alt="sobre">Sobre</a></li>
						<li><a href="index.php#colecoes">Coleções</a></li> 
						<li><a href="index.php#gallery">Galeria</a></li>
						<li><a href="index.php#visitas" id="btn_visitas" onclick="">Visitas</a></li>
						<li><a href="index.php#contactos">Contactos</a></li>
						<li>
							<a>
								<label class="toggle" for="darkSwitch">
									<div><input class="toggle__input" type="checkbox" id="darkSwitch" aria-label="modo escuro"><i class="material-icons" aria-label="modo escuro">brightness_4</i></div>
								</label>
							</a>
						</li>
						
					</ul>
				</div>
				</nav><!-- #nav-menu-container -->	

			</div>
		</div>
		</header>

			<!-- start banner Area -->
			<section class="banner-area relative" id="home">	
				<div class="overlay overlay-bg"></div>
				<div class="container">
					<div class="row d-flex align-items-center justify-content-center">
						<div class="about-content col-lg-12">
							<h1 class="text-white text-shadow">
								<strong>COLEÇÕES</strong>			
							</h1>	
						</div>											
					</div>
				</div>
			</section>
			<!-- End banner Area -->	


			<!-- Start gallery Area -->
			<section class="gallery-area section-gap gallery-page-area contrast" id="gallery">

				<div class="container">
					<div class="row d-flex justify-content-center">
						<div class="menu-content pb-70 col-lg-8">
							<div class="title text-center">
								<h1 class="mb-10"><?php echo "Coleção ". $colecao; ?></h1>
							</div>
						</div>
					</div>

					<div id="galeria" class="container-fluid justify-content-center">
						<?php
							$sql = "SELECT Objetos.*, Categoria, Nome_Colecao FROM Objetos INNER JOIN Categorias INNER JOIN Colecoes ON Objetos.Id_Categoria=Categorias.Id_Categoria AND Objetos.Id_Colecao=Colecoes.Id_Colecao WHERE Objetos.Id_Estado=1 AND Nome_Colecao='$colecao' ORDER BY Data ";

							Mostrar($sql);
						?>
					</div>
				</div>	
			</section>
			<!-- End gallery Area -->			
			

			<!-- Começo Footer -->		
		<footer class="footer-area section-gap contrast">
			<div class="container">
				<div class="row">

					<div class="col-lg-5 col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<h6>Copyright</h6>
							<p class="footer-text">
								<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
Copyright &copy;<script>document.write(new Date().getFullYear());</script> All rights reserved | This template is made with <i class="fa fa-heart-o" aria-hidden="true"></i> by <a href="https://colorlib.com" target="_blank">Colorlib</a> and distributed by <a href="https://themewagon.com" target="_blank">ThemeWagon</a>
<!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
							</p>
						</div>
					</div>

					<div class="col-lg-5  col-md-6 col-sm-6">
						<div class="single-footer-widget">
							<h6>Notícias</h6>
							<p>Fique atualizado com as nossas notícias</p>
							
								<form name="form_email" action="noticias.php" method="POST" class="form-inline" onsubmit="alert('Email registado com sucesso.');">
									<input class="form-control" name="email" placeholder="Introduza o seu e-mail" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Introduza o seu e-mail '" required="" type="email" required>
										<button class="click-btn btn btn-default" type="submit"><span class="lnr lnr-arrow-right"></span></button>
										<div style="position: absolute; left: -5000px;">
											<input name="b_36c4fd991d266f23781ded980_aefe40901a" tabindex="-1" value="" type="text">
										</div>

									<div class="info"></div>
								</form>
						</div>
					</div>

					<div class="col-lg-2 col-md-6 col-sm-6 social-widget">
						<div class="single-footer-widget">
							<h6>Siga-nos</h6>
							<div class="footer-social d-flex align-items-center">
								<a href="https://www.instagram.com/aefranciscoholanda/" target="_blank"><i class="fa fa-instagram"></i></a>
								<a href="https://www.facebook.com/AgrupamentoDeEscolasFranciscoDeHolanda/" target="_blank"><i class="fa fa-facebook"></i></a>
								<a href="https://discord.gg/E2uXGVYmwm" target="_blank"><i class="fa fa-discord" aria-hidden="true"></i></a>
								<a href="https://www.youtube.com/user/AeFranciscoHolanda" target="_blank"><i class="fa fa-youtube"></i></a>
							</div> <br>
							<p>Acesso reservado a <a href="../Administrador/Login/index.php" class="footer-text" target="_blank"><i>Administradores</i></a></p>
						</div>
					</div>

					
				</div>
			</div>
		</footer>	
		<!-- Fim Footer -->		

			<script src="js/vendor/jquery-2.2.4.min.js"></script>
			<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
			<script src="js/vendor/bootstrap.min.js"></script>
			<script type="text/javascript" src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBhOdIF3Y9382fqJYt5I_sswSrEw5eihAA"></script>
			<script src="js/easing.min.js"></script>			
			<script src="js/hoverIntent.js"></script>
			<script src="js/superfish.js"></script>	
			<script src="js/jquery.ajaxchimp.min.js"></script>
			<script src="js/jquery.magnific-popup.min.js"></script>	
			<script src="js/owl.carousel.min.js"></script>	
			<script src="js/imagesloaded.pkgd.min.js"></script>
			<script src="js/justified.min.js"></script>					
			<script src="js/jquery.sticky.js"></script>
			<script src="js/jquery.nice-select.min.js"></script>			
			<script src="js/parallax.min.js"></script>
			<script src="js/main.js"></script>
			<script src="js/dark-mode-switch.js"></script>
		</body>
	</html>

<?php 
	function Mostrar($sql)
	{
		include "connection.php";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {?>
			<a href="./apresentar.php?id_objeto=<?php echo $row['Id_Objeto'];?>"><img class="img-responsive" src="../Administrador/Base de dados/Imagens/Objetos/<?php echo $row['Fotografia'];?>" alt="<?php echo $row["Nome_Objeto"] ?>"></a>
		<?php }

		include "close.php";
	}
?>

