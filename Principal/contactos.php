<!-- Começo Contactos -->
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content pb-40 col-lg-8 pt-20">
			<div class="title text-center">
				<h1 class="mb-10">CONTACTOS</h1>
				<p><!-- Caso eu queira adicionar alguma coisa a baixo dos contactos --></p>
			</div>
		</div>
	</div>
</div>

<div class="container">
	<div class="row">
		<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2990.740728277678!2d-8.2969923!3d41.4448471!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0xd24e57e013b0127%3A0x36832a4ac8e3e055!2sEscola%20Secund%C3%A1ria%20Francisco%20de%20Holanda!5e0!3m2!1spt-PT!2sus!4v1634914858878!5m2!1spt-PT!2sus" class="map-wrap" width="100%" height="445px" style="border:0;" allowfullscreen="" loading="lazy" id="map"></iframe>
		
		<div class="col-lg-4 d-flex flex-column address-wrap">
			<div class="single-contact-address d-flex flex-row">
				<div class="icon">
					<span class="lnr lnr-home"></span>
				</div>
				<div class="contact-details">
					<h5>Alameda Dr. Alfredo Pimenta</h5>
					<p>4814-528 Guimarães</p>
				</div>
			</div>
			<div class="single-contact-address d-flex flex-row">
				<div class="icon">
					<span class="lnr lnr-phone-handset"></span>
				</div>
				<div class="contact-details">
					<h5>253 540 130</h5>
					<p>Telefone da escola</p>
				</div>
			</div>
			<div class="single-contact-address d-flex flex-row">
				<div class="icon">
					<span class="lnr lnr-envelope"></span>
				</div>
				<div class="contact-details" style="padding: 5px;">
					<h5>geral@esfh.pt</h5>
				</div>
			</div>														
		</div>
		
		<div class="col-lg-8">
			<form class="form-area " id="myForm" action="comentario.php" method="post" onsubmit="alert('Mensagem enviada com sucesso!');" class="contact-form text-right">
				<div class="row">	
					<div class="col-lg-6 form-group">
						<input name="nome" placeholder="Nome" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Nome'" class="common-input mb-20 form-control" required="" type="text">
					
						<input name="email" placeholder="E-mail" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Email'" class="common-input mb-20 form-control" required="" type="email">

						<input name="assunto" placeholder="Assunto" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Assunto'" class="common-input mb-20 form-control" required="" type="text">
						<div class="mt-20 alert-msg" style="text-align: left;"></div>
					</div>
					<div class="col-lg-6 form-group">
						<textarea class="common-textarea form-control" name="mensagem" placeholder="Mensagem" onfocus="this.placeholder = ''" onblur="this.placeholder = 'Messege'" required="" style="height: 190px; resize: none;"></textarea>
						<button class="primary-btn mt-20 text-white" style="float: right;">Enviar Mensagem</button>									
					</div>
				</div>
			</form>	
		</div>

	</div>
</div>
<!-- Fim Contactos -->