<?php
include_once("MinhaConexao.php");

class AlterarBanner extends MinhaConexao {
    private $conn;

    public function __construct() {
        parent::__construct();
        $this->conn = $this->getConnection();
    }

    public function obterBanner($idBanner) {
        try {
            $sql = "SELECT * FROM banners WHERE idBanner = ?";
            $stmt = $this->conn->prepare($sql);
            $stmt->bind_param("i", $idBanner);
            $stmt->execute();
            $resultado = $stmt->get_result();
            return $resultado->fetch_assoc();
        } catch (Exception $e) {
            echo "Erro ao obter Banner: " . $e->getMessage();
        }
    }

    public function alterarBanner($idBanner, $situacao, $caminhoImagem = null) {
        try {
            if ($caminhoImagem) {
                $sql = "UPDATE banners SET statusBanner = ?, urlBanner = ? WHERE idBanner = ?";
            } else {
                $sql = "UPDATE banners SET statusBanner = ? WHERE idBanner = ?";
            }            

            $stmt = $this->conn->prepare($sql);

            if ($caminhoImagem) {
                $stmt->bind_param("ssi", $situacao, $caminhoImagem, $idBanner);
            } else {
                $stmt->bind_param("si", $situacao, $idBanner);
            }

            if ($stmt->execute()) {
                // Sucesso ao alterar categoria
            } else {
                echo "Erro ao atualizar Banner: " . $stmt->error;
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
