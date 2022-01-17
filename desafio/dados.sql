-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Jan-2022 às 21:44
-- Versão do servidor: 10.4.22-MariaDB
-- versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


-- ALTER USER 'root'@'localhost' IDENTIFIED WITH mysql_native_password BY 'root';
-- CREATE USER 'sa'@'localhost' IDENTIFIED WITH mysql_native_password BY 'sa';

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dados`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `conta`
--

CREATE TABLE `conta` (
  `idconta` int(11) NOT NULL,
  `saldo` float NOT NULL,
  `tipo` varchar(200) NOT NULL,
  `banco` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `conta`
--

INSERT INTO `conta` (`idconta`, `saldo`, `tipo`, `banco`) VALUES
(1, 1080, 'poupança', 'viacred'),
(3, 4100, 'carteira', 'caixa');

-- --------------------------------------------------------

--
-- Estrutura da tabela `despesas`
--

CREATE TABLE `despesas` (
  `iddespesa` int(11) NOT NULL,
  `valorDespesa` float NOT NULL,
  `dataPagamento` date NOT NULL,
  `dataEsperado` date NOT NULL,
  `tipoDespesa` varchar(200) NOT NULL,
  `id_banco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `despesas`
--

INSERT INTO `despesas` (`iddespesa`, `valorDespesa`, `dataPagamento`, `dataEsperado`, `tipoDespesa`, `id_banco`) VALUES
(16, 50, '2022-01-03', '2022-01-03', 'lazer', 3),
(17, 20, '2022-01-16', '2022-01-16', 'alimentação', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `receita`
--

CREATE TABLE `receita` (
  `idreceita` int(11) NOT NULL,
  `valorReceita` float NOT NULL,
  `dataRecebimento` date NOT NULL,
  `dataEsperado` date NOT NULL,
  `descrição` varchar(2000) NOT NULL,
  `id_banco` int(11) NOT NULL,
  `tipoReceita` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `receita`
--

INSERT INTO `receita` (`idreceita`, `valorReceita`, `dataRecebimento`, `dataEsperado`, `descrição`, `id_banco`, `tipoReceita`) VALUES
(12, 1000, '2022-01-05', '2022-01-05', 'Bom Trabalho', 1, 'premio'),
(13, 500, '2022-01-16', '1970-01-06', 'Feliz aniverdario', 3, 'presente');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `conta`
--
ALTER TABLE `conta`
  ADD PRIMARY KEY (`idconta`);

--
-- Índices para tabela `despesas`
--
ALTER TABLE `despesas`
  ADD PRIMARY KEY (`iddespesa`),
  ADD KEY `id_banco` (`id_banco`);

--
-- Índices para tabela `receita`
--
ALTER TABLE `receita`
  ADD PRIMARY KEY (`idreceita`),
  ADD KEY `id_banco` (`id_banco`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `conta`
--
ALTER TABLE `conta`
  MODIFY `idconta` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `despesas`
--
ALTER TABLE `despesas`
  MODIFY `iddespesa` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `receita`
--
ALTER TABLE `receita`
  MODIFY `idreceita` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `despesas`
--
ALTER TABLE `despesas`
  ADD CONSTRAINT `despesas_ibfk_1` FOREIGN KEY (`id_banco`) REFERENCES `conta` (`idconta`),
  ADD CONSTRAINT `despesas_ibfk_2` FOREIGN KEY (`id_banco`) REFERENCES `conta` (`idconta`);

--
-- Limitadores para a tabela `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `receita_ibfk_1` FOREIGN KEY (`id_banco`) REFERENCES `conta` (`idconta`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
