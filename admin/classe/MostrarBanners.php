<?php
include_once("CriaPaginacao.php");

class MostrarBanners extends CriaPaginacao {
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

    public function totalBanners() {
        try {
            $sql = "SELECT COUNT(*) as total FROM banners WHERE deletedBanner = 0";
            $query = self::execSql($sql);
            $resultado = self::listarDados($query);

            return $resultado[0]['total'];
        } catch (Exception $e) {
            echo "Erro ao contar os banners: " . $e->getMessage();
        }
    }

    public function mostrarBanners() {
        try {
            $sql = "SELECT b.idBanner, b.statusBanner, i.nameImage
                    FROM banners b
                    JOIN images i ON b.idImage = i.idImage
                    WHERE b.deletedBanner = 0";

            $this->setParametro($this->strNumPagina);
            $this->setFileName($this->strUrl);
            $this->setInfoMaxPag(3);
            $this->setMaximoLinks(9);
            $this->setSQL($sql);
            self::iniciaPaginacao();
            $contador = 0;
            $banners = $this->results();
            
            if (count($banners) > 0) {
                echo "
                    <table class='table table-light table-hover'>
                        <thead>
                            <tr class='text-center table-dark'>
                                <th>ID</th>
                                <th>Imagem</th>
                                <th>Status</th>
                                <th width='30'></th>
                                <th width='30'></th>
                            </tr>
                        </thead>
                        <tbody>
                ";
                foreach($banners as $resultado){
                    $contador++;
                    echo "<tr class='text-center'>";
                    echo "<td class='fw-lighter'>".$resultado['idBanner']."</td>";
                    echo "<td class='fw-lighter'>".$resultado['nameImage']."</td>";
                    echo "<td class='fw-lighter'>".$resultado['statusBanner']."</td>";
                    echo "<td><a href='#' class='bi bi-pencil btn btn-outline-dark' data-bs-toggle='modal' data-bs-target='#editBannerModal' data-id='".$resultado['idBanner']."' data-situacao='".$resultado['statusBanner']."'></a></td>";
                    echo "<td><i class='bi bi-trash btn btn-dark' data-id='".$resultado['idBanner']."'></i></td>";
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
