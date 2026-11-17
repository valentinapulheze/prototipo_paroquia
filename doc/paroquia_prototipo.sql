-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02/11/2026 às 17:34
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
-- Banco de dados: `paroquia_prototipo`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id_agendamento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora_inicial` time NOT NULL,
  `hora_final` time NOT NULL,
  `detalhamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `avisos`
--

CREATE TABLE `avisos` (
  `id_aviso` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `detalhamento` varchar(100) NOT NULL,
  `mensagem` text DEFAULT NULL,
  `categoria` enum('missa','evento','pastoral','geral') NOT NULL DEFAULT 'geral',
  `destaque` int(11) NOT NULL DEFAULT 0,
  `data_expiracao` date DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT current_timestamp(),
  `atualizado_em` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `avisos`
--

INSERT INTO `avisos` (`id_aviso`, `id_usuario`, `titulo`, `detalhamento`, `mensagem`, `categoria`, `destaque`, `data_expiracao`, `criado_em`, `atualizado_em`, `status`) VALUES
(0, 1, 'Missa de domingo', 'Missas às 7h, 9h e 19h na Matriz.', 'Missas às 7h, 9h e 19h na Matriz.', 'geral', 0, NULL, '2026-10-26 20:23:11', '2026-10-26 20:23:11', 'ativo'),
(2, 1, 'teste', 'teste', 'teste, teste', 'evento', 1, '2026-10-16', '2026-11-02 14:37:09', '2026-11-02 14:37:09', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura para tabela `disponibilidade_agendamento`
--

CREATE TABLE `disponibilidade_agendamento` (
  `id_disponibilidade` int(11) NOT NULL,
  `data` date NOT NULL,
  `hora_inicial` time NOT NULL,
  `hora_final` time NOT NULL,
  `status` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `dizimos`
--

CREATE TABLE `dizimos` (
  `id_dizimo` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int(11) NOT NULL,
  `nome_fantasia` varchar(150) NOT NULL,
  `razao_social` varchar(180) NOT NULL,
  `cnpj` varchar(20) NOT NULL,
  `inscricao_estadual` varchar(30) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telefone` varchar(30) NOT NULL,
  `whatsapp` varchar(30) NOT NULL,
  `cep` varchar(10) NOT NULL,
  `rua` varchar(180) NOT NULL,
  `numero` varchar(20) NOT NULL,
  `complemento` varchar(100) NOT NULL,
  `bairro` varchar(100) NOT NULL,
  `cidade` varchar(100) NOT NULL,
  `uf` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Estrutura para tabela `lojas`
--

CREATE TABLE `lojas` (
  `id_loja` int(11) NOT NULL,
  `id_usuario` int(11) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `preco` int(11) NOT NULL,
  `foto` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `lojas`
--

INSERT INTO `lojas` (`id_loja`, `id_usuario`, `titulo`, `preco`, `foto`) VALUES
(2, 1, 'teste', 0, 'img/lojinha/produto_6ae8b8a309b0a1.28351952.png');

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int(11) NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(18) NOT NULL,
  `tipo_acesso` varchar(45) NOT NULL,
  `senha` varchar(225) NOT NULL,
  `foto` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `telefone`, `tipo_acesso`, `senha`, `foto`) VALUES
(1, 'Julia Lopes de Souza', 'julia.souza49@portalsesisp.org.br', '18991030052', '0', '$2y$10$PmsTllXk3F2OfWG6WhDoZeRsBpBbYYGP4WtzSMG1WbHSWEEt4qUqe', ''),
(2, 'cliente', 'cliente@email', '18995658739', '1', '$2y$10$PmsTllXk3F2OfWG6WhDoZeRsBpBbYYGP4WtzSMG1WbHSWEEt4qUqe', '');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `fk_agendamentos_usuarios_idx` (`id_usuario`);

--
-- Índices de tabela `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id_aviso`),
  ADD KEY `fk_avisos_usuarios1_idx` (`id_usuario`);

--
-- Índices de tabela `disponibilidade_agendamento`
--
ALTER TABLE `disponibilidade_agendamento`
  ADD PRIMARY KEY (`id_disponibilidade`);

--
-- Índices de tabela `dizimos`
--
ALTER TABLE `dizimos`
  ADD PRIMARY KEY (`id_dizimo`),
  ADD KEY `fk_dizimos_usuarios1_idx` (`id_usuario`);

--
-- Índices de tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices de tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `fk_eventos_usuarios1_idx` (`id_usuario`);

--
-- Índices de tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id_loja`),
  ADD KEY `fk_lojas_usuarios1_idx` (`id_usuario`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `uq_usuarios_email` (`email`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id_agendamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id_aviso` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `disponibilidade_agendamento`
--
ALTER TABLE `disponibilidade_agendamento`
  MODIFY `id_disponibilidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dizimos`
--
ALTER TABLE `dizimos`
  MODIFY `id_dizimo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id_loja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `fk_agendamentos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `fk_avisos_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `dizimos`
--
ALTER TABLE `dizimos`
  ADD CONSTRAINT `fk_dizimos_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_eventos_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Restrições para tabelas `lojas`
--
ALTER TABLE `lojas`
  ADD CONSTRAINT `fk_lojas_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
