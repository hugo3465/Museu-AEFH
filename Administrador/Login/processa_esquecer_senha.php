<?php
    if (empty($_POST) && empty($_POST["email"]))
    {
        header("Location: esquecer_senha.php");
        exit;
    }

    require_once('./PHPMailer/vendor/autoload.php');
	use PHPMailer\PHPMailer\PHPMailer;
	use PHPMailer\PHPMailer\SMTP;
	use PHPMailer\PHPMailer\Exception;

    include "connection.php";

    $mail = $_POST["email"];

    $sql = "SELECT * FROM Utilizadores WHERE Email = '$mail'";
    $result_usuario=mysqli_query($conn, $sql);
    $row = mysqli_fetch_assoc($result_usuario);
    $id = $row['Id_Utilizador'];
    $nome = $row['Nome_Utilizador'];
    $email = $row['Email'];
    
    $host = $_SERVER["HTTP_HOST"];
    $caminho = substr($_SERVER["PHP_SELF"], 0, -28);

    if(mysqli_num_rows($result_usuario)==1) /* Verificar se o e-mail que o utilizador existe na base de dados*/
    {
        //$row_usuario = $result_usuario->fetch(PDO::FETCH_ASSOC);
        $chave_recuperar_senha = password_hash($id, PASSWORD_DEFAULT);
        //echo "Chave $chave_recuperar_senha <br>";

        $query_up_usuario = "UPDATE Utilizadores SET recuperar_senha ='$chave_recuperar_senha' WHERE Id_Utilizador ='$id' LIMIT 1";
        mysqli_query($conn, $query_up_usuario);
        

        $link = "$host$caminho/repor_senha.php?chave=$chave_recuperar_senha";

        try {
            /*$mail->SMTPDebug = SMTP::DEBUG_SERVER;*/
            $mail = new PHPMailer(true);
            $mail->CharSet = 'UTF-8';
            $mail->isSMTP();
            $mail->Host     = 'mail.cmbn.pt';
            $mail->SMTPAuth = true;
            $mail->Username = 'no-reply@cmbn.pt';
            $mail->Password = '$redes12TSI';
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port     = 587;      

            $mail->setFrom('no-reply@cmbn.pt', 'Recuperação de Senha');
            $mail->addAddress($email);

            $mail->isHTML(true);                                  //Set e-mail format to HTML
            $mail->Subject = 'Recuperar senha';
            $mail->Body    = 'Prezado(a) ' . $nome .".<br><br>Você solicitou alteração de senha.<br><br>Para continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: <br><br><a href='" . $link . "'>" . $link . "</a><br><br>Se você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.<br><br>";
            $mail->AltBody = 'Prezado(a) ' . $nome ."\n\nVocê solicitou alteração de senha.\n\nPara continuar o processo de recuperação de sua senha, clique no link abaixo ou cole o endereço no seu navegador: \n\n" . $link . "\n\nSe você não solicitou essa alteração, nenhuma ação é necessária. Sua senha permanecerá a mesma até que você ative este código.\n\n";

            $mail->send();

            session_start();

            $_SESSION['msg'] = "<p style='color: green'>Enviado e-mail com instruções para recuperar a senha. Acesse a sua caixa de e-mail para recuperar a senha!</p>";

            $header="Location: esquecer_senha.php?sucesso=1&email=". trim($email);
            header($header);
        } catch (Exception $e) {
            echo "Erro: E-mail não enviado sucesso. Mailer Error: {$mail->ErrorInfo}";
        }
    }
    else
    {
        $header="Location: esquecer_senha.php?erro=1&email=". trim($mail);
        header($header);
    }

    include "close.php";
?>