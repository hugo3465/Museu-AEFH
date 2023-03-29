<?php
    include "connection.php";
    include "sessao.php";

    $id_utilizador=$_GET["id_utilizador"];

    $sql = "DELETE FROM Utilizadores WHERE Id_Utilizador=$id_utilizador";
    // echo $sql;

    if (mysqli_query($conn, $sql)) {
        //echo "Registo apagado com sucesso!";
        header("location:registos.php?apagar=1");
    } 
    else 
    {
        echo "Erro ao apagar registo: " . mysqli_error($conn);
    }
    include "close.php"
?>