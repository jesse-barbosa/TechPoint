<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sobre Nós | Tech Point</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/styles.css">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f3f3f3;
        }
        main {
            margin: 50px 0;
        }
        .about-section {
            text-align: center;
            padding: 60px;
            color: #fff;
            border-radius: 10px;
        }
        .about-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }
        .about-section p {
            font-size: 1.25rem;
            margin-top: 20px;
        }
        .values {
            display: flex;
            justify-content: space-around;
            margin-top: 50px;
        }
        .value-box {
            background-color: #f8f9fa;
            padding: 30px;
            border-radius: 10px;
            text-align: center;
        }
        .value-box h3 {
            font-size: 1.75rem;
            margin-bottom: 15px;
        }
        footer p {
            color: #ddd;
        }
    </style>
</head>
<body>
<?php
    include_once("../include/header.php")
?>
    <main class="container">
        <div class="about-section bg-dark">
            <h1>Sobre Nós</h1>
            <p>Na Tech Point, nossa missão é fornecer as melhores soluções tecnológicas para o seu dia a dia. Somos apaixonados por inovação e comprometidos com a satisfação dos nossos clientes.</p>
        </div>

        <div class="values container mt-5">
            <div class="row">
                <div class="col-md-4">
                    <div class="value-box shadow-none">
                        <h3>Inovação</h3>
                        <p>Oferecemos as últimas tendências e inovações tecnológicas para garantir que você tenha sempre o melhor.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-box shadow-none">
                        <h3>Qualidade</h3>
                        <p>Trabalhamos com as melhores marcas para garantir que nossos produtos sejam confiáveis e duráveis.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="value-box shadow-none">
                        <h3>Atendimento</h3>
                        <p>Estamos sempre prontos para oferecer suporte e orientação para ajudá-lo a encontrar a solução ideal.</p>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <?php
        include_once("../include/footer.php");
    ?>
<!-- Link para os ícones do Bootstrap (Fontes de ícones) -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
