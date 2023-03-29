<?php
  if(empty($_POST) && empty($_POST["senha"])) {
    header("Location: index.php");
    exit;
  }

  include "connection.php";

  $token = $_POST["token"];
  $senha = $_POST["senha"];

  $sql = "UPDATE Utilizadores SET Senha = SHA1('$senha'), recuperar_senha = NULL WHERE recuperar_senha='$token'";

  if (mysqli_query($conn, $sql)) {
    // Redirecionar para outra página
    header("location:index.php?sucesso=1");
  } 
  else {
      // Apresenta o erro
      echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
  }

  include "close.php";
    
?>