-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 18/09/2024 às 00:58
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dbtechpoint`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `banners`
--

CREATE TABLE `banners` (
  `idBanner` int(11) NOT NULL,
  `idImage` int(11) DEFAULT NULL,
  `statusBanner` char(10) NOT NULL DEFAULT 'ATIVO',
  `deletedBanner` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `banners`
--

INSERT INTO `banners` (`idBanner`, `idImage`, `statusBanner`, `deletedBanner`) VALUES
(1, 1, 'ATIVO', 0),
(2, 2, 'ATIVO', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `cart`
--

CREATE TABLE `cart` (
  `idCart` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantProducts` int(11) NOT NULL,
  `added_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `cart`
--

INSERT INTO `cart` (`idCart`, `user_id`, `product_id`, `quantProducts`, `added_at`) VALUES
(1, 18, 8, 1, '2024-09-17 22:52:12');

-- --------------------------------------------------------

--
-- Estrutura para tabela `categories`
--

CREATE TABLE `categories` (
  `idCategory` int(11) NOT NULL,
  `nameCategory` char(30) DEFAULT NULL,
  `descCategory` char(200) DEFAULT NULL,
  `statusCategory` char(10) NOT NULL DEFAULT 'ATIVO',
  `deletedCategory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `categories`
--

INSERT INTO `categories` (`idCategory`, `nameCategory`, `descCategory`, `statusCategory`, `deletedCategory`) VALUES
(1, 'Processadores', 'Unidade de processamento central (CPU)', 'ATIVO', 0),
(2, 'Placas Mae', 'Placas que conectam todos os componentes do sistema', 'ATIVO', 0),
(3, 'Memorias RAM', 'Memória de acesso aleatório usada para armazenar dados temporários', 'ATIVO', 0),
(4, 'Armazenamento', 'Dispositivos de armazenamento como HDs e SSDs', 'ATIVO', 0),
(5, 'Placas de Video', 'Unidades de processamento gráfico (GPU)', 'ATIVO', 0),
(6, 'Periféricos', 'Dispositivos como teclados, mouses e headsets', 'ATIVO', 0),
(8, 'Placas de Som', 'Dispositivos de processamento de áudio', 'ATIVO', 0),
(9, 'Coolers', 'Sistemas de resfriamento para computadores', 'ATIVO', 0),
(10, 'Monitores', 'Tela que exibe informações visuais de forma gráfica', 'ATIVO', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `contacts`
--

CREATE TABLE `contacts` (
  `idContact` int(11) NOT NULL,
  `nameContact` char(50) DEFAULT NULL,
  `emailContact` char(50) DEFAULT NULL,
  `cityContact` char(30) DEFAULT NULL,
  `stateContact` char(2) DEFAULT NULL,
  `subjectContact` char(50) DEFAULT NULL,
  `messageContact` varchar(500) DEFAULT NULL,
  `deletedContact` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci COMMENT='Tabela para salvar mensagens dos usuários.';

--
-- Despejando dados para a tabela `contacts`
--

INSERT INTO `contacts` (`idContact`, `nameContact`, `emailContact`, `cityContact`, `stateContact`, `subjectContact`, `messageContact`, `deletedContact`) VALUES
(1, 'João Silva', 'joao.silva@email.com', 'São Paulo', 'SP', 'Dúvida sobre produto', 'Gostaria de saber mais sobre as especificações do computador X.', 0),
(2, 'Maria Oliveira', 'maria.oliveira@email.com', 'Rio de Janeiro', 'RJ', 'Orçamento', 'Preciso de um orçamento para uma estação de trabalho completa.', 0),
(3, 'Carlos Pereira', 'carlos.pereira@email.com', 'Belo Horizonte', 'MG', 'Suporte técnico', 'Meu monitor está com problemas de exibição.', 0),
(4, 'Ana Santos', 'ana.santos@email.com', 'Curitiba', 'PR', 'Compra de equipamento', 'Estou interessada em comprar um teclado mecânico.', 0),
(5, 'Fernando Costa', 'fernando.costa@email.com', 'Porto Alegre', 'RS', 'Dúvida sobre garantia', 'Qual é a garantia para o notebook adquirido recentemente?', 0),
(6, 'Juliana Lima', 'juliana.lima@email.com', 'Recife', 'PE', 'Troca de produto', 'Gostaria de trocar meu mouse por um modelo diferente.', 0),
(7, 'Lucas Almeida', 'lucas.almeida@email.com', 'Salvador', 'BA', 'Informações sobre software', 'Vocês oferecem suporte para instalação de software de edição gráfica?', 0),
(8, 'Patrícia Souza', 'patricia.souza@email.com', 'Fortaleza', 'CE', 'Problema com entrega', 'A entrega do meu pedido está atrasada, podem verificar?', 0),
(9, 'Roberto Rodrigues', 'roberto.rodrigues@email.com', 'São Luís', 'MA', 'Reclamação', 'Recebi um produto danificado e gostaria de uma solução.', 0),
(10, 'Beatriz Silva', 'beatriz.silva@email.com', 'Belém', 'PA', 'Sugestão', 'Sugiro que incluam mais opções de computadores gamers no catálogo.', 0),
(11, 'Renato Lima', 'renato.lima@email.com', 'Natal', 'RN', 'Agradecimento', 'Agradeço pelo ótimo atendimento e suporte recebido.', 0),
(12, 'Elaine Ferreira', 'elaine.ferreira@email.com', 'João Pessoa', 'PB', 'Dúvida sobre pagamento', 'Qual é a forma de pagamento disponível para compras online?', 0),
(13, 'Marcos Freitas', 'marcos.freitas@email.com', 'Maceió', 'AL', 'Solicitação de devolução', 'Preciso devolver um produto que não atendeu minhas expectativas.', 0),
(14, 'Gabriela Rocha', 'gabriela.rocha@email.com', 'Teresina', 'PI', 'Consulta sobre disponibilidade', 'Vocês têm o modelo XYZ em estoque?', 0),
(15, 'Thiago Martins', 'thiago.martins@email.com', 'São Bernardo do Campo', 'SP', 'Ajuda com configuração', 'Preciso de ajuda para configurar meu novo roteador.', 0),
(16, 'Jessé Barbosa', 'barbosajesse419@gmail.com', 'Teófilo Otoni', 'MG', 'Teste', 'Lorem ipsum Dolor', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `images`
--

CREATE TABLE `images` (
  `idImage` int(11) NOT NULL,
  `nameImage` char(50) NOT NULL,
  `urlImage` char(100) NOT NULL,
  `typeImage` char(10) NOT NULL,
  `statusImage` char(10) NOT NULL DEFAULT 'ATIVO',
  `deletedImage` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `images`
--

INSERT INTO `images` (`idImage`, `nameImage`, `urlImage`, `typeImage`, `statusImage`, `deletedImage`) VALUES
(1, 'Primeiro Banner', '/TechPoint/img/banners/banner1.jpg', 'banners', 'ATIVO', 0),
(2, 'Segundo Banner', '/TechPoint/img/banners/banner2.jpg', 'banners', 'ATIVO', 0),
(3, 'i5 12400', '/TechPoint/img/products/processador_intel_i5.jpg', 'products', 'ATIVO', 0),
(4, 'Ryzen 5 5600x', '/TechPoint/img/products/processador_amd_ryzen5.jpg', 'products', 'ATIVO', 0),
(5, 'Placa Mãe ASUS ATX', '/TechPoint/img/products/placa_mae_atx_asus.jpg', 'products', 'ATIVO', 0),
(6, 'Memoria RAM DDR4 16G', '/TechPoint/img/products/memoria_ram_ddr4.jpg', 'products', 'ATIVO', 0),
(7, 'SSD Kingston 500GB', '/TechPoint/img/products/ssd_500gb.jpg', 'products', 'ATIVO', 0),
(8, 'NVIDIA RTX 3060', '/TechPoint/img/products/placa_video_nvidia_rtx3060.jpg', 'products', 'ATIVO', 0),
(9, 'Placa-Mãe MSI ATX', '/TechPoint/img/products/Placa_Mãe_MSI_ATX.jpg', 'products', 'ATIVO', 0),
(10, 'Gabinete NZXT H510', '/TechPoint/img/products/Gabinet_ NZXT_H510.jpg', 'products', 'ATIVO', 0),
(11, 'Fonte Corsair 750W', '/TechPoint/img/products/Fonte_Corsair_750W.jpg', 'products', 'ATIVO', 0),
(13, 'Memória Crucial 16GB', '/TechPoint/img/products/Memória_Crucial_16GB.jpg', 'products', 'ATIVO', 0),
(14, 'Memória Corsair 32GB', '/TechPoint/img/products/Memória_Corsair_32GB.jpg', 'products', 'ATIVO', 0),
(15, 'Water Cooler NZXT Kraken', '/TechPoint/img/products/Water_Cooler_NZXT_Kraken.jpg', 'products', 'ATIVO', 0),
(17, 'Cooler Master Hyper 212', '/TechPoint/img/products/Cooler_Master_Hyper_212.jpg', 'products', 'ATIVO', 0),
(18, 'Mouse Razer DeathAdder', '/TechPoint/img/products/Mouse_Razer_DeathAdder.jpg', 'products', 'ATIVO', 0),
(19, 'Teclado Razer BlackWidow', '/TechPoint/img/products/Teclado_Razer_BlackWidow.jpg', 'products', 'ATIVO', 0),
(20, 'Headset HyperX Cloud II', '/TechPoint/img/products/Headset_HyperX_Cloud_II.jpg', 'products', 'ATIVO', 0),
(21, 'Teclado Corsair K95', '/TechPoint/img/products/Teclado Corsair K95.png', 'products', 'ATIVO', 0),
(22, 'Mouse Logitech G502', '/TechPoint/img/products/Mouse_Logitech_G502.jpg', 'products', 'ATIVO', 0),
(23, 'SSD Samsung 1TB', '/TechPoint/img/products/SSD_Samsung_1TB.jpg', 'products', 'ATIVO', 0),
(24, 'HD Seagate 2TB', '/TechPoint/img/products/HD_Seagate_2TB.png', 'products', 'ATIVO', 0),
(25, 'Placa de Vídeo GTX 1660', '/TechPoint/img/products/Placa_de_Video_GTX_1660.jpg', 'products', 'ATIVO', 0),
(26, 'Webcam Logitech C920', '/TechPoint/img/products/Webcam_Logitech_C920.png', 'products', 'ATIVO', 0),
(27, 'Monitor Samsung Curvo 27\"', '/TechPoint/img/products/Monitor_Samsung_Curvo_27pol.jpg', 'products', 'ATIVO', 0),
(28, 'Cadeira Gamer DXRacer', '/TechPoint/img/products/Cadeira_Gamer_ DXRacer.jpg', 'products', 'ATIVO', 0),
(29, 'Monitor LG 24\"', '/TechPoint/img/products/Monitor_LG_24pol.jpg', 'products', 'ATIVO', 0),
(30, 'AOC GH100', '/TechPoint/img/products/AOC_GH100.jpeg', 'products', 'ATIVO', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `nameProduct` char(50) DEFAULT NULL,
  `idImage` int(11) DEFAULT NULL,
  `descProduct` char(250) DEFAULT NULL,
  `quantProduct` int(11) DEFAULT 0,
  `quantSoldProduct` int(11) NOT NULL DEFAULT 0,
  `priceProduct` float DEFAULT 0,
  `idCategory` int(11) DEFAULT 0,
  `idSubCategory` int(11) DEFAULT 0,
  `statusProduct` char(10) DEFAULT 'ATIVO',
  `deletedProduct` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `products`
--

INSERT INTO `products` (`idProduct`, `nameProduct`, `idImage`, `descProduct`, `quantProduct`, `quantSoldProduct`, `priceProduct`, `idCategory`, `idSubCategory`, `statusProduct`, `deletedProduct`) VALUES
(1, 'Intel i5-12400', 3, 'Processador Intel de 12ª geração', 50, 0, 1200, 1, 1, 'ATIVO', 0),
(2, 'Ryzen 5 5600x', 4, 'Processador AMD Ryzen 5, 6 núcleos, 12 threads', 30, 0, 1100, 1, 2, 'ATIVO', 0),
(3, 'Placa Mãe ASUS ATX', 5, 'Placa mãe ASUS com suporte para processadores Intel e AMD, formato ATX', 20, 0, 900, 2, 3, 'ATIVO', 0),
(4, 'Memoria RAM DDR4 16G', 6, 'Memória RAM DDR4 16GB 3200MHz', 30, 0, 450, 3, 5, 'ATIVO', 0),
(5, 'SSD Kingston 500GB', 7, 'SSD Kingston 500GB NVMe', 25, 0, 350, 4, 6, 'ATIVO', 0),
(6, 'NVIDIA RTX 3060', 8, 'Placa de vídeo NVIDIA GeForce RTX 3060, 12GB GDDR6', 10, 0, 2400, 5, 7, 'ATIVO', 0),
(8, 'Webcam Logitech C920', 26, 'Webcam Logitech C920 Full HD com microfone embutido', 40, 0, 350, 6, 10, 'ATIVO', 0),
(9, 'Memória Crucial 16GB', 13, 'Memória RAM Crucial Ballistix 16GB DDR4 3200MHz', 30, 0, 400, 3, 5, 'ATIVO', 0),
(10, 'Placa-Mãe MSI ATX', 9, 'Placa-mãe MSI B450M Mortar ATX', 20, 0, 850, 2, 3, 'ATIVO', 0),
(11, 'Cadeira Gamer DXRacer', 28, 'Cadeira gamer DXRacer série Racing', 10, 0, 1100, 8, 11, 'ATIVO', 0),
(12, 'Mouse Razer DeathAdder', 18, 'Mouse Razer DeathAdder Elite com 16.000 DPI', 75, 0, 250, 6, 7, 'ATIVO', 0),
(13, 'Monitor Samsung Curvo 27\"', 27, 'Monitor curvo Samsung 27 polegadas Full HD', 12, 0, 1500, 10, 13, 'ATIVO', 0),
(14, 'SSD Samsung 1TB', 23, 'SSD Samsung 970 EVO 1TB NVMe', 20, 0, 1000, 4, 8, 'ATIVO', 0),
(15, 'Teclado Razer BlackWidow', 19, 'Teclado mecânico Razer BlackWidow com switches verdes', 50, 0, 650, 6, 7, 'ATIVO', 0),
(16, 'Memória Corsair 32GB', 14, 'Memória RAM Corsair Vengeance 32GB DDR4 3200MHz', 25, 0, 950, 3, 5, 'ATIVO', 0),
(17, 'Water Cooler NZXT Kraken', 15, 'Water Cooler NZXT Kraken X53 com radiador de 240mm', 10, 0, 600, 4, 6, 'ATIVO', 0),
(18, 'Headset HyperX Cloud II', 20, 'Headset HyperX Cloud II com som surround 7.1 e microfone embutido', 19, 0, 500, 6, 7, 'ATIVO', 0),
(20, 'Placa de Vídeo GTX 1660', 25, 'Placa de vídeo NVIDIA GTX 1660, 6GB GDDR5', 12, 0, 1200, 5, 9, 'ATIVO', 0),
(21, 'HD Seagate 2TB', 24, 'HD Seagate Barracuda 2TB 7200RPM', 35, 0, 450, 4, 8, 'ATIVO', 0),
(23, 'Cadeira Gamer ThunderX3', 26, 'Cadeira gamer ThunderX3 com apoio lombar e inclinação de até 180 graus', 15, 0, 900, 8, 11, 'ATIVO', 0),
(24, 'Monitor LG 24\"', 29, 'Monitor LG 24 polegadas Full HD com 75Hz de taxa de atualização', 20, 0, 850, 10, 13, 'ATIVO', 0),
(25, 'Teclado Corsair K95', 21, 'Teclado mecânico Corsair K95 com switches Cherry MX RGB', 60, 0, 700, 6, 7, 'ATIVO', 0),
(26, 'Mouse Logitech G502', 22, 'Mouse Gamer Logitech G502 com sensor Hero 16K DPI', 80, 0, 350, 6, 7, 'ATIVO', 0),
(27, 'Gabinete NZXT H510', 10, 'Gabinete NZXT H510 Mid Tower com painel de vidro temperado', 10, 0, 500, 2, 3, 'ATIVO', 0),
(28, 'Cooler Master Hyper 212', 17, 'Cooler para CPU Cooler Master Hyper 212 com 4 heatpipes', 40, 0, 150, 4, 6, 'ATIVO', 0),
(7, 'Fonte Corsair 750W', 11, 'Fonte de alimentação Corsair com 750W de potência e certificação 80 Plus Gold', 15, 0, 550, 2, 4, 'ATIVO', 0),
(271, 'AOC GH100', 30, 'Headset HyperX Cloud II com som surround 7.1 e microfone embutido', 56, 0, 149, 6, 10, 'ATIVO', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `subcategories`
--

CREATE TABLE `subcategories` (
  `idSubCategory` int(11) NOT NULL,
  `nameSubCategory` char(30) DEFAULT NULL,
  `descSubCategory` varchar(100) DEFAULT NULL,
  `statusSubCategory` char(10) NOT NULL DEFAULT 'ATIVO',
  `deletedSubCategory` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `subcategories`
--

INSERT INTO `subcategories` (`idSubCategory`, `nameSubCategory`, `descSubCategory`, `statusSubCategory`, `deletedSubCategory`) VALUES
(1, 'Intel', 'Processadores da Intel', 'ATIVO', 0),
(2, 'AMD', 'Processadores da AMD', 'ATIVO', 0),
(3, 'ATX', 'Placas mãe no formato ATX', 'ATIVO', 0),
(4, 'Micro-ATX', 'Placas mãe no formato Micro-ATX', 'ATIVO', 0),
(5, 'DDR4', 'Memórias RAM DDR4', 'ATIVO', 0),
(6, 'DDR5', 'Memórias RAM DDR5', 'ATIVO', 0),
(7, 'HD', 'Discos rígidos (HDD)', 'ATIVO', 0),
(8, 'SSD', 'Unidades de estado sólido (SSD)', 'ATIVO', 0),
(9, 'NVIDIA', 'Placas de vídeo NVIDIA', 'ATIVO', 0),
(10, 'USB', 'Dispositivos conectados via USB', 'ATIVO', 0),
(11, 'SATA', 'Dispositivos conectados via SATA', 'ATIVO', 0),
(12, 'PCIe', 'Componentes conectados via PCIe', 'ATIVO', 0),
(13, 'HDMI/VGA', 'Dispositivos de vídeo conectados via HDMI/VGA', 'ATIVO', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `nameUser` char(20) NOT NULL,
  `emailUser` char(60) NOT NULL,
  `passwordUser` char(60) NOT NULL,
  `statusUser` char(10) NOT NULL DEFAULT 'ATIVO',
  `typeUser` char(12) NOT NULL DEFAULT 'default',
  `deletedUser` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`idUser`, `nameUser`, `emailUser`, `passwordUser`, `statusUser`, `typeUser`, `deletedUser`) VALUES
(1, 'João Silva', 'joao.silva@email.com', 'senha123', 'ATIVO', 'default', 0),
(2, 'Maria Oliveira', 'maria.oliveira@email.com', 'senha123', 'ATIVO', 'default', 0),
(3, 'Carlos Pereira', 'carlos.pereira@email.com', 'senha123', 'ATIVO', 'default', 0),
(4, 'Ana Santos', 'ana.santos@email.com', 'senha123', 'ATIVO', 'default', 0),
(5, 'Fernando Costa', 'fernando.costa@email.com', 'senha123', 'ATIVO', 'default', 0),
(6, 'Juliana Lima', 'juliana.lima@email.com', 'senha123', 'ATIVO', 'default', 0),
(7, 'Lucas Almeida', 'lucas.almeida@email.com', 'senha123', 'ATIVO', 'default', 0),
(8, 'Patrícia Souza', 'patricia.souza@email.com', 'senha123', 'ATIVO', 'default', 0),
(9, 'Roberto Rodrigues', 'roberto.rodrigues@email.com', 'senha123', 'ATIVO', 'default', 0),
(10, 'Beatriz Silva', 'beatriz.silva@email.com', 'senha123', 'ATIVO', 'default', 0),
(11, 'Renato Lima', 'renato.lima@email.com', 'senha123', 'ATIVO', 'default', 0),
(12, 'Elaine Ferreira', 'elaine.ferreira@email.com', 'senha123', 'ATIVO', 'default', 0),
(13, 'Marcos Freitas', 'marcos.freitas@email.com', 'senha123', 'ATIVO', 'default', 0),
(14, 'Gabriela Rocha', 'gabriela.rocha@email.com', 'senha123', 'ATIVO', 'default', 0),
(15, 'Thiago Martins', 'thiago.martins@email.com', 'senha123', 'ATIVO', 'default', 0),
(16, 'Diego', 'diupake@gmail.com', '1234', 'ATIVO', 'admin', 0),
(17, 'admin-master', 'admin-master@gmail.com', '1234', 'ATIVO', 'admin-master', 0),
(18, 'Jesse Barbosa', 'barbosajesse419@gmail.com', '1234', 'ATIVO', 'default', 0);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `banners`
--
ALTER TABLE `banners`
  ADD PRIMARY KEY (`idBanner`);

--
-- Índices de tabela `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`idCart`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Índices de tabela `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`idCategory`);

--
-- Índices de tabela `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`idContact`);

--
-- Índices de tabela `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`idImage`);

--
-- Índices de tabela `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`idProduct`);

--
-- Índices de tabela `subcategories`
--
ALTER TABLE `subcategories`
  ADD PRIMARY KEY (`idSubCategory`);

--
-- Índices de tabela `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`idUser`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `banners`
--
ALTER TABLE `banners`
  MODIFY `idBanner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `cart`
--
ALTER TABLE `cart`
  MODIFY `idCart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `idContact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `images`
--
ALTER TABLE `images`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=272;

--
-- AUTO_INCREMENT de tabela `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `idSubCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
