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
                <button type="button" class="btn btn-dark fw-medium" data-bs-toggle="modal" data-bs-target="#addProductModal">
                    Adicionar
                </button>
                <!-- Modal de Adicionar Produto -->
                <div class="modal fade" id="addProductModal" tabindex="-1" aria-labelledby="addProductModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="addProductModalLabel">Adicionar Novo Produto</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form method="POST" action="" enctype="multipart/form-data">
                                <div class="modal-body">

                                    <!-- Nome do Produto -->
                                    <div class="mb-3 text-start">
                                        <label for="nomeProduto" class="form-label">Nome do Produto:</label>
                                        <input type="text" name="nomeProduto" id="nomeProduto" class="form-control" required>
                                    </div>
                                    <!-- Seleção da Imagem -->
                                    <div class="mb-3 text-start">
                                        <label for="idImage" class="form-label">Selecione a Imagem:</label>
                                        <select name="idImage" id="idImage" class="form-select" required>
                                            <option value="" disabled selected>Escolha uma imagem</option>
                                            <?php
                                                include_once("../classe/ListarImagens.php");
                                                $listarImagens = new ListarImagens();
                                                $imagens = $listarImagens->listarImagens();
                                                foreach ($imagens as $imagem) {
                                                    echo "<option value='" . htmlspecialchars($imagem['idImage']) . "'>" . htmlspecialchars($imagem['nameImage']) . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- Descrição do Produto -->
                                    <div class="mb-3 text-start">
                                        <label for="descricaoProduto" class="form-label">Descrição do Produto:</label>
                                        <textarea name="descricaoProduto" id="descricaoProduto" class="form-control" rows="3" required></textarea>
                                    </div>

                                    <!-- Quantidade do Produto -->
                                    <div class="mb-3 text-start">
                                        <label for="quantidadeProduto" class="form-label">Quantidade do Produto:</label>
                                        <input type="number" name="quantidadeProduto" id="quantidadeProduto" class="form-control" required>
                                    </div>

                                    <!-- Preço do Produto -->
                                    <div class="mb-3 text-start">
                                        <label for="precoProduto" class="form-label">Preço do Produto:</label>
                                        <input type="number" name="precoProduto" id="precoProduto" class="form-control" step="0.01" required>
                                    </div>

                                    <!-- Categoria do Produto -->
                                    <div class="mb-3 text-start">
                                        <label for="categoriaProduto" class="form-label">Categoria do Produto:</label>
                                        <select name="categoriaProduto" id="categoriaProduto" class="form-select text-dark" required>
                                            <option value="" disabled selected>Escolha uma categoria</option>
                                            <?php
                                                // Inclua a lista de categorias aqui
                                                include_once("../classe/ListarCategorias.php");
                                                $listarCategorias = new ListarCategorias();
                                                $categorias = $listarCategorias->listarCategorias();
                                                foreach ($categorias as $categoria) {
                                                    echo "<option value='" . htmlspecialchars($categoria['idCategory']) . "' class='text-dark'>" . htmlspecialchars($categoria['nameCategory']) . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Subcategoria do Produto -->
                                    <div class="mb-3 text-start">
                                        <label for="subcategoriaProduto" class="form-label">Subcategoria do Produto:</label>
                                        <select name="subcategoriaProduto" id="subcategoriaProduto" class="form-select text-dark" required>
                                            <option value="" disabled selected>Escolha uma subcategoria</option>
                                            <?php
                                                // Inclua a lista de subcategorias aqui
                                                include_once("../classe/ListarSubcategorias.php");
                                                $listarSubcategorias = new ListarSubcategorias();
                                                $subcategorias = $listarSubcategorias->listarSubcategorias();
                                                foreach ($subcategorias as $subcategoria) {
                                                    echo "<option value='" . htmlspecialchars($subcategoria['idSubCategory']) . "'>" . htmlspecialchars($subcategoria['nameSubCategory']) . "</option>";
                                                }
                                            ?>
                                        </select>
                                    </div>

                                    <!-- Situação do Produto -->
                                    <div class="mb-3 text-start">
                                        <label for="situacaoProduto" class="form-label">Situação do Produto:</label>
                                        <select name="situacaoProduto" id="situacaoProduto" class="form-select" required>
                                            <option value="" disabled selected>Escolha a situação</option>
                                            <option value="ativo">Ativo</option>
                                            <option value="inativo">Inativo</option>
                                        </select>
                                    </div>

                                    <!-- Preview da Imagem -->
                                    <div class="mb-3 text-start">
                                        <img id="imagemPreview" src="" class="img-fluid" alt="Preview da Imagem Selecionada">
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" name="enviar" class="btn btn-dark">Adicionar Produto</button>
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
<!-- Modal de Edição de Produto -->
<div class="modal fade" id="editProductModal" tabindex="-1" aria-labelledby="editProductModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editProductModalLabel">Editar Produto</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="">
                <div class="modal-body">
                    <input type="hidden" id="editIdProduto" name="idProduto">

                    <!-- Seleção da Imagem -->
                    <div class="mb-3 text-start">
                        <label for="editIdImage" class="form-label">Selecione a Imagem:</label>
                        <select name="idImage" id="editIdImage" class="form-select" required>
                            <option value="" disabled selected>Escolha uma imagem</option>
                            <?php
                                include_once("../classe/ListarImagens.php");
                                $listarImagens = new ListarImagens();
                                $imagens = $listarImagens->listarImagens();
                                foreach ($imagens as $imagem) {
                                    echo "<option value='" . htmlspecialchars($imagem['idImage']) . "' data-url='" . htmlspecialchars($imagem['urlImage']) . "'>" . htmlspecialchars($imagem['nameImage']) . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <!-- Nome do Produto -->
                    <div class="mb-3 text-start">
                        <label for="editNomeProduto" class="form-label">Nome do Produto:</label>
                        <input type="text" name="nomeProduto" id="editNomeProduto" class="form-control" required>
                    </div>

                    <!-- Descrição do Produto -->
                    <div class="mb-3 text-start">
                        <label for="editDescricaoProduto" class="form-label">Descrição do Produto:</label>
                        <textarea name="descricaoProduto" id="editDescricaoProduto" class="form-control" rows="3" required></textarea>
                    </div>

                    <!-- Quantidade do Produto -->
                    <div class="mb-3 text-start">
                        <label for="editQuantidadeProduto" class="form-label">Quantidade do Produto:</label>
                        <input type="number" name="quantidadeProduto" id="editQuantidadeProduto" class="form-control" required>
                    </div>

                    <!-- Preço do Produto -->
                    <div class="mb-3 text-start">
                        <label for="editPrecoProduto" class="form-label">Preço do Produto:</label>
                        <input type="number" name="precoProduto" id="editPrecoProduto" class="form-control" step="0.01" required>
                    </div>

                    <!-- Categoria do Produto -->
                    <div class="mb-3 text-start">
                        <label for="editCategoriaProduto" class="form-label">Categoria do Produto:</label>
                        <select name="categoriaProduto" id="editCategoriaProduto" class="form-select" required>
                            <option value="" disabled selected>Escolha uma categoria</option>
                            <?php
                                include_once("../classe/ListarCategorias.php");
                                $listarCategorias = new ListarCategorias();
                                $categorias = $listarCategorias->listarCategorias();
                                foreach ($categorias as $categoria) {
                                    echo "<option value='" . htmlspecialchars($categoria['idCategoria']) . "'>" . htmlspecialchars($categoria['nomeCategoria']) . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <!-- Subcategoria do Produto -->
                    <div class="mb-3 text-start">
                        <label for="editSubcategoriaProduto" class="form-label">Subcategoria do Produto:</label>
                        <select name="subcategoriaProduto" id="editSubcategoriaProduto" class="form-select" required>
                            <option value="" disabled selected>Escolha uma subcategoria</option>
                            <?php
                                include_once("../classe/ListarSubcategorias.php");
                                $listarSubcategorias = new ListarSubcategorias();
                                $subcategorias = $listarSubcategorias->listarSubcategorias();
                                foreach ($subcategorias as $subcategoria) {
                                    echo "<option value='" . htmlspecialchars($subcategoria['idSubcategoria']) . "'>" . htmlspecialchars($subcategoria['nomeSubcategoria']) . "</option>";
                                }
                            ?>
                        </select>
                    </div>

                    <!-- Situação do Produto -->
                    <div class="mb-3 text-start">
                        <label for="editSituacaoProduto" class="form-label">Situação do Produto:</label>
                        <select name="situacaoProduto" id="editSituacaoProduto" class="form-select" required>
                            <option value="" disabled selected>Escolha a situação</option>
                            <option value="ativo">Ativo</option>
                            <option value="inativo">Inativo</option>
                        </select>
                    </div>

                    <!-- Preview da Imagem Selecionada -->
                    <div class="mb-3 text-start">
                        <img id="editImagemPreview" src="" class="img-fluid" alt="Preview da Imagem Selecionada">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" name="editar" class="btn btn-dark">Salvar Alterações</button>
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
                <a href="" id="confirmDeleteProduct" class="btn btn-dark">Excluir</a>
            </div>
        </div>
    </div>
</div>
<script>
    document.addEventListener('DOMContentLoaded', () => {
        // Configuração do Modal de Edição
        document.querySelectorAll('.bi-pencil').forEach(button => {
            button.addEventListener('click', function () {
                const idProduto = this.dataset.id;
                const nomeProduto = this.dataset.nome;
                const precoProduto = this.dataset.preco;
                const descricaoProduto = this.dataset.descricao;
                const quantidadeProduto = this.dataset.quantidade;
                const idImage = this.dataset.idimage;
                const urlImagem = this.dataset.url;
                const categoriaProduto = this.dataset.categoria;
                const subcategoriaProduto = this.dataset.subcategoria;
                const situacaoProduto = this.dataset.situacao;

                // Preencher os campos do modal com os valores
                document.getElementById('editIdProduto').value = idProduto;
                document.getElementById('editNomeProduto').value = nomeProduto;
                document.getElementById('editPrecoProduto').value = precoProduto;
                document.getElementById('editDescricaoProduto').value = descricaoProduto;
                document.getElementById('editQuantidadeProduto').value = quantidadeProduto;

                // Atualizar o select de imagem
                const selectImagem = document.getElementById('editIdImage');
                const options = selectImagem.querySelectorAll('option');
                let found = false;
                options.forEach(option => {
                    if (option.value === idImage) {
                        option.selected = true;
                        document.getElementById('editImagemPreview').src = urlImagem; // Mostrar a imagem selecionada
                        found = true;
                    }
                });

                if (!found) {
                    document.getElementById('editImagemPreview').src = ''; // Limpar o preview se a imagem não for encontrada
                }

                // Atualizar os selects de categoria e subcategoria
                document.getElementById('editCategoriaProduto').value = categoriaProduto;
                document.getElementById('editSubcategoriaProduto').value = subcategoriaProduto;
                document.getElementById('editSituacaoProduto').value = situacaoProduto;

                // Abrir o modal de edição
                const modal = new bootstrap.Modal(document.getElementById('editProductModal'));
                modal.show();
            });
        });

        // Alterar preview da imagem ao trocar a seleção no modal de edição
        document.getElementById('editIdImage').addEventListener('change', function () {
            const selectedOption = this.options[this.selectedIndex];
            const url = selectedOption.dataset.url;
            document.getElementById('editImagemPreview').src = url;
        });

        // Configuração do Modal de Exclusão
        document.querySelectorAll('.bi-trash').forEach(button => {
            button.addEventListener('click', function () {
                const deleteId = this.dataset.id;
                const confirmDeleteButton = document.getElementById('confirmDeleteProduct');
                confirmDeleteButton.href = 'index.php?tela=cadListarProdutos&action=delete&idProduto=' + deleteId;
                const modal = new bootstrap.Modal(document.getElementById('deleteConfirmationModal'));
                modal.show();
            });
        });
    });
</script>
