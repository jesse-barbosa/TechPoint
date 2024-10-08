<?php
include_once("CriaPaginacao.php");

class MostrarProduto extends criaPaginacao {
    private $idProduct;

    public function setIdProduct($id) {
        $this->idProduct = $id;
    }

    public function mostrarProduto() {
        try {
            // SQL com JOIN para obter informações do produto e da imagem
            $sql = "
                SELECT p.*, i.urlImage
                FROM products p
                JOIN images i ON p.idImage = i.idImage
                WHERE p.idProduct = ? AND p.deletedProduct = 0
            ";
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
                            <img src='" . $resultado['urlImage'] . "' class='h-100 p-5 card-img-top' alt='Foto Produto'>
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

                            <!-- Formulário de adicionar ao carrinho -->
                            <form action='index.php?tela=viewProduct' method='post'>
                                <input type='hidden' name='idProduto' value='" . $this->idProduct . "'>
                                <input type='hidden' name='quantidade' value='1'>
                                <button type='submit' class='btn btn-dark fw-semibold w-75'>Adicionar ao Carrinho</button>
                            </form>
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
