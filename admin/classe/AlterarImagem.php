<?php
include_once("MinhaConexao.php");
include_once("UploadImagem.php");

class AlterarImagem extends MinhaConexao {
    public function alterarImagem($idImagem, $nomeImagem, $tipoImagem, $situacao, $imagem = null) {
        try {
            if ($imagem && isset($imagem['error']) && $imagem['error'] === UPLOAD_ERR_OK) {
                // Faz o upload da imagem
                $upload = new UploadImagem();
                $upload->upload($imagem, "$tipoImagem");
                $caminhoImagem = $upload->getNovoDiretorio();
                
                // Atualiza a imagem e a situação no banco de dados
                $sql = "UPDATE images SET nameImage = ?, urlImage = ?, typeImage = ?, deletedImage = ? WHERE idImage = ?";
                $stmt = $this->conectar->prepare($sql);
                $stmt->bind_param("ssssi", $nomeImagem, $caminhoImagem, $tipoImagem, $situacao, $idImagem);
            } else {
                // Atualiza apenas a situação, sem alterar a imagem
                $sql = "UPDATE images SET nameImage = ?, typeImage = ?, deletedImage = ? WHERE idImage = ?";
                $stmt = $this->conectar->prepare($sql);
                $stmt->bind_param("sssi", $nomeImagem, $tipoImagem, $situacao, $idImagem);
            }

            // Executa a consulta
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "<script>alert('Imagem alterada com sucesso!');window.location.href = 'index.php?tela=cadListarImagens'</script>";
            } else {
                echo "Nenhuma alteração realizada.";
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
