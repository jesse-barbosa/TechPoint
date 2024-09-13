<?php
include_once("MinhaConexao.php");
include_once("UploadImagem.php");

class AdicionarProduto extends MinhaConexao {

    public function __construct() {
        parent::__construct();
    }

    public function adicionarProduto($nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $imagem) {
        try {
            // Faz o upload da imagem
            $upload = new UploadImagem();
            $upload->upload($imagem, "products");
            $idImage = $upload->getNovoDiretorio(); // Obtendo o caminho da imagem após o upload
            
            // Inserir novo produto
            $sql = "INSERT INTO products (nameProduct, idImage, descProduct, quantProduct, priceProduct, idCategory, idSubCategory, statusProduct)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $this->getConnection()->prepare($sql);
            $stmt->bind_param("ssisiiis", $nome, $idImage, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao);
            
            if ($stmt->execute()) {
                echo "<script>alert('Produto adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarProduto'</script>";
                exit();
            } else {
                echo "Erro ao adicionar produto: " . $stmt->error;
            }
            $stmt->close();
            
        } catch (Exception $e) {
            echo "Erro ao adicionar produto: " . $e->getMessage();
        }
    }
}
?>
