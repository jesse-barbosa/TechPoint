<?php
include_once("MinhaConexao.php");

class MostrarRelacionados extends MinhaConexao {
    private $idProduct, $idCategory;

    public function __construct(){
        parent::__construct(); // Chama o construtor da classe pai, que já conecta ao banco
    }

    public function setCategory($id){
        $this->idProduct = $id;
        try {
            $sql = "SELECT * FROM products WHERE (idProduct = ? AND deletedProduct = 0)";
            $stmt = $this->conectar->prepare($sql); // Usa diretamente $this->conectar
            $stmt->bind_param("i", $this->idProduct);
            $stmt->execute();
            $query = $stmt->get_result();

            if (!$query) {
                throw new Exception("Erro na execução da consulta: " . $this->conectar->error);
            }
            $resultado = $query->fetch_assoc();
            if ($resultado) {
                $this->idCategory = $resultado['idCategory'];
            } else {
                echo "<div class='alert alert-danger'>Produto não encontrado.</div>";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }

    public function mostrarRelacionados()
    {
        try {
            $sql = "SELECT * FROM products WHERE (idCategory = ? AND idProduct != ? AND deletedProduct = 0)";
            $stmt = $this->conectar->prepare($sql);
            $stmt->bind_param("ii", $this->idCategory, $this->idProduct);
            $stmt->execute();
            $query = $stmt->get_result();

            if ($query->num_rows > 0) {
                while ($resultado = $query->fetch_assoc()) {
                    echo "
                    <div class='product-item mx-1'>
                        <a href='index.php?tela=viewProduct&id=" . $resultado['idProduct'] . "' class='link link-underline link-underline-opacity-0'>
                            <div class='card shadow-none p-2'>
                                <img src='" . $resultado['imageProduct'] . "' class='p-5 card-img-top' height='300' alt='Foto Produto'>
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
