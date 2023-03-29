<?php 
	include "connection.php";

  $pagina=1;
  $registosPorPagina=12;
  //Valores recebidos por parametro
  // Verificar se recebemos por GET o nu'mero de pa'gina a mostrar.
  if(isset($_GET['pagina']))
    $pagina = $_GET['pagina'];
  //Evitar que tentem aceder a p'aginas abaixo da 1
  if ($pagina<=0) $pagina=1;

	// Verificar a opção que está selecionada no filtro e organizar a tabela segundo a opção selecionada
	if (isset($_GET["filtro"]) && $_GET["filtro"]==1) {
		$sql = "SELECT * FROM Visitas WHERE Id_Estado=1 LIMIT ".(($pagina-1)*$registosPorPagina).", ".$registosPorPagina;
    $pesquisa=1;
	} elseif (isset($_GET["filtro"]) && $_GET["filtro"]==2) {
		$sql = "SELECT * FROM Visitas WHERE Id_Estado=2 LIMIT ".(($pagina-1)*$registosPorPagina).", ".$registosPorPagina;
    $pesquisa=2;
	} elseif (isset($_GET["filtro"]) && $_GET["filtro"]==3) {
		$sql = "SELECT * FROM Visitas WHERE Id_Estado=3 LIMIT ".(($pagina-1)*$registosPorPagina).", ".$registosPorPagina;
    $pesquisa=3;
	} else{
		$sql = "SELECT * FROM Visitas LIMIT ".(($pagina-1)*$registosPorPagina).", ".$registosPorPagina;
    $pesquisa=null;
	}
?>

<!DOCTYPE html>
<html lang="pt-pt">
  <head>

    <title>Administração - Visitas</title>

		<meta charset="UTF-8">
		<link rel="shortcut icon" href="../Login/imagens/favicon verde.png">
		<meta name="author" content="Hugo Guimarães">
		<meta name="Description" content="Página para a inserção de categorias na base de dados do site do museu AEFF">

    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/w3.css"> <!-- a biblioteca w3.css serve apenas para os panels -->

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
  
    <!-- Icons Google -->
    <link rel="stylesheet" href="css/icon.css">

  </head>

    <body>
      
      <?php include "sessao.php"; ?>

      <!--
          Menu
      -->
      <?php include "menu.php"; ?>


      <!--
        Área de Pesquisa
      -->
      <form action="visitas.php" method="GET">
        <nav class="navbar">
          <div class="container-fluid">
            <ul>
              <li>
                  <label>Estado:</label>
                  <select name="filtro" id="filtro" onchange="this.form.submit()"> <!-- O PHP dentro das opções serve para a opção continuar marcada quando reinicia a página para efetuar a pesquisa -->
                    <option value="0" <?php if (!isset($_GET["filtro"])) echo "selected" ?> >Todas</option>
                    <option value=1 <?php if (isset($_GET["filtro"]) && $_GET["filtro"]==1) echo "selected" ?>>Aceite</option>
                    <option value=2 <?php if (isset($_GET["filtro"]) && $_GET["filtro"]==2) echo "selected" ?> >Em Espera</option>
                    <option value=3 <?php if (isset($_GET["filtro"]) && $_GET["filtro"]==3) echo "selected" ?> >Rejeitado</option>
                  </select>
                </li>
            </ul>

            <ul class="navbar-right">
              <a onclick="window.print();" href="#" class="pr-1"><i class="material-icons" style="color: #4CAF50;">print</i></a>
            </ul>
            
          </div>
        </nav>
      </form>

      <!--
        Fim da Área de Pesquisa e Legenda
      -->

       <!--
          Alerta de dados modificados
      -->
      <?php if (isset($_GET["apagar"]) && $_GET["apagar"]==1) { ?>
        <div class="w3-panel w3-green w3-card-4 w3-animate-left" role="alert" id="demo" onclick="document.getElementById('demo').style.display='none'">
          <span onclick="this.parentElement.style.display='none'" class="w3-large">&times;</span>
          Dados eliminados com sucesso!
      </div>
      <?php } ?>

      <?php if (isset($_GET["alterar"]) && $_GET["alterar"]==1) { ?>
        <div class="w3-panel w3-green w3-card-4 w3-animate-left" role="alert" id="demo" onclick="document.getElementById('demo').style.display='none'">
        <span onclick="this.parentElement.style.display='none'" class="w3-large">&times;</span>
        Dados alterados com sucesso!
        </div>
      <?php } ?>
      <!--
        Fim Alerta de dados modificados
      -->

      <!--
        Tabela com os objetos
      -->
      <table class="table table-hover" id="myTable">
      <?php 
      $result = mysqli_query($conn, $sql);
      if (mysqli_num_rows($result) > 0) { ?>
        <thead>
          <tr>
            <th>Dia</th>
            <th>Hora</th>
            <th>Instituição</th>
            <th>Orientador</th>
            <th>Email</th>
            <th>Telefone</th>
            <th>Localidade</th>
            <th>Nº Alunos</th>
            <th>Estado</th>
            <th scope="col" colspan=2>Operações</th>
          </tr>
        </thead>
        <tbody>
            <?php
                // Obter cada registo da base de dados para a variável $row
                while($row = mysqli_fetch_assoc($result)) {?>
                <tr>
                  <td><?php echo $row['Dia'];?></td>
                  <td><?php if ($row['Id_Hora']==1) echo "Manhã"; else echo "Tarde"?></td>
                  <td><?php if($row['Tipo'] == 1) echo $row['Nome_Instituicao']; else  echo "-";?></td>
                  <td><?php echo $row['Nome_Orientador'];?></td>
                  <td><?php echo $row['Email'];?></td>
                  <td><?php echo $row['Telefone'];?></td>
                  <td><?php echo $row['Localidade'];?></td>
                  <td><?php if($row['Tipo'] == 1) echo $row['NAlunos']; else  echo "-";?></td>
                  <td><i class="material-icons"><?php if($row['Id_Estado']==1) echo "✔️"; else if($row['Id_Estado']==3) echo "❌"; else if($row['Id_Estado']==2) echo "🕒";?></i></td>
                  <td><a href="form_visita.php?id_visita=<?php echo $row['Id_Visita'];?>"><i class="material-icons" style="color: #4CAF50;">mode_edit</i></a></td>
                  <td><a onclick="return Confirmar();" href="apagar_visita.php?id_visita=<?php echo $row['Id_Visita'];?>"><i class="material-icons" style="color: #4CAF50;">delete</i></a></td>
                </tr>
                <?php } ?>
        </tbody>
        <?php } else {
          echo "<p class='text-center'>Não existem visitas na BD.</p>";
        } ?>
        </table>
          
        <!--
          Fim da Tabela da base de dados
        -->

        <!-- 
          Legenda do Estado
        -->
        <nav class="navbar">
          <div class="container-fluid">
            <ul>
              <li>
                <p class="legenda">❌ Rejeitado 🕒 Em Espera ✔️ Aceite </p>
              </li>
            </ul>

            <ul class="navbar-right">
              <?php include "pagination.php"; ?>
            </ul>
            
          </div>
        </nav>
        <!-- 
          Fim Legenda do Estado
        -->
          
        <?php include "./close.php"; ?>
      </body>
</html>

<!-- Botão para confirmar a alteração -->
<script>
	function Confirmar()
	{
		let texto="Tem a certeza que pretende eliminar este registo?";
		if (confirm(texto)==true){
			return true;
		}
		else{
			return false;
		}

	}
</script>
<!-- Fim Botão para confirmar a alteração -->