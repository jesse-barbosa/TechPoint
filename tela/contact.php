<?php
include_once("../classe/MinhaConexao.php");
include_once("../classe/EnviarContato.php");

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Verifique se os dados foram enviados
    if (isset($_POST['nameContact'], $_POST['emailContact'], $_POST['cityContact'], $_POST['stateContact'], $_POST['subjectContact'], $_POST['messageContact'])) {
        
        // Capture os dados do formulário
        $nameContact = $_POST['nameContact'];
        $emailContact = $_POST['emailContact'];
        $cityContact = $_POST['cityContact'];
        $stateContact = $_POST['stateContact'];
        $subjectContact = $_POST['subjectContact'];
        $messageContact = $_POST['messageContact'];
        
        // Instancie a classe AdicionarContato
        $contato = new EnviarContato();
        
        // Salve os dados no banco de dados
        if ($contato->salvarContato($nameContact, $emailContact, $cityContact, $stateContact, $subjectContact, $messageContact)) {
            echo "
            <META HTTP-EQUIV=REFRESH CONTENT='0; URL=../tela/?tela=contact'>
            <script type=\"text/javascript\">
                alert(\"Mensagem enviada com sucesso!\");
            </script>";
        } else {
            echo "Erro ao enviar a mensagem. Tente novamente.";
        }
    }
}
?>
<?php
    include_once("../include/header.php");
?>
<main class="container contact-section py-5">
    <div class="row">
        <!-- Formulário de Contato -->
        <div class="col-md-6">
            <h2 class="mb-4">Fale Conosco</h2>
                <form action="index.php?tela=contact" class="border rounded-3 p-3" method="post">
                    <div class="mb-3">
                        <label for="nameContact" class="form-label">Nome Completo</label>
                        <input type="text" class="form-control" id="nameContact" name="nameContact" required>
                    </div>
                    <div class="mb-3">
                        <label for="emailContact" class="form-label">E-mail</label>
                        <input type="email" class="form-control" id="emailContact" name="emailContact" required>
                    </div>
                    <div class="mb-3">
                        <label for="cityContact" class="form-label">Cidade</label>
                        <input type="text" class="form-control" id="cityContact" name="cityContact" required>
                    </div>
                    <div class="mb-3">
                        <label for="stateContact" class="form-label">Estado</label>
                        <input type="text" class="form-control" id="stateContact" name="stateContact" required>
                    </div>
                    <div class="mb-3">
                        <label for="subjectContact" class="form-label">Assunto</label>
                        <input type="text" class="form-control" id="subjectContact" name="subjectContact" required>
                    </div>
                    <div class="mb-3">
                        <label for="messageContact" class="form-label">Mensagem</label>
                        <textarea class="form-control" id="messageContact" name="messageContact" rows="5" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-dark form-control py-2 fw-medium">Enviar Mensagem</button>
                </form>
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
