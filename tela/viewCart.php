<main class="container-fluid py-5">
    <div class="row bg-white">
        <h2 class="fw-lighter m-3">Seu carrinho</h2>

        <?php
            include_once("../classe/MostrarCarrinho.php");
            include_once("../classe/ApagarDoCarrinho.php");

            // Verifica se foi solicitada a exclusão de um produto
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['idProduto'])) {
                $idProduto = (int) $_POST['idProduto'];

                $apagar = new ApagarDoCarrinho();
                $apagar->removerProduto($idProduto);
            }

            $carrinho = new MostrarCarrinho();
            $carrinho->mostrarProdutos();
        ?>

    </div>
</main>
