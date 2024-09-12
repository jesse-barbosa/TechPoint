<?php
include_once("MinhaConexao.php");

class MostrarCategoriasDropdown extends Minhaconexao {
    public function mostrarCategoriasDropdown() {
        try {
            $sql = "SELECT * FROM categories WHERE (statusCategory = 'ATIVO' AND deletedCategory = 0)";
            $query = self::execSql($sql);
            
            /***** Armazenar os dados encontrados *****/
            $resultado = self::listarDados($query);
            
            /***** Verifica a quantidade de dados encontrados *****/
            $dados = self::contarDados($query);
            
            // Verifica se há dados
            if ($dados > 0) {
                // Exibe as informações de cada dado
                foreach ($resultado as $categoria) {
                    $id = $categoria['idCategory']; // Supondo que 'id' seja a coluna que armazena o ID da categoria
                    $nome = htmlspecialchars($categoria['nameCategory']);
                    echo "<li class='fw-lighter'><a href='index.php?categoria=" . urlencode($id) . "' class='dropdown-item'>" . $nome . "</a></li>";
                }
            } else {
                echo "<li class='fw-lighter'>Nenhum dado encontrado.</li>";
            }
        } catch (Exception $e) {
            echo "<li class='fw-lighter'>Erro: " . htmlspecialchars($e->getMessage()) . "</li>";
        }
    }
}
