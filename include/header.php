<header class="bg-white">
        <div class="container-fluid">
            <div class="row ps-5 pe-4 align-items-center">
                <div class="col-2">
                    <a href="index.php?tela=home" class="logo link fs-3 fw-bold text-black link-underline link-underline-opacity-0">TechPoint</a>
                </div>
                <div class="col-8">
                    <nav class="nav ps-4">
                        <a class="nav-link link link-dark opacity-50 fs-5 mx-2" href="index.php?tela=home">INÍCIO</a>
                        <a class="nav-link link link-dark opacity-50 fs-5 mx-2" href="index.php?tela=about">SOBRE</a>
                        <a class="nav-link link link-dark opacity-50 fs-5 mx-2" href="index.php?tela=contact">CONTATO</a>
                    </nav>
                </div>
                <div class="col-2 text-end">
                <a class="" href="index.php?tela=viewCart"><i class="bi bi-cart text-black fs-2 me-1"></i></a>
                    <?php
                        include_once("../classe/MostrarIconeUsuario.php");
                        $icons = new MostrarIconeUsuario();
                        $icons->mostrarIcone($_SESSION['idUser']);
                    ?>
                </div>
            </div>
        </div>
    </header>