<?php
include_once("CriaPaginacao.php");
class MostrarImagens extends CriaPaginacao {
    private $strNumPagina, $strUrl, $strSessao;

    public function setNumPagina($x) {
        $this->strNumPagina = $x;
    }

    public function setUrl($x) {
        $this->strUrl = $x;
    }

    public function setSessao($x) {
        $this->strSessao = $x;
    }

    public function getPagina() {
        return $this->strNumPagina;
    }

    public function mostrarImagens() {
        try {
            $sql = "SELECT * FROM images WHERE deletedImage = 0";

            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(3);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;
            $images = $this->results();
            
            if (count($images) > 0) {
                echo "
                    <table class='table table-light table-hover'>
                        <thead>
                            <tr class='text-center table-dark'>
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Tipo</th>
                                <th>URL</th>
                                <th>Status</th>
                                <th width='30'></th>
                                <th width='30'></th>
                            </tr>
                        </thead>
                        <tbody>
                ";
                foreach($images as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                    echo "<td class='fw-lighter'>".$resultado['idImage']."</td>";
                    echo "<td class='fw-lighter'>".$resultado['nameImage']."</td>";
                    echo "<td class='fw-lighter'>".$resultado['typeImage']."</td>";
                    echo "<td class='fw-lighter'>".$resultado['urlImage']."</td>";
                    echo "<td class='fw-lighter'>".$resultado['statusImage']."</td>";
                    echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editImageModal' data-id='".$resultado['idImage']."' data-name='".$resultado['nameImage']."' data-type='".$resultado['typeImage']."' data-url='".$resultado['urlImage']."' data-status='".$resultado['statusImage']."'></a></td>";
                    echo "<td><i class='bi bi-trash btn btn-dark' data-id='".$resultado['idImage']."'></i></td>";
                    echo "</tr>";
                }
                echo "
                    </tbody>
                    </table>
                ";
            } else {
                echo "Nenhum dado encontrado.";
            }
        } catch (Exception $e) {
            echo "Erro: ".$e->getMessage();
        }
    }
}
?>
