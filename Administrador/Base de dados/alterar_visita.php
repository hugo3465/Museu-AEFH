<?php
	if(empty($_POST) && (empty($_POST["id_visita"]) || empty($_POST["estado"]) || empty($_POST["email"]) || empty($_POST["dia"]) || empty($_POST["hora"]) ))
    {
        header("Location: visitas.php");
        exit;
    }

	include "connection.php";
	include "sessao.php";


	$id_visita=$_POST["id"];
	$estado=$_POST["estado"];
	$nome = $_POST["nome"];
	$motivo_rejeicao=$_POST["motivo_rejeicao"];
	$email=$_POST["email"];
	$dia=$_POST["dia"];
	$hora=$_POST["hora"];
	

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
		$assunto='Visita ao museu do AEFH';
		
		$mail -> isSMTP(); 
		// configs para se autenticar no smtp
	
		$mail->Host     = 'mail.cmbn.pt';
		$mail->SMTPAuth = true;
		$mail->Username = 'no-reply@cmbn.pt';
		$mail->Password = '$redes12TSI';
		$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
		$mail->Port     = 587;        
	
		// info do remetente
		$mail->setFrom('no-reply@cmbn.pt', 'Visita ao museu ESFH');
		$mail->addReplyTo('no-reply@cmbn.pt', 'Info');
	
		// info do destinatário do email
		$mail->addAddress($email);

		// configs do email
		$mail->isHTML(true); //corpo da mensagem aceita html
		$mail->Subject = utf8_decode($assunto);

		/*
			Fim Enviar o Email
		*/

		/* 
			Saber se o pedido foi aceite ou recusado 
		*/
		if ($estado==1)
		{
			$mail->Body = utf8_decode(
				"
				<p class='MsoNormal'>Caro(a) Sr.(a) $nome</p>
				<p class='MsoNormal'> </p>
				<p class='MsoNormal'> </p>
				<p class='MsoNormal'>O seu pedido foi aceite <br> A sua visita está marcada para o dia: $dia de $hora</p>
				<p class='MsoNormal'> </p>
				<p class='MsoNormal'><strong>Este email é meramente informativo, e não está preparado para aceitar respostas. Deste modo, agradecemos que não responda para este endereço.</strong></p>
				<p class='MsoNormal'> </p>
				<p class='MsoNormal'>Com os melhores cumprimentos,</p>
				<p class='MsoNormal'>Museu Francisco de Holanda</p>
				"
			);
		}
		elseif ($estado==3)
		{

			$mail->Body = utf8_decode(
				"
				<p class='MsoNormal'>Caro(a) Sr.(a) $nome</p>
				<p class='MsoNormal'> </p>
				<p class='MsoNormal'> </p>
				<p class='MsoNormal'>O seu pedido foi recusado pelo seguinte motivo: <br> $motivo_rejeicao</p>
				<p class='MsoNormal'> </p>
				<p class='MsoNormal'><strong>Este email é meramente informativo, e não está preparado para aceitar respostas. Deste modo, agradecemos que não responda para este endereço.</strong></p>
				<p class='MsoNormal'> </p>
				<p class='MsoNormal'>Com os melhores cumprimentos,</p>
				<p class='MsoNormal'>Museu Francisco de Holanda</p>
				"
			);
		}
		else
		{
			header("Location: visitas.php");
		}
			$mail->send();
            
    }

	catch(Exception $e){ 
		echo "Erro ao enviar: " . $e->getMessage();
	}


	/*
		Atualizar os dados da base de dados
	*/
	if ($estado==3)
	{
		$sql = "UPDATE Visitas SET Id_Estado='$estado', Motivo_Rejeicao='$motivo' WHERE Id_Visita='$id_visita'";
	}
	else
	{
		$sql = "UPDATE Visitas SET Id_Estado='$estado' WHERE Id_Visita='$id_visita'";
	}

	if (mysqli_query($conn, $sql)) {
		//echo "Record updated successfully";
		header("location:visitas.php?alterar=1");
	} else {
		echo "Erro ao atualizar: " . mysqli_error($conn);
	}
		
	include "close.php";
?>