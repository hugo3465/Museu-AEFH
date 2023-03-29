<?php
    include "connection.php";
    include "sessao.php";
    
    if (!isset($_POST) && (empty($_POST["utilizador"]) && empty($_POST["password"]) && empty($_POST["nivel"]) ) )
    {
      header("Location: registos.php");
      exit;
    }

    $id_utilizador = $_POST["id"];
    $nome_utilizador = $_POST["utilizador"];
    $nivel =  $_POST["nivel"];

    // Ver se o utilizador existe na base de ddados
    $verificar="SELECT Nome_Utilizador FROM Utilizadores WHERE Nome_Utilizador='$nome_utilizador'";
    $verificacao=mysqli_query($conn, $verificar);

    if(mysqli_num_rows($verificacao)!=0)
    {
        header("Location: registos.php?erro=1");
    }
    else
    {
        // Alterar o utilizador
        $sql = "UPDATE Utilizadores SET Id_Nivel='$nivel' WHERE Id_Utilizador='$id_utilizador'";
        //echo "Teste: ".$sql."Fim";

        if (mysqli_query($conn, $sql)) {
            //echo "Record updated successfully";
            header("location:registos.php?alterar=1");
        } else {
            echo "Erro ao atualizar: " . mysqli_error($conn);
        }
    }
    
    include "close.php";
?>