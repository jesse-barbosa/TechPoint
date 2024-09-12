<?php
include_once("MinhaConexao.php");

class AdicionarImagem extends MinhaConexao {
    public function adicionarImagem($imagem, $situacao) {
        try {
            // Verifique se há imagem e situação
            if ($imagem['error'] === UPLOAD_ERR_OK) {
                $nomeImagem = $imagem['name'];
                $caminhoTemp = $imagem['tmp_name'];
                $caminhoDestino = "uploads/" . basename($nomeImagem);

                // Move o arquivo para o diretório de destino
                if (move_uploaded_file($caminhoTemp, $caminhoDestino)) {
                    // Insere a nova imagem no banco de dados
                    $sql = "INSERT INTO images (nameImage, urlImage, statusImage) VALUES (?, ?, ?)";
                    $stmt = $this->conectar->prepare($sql);
                    $stmt->bind_param("sss", $nomeImagem, $caminhoDestino, $situacao);
                    $stmt->execute();
                    
                    if ($stmt->affected_rows > 0) {
                        echo "Imagem adicionada com sucesso!";
                    } else {
                        echo "Falha ao adicionar a imagem.";
                    }
                    $stmt->close();
                } else {
                    echo "Erro ao mover a imagem.";
                }
            } else {
                echo "Erro no upload da imagem.";
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
