<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="pt-pt">
  <head>

    <title>Administração - Coleções</title>

		<meta charset="UTF-8">
		<link rel="shortcut icon" href="../Login/imagens/favicon verde.png"> <!-- Favicon -->
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
        botão de adicionar
      -->
      <nav class="navbar">
        <div class="container-fluid">
          <ul><input type="text" id="filtraColecao" onkeyup="filtra('filtraColecao',1)" placeholder="Procurar por coleção..." title="Digite uma coleção..."></ul>

          <ul class="navbar-right">
            <li class="nav-item"><a class="btn btn-success" data-toggle="modal" data-target="#inserir" style="background-color: #4CAF50; border: none;" href="#">Adicionar</a></li>
          </ul>
        </div>
      </nav>

      <!--
        Alerta de dados modificados
      -->
      <?php if (isset($_GET["insere"]) && $_GET["insere"]==1){ ?>
        <div class="w3-panel w3-green w3-card-4 w3-animate-left" role="alert" id="demo" onclick="document.getElementById('demo').style.display='none'">
        <span onclick="this.parentElement.style.display='none'"class="  w3-large">&times;</span>
        Dados inseridos com sucesso!
        </div>
      <?php }?>
      <?php if (isset($_GET["apagar"]) && $_GET["apagar"]==1){ ?>
        <div class="w3-panel w3-green w3-card-4 w3-animate-left" role="alert" id="demo" onclick="document.getElementById('demo').style.display='none'">
        <span onclick="this.parentElement.style.display='none'"class="  w3-large">&times;</span>
        Dados eliminados com sucesso!
        </div>
      <?php }?>
          <?php if (isset($_GET["alterar"]) && $_GET["alterar"]==1){ ?>
          <div class="w3-panel w3-green w3-card-4 w3-animate-left" role="alert" id="demo" onclick="document.getElementById('demo').style.display='none'">
          <span onclick="this.parentElement.style.display='none'"class="  w3-large">&times;</span>
          Dados alterados com sucesso!
        </div>
      <?php }?>

      <!--
        Tabela com os categorias
      -->
      <div style="padding: 0 160px 0 160px;" class="container">
      <?php
        $sql = 'SELECT * FROM Colecoes WHERE Id_Colecao!=1;';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) { ?>
          <table class="table table-hover" id="myTable">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Coleção</th>
                <th scope="col" colspan=3>Operações</th>
              </tr>
            </thead>

            <tbody>
              <?php
                $result = $conn->query($sql);
                while($row = mysqli_fetch_array($result)){ if($row['Id_Colecao']!=1) { ?>
                    <tr>
                        <td><?php echo $row['Id_Colecao'];?></td>
                        <td><?php echo $row['Nome_Colecao']?></td>
                        <td><a onclick="Imagem('./Imagens/Colecoes/<?php echo $row['Fotografia']?>')" href="#"><i class="material-icons" style="color: #4CAF50;">image</i></a></td>
                        <td><a href="#" onclick="Dados('<?php echo $row['Id_Colecao']; ?>', '<?php echo $row['Nome_Colecao']; ?>')" data-toggle="modal" data-target="#alterar"><i class="material-icons" style="color: #4CAF50;">mode_edit</i></a></td>
                        <td><a onclick="return Apagar();" href='apagar_colecao.php?id_colecao=<?php echo $row['Id_Colecao'];?>'><i class="material-icons" style="color: #4CAF50;">delete</i></a></td>
                    </tr>
                <?php } } ?>
            </tbody>
          </table>
      <?php }
        else {
          echo "<p class='text-center'>Não existem coleções na BD.</p>";
        } ?>
      </div>
    </body>
    
  <!-- Modal para inserir dados-->
  <div class="modal fade" id="inserir">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
          <h4 class="modal-title" style="font-family:var(--bs-font-sans-serif);">Inserir Coleção</h4>
          <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"> </button>
        </div>

        <div class="modal-body">

          <!--O conteúdo do modal começa aqui-->
          <form name="form_inserir_colecao" action="inserir_colecao.php" method="POST" enctype="multipart/form-data">
            <div class="container">

                <div class="mb-3 row">
                  <label class="col-sm-2 col-form-label">Coleção:</label>
                  <div class="col-sm-10">
                      <input type="text" name="colecao" id="colecao" class="form-control" placeholder="Designação" required>
                  </div>
                </div>

                <div class="mb-3 row"> <!-- Fotografia -->
                  <label class="col-sm-2 col-form-label">Fotografia:</label>
                  <div class="col-sm-10">
                      <input required class="form-control" type="file" name="fotografia" id="fotografia" class="form-control">
                  </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row justify-content-center">
                                <a class="btn btn-success btn-green" href="colecoes.php">Voltar</a>
                            </div>
                        </div>

                        <div class="col-sm-2"></div> <!-- Espaçamento entre os botões -->

                        <div class="col-sm-5">
                            <div class="row justify-content-center">
                                <button onclick="return Confirmar();" id="btn" class="btn btn-success btn-green">Inserir</button>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
        </form>

        </div>
      </div>
    </div>
  </div>
  <!-- Fim Modal Inserir dados -->

  <!-- Modal alterar -->
  <div class="modal fade" id="alterar">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" style="font-family:var(--bs-font-sans-serif);">Alterar Coleção</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"> </button>
              </div>
              
              <div class="modal-body">
          
                  <!--O conteúdo do modal começa aqui-->
                  <form name="form_alterar_colecao" action="alterar_colecao.php" method="POST" enctype="multipart/form-data">

                    <input type="hidden" name="id" id='fid'>

                    <div class="container">
                        <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Categoria:</label>
                            <div class="col-sm-10">
                                <input type="text" name="colecao" id="fcolecao" class="form-control" placeholder="Designação">
                            </div>
                        </div>
                    </div>

                    <div class="mb-3 row"> <!-- Fotografia -->
                      <label class="col-sm-2 col-form-label form-label">Fotografia:</label>
                      <div class="col-sm-10">
                          <input class="form-control" type="file" name="fotografia" id="fotografia" class="form-control">
                      </div>
                    </div>

                    <div class="container">
                        <div class="row">
                            <div class="col-sm-5">
                                <div class="row justify-content-center">
                                    <a class="btn btn-success btn-green" href="colecoes.php">Voltar</a>
                                </div>
                            </div>

                            <div class="col-sm-2"></div> <!-- Espaçamento entre os botões -->

                            <div class="col-sm-5">
                                <div class="row justify-content-center">
                                    <button onclick="return Alterar();" id="btn" class="btn btn-success btn-green">Alterar</button>
                                </div>
                            </div>
                        </div>
                    </div>

                  </div>
              </form>

              </div>
          </div>
      </div>
  </div>
  <!-- Fim Modal alterar -->

  <?php include "close.php";?>
</html>

<!-- Função da Pesquisa -->
<script>
  function filtra(nomeTextBox, colunaTabela) {
    var input, filter, table, tr, td, i, txtValue;
    // Seleciona a textbox com o id fitraprocesso (local onde o utilizador está a escrever)
    input = document.getElementById(nomeTextBox);
    // Converte o texto que foi escrito para maiúsculas (obtido na linha anterior)
    filter = input.value.toUpperCase();
    // Selecionar a tabela que tem o id myTable
    table = document.getElementById("myTable");
    // Obter uma lista de tr's existente na tabela (lista das linhas existentes na tabela
    tr = table.getElementsByTagName("tr");
    
    // Percorrer todas as linhas da tabela
    for (i = 0; i < tr.length; i++) {
    // Obter o primeiro td da linha tr que está a ser tratada
      td = tr[i].getElementsByTagName("td")[colunaTabela];
    // se existir um <td>
      if (td) {
      // obter o texto que está no td
        txtValue = td.textContent || td.innerText;
      //Procurar nesse texto a ocorrência do texto que está na variável filter. 
      // A função indexof devolve um número igual ou maior que zero se encontrar o filter na variável txtValue.
        if (txtValue.toUpperCase().indexOf(filter) > -1) {
      // mostra a linha da tabela  
          tr[i].style.display = "";
        } else {
        // esconde a linha da tabela
          tr[i].style.display = "none";
        }
      }       
    }
  }
</script>
<!-- Fim Função de Pesquisa -->

<script>
	function Confirmar()
	{
		let texto="Tem a certeza que pretende inserir uma coleção?";
		if (confirm(texto)!=true) return false; //Caso o utilizador clique no botão cancelar, vai fazer return false
		
    return true;
  }

  function Apagar()
	{
    let texto="Tem a certeza que pretende apagar esta coleção?";
    if (confirm(texto)!=true) return false;
    
    return true;
  }

  function Alterar()
	{
		let texto="Tem a certeza que pretende alterar esta coleção?";
		if (confirm(texto)!=true) return false;
		
    return true;
  }
</script>

<!-- Modal da Imagem -->
<div id="alterarDiv" class="w3-modal black" onclick="this.style.display='none'">
  <span class="w3-button w3-xxlarge modal-close w3-padding-large w3-display-topright" title="Fechar imagem"><strong>×</strong></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent" style="width: 80%;">
    <img id="Fotografia" src="Fotografia">
  </div>
</div> 


<script>
  function Imagem(Fotografia)
  {
    document.getElementById('alterarDiv').style.display='block';
		document.getElementById('Fotografia').src = Fotografia;
  }
</script>
<!-- Fim Modal da Imagem-->

<script>
  function Dados(Id, Colecao)
  {
    document.getElementById('fid').value = Id;
		document.getElementById('fcolecao').value = Colecao;
  }
</script>