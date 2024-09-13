<?php
include_once("MinhaConexao.php");

class MostrarBanners extends MinhaConexao
{
    public function __construct()
    {
        parent::__construct();
    }

    public function mostrarBanners()
    {
        try {
            // Consulta para obter os banners ativos e suas imagens associadas
            $sql = "SELECT banners.*, images.urlImage 
                    FROM banners 
                    INNER JOIN images ON banners.idImage = images.idImage 
                    WHERE banners.statusBanner = 'ATIVO' AND banners.deletedBanner = 0";
            $resultado = $this->execSql($sql);

            // Verifica se há banners
            if (mysqli_num_rows($resultado) > 0) {
                $html = '<div class="container-fluid p-0">
                    <div id="carouselExampleRide" class="carousel slide" data-bs-ride="true">
                    <div class="carousel-inner">';
                $ativa = true;
                while ($banner = mysqli_fetch_assoc($resultado)) {
                    $classe = $ativa ? 'carousel-item active' : 'carousel-item';
                    $html .= '<div class="' . $classe . '">
                                 <img src="' . $banner['urlImage'] . '" class="d-block w-100 full-screen-banner" alt="Imagem do Banner">
                             </div>';
                    $ativa = false;
                }

                $html .= '     </div>
                                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="prev">
                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Previous</span>
                                    </button>
                                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleRide" data-bs-slide="next">
                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                        <span class="visually-hidden">Next</span>
                                    </button>
                             </div>
                         </div>';

                echo $html;
            } else {
                echo '<p>Nenhum banner disponível.</p>';
            }
        } catch (Exception $e) {
            echo "Erro ao exibir banners: " . $e->getMessage();
        }
    }
}

?>
