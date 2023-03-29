<?php
    if (isset($_POST))
    {
      include "connection.php";
      include "sessao.php";

      $colecao = $_POST["colecao"];

      // Imagens
      $img_nome=$_FILES["fotografia"]["name"];
      $img_tamanho=round($_FILES["imagem"]["size"]);
      $pasta_imagens="Imagens/Colecoes";
      // determinar o tipo de ficheiro enviado
      $img_tipo=$_FILES["fotografia"]["type"];
      $local_final="./".$pasta_imagens. "/" . $img_nome;
      // caso o tamanho ou o tipo do ficheiro seja correto, permite upload
      if($img_tamanho<3.5*1048576 && ($img_tipo=="image/jpg" OR $img_tipo=="image/jpeg" OR $img_tipo=="image/pjpeg" OR $img_tipo=="image/png" OR $img_tipo=="image/JPG" OR $img_tipo=="image/JPEG" OR $img_tipo=="image/PJPEG" OR $img_tipo=="image/PNG")) {
          // copiar ficheiro para o destino
          (move_uploaded_file($_FILES['fotografia']['tmp_name'], $local_final));
          // inserir hiperligação na base de dados

          $sql = "INSERT INTO Colecoes (Nome_Colecao, Fotografia) VALUES ('$colecao', '$img_nome')";

            if (mysqli_query($conn, $sql)) {
              header("location:colecoes.php?insere=1");
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
?>