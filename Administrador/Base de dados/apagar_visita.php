<?php
    include "connection.php";
    include "sessao.php";

    $id_visita=$_GET["id_visita"];

    $sql = "DELETE FROM Visitas WHERE Id_Visita=$id_visita";
    // echo $sql;

    if (mysqli_query($conn, $sql)) {
        //echo "Registo apagado com sucesso!";
        header("location:visitas.php?apagar=1");
    } 
    else 
    {
        echo "Erro ao apagar registo: " . mysqli_error($conn);
    }
    
    include "close.php"
?>
