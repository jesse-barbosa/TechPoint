<?php
include_once("MinhaConexao.php");

class AlterarProduto extends MinhaConexao {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function obterProduto($idProduto) {
        try {
            $sql = "SELECT * FROM products WHERE idProduct = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idProduto);
            $stmt->execute();
            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            echo "Erro ao obter produto: " . $e->getMessage();
        }
    }

    public function alterarProduto($idProduto, $nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $caminhoImagem = null) {
        try {
            if ($caminhoImagem) {
                $sql = "UPDATE products SET nameProduct = ?, descProduct = ?, quantProduct = ?, priceProduct = ?, idCategory = ?, idSubCategory = ?, statusProduct = ?, imageProduct = ? WHERE idProduct = ?";
            } else {
                $sql = "UPDATE products SET nameProduct = ?, descProduct = ?, quantProduct = ?, priceProduct = ?, idCategory = ?, idSubCategory = ?, statusProduct = ? WHERE idProduct = ?";
            }

            $stmt = $this->conn->prepare($sql);

            if ($caminhoImagem) {
                $stmt->bind_param("ssidsissi", $nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $caminhoImagem, $idProduto);
            } else {
                $stmt->bind_param("ssidsisi", $nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $idProduto);
            }

            if ($stmt->execute()) {
                // Sucesso ao alterar categoria
            } else {
                echo "Erro ao atualizar produto: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
