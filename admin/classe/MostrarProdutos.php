<?php
include_once("CriaPaginacao.php");

class MostrarProdutos extends CriaPaginacao {
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

    public function totalProdutos() {
        try {
            $sql = "SELECT COUNT(*) as total FROM products WHERE deletedProduct = 0";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os produtos: " . $e->getMessage();
        }
    }

    public function mostrarProdutos() {
        try {
            $sql = "SELECT * FROM products WHERE deletedProduct = 0";

            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(3);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            $this->iniciaPaginacao();
            $contador = 0;

            $produtos = $this->results();

            if (count($produtos) > 0) {
                echo "
                <table class='table table-light table-hover'>
                    <thead>
                        <tr class='text-center table-dark'>
                            <th>ID</th>
                            <th>Foto</th>
                            <th>Produto</th>
                            <th>Descrição</th>
                            <th>Quantidade</th>
                            <th>Valor</th>
                            <th>ID Categoria</th>
                            <th>ID Sub Categoria</th>
                            <th>Situação</th>
                            <th width='30'></th>
                            <th width='30'></th>
                        </tr>
                    </thead>
                    <tbody>
                ";
                foreach ($produtos as $resultado) {
                    echo "<tr class='text-center'>";
                        echo "<td class='fw-lighter'>".$resultado['idProduct']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['imageProduct']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['nameProduct']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['descProduct']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['quantProduct']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['priceProduct']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['idCategory']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['idSubCategory']."</td>";
                        echo "<td class='fw-lighter'>".$resultado['statusProduct']."</td>";
                        echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editProductModal' data-id='".$resultado['idProduct']."' data-nome='".$resultado['nameProduct']."' data-descricao='".$resultado['descProduct']."' data-quantidade='".$resultado['quantProduct']."' data-preco='".$resultado['priceProduct']."' data-categoria='".$resultado['idCategory']."' data-subcategoria='".$resultado['idSubCategory']."' data-situacao='".$resultado['statusProduct']."'></a></td>";
                        echo "<td><a href='#' class='bi bi-trash btn btn-dark' data-id='".$resultado['idProduct']."'></a></td>";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                </table>
                ";
            } else {
                echo "Nenhum dado encontrado.";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
