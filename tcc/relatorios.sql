-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01/07/2025 às 01:01
-- Versão do servidor: 10.4.32-MariaDB
-- Versão do PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `conect`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `relatorios`
--

CREATE TABLE `relatorios` (
  `id` int(11) NOT NULL,
  `titulo` varchar(100) NOT NULL,
  `descricao` text DEFAULT NULL,
  `data_envio` date NOT NULL,
  `status` varchar(20) DEFAULT 'ativo',
  `estagio_id` int(11) DEFAULT NULL,
  `empresa_id` int(11) DEFAULT NULL,
  `instituicao_id` int(11) DEFAULT NULL,
  `caminho_arquivo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `relatorios`
--

INSERT INTO `relatorios` (`id`, `titulo`, `descricao`, `data_envio`, `status`, `estagio_id`, `empresa_id`, `instituicao_id`, `caminho_arquivo`) VALUES
(1, 'teste', 'Relatório de Estágios', '2025-06-30', 'ativo', NULL, NULL, NULL, '../relatorios/relatorio_6862ed85945fb6.69192543.pdf'),
(2, 'teste', 'Relatório de Estágios', '2025-06-30', 'ativo', NULL, NULL, NULL, '../relatorios/relatorio_6862eec761b537.86529985.pdf'),
(3, 'teste', 'Relatório de Estágios', '2025-06-30', 'ativo', NULL, NULL, NULL, '../relatorios/relatorio_6862f02ad09e03.92962042.pdf'),
(4, 'tese', 'Relatório de Estágios', '2025-06-30', 'ativo', NULL, NULL, NULL, '../relatorios/relatorio_6862f48f82b5c8.50466740.pdf'),
(5, 'tese', 'Relatório de Estágios', '2025-06-30', 'ativo', NULL, NULL, NULL, '../relatorios/relatorio_6862f6564b7962.30655426.pdf'),
(6, 'tese', 'Relatório de Estágios', '2025-06-30', 'ativo', NULL, NULL, NULL, '../relatorios/relatorio_6862f70abaaa30.99961486.pdf'),
(7, 'tese', 'Relatório de Estágios', '2025-06-30', 'ativo', NULL, NULL, NULL, '../relatorios/relatorio_6862f77b0049d2.82717993.pdf'),
(8, 'teste', 'Relatório de Estágios', '2025-06-30', 'ativo', NULL, NULL, NULL, 'relatorios/relatorio_686303ac5d6727.19924298.pdf'),
(9, 'teste', 'Relatório de Vagas', '2025-06-30', 'ativo', NULL, NULL, NULL, 'relatorios/relatorio_686307be4a3005.35130043.pdf');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `relatorios`
--
ALTER TABLE `relatorios`
  ADD PRIMARY KEY (`id`),
  ADD KEY `estagio_id` (`estagio_id`),
  ADD KEY `empresa_id` (`empresa_id`),
  ADD KEY `instituicao_id` (`instituicao_id`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `relatorios`
--
ALTER TABLE `relatorios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `relatorios`
--
ALTER TABLE `relatorios`
  ADD CONSTRAINT `relatorios_ibfk_1` FOREIGN KEY (`estagio_id`) REFERENCES `estagios` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `relatorios_ibfk_2` FOREIGN KEY (`empresa_id`) REFERENCES `empresa` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `relatorios_ibfk_3` FOREIGN KEY (`instituicao_id`) REFERENCES `instituicao` (`id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
