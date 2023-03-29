<?php
    // A sessão deve ser iniciada em cada página
    if(! isset($_SESSION)){
        session_start();
    } 

    // Verifica se não há a variável de sessão que identifica o utilizador
    if(!isset($_SESSION['UtilizadorID'])) {
        // destrói a sessoão, por questões de segurança
        session_destroy();
        // redireciona o visitante de volta para o login
        header("Location: ../Login/index.php");
        exit;
    }
?>