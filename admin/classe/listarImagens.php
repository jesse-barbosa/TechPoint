<?php

include_once("MinhaConexao.php");

class ListarImagens extends MinhaConexao {
    public function listarImagens(): array
    {
        try {
            $sql = "SELECT idImage, nameImage, urlImage FROM images WHERE deletedImage = 0";
            $resultado = self::execSql($sql);

            if (mysqli_num_rows($resultado) > 0) {
                $imagens = [];
                while ($row = mysqli_fetch_assoc($resultado)) {
                    $imagens[] = $row;
                }
                return $imagens;
            } else {
                return [];
            }
        } catch (Exception $e) {
            echo "Erro ao listar imagens: " . $e->getMessage();
            return [];
        }
    }
}
?>