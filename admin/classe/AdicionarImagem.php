<?php
include_once("MinhaConexao.php");
include_once("UploadImagem.php");

class AdicionarImagem extends MinhaConexao {
    public function adicionarImagem($imagem, $nomeImagem, $tipoImagem, $situacao) {
        try {
            $upload = new UploadImagem();
            $upload->upload($imagem, $tipoImagem);
            $caminhoImagem = $upload->getNovoDiretorio();

            $sql = "INSERT INTO images (nameImage, urlImage, typeImage, statusImage) VALUES (?, ?, ?, ?)";
            $stmt = $this->conectar->prepare($sql);
            $stmt->bind_param("ssss", $nomeImagem, $caminhoImagem, $tipoImagem, $situacao);
            $stmt->execute();
            
            if ($stmt->affected_rows > 0) {
                echo "Imagem adicionada com sucesso!";
            } else {
                echo "Falha ao adicionar a imagem.";
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
