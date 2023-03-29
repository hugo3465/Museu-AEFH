<?php
	include "connection.php";

	$pagina=1;
	$registosPorPagina=9;
	//Valores recebidos por parametro
	// Verificar se recebemos por GET o nu'mero de pa'gina a mostrar.
	if(isset($_GET['pagina']))
	  $pagina = $_GET['pagina'];
	//Evitar que tentem aceder a p'aginas abaixo da 1
	if ($pagina<=0) $pagina=1;

	if(isset($_POST['categoria'])) $categoria=$_POST['categoria'];
?>

<!-- Começo Galeria -->
<div class="container">
	<div class="row d-flex justify-content-center">
		<div class="menu-content col-lg-8 pt-20"> <!-- class pb-70 -->
			<div class="title text-center">
				<h1 class="mb-10">GALERIA</h1>
			</div>
		</div>
	</div>
	
	<div class="row justify-content-center">
		<form name="pesquisa" id="pesquisa" action="index.php#gallery" method="POST">
			<select name="categoria" id="categoria" class="nice-select" onchange="document.getElementById('pesquisa').submit();">
				<option value="AND Objetos.Id_Categoria=Objetos.Id_Categoria">Não filtrar</option>
				<?php
					$sql = 'SELECT * FROM Categorias;';
					$result = $conn->query($sql);
					while($row = mysqli_fetch_array($result)){
						if($row['Id_Categoria']==trim($categoria, 'AND Objetos.Id_Categoria='))
							echo '<option value="AND Objetos.Id_Categoria='. $row['Id_Categoria']. '" selected>'. $row['Categoria']. '</option>';
						else
							echo '<option value="AND Objetos.Id_Categoria='. $row['Id_Categoria']. '">'. $row['Categoria']. '</option>';
					}
				?>
			</select>
		</form>
	</div>

	<div id="galeria" class="container-fluid justify-content-center">
		<?php
			$sql = "SELECT Objetos.*, Categoria, Nome_Colecao FROM Objetos INNER JOIN Categorias INNER JOIN Colecoes ON Objetos.Id_Categoria=Categorias.Id_Categoria AND Objetos.Id_Colecao=Colecoes.Id_Colecao WHERE Objetos.Id_Estado=1 ORDER BY Data AND Nome_Colecao LIMIT ".(($pagina-1)*$registosPorPagina).", ".$registosPorPagina;
			if(isset($_POST['categoria'])) $sql = "SELECT Objetos.*, Categoria, Nome_Colecao FROM Objetos INNER JOIN Categorias INNER JOIN Colecoes ON Objetos.Id_Categoria=Categorias.Id_Categoria AND Objetos.Id_Colecao=Colecoes.Id_Colecao WHERE Objetos.Id_Estado=1 ". $categoria ." ORDER BY Data AND Nome_Colecao LIMIT ".(($pagina-1)*$registosPorPagina).", ".$registosPorPagina;

			Mostrar($sql);
		?>
		<br>
	</div>

	<div class="row justify-content-center">
		<?php include "pagination.php"; ?>
	</div>
	
</div>
<!-- Fim Galeria -->

<style>
	.img-responsive:hover {
		opacity: 0.6;
	}
</style>

<?php 
	function Mostrar($sql)
	{
		include "connection.php";
		$result = mysqli_query($conn, $sql);
		while($row = mysqli_fetch_assoc($result)) {?>
			<a href="./apresentar.php?id_objeto=<?php echo $row['Id_Objeto'];?>"><img class="img-responsive" src="../Administrador/Base de dados/Imagens/Objetos/<?php echo $row['Fotografia'];?>" alt="<?php echo $row["Nome_Objeto"] ?>"></a>
		<?php }

		include "close.php";
	}
?>