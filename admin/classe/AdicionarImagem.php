<?php
include_once("MinhaConexao.php");

class AdicionarBanner extends MinhaConexao {

    public function __construct() {
        parent::__construct();
    }

    public function adicionarBanner($idImage, $situacao) {
        try {
            $sql = "INSERT INTO banners (idImage, statusBanner) VALUES (?, ?)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("ss", $idImage, $situacao);
            if ($stmt->execute()) {
                echo "<script>alert('Banner adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarBanners';</script>";
            } else {
                echo "Erro ao adicionar banner: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
