<?php
/***********************************************************************************************************************
 * Classe que irá permitir ou negar o acesso ao painel de administrador.
 * Desenvolvedor: Diego Jardim da Silva
 * Data: 12 de agosto de 2024
 */
include_once("MinhaConexao.php");
class VerificarLogin extends Minhaconexao
{
    /***** Declarar variáveis necessárias para tratar os dados de acesso *****/
    protected $nome, $senha, $usuarioLogado, $erro;
    /***** Métodos que receberá o nome de usuário e retornará para validar o acesso  *****/
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
    /***** Método que receberá a senha de usuário e retornará para validar o acesso *****/
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
    /***** Métodos que receberá o nome de usuário e retornará para validar o acesso  *****/
    public function getErro(){
        return $this->erro; 
    }
    /***** Método que realizará acesso ao sistema, caso os dados de acesso estejam corretos *****/
    public function verificarLogin()
    {
     try {
        $sql = "SELECT * FROM users WHERE nameUser = '$this->nome' AND passwordUser = '$this->senha' AND statusUser = 'ativo' AND (typeUser = 'admin' OR typeUser = 'admin-master')";
        $query = self::execSql($sql);
        /***** Armazenar os dados encontrados *****/
        $resultado = self::listarDados($query);
        /***** Verifica a quantidade de dados encontrados *****/
        $dados = self::contarDados($query);
        
        /**** Verifica se o usuário está duplicado *****/
        if($dados > 1){
            echo $this->erro = "Dados duplicados no sistema, entre em contato com o administrador do sistema!";
        /**** Verifica se o foi encontrado o usuário, ou seja, se dados foram digitados corretamente *****/
        }else if($dados <= 0){
            /***** Exibe mensagem onde onde os dados são inválidos *****/
            echo $this->erro = "Email ou senha inválidos! <br>Entre em contato com o administrador do sistema!";
            /**** Verifica se foi encontrado registro no banco *****/
        }else if($dados == 1){
            /**** Se encontrar resultado no banco, irá iniciar a sessão *****/
            session_start();
            /**** Armazenando os dados do usuário (na super global $_SESSION) em uma sessão para que possam ser acessados em outras páginas do site  *****/
            $_SESSION['nome'] = $this->nome;
            $_SESSION['senha'] = $this->senha;
            $_SESSION['typeUser'] = $resultado[0]['typeUser'];
            
            header('Location: /TechPoint/admin/tela/index.php');
        }
     } catch (Exception $e) {
        echo "Erro: ".$e->getMessage();
     }   
    }
}