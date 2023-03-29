<?php
  if(isset($_POST) && empty($_POST["email"])){
    header("Location: index.php");
    exit;
  }

  $email=$_POST["email"];

  include "connection.php";

  $sql = "INSERT INTO Noticias (Email) VALUES ('$email')";

  // Executa a query e verifica se deu erro
  if (mysqli_query($conn, $sql)) {
    // Redirecionar para outra página
    header("location:index.php");
  } 
  else {
      // Apresenta o erro
      echo "Não pode inserir o mesmo e-mail duas vezes.";
  }

  include "close.php";
?>