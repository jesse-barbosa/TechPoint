<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Painel Administrativo</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/login.css" rel="stylesheet" type="text/css">
</head>
<body class="bg-dark">
    <div class="container-fluid">
        <div class="row full-heigth justify-content-center">
            <div class="col-6">
                <div class="row full-height justify-content-center">
                    <div class="col-12 col-xxl-10 align-self-center">
                        <h2 class="display-5 mb-5 text-light text-center">Painel Administrativo</h2>
                        <form action="index.php" method="post">
                            <input type="hidden" name="idForm" value="formLogin">
                            <input type="text" name="nome" placeholder="Nome"
                                class="input border-0 border-bottom p-2"><br />
                            <input type="password" name="senha" placeholder="Senha"
                                class="input border-0 border-bottom p-2"><br />
                            <div class="mt-4 d-flex justify-content-between align-items-center">
                                <button type="submit" name="enviar" class="btn btn-light form-control">Entrar</button>
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