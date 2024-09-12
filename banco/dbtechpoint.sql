-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 12/09/2024 às 17:06
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
  `urlBanner` char(60) NOT NULL,
  `linkBanner` char(100) NOT NULL DEFAULT 'index.php?tela=home',
  `statusBanner` char(10) NOT NULL DEFAULT 'ATIVO',
  `deletedBanner` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `banners`
--

INSERT INTO `banners` (`idBanner`, `urlBanner`, `linkBanner`, `statusBanner`, `deletedBanner`) VALUES
(7, '/TechPoint/img/banners/banner1.jpg', '', 'ATIVO', 1),
(9, '/TechPoint/img/banners/banner2.jpg', '', 'ATIVO', 0),
(11, '/TechPoint/img/banners/banner3.jpg', '', 'ATIVO', 0),
(12, '/TechPoint/img/banners/banner1.jpg', '', 'ATIVO', 0),
(13, '/TechPoint/img/banners/banner1.jpg', '', 'ATIVO', 1),
(14, '/TechPoint/img/banners/banner1.jpg', '', 'ATIVO', 1),
(15, '/TechPoint/img/banners/banner3.jpg', '', 'ATIVO', 1);

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
(6, 'Gabinete', 'Essa peÃ§a guarda todas as peÃ§as do seu PC', 'ativo', 1),
(7, 'Xeon', 'Processadores da Xeon', 'ATIVO', 1),
(10, 'testes', 'testes', 'ATIVO', 1),
(11, 'teste', 'teste', 'ATIVO', 1);

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
(16, 'Juliana Silva', 'juliana.silva@email.com', 'São José dos Campos', 'SP', 'Pedido especial', 'Gostaria de fazer um pedido especial de um servidor personalizado.', 0),
(17, 'Diego Campos', 'diego.campos@email.com', 'Jundiaí', 'SP', 'Atualização de contato', 'Preciso atualizar meu endereço de entrega no cadastro.', 0),
(18, 'Tatiane Almeida', 'tatiane.almeida@email.com', 'Sorocaba', 'SP', 'Problema com pagamento', 'Estou enfrentando problemas para realizar o pagamento do meu pedido.', 0),
(19, 'Eduardo Ribeiro', 'eduardo.ribeiro@email.com', 'Campinas', 'SP', 'Problemas com site', 'O site está apresentando erro ao tentar finalizar a compra.', 0),
(20, 'Larissa Oliveira', 'larissa.oliveira@email.com', 'Ribeirão Preto', 'SP', 'Feedback sobre atendimento', 'Gostaria de deixar um feedback positivo sobre o atendimento que recebi.', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `images`
--

CREATE TABLE `images` (
  `idImage` int(11) NOT NULL,
  `urlImage` char(100) NOT NULL,
  `typeImage` char(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `products`
--

CREATE TABLE `products` (
  `idProduct` int(11) NOT NULL,
  `nameProduct` char(20) DEFAULT NULL,
  `imageProduct` char(100) DEFAULT NULL,
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

INSERT INTO `products` (`idProduct`, `nameProduct`, `imageProduct`, `descProduct`, `quantProduct`, `quantSoldProduct`, `priceProduct`, `idCategory`, `idSubCategory`, `statusProduct`, `deletedProduct`) VALUES
(1, 'Intel i5-12400', '/TechPoint/img/products/processador_intel_i5.jpg', 'Processador Intel Core i5 de 12° geração, 6 núcleos', 15, 0, 1200, 1, 1, 'ATIVO', 0),
(2, 'Ryzen 5 5600x', '/TechPoint/img/products/processador_amd_ryzen5.jpg', 'Processador AMD Ryzen 5, 6 núcleos, 12 threads', 10, 0, 1100, 1, 2, 'ATIVO', 0),
(3, 'Placa Mãe ASUS ATX', '/TechPoint/img/products/placa_mae_atx_asus.jpg', 'Placa mãe ASUS com suporte para processadores Intel e AMD, formato ATX', 20, 0, 900, 2, 3, 'ATIVO', 0),
(4, 'Memoria RAM DDR4 16G', '/TechPoint/img/products/memoria_ram_ddr4.jpg', 'Memória RAM DDR4 16GB 3200MHz', 30, 0, 450, 3, 5, 'ATIVO', 0),
(5, 'SSD Kingston 500GB', '/TechPoint/img/products/ssd_500gb.jpg', 'SSD Kingston 500GB NVMe', 25, 0, 350, 4, 8, 'ATIVO', 0),
(6, 'NVIDIA RTX 3060', '/TechPoint/img/products/placa_video_nvidia_rtx3060.jpg', 'Placa de vídeo NVIDIA GeForce RTX 3060, 12GB GDDR6', 8, 0, 2400, 5, 9, 'ATIVO', 0);

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
(9, 'NVIDIA', 'Placas de vídeo NVIDIA', 'ATIVO', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `users`
--

CREATE TABLE `users` (
  `idUser` int(11) NOT NULL,
  `nameUser` char(20) NOT NULL,
  `emailUser` char(60) NOT NULL,
  `passwordUser` char(60) NOT NULL,
  `iconUser` char(100) NOT NULL DEFAULT '/TechPoint/img/icons/icon1.png',
  `statusUser` char(10) NOT NULL DEFAULT 'ATIVO',
  `typeUser` char(12) NOT NULL DEFAULT 'default',
  `deletedUser` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Despejando dados para a tabela `users`
--

INSERT INTO `users` (`idUser`, `nameUser`, `emailUser`, `passwordUser`, `iconUser`, `statusUser`, `typeUser`, `deletedUser`) VALUES
(4, 'Jesse Barbosa', 'barbosajesse419@gmail.com', '1234', '/TechPoint/img/icons/icon1.png', 'ATIVO', 'admin-master', 0),
(5, 'admin-master', 'barbosajesse419@gmail.com', '1234', '/TechPoint/img/icons/icon1.png', 'ATIVO', 'admin-master', 0),
(6, 'Jesse', 'barbosajesse419@gmail.com', '1234', '/TechPoint/img/icons/icon1.png', 'ATIVO', 'default', 0);

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
  MODIFY `idBanner` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT de tabela `cart`
--
ALTER TABLE `cart`
  MODIFY `idCart` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `categories`
--
ALTER TABLE `categories`
  MODIFY `idCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `contacts`
--
ALTER TABLE `contacts`
  MODIFY `idContact` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT de tabela `images`
--
ALTER TABLE `images`
  MODIFY `idImage` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `products`
--
ALTER TABLE `products`
  MODIFY `idProduct` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `subcategories`
--
ALTER TABLE `subcategories`
  MODIFY `idSubCategory` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT de tabela `users`
--
ALTER TABLE `users`
  MODIFY `idUser` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`idUser`),
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`idProduct`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
