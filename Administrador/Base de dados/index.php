<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="pt-pt">
  <head>

    <title>Administração - Objetos</title>

		<meta charset="UTF-8">
		<link rel="shortcut icon" href="../Login/imagens/favicon verde.png"> <!-- Favicon -->
		<meta name="author" content="Hugo Guimarães">
		<meta name="Description" content="Página para a inserção de registos na base de dados do site do museu AEFF">

    <link rel="stylesheet" href="css/estilos.css">
    <link rel="stylesheet" href="css/w3.css"> <!-- a biblioteca w3.css serve apenas para os panels -->
    
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <script src="js/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    
    <!-- NewsLetter textarea (Editor de texto) -->
    <script type="text/javascript" src="./tinymce/js/tinymce/tinymce.min.js"></script>
    <script>tinymce.init(
      {
        selector:'textarea',
        menubar: false,
        entity_encoding: 'raw',
        statusbar: false,

        setup: function (editor) {
          editor.on('change', function () {
              editor.save();
          });
        }

      });
      </script>
    
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
          Área de Pesquisa e botão de adicionar
        -->
        <nav class="navbar">
          <div class="container-fluid">
            <ul>
              <li>
                <input type="text" id="filtraNome" onkeyup="filtra('filtraNome',1)" placeholder="Procurar por objeto..." title="Digite um objeto...">
                &nbsp;
                <input type="text" id="filtraColecao" onkeyup="filtra('filtraColecao',4)" placeholder="Procurar por coleção..." title="Digite uma coleção...">
                &nbsp;
                <input type="text" id="filtraCategoria" onkeyup="filtra('filtraCategoria',5)" placeholder="Procurar por categoria..." title="Digite uma categoria...">
              </li>
              
              <li class="nav-item"><a class="btn btn-success" data-toggle="modal" data-target="#inserir" style="background-color: #4CAF50; border: none;" href="#">Adicionar</a></li>
            </ul>

            <ul class="navbar-right">

            <li>

              <label>Estado:</label>
              <select name="filtro" id="filtro" onchange="filtra('filtro', 6)">
                <option value="" selected>Todas</option>
                <option value="Público">Público</option>
                <option value="Privado">Privado</option>
              </select>
            </li>

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
          Tabela com os objetos
        -->
        <table class="table table-hover" id="myTable">
        <?php
        $sql = "SELECT Objetos.*, Categoria, Nome_Colecao FROM Objetos INNER JOIN Categorias INNER JOIN Colecoes ON Objetos.Id_Categoria=Categorias.Id_Categoria AND Objetos.Id_Colecao=Colecoes.Id_Colecao ORDER BY Data DESC";
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) { ?>
          <thead>
            <tr>
                <th></th> <!-- Espaçamento -->
                <th style="text-align: left" align="center" scope="col">Objeto</th>
                <th style="text-align: left" scope="col">Criador</th>
                <th style="text-align: left" scope="col">Origem</th>
                <th scope="col">Coleção</th>
                <th scope="col">Categoria</th>
                <th scope="col">Estado</th>
                <th scope="col" colspan=3>Operações</th>
            </tr>
          </thead>
          <tbody>
              <?php
                while($row = mysqli_fetch_assoc($result)){  ?>
                    <tr>
                        <td></td> <!-- Espaçamento -->
                        <td align="left"><?php echo $row['Nome_Objeto']?></td>
                        <td align="left"><?php echo $row['Criador']?></td>
                        <td align="left"><?php echo $row['Pais']?></td>
                        <td><?php echo $row['Nome_Colecao']?></td>
                        <td><?php echo $row['Categoria']?></td>
                        <td><?php if ($row['Id_Estado']==1) echo "Público"; else echo "Privado";?></td>
                        <td><a onclick="Imagem('./Imagens/Objetos/<?php echo $row['Fotografia']?>')" href="#"><i class="material-icons" style="color: #4CAF50;">image</i></a></td>
                        <td><a href='form_objeto.php?id_objeto=<?php echo $row['Id_Objeto'];?>'><i class="material-icons" style="color: #4CAF50;">mode_edit</i></a></td>
                        <td><a onclick="return Apagar();" href='apagar_objeto.php?id_objeto=<?php echo $row['Id_Objeto'];?>'><i class="material-icons" style="color: #4CAF50;">delete</i></a></td>
                      </tr>
                <?php } ?>
          </tbody>
          <?php } else {
            echo "<p class='text-center'>Não existem objetos na BD.</p>";
          } ?>
      </table>

    </body>

<!-- Modal para inserir dados-->
<div class="modal fade" id="inserir" role="dialog">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">

      <div class="modal-header">
        <h4 class="modal-title" style="font-family:var(--bs-font-sans-serif);">Inserir Objeto</h4>
        <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"> </button>
      </div>

      <div class="modal-body">
        
        <!--O conteúdo do modal começa aqui-->
        <form name="objeto" action="inserir_objetos.php" method="POST" enctype="multipart/form-data">
          <div class="container">
          
            <div class="mb-3 row"> <!-- Nome -->
                <label class="col-sm-2 col-form-label">Nome*:</label>
                <div class="col-sm-10">
                    <input required type="text" name="nome" id="nome" class="form-control" placeholder="Nome">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Criador -->
                <label class="col-sm-2 col-form-label">Criador:</label>
                <div class="col-sm-10">
                    <input type="text" name="criador" id="criador" class="form-control" placeholder="Criador">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Ano -->
                <label class="col-sm-2 col-form-label">Ano:</label>
                <div class="col-sm-10">
                    <input type="text" name="ano" id="ano" maxlength="20" class="form-control" placeholder="Ano">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Origem -->
                <label class="col-sm-2 col-form-label">Origem:</label>
                <div class="col-sm-10">
                    <input type="text" name="origem" id="origem" class="form-control" placeholder="Origem">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Categoria e Coleção-->
                <label class="col-sm-2 col-form-label">Categoria*:</label>
                <div class="col-sm-10">
                    <Select required name="categoria" id="categoria">
                      <?php
                        $sql = 'SELECT * FROM Categorias;';
                        $result = $conn->query($sql);
                        while($row = mysqli_fetch_array($result)){
                          echo '<option value="'. $row['Id_Categoria']. '">'. $row['Categoria']. '</option>';
                        }
                      ?>
                    </Select>
                        
                    <label class="col-sm-2 col-form-label pl-2">Coleção*:</label>
                    <Select name="colecao" id="colecao">
                      <?php
                        $sql = 'SELECT * FROM Colecoes;';
                        $result = $conn->query($sql);
                        while($row = mysqli_fetch_array($result)){
                          echo '<option value="'. $row['Id_Colecao']. '">'. $row['Nome_Colecao']. '</option>';
                        }
                      ?>
                    </Select>

                </div>
            </div>

            <div class="mb-3 row"> <!-- Estado -->
                <label class="col-sm-2 col-form-label">Estado*:</label>
                <div class="col-sm-10">
                    <label for="Publico">Público</label>
                    <input type="radio" name="estado" id="festado1" value="1" checked>

                    <label for="Privado">Privado</label>
                    <input type="radio" name="estado" id="festado2" value="2">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Descrição -->
                <label class="col-sm-2 col-form-label">Descrição:</label>
                <div class="col-sm-10">
                    <textarea onkeyup="tinyMCE.triggerSave();" name="descricao" id="descricao" class="form-control" placeholder="Descrição" cols="30" rows="10"></textarea>
                </div>
            </div>

            <div class="mb-3 row"> <!-- Fotografia -->
                <label class="col-sm-2 col-form-label form-label">Fotografia*:</label>
                <div class="col-sm-10">
                    <input required class="form-control" type="file" name="fotografia" id="fotografia" class="form-control">
                </div>
            </div>

            <div class="container">
              <div class="row">
                  <div class="col-sm-5">
                      <div class="row justify-content-center">
                          <a class="btn btn-success btn-green" href="index.php">Voltar</a>
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
<!-- Fim modal inserir -->

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


<!-- Modal da Imagem e dados alterar -->
<div id="alterarDiv" class="w3-modal black" onclick="this.style.display='none'">
  <span class="w3-button w3-xxlarge modal-close w3-padding-large w3-display-topright" title="Fechar imagem"><strong>×</strong></span>
  <div class="w3-modal-content w3-animate-zoom w3-center w3-transparent" style="width: 80%;">
    <img id="Fotografia" src="Fotografia">
  </div>
</div> 


<script>
  function Dados(Id, Nome, Criador, Ano, Pais, Categoria, Estado, Descricao, Fotografia)
  {
    document.getElementById('fid').value = Id;
    document.getElementById('fnome').value = Nome;
    document.getElementById('fcriador').value = Criador;
    document.getElementById('fano').value = Ano;
    document.getElementById('forigem').value = Pais;
    document.getElementById(Categoria).selected = true;

    if(Estado==1)
      document.getElementById('idestado1').checked = true;
    else if(Estado==2)
      document.getElementById('idestado2').checked = true;

    tinymce.activeEditor.setContent(Descricao);
    tinymce.triggerSave();
  }

  function Imagem(Fotografia)
  {
    document.getElementById('alterarDiv').style.display='block';
		document.getElementById('Fotografia').src = Fotografia;
  }
</script>
<!-- Fim Modal da Imagem e dados alterar-->

<!-- Confirmar a remoção, alteração inserção de dados -->
<script>
  function Confirmar()
  {
    let texto="Tem a certeza que pretende inserir um objeto?";
    if (confirm(texto)!=true) return false; //Caso o utilizador clique no botão cancelar, vai fazer return false
    
      return true;
    }

  function Apagar()
  {
    let texto="Tem a certeza que pretende apagar este objeto?";
    if (confirm(texto)!=true) return false;

    return true;
  }
  function Alterar()
	{
		let texto="Tem a certeza que pretende alterar este objeto?";
		if (confirm(texto)!=true) return false;
		
        return true;
  }
</script>
<!-- Fim Confirmar a remoção, alteração einserção de dados -->

<?php include "close.php";?>

</html>
