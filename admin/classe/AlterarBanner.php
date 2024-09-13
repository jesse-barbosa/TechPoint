<?php
include_once("MinhaConexao.php");

class AlterarBanner extends MinhaConexao {

    public function __construct() {
        parent::__construct();
    }

    public function alterarBanner($idBanner, $situacao, $nomeImagem) {
        $sql = "UPDATE banners SET urlBanner = ?, statusBanner = ? WHERE idBanner = ?";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param("ssi", $nomeImagem, $situacao, $idBanner);
        if ($stmt->execute()) {
            echo "Banner atualizado com sucesso!";
        } else {
            echo "Erro ao atualizar banner: " . $stmt->error;
        }
    }
}
?>
