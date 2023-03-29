<?php
    require_once('./PHPMailer/vendor/autoload.php');
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    if (isset($_POST))
    {
      include "connection.php";
      include "sessao.php";

      $Objeto = $_POST["nome"];
      $Descricao = $_POST["descricao"];
      $Criador = $_POST["criador"];
      $Ano = $_POST["ano"];
      $Origem = $_POST["origem"];
      $Categoria = $_POST["categoria"];
      //$Fotografia = $_POST["fotografia"];
      $Estado = $_POST["estado"];
      $Colecao = $_POST["colecao"];
      $Data = date("Y-m-d h:i:s");
      echo $Colecao;

      // Imagens
      $img_nome=$_FILES["fotografia"]["name"];
      $img_tamanho=round($_FILES["fotografia"]["size"]);
      $pasta_imagens="Imagens/Objetos";
      // determinar o tipo de ficheiro enviado
      $img_tipo=$_FILES["fotografia"]["type"];
      $local_final="./".$pasta_imagens. "/" . $img_nome;
      // caso o tamanho ou o tipo do ficheiro seja correto, permite upload
      if($img_tamanho<3.5*1048576 && ($img_tipo=="image/jpg" OR $img_tipo=="image/jpeg" OR $img_tipo=="image/pjpeg" OR $img_tipo=="image/png" OR $img_tipo=="image/JPG" OR $img_tipo=="image/JPEG" OR $img_tipo=="image/PJPEG" OR $img_tipo=="image/PNG")) {
          // copiar ficheiro para o destino
          (move_uploaded_file($_FILES['fotografia']['tmp_name'], $local_final));
          // inserir hiperligação na base de dados

          if ($Colecao==0)
            $sql = "INSERT INTO Objetos (Nome_Objeto, Descricao, Criador, Ano_Origem, Pais, Id_Categoria, Fotografia, Id_Estado, Data) VALUES ('$Objeto', '$Descricao', '$Criador', '$Ano', '$Origem', '$Categoria', '$img_nome', '$Estado', '$Data')";
          else
            $sql = "INSERT INTO Objetos (Nome_Objeto, Descricao, Criador, Ano_Origem, Pais, Id_Categoria, Id_Colecao, Fotografia, Id_Estado, Data) VALUES ('$Objeto', '$Descricao', '$Criador', '$Ano', '$Origem', '$Categoria', '$Colecao', '$img_nome', '$Estado', '$Data')";

          if (mysqli_query($conn, $sql)) {
            if ($Estado==1) {
              // Redirecionar para outra página
              header("location:index.php?insere=1");

              /*
                Enviar o Email
              */
              $mail = new PHPMailer(true); 


              $assunto='Novo objeto no museu AEFH';
              
              $mail -> isSMTP(); 
              // configs para se autenticar no smtp
            
              $mail->Host     = 'mail.cmbn.pt';
              $mail->SMTPAuth = true;
              $mail->Username = 'no-reply@cmbn.pt';
              $mail->Password = '$redes12TSI';
              $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
              $mail->Port     = 587;        
            
              // info do remetente
              $mail->setFrom('no-reply@cmbn.pt', 'Novo objeto no museu AEFH');
              $mail->addReplyTo('no-reply@cmbn.pt', 'Info');

              // configs do email
              $mail->isHTML(true); //corpo da mensagem aceita html
              $mail->Subject = utf8_decode($assunto);

              $mail->Body = utf8_decode(
                "
                <p class='MsoNormal'>Foi adicionado um novo objeto à nossa coleção.</p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'>Venha ver o novo(a): <strong>$Objeto</strong></p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'><strong>Este email é meramente informativo, e não está preparado para aceitar respostas. Deste modo, agradecemos que não responda para este endereço.</strong></p>
                <p class='MsoNormal'> </p>
                <p class='MsoNormal'>Com os melhores cumprimentos,</p>
                <p class='MsoNormal'>Museu Francisco de Holanda</p>
                "
              );

              $sql = 'SELECT * FROM Noticias';
              $result = mysqli_query($conn, $sql);
              // info do destinatário do email
              while($row = mysqli_fetch_assoc($result)){
                $mail->addBcc($row['Email']); /* em caso de erro, trocar addbcc por add address */
              }
              $mail->send();
              

              /*
                Fim Enviar o Email
              */
            }
            else {
              header("location:index.php?insere=1");
            }
          }
          else {
              // Apresenta o erro
              echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
          }
        }
      else {
        echo "Erro ao inserir a imagem. \n Tipos de ficheiro suportados: PNG, JPG, JPEG e pJPEG\nTamanho permitido: 3.5 MB";
      }

      include "close.php";
    }
?>