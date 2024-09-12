<?php
include_once("MinhaConexao.php");

class AlterarImagem extends MinhaConexao {
    public function alterarImagem($idImagem, $situacao, $imagem = null) {
        try {
            // Verifica se foi fornecida uma nova imagem
            if ($imagem && isset($imagem['error']) && $imagem['error'] === UPLOAD_ERR_OK) {
                $nomeImagem = $imagem['name'];
                $caminhoTemp = $imagem['tmp_name'];
                $caminhoDestino = "uploads/" . basename($nomeImagem);

                // Move o arquivo para o diretório de destino
                if (move_uploaded_file($caminhoTemp, $caminhoDestino)) {
                    // Atualiza a imagem e a situação no banco de dados
                    $sql = "UPDATE images SET nameImage = ?, urlImage = ?, statusImage = ? WHERE idImage = ?";
                    $stmt = $this->conectar->prepare($sql);
                    $stmt->bind_param("sssi", $nomeImagem, $caminhoDestino, $situacao, $idImagem);
                } else {
                    echo "Erro ao mover a imagem.";
                    return;
                }
            } else {
                // Atualiza apenas a situação, sem alterar a imagem
                $sql = "UPDATE images SET statusImage = ? WHERE idImage = ?";
                $stmt = $this->conectar->prepare($sql);
                $stmt->bind_param("si", $situacao, $idImagem);
            }

            // Executa a consulta
            $stmt->execute();

            if ($stmt->affected_rows > 0) {
                echo "Imagem atualizada com sucesso!";
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
