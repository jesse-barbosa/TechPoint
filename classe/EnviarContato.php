<?php
include_once("MinhaConexao.php");

class EnviarContato extends MinhaConexao {
    public function __construct(){
        parent::__construct();
    }

    public function salvarContato($nameContact, $emailContact, $cityContact, $stateContact, $subjectContact, $messageContact) {
        // Prepara a consulta SQL
        $sql = "INSERT INTO contacts (nameContact, emailContact, cityContact, stateContact, subjectContact, messageContact) 
                VALUES (?, ?, ?, ?, ?, ?)";
        
        // Prepara a declaração (stmt) usando MySQLi
        $stmt = $this->conectar->prepare($sql);
        if ($stmt === false) {
            die('Erro ao preparar a consulta: ' . $this->conectar->error);
        }

        // Faz o bind dos parâmetros (s = string)
        $stmt->bind_param('ssssss', $nameContact, $emailContact, $cityContact, $stateContact, $subjectContact, $messageContact);

        // Executa a consulta
        if ($stmt->execute()) {
            return true; // Sucesso
        } else {
            return false; // Falha
        }

        // Fecha o statement
        $stmt->close();
    }
}
?>
