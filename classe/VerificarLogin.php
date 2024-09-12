<?php
include_once("MinhaConexao.php");
class VerificarLogin extends Minhaconexao
{
    protected $nome, $senha, $usuarioLogado, $erro;
    private function setNome($u){
        $this->nome = $u;
    }
    private function getNome(){
        return $this->nome;
    }
    public function retornarNome($u){
        $this->setNome($u);
        return $this->getNome();
    }
    private function setSenha($s){
        $this->senha = $s;
    }
    private function getSenha(){
        return $this->senha;
    }
    public function retornarSenha($s){
        $this->setSenha($s);
        return $this->getSenha();
    }
    public function getErro(){
        return $this->erro; 
    }
    public function verificarLogin()
    {
     try {
        $sql = "SELECT * FROM users WHERE nameUser = '$this->nome' AND passwordUser = '$this->senha' AND statusUser = 'ativo'";
        $query = self::execSql($sql);
        $resultado = self::listarDados($query);
        $dados = self::contarDados($query);
        
        if($dados > 1){
            echo $this->erro = "Dados duplicados no sistema, entre em contato com o administrador do sistema!";
        }else if($dados <= 0){
            echo $this->erro = "Email ou senha inválidos! <br>Entre em contato com o administrador do sistema!";
        }else if($dados == 1){
            session_start();
            $_SESSION['nome'] = $this->nome;
            $_SESSION['idUser'] = $resultado[0]['idUser'];
            $_SESSION['senha'] = $this->senha;
            $_SESSION['typeUser'] = $resultado[0]['typeUser'];
            
            header('Location: /TechPoint/tela/index.php?tela=home');
        }
     } catch (Exception $e) {
        echo "Erro: ".$e->getMessage();
     }   
    }
}