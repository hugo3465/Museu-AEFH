<!-- Começo Formulário de visitas -->
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content pb-40 col-lg-8 pt-20">
			<div class="title text-center">
				<h1 class="mb-10">FORMULÁRIO DE VISITA</h1>
				<p>Preencha o formulário para marcar a sua visita.</p>
			</div>
		</div>
	</div>
</div>

	<div class="container">
	<form class="form-area " id="myForm" action="processa_visita.php" method="post" class="text-center"> <!-- class contact-form-->

		<hr><br>

		<div class="row">	
			<div class="col">

				<div class="col-lg-12"> <!-- Nome do Responsável -->
					<div class="form-group">
						<input type="text" class="common-input mb-20 form-control visitas" name="nome" id="nome" placeholder="Nome do Responsável" required>
						<label for="nome" class="control-label">Nome do Responsável</label>
					</div>
				</div>

				<div class="col-lg-12"> <!-- Localidade -->
					<div class="form-group">
						<input type="text" class="common-input mb-20 form-control visitas" name="localidade" id="localidade" placeholder="Localidade" required>
						<label for="localidade" class="control-label">Localidade</label>
					</div>
				</div>

				<div class="col-lg-12"> <!-- Email -->
					<div class="form-group">
						<input type="email" class="common-input mb-20 form-control" name="email" id="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email" required>
						<label for="email" class="control-label">Email</label>
					</div>
				</div>

				<div class="col-lg-12"> <!-- Se é Instituição ou não -->
					<select class="form-control mb-20 visitas" name="tipo" id="tipo" onchange="Tipo();" required>
						<option value="" disabled selected>Instituição</option>
						<option value="1">Sim</option>
						<option value="2">Não</option>
					</select>
				</div>

			</div>

		<div class="col-md-6">

			<div class="col-lg-12"> <!-- Nº de Telemóvel -->
				<div class="form-group">
					<input type="tel" class="common-input mb-20 form-control" name="telemovel" id="telemovel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" placeholder="Número de telemóvel" required>
					<label for="telemovel" class="control-label">Número de Telemóvel</label>
				</div>
			</div>

			<div class="col-lg-12"> <!-- Dia da Visita -->
				<div class="form-group">
					<input type="text" class="common-input mb-20 form-control" name="dia" id="dia" onfocus="(this.type='date')" onblur="(this.type='text')" placeholder="Dia da visita" required>
					<label for="dia" class="control-label">Dia da Visita</label>
				</div>
			</div>

			<div class="col-lg-12"> <!-- Hora da Visita -->
				<div class="form-group">
					<select class="form-control mb-20 visitas" name="hora" id="hora" required>
						<option value="" disabled selected>Horário da visita</option>
						<option value="1">Manhã | 9:00 - 13:00</option>
						<option value="2">Tarde | Por Marcação</option>
					</select>
				</div>
			</div>

			<div class="col-lg-12"> <!-- Nome da Instituição -->
				<div class="form-group">
					<input type="text" class="common-input mb-20 form-control" name="instituicao" id="instituicao" placeholder="Nome da Instituição" hidden required>
					<label id="instituicao" class="control-label">Nome da Instituição</label>
				</div>
			</div>

			<div class="col-lg-12"> <!-- Ciclo de Estudos-->
				<select class="form-control mb-20 visitas" name="ciclo" id="ciclo" style="color: #6c757d; font-size: 12px; line-height: 40px;" hidden required> <!-- Ciclo de Estudos -->
					<option value="" disabled selected>Ciclo de estudos</option>
					<option value="1">1º Ciclo</option>
					<option value="2">2º Ciclo</option>
					<option value="3">3º Ciclo</option>
					<option value="4">Secundário</option>
				</select>
			</div>

			<div class="col-lg-12"> <!-- Número de Alunos -->
				<div class="form-group">
					<input type="number" class="common-input mb-20 form-control" name="NAlunos" id="NAlunos" placeholder="Número de Alunos" hidden required>
					<label for="NAlunos" class="control-label">Número de Alunos</label>
				</div>
			</div>

		</div>
		
	</div>


	<div class="row-lg-5 form-group">

		<div class="col-lg-12"> <!-- Motivo da visita e botão de enviar -->
			<div class="form-group">
				<textarea class="common-textarea form-control" name="motivo" id="motivo" cols="30" rows="5" placeholder="Motivo da Visita" style="resize: none;" required></textarea>

				<button class="primary-btn mt-20 btn_visitas text-white" value="Enviar Formulário" style="float: right;">Enviar Formulário</button>
			</div>
		</div>

			
													
		</div>
	</form>
	<div class="col-lg-12"> <!-- Hora da Visita -->
		<label class="legenda mt-20">Todos os campos são de preenchimento obrigatório.</label>
	</div>

</div>
<!-- Fim Formulário de Visitas -->

<script>
	function Tipo()
	{
		if(document.getElementById("tipo").value =="1")
		{
			document.getElementById("ciclo").hidden=false;
			document.getElementById("instituicao").hidden=false;
			document.getElementById("NAlunos").hidden=false;

			document.getElementById("ciclo").required=true;
			document.getElementById("instituicao").required=true;
			document.getElementById("NAlunos").required=true;
		}
		else
		{
			document.getElementById("ciclo").hidden=true;
			document.getElementById("instituicao").hidden=true;
			document.getElementById("NAlunos").hidden=true;


			document.getElementById("ciclo").required=false;
			document.getElementById("instituicao").required=false;
			document.getElementById("NAlunos").required=false;
		}
	}
</script>