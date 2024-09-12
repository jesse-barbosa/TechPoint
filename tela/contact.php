    <style>
        .contact-form {
            background-color: #fff;
            padding: 30px;
            border-radius: 10px;
        }
        .contact-info a {
            color: #fff;
            text-decoration: none;
        }
    </style>
<?php
    include_once("../include/header.php")
?>
    <main class="container contact-section py-5">
        <div class="row">
            <!-- Formulário de Contato -->
            <div class="col-md-6">
                <h2 class="mb-4">Fale Conosco</h2>
                <div class="contact-form">
                    <form action="contact.php" method="post">
                        <div class="mb-3">
                            <label for="nome" class="form-label">Nome Completo</label>
                            <input type="text" class="form-control" id="nome" name="nome" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">E-mail</label>
                            <input type="email" class="form-control" id="email" name="email" required>
                        </div>
                        <div class="mb-3">
                            <label for="mensagem" class="form-label">Mensagem</label>
                            <textarea class="form-control" id="mensagem" name="mensagem" rows="5" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-dark form-control py-2 fw-medium">Enviar Mensagem</button>
                    </form>
                </div>
            </div>

            <!-- Informações de Contato -->
            <div class="col-md-6">
                <h2 class="mb-4">Nossas Informações</h2>
                <div class="card p-5 border-4 bg-dark text-white">
                    <h5 class="fw-bold">Endereço</h5>
                    <p>Rua dos Exemplos, 123, São Paulo, SP</p>
                    
                    <h5 class="fw-bold">Telefone</h5>
                    <p><i class="bi bi-telephone-fill"></i> (11) 1234-5678</p>
                    
                    <h5 class="fw-bold">E-mail</h5>
                    <p><i class="bi bi-envelope-fill"></i> contato@techpoint.com.br</p>

                    <h5 class="fw-bold">Redes Sociais</h5>
                    <a href="#" class="d-block text-white mb-1 link link-underline link-underline-opacity-0 text-dark opacity-75"><i class="bi bi-facebook"></i> Facebook</a>
                    <a href="#" class="d-block text-white mb-1 link link-underline link-underline-opacity-0 text-dark opacity-75"><i class="bi bi-instagram"></i> Instagram</a>
                    <a href="#" class="d-block text-white mb-1 link link-underline link-underline-opacity-0 text-dark opacity-75"><i class="bi bi-twitter"></i> Twitter</a>
                    <a href="#" class="d-block text-white mb-1 link link-underline link-underline-opacity-0 text-dark opacity-75"><i class="bi bi-linkedin"></i> LinkedIn</a>
                </div>
            </div>
        </div>
    </main>