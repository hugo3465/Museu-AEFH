<?php //Verificar se o token está bem escrito
  include "connection.php";

  if(isset($_GET) && !empty($_GET["chave"]))
  {
    $chave = $_GET["chave"];
    $sql = "SELECT Id_Utilizador, recuperar_senha FROM Utilizadores WHERE recuperar_senha = '$chave'";
    $verificacao=mysqli_query($conn, $sql);

    if(mysqli_num_rows($verificacao)==0)
      header("Location: index.php");
  }
  else
    header("Location: index.php");

  include "close.php";
?>

<html>
    <head>
      <meta charset="UTF-8">
      <link rel="shortcut icon" href="./imagens/favicon verde.png"> <!-- Favicon -->
      <meta name="Description" content="Formulário para introduzir o e-mail de recuperação">
      <meta name="viewport" content="width=device-width, initial-scale=1">
        
      <title>Login</title>
      <link rel="stylesheet" href="login.css">
        
    </head>

    <body>
    
        <div class="login-page">
        <h1 class="white text-center">ÁREA ADMINISTRATIVA</h3>
            <div class="form">
              <form class="login-form" name="form_login" action="processa_repor_senha.php" method="POST" onsubmit="return Comparar();">

                <img src="imagens/user.png" class="pa-0" id="icon"/><br>

                <p>Introduza a nova senha</p>

                <input type="hidden" name="token" value="<?php echo $chave; ?>">

                <input type="password" name="senha" id="senha1" placeholder="Senha" required/>

                <input type="password" name="senha2" id="senha2" placeholder="Repita a senha" required/>

                <button type="submit">Recuperar Senha</button> <br>
              </form>

              <p name="erro" id="erro"></p>
              
            </div>

            </div>

            <p class="white text-center">Museu Francisco de Holanda</p>
          </div>
    </body>

    <script>
        function Comparar()
        {
            a = document.getElementById('senha1').value;
            b = document.getElementById('senha2').value;

            if (a==b)
            {
               return true; 
            }
            else
            {
                document.getElementById('erro').innerHTML = 'As senhas que introduziu são diferentes.';
                return false;
            }
        }
    </script>
</html>