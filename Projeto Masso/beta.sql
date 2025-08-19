CREATE DATABASE imagens_db;
-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 19/08/2025 às 21:01
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
(23, 'uploads/68a346e871508_Logo-lavagem-de-maos-1-1024x373.jpg', 'Médio', 'deu certo 2', '200', 'Sim', '2025-08-18 15:29:44', '2025-08-18 12:29:44', NULL, NULL),
(24, 'uploads/68a349941ee89_download.jpg', 'Baixo', 'deu certo 2', '200', 'Sim', '2025-08-18 15:41:08', '2025-08-18 12:41:08', NULL, NULL),
(25, 'uploads/68a349941fd42_Protecao-das-Maos.png', 'Baixo', 'AMAaa', '200', 'Sim', '2025-08-18 15:41:08', '2025-08-18 12:41:08', NULL, NULL),
(26, 'uploads/68a349c236cf9_img_67_221122_e953a594-02ac-46b8-8721-5bd0c1c34bfc_p.jpg', 'Baixo', 'deu certo 2', '200', 'Sim', '2025-08-18 15:41:54', '2025-08-18 12:41:54', NULL, NULL),
(27, 'uploads/68a34a155a3b8_download.jpg', 'Baixo', 'deu certo 2', '200', 'Não', '2025-08-18 15:43:17', '2025-08-18 12:43:17', NULL, NULL),
(28, 'uploads/68a34d746ed97_maos_importancia.jpg', 'Médio', 'AMA', '200', 'Sim', '2025-08-18 15:57:40', '2025-08-18 12:57:40', NULL, NULL),
(29, 'uploads/68a34fc692a90_maos_importancia.jpg', 'Baixo', 'AMA', '200', 'Não', '2025-08-18 16:07:34', '2025-08-18 13:07:34', NULL, NULL),
(30, 'uploads/68a351a6b727c_Protecao-das-Maos.png', 'Baixo', 'deu certo 2', '', 'Não', '2025-08-18 16:15:34', '2025-08-18 13:15:34', NULL, NULL),
(31, 'uploads/68a49d37f3e44_image.jpg', 'Médio', 'nsnsj', '', 'Sim', '2025-08-19 15:50:16', '2025-08-19 12:50:15', NULL, NULL),
(32, 'uploads/68a4b48caa032_Protecao-das-Maos.png', 'Baixo', 'deu certo 2', '', 'Não', '2025-08-19 17:29:48', '2025-08-19 14:29:48', 1, NULL),
(33, 'uploads/68a4bbc2b5a0a_Protecao-das-Maos.png', 'Médio', 'Canaletas desobstrídas, sem transbordo', '', 'Sim', '2025-08-19 18:00:34', '2025-08-19 15:00:34', 1, 'Armazenamento de Òleo - Eneva');

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
(1, 'mateus@gmail.com', '123', 'mateus');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `uploads`
--
ALTER TABLE `uploads`
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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
