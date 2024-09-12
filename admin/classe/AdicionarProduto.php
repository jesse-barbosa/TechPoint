<?php
include_once("MinhaConexao.php");
include_once("UploadImagem.php");
class Produto extends MinhaConexao
{
    private $nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $imagem;

    public function __construct($nome, $descricao, $quantidade, $preco, $categoria, $subcategoria, $situacao, $imagem)
    {
        parent::__construct();

        $this->nome = $nome;
        $this->imagem = $imagem;
        $this->descricao = $descricao;
        $this->quantidade = $quantidade;
        $this->preco = $preco;
        $this->categoria = $categoria;
        $this->subcategoria = $subcategoria;
        $this->situacao = $situacao;
    }

    public function adicionarProduto()
    {
        try {
            // Faz o upload da imagem
            $upload = new UploadImagem();
            $upload->upload($this->imagem, "products");
            $caminhoImagem = $upload->getNovoDiretorio();

            // Insere os dados no banco de dados usando o método execSql
            $sql = "INSERT INTO products (nameProduct, imageProduct, descProduct, quantProduct, priceProduct, idCategory, idSubCategory, statusProduct)
                    VALUES ('$this->nome', '$caminhoImagem', '$this->descricao', '$this->quantidade', '$this->preco', 
                            '$this->categoria', '$this->subcategoria', '$this->situacao')";
            
            if ($this->execSql($sql)) {
                echo "<script>alert('Produto adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarProduto'</script>";

                exit();
            } else {
                echo "Erro ao executar a sql: " . $sql;
            }

        } catch (Exception $e) {
            echo "Erro ao adicionar produto: " . $e->getMessage();
        }
    }
}
