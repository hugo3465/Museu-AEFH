<?php
	include "connection.php";
	include "sessao.php";

	$id_objeto=$_GET["id_objeto"];

	$sql = "SELECT Fotografia FROM Objetos WHERE Id_Objeto= '$id_objeto';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	// Imagens
	$ficheiro_eliminar="Imagens/Objetos/".$row["Fotografia"];
	unlink ($ficheiro_eliminar);

	$sql = "DELETE FROM Objetos WHERE id_objeto=$id_objeto";

	if (mysqli_query($conn, $sql)) {
		//echo "Registo apagado com sucesso!";
		header("location:index.php?apagar=1");
	} 
	else 
	{
		echo "Erro ao apagar registo: " . mysqli_error($conn);
	}

	include "close.php"
?>