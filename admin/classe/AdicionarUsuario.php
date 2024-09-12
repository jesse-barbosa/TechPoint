<?php
include_once("MinhaConexao.php");
include_once("UploadImagem.php");
class Usuario extends MinhaConexao {

    public function __construct(){
        parent::__construct();
    }

    public function adicionarUsuario($nome, $email, $senha, $icone, $typeUser, $situacao)
    {
        try {
            // Faz o upload da imagem
            $upload = new UploadImagem();
            $upload->upload($icone, "icons");
            $caminhoImagem = $upload->getNovoDiretorio();

            // Insere os dados no banco de dados usando o método execSql
            $sql = "INSERT INTO users (nameUser, emailUser, passwordUser, iconUser, typeUser, statusUser)
             VALUES ($nome', $email', $senha', $caminhoImagem', $typeUser', $situacao')";
            
            if ($this->execSql($sql)) {
                echo "<script>alert('Usuário adicionado com sucesso!');window.location.href = 'index.php?tela=cadListarUsuario'</script>";

                exit();
            } else {
                echo "Erro ao executar a sql: " . $sql;
            }

        } catch (Exception $e) {
            echo "Erro ao adicionar Banner: " . $e->getMessage();
        }
    }
}
