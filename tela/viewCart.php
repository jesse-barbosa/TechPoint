<main class="container-fluid py-5">
    <div class="row bg-white">
    <h2 class="fw-lighter m-3">Seu carrinho</h2>
        <?php
            include_once("../classe/MostrarCarrinho.php");
            $carrinho = new MostrarCarrinho();
            $carrinho->mostrarProdutos();
        ?>
    </div>
</main>