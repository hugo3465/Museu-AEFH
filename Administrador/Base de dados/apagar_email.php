<?php
    include "connection.php";
	include "sessao.php";

    $id_email=$_GET["id_email"];

	$sql = "SELECT * FROM Noticias WHERE Id_Email= '$id_email';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	$sql = "DELETE FROM Noticias WHERE id_email=$id_email";

	if (mysqli_query($conn, $sql)) {
		//echo "Registo apagado com sucesso!";
		header("location:emails.php?apagar=1");
	} 
	else 
	{
		echo "Erro ao apagar registo: " . mysqli_error($conn);
	}

	include "close.php";
?>