<?php
include_once('CriaPaginacao.php');

class MostrarLixeira extends CriaPaginacao {

    private $strNumPagina, $strUrl, $strSessao;

    public function setNumPagina($x) {
        $this->strNumPagina = $x;
    }

    public function setUrl($x) {
        $this->strUrl = $x;
    }

    public function setSessao($x) {
        $this->strSessao = $x;
    }

    public function getPagina() {
        return $this->strNumPagina;
    }

    public function __construct() {
        parent::__construct();
    }

    public function mostrarLixeira() {
        try {
            // Consultas para itens excluídos
            $sqlProdutos = "SELECT idProduct AS id, nameProduct AS name, descProduct AS description, 'Produto' AS tipo FROM products WHERE deletedProduct = 1";
            $sqlCategorias = "SELECT idCategory AS id, nameCategory AS name, descCategory AS description, 'Categoria' AS tipo FROM categories WHERE deletedCategory = 1";
            $sqlSubcategorias = "SELECT idSubcategory AS id, nameSubCategory AS name, descSubcategory AS description, 'Sub Categoria' AS tipo FROM subcategories WHERE deletedSubcategory = 1";
            $sqlBanners = "SELECT b.idBanner AS id, i.urlImage AS name, '' AS description, 'Banner' AS tipo
               FROM banners b
               JOIN images i ON b.idImage = i.idImage
               WHERE b.deletedBanner = 1";
            $sqlUsuarios = "SELECT idUser AS id, nameUser AS name, emailUser AS description, 'Usuário' AS tipo FROM users WHERE deletedUser = 1";
            $sqlContatos = "SELECT idContact AS id, nameContact AS name, subjectContact AS description, 'Contato' AS tipo FROM contacts WHERE deletedContact = 1";
            $sqlImagens = "SELECT idImage AS id, urlImage AS name, '' AS description, 'Imagem' AS tipo FROM images WHERE deletedImage = 1";

            $sql = "($sqlProdutos) UNION ALL ($sqlCategorias) UNION ALL ($sqlSubcategorias) UNION ALL ($sqlBanners) UNION ALL ($sqlUsuarios) UNION ALL ($sqlContatos) UNION ALL ($sqlImagens)";

            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(6);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;

            $result = $this->results();

            // Exibir tabela
            if (count($result) > 0) {
                echo "
                <table class='table table-light table-hover'>
                    <thead>
                        <tr class='text-center table-dark'>
                            <th>ID</th>
                            <th>Nome</th>
                            <th>Descrição</th>
                            <th>Tipo</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($result as $item) {
                    $contador++;
                    echo "<tr class='text-center'>";
                    echo "<td class='fw-lighter'>{$item['id']}</td>";
                
                    if ($item['tipo'] == 'Banner' || $item['tipo'] == 'Imagem') {
                        echo "<td class='fw-lighter'><img src='{$item['name']}' alt='{$item['tipo']}' style='width: 100px;'></td>";
                    } else {
                        echo "<td class='fw-lighter'>{$item['name']}</td>";
                    }
                
                    echo "<td class='fw-lighter'>{$item['description']}</td>";
                    echo "<td class='fw-lighter'>{$item['tipo']}</td>";
                    echo "<td><button class='btn btn-outline-dark mx-1' data-id='{$item['id']}' data-tipo='{$item['tipo']}' data-action='restore' data-bs-toggle='modal' data-bs-target='#restoreConfirmationModal'><i class='bi bi-arrow-counterclockwise'></i></button></td>";
                    echo "<td><button class='btn btn-dark mx-1' data-id='{$item['id']}' data-tipo='{$item['tipo']}' data-action='delete' data-bs-toggle='modal' data-bs-target='#deleteConfirmationModal'><i class='bi bi-trash'></i></button></td>";
                    echo "</tr>";
                }                
                
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "Nenhum item excluído encontrado.";
            }

        } catch (Exception $e) {
            echo "Erro ao mostrar itens excluídos: " . $e->getMessage();
        }
    }
}
?>
