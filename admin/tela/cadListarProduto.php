<?php
// Editar
include_once("../classe/AlterarProduto.php");
include_once("../classe/UploadImagem.php");

if (isset($_POST['editar'])) {
    $idProduto = $_POST['idProduto'];
    $nome = $_POST['nome'];
    $descricao = $_POST['descricao'];
    $quantidade = $_POST['quantidade'];
    $preco = $_POST['preco'];
    $categoria = $_POST['categoria'];
    $subcategoria = $_POST['subcategoria'];
    $situacao = $_POST['situacao'];

    $caminhoImagem = '';

    if (isset($_FILES['imagem']) && $_FILES['imagem']['error'] === UPLOAD_ERR_OK) {
        $imagem = $_FILES['imagem'];
        
        $upload = new UploadImagem();
        $upload->upload($imagem, 'products');
        $caminhoImagem = $upload->getNovoDiretorio();
    }
    $produto = new AlterarProduto();
    $produto->alterarProduto($idProduto, $nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $caminhoImagem);
    echo "<script>window.location.href = 'index.php?tela=cadListarProduto';</script>";
}
// Apagar
include_once("../classe/ApagarProduto.php");

if (isset($_GET['action']) && $_GET['action'] === 'delete' && isset($_GET['idProduto'])) {
    $idProduto = intval($_GET['idProduto']);
    $apagarProduto = new ApagarProduto();
    $apagarProduto->apagarProduto($idProduto);
}
?>

<!-- Cadastro de dados -->
<div class="section mt-2 mb-4">
    <div class="container">
        <div class="row">
            <div class="col align-content-around">
                <div class="lead fs-3">Produtos Cadastrados</div>
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
                            <div class="modal-header border-0">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Adicionar novo item</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="index.php?tela=cadListarProduto" method="post" enctype="multipart/form-data">
                                <div class="modal-body">
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <input type="text" name="nome" class="input border-0 py-1" placeholder="Nome" required>
                                    </div>
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <input type="file" name="imagem" class="input border-0 py-1" required>
                                    </div>
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <input type="text" name="descricao" class="input border-0 py-1" placeholder="Descrição" required>
                                    </div>
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <input type="number" name="quantidade" class="input border-0 py-1" placeholder="Quantidade em Estoque" required>
                                    </div>
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <input type="number" name="preco" class="input border-0 py-1" placeholder="Preço" step="0.01" required>
                                    </div>
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <select name="categoria" class="form-select border-0" required>
                                            <option value='1'>Processadores</option>
                                            <option value='2'>Placas Mãe</option>
                                            <option value='3'>Memórias RAM</option>
                                            <option value='4'>Armazenamento</option>
                                            <option value='5'>Placas de Vídeo</option>
                                        </select>
                                    </div>
                                    <div class="text-start border px-1 py-1 mb-1">
                                        <select name="subcategoria" class="form-select border-0" required>
                                            <option value='1'>Intel</option>
                                            <option value='2'>AMD</option>
                                            <option value='3'>ATX</option>
                                            <option value='4'>Micro-ATX</option>
                                            <option value='5'>DDR4</option>
                                            <option value='6'>DDR5</option>
                                            <option value='7'>HD</option>
                                            <option value='8'>SSD</option>
                                            <option value='9'>NVIDIA</option>
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

<!-- Mostrar dados -->
<div class="section">
    <div class="container-fluid">
        <div class="row">
            <div class="col">
                <?php
                    include_once("../classe/MostrarProdutos.php");
                    $produtos = new MostrarProdutos();
                    $produtos->setNumPagina(@$_GET['pg']);
                    $produtos->setUrl("?tela=cadListarProduto");
                    $produtos->setSessao('');
                    $produtos->mostrarProdutos();
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
                <ul class="nav d-flex">
                    <li><?php $produtos->geraNumeros();?></li>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- Modal de Edição -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="index.php?tela=cadListarProduto" method="post" enctype="multipart/form-data" id="editProductForm">
                <div class="modal-body">
                    <input type="hidden" name="idProduto" id="editIdProduto">
                    <div class="mb-3">
                        <label for="editNomeProduto" class="form-label">Nome</label>
                        <input type="text" class="form-control" id="editNomeProduto" name="nome" required>
                    </div>
                    <div class="mb-3">
                        <label for="editDescricaoProduto" class="form-label">Descrição</label>
                        <input type="text" class="form-control" id="editDescricaoProduto" name="descricao" required>
                    </div>
                    <div class="mb-3">
                        <label for="editQuantidadeProduto" class="form-label">Quantidade</label>
                        <input type="number" class="form-control" id="editQuantidadeProduto" name="quantidade" required>
                    </div>
                    <div class="mb-3">
                        <label for="editPrecoProduto" class="form-label">Preço</label>
                        <input type="number" class="form-control" id="editPrecoProduto" name="preco" step="0.01" required>
                    </div>
                    <div class="mb-3">
                        <label for="editCategoriaProduto" class="form-label">Categoria</label>
                        <select class="form-select" id="editCategoriaProduto" name="categoria" required>
                            <option value='1'>Processadores</option>
                            <option value='2'>Placas Mãe</option>
                            <option value='3'>Memórias RAM</option>
                            <option value='4'>Armazenamento</option>
                            <option value='5'>Placas de Vídeo</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editSubcategoriaProduto" class="form-label">Subcategoria</label>
                        <select class="form-select" id="editSubcategoriaProduto" name="subcategoria" required>
                            <option value='1'>Intel</option>
                            <option value='2'>AMD</option>
                            <option value='3'>ATX</option>
                            <option value='4'>Micro-ATX</option>
                            <option value='5'>DDR4</option>
                            <option value='6'>DDR5</option>
                            <option value='7'>HD</option>
                            <option value='8'>SSD</option>
                            <option value='9'>NVIDIA</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editSituacaoProduto" class="form-label">Situação</label>
                        <select class="form-select" id="editSituacaoProduto" name="situacao" required>
                            <option value='ATIVO'>ATIVO</option>
                            <option value='DESATIVO'>DESATIVO</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="editImagemProduto" class="form-label">Imagem</label>
                        <input type="file" class="form-control" id="editImagemProduto" name="imagem">
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
                Tem certeza de que deseja excluir este produto?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-dark" data-bs-dismiss="modal">Cancelar</button>
                <button type="button" class="btn btn-dark" id="confirmDelete">Excluir</button>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', (event) => {
    // Preenchimento do modal de edição
    document.querySelectorAll('.bi-pencil').forEach(button => {
        button.addEventListener('click', function () {

            document.getElementById('editIdProduto').value = this.dataset.id;
            document.getElementById('editNomeProduto').value = this.dataset.nome;
            document.getElementById('editDescricaoProduto').value = this.dataset.descricao;
            document.getElementById('editQuantidadeProduto').value = this.dataset.quantidade;
            document.getElementById('editPrecoProduto').value = this.dataset.preco;
            document.getElementById('editCategoriaProduto').value = this.dataset.categoria;
            document.getElementById('editSubcategoriaProduto').value = this.dataset.subcategoria;
            document.getElementById('editSituacaoProduto').value = this.dataset.situacao;

            const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
            modal.show();
        });
    });

    // Confirmação de exclusão
    let deleteId = '';
    document.querySelectorAll('.bi-trash').forEach(button => {
        button.addEventListener('click', function () {
            deleteId = this.dataset.id;
            const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
            modal.show();
        });
    });

    document.getElementById('confirmDelete').addEventListener('click', function () {
        if (deleteId) {
            window.location.href = 'index.php?tela=cadListarProduto&action=delete&idProduto=' + deleteId;
        }
    });
});
</script>
