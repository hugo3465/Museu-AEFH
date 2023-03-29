<nav class="pl-1 mt-3" aria-label="Paginação">
  <ul class="pagination pagination-md">
    <?php
      // ----- Mostrar a navegacao entre p'aginas -----------------------------------------------------------------------
      //1. Calcular o total de paginas
      include "connection.php";
      
        $sqlCalcularTotalPaginas = "SELECT ceil(count(*)/".$registosPorPagina.") AS totalPaginas FROM Objetos";
        if(isset($_POST['categoria']))
        {
          $categoria = trim($_POST['categoria'], 'AND ');
          $sqlCalcularTotalPaginas = "SELECT ceil(count(*)/".$registosPorPagina.") AS totalPaginas, Id_Categoria FROM Objetos WHERE $categoria";
        }

      $resultCalcularTotalPaginas = mysqli_query($conn, $sqlCalcularTotalPaginas);
      $rowTotalPaginas = mysqli_fetch_assoc($resultCalcularTotalPaginas);
      $totalPaginas = $rowTotalPaginas['totalPaginas'];
      //2. Determinar os valores de navegacao a aparecer no ecra	
      $antes = max(1, $pagina-2);
      $depois = min($pagina+2,$totalPaginas);
      //3. Apresentar no ecrã a navegacao
      for ($i=$antes; $i<=$depois; $i++)
        if ($i==$pagina)
          echo "<li class='page-item pagination active'><a class='page-link' href='#gallery'><strong>$i</strong></a></li>";
        else
        {
          if(isset($_POST['categoria'])) 
          {
            $categoria='&categoria='. $_POST['categoria'];
            echo "<li class='page-item pagination'><a class='page-link' href=\"index.php?pagina=".$i. $categoria ."#gallery\"><strong>$i</strong></a></li>";
          }
          else
            echo "<li class='page-item pagination'><a class='page-link' href=\"index.php?pagina=".$i ."#gallery\"><strong>$i</strong></a></li>";
        }
          
      // ----- Mostrar a navegacao entre p'aginas (FIM) -----------------------------------------------------------------

      include "close.php";
    ?>
  </ul>
</nav>