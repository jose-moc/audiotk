<?php
 if($this->num_pages > 1):
    $qty = 5;                       // cantidad de páginas a mostrar ( de 3 en 3, de 5 en 5, etc... )
    $page = $this->getPage();       // página actual
    $corte = ceil($page / $qty);    // El corte es el numero de páginas que se muestran a la vez (del 1 al 5 - corte 1, del 5 al 10 - corte 2, etc..). En 15 páginas tendriamos 3 cortes
    $final = $corte * $qty;         // número final para el paginador, ejemplo 10
    $ini = $final - ($qty-1);       // número início para el paginador, , ejemplo 10 - 4 = 6

    // marcador de página final. Calculo del inicio del ultimo corte
    /*$last_flat = floor($this->num_pages/$qty);
    $last_flat = $last_flat * $qty;
    $last_flat = ($this->num_pages-1)-$last_flat;*/
?>
    <nav aria-label="Page navigation" class="text-center">
        <ul class="pagination pagination-sm">
            <?php if($page > 1): ?>
                <li>
                    <a href="index.php?c=<?php echo $this->ctrl; ?>&p=<?php echo $page-1; ?>" aria-label="Previous"><span aria-hidden="true">&laquo;</span></a>
                </li>
            <?php endif; ?>

            <?php if($page > 5): ?>
                <li><a href="index.php?c=<?php echo $this->ctrl; ?>&p=1">1</a></li>
                <li class="disabled"><a href="#">...</a></li>
            <?php endif; ?>


            <?php for($i=$ini; $i <= $this->num_pages; $i++): ?>

                <?php if ($i > $final){ break; } ?>

                <li class="<?php echo ($page == $i)? 'active' : '' ?>">
                    <a href="index.php?c=<?php echo $this->ctrl; ?>&p=<?php echo $i ?>"><?php echo $i ?></a>
                </li>

            <?php endfor; ?>

            <?php /*if($page < ($this->num_pages-$last_flat)): ?>
                <li class="disabled"><a href="#">...</a></li>
                <li><a href="index.php?c=<?php echo $this->ctrl; ?>&p=<?php echo $this->num_pages ?>"><?php echo $this->num_pages ?></a></li>
            <?php endif;*/ ?>

            <?php if($page < $this->num_pages): ?>
                <li class="<?php echo ($page == $this->num_pages)? 'hidden' : '' ?>">
                    <a href="index.php?c=<?php echo $this->ctrl; ?>&p=<?php echo $page+1; ?>" aria-label="Next"><span aria-hidden="true">&raquo;</span></a>
                </li>
            <?php endif; ?>
        </ul>
    </nav>
<?php endif; ?>
