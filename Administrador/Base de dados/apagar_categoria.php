<?php
	include "connection.php";
	include "sessao.php";

	$id_categoria=$_GET["id_categoria"];

	$sql = "DELETE FROM Categorias WHERE id_categoria=$id_categoria";
	// echo $sql;

	if (mysqli_query($conn, $sql)) {
		//echo "Registo apagado com sucesso!";
		header("location:categorias.php?apagar=1");
	} 
	else 
	{
		echo "Erro ao apagar registo: " . mysqli_error($conn);
	}
	include "close.php"
?>
