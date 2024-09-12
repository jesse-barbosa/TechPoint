<header class="bg-white">
        <div class="container-fluid">
            <div class="row">
                <div class="col-2">
                    <a href="index.php?tela=home" class="link fs-3 fw-semibold text-black link-underline link-underline-opacity-0">TechPoint</a>
                </div>
                <div class="col-8">
                    <nav class="nav">
                    <div class="nav-item dropdown">
                            <a class="nav-link link text-secondary bg-blue dropdown-toggle fs-5 fw-semibold" href="#" id="produtosDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                                Produtos
                            </a>
                            <ul class="dropdown-menu p-2" aria-labelledby="produtosDropdown">
                                <li><a class="dropdown-item" href="index.php">Geral</a></li>
                                <?php
                                    include_once("../classe/MostrarCategorias.php");
                                    $categorias = new MostrarCategoriasDropdown();
                                    $categorias->mostrarCategoriasDropdown();
                                ?>
                            </ul>
                        </div>
                        <a class="nav-link link text-secondary fs-5 fw-semibold" href="about.php">Sobre</a>
                        <a class="nav-link link text-secondary fs-5 fw-semibold" href="contact.php">Contato</a>
                    </nav>
                </div>
                <div class="col-2">
                    <?php
                        include_once("../classe/MostrarIconeUsuario.php");
                        $icons = new MostrarIconeUsuario();
                        $icons->mostrarIcone(4);
                    ?>
                </div>
            </div>
        </div>
    </header>