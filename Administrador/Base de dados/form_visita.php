

<?php include "visitas.php"; ?>

<!-- Modal alterar -->
<div class="modal fade" id="alterar">
<div class="modal-dialog modal-lg">
<div class="modal-content">

    <div class="modal-header">
        <h4 class="modal-title" style="font-family:var(--bs-font-sans-serif);">Alterar Visita</h4>
        <a type="button" class="btn-close" href="visitas.php"></a>
    </div>

    <div class="modal-body">
    
    <!--O conteúdo do modal começa aqui-->
    <?php
        include "connection.php";
        $sql = 'SELECT * FROM Visitas;';
        $result = $conn->query($sql);
        
        $id_visita=$_GET["id_visita"];

        $sql_visitas = "SELECT * FROM Visitas WHERE Id_Visita = '$id_visita';";
        $result_visitas = mysqli_query($conn, $sql_visitas);
        $row_visitas = mysqli_fetch_assoc($result_visitas);

        $tipo = $row_visitas["Tipo"];
        $estado = $row_visitas["Id_Estado"];

        if ($row_visitas["Id_Hora"]==1) $hora = "Manhã"; else $hora = "Tarde";

        if ($row_visitas['Id_Ciclo']==1) $ciclo = "1º Ciclo"; elseif($row_visitas['Id_Ciclo']==2) $ciclo = "2º Ciclo"; elseif($row_visitas['Id_Ciclo']==3) $ciclo = "3º Ciclo"; else $ciclo = "Secundário";

        include "close.php";
    ?>

    <div class="container">
        
        <form class="form-area " id="myForm" action="alterar_visita.php" method="post" class="contact-form text-center">
            
            <input type="hidden" name="id" id="id" value="<?php echo $row_visitas['Id_Visita'];?>"> <!-- Este input serve para mandar o Id da categoria durante o POST do form -->

            <div class="text-center"><!-- Tipo -->
                <label>Instituição</label> <br>
                <select class="text-center" name="tipo" id="tipo" onchange="Tipo();"> <!-- Tipo -->
                    <option value='Sim' disabled <?php if($tipo==1) echo "selected"; ?>>Sim</option>
                    <option value='Não' disabled <?php if($tipo==2) echo "selected"; ?>>Não</option>
                </select>
            </div>

            <div class="row">	
                <div class="col">          
                    
                    <div class="col-md-12"> <!-- Nome do Responsável -->
                        <div class="form-group">
                            <label for="nome" class="label-alone">Nome do Responsável</label>
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Nome do Resposável" value="<?php echo $row_visitas['Nome_Orientador'];?>" readonly> <br>
                        </div>
                    </div>
                    
                    <?php if($tipo==1) {?>
                    <div class="col-lg-12"> <!-- Nome da Instituição -->
                        <div class="form-group">
                            <label for="instituicao" class="label-alone"> <?php if ($tipo==1) echo "Nome da Instituição"; ?></label>
                            <input type="text" class="common-input mb-20 form-control" name="instituicao" id="instituicao" placeholder="Nome da Instituição" value="<?php echo $row_visitas['Nome_Instituicao'];?>" hidden readonly> <br>
                        </div>
                    </div>
                    <?php }?>
                    
                    <div class="col-lg-12"> <!-- Localidade -->
                        <div class="form-group">
                            <label for="localidade" class="label-alone">Localidade</label>
                            <input type="text" class="common-input mb-20 form-control" name="localidade" id="localidade" placeholder="Localidade" value="<?php echo $row_visitas['Localidade'];?>" readonly> <br>
                        </div>
                    </div>
                    
                    <div class="col-lg-12"> <!-- Email -->
                        <div class="form-group">
                            <label for="email" class="label-alone">Email</label>
                            <input type="email" class="common-input mb-20 form-control" name="email" id="email" pattern="[A-Za-z0-9._%+-]+@[A-Za-z0-9.-]+\.[A-Za-z]{1,63}$" placeholder="Email" value="<?php echo $row_visitas['Email'];?>" readonly> <br>
                        </div>
                    </div>
                    
                    <div class="col-lg-12"> <!-- Nº de Telemóvel -->
                        <div class="form-group">
                            <label for="telemovel" class="label-alone">Número de Telemóvel</label>    
                            <input type="tel" class="common-input mb-20 form-control" name="telemovel" id="telemovel" pattern="[0-9]{3}[0-9]{3}[0-9]{3}" placeholder="Número de telemóvel" value="<?php echo $row_visitas['Telefone'];?>" readonly> <br>
                        </div>
                    </div>

                </div>

                <div class="col">

                    <div class="col-lg-12"> <!-- Dia da Visita -->
                        <div class="form-group">
                            <label for="dia" class="label-alone">Dia da Visita</label>
                            <input type="date" class="common-input mb-20 form-control" name="dia" id="dia" placeholder="Data da visita" value="<?php echo $row_visitas['Dia'];?>" readonly> <br>
                        </div>
                    </div>
                    
                    <div class="col-lg-12"> <!-- Hora da Visita -->
                        <div class="form-group">
                            <label for="hora" class="label-alone">Hora da Visita</label>
                            <input type="text" class="common-input mb-20 form-control" name="hora" id="hora" placeholder="Horário da visita" value="<?php echo $hora;?>" readonly> <br>
                        </div>
                    </div>
                    
                    <?php if($tipo==1){?>
                    <div class="col-lg-12"> <!-- Número de Alunos -->
                        <div class="form-group">
                            <label for="NAlunos" class="label-alone"> <?php if ($tipo==1) echo "Número de Alunos"; ?></label>
                            <input type="number" class="common-input mb-20 form-control" name="NAlunos" id="NAlunos" placeholder="Número de Alunos" value="<?php echo $row_visitas['NAlunos'];?>" hidden readonly> <br>
                        </div>
                    </div>
                    <?php }?>

                    <?php if($tipo==1){?>
                    <div class="col-md-12"> <!-- Ciclo de estudos -->
                        <label for="ciclo" class="label-alone"><?php if ($tipo==1) echo "Ciclo de Estudos"; ?></label>
                        <input type="text" class="common-input mb-20 form-control" name="ciclo" id="ciclo" placeholder="Ciclo de Estudos" value="<?php echo "$ciclo";?>" hidden readonly> <br>
                    </div>
                    <?php }?>
                    
                    <div class="mt-20 alert-msg" style="text-align: left;"></div>
                </div>
                
            </div>

            <div class="row-lg-5 form-group"> <!-- Motivo da visita -->
                <label class="label-alone">Motivo da Visita</label>
                <textarea class="common-textarea form-control" name="comentario" id="comentario" cols="30" rows="5" placeholder="Motivo da Rejeição" readonly><?php echo $row_visitas['Motivo'];?></textarea><br>
            </div>

            <div class="col-md-12">
                <div class="form-group">
                    <label>Estado: </label>
                    <select name="estado" id="estado" onchange="Rejeicao();">
                        <option value=2 <?php if ($estado==2) echo "selected" ?>>Em Espera</option>
                        <option value=1 <?php if ($estado==1) echo "selected" ?>>Aceite</option>
                        <option value=3 <?php if ($estado==3) echo "selected" ?>>Rejeitado</option>
                    </select>
                </div>
            </div> <br>

            <div class="col-md-12"> <!-- Motivo da Rejeição -->
                <div class="form-group">
                    <label class="label-alone"><?php if ($estado==3) echo "Motivo da Rejeição"; ?></label>
                    <textarea class="common-textarea form-control" name="motivo_rejeicao" id="motivo_rejeicao" cols="30" rows="5" placeholder="Motivo da rejeição" hidden><?php echo $row_visitas['Motivo_Rejeicao'];?></textarea> <br>
                </div>
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-sm-5">
                        <div class="row justify-content-center">
                            <a class="btn btn-success btn-green" href="visitas.php">Voltar</a>
                        </div>
                    </div>

                    <div class="col-sm-2"></div> <!-- Espaçamento entre os botões -->

                    <div class="col-sm-5">
                        <div class="row justify-content-center">
                            <button onclick="return Confirmar();" id="btn" class="btn btn-success btn-green" disabled>Alterar</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="text-center" style="padding-top: 3%;">
            <p id="paragrafo">Se mudar o estado para aceito ou rejeitado, o orientador irá receber um e-mail automáticamente a dizer se o pedido foi aceite ou não.</p>
        </div>
    </div>

        </div>
    </div>
    </div>
</div>


<script>
    $(document).ready(function(){
        // Mostra o modal quando faz load
        $("#alterar").modal("show");
        Tipo();
        Rejeicao();
    });
</script>

<script> /* colocar em readonly caso o estado esteja como aceito ou rejeitado */
    var doc;
    doc=document.getElementById("estado").value;
    if (doc==1 || doc==3)
    {
        document.getElementById("estado").disabled=true;
        document.getElementById("btn").hidden=true;
        document.getElementById("paragrafo").hidden=true;
    }
</script>

<script> /* Ocultar ou mostrar o input com o motivo da rejeição */

    if (document.getElementById("estado").value==3)
    {
        document.getElementById("motivo_rejeicao").hidden=false;
        document.getElementById("motivo_rejeicao").readOnly=true;
    }

    function Rejeicao()
    {
        if (document.getElementById("estado").value==3)
        {
            document.getElementById("motivo_rejeicao").hidden=false;
            document.getElementById("motivo_rejeicao").readonly=false;
            document.getElementById("btn").disabled = false;
        }
        else if(document.getElementById("estado").value==1)
        {
            document.getElementById("motivo_rejeicao").hidden=true;
            document.getElementById("btn").disabled = false;
        }
        else if(document.getElementById("estado").value==2)
        {
            document.getElementById("motivo_rejeicao").hidden=true;
            document.getElementById("btn").disabled = true;
        }
    }
</script>

<script>
    function Tipo()
    {
        if(document.getElementById("tipo").value == 'Sim')
        {
            document.getElementById("ciclo").hidden=false;
            document.getElementById("instituicao").hidden=false;
            document.getElementById("NAlunos").hidden=false;
        }
        else if(document.getElementById("tipo").value == 'Não')
        {
            document.getElementById("ciclo").hidden=true;
            document.getElementById("instituicao").hidden=true;
            document.getElementById("NAlunos").hidden=true;
        }
    }
</script>

<!-- Botão para confirmar a alteração -->
<script>
	function Confirmar()
	{
		let texto="Tem a certeza que pretende alterar este registo?";
		if (confirm(texto)!=true) return false; //Caso o utilizador clique no botão cancelar, vai fazer return false
		
        return true;
    }
</script>