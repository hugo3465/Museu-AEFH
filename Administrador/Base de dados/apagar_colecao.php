<?php
	include "connection.php";
	include "sessao.php";

	$id_colecao=$_GET["id_colecao"];
	
	$sql = "SELECT Fotografia FROM Colecoes WHERE Id_Colecao= '$id_colecao';";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);

	// Imagens
	$ficheiro_eliminar="Imagens/Colecoes/".$row["Fotografia"];
	unlink ($ficheiro_eliminar);

	$sql = "DELETE FROM Colecoes WHERE id_colecao=$id_colecao";
	// echo $sql;

	if (mysqli_query($conn, $sql)) {
		//echo "Registo apagado com sucesso!";
		header("location:colecoes.php?apagar=1");
	} 
	else 
	{
		echo "Erro ao apagar registo: " . mysqli_error($conn);
	}
	include "close.php"
?>