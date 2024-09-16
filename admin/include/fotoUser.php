<div class="col bg-warning">
    <div class="d-flex flex-row text-center">
    
        <?php
            if ($_SESSION['nome'] == 'Diego') {
                echo '<div class="text-center my-auto ms-3 my-3 lead text-light">';
                    echo "<h4 class='fw-semibold'>".$_SESSION['nome']."</h4>\n";
                    echo '<img src="../img/diego.png" class="rounded-3 ms-2 w-75" alt="Icone">';
                echo '</div>';
            } else {
                echo '<div class="text-start my-auto ms-3 my-3 lead text-light">';
                    echo '<img src="../img/icon.png" class="rounded-3 my-3 mx-3 w-25" alt="Icone">';
                    echo $_SESSION['nome'];
                echo '</div>';
            }
        ?>
    </div>
</div>