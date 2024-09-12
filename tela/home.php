    <?php
        include_once("../classe/MostrarBanners.php");
        $banners = new MostrarBanners();
        $banners->mostrarBanners();
    ?>
    <main class="container-fluid mt-3">
        <div class="row mx-2">
            <div class="col-3 bg-white rounded-2">
                <!-- Filtro -->
                <h4 class="text-start mt-4 ms-2 fw-bold">Filtro</h4>
                <hr />
                <h5 class="text-start ms-2">Filtrar por categoria</h5>
                <form action="index.php" class="p-2" method="GET">
                <select name="categoria" class="form-select mb-3">
                    <option value="">Geral</option>
                    <?php
                        include_once("../classe/MostrarCategoriasFilter.php");
                        $categoriasFilter = new MostrarCategoriasFilter();
                        $categoriasFilter->mostrarCategoriasFilter();
                    ?>
                </select>
                <button type="submit" class="btn btn-dark form-control">Filtrar</button>
            </form>
            </div>
            <div class="col-9">
                <div class="container-fluid">
                    <div class="row">
                        <!-- Produtos -->
                        <?php
                        include_once("../classe/MostrarProdutos.php");
                        $produtos = new MostrarProdutos();
                        $numPagina = isset($_GET['pg']) ? (int)$_GET['pg'] : 1;
                        $filtroCategoria = isset($_GET['categoria']) ? $_GET['categoria'] : '';
                        $produtos->setNumPagina($numPagina);
                        $produtos->setUrl("index.php?categoria=" . urlencode($filtroCategoria));
                        $produtos->setSessao('');
                        $produtos->setFiltroCategoria($filtroCategoria);
                        $produtos->mostrarProdutos();
                        ?>
                    </div>
                </div>
            </div>
        </div>
        <!-- Paginação -->
        <div class="section">
            <div class="container">
                <div class="row">
                    <div class="col d-flex flex-column align-items-center">
                        <ul class="nav nav1 d-flex">
                            <li><?php $produtos->geraNumeros(); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </main>