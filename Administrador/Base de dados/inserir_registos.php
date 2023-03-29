<?php
    if (!isset($_POST) && (empty($_POST["utilizador"]) && empty($_POST["email"]) && empty($_POST["password"]) && empty($_POST["nivel"]) ) )
    {
      header("Location: registos.php");
      exit;
    }
      include "connection.php";
      include "sessao.php";

      $utilizador = $_POST["utilizador"];
      $email = $_POST["email"];
      $senha = $_POST["password"];
      $nivel = $_POST["nivel"];

      // Ver se o utilizador existe na base de ddados
      $verificar="SELECT Nome_Utilizador FROM Utilizadores WHERE Nome_Utilizador='$utilizador' OR Email='$email'";
      $verificacao=mysqli_query($conn, $verificar);

      if(mysqli_num_rows($verificacao)!=0)
      {
        header("Location: registos.php?erro=1");
      }
      else
      {
        // Inserir o utilizador na base de dados
        $sql = "INSERT INTO Utilizadores (Nome_Utilizador, Email, Senha, Id_Nivel) VALUES ('$utilizador', '$email', SHA1('$senha'), '$nivel')";

        if (mysqli_query($conn, $sql)) {
          // Redirecionar para outra página
          header("location:registos.php?insere=1");
        } 
        else {
            // Apresenta o erro
            echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
        }
      }
        
      include "close.php";
?>