<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechPoint | Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body>
    <div class="container-fluid h-100">
        <div class="row full-height justify-content-center align-items-center">
            <div class="col-md-6 col-12 full-height img-cover d-none d-md-block"></div>
            <div class="col-6 justify-content-center">
                <div class="card border-0">
                    <div class="card-body">
                        <h2 class="display-5 mb-5 text-black text-start ms-5">Faça Login</h2>
                        <form action="index.php" class="px-5" method="post">
                            <input type="hidden" name="idForm" value="formLogin">
                            <div class="form-floating mb-3">
                                <input type="text" name="nome" placeholder="Nome" class="form-control">
                                <label for="nome">Nome</label>
                            </div>
                            <div class="form-floating mb-3">
                                <input type="password" name="senha" placeholder="Senha" class="form-control">
                                <label for="senha">Senha</label>
                            </div>
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <button type="submit" name="enviar" class="btn btn-dark form-control py-2 fw-bold">Entrar</button>
                            </div>
                            <?php
                                if(empty($_POST["nome"]) || empty($_POST["senha"])){
                                  echo "";
                                }else if(isset($_POST["enviar"])){
                                  echo "<div class='alert alert-danger my-3'>";
                                  include_once("classe/VerificarLogin.php");
                                  $dados = new VerificarLogin();
                                  $dados->retornarNome($_POST["nome"]);
                                  $dados->retornarSenha($_POST["senha"]);
                                  $dados->verificarLogin();
                                  echo "</div>";
                                }
                            ?>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>

</html>