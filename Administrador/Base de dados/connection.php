<?php
	$servername = "localhost";
	$username = "root";
	$password = "";
	$dbname = "museu";

	// Ligação ao servidor
	$conn = new Mysqli($servername, $username, $password, $dbname);

	// Codificação de caracteres usada pela base de dados 
	$conn->set_charset("utf8");

	// Verificar se ligou à base de dados
	if ($conn->connect_errno!=0){  
		echo "Ocorreu um erro de ligação à base de dados;" . $conn->connect_error;
		exit();
		}
?>