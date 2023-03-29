<?php
    include "connection.php";
    include "sessao.php";
    
    if (isset($_POST)) {
    $Id = $_POST["id"];
    $Colecao = $_POST["colecao"];
    $Fotografia = $_FILES["fotografia"]["name"];
    //print_r($_POST);

    if(empty($Fotografia)) { /* Caso não queira substituir a imagem */
      $sql = "UPDATE Colecoes SET Nome_Colecao='$Colecao' WHERE Id_Colecao=$Id";
      
      if (mysqli_query($conn, $sql)) {
          //echo "Record updated successfully";
          header("location:colecoes.php?alterar=1");
      } else {
          echo "Erro ao atualizar: " . mysqli_error($conn);
      }
    }
    else { /* Caso  queira substituir a imagem */
        // Imagens
        $img_nome=$_FILES["fotografia"]["name"];
        $img_tamanho=round($_FILES["fotografia"]["size"]);
        $pasta_imagens="Imagens/Colecoes";
        // determinar o tipo de ficheiro enviado
        $img_tipo=$_FILES["fotografia"]["type"];
        $local_final="./".$pasta_imagens. "/" . $img_nome;
        // caso o tamanho ou o tipo do ficheiro seja correto, permite upload
        if($img_tamanho<3.5*1048576 && ($img_tipo=="image/jpg" OR $img_tipo=="image/jpeg" OR $img_tipo=="image/pjpeg" OR $img_tipo=="image/png" OR $img_tipo=="image/JPG" OR $img_tipo=="image/JPEG" OR $img_tipo=="image/PJPEG" OR $img_tipo=="image/PNG")) {
            // copiar ficheiro para o destino

            /* Apagar o ficheiro existente */
            $sql = "SELECT Fotografia FROM Colecoes WHERE Id_Colecao= '$Id';";
            $result = mysqli_query($conn, $sql);
            $row = mysqli_fetch_assoc($result);
            $ficheiro_eliminar="Imagens/Colecoes/".$row["Fotografia"];
	          unlink ($ficheiro_eliminar);
            /* Fim Apagar o ficheiro existente */

            (move_uploaded_file($_FILES['fotografia']['tmp_name'], $local_final));
            // inserir hiperligação na base de dados

            $sql = "UPDATE Colecoes SET Nome_Colecao='$Colecao', Fotografia='$img_nome' WHERE Id_Colecao=$Id";

            if (mysqli_query($conn, $sql)) {
                // Redirecionar para outra página
                header("Location:colecoes.php?alterar=1");
            } 
            else {
                // Apresenta o erro
                echo "Erro: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
        else {
            echo "Erro ao inserir a imagem. \n Tipos de ficheiro suportados: PNG, JPG, JPEG e pJPEG\nTamanho permitido: 3.5 MB";
        }
    }

    include "close.php";
    
    }
?>