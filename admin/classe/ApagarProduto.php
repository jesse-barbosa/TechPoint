<?php
include_once("MinhaConexao.php");

class ApagarProduto extends MinhaConexao {
    public function __construct()
    {
        parent::__construct();
    }

public function apagarProduto($idProduto) {
    try {
        // Validação do ID
        if (!is_numeric($idProduto)) {
            throw new Exception("ID de produto inválido.");
        }

        // Consulta preparada
        $sql = "UPDATE products SET deletedProduct = 1 WHERE idProduct = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param('i', $idProduto);
        $stmt->execute();

        if ($stmt->affected_rows === 0) {
            throw new Exception("Produto não encontrado.");
        }

        header("Location: index.php?tela=cadListarProduto");
        echo "<script>alert('Produto apagado com sucesso!');window.location.href = 'index.php?tela=cadListarProduto'</script>";
        exit();
    } catch (Exception $e) {
        error_log("Erro ao apagar produto: " . $e->getMessage());
        header("Location: index.php?tela=cadListarProduto&error=" . $e->getMessage());
        exit();
    }
}
}

// Verifica se um ID de produto foi passado e processa a exclusão
if (isset($_GET['idProduto'])) {
    $idProduto = intval($_GET['idProduto']);
    $apagarProduto = new ApagarProduto();
    $apagarProduto->apagarProduto($idProduto);
}
?>
