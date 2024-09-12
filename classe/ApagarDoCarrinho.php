<?php
class ApagarDoCarrinho extends MinhaConexao {
    public function removerProduto($idProduto) {
        if (!isset($_SESSION['idUser'])) {
            echo "<p class='alert alert-warning'>Você precisa estar logado para remover itens do carrinho.</p>";
            return;
        }

        $usuario_id = $_SESSION['idUser'];

        try {
            $sql = "DELETE FROM cart WHERE product_id = ? AND user_id = ?";
            $stmt = $this->conectar->prepare($sql);
            $stmt->bind_param("ii", $idProduto, $usuario_id);

            if ($stmt->execute()) {
            echo "<script>alert('Produto removido do carrinho!');</script>";
            } else {
                throw new Exception("Erro ao remover o produto: " . $stmt->error);
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
