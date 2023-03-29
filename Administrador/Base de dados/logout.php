<!DOCTYPE html>
<html>
    <head>
        <title>Fim de Sessão</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
    </head>
    
    <body>
        <?php
            session_start();
            // remove all session variables
            session_unset();

            // destrói a sessão
            session_destroy();

            //redireciona o visitante para a página de login
            header("Location: ../Login/index.php");
        ?>
    </body>
</html>