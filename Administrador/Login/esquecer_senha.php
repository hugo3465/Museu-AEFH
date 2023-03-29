<html>
    <head>
      <meta charset="UTF-8">
      <link rel="shortcut icon" href="./imagens/favicon verde.png"> <!-- Favicon -->
      <meta name="Description" content="Formulário para introduzir o e-mail de recuperação">
      <meta name="viewport" content="width=device-width, initial-scale=1">
        
      <title>Login</title>
      <link rel="stylesheet" href="./login.css">
        
    </head>

    <body>
    
        <div class="login-page">
        <h1 class="white text-center">ÁREA ADMINISTRATIVA</h3>
            <div class="form">

              <form class="login-form" name="form_login" action="processa_esquecer_senha.php" method="POST">
                <img src="imagens/user.png" class="pa-0" id="icon"/><br>

                <p>Introduza o seu e-mail de recuperação</p>
                <input type="email" name="email" id="email" placeholder="Email" required/>

                <button type="submit">Recuperar Senha</button> <br>
              </form>

              <p name="erro" id="erro"></p>

              <?php
                if (isset($_GET["erro"]) && $_GET["erro"] == 1)
                {
                  $email=$_GET['email'];
                  echo "<script>";
                  echo "document.getElementById('erro').innerHTML = 'O e-mail que inseriu não existe';";
                  echo "document.getElementById('erro').className='p-erro';";
                  echo "document.getElementById('email').className='input-erro';";
                  echo "document.getElementById('email').value = '$email';";
                  echo "</script>";
                }

                if(isset($_GET["sucesso"]) && $_GET["sucesso"] == 1)
                {
                  $email=$_GET['email'];
                  echo "<script>";
                  echo "document.getElementById('erro').innerHTML = 'E-mail enviado, por favor confira a caixa de entrada do seu e-mail';";
                  echo "document.getElementById('erro').className='p-sucesso';";
                  echo "document.getElementById('email').className = 'input-sucesso';";
                  echo "document.getElementById('email').value = '$email';";
                  echo "</script>";
                }
              ?>
            </div>

            </div>

            <p class="white text-center">Museu Francisco de Holanda</p>
          </div>
    </body>
</html>