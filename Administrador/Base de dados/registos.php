<?php include "connection.php"; ?>

<!DOCTYPE html>
<html lang="pt-pt">
    <head>

        <title>Administração - Utilizadores</title>

		<meta charset="UTF-8">
		<link rel="shortcut icon" href="../Login/imagens/favicon verde.png">
		<meta name="author" content="Hugo Guimarães">
		<meta name="Description" content="Página para a inserção de utilizadores na base de dados do site do museu AEFF">

        <link rel="stylesheet" href="css/estilos.css">
        <link rel="stylesheet" href="css/w3.css"> <!-- a biblioteca w3.css serve apenas para os panels -->

        <!-- Bootstrap -->
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <script src="js/jquery-3.3.1.slim.min.js"></script>
        <script src="js/bootstrap.min.js"></script>
        
        <!-- Icons Google -->
        <link rel="stylesheet" href="css/icon.css">

    </head>

    <body>

        <!-- 
            Verificar se a sessão existe e se é um utilizador de nível 2 (Administrador)
        -->
        <?php
            // A sessão deve ser iniciada em cada página
            if(! isset($_SESSION)) session_start();

            $nivel_necessario=2;

            // Verifica se não há a variável de sessão que identifica o utilizador
            if(!isset($_SESSION['UtilizadorID']) OR ($_SESSION['UtilizadorNivel']<$nivel_necessario) ) {
                // destrói a sessoão, por questões de segurança
                session_destroy();
                // redireciona o visitante de volta para o login
                header("Location: ../Login/index.php");
                exit;
            }
        ?>

        <!--
          Menu
        -->
        <?php include "menu.php"; ?>


        <!--
            botão de adicionar
        -->
        <nav class="navbar">
            <div class="container-fluid">
            <ul><input type="text" id="filtraUtilizador" onkeyup="filtra('filtraUtilizador',0)" placeholder="Procurar por utilizador..." title="Digite um utilizador..."></ul>

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
          <?php if (isset($_GET["erro"]) && $_GET["erro"]==1){ ?>
          <div class="w3-panel w3-red w3-card-4 w3-animate-left" role="alert" id="demo" onclick="document.getElementById('demo').style.display='none'">
        <span onclick="this.parentElement.style.display='none'"class="  w3-large">&times;</span>
          Não pode inserir o mesmo utilizadore ou e-mail duas vezes!
          </div>
        <?php }?>

        <!--
            Tabela com os objetos
        -->
        <table class="table table-hover" id="myTable">
        <?php
        $sql = 'SELECT * FROM Utilizadores';
        $result = mysqli_query($conn, $sql);
        if (mysqli_num_rows($result) > 0) { ?>
        <thead>
            <tr>
                <th scope="col">Utilizador</th>
                <th scope="col">Email</th>
                <th scope="col">Nível</th>
                <th scope="col" colspan=2>Operações</th>
            </tr>
        </thead>

        <tbody>
            <?php
                while($row = mysqli_fetch_assoc($result)){  ?>
                    <tr>
                        <td><?php echo $row['Nome_Utilizador']?></td>
                        <td><?php echo $row['Email']?></td>
                        <td><?php if ($row['Id_Nivel']==1) echo "Padrão"; else echo "Administrador";?></td>
                        <td><a href="#" onclick="Dados('<?php echo $row['Id_Utilizador'];?>', '<?php echo $row['Nome_Utilizador'];?>', '<?php echo $row['Email'];?>', '<?php echo $row['Senha'];?>', '<?php echo $row['Id_Nivel'];?>')" data-toggle="modal" data-target="#alterar"><i class="material-icons" style="color: #4CAF50;">mode_edit</i></a></td>
                        <td><a onclick="return Apagar();" href='apagar_registo.php?id_utilizador=<?php echo $row['Id_Utilizador'];?>'><i class="material-icons" style="color: #4CAF50;">delete</i></a></td>
                    </tr>
                <?php } ?>
        </tbody>
        <?php } else {
            echo "<p class='text-center'>Não existem utilizadores na BD.</p>";
        } ?>
        </table>
        <!--
          Fim da Tabela da base de dados
        -->
    </body>

    <!-- Modal para inserir dados-->
  <div class="modal fade" id="inserir">
    <div class="modal-dialog modal-lg">
      <div class="modal-content">

        <div class="modal-header">
            <h4 class="modal-title" style="font-family:var(--bs-font-sans-serif);">Inserir Utilizador</h4>
            <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"></button>
        </div>

        <div class="modal-body">

          <!--O conteúdo do modal começa aqui-->
          <form name="form_utilizadores" action="inserir_registos.php" method="POST">
            <div class="container teste">
                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Utilizador:</label>
                    <div class="col-sm-10">
                        <input type="text" name="utilizador" id="utilizador" class="form-control" placeholder="Nome de Utilizador" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Email:</label>
                    <div class="col-sm-10">
                        <input type="text" name="email" id="email" class="form-control" placeholder="Email" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Password:</label>
                    <div class="col-sm-10">
                        <input type="text" name="password" id="password" class="form-control" placeholder="Password" required>
                    </div>
                </div>

                <div class="mb-3 row">
                    <label class="col-sm-2 col-form-label">Nível</label>
                    <div class="col-sm-10">
                        <select class="text-center" name="nivel" id="nivel" required>
                            <option value="" selected disabled>Nivel</option>
                            <option value="1">Padrão</option>
                            <option value="2">Administrador</option>
                        </select>
                    </div>
                </div>

                <div class="container">
                    <div class="row">
                        <div class="col-sm-5">
                            <div class="row justify-content-center">
                                <a class="btn btn-success btn-green" href="registos.php">Voltar</a>
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

  <!-- Modal para alterar dados-->
  <div class="modal fade" id="alterar">
      <div class="modal-dialog modal-lg">
          <div class="modal-content">

            <div class="modal-header">
                <h4 class="modal-title" style="font-family:var(--bs-font-sans-serif);">Alterar Utilizador</h4>
                <button type="button" class="btn-close" data-dismiss="modal" aria-label="Close"> </button>
            </div>

              <div class="modal-body">

                  <!--O conteúdo do modal começa aqui-->

                  <form name="form_utilizadores" action="alterar_registo.php" method="POST">

                      <input type="hidden" name="id" id="fid"> <!-- Este input serve para mandar o Id do objeto durante o POST do form -->

                      <div class="container teste">
                          
                          <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Utilizador:</label>
                              <div class="col-sm-10">
                                  <input type="text" name="utilizador" id="futilizador" class="form-control" placeholder="Nome de Utilizador" disabled required>
                              </div>
                          </div>

                          <div class="mb-3 row">
                            <label class="col-sm-2 col-form-label">Email:</label>
                            <div class="col-sm-10">
                                <input type="text" name="email" id="femail" class="form-control" placeholder="Email" disabled required>
                            </div>
                        </div>

                          <div class="mb-3 row">
                              <label class="col-sm-2 col-form-label">Nível</label>
                              <div class="col-sm-10">
                                  <select class="text-center" name="nivel" id="fnivel" required>
                                      <option value="1" id="1">Padrão</option>
                                      <option value="2" id="2">Administrador</option>
                                  </select>
                              </div>
                          </div>
                          

                          <div class="container">
                              <div class="row">
                                  <div class="col-sm-5">
                                      <div class="row justify-content-center">
                                          <a class="btn btn-success btn-green" href="registos.php">Voltar</a>
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
<!-- Fim Modal para alterar dados-->

</html>

<!-- Modal dados alterar -->
<script>
  function Dados(Id, Nome, Email, Senha, Nivel)
  {
    document.getElementById('fid').value = Id;
    document.getElementById('futilizador').value = Nome;
    document.getElementById('femail').value = Email;
    document.getElementById('fpassword').value = Senha;
    document.getElementById(Nivel).selected = true;
  }
</script>
<!-- Fim Modal dados alterar-->

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

<!-- Scripts de confirmação -->
<script>
    function Confirmar()
    {
        let texto="Tem a certeza que pretende inserir um utilizador?";
        if (confirm(texto)!=true) return false; //Caso o utilizador clique no botão cancelar, vai fazer return false
        
        return true;
    }

    function Apagar()
    {
        let texto="Tem a certeza que pretende apagar este utilizador?";
        if (confirm(texto)!=true) return false; //Caso o utilizador clique no botão cancelar, vai fazer return false
        
        return true;
    }

    function Alterar()
	  {
      let texto="Tem a certeza que pretende alterar este utilizador?";
      if (confirm(texto)!=true) return false; //Caso o utilizador clique no botão cancelar, vai fazer return false
      
          return true;
    }
</script>
<!-- Fim Scripts de confirmação -->

<?php include "close.php"; ?>