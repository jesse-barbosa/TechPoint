<?php
include_once("MinhaConexao.php");
class MostrarCategoriasFilter extends Minhaconexao {
    public function mostrarCategoriasFilter() {
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
                    echo "<option value='" . $categoria['idCategory'] . "'>" . htmlspecialchars($categoria['nameCategory'], ENT_QUOTES, 'UTF-8') . "</option>";
                }
            } else {
                echo "<option value=''>Nenhuma categoria encontrada</option>";
            }
        } catch (Exception $e) {
            echo "<option value=''>Erro: " . htmlspecialchars($e->getMessage(), ENT_QUOTES, 'UTF-8') . "</option>";
        }
    }
}
?>
