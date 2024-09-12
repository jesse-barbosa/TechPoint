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
            $sql = "SELECT * FROM products WHERE (statusProduct = 'ATIVO' AND deletedProduct = 0)";
            if ($this->filtroCategoria) {
                $sql .= " WHERE idCategory = " . intval($this->filtroCategoria);
            }
        
            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(3);  // Exibir 3 produtos por página
            $this->setMaximoLinks(9); // Mostrar até 9 links de paginação
            $this->setSQL($sql);
        
            self::iniciaPaginacao();
        
            $offset = ($this->strNumPagina - 1) * 3; // Calcula o deslocamento
            $sql .= " LIMIT $offset, 9"; // Limita a consulta à página atual
        
            $query = $this->execSql($sql);
            if (!$query) {
                throw new Exception("Erro na execução da consulta: " . mysqli_error($this->conectar));
            }
            $dados = mysqli_num_rows($query);
            if ($dados > 0) {
                while ($resultado = mysqli_fetch_assoc($query)) {
                    echo "
                        <div class='col-4 col-md-4 col-lg-3 mb-3'>
                            <a href='index.php?tela=viewProduct&id=" . $resultado['idProduct'] . "' class='link link-underline link-underline-opacity-0'>
                                <div class='card shadow-none p-2 h-100'>
                                    <img src='" . $resultado['imageProduct'] . "' class='p-1 card-img-top' height='220' alt='Foto Produto'>
                                    <div class='card-body'>
                                        <h5 class='card-title fw-bold'>" . $resultado['nameProduct'] . "</h5>    
                                        <h5 class='card-title text-success fw-bold'>R$" . $resultado['priceProduct'] . "</h5>    
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
