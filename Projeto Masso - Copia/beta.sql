-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28/08/2025 às 21:38
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
-- Banco de dados: `imagens_db`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `uploads`
--

CREATE TABLE `uploads` (
  `id` int(11) NOT NULL,
  `imagem` varchar(255) DEFAULT NULL,
  `nivel` varchar(50) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `volume` varchar(1000) DEFAULT NULL,
  `transbordo` enum('Sim','Não') DEFAULT NULL,
  `data_upload` timestamp NOT NULL DEFAULT current_timestamp(),
  `data_envio` datetime NOT NULL DEFAULT current_timestamp(),
  `usuario_id` int(11) DEFAULT NULL,
  `local` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `uploads`
--

INSERT INTO `uploads` (`id`, `imagem`, `nivel`, `observacao`, `volume`, `transbordo`, `data_upload`, `data_envio`, `usuario_id`, `local`) VALUES
(33, 'uploads/68a4bbc2b5a0a_Protecao-das-Maos.png', 'Médio', 'Canaletas desobstrídas, sem transbordo', '', 'Sim', '2024-08-08 18:00:34', '2024-08-08 15:00:34', 1, 'Armazenamento de Òleo - Eneva'),
(36, 'uploads/68a4d16bbf211_689e243e59c09_IMG_5478.jpeg', 'Médio', 'deu certo3', '', 'Sim', '2025-08-19 19:32:59', '2025-08-19 16:32:59', 1, 'Masso'),
(37, 'uploads/68a5eb6527ad2_689e243e59c09_IMG_5478.jpeg', 'Médio', 'deu certo3', '', 'Sim', '2025-08-20 15:36:05', '2025-08-20 12:36:05', 1, 'Armazenamento de Òleo - Eneva'),
(38, 'uploads/68a5ed42cb8c2_68a4ce40a8192_68a49d37f3e44_image.jpg', 'Não possui', 'AMA', '', 'Sim', '2025-08-20 15:44:02', '2025-08-20 12:44:02', 1, 'Armazenamento de Òleo - Eneva'),
(39, 'uploads/68a5f5147953e_image.jpg', 'Não possui', 'teste', '', 'Não', '2025-08-20 16:17:24', '2025-08-20 13:17:24', 1, 'Masso'),
(40, 'uploads/68a6105b47ec3_image.jpg', 'Médio', 'nao sei', '', 'Sim', '2025-08-20 18:13:47', '2025-08-20 15:13:47', 1, 'nao sei'),
(41, 'uploads/68a610908ac24_image.jpg', 'Não possui', 'x', '', 'Sim', '2025-08-20 18:14:40', '2025-08-20 15:14:40', 1, 'jsj'),
(42, 'uploads/68a61818cfd3e_image.jpg', 'Não possui', 'sei la', '', 'Não', '2025-08-20 18:46:48', '2025-08-20 15:46:48', 1, 'Masso'),
(43, 'uploads/68a6255a6b2c6_68a6105b47ec3_image.jpg', '', '°Canalatas descobertas\r\n°Sem transbordo', '', '', '2025-08-20 19:43:22', '2025-08-20 16:43:22', 1, 'Armazenamento de Òleo - Eneva'),
(44, 'uploads/68ac8e77e35db_image.jpg', '', 'qw', '', '', '2025-08-25 16:25:27', '2025-08-25 13:25:27', 1, '123'),
(45, 'uploads/68ac8e8335c72_17561391278602650689371420711875.jpg', '', 'Teste', '', '', '2025-08-25 16:25:39', '2025-08-25 13:25:39', 1, 'Masso'),
(47, 'uploads/68ac955dbdfda_Captura de Tela (1).png', '', '12', '', '', '2025-08-25 16:54:53', '2025-08-25 13:54:53', 1, 'Masso'),
(49, 'uploads/68ac966e3627d_IMG_5616.png', '', 'TESTEW', '', '', '2025-08-25 16:59:26', '2025-08-25 13:59:26', 1, 'Masso'),
(50, 'uploads/68ac98b4b25d9_image.jpg', '', 'Teste png', '', '', '2025-08-25 17:09:08', '2025-08-25 14:09:08', 1, 'Masso'),
(51, 'uploads/68ac99d8bb940_IMG_5616.png', '', 'TER', '', '', '2025-08-25 17:14:00', '2025-08-25 14:14:00', 1, 'Masso'),
(52, 'uploads/68ac99ec4f46b_image.jpg', '', 'teste 2', '', '', '2025-08-25 17:14:20', '2025-08-25 14:14:20', 1, 'Masso'),
(53, 'uploads/68addf4b3408d_Imagem1.png', '', 'teste', '', '', '2025-08-26 16:22:35', '2025-08-26 13:22:35', 1, 'Masso'),
(54, 'uploads/68adec79dd20e_image.jpg', '', 'paisagem ', '', '', '2025-08-26 17:18:49', '2025-08-26 14:18:49', 1, 'Teste da foto'),
(55, 'uploads/68aded88bc202_image.jpg', '', 'teste', '', '', '2025-08-26 17:23:20', '2025-08-26 14:23:20', 1, 'Teste 1 '),
(56, 'uploads/68adf4c1e4a74_image.jpg', '', 'img 4', '', '', '2025-08-26 17:54:09', '2025-08-26 14:54:09', 1, 'teste 2'),
(57, 'uploads/68adf640c8184_68a5f5147953e_image.jpg', '', '2', '', '', '2025-08-26 18:00:32', '2025-08-26 15:00:32', 1, 'teste de mul'),
(58, 'uploads/68adf6750fb61_68a5eb6527ad2_689e243e59c09_IMG_5478.jpeg', '', '2', '', '', '2025-08-26 18:01:25', '2025-08-26 15:01:25', 1, 'teste de mul'),
(59, 'uploads/68adf79e0a290_68a4d16bbf211_689e243e59c09_IMG_5478.jpeg', NULL, '3', NULL, NULL, '2025-08-26 18:06:22', '2025-08-26 15:06:22', 1, 'Armazenamento de Òleo - Eneva'),
(60, 'uploads/68ae0ec0b3529_68a4ce40a8192_68a49d37f3e44_image.jpg', '', 'teste de funcionamento', '', '', '2025-08-26 19:45:04', '2025-08-26 16:45:04', 1, 'Armazenamento de Òleo - Eneva'),
(61, 'uploads/68ae0ec0b4145_68a5f5147953e_image.jpg', '', 'teste de funcionamento 2', '', '', '2025-08-26 19:45:04', '2025-08-26 16:45:04', 1, 'Masso'),
(62, 'uploads/68af28e896a83_68a4d16bbf211_689e243e59c09_IMG_5478.jpeg', '', '4', '', '', '2025-08-27 15:48:56', '2025-08-27 12:48:56', 1, 'teste de mul'),
(63, 'uploads/68af298247019_68a4ce75809ab_68a34fc692a90_maos_importancia.jpg', '', '7', '', '', '2025-08-27 15:51:30', '2025-08-27 12:51:30', 1, 'Armazenamento de Òleo - Eneva'),
(64, 'uploads/68af2d790a0f9_68a5f5147953e_image.jpg', '', '90', '', '', '2025-08-27 16:08:25', '2025-08-27 13:08:25', 1, 'Armazenamento de Òleo - Eneva'),
(65, 'uploads/68af2ee9c9021_68a5eb6527ad2_689e243e59c09_IMG_5478.jpeg', NULL, '80', NULL, NULL, '2025-08-27 16:14:33', '2025-08-27 13:14:33', 1, 'teste de mul');

-- --------------------------------------------------------

--
-- Estrutura para tabela `upload_imagens`
--

CREATE TABLE `upload_imagens` (
  `id` int(11) NOT NULL,
  `local_id` int(11) DEFAULT NULL,
  `imagem` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `upload_imagens`
--

INSERT INTO `upload_imagens` (`id`, `local_id`, `imagem`) VALUES
(1, 1, 'uploads/68af30a350a49_68a4ce40a8192_68a49d37f3e44_image.jpg'),
(2, 2, 'uploads/68af315b4cd78_68a4ce40a8192_68a49d37f3e44_image.jpg'),
(3, 2, 'uploads/68af315b4d8e5_68a5eb6527ad2_689e243e59c09_IMG_5478.jpeg'),
(4, 3, 'uploads/68af416321544_68a5ed42cb8c2_68a4ce40a8192_68a49d37f3e44_image.jpg'),
(5, 3, 'uploads/68af416321d9d_68a5eb6527ad2_689e243e59c09_IMG_5478.jpeg'),
(6, 3, 'uploads/68af41632285b_68a4bbc2b5a0a_Protecao-das-Maos.png'),
(7, 4, 'uploads/68af4327adcda_68addf4b3408d_Imagem1.png'),
(8, 4, 'uploads/68af4327ae7e3_68ac955dbdfda_Captura de Tela (1).png'),
(9, 5, 'uploads/68af4d00bd1f7_68a4ce75809ab_68a34fc692a90_maos_importancia.jpg'),
(10, 5, 'uploads/68af4d00bddb0_68a5eb6527ad2_689e243e59c09_IMG_5478.jpeg'),
(11, 6, 'uploads/68af5048d316a_68a5eb6527ad2_689e243e59c09_IMG_5478.jpeg'),
(12, 7, 'uploads/68af5782654b7_image.jpg'),
(13, 7, 'uploads/68af578265c80_image.jpg'),
(14, 8, 'uploads/68af58af9704b_image.jpg'),
(15, 8, 'uploads/68af58af97b31_image.jpg'),
(16, 8, 'uploads/68af58af98507_image.jpg');

-- --------------------------------------------------------

--
-- Estrutura para tabela `upload_locais`
--

CREATE TABLE `upload_locais` (
  `id` int(11) NOT NULL,
  `nivel` varchar(255) DEFAULT NULL,
  `observacao` text DEFAULT NULL,
  `volume` varchar(255) DEFAULT NULL,
  `transbordo` varchar(255) DEFAULT NULL,
  `data_envio` datetime DEFAULT NULL,
  `usuario_id` int(11) DEFAULT NULL,
  `local` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `upload_locais`
--

INSERT INTO `upload_locais` (`id`, `nivel`, `observacao`, `volume`, `transbordo`, `data_envio`, `usuario_id`, `local`) VALUES
(1, '', '12', '', '', '2025-08-27 13:21:55', 1, 'Armazenamento de Òleo - Eneva'),
(2, '', '2', '', '', '2025-08-27 13:24:59', 1, 'teste de mul'),
(3, '', '3', '', '', '2025-08-27 14:33:23', 1, 'Armazenamento de Òleo - Eneva'),
(4, '', 'TESTE TESTE', '', '', '2025-08-27 14:40:55', 1, 'Armazenamento de Òleo - Eneva'),
(5, '', '2', '', '', '2025-08-27 15:22:56', 1, 'Armazenamento de Òleo - Eneva'),
(6, '', '1', '', '', '2025-08-27 15:36:56', 1, 'teste de 2 envios'),
(7, '', 'TESTETESTETES', '', '', '2025-08-27 16:07:46', 1, 'Teste '),
(8, '', 'Testetesteteste', '', '', '2025-08-27 16:12:47', 1, 'TESTE');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `email` varchar(200) DEFAULT NULL,
  `senha` varchar(200) DEFAULT NULL,
  `nome` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `email`, `senha`, `nome`) VALUES
(1, 'mateus@gmail.com', '123', 'mateus'),
(2, 'escritorio@gmail.com', 'escritorio123', 'Escritório'),
(3, 'leo@gmail.com', 'leo123', 'Leo'),
(4, 'jessica@gmail.com', 'jessica123', 'Jéssica'),
(5, 'jefersson@gmail.com', 'jefersson123', 'Jefersson');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `uploads`
--
ALTER TABLE `uploads`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `upload_imagens`
--
ALTER TABLE `upload_imagens`
  ADD PRIMARY KEY (`id`),
  ADD KEY `local_id` (`local_id`);

--
-- Índices de tabela `upload_locais`
--
ALTER TABLE `upload_locais`
  ADD PRIMARY KEY (`id`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `uploads`
--
ALTER TABLE `uploads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT de tabela `upload_imagens`
--
ALTER TABLE `upload_imagens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT de tabela `upload_locais`
--
ALTER TABLE `upload_locais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `upload_imagens`
--
ALTER TABLE `upload_imagens`
  ADD CONSTRAINT `upload_imagens_ibfk_1` FOREIGN KEY (`local_id`) REFERENCES `upload_locais` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
