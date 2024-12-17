-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 09/12/2023 às 15:50
-- Versão do servidor: 10.4.28-MariaDB
-- Versão do PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `floricultura`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `cliente`
--

CREATE TABLE `cliente` (
  `id` int(11) NOT NULL,
  `nome` varchar(80) NOT NULL,
  `datanasc` date NOT NULL,
  `email` varchar(140) NOT NULL,
  `senha` varchar(60) NOT NULL,
  `adm` int(10) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `cliente`
--

INSERT INTO `cliente` (`id`, `nome`, `datanasc`, `email`, `senha`, `adm`) VALUES
(1, 'Rick Sanchez', '2017-04-05', 'rick123@gmail.com', 'Rick123', 1),
(15, 'Jorge o bagre', '2010-10-10', 'foi@pescar.com', 'tiago123', 0),
(16, 'Andre', '2023-09-13', 'andrezin@gmail.com', 'andre123', 0),
(18, 'Jader', '2019-05-24', 'jd@gmail.com', 'jd00', 0),
(19, 'Natalia Bostinha', '2023-11-08', 'fedidinha@gmail.com', '123456', 0),
(22, 'Super Mascara', '2010-10-10', 'mister@mascara.com', 'mmaker123321', 0),
(30, 'Cripto Teste', '2023-10-03', 'cripto@gmail.com', 'énoixx', 0),
(31, 'cripto2', '2023-12-07', 'oi@gmail.com', '$2y$10$bt17AN0vmuBCk.Dvmvs1IeAOXEGRhoOE9eoUcJ9V2bZtJqbX/mJT6', 0),
(32, 'vapo', '2023-09-04', 'vapoooooo@gamil', '$2y$10$AaqO2tVSF6g8/6WfYVbGAe/AN0s2oyFZRgnBeWliCxVWrWCjPMijy', 0),
(33, 'manooooo', '2023-11-26', 'maninho', '$2y$10$j.yYvDBoKfCHGFts06hihONUy.euKD2nc92FKIJK6kLPSkyR6yavC', 0),
(34, 'seriao', '2023-10-03', 'serio@gmail.com', '$2y$10$kU2X.PiRleonqU5ntLzI7.BqFrRX6JPdvx.0ywCEnJudGt61BeXv2', 0),
(35, 'Tinhoso', '2023-05-01', 'tinhoso@gmail.com', '$2y$10$ddPz/tXEYFDSAfNizVaSQ.7ewq84VYeGSX8bDWepVLj6tGDyACJ/O', 0),
(36, 'adm', '2023-08-07', 'souadm@gmail.com', '$2y$10$boBvoix9DDIkPKb/FS9zkeuk0ClgNlQ/4RPgfaQkHwGQP4tvPuKQm', 1),
(37, 'TesteOficial', '2022-05-09', 'sao2damanha@gmail.com', '$2y$10$aNcE4ncYV32J7uS4Da5tgutIejDTTOPEmHlAY9NakteRvQq/mNWwO', 0),
(38, 'Barbie Girl', '2023-10-02', 'barbie@gmail.com', '$2y$10$BVWGV4g.znGMkgo1v07Vde0gVS/6WtOBl/YJWQV9YLirAUArHJJ7u', 0),
(39, 'joaozinho', '2007-05-29', 'joao@gmail.com', '$2y$10$XE2FdO8iLVZ2jfM2CgLrweFQnKfLTDVFad7VRiTVfw8gE4AKGxxc6', 1),
(40, 'Mosca', '2018-11-09', 'mosquinha@gmail.com', '$2y$10$8UL3UiFdrfAn3VPl9yDuSO3YsxpFHAdNXcf/7wXYZHbYMB.a4VCtK', 0),
(41, 'Claudia A Raia', '2019-10-31', 'raianna@gmail.com', '$2y$10$z/v8PhvSTZSJoAR2ItX8SOhzdyWTrqGV/yVMdTCbDGmoeRtmWSiFu', 0);

-- --------------------------------------------------------

--
-- Estrutura para tabela `ferramenta`
--

CREATE TABLE `ferramenta` (
  `id` int(11) NOT NULL,
  `nome_ferramenta` varchar(40) NOT NULL,
  `uso` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `ferramenta`
--

INSERT INTO `ferramenta` (`id`, `nome_ferramenta`, `uso`) VALUES
(2, 'arador', 'arar a terra'),
(3, 'foice', 'cavar tumulos'),
(9, 'enxada', 'carpir'),
(17, 'adubador', 'adubar'),
(18, 'cefador', 'ceifa a vida das plantas');

-- --------------------------------------------------------

--
-- Estrutura para tabela `planta`
--

CREATE TABLE `planta` (
  `id` int(11) NOT NULL,
  `nome` varchar(60) NOT NULL,
  `nomecientifico` varchar(80) NOT NULL,
  `preco` float NOT NULL,
  `cor` varchar(30) NOT NULL,
  `donoid` int(11) DEFAULT NULL,
  `ferramentaid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `planta`
--

INSERT INTO `planta` (`id`, `nome`, `nomecientifico`, `preco`, `cor`, `donoid`, `ferramentaid`) VALUES
(8, 'rosa', 'rosalius', 100, 'vermeio', NULL, 2),
(11, 'lopan', 'loppp', 45, 'amarelo', 16, 2),
(12, 'Margarida', 'marrida', 56.6, 'branco', 37, 3),
(13, 'girassol', 'girassolius', 23, 'amarelo', NULL, 3),
(14, 'Cacto', 'Cactaceae', 34, 'verde', 30, 3),
(21, 'Tulipas Vermelhas', 'tulipax red', 34, 'Vermelha', 19, 3),
(24, 'Figueira', 'Ficus', 33.55, 'laranja', NULL, 17),
(25, 'Figueira', 'Ficus', 33.55, 'laranja', NULL, 17),
(1053, 'Grama', 'gramius', 30, 'roxa', 15, 9),
(1056, 'Palmeiras', 'Sem mundial', 90.99, 'verde', NULL, 18),
(1057, 'Lavanda', 'lavandex', 79, 'roxa', NULL, 2),
(1058, 'Espada-de-são-jorge', 'espadammm', 110, 'Verde', NULL, 2),
(1061, 'plantinha', 'plantona', 98, 'pink', 39, 9),
(1062, 'plantinha', 'plantona', 98, 'pink', NULL, 9),
(1063, 'plantinha', 'plantona', 98, 'pink', NULL, 9),
(1064, 'samambaia', 'samba', 45.99, 'verde', NULL, 2),
(1065, 'samambaia', 'samba', 45.99, 'verde', NULL, 2),
(1066, 'samambaia', 'samba', 45.99, 'verde', NULL, 2);

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `cliente`
--
ALTER TABLE `cliente`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Índices de tabela `ferramenta`
--
ALTER TABLE `ferramenta`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome_ferramenta` (`nome_ferramenta`);

--
-- Índices de tabela `planta`
--
ALTER TABLE `planta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk ferramentaid` (`ferramentaid`),
  ADD KEY `nomecientifico` (`nomecientifico`) USING BTREE;

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cliente`
--
ALTER TABLE `cliente`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT de tabela `ferramenta`
--
ALTER TABLE `ferramenta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT de tabela `planta`
--
ALTER TABLE `planta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1068;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
