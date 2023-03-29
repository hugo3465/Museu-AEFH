<?php
    include "connection.php";
    include "sessao.php";
    
    if (isset($_POST)) {
      $Id = $_POST["id"];
      $Categoria = $_POST["categoria"];
        //print_r($_POST);

    $sql = "UPDATE Categorias SET Categoria='$Categoria' WHERE Id_Categoria=$Id";
    //echo "Teste: ".$sql."Fim";

    if (mysqli_query($conn, $sql)) {
        //echo "Record updated successfully";
        header("location:categorias.php?alterar=1");
    } else {
        echo "Erro ao atualizar: " . mysqli_error($conn);
    }
    }
    include "close.php";
?>