<?php
class TrocarUrl {
    public function trocarUrl($tela) {
        try {
            if ($tela == 'viewProduct' && isset($_GET['id'])) {
                include_once('../tela/viewProduct.php');
            } else {
                include_once("../tela/$tela.php");
            }
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
