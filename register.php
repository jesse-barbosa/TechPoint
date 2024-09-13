<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST["enviar"])) {
    if (!empty($_POST["nome"]) && !empty($_POST["email"]) && !empty($_POST["senha"])) {
        include_once("classe/FazerRegistro.php");
        $login = new FazerRegistro();
        $resultado = $login->registrar($_POST["nome"], $_POST["email"], $_POST["senha"]);
        
        if ($resultado) {
            header('Location: tela/index.php?tela=home');
            exit;
        } else {
            $error_message = "Erro ao realizar registro, tente novamente!";
        }
    } else {
        $error_message = "Todos os campos são obrigatórios.";
    }
}
?>
<!doctype html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>TechPoint | Registro</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link href="css/login.css" rel="stylesheet" type="text/css">
    <style>
    body {
      background-image: url('img/loginBackground.avif');
      background-size: cover;
      background-repeat: no-repeat;
      background-position: center;
    }

    .form {
      background: rgba(255, 255, 255, 0.1);
      border-radius: 10px;
      backdrop-filter: blur(10px);
      padding: 20px;
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
    }
    </style>
</head>
<body>
    <div class="container vh-100">
        <div class="row vh-100 justify-content-start align-items-center">
            <div class="col-5 justify-content-center">
                <div class="form py-5">
                    <h2 class="display-5 mb-5 text-black text-center ms-5 font-monospace">Crie uma conta</h2>
                    <form action="register.php" class="px-5" method="post">
                        <input type="hidden" name="idForm" value="formLogin">
                        <div class="form-floating mb-3">
                            <input type="text" name="nome" placeholder="Nome" class="form-control">
                            <label for="nome">Nome</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="text" name="email" placeholder="Email" class="form-control">
                            <label for="email">Email</label>
                        </div>
                        <div class="form-floating mb-3">
                            <input type="password" name="senha" placeholder="Senha" class="form-control">
                            <label for="senha">Senha</label>
                        </div>
                        <div class="mt-4 d-flex justify-content-between align-items-center">
                            <button type="submit" name="enviar" class="btn btn-dark form-control py-3 fw-bold">Entrar</button>
                        </div>
                        <p class="text-center mt-1 text-secondary">Já tem uma conta? <a href="index.php" class="link text-decoration-none link-dark fw-medium">Faça login</a></p>
                        <?php
                        if (isset($error_message)) {
                            echo "<div class='alert alert-danger my-3'>$error_message</div>";
                        }
                        ?>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous">
    </script>
</body>
</html>
