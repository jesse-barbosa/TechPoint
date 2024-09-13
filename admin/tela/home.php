<style>
        .welcome-card {
            background: rgba(0, 0, 0, 0.7);
            border-radius: 10px;
            padding: 1.5rem;
        }
        .card {
            border-radius: 10px;
            overflow: hidden;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
            transition: transform 0.3s;
        }
        .card:hover {
            transform: scale(1.05);
        }
        .card-body {
            background: #1c1c1c;
            color: #fff;
        }
        .card-body i {
            color: #4caf50;
        }
        .card-body h3 {
            margin: 1rem 0;
        }
        .fw-lighter {
            font-weight: 300;
        }
    </style>
    <div class="container m-3">
        <div class="row">
            <div class="col-md-9">
                <div class="welcome-card">
                    <h1 class="fw-lighter text-light" id="welcome-message"></h1>
                </div>
            </div>
            <div class="col-md-2 text-center">
                <div class="py-2 px-1 bg-dark rounded text-light" id="date-time"></div>
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
            const options = { hour: '2-digit', minute: '2-digit' };
            return now.toLocaleTimeString('pt-BR', options);
        }

        document.getElementById('welcome-message').innerText = `${getGreeting()}, <?php echo $_SESSION['nome'];?>`;
        document.getElementById('date-time').innerText = `${formatDateTime()}`;
        
        // Update time every minute
        setInterval(() => {
            document.getElementById('date-time').innerText = `${formatDateTime()}`;
        }, 60000);
    </script>

    <div class="container-fluid mt-5">
        <div class="row">
            <h3 class="fw-semibold mb-4">Total Registros</h3>
            <?php
            $cards = [
                ['icon' => 'bi-pc-display', 'class' => 'MostrarProdutos', 'method' => 'totalProdutos', 'label' => 'Total de Produtos'],
                ['icon' => 'bi-bookmark', 'class' => 'MostrarCategorias', 'method' => 'totalCategorias', 'label' => 'Total de Categorias'],
                ['icon' => 'bi-bookmarks', 'class' => 'MostrarSubCategoria', 'method' => 'totalSubCategorias', 'label' => 'Total de Sub Categorias'],
                ['icon' => 'bi-image', 'class' => 'MostrarBanners', 'method' => 'totalBanners', 'label' => 'Total de Banners'],
                ['icon' => 'bi-person', 'class' => 'MostrarUsuarios', 'method' => 'totalUsuarios', 'label' => 'Total de Usuários']
            ];

            foreach ($cards as $card) {
                echo '<div class="col-md-2 mb-4">
                        <div class="card h-100">
                            <div class="card-body text-center">
                                <i class="bi ' . $card['icon'] . ' fs-1"></i>';
                                include_once("../classe/" . $card['class'] . ".php");
                                $total = new $card['class']();
                                echo '<h3 class="text-success fw-bold">' . $total->{$card['method']}() . '</h3>
                                <p class="card-text fw-lighter">' . $card['label'] . '</p>
                            </div>
                        </div>
                      </div>';
            }
            ?>
        </div>
    </div>