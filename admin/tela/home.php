    <div class="container m-3">
        <div class="row">
            <div class="col-10">
                <h1 class="welcome-message fw-lighter" id="welcome-message"></h1>
            </div>
            <div class="col-2">
                <div class=" p-2" id="date-time"></div>
            </div>
        </div>
    </div>

    <script>
        function getGreeting() {
            const hours = new Date().getHours();
            if (hours < 12) {
                return 'Bom dia';
            } else if (hours < 18) {
                return 'Boa tarde';
            } else {
                return 'Boa noite';
            }
        }

        function formatDateTime() {
            const now = new Date();
            const options = { hour: '2-digit', minute: '2-digit'};
            return now.toLocaleDateString('pt-BR', options);
        }

        document.getElementById('welcome-message').innerText = `${getGreeting()}, <?php echo $_SESSION['nome'];?>`;
        document.getElementById('date-time').innerText = `${formatDateTime()}`;
    </script>
    <div class="container mt-5">
        <div class="row px-5">
            <div class="col-4 mt-3">
                <div class="card" style="width: 12rem;">
                    <div class="card-body text-center">
                        <i class="bi bi-pc-display fs-1"></i>
                        <?php
                            include_once("../classe/MostrarProdutos.php");
                            $totalProdutos = new MostrarProdutos();
                            echo "<h3 class='text-success fw-bold'>" . $totalProdutos->totalProdutos() . "</h3>";
                        ?>
                        <p class="card-text fw-lighter">Total de Produtos </p>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-3">
                <div class="card" style="width: 12rem;">
                    <div class="card-body text-center">
                        <i class="bi bi-bookmark fs-1"></i>
                        <?php
                            include_once("../classe/MostrarCategorias.php");
                            $totalCategorias = new MostrarCategoria();
                            echo "<h3 class='text-success fw-bold'>" . $totalCategorias->totalCategorias() . "</h3>";
                        ?>
                        <p class="card-text fw-lighter">Total de Categorias </p>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-3">
                <div class="card" style="width: 12rem;">
                    <div class="card-body text-center">
                        <i class="bi bi-bookmarks fs-1"></i>
                        <?php
                            include_once("../classe/MostrarSubCategoria.php");
                            $totalSubCategorias = new MostrarSubCategoria();
                            echo "<h3 class='text-success fw-bold'>" . $totalSubCategorias->totalSubCategorias() . "</h3>";
                        ?>
                        <p class="card-text fw-lighter">Total de Sub Categorias </p>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-3">
                <div class="card" style="width: 12rem;">
                    <div class="card-body text-center">
                        <i class="bi bi-image fs-1"></i>
                        <?php
                            include_once("../classe/MostrarBanners.php");
                            $totalBanners = new MostrarBanners();
                            echo "<h3 class='text-success fw-bold'>" . $totalBanners->totalBanners() . "</h3>";
                        ?>
                        <p class="card-text fw-lighter">Total de Banners </p>
                    </div>
                </div>
            </div>
            <div class="col-4 mt-3">
                <div class="card" style="width: 12rem;">
                    <div class="card-body text-center">
                        <i class="bi bi-person fs-1"></i>
                        <?php
                            include_once("../classe/MostrarUsuarios.php");
                            $totalUsuarios = new MostrarUsuario();
                            echo "<h3 class='text-success fw-bold'>" . $totalUsuarios->totalUsuarios() . "</h3>";
                        ?>
                        <p class="card-text fw-lighter">Total de Usuários </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
