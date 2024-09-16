<?php
// Adicionar
include_once("../classe/AdicionarImagem.php");

if (isset($_POST['enviar'])) {
    $situacao = $_POST['situacao'];
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';

    if (isset($_FILES['url']) && $_FILES['url']['error'] === UPLOAD_ERR_OK) {
        $imagem = $_FILES['url'];
        $adicionarImagem = new AdicionarImagem();
        $adicionarImagem->adicionarImagem($name, $imagem, $type, $situacao);
    } else {
        echo "Imagem não foi enviada ou ocorreu um erro no upload.";
    }
}
// Editar
include_once("../classe/AlterarImagem.php");

if (isset($_POST['editar'])) {
    $idImage = $_POST['idImage'];
    $situacao = $_POST['situacao'];
    $name = isset($_POST['name']) ? $_POST['name'] : '';
    $type = isset($_POST['type']) ? $_POST['type'] : '';
    $imagem = isset($_FILES['url']) ? $_FILES['url'] : null;

    $alterarImagem = new AlterarImagem();
    $alterarImagem->alterarImagem($idImage, $name, $type, $situacao, $imagem);
    echo "<script>window.location.href = 'index.php?tela=cadListarImagens';</script>";
}

// Apagar
include_once("../classe/ApagarImagem.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idImage'])) {
    $idImage = intval($_GET['idImage']);
    $apagarImagem = new ApagarImagem();
    $apagarImagem->apagarImagem($idImage);
    echo "<script>window.location.href = 'index.php?tela=cadListarImagens';</script>";
}

?>
<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3">Imagens Cadastradas</div>
            </div>
            <div class="col-3 text-end">
                <!-- Botão para adicionar imagem -->
                <button type="button" class="btn btn-dark fw-medium" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Adicionar
                </button>
            </div>
        </div>
    </div>
</div>
<!-- Mostrar dados -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col table-responsive">
                <?php
                    include_once("../classe/MostrarImagens.php");

                    $banner = new MostrarImagens();
                    $banner->setNumPagina(@$_GET['pg']);
                    $banner->setUrl("?tela=cadListarImagens");
                    $banner->setSessao('');
                    $banner->mostrarImagens();
                ?>
            </div>
        </div>
    </div>
</div>
<!-- Paginação -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col d-flex flex-column align-items-center">
                <ul class="nav nav1 d-flex">
                    <li><?php $banner->geraNumeros(); ?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Cadastro -->
<div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar novo item</h1>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarImagens" method="post" enctype="multipart/form-data">
            <div class="modal-body">
                <div class="text-start px-1 py-1 mb-1">
                    <label for="addName" class="form-label">Nome</label>
                    <input type="text" class="form-control" id="addNameImage" name="name" required>
                </div>
                <div class="text-start px-1 py-1 mb-1">
                    <label for="addTypeImage" class="form-label">Tipo</label>
                    <select class="form-select" id="addTypeImage" name="type" required>
                        <option value='banners'>Banner</option>
                        <option value='products'>Produto</option>
                        <option value='icons'>Ícone</option>
                    </select>
                </div>
                <div class="text-start px-1 py-1 mb-1">
                <label for="addUrlImage" class="form-label">Imagem</label>
                <input type="file" class="form-control" id="addUrlImage" name="url">
            </div>
                <div class="text-start px-1 py-1 mb-1">
                    <label for="addStatusImage" class="form-label">Situação</label>
                    <select name="situacao" class="form-select" required>
                        <option value='ATIVO'>ATIVO</option>
                        <option value='DESATIVO'>DESATIVO</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer -0">
                <button type="submit" name="enviar" class="btn btn-dark form-control fw-medium">Adicionar</button>
            </div>
        </form>
        </div>
    </div>
</div>
<!-- Modal de Edição -->
<div class="modal fade" id="editImageModal" tabindex="-1" aria-labelledby="editImageModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editImageModalLabel">Editar Imagem</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarImagens" method="post" enctype="multipart/form-data" id="editImageForm">
                <div class="modal-body">
                    <input type="hidden" name="idImage" id="editIdImage">
                    
                    <div class="mb-3">
                        <label for="editNameImage" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNameImage" name="name" required>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editTypeImage" class="form-label">Tipo</label>
                        <select class="form-select" id="editTypeImage" name="type" required>
                            <option value='banners'>Banner</option>
                            <option value='products'>Produto</option>
                            <option value='icons'>Ícone</option>
                        </select>
                    </div>
                    
                    <div class="mb-3">
                        <label for="editUrlImage" class="form-label">Imagem Atual</label>
                        <img id="editImagemPreview" src="" alt="Preview" class="img-fluid mb-3" style="display:none;">
                        <input type="file" class="form-control" id="editUrlImage" name="url">
                    </div>
                    
                    <div class="mb-3">
                        <label for="editStatusImage" class="form-label">Situação</label>
                        <select class="form-select" id="editStatusImage" name="situacao" required>
                            <option value='ATIVO'>ATIVO</option>
                            <option value='DESATIVO'>DESATIVO</option>
                        </select>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editar" class="btn btn-dark form-control">Salvar alterações</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir esta imagem?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="" id="confirmDelete" class="btn btn-dark">Excluir</a>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    // Configuração do modal de edição
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            const id = this.dataset.id;
            const name = this.dataset.name;
            const type = this.dataset.type;
            const status = this.dataset.status;
            const url = this.dataset.url;

            console.log({ id, name, type, status, url });
            
            // Preencher os campos do modal
            document.getElementById('editIdImage').value = id;
            document.getElementById('editNameImage').value = name;
            document.getElementById('editTypeImage').value = type;
            document.getElementById('editStatusImage').value = status;

            // Atualizar o preview da imagem
            const preview = document.getElementById('editImagemPreview');
            if (url) {
                preview.src = url;
                preview.style.display = 'block';
            } else {
                preview.src = '';
                preview.style.display = 'none';
            }

            const modal = new bootstrap.Modal(document.getElementById('editImageModal'));
            modal.show();
        });
    });

    // Atualizar o preview da imagem no modal de edição quando o arquivo for selecionado
    document.getElementById('editUrlImage').addEventListener('change', function () {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function (e) {
                document.getElementById('editImagemPreview').src = e.target.result;
                document.getElementById('editImagemPreview').style.display = 'block';
            };
            reader.readAsDataURL(file);
        }
    });

    // Configuração do modal de exclusão
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            const deleteId = this.dataset.id;
            const confirmDeleteButton = document.getElementById('confirmDelete');
            confirmDeleteButton.href = 'index.php?tela=cadListarImagens&action=delete&idImage=' + deleteId;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });
});


</script>