-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 22/12/2020 às 10:06
-- Versão do servidor: 10.3.27-MariaDB-0+deb10u1
-- Versão do PHP: 7.3.25-1+0~20201130.73+debian10~1.gbp042074

SET SQL_MODE
= "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone
= "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `crud_empresas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cnae`
--

CREATE TABLE `cnae`
(
  `id_cnae` int
(16) NOT NULL,
  `codigo_cnae` varchar
(16) COLLATE utf8mb4_swedish_ci NOT NULL,
  `desc_cnae` text COLLATE utf8mb4_swedish_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas`
(
  `id` bigint
(20) UNSIGNED NOT NULL,
  `cnpj` varchar
(14) COLLATE utf8mb4_swedish_ci NOT NULL,
  `razao_social` varchar
(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `nome_fantasia` varchar
(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `telefone` varchar
(15) COLLATE utf8mb4_swedish_ci NOT NULL,
  `id_cnae` int
(16) NOT NULL,
  `cep` varchar
(10) COLLATE utf8mb4_swedish_ci NOT NULL,
  `logradouro` varchar
(255) COLLATE utf8mb4_swedish_ci NOT NULL,
  `numero` varchar
(10) NOT NULL,
  `bairro` varchar
(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `sigla_estado` char
(2) COLLATE utf8mb4_swedish_ci NOT NULL,
  `cidade` varchar
(100) COLLATE utf8mb4_swedish_ci NOT NULL,
  `observacao` text COLLATE utf8mb4_swedish_ci DEFAULT NULL,
  `situacao` tinyint
(1) NOT NULL COMMENT '0: Inativo; 1: Ativo',
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp
(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp
(),
  `excluido_em` datetime DEFAULT NULL COMMENT 'Se preenchido, a empresa estará com situação Excluída'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_swedish_ci;

--
-- Índices de tabelas apagadas
--

--
-- Índices de tabela `cnae`
--
ALTER TABLE `cnae`
ADD PRIMARY KEY
(`id_cnae`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
ADD PRIMARY KEY
(`id`),
ADD KEY `cnae`
(`id_cnae`);

--
-- AUTO_INCREMENT de tabelas apagadas
--

--
-- AUTO_INCREMENT de tabela `cnae`
--
ALTER TABLE `cnae`
  MODIFY `id_cnae` int
(16) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `empresas`
--
ALTER TABLE `empresas`
  MODIFY `id` bigint
(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- Restrições para dumps de tabelas
--

--
-- Restrições para tabelas `empresas`
--
ALTER TABLE `empresas`
ADD CONSTRAINT `fk_empresas_cnae` FOREIGN KEY
(`id_cnae`) REFERENCES `cnae`
(`id_cnae`) ON
UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
