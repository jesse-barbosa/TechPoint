<?php
include_once('MinhaConexao.php');

class RestaurarItem extends MinhaConexao {
    public function restaurarItem($id, $tipo) {
        try {
            // Ajuste a consulta SQL conforme o tipo
            switch ($tipo) {
                case 'Produto':
                    $sql = "UPDATE products SET deletedProduct = 0 WHERE idProduct = ?";
                    break;
                case 'Categoria':
                    $sql = "UPDATE categories SET deletedCategory = 0 WHERE idCategory = ?";
                    break;
                case 'Sub Categoria':
                    $sql = "UPDATE subcategories SET deletedSubcategory = 0 WHERE idSubcategory = ?";
                    break;
                case 'Banner':
                    $sql = "UPDATE banners SET deletedBanner = 0 WHERE idBanner = ?";
                    break;
                case 'Usuário':
                    $sql = "UPDATE users SET deletedUser = 0 WHERE idUser = ?";
                    break;
                case 'Contato':
                    $sql = "UPDATE contacts SET deletedContact = 0 WHERE idContact = ?";
                    break;
                default:
                    throw new Exception("Tipo de item inválido.");
            }

            // Preparar e executar a consulta
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param('i', $id);
            $stmt->execute();

            // Verificar se a atualização foi bem-sucedida
            if ($stmt->affected_rows > 0) {
                echo "<script>window.location.href = 'index.php?tela=listarLixeira';</script>";
            } else {
                echo "Erro ao restaurar item.";
            }
            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}

// Chamar a função ao clicar no botão
if (isset($_GET['id']) && isset($_GET['tipo'])) {
    $restaurar = new RestaurarItem();
    $restaurar->restaurarItem($_GET['id'], $_GET['tipo']);
    echo "<script>window.location.href = 'index.php?tela=listarLixeira?restaurado=1';</script>";
    exit();
}
?>
