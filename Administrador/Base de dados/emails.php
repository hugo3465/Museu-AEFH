<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="pt-pt">
  <head>

    <title>Administração - E-mails</title>

		<meta charset="UTF-8">
		<link rel="shortcut icon" href="../Login/imagens/favicon verde.png"> <!-- Favicon -->
		<meta name="author" content="Hugo Guimarães">
		<meta name="Description" content="Página para a visualização dos e-mails existentes na base de dados">

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
          <ul><input type="text" id="filtraemail" onkeyup="filtra('filtraemail',0)" placeholder="Procurar por email..." title="Digite um email..."></ul>

        </div>
      </nav>

      <!--
        Alerta de dados modificados
      -->
      <?php if (isset($_GET["apagar"]) && $_GET["apagar"]==1){ ?>
        <div class="w3-panel w3-green w3-card-4 w3-animate-left" role="alert" id="demo" onclick="document.getElementById('demo').style.display='none'">
        <span onclick="this.parentElement.style.display='none'"class="  w3-large">&times;</span>
        Dados eliminados com sucesso!
        </div>
      <?php }?>

      <!--
        Tabela com os emails
      -->
      <div style="padding: 0 160px 0 160px;" class="container">
        <?php
          $sql = 'SELECT * FROM Noticias;';
          $result = mysqli_query($conn, $sql);
          if (mysqli_num_rows($result) > 0) { ?>
            <table class="table table-hover" id="myTable">
              <thead>
                <tr> <!--Só este é que leva th em tudo-->
                    <th scope="col">E-mail</th>
                    <th scope="col">Eliminar</th>
                </tr>
              </thead>

              <tbody>
                <?php
                  $result = $conn->query($sql);
                  while($row = mysqli_fetch_array($result)){  ?>
                      <tr>
                          <td><?php echo $row['Email']?></td>
                          <td><a onclick="return Apagar();" href='apagar_email.php?id_email=<?php echo $row['Id_Email'];?>'><i class="material-icons" style="color: #4CAF50;">delete</i></a></td>
                      </tr>
                  <?php } ?>
              </tbody>
            </table>
        <?php }
          else {
            echo "<p class='text-center'>Não existem emails na BD.</p>";
          } ?>
        </div>
    </body>

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
  function Apagar()
	{
    let texto="Tem a certeza que pretende apagar este email?";
    if (confirm(texto)!=true) return false; //Caso o utilizador clique no botão cancelar, vai fazer return false
    
        return true;
  }  
</script>