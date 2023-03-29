<nav class="pl-1" aria-label="Paginação">
  <ul class="pagination">
    <?php
      // ----- Mostrar a navegacao entre p'aginas -----------------------------------------------------------------------
      //1. Calcular o total de paginas
      if ($pesquisa==null)
        $sqlCalcularTotalPaginas = "SELECT ceil(count(*)/".$registosPorPagina.") AS totalPaginas FROM Visitas";
      else
        $sqlCalcularTotalPaginas = "SELECT ceil(count(*)/".$registosPorPagina.") AS totalPaginas FROM Visitas WHERE Id_Estado='$pesquisa'";

      $resultCalcularTotalPaginas = mysqli_query($conn, $sqlCalcularTotalPaginas);
      $rowTotalPaginas = mysqli_fetch_assoc($resultCalcularTotalPaginas);
      $totalPaginas = $rowTotalPaginas['totalPaginas'];
      //2. Determinar os valores de navegacao a aparecer no ecra	
      $antes = max(1, $pagina-2);
      $depois = min($pagina+2,$totalPaginas);
      //3. Apresentar no ecrã a navegacao
      for ($i=$antes; $i<=$depois; $i++)
        if ($i==$pagina)
          echo "<li class='page-item pagination'><a class='page-link green' href='#'>$i</a></li>";
        else
          echo "<li class='page-item pagination'><a class='page-link green' href=\"visitas.php?filtro=". $pesquisa ."&pagina=".$i."\">$i</a></li>";
      // ----- Mostrar a navegacao entre p'aginas (FIM) -----------------------------------------------------------------
    ?>
  </ul>
</nav>