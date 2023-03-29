<?php
    if (empty($_POST) && (empty($_POST["nome"]) || empty($_POST["password"]) ))
    {
        header("Location: index.html");
        exit;
    }

    include "connection.php";

    $nome = $_POST["nome"];
    $password = $_POST["password"];

    $sql = "SELECT Id_Utilizador, Nome_Utilizador, Id_Nivel FROM Utilizadores WHERE Nome_Utilizador = '$nome' AND Senha = SHA1('$password')";
    $result = mysqli_query($conn, $sql);
    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
    
    $count = mysqli_num_rows($result);

    if($count == 1) {
        // o utilizador foi encontrado na bd e guarda os dados encontrados na variável $resultado

        // se a sessão não existir, inicia uma sessão
        if(!isset($_SESSION)) session_start();

        // guarda os dados encontrados na sessão
        $_SESSION['UtilizadorID']=$row['Id_Utilizador'];
        $_SESSION['UtilizadorNome']=$row['Nome_Utilizador'];
        $_SESSION['UtilizadorNivel']=$row['Id_Nivel'];

        // redireciona o visitante para uma página de sucesso
        header("Location: ../Base de dados/index.php");
    }else {
        header("Location: index.php?erro=1");
    }

    include "close.php";
?>