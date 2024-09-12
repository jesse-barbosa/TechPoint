<style>
.related-products-container {
    overflow-x: auto;
    white-space: nowrap;
    padding-bottom: 10px;
}

.related-products .col-6 {
    display: inline-block;
    float: none;
    margin-right: 10px;
}
</style>
<main class="container-fluid py-5">
    <div class="row bg-white">
        <?php
            include_once("../classe/MostrarProduto.php");
            $produto = new MostrarProduto();
            if (isset($_GET['id'])) {
                $produto->setIdProduct((int)$_GET['id']);
                $produto->mostrarProduto();
            } else {
                echo "<div class='alert alert-danger'>Produto não encontrado.</div>";
            }
        ?>
    </div>

    <h2 class="fw-lighter m-3">Produtos Relacionados</h2>
    
    <!-- Seção com scroll horizontal -->
    <div class="related-products-container">
        <div class="related-products d-flex">
            <?php
                include_once("../classe/MostrarRelacionados.php");
                $produto = new MostrarRelacionados();
                if (isset($_GET['id'])) {
                    $produto->setCategory((int)$_GET['id']);
                    $produto->mostrarRelacionados();
                } else {
                    echo "<div class='alert alert-danger'>Produto não encontrado.</div>";
                }
            ?>
        </div>
    </div>
</main>
