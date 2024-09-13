<?php
include_once("MinhaConexao.php");

class ListarImagens extends MinhaConexao {
    public function listarImagens() {
        try {
            $sql = "SELECT idImage, nameImage, urlImage FROM images WHERE deletedImage = 0";
            $stmt = $this->conectar->prepare($sql);
            $stmt->execute();
            $result = $stmt->get_result();
            
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['idImage'] . "'>";
                    echo htmlspecialchars($row['nameImage']) . " (" . htmlspecialchars($row['urlImage']) . ")";
                    echo "</option>";
                }
            } else {
                echo "<option value=''>Nenhuma imagem encontrada</option>";
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>