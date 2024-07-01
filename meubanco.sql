-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 22/06/2024 às 00:23
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
-- Banco de dados: `meubanco`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `NomeCompleto` varchar(80) NOT NULL,
  `DataNascimento` date DEFAULT NULL,
  `Sexo` enum('Masculino','Feminino','Outro') DEFAULT NULL,
  `NomeMaterno` varchar(255) DEFAULT NULL,
  `CPF` char(11) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `TelefoneCelular` varchar(20) DEFAULT NULL,
  `TelefoneFixo` varchar(20) DEFAULT NULL,
  `EnderecoCompleto` text DEFAULT NULL,
  `Login` varchar(6) NOT NULL,
  `Senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `NomeCompleto`, `DataNascimento`, `Sexo`, `NomeMaterno`, `CPF`, `Email`, `TelefoneCelular`, `TelefoneFixo`, `EnderecoCompleto`, `Login`, `Senha`) VALUES
(1, 'Master', '0000-00-00', 'Masculino', 'Master', '18882837777', 'admin@gmail.com', '22222222', NULL, '', 'admin', 'admin1');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CPF` (`CPF`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Login` (`Login`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;