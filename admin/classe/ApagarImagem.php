<?php
include_once("MinhaConexao.php");

class ApagarImagem extends MinhaConexao {
    public function apagarImagem($idImagem) {
        try {
            // Marca a imagem como deletada
            $sql = "UPDATE images SET deletedImage = 1 WHERE idImage = ?";
            $stmt = $this->conectar->prepare($sql);
            $stmt->bind_param("i", $idImagem);
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
            echo "<script>alert('Imagem apagada com sucesso!');window.location.href = 'index.php?tela=cadListarImagens'</script>";
            } else {
                echo "Erro ao apagar a imagem.";
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
