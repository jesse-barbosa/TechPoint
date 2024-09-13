<?php
include_once("MinhaConexao.php");

class MostrarCarrinho extends MinhaConexao {
    public function __construct() {
        parent::__construct();
    }

    public function mostrarProdutos() {
        // Verifica se o usuário está logado
        if (!isset($_SESSION['idUser'])) {
            echo "<p class='alert alert-secondary mx-5'>Você precisa estar logado para ver seu carrinho.</p>";
            return;
        }

        $usuario_id = $_SESSION['idUser'];

        try {
            // Consulta os produtos no carrinho do usuário
            $sql = "SELECT *
                    FROM cart c
                    INNER JOIN products p ON c.product_id = p.idProduct
                    WHERE c.user_id = ?";
            
            $stmt = $this->conectar->prepare($sql);
            $stmt->bind_param("i", $usuario_id);
            $stmt->execute();
            $result = $stmt->get_result();

            if (!$result) {
                throw new Exception("Erro na execução da consulta: " . $this->conectar->error);
            }

            // Verifica se o carrinho está vazio
            if ($result->num_rows == 0) {
                echo "<p class='text-secondary text-center my-5'>
                <i class='bi bi-emoji-frown fs-4 my-2'></i><br />
                Ops! Seu carrinho está vazio.
                </p>";
            } else {
                echo '<table class="table">';
                echo '<thead><tr class="text-center">
                            <th>Produto</th>
                            <th>Nome</th>
                            <th>Preço</th>
                            <th>Quantidade</th>
                            <th>Total</th>
                            <th width="30"></th>
                        </tr>
                    </thead>
                <tbody>';
                
                $totalGeral = 0;
                while ($row = $result->fetch_assoc()) {
                    $nome = $row['nameProduct'];
                    $image = $row['imageProduct'];
                    $preco = $row['priceProduct'];
                    $quantidade = $row['quantProducts'];
                    $total = $preco * $quantidade;
                    $totalGeral += $total;
                    echo "<tr class='text-center'>
                            <td><img src='{$image}' height='80'/></td>
                            <td>{$nome}</td>
                            <td>R$ " . number_format($preco, 2, ',', '.') . "</td>
                            <td>{$quantidade}</td>
                            <td>R$ " . number_format($total, 2, ',', '.') . "</td>
                            <td>
                                <form method='POST' action='index.php?tela=viewCart'>
                                    <input type='hidden' name='idProduto' value='{$row['product_id']}'>
                                    <button type='submit' class='btn btn-light'>
                                        <i class='bi bi-trash fs-4'></i>
                                    </button>
                                </form>
                            </td>
                        </tr>";
                }
                echo "</tbody></table>";
                echo "<h4 class='ps-4'>Total Geral: R$ " . number_format($totalGeral, 2, ',', '.') . "</h4>";
            }

            $stmt->close();
        } catch (Exception $e) {
            echo "Erro: " . $e->getMessage();
        }
    }
}
?>
