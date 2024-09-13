<header class="bg-white">
    <div class="container-fluid">
        <div class="row ps-5 pe-4 align-items-center">
            <div class="col-2">
                <a href="index.php?tela=home" class="logo link fs-3 fw-bold text-black link-underline link-underline-opacity-0">TechPoint</a>
            </div>
            <div class="col-8">
                <nav class="nav ps-4">
                    <a class="nav-link link link-secondary mx-2" href="index.php?tela=home">INÍCIO</a>
                    <a class="nav-link link link-secondary mx-2" href="index.php?tela=about">SOBRE</a>
                    <a class="nav-link link link-secondary mx-2" href="index.php?tela=contact">CONTATO</a>
                </nav>
            </div>
            <div class="col-2 d-flex align-items-center justify-content-end">
                <a href="index.php?tela=viewCart" class="me-3">
                    <i class="bi bi-cart text-black fs-2"></i>
                </a>
                <div class="dropdown">
                    <button class="btn btn-link p-0" type="button" id="userMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                        <?php
                            include_once("../classe/MostrarIconeUsuario.php");
                            $icons = new MostrarIconeUsuario();
                            $icons->mostrarIcone($_SESSION['idUser']);
                        ?>
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userMenuButton">
                        <li><h6 class="dropdown-header"><?php echo htmlspecialchars($_SESSION['nome']); ?></h6></li>
                        <li><p class="dropdown-item-text"><?php echo htmlspecialchars($_SESSION['email']); ?></p></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="../funcao/logout.php">Sair</a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</header>
