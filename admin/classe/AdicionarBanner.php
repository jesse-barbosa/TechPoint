<?php
include_once("MinhaConexao.php");

class AdicionarBanner extends MinhaConexao {

    public function __construct() {
        parent::__construct();
    }

    public function adicionarBanner($idImage, $situacao) {
        // Verificar se já existe um banner com a mesma imagem
        $sqlVerificacao = "SELECT COUNT(*) FROM banners WHERE idImage = ?";
        $stmtVerificacao = $this->getConnection()->prepare($sqlVerificacao);
        $stmtVerificacao->bind_param("i", $idImage);
        $stmtVerificacao->execute();
        $stmtVerificacao->bind_result($contagem);
        $stmtVerificacao->fetch();
        $stmtVerificacao->close();

        if ($contagem > 0) {
            echo "Erro: Já existe um banner com essa imagem.";
            return;
        }

        // Inserir novo banner
        $sql = "INSERT INTO banners (idImage, statusBanner) VALUES (?, ?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param("is", $idImage, $situacao);
        if ($stmt->execute()) {
            echo "Banner adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar banner: " . $stmt->error;
        }
        $stmt->close();
    }
}

?>
