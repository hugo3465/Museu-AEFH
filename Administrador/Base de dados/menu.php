<?php $activePage = basename($_SERVER['PHP_SELF'], ".php");?>

<nav class="navbar navbar-inverse bg-green header noprint">
    <div class="container-fluid">
    <ul>
        <img id="logo" src="./Imagens/LOGO branco.png">
        <li class="nav-item justify-content-center"><a href="index.php" class="<?= ($activePage == 'index') ? 'active':''; ?>"><strong>Objetos</strong></a></li>
        <li class="nav-item"><a href="categorias.php" class="<?= ($activePage == 'categorias') ? 'active':''; ?>"><strong>Categorias</strong></a></li>
        <li class="nav-item"><a href="colecoes.php" class="<?= ($activePage == 'colecoes') ? 'active':''; ?>"><strong>Coleções</strong></a></li>
        <li class="nav-item"><a href="visitas.php" class="<?= ($activePage == 'visitas') ? 'active':''; ?>"><strong>Visitas</strong></a></li>
        <li class="nav-item"><a href="emails.php" class="<?= ($activePage == 'emails') ? 'active':''; ?>"><strong>E-mails</strong></a></li>
        <li class='nav-item' id="registos" hidden><a href='registos.php' class="<?= ($activePage == 'registos') ? 'active':''; ?>"><strong>Utilizadores</strong></a></li> <!-- Caso seja um utilizador de nível 2 (Administrador) -->
    </ul>
    <ul class="navbar-right">
        <li class="nav-item"><a href="logout.php"><i class="material-icons">logout</i></a></li>
    </ul>
    </div>
</nav> <br>

<?php if($_SESSION['UtilizadorNivel']==2)
    {
        echo "<script>";
        echo "document.getElementById('registos').hidden=false";
        echo "</script>";
    }
?> 