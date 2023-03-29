<html>
    <head>
      <meta charset="UTF-8">
      <link rel="shortcut icon" href="./imagens/favicon verde.png"> <!-- Favicon -->
      <meta name="Description" content="LogIn do museu do Agrupamento de Escolas Francisco de Holanda">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css"/>
        
      <title>Login</title>
      <link rel="stylesheet" href="./login.css">
        
    </head>

    <body>
    
        <div class="login-page">
        <h1 class="white text-center">ÁREA ADMINISTRATIVA</h3>
            <div class="form">

              <form class="login-form" name="form_login" action="processa.php" method="POST">
                <img src="imagens/user.png" class="pa-0" id="icon"/>

                <input type="text" name="nome" id="nome" placeholder="Utilizador" required/>

                <input type="password" name="password" id="password" placeholder="Password" required/>
                <span class="show-btn"><i class="fas fa-eye"></i></span>

                <button type="submit">login</button> <br>
              </form>

              <a class="esquecer_senha" href="esquecer_senha.php">Esqueceu-se da senha?</a>

              <p style='color: red;' name="erro" id="erro"></p>

              <?php
                if (isset($_GET["erro"]) && $_GET["erro"] == 1)
                {
                  echo "<script>";
                  echo "document.getElementById('erro').innerHTML = 'Nome ou senha não foram preenchidos corretamente'";
                  echo "</script>";

                  // Este style serve para que o olho não fique fora da caixa quando o erro aparecer
                  echo "<style>";
                    echo ".show-btn {";
                      echo "top: 58%;";
                    echo "}";
                  echo "</style>";
                }
              ?>
            </div>

            <p class="white text-center">Museu Francisco de Holanda</p>
          </div>
    </body>
</html>

<script>
  const passField = document.getElementById("password");
  const showBtn = document.querySelector("span i");
  showBtn.onclick = (()=>{
    if(passField.type === "password"){
      passField.type = "text";
      showBtn.classList.add("hide-btn");
    }else{
      passField.type = "password";
      document.getElementById("password").type="password";
      showBtn.classList.remove("hide-btn");
    }
  });
</script>