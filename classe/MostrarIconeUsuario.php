<?php
include_once("MinhaConexao.php");

class MostrarIconeUsuario extends MinhaConexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function mostrarIcone($idUser){
        try {
            $sql = "SELECT iconUser FROM users WHERE idUser = '$idUser'";
            $query = $this->execSql($sql);

            if ($query) {
                $result = $query->fetch_assoc(); // Corrigido: buscar o resultado como array associativo
                echo "<img src='".$result['iconUser']."' height='50' />";
            } else {
                return '';
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return 'Erro: Não foi possível carregar o ícone do usuário.';
        }
    }
}