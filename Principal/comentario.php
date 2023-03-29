<!--<head>
    <meta http-equiv="Content-Type" content="text/html" charset="iso-8859-1" />
</head>-->

<?php
    if(isset($_POST) && (empty($_POST["nome"]) && empty($_POST["email"]) && empty($_POST["assunto"]) && empty($_POST["mensagem"]) ) )
    {
        header("Location: index.php");
        exit;
    }

    //header('Content-type: text/html; charset=utf-8');

    $nome = $_POST["nome"];
    $email = $_POST["email"];
    $assunto = $_POST["assunto"];
    $mensagem = $_POST["mensagem"];

    /*
    
        Enviar o Email
    
    */
    require_once('./PHPMailer/vendor/autoload.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $mail = new PHPMailer(true); 

    try{
        //$mail -> SMTPDebug = SMTP::DEBUG_SERVER;
        $mail -> isSMTP(); 
        // configs para se autenticar no smtp
    
        $mail->Host     = 'mail.cmbn.pt';
        $mail->SMTPAuth = true;
        $mail->Username = 'no-reply@cmbn.pt';
        $mail->Password = '$redes12TSI';
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
        $mail->Port     = 587;

    
        // info do remetente
        $mail->setFrom('no-reply@cmbn.pt', utf8_decode('Comentário do museu AEFH'));
    
        // info do destinatário do email
        $mail->addAddress("aefhmuseu@gmail.com");
    
        // configs do email
        $mail->isHTML(true); //corpo da mensagem aceita html
        $mail->Subject = utf8_decode($assunto);
        
        $mail->Body = utf8_decode(
            "
            <p class='MsoNormal'>$nome comentou o site do museu</p>
            <p class='MsoNormal'> </p>
            <p class='MsoNormal'><strong>E-mail:</strong> $email</p>
            <p class='MsoNormal'><strong>Assunto:</strong> $assunto</p>
            <p class='MsoNormal'> </p>
            <p class='MsoNormal'><strong>mensagem:</strong></p>
            <p class='MsoNormal'>$mensagem</p>
            <p class='MsoNormal'> </p>
            <p class='MsoNormal'><strong>Este email é meramente informativo, e não está preparado para aceitar respostas. Deste modo, agradecemos que não responda para este endereço.</strong></p>
            "
        );
    
        // envia o email
        $mail->send();

        header("Location: index.php");
            
        }

    catch(Exception $e){ 
        echo "Erro ao enviar: " . $e->getMessage();
    }
?>