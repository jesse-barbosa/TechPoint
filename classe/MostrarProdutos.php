<?php
include_once("CriaPaginacao.php");

class MostrarProdutos extends criaPaginacao {
    private $strNumPagina, $strUrl, $strSessao, $filtroCategoria;

    public function setNumPagina($x) {
        $this->strNumPagina = $x;
    }

    public function setUrl($x) {
        $this->strUrl = $x;
    }

    public function setSessao($x) {
        $this->strSessao = $x;
    }

    public function setFiltroCategoria($categoria) {
        $this->filtroCategoria = $categoria;
    }

    public function getPagina() {
        return $this->strNumPagina;
    }

    public function mostrarProdutos() {
        try {
            // Consulta SQL que faz a junção entre as tabelas products e images
            $sql = "
                SELECT p.idProduct, p.nameProduct, p.priceProduct, i.urlImage
                FROM products p
                LEFT JOIN images i ON p.idImage = i.idImage
                WHERE p.statusProduct = 'ATIVO' AND p.deletedProduct = 0
            ";
            
            if ($this->filtroCategoria) {
                $sql .= " AND p.idCategory = " . intval($this->filtroCategoria);
            }

            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(8);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;

            $produtos = $this->results();
            if (count($produtos) > 0) {
                foreach ($produtos as $resultado) {
                    $contador++;
                    $imagemProduto = $resultado['urlImage'];
                    
                    echo "
                        <div class='col-4 col-md-4 col-lg-3 mb-3'>
                            <a href='index.php?tela=viewProduct&id=" . htmlspecialchars($resultado['idProduct']) . "' class='link link-underline link-underline-opacity-0'>
                                <div class='card shadow-none p-2 h-100'>
                                    <img src='" . htmlspecialchars($imagemProduto) . "' class='p-1 card-img-top' height='220' alt='Foto Produto'>
                                    <div class='card-body'>
                                        <h5 class='card-title fw-bold'>" . htmlspecialchars($resultado['nameProduct']) . "</h5>    
                                        <h5 class='card-title text-success fw-lighter'>R$" . htmlspecialchars(number_format($resultado['priceProduct'], 2, ',', '.')) . "</h5>    
                                    </div>
                                </div>
                            </a>
                        </div>
                    ";
                }
            } else {
                echo "<div class='alert alert-secondary'>Nenhum dado encontrado.</div>";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }    
}
?>
