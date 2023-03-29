
<?php include "index.php"; ?>

<!-- Modal alterar -->
<div class="modal fade" id="alterar">
<div class="modal-dialog modal-lg">
<div class="modal-content">

    <div class="modal-header">
        <h4 class="modal-title" style="font-family:var(--bs-font-sans-serif);">Alterar Objeto</h4>
        <a type="button" class="btn-close" href="index.php"></a>
    </div>

    <div class="modal-body">
    
    <!--O conteúdo do modal começa aqui-->
    <?php
        include "connection.php";
        $sql = 'SELECT * FROM Objetos INNER JOIN Categorias ON objetos.Id_Categoria=categorias.Id_Categoria;';
        $result = $conn->query($sql);
        
        $id_objeto=$_GET["id_objeto"];

        $sql_objetos = "SELECT Id_Objeto, Nome_Objeto, Descricao, Criador, Ano_Origem, Pais, Id_Categoria, Id_Colecao, Fotografia, Id_Estado, Data FROM Objetos WHERE Id_Objeto = '$id_objeto';";
        $result_objetos = mysqli_query($conn, $sql_objetos);
        $row_objetos = mysqli_fetch_assoc($result_objetos);
        include "close.php";
    ?>
    <form name="objeto" action="alterar_objeto.php" method="POST" enctype="multipart/form-data">
        <div class="container teste">

            <input type="hidden" name="id" id="id" value="<?php echo $row_objetos['Id_Objeto'];?>"> <!-- Este input serve para mandar o Id do objeto durante o POST do form -->
            
            <div class="mb-3 row"> <!-- Nome -->
                <label class="col-sm-2 col-form-label">Nome*:</label>
                <div class="col-sm-10">
                    <input required type="text" name="nome" id="nome" class="form-control" placeholder="Nome" value="<?php echo $row_objetos['Nome_Objeto'];?>">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Criador -->
                <label class="col-sm-2 col-form-label">Criador:</label>
                <div class="col-sm-10">
                    <input type="text" name="criador" id="criador" class="form-control" placeholder="Criador" value="<?php echo $row_objetos['Criador'];?>">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Ano -->
                <label class="col-sm-2 col-form-label">Ano:</label>
                <div class="col-sm-10">
                    <input type="text" name="ano" id="ano" maxlength="20" class="form-control" placeholder="Ano" value="<?php echo $row_objetos['Ano_Origem'];?>">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Origem -->
                <label class="col-sm-2 col-form-label">Origem:</label>
                <div class="col-sm-10">
                    <input type="text" name="origem" id="origem" class="form-control" placeholder="Origem" value="<?php echo $row_objetos['Pais'];?>">
                </div>
            </div>

            <div class="mb-3 row"> <!-- Categoria -->
                <label class="col-sm-2 col-form-label">Categoria*:</label>
                <div class="col-sm-10">
                    <Select name="categoria" id="categoria">
                    <?php
                        include "connection.php";
                        $sql = 'SELECT * FROM Categorias;';
                        $result = $conn->query($sql);
                        while($row = mysqli_fetch_array($result)){
                            if($row['Id_Categoria']==$row_objetos['Id_Categoria'])
                                echo '<option value="'. $row['Id_Categoria']. '" selected>'. $row['Categoria']. '</option>';
                            else
                                echo '<option value="'. $row['Id_Categoria']. '">'. $row['Categoria']. '</option>';
                        }
                        include "close.php";
                    ?>
                    </Select>

                    <label class="col-sm-2 col-form-label pl-2">Coleção*:</label>
                    <Select name="colecao" id="colecao">
                        <?php
                            include "connection.php";
                            $sql = 'SELECT * FROM Colecoes;';
                            $result = $conn->query($sql);
                            while($row = mysqli_fetch_array($result)){
                                if($row['Id_Colecao']==$row_objetos['Id_Colecao'])
                                    echo '<option value="'. $row['Id_Colecao']. '" selected>'. $row['Nome_Colecao']. '</option>';
                                else
                                    echo '<option value="'. $row['Id_Colecao']. '">'. $row['Nome_Colecao']. '</option>';
                            }
                            include "close.php";
                        ?>
                    </Select>
                </div>
            </div>

            <div class="mb-3 row"> <!-- Estado -->
                <label class="col-sm-2 col-form-label">Estado*:</label>
                <div class="col-sm-10">
                    <?php if($row_objetos["Id_Estado"]==1) { ?>
                    <label for="Publico">Público</label>
                    <input type="radio" name="estado" id="estado" value=1 checked>

                    <label for="Privado">Privado</label>
                    <input type="radio" name="estado" id="estado" value=2>
                <?php } else {?>
                    <label for="Publico">Público</label>
                    <input type="radio" name="estado" id="estado" value=1>

                    <label for="Privado">Privado</label>
                    <input type="radio" name="estado" id="estado" value=2 checked>
                <?php }?>
                </div>
            </div>

            <div class="mb-3 row"> <!-- Descrição -->
                <label class="col-sm-2 col-form-label">Descricao:</label>
                <div class="col-sm-10">
                    <textarea onkeyup="tinyMCE.triggerSave();" name="descricao" id="descricao" class="form-control" placeholder="Descrição" cols="30" rows="10"><?php echo $row_objetos['Descricao']; ?></textarea>
                </div>
            </div>

            <div class="mb-3 row"> <!-- Fotografia -->
                <label class="col-sm-2 col-form-label form-label">Fotografia*:</label>
                <div class="col-sm-10">
                    <input class="form-control" type="file" name="fotografia" id="fotografia" class="form-control" value="<?php echo $row_objetos['Fotografia'];?>">
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="row justify-content-center">
                            <a class="btn btn-success btn-green" href="index.php">Voltar</a>
                        </div>
                    </div>

                    <div class="col-sm-2"></div> <!-- Espaçamento entre os botões -->

                    <div class="col-sm-5">
                        <div class="row justify-content-center">
                            <button onclick="return Confirmar();" id="btn" class="btn btn-success btn-green">Alterar</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </form>

        </div>
    </div>
    </div>
</div>

<script>
    $(document).ready(function(){
    // Show the Modal on load
    $("#alterar").modal("show");
    });
</script>

<!-- Botão para confirmar a alteração -->
<script>
	function Confirmar()
	{
		let texto="Tem a certeza que pretende alterar este objeto?";
		if (confirm(texto)!=true) return false; //Caso o utilizador clique no botão cancelar, vai fazer return false
		
        return true;
    }
</script>