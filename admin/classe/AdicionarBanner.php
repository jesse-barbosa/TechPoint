<?php
include_once("MinhaConexao.php");

class AdicionarBanner extends MinhaConexao {

    public function __construct() {
        parent::__construct();
    }

    public function adicionarBanner($nomeImagem, $situacao) {
        $sql = "INSERT INTO banners (urlBanner, statusBanner) VALUES (?, ?)";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param("ss", $nomeImagem, $situacao);
        if ($stmt->execute()) {
            echo "Banner adicionado com sucesso!";
        } else {
            echo "Erro ao adicionar banner: " . $stmt->error;
        }
    }
}
?>
