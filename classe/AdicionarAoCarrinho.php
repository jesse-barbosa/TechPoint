<?php
include_once("MinhaConexao.php");

class AdicionarAoCarrinho extends MinhaConexao {
    public function __construct() {
        parent::__construct();
    }

    public function adicionarProduto($idProduto, $quantidade) {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['idUser'])) {
            header('Location: ../index.php');
            exit();
        }

        $usuario_id = $_SESSION['idUser'];

        try {
            $sql = "SELECT * FROM cart WHERE user_id = ? AND product_id = ?";
            $stmt = $this->conectar->prepare($sql);
            $stmt->bind_param("ii", $usuario_id, $idProduto);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                // Atualiza a quantidade se o produto já estiver no carrinho
                $row = $result->fetch_assoc();
                $newQuantity = $row['quantProducts'] + $quantidade;
                $sql = "UPDATE cart SET quantProducts = ? WHERE idCart = ?";
                $stmt = $this->conectar->prepare($sql);
                $stmt->bind_param("ii", $newQuantity, $row['idCart']);
            } else {
                $sql = "INSERT INTO cart (user_id, product_id, quantProducts) VALUES (?, ?, ?)";
                $stmt = $this->conectar->prepare($sql);
                $stmt->bind_param("iii", $usuario_id, $idProduto, $quantidade);
            }
            
            if (!$stmt->execute()) {
                throw new Exception("Erro na execução da consulta: " . $this->conectar->error);
            }
            echo "<script>alert('Produto adicionado ao carrinho!');window.location.href = 'index.php?tela=home'</script>";
            exit();

        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
