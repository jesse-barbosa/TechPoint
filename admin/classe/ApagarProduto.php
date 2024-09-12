<?php
include_once("MinhaConexao.php");

class ApagarProduto extends MinhaConexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function apagarProduto($idProduto)
    {
        try {
            // Usar prepare para evitar SQL Injection
            $sql = "UPDATE products SET deletedProduct = 1 WHERE idProduct = ?";
            $stmt = mysqli_prepare($this->conectar, $sql);
            if ($stmt === false) {
                throw new Exception("Erro ao preparar a consulta: " . mysqli_error($this->conectar));
            }

            // Vincular parâmetros e executar a consulta
            mysqli_stmt_bind_param($stmt, 'i', $idProduto);
            $result = mysqli_stmt_execute($stmt);
            if (!$result) {
                throw new Exception("Erro ao executar a consulta: " . mysqli_error($this->conectar));
            }

            mysqli_stmt_close($stmt);

            echo "<script>window.location.href = 'index.php?tela=cadListarProduto'</script>";

            exit();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            echo "<script>window.location.href = 'index.php?tela=cadListarProduto'</script>";
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
