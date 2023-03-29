<?php include "connection.php"; ?>

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
					<a href="index.php"><img src="img/LOGO MEU.png" alt="museu AEFH"></a> <!-- em caso de erro, colocar a class logo -->
				</div>

				<nav id="nav-menu-container">
				<div class="underlineEffects">
					<ul class="nav-menu">
						<li class="menu-active"><a href="#home">Início</a></li>
						<li><a href="#sobre" alt="sobre">Sobre</a></li>
						<li><a href="#colecoes">Coleções</a></li> 
						<li><a href="#gallery">Galeria</a></li>
						<li><a href="#visitas" id="btn_visitas" onclick="">Visitas</a></li>
						<li><a href="#contactos">Contactos</a></li>
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


		<!-- Começo banner-->
		<section class="banner-area relative" id="home">
			<div class="overlay overlay-bg"></div>	
			<div class="container">
				<div class="row fullscreen d-flex align-items-center justify-content-center">
					<div class="banner-content col-lg-8">	
						<h1 class="text-white">
							Museu AEFH				
						</h1>
						<p class="pt-20 pb-20 text-white">
							Visite-nos e descubra um pouco daquilo que faz as nossas memórias ao longo de mais de um século de existência, ao serviço da comunidade
						</p>
						<a href="#gallery" class="primary-btn text-uppercase">Galeria</a>
					</div>											
				</div>
			</div>					
		</section>
		<!-- Fim banner -->	
		
		<!-- Começo Sobre -->
		<section class="quote-area section-gap contrast" id="sobre">
			<div class="container">
				
				<div class="row d-flex justify-content-center">
					<div class="menu-content pb-20 col-lg-8 pt-20">
						<div class="title text-center">
							<h1 class="mb-10">SOBRE</h1>
							<p><!-- Caso se queira escrever alguma coisa debaixo do sobre --></p>
						</div>
					</div>
				</div>
				
				<div class="row pb-20">
					<div class="col-lg-6 quote-left">
						<h1>
							O <span>Passado</span> como referência para <br>
							 o <span>Presente</span>, e contributo <br>
							  para o <span>Futuro</span>.
						</h1>
					</div>
					
					<div class="col-lg-6 quote-right">
						<p>
							&nbsp;A Escola Secundária Francisco de Holanda, para além de ser uma escola, também é um museu, onde possui coleções históricas de grande valor patrimonial, e são disponibilizadas mais de 600 peças, devidamente tratadas, identificadas e catalogadas, organizadas em armários por temas e áreas disciplinares correspondentes aos diversos cursos que funcionaram na nossa Escola, desde 1885 até aos nossos dias. Trata-se de objetos adquiridos por compra, por oferta, ou produzidos por alunos e professores cuja datação vai desde finais do século XIX.
							<br>&nbsp;O material didático em exposição é bastante diverso e corresponde a um período temporal de mais de 130 anos.  Na verdade, os objetos musealizados compreendem o período temporal de finais do século XIX até à atualidade, pois é considerado objeto de museu qualquer peça que deixou de ser utilizada. Destacamos ainda o valioso património artístico em exposição permanente nos mais diversos espaços da escola
							<br>&nbsp;Este espaço é um local que vale a pena conhecer, enriquece-nos e dá-nos um sentido de pertença, pois entendemos que sem memórias não há futuro!
						</p>
					</div>
				</div>
			</div>	
		</section>
		<!-- Fim Sobre-->

		<!-- Começo Área de coleções -->
		<section class="exibition-area section-gap contrast2" id="colecoes">
			<div class="container">
				<div class="row d-flex justify-content-center">
					<div class="menu-content pb-60 col-lg-10 pt-20">
						<div class="title text-center">
							<h1 class="mb-10">COLEÇÕES</h1>
						</div>
					</div>
				</div>						
				<div class="row">
					<div class="active-exibition-carusel">

						<?php 
							$sql = "SELECT * FROM Colecoes WHERE Nome_Colecao!='Sem Coleção';";
							
							$result = mysqli_query($conn, $sql);
							
							while ($row = mysqli_fetch_assoc($result)) {
						?>
								<div class="single-exibition item">
									<a href="apresentar_colecao.php?nome_colecao=<?php echo $row['Nome_Colecao'];?>"><img class="rounded noticias" src="../Administrador/Base de dados/Imagens/Colecoes/<?php echo $row["Fotografia"]; ?>" alt="<?php echo "Coleção ". $row["Nome_Colecao"] ?>"></a> <br>
									<a class="text-center" href="apresentar_colecao.php?nome_colecao=<?php echo $row['Nome_Colecao'];?>"><h4><?php echo $row["Nome_Colecao"] ?> </h4></a>
								</div>
								
						<?php  }  ?>	
					
					</div>													
				</div>
			</div>	
		</section>
		<!-- Fim Área de novidades  -->

		<!-- Começo Galeria -->
		<section class="gallery-area section-gap gallery-page-area contrast" id="gallery">
			<?php include "galeria.php"; ?>
		</section>
		<!-- Fim Galeria -->

		<!-- Começo Formulário Visitas -->
		<section class="contact-page-area section-gap contrast2" id="visitas">
			<?php include "visitas.php"; ?>
		</section>
		<!-- Fim formulário Visitas -->

		<!-- Começo Contactos -->
		<section class="contact-page-area section-gap contrast" id="contactos">
			<?php include "contactos.php"; ?>
		</section>
		<!-- Fim Contactos -->
		
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
		<!-- JavaScript Bundle with Popper -->
	</body>
</html>

<!-- Modal de visita requesitada com sucesso-->


<div class="modal fade" id="visita">
  <div class="modal-dialog modal-lg">
    <div class="modal-content contrast">
      <div class="modal-body">
        
        <!--O conteúdo do modal começa aqui-->
				<div class="container">
					<a href="index.php">
						<h1 class="close"><span aria-hidden="true">&times;</span></h1>
					</a>

					<div class="text-center">
						<img src="./img/verificado.png" class="hg-img">
					</div>


					<div class="text-center">
						<h1 class="text-green">FORMULÁRIO ENVIADO COM SUCESSO </h1>
					</div>
					
					<div class="text-center">
						<h4 class="mb-40">Espere até que o seu pedido seja aceite. </h4>
					</div>

					<div class="text-center">
						<p>Pode ser que a sua mensagem possa vir a parar no spam.</p>
					</div>

				</div>
        

      </div>
    </div>
  </div>
</div>
<!-- Fim Modal de visita requesitada com sucesso -->

<script>
    function data()
    {
			// Obtém a data/hora atual
			var data = new Date();
			data.setDate(data.getDate()+4)

			// Guarda cada pedaço em uma variável
			var dia     = data.getDate();           // 1-31
			var mes     = data.getMonth();          // 0-11 (zero=janeiro)
			var ano    = data.getFullYear();       // 4 dígitos
			mes = mes+1

			// Formata a data
			if (dia<10)
			{
					dia = "0" + dia;
			}
			if (mes<10)
			{
					mes = "0" + mes;
			}

			var str_data = ano + '-' + mes + '-' + dia;

			document.getElementById("dia").min = str_data;
    }
</script>

<?php
if(isset($_GET["sucesso"]) && $_GET["sucesso"]==1) {
?>
<script>
	$(document).ready(function(){
	// Show the Modal on load
	$("#visita").modal("show");
	});
</script>

<?php } ?>