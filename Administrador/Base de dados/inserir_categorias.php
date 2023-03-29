<?php
    if (isset($_POST))
    {
      include "connection.php";
      include "sessao.php";

      $categoria = $_POST["categoria"];

      $sql = "INSERT INTO Categorias (Categoria) VALUES ('$categoria')";

      if (mysqli_query($conn, $sql)) {
        // Redirecionar para outra página
        header("location:categorias.php?insere=1");
      } 
      else {
          // Apresenta o erro
          echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
      }
        
      include "close.php";
    }
?>