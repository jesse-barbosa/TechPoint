<?php
include_once("CriaPaginacao.php");

class MostrarProduto extends criaPaginacao {
    private $idProduct;

    public function setIdProduct($id) {
        $this->idProduct = $id;
    }

    public function mostrarProduto() {
        try {
            $sql = "SELECT * FROM products WHERE (idProduct = ? AND deletedProduct = 0)";
            $stmt = $this->conectar->prepare($sql);
            $stmt->bind_param("i", $this->idProduct);
            $stmt->execute();
            $query = $stmt->get_result();

            if (!$query) {
                throw new Exception("Erro na execução da consulta: " . mysqli_error($this->conectar));
            }

            $resultado = $query->fetch_assoc();
            if ($resultado) {
                echo "
                    <div class='col-6'>
                        <div class='w-50'>
                            <img src='" . $resultado['imageProduct'] . "' class='h-100 p-5 card-img-top' alt='Foto Produto'>
                        </div>
                    </div>
                    <div class='col-5'>
                        <div class='pe-5 pt-5'>
                            <h2 class='text-start fw-bold'>" . $resultado['nameProduct'] . "</h2>    
                            <p class='text-start text-secondary fw-semibold'>" . $resultado['descProduct'] . "</p>    
                            <p class='text-start text-secondary mb-5 fw-semibold'>Vendidos: " . $resultado['quantSoldProduct'] . "</p>    
                        </div>
                        <div class='mt-auto'>
                            <h2 class='text-start text-success mt-5 fw-semibold'>R$ " . $resultado['priceProduct'] . "</h2>    
                            <div class='text-start text-dark mt-1 fw-semibold'>Quantidade Disponível: " . $resultado['quantProduct'] . "</div>    
                            <div class='btn btn-dark fw-semibold form-control w-75'>Comprar</div>
                        </div>
                    </div>
                ";
            } else {
                echo "<div class='alert alert-danger'>Produto não encontrado.</div>";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
