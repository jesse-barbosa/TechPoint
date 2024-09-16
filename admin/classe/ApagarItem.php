<?php
include_once('MinhaConexao.php');

class ApagarItem extends MinhaConexao {
    public function apagarItem($id, $tipo) {
        try {
            // Ajuste a consulta SQL conforme o tipo
            switch ($tipo) {
                case 'Produto':
                    $sql = "DELETE FROM products WHERE idProduct = ?";
                    break;
                case 'Categoria':
                    $sql = "DELETE FROM categories WHERE idCategory = ?";
                    break;
                case 'Sub Categoria':
                    $sql = "DELETE FROM subcategories WHERE idSubcategory = ?";
                    break;
                case 'Banner':
                    $sql = "DELETE FROM banners WHERE idBanner = ?";
                    break;
                case 'Usuário':
                    $sql = "DELETE FROM users WHERE idUser = ?";
                    break;
                case 'Contato':
                    $sql = "DELETE FROM contacts WHERE idContact = ?";
                    break;
                case 'Imagem':
                    $sql = "DELETE FROM images WHERE idImage = ?";
                    break;
                default:
                    throw new Exception("Tipo de item inválido.");
            }

            // Preparar e executar a consulta
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();

            // Verificar se a exclusão foi bem-sucedida
            if ($stmt->affected_rows > 0) {
                echo "<script>window.location.href = 'index.php?tela=listarLixeira';</script>";
            } else {
                echo "Erro ao excluir item.";
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}

// Chamar a função ao clicar no botão
if (isset($_GET['id']) && isset($_GET['tipo'])) {
    $apagar = new ApagarItem();
    $apagar->apagarItem($_GET['id'], $_GET['tipo']);
    echo "<script>window.location.href = 'index.php?tela=listarLixeira?apagado=1';</script>";

    exit();
}
?>
