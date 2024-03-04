-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 03-Mar-2024 às 21:11
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `cripto`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aporte`
--

CREATE TABLE `aporte` (
  `id` int(11) NOT NULL,
  `id_moeda` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `preco_moeda_compra` double(10,2) NOT NULL,
  `quantidade_moeda` double(10,4) NOT NULL,
  `valor_aporte` double(10,2) NOT NULL,
  `data_aporte` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `moeda`
--

CREATE TABLE `moeda` (
  `id` int(11) NOT NULL,
  `moeda` varchar(200) NOT NULL,
  `cod_moeda_binance` varchar(200) NOT NULL,
  `link_logo` varchar(400) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `moeda_usuario`
--

CREATE TABLE `moeda_usuario` (
  `id` int(11) NOT NULL,
  `id_moeda` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `preco_medio` double(10,2) NOT NULL,
  `valor_total_investido` double(10,2) NOT NULL,
  `quantidade_total_moeda` double(10,4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `venda`
--

CREATE TABLE `venda` (
  `id` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `id_moeda` int(11) NOT NULL,
  `quantidade_moeda` double(10,4) NOT NULL,
  `preco_medio` double(10,2) NOT NULL,
  `preco_venda` double(10,2) NOT NULL,
  `lucro` double(10,4) NOT NULL,
  `lucro_porcentagem` double(10,2) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aporte`
--
ALTER TABLE `aporte`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_moeda` (`id_moeda`),
  ADD KEY `pk_usuario` (`id_usuario`);

--
-- Índices para tabela `moeda`
--
ALTER TABLE `moeda`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `moeda_usuario`
--
ALTER TABLE `moeda_usuario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pk_moeda_usuario` (`id_moeda`),
  ADD KEY `pk_usuario_moeda` (`id_usuario`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `venda`
--
ALTER TABLE `venda`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_moeda` (`id_moeda`),
  ADD KEY `fk_usuario` (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aporte`
--
ALTER TABLE `aporte`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `moeda`
--
ALTER TABLE `moeda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `moeda_usuario`
--
ALTER TABLE `moeda_usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `venda`
--
ALTER TABLE `venda`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aporte`
--
ALTER TABLE `aporte`
  ADD CONSTRAINT `pk_moeda` FOREIGN KEY (`id_moeda`) REFERENCES `moeda` (`id`),
  ADD CONSTRAINT `pk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `moeda_usuario`
--
ALTER TABLE `moeda_usuario`
  ADD CONSTRAINT `pk_moeda_usuario` FOREIGN KEY (`id_moeda`) REFERENCES `moeda` (`id`),
  ADD CONSTRAINT `pk_usuario_moeda` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);

--
-- Limitadores para a tabela `venda`
--
ALTER TABLE `venda`
  ADD CONSTRAINT `fk_moeda` FOREIGN KEY (`id_moeda`) REFERENCES `moeda` (`id`),
  ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usuario`) REFERENCES `usuario` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
