<?php
include_once("MinhaConexao.php");
include_once("UploadImagem.php");
class Banner extends MinhaConexao
{
    private $imagem, $situacao;

    public function __construct($imagem, $situacao)
    {
        parent::__construct();

        $this->imagem = $imagem;
        $this->situacao = $situacao;
    }

    public function adicionarBanner()
    {
        try {
            // Faz o upload da imagem
            $upload = new UploadImagem();
            $upload->upload($this->imagem, "banners");
            $caminhoImagem = $upload->getNovoDiretorio();

            // Insere os dados no banco de dados usando o método execSql
            $sql = "INSERT INTO banners (urlBanner, statusBanner)
                    VALUES ('$caminhoImagem', '$this->situacao')";
            
            if ($this->execSql($sql)) {
                echo "<script>alert('Banner adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarBanners'</script>";

                exit();
            } else {
                echo "Erro ao executar a sql: " . $sql;
            }

        } catch (Exception $e) {
            echo "Erro ao adicionar Banner: " . $e->getMessage();
        }
    }
}
