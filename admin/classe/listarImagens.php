<?php
include_once("MinhaConexao.php");

class ListarImagens extends MinhaConexao {

    public function __construct() {
        parent::__construct();
    }

    public function listarImagens($typeImage) {
        $sql = "SELECT idImage, nameImage FROM images WHERE typeImage = ? AND deletedImage = 0";
        $stmt = $this->getConnection()->prepare($sql);
        $stmt->bind_param("s", $typeImage);
        $stmt->execute();
        $resultado = $stmt->get_result();
        return $resultado->fetch_all(MYSQLI_ASSOC);
    }
}
?>
