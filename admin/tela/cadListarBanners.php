<?php
// Adicionar
include_once("../classe/AdicionarBanner.php");
include_once("../classe/ListarImagens.php");

if (isset($_POST['enviar'])) {
    $situacao = $_POST['situacao'];
    $idImage = $_POST['idImage'];
    
    $banner = new AdicionarBanner();
    $banner->adicionarBanner($idImage, $situacao);
}

// Editar
include_once("../classe/AlterarBanner.php");

if (isset($_POST['editar'])) {
    $idBanner = $_POST['idBanner'];
    $situacao = $_POST['situacao'];
    $idImage = $_POST['idImage'];
    
    $banner = new AlterarBanner();
    $banner->alterarBanner($idBanner, $situacao, $idImage);
    echo "<script>window.location.href = 'index.php?tela=cadListarBanners';</script>";
}

// Apagar
include_once("../classe/ApagarBanner.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idBanner'])) {
    $idBanner = intval($_GET['idBanner']);
    $apagarBanner = new ApagarBanner();
    $apagarBanner->apagarBanner($idBanner);
}
?>
<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3">Banners Cadastrados</div>
            </div>
            <div class="col-3 text-end">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-dark fw-medium" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                    Adicionar
                </button>

                <!-- Modal -->
                <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false"
                    tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar novo item</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="index.php?tela=cadListarBanners" method="post">
                                <div class="modal-body">
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <select name="nomeImagem" class="form-select border-0" required>
                                            <?php
                                                include_once("../classe/ListarImagens.php");
                                                $listarImagens = new ListarImagens();
                                                $imagens = $listarImagens->listarImagens('banners');
                                                foreach ($imagens as $imagem) {
                                                    echo "<option value=\"{$imagem['idImage']}\">{$imagem['nameImage']}</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <select name="situacao" class="form-select border-0" required>
                                            <option value='ATIVO'>ATIVO</option>
                                            <option value='DESATIVO'>DESATIVO</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="modal-footer border-0">
                                    <button type="submit" name="enviar" class="btn btn-dark form-control fw-medium">Adicionar</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal de Edição -->
<div class="modal fade" id="editBannerModal" tabindex="-1" aria-labelledby="editBannerModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editBannerModalLabel">Editar Banner</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarBanners" method="post">
                <div class="modal-body">
                    <input type="hidden" name="idBanner" id="editIdBanner">
                    <div class="mb-3">
                        <label for="editNomeImagem" class="form-label">Imagem</label>
                        <select class="form-select" id="editNomeImagem" name="nomeImagem" required>
                            <?php
                                include_once("../classe/ListarImagens.php");
                                $listarImagens = new ListarImagens();
                                $imagens = $listarImagens->listarImagens('banners');
                                foreach ($imagens as $imagem) {
                                    echo "<option value=\"{$imagem['nameImage']}\">{$imagem['nameImage']}</option>";
                                }
                            ?>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editSituacaoBanner" class="form-label">Situação</label>
                        <select class="form-select" id="editSituacaoBanner" name="situacao" required>
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


<script>
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {
            document.getElementById('editIdBanner').value = this.dataset.id;
            document.getElementById('editSituacaoBanner').value = this.dataset.situacao;
            document.getElementById('editImagemBanner').value = this.dataset.idImage;

            const modal = new bootstrap.Modal(document.getElementById('editBannerModal'));
            modal.show();
        });
    });
});
</script>

<!-- Modal de Confirmação de Exclusão -->
<div class="modal fade" id="deleteConfirmationModal" tabindex="-1" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirmar Exclusão</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Tem certeza de que deseja excluir este Banner?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                <a href="" id="confirmDelete" class="btn btn-dark">Excluir</a>
            </div>
        </div>
    </div>
</div>

<!-- Script para confirmar e processar exclusão -->
<script>
document.addEventListener('DOMContentLoaded', (event) => {
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            const deleteId = this.dataset.id;
            const confirmDeleteButton = document.getElementById('confirmDelete');
            confirmDeleteButton.href = 'index.php?tela=cadListarBanners&action=delete&idBanner=' + deleteId;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });
});
</script>

<!-- Mostrar dados -->
<div class="section">
    <div class="container">
        <div class="row">
            <div class="col table-responsive">
                <?php
                    include_once("../classe/MostrarBanners.php");
                    $banner = new MostrarBanners();
                    $banner->setNumPagina(@$_GET['pg']);
                    $banner->setUrl("?tela=cadListarBanners");
                    $banner->setSessao('');
                    $banner->mostrarBanners();
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
                    <li><?php $banner->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
