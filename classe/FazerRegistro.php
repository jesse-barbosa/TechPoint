<?php
include_once("MinhaConexao.php");

class FazerRegistro extends Minhaconexao {
    public function __construct() {
        parent::__construct();
    }

    public function registrar($nome, $email, $senha){
        try {
            $sql = "INSERT INTO users (nameUser, emailUser, passwordUser) VALUES ('$nome', '$email', '$senha')";
            $query = self::execSql($sql);

            if ($query) {
                $sql = "SELECT * FROM users WHERE emailUser = '$email'";
                $query = self::execSql($sql);
                $resultado = self::listarDados($query);

                session_start();
                $_SESSION['nome'] = $nome;
                $_SESSION['idUser'] = $resultado[0]['idUser'];
                $_SESSION['senha'] = $senha;
                $_SESSION['typeUser'] = $resultado[0]['typeUser'];

                return true; // Registro bem-sucedido
            } else {
                return false; // Falha no registro
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
            return false;
        }
    }
}
