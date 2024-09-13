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
                $result = $query->fetch_assoc();
                echo "<img src='".$result['iconUser']."' height='40' />";
            } else {
                return '';
            }
        } catch (Exception $e) {
            error_log($e->getMessage());
            return 'Erro: Não foi possível carregar o ícone do usuário.';
        }
    }
}