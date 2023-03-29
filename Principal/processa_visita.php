<?php
    if(empty($_POST) && (empty($_POST["instituicao"]) || empty($_POST["nome"]) || empty($_POST["localidade"]) || empty($_POST["email"]) || empty($_POST["telemovel"]) || empty($_POST["NAlunos"]) || empty($_POST["dia"]) || empty($_POST["hora"] ) ) )
    {
        header("Location: index.html");
        exit;
    }

    include "connection.php";

    $tipo=$_POST["tipo"];
    $instituicao=$_POST["instituicao"];
    $nome=$_POST["nome"];
    $localidade=$_POST["localidade"];
    $email=$_POST["email"];
    $telemovel=$_POST["telemovel"];
    $ciclo=$_POST["ciclo"];
    $NAlunos=$_POST["NAlunos"];
    $dia=$_POST["dia"];
    $hora=$_POST["hora"];
    $motivo=$_POST["motivo"];

    /*
 
        Inserir na Base de Dados

    */

    // Query para a inserção de dados na BD
    if ($tipo == 1)
    {
        $sql = "INSERT INTO Visitas (Nome_Instituicao, Nome_Orientador, Localidade, Email, Telefone, Tipo, NAlunos, Id_Ciclo, Dia, Id_Hora, Motivo, Id_Estado)
        VALUES ('$instituicao', '$nome', '$localidade', '$email', '$telemovel', '$tipo', '$NAlunos', '$ciclo', '$dia', '$hora', '$motivo', 2)";
    }
    else if ($tipo == 2)
    {
        $sql = "INSERT INTO Visitas (Nome_Orientador, Localidade, Email, Telefone, Tipo, Dia, Id_Hora, Motivo, Id_Estado)
    VALUES ('$nome', '$localidade', '$email', '$telemovel', '$tipo', '$dia', '$hora','$motivo', 2)";
    }

    // Executa a query e verifica se deu erro
    if (mysqli_query($conn, $sql)) {
        // Redirecionar para outra página
        header("location:index.php?sucesso=1#visitas");
    } 
    else {
        // Apresenta o erro
        echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
    }

    /* Isto serve para não mandar e-mails com id */
    if ($hora==1) $hora = 'Manhã'; else $hora= 'Tarde';
    if ($ciclo==1) $ciclo = '1º Ciclo'; elseif ($ciclo==2) $ciclo = '2º Ciclo'; elseif ($ciclo==3) $ciclo = '3º Ciclo'; else $ciclo = 'Secundário';



    /*
    
        Enviar o Email
    
    */
    require_once('./PHPMailer/vendor/autoload.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    $assunto='Visita ao museu do AEFH';

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
        $mail->setFrom('no-reply@cmbn.pt', 'Visita ao museu do AEFH');
    
        // info do destinatário do email
        $mail->addAddress($email);
    
        // configs do email
        $mail->isHTML(true); //corpo da mensagem aceita html
        $mail->Subject = utf8_decode($assunto);
        
        if($tipo == 1) /* Se for instituição */
        {
            $mail->Body = utf8_decode(
                "
                <p class='MsoNormal'>Caro(a) Sr.(a) $nome</p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'>Agradecemos por requesitar uma visita ao nosso museu. Seremos breves na resposta.</p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'>Instituição: $instituicao</p>
                <p class='MsoNormal'>Nome do Responsável: $nome</p>
                <p class='MsoNormal'>Localidade: $localidade</p>
                <p class='MsoNormal'>E-mail: $email</p>
                <p class='MsoNormal'>Telemóvel: $telemovel</p>
                <p class='MsoNormal'>Ciclo de Estudos: $ciclo</p>
                <p class='MsoNormal'>Número de alunos: $NAlunos</p>
                <p class='MsoNormal'>Dia da Visita: $dia</p>
                <p class='MsoNormal'>Hora da Visita: $hora</p>
                <p class='MsoNormal'>Motivo: $motivo</p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'><strong>Este email é meramente informativo, e não está preparado para aceitar respostas. Deste modo, agradecemos que não responda para este endereço.</strong></p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'>Com os melhores cumprimentos,</p>
                <p class='MsoNormal'>Museu Francisco de Holanda</p>
                "
            );
        }
        else if($tipo == 2) /* Se não for instituição */
        {
            $mail->Body = utf8_decode(
                "
                <p class='MsoNormal'>Caro(a) Sr.(a) $nome</p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'>Agradecemos por requesitar uma visita ao nosso museu. Seremos breves na resposta.</p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'>Nome do Responsável: $nome</p>
                <p class='MsoNormal'>Localidade: $localidade</p>
                <p class='MsoNormal'>E-mail: $email</p>
                <p class='MsoNormal'>Telemóvel: $telemovel</p>
                <p class='MsoNormal'>Dia da Visita: $dia</p>
                <p class='MsoNormal'>Hora da Visita: $hora</p>
                <p class='MsoNormal'>Motivo: $motivo</p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'><strong>Este email é meramente informativo, e não está preparado para aceitar respostas. Deste modo, agradecemos que não responda para este endereço.</strong></p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'>Com os melhores cumprimentos,</p>
                <p class='MsoNormal'>Museu Francisco de Holanda</p>
                "
            );
        }
    
        // envia o email
        $mail->send();
            
        }

    catch(Exception $e){ 
        echo "Erro ao enviar: " . $e->getMessage();
    }

    /*
        Enviar e-mail para o museu da escola
    */

    try{
        $mail->ClearAddresses();
        //$mail -> SMTPDebug = SMTP::DEBUG_SERVER;
        $mail -> isSMTP(); 
    
        // info do remetente
        $mail->setFrom('no-reply@cmbn.pt', "Nova visita requesitada");
    
        // info do destinatário do email
        $mail->addAddress("aefhmuseu@gmail.com");
    
        // configs do email
        $mail->isHTML(true); //corpo da mensagem aceita html
        $mail->Subject = utf8_decode("Nova visita requesitada");

        $mail->Body = utf8_decode(
            "
            <p class='MsoNormal'>Uma nova visita foi requisitada. Por favor seja o mais breve possível a responder</p>
            <p class='MsoNormal'><strong>Museu Francisco de Holanda</strong></p>
            "
        );


    
        // envia o email
        $mail->send();
            
        }

    catch(Exception $e){ 
        echo "Erro ao enviar: " . $e->getMessage();
    }

    include "close.php";
?>