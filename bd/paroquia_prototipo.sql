-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: p:127.0.0.1
-- Tempo de geração: 10-Nov-2026 às 19:07
-- Versão do servidor: 8.0.33
-- versão do PHP: 8.2.0

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
-- Estrutura da tabela `agendamentos`
--

CREATE TABLE `agendamentos` (
  `id_agendamento` int NOT NULL,
  `id_usuario` int NOT NULL,
  `data` date NOT NULL,
  `hora_inicial` time NOT NULL,
  `hora_final` time NOT NULL,
  `detalhamento` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `agendamentos`
--

INSERT INTO `agendamentos` (`id_agendamento`, `id_usuario`, `data`, `hora_inicial`, `hora_final`, `detalhamento`) VALUES
(1, 2, '2026-11-12', '14:00:00', '15:00:00', 'Confissão'),
(2, 2, '2026-11-11', '14:00:00', '15:00:00', 'Confissão');

-- --------------------------------------------------------

--
-- Estrutura da tabela `avisos`
--

CREATE TABLE `avisos` (
  `id_aviso` int NOT NULL,
  `id_usuario` int NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `foto` text NOT NULL,
  `detalhamento` varchar(100) NOT NULL,
  `mensagem` text,
  `categoria` enum('missa','evento','pastoral','geral') NOT NULL DEFAULT 'geral',
  `destaque` int NOT NULL DEFAULT '0',
  `data_expiracao` date DEFAULT NULL,
  `criado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `atualizado_em` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `status` varchar(10) NOT NULL DEFAULT 'ativo'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `avisos`
--

INSERT INTO `avisos` (`id_aviso`, `id_usuario`, `titulo`, `foto`, `detalhamento`, `mensagem`, `categoria`, `destaque`, `data_expiracao`, `criado_em`, `atualizado_em`, `status`) VALUES
(0, 1, 'Missa de domingo', '', 'Missas às 7h, 9h e 19h na Matriz.', 'Missas às 7h, 9h e 19h na Matriz.', 'geral', 0, NULL, '2026-10-26 20:23:11', '2026-10-26 20:23:11', 'ativo'),
(2, 1, 'Biblia', 'img/avisos/aviso_6aec9d74b54d61.28520789.jpg', 'missa levar', NULL, 'missa', 1, '2026-11-06', '2026-11-02 14:37:09', '2026-11-05 15:15:00', 'ativo'),
(3, 1, 'Agendamento de Confissão', 'img/avisos/aviso_6af3228e374e19.06899263.png', 'Agendar seu horário', 'Dia 12/11/2026 Na igreja matriz', 'geral', 1, '2026-11-14', '2026-11-10 13:56:35', '2026-11-10 13:56:35', 'ativo');

-- --------------------------------------------------------

--
-- Estrutura da tabela `disponibilidade_agendamento`
--

CREATE TABLE `disponibilidade_agendamento` (
  `id_disponibilidade` int NOT NULL,
  `data` date NOT NULL,
  `hora_inicial` time NOT NULL,
  `hora_final` time NOT NULL,
  `status` int NOT NULL,
  `id_usuario` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dizimos`
--

CREATE TABLE `dizimos` (
  `id_dizimo` int NOT NULL,
  `id_usuario` int NOT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresas`
--

CREATE TABLE `empresas` (
  `id_empresa` int NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `eventos`
--

CREATE TABLE `eventos` (
  `id_evento` int NOT NULL,
  `id_usuario` int NOT NULL,
  `tipo` varchar(45) NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `foto` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lojas`
--

CREATE TABLE `lojas` (
  `id_loja` int NOT NULL,
  `id_usuario` int NOT NULL,
  `titulo` varchar(45) NOT NULL,
  `preco` int NOT NULL,
  `foto` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `lojas`
--

INSERT INTO `lojas` (`id_loja`, `id_usuario`, `titulo`, `preco`, `foto`, `ativo`) VALUES
(2, 1, 'Nossa Senhora Aparecida', 12, 'img/lojinha/produto_6aec9ca5b96fd5.15606212.jpg', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `id_usuario` int NOT NULL,
  `nome` varchar(45) NOT NULL,
  `email` varchar(50) NOT NULL,
  `telefone` varchar(18) NOT NULL,
  `tipo_acesso` varchar(45) NOT NULL,
  `senha` varchar(225) NOT NULL,
  `foto` text NOT NULL,
  `ativo` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id_usuario`, `nome`, `email`, `telefone`, `tipo_acesso`, `senha`, `foto`, `ativo`) VALUES
(1, 'Julia Lopes de Souza', 'julia.souza49@portalsesisp.org.br', '18991030052', '0', '$2y$10$PmsTllXk3F2OfWG6WhDoZeRsBpBbYYGP4WtzSMG1WbHSWEEt4qUqe', '', 1),
(2, 'cliente', 'cliente@email', '18995658739', '1', '$2y$10$PmsTllXk3F2OfWG6WhDoZeRsBpBbYYGP4WtzSMG1WbHSWEEt4qUqe', '', 1);

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD PRIMARY KEY (`id_agendamento`),
  ADD KEY `fk_agendamentos_usuarios_idx` (`id_usuario`);

--
-- Índices para tabela `avisos`
--
ALTER TABLE `avisos`
  ADD PRIMARY KEY (`id_aviso`),
  ADD KEY `fk_avisos_usuarios1_idx` (`id_usuario`);

--
-- Índices para tabela `disponibilidade_agendamento`
--
ALTER TABLE `disponibilidade_agendamento`
  ADD PRIMARY KEY (`id_disponibilidade`);

--
-- Índices para tabela `dizimos`
--
ALTER TABLE `dizimos`
  ADD PRIMARY KEY (`id_dizimo`),
  ADD KEY `fk_dizimos_usuarios1_idx` (`id_usuario`);

--
-- Índices para tabela `empresas`
--
ALTER TABLE `empresas`
  ADD PRIMARY KEY (`id_empresa`);

--
-- Índices para tabela `eventos`
--
ALTER TABLE `eventos`
  ADD PRIMARY KEY (`id_evento`),
  ADD KEY `fk_eventos_usuarios1_idx` (`id_usuario`);

--
-- Índices para tabela `lojas`
--
ALTER TABLE `lojas`
  ADD PRIMARY KEY (`id_loja`),
  ADD KEY `fk_lojas_usuarios1_idx` (`id_usuario`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id_usuario`),
  ADD UNIQUE KEY `uq_usuarios_email` (`email`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  MODIFY `id_agendamento` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `avisos`
--
ALTER TABLE `avisos`
  MODIFY `id_aviso` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `disponibilidade_agendamento`
--
ALTER TABLE `disponibilidade_agendamento`
  MODIFY `id_disponibilidade` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `dizimos`
--
ALTER TABLE `dizimos`
  MODIFY `id_dizimo` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `eventos`
--
ALTER TABLE `eventos`
  MODIFY `id_evento` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lojas`
--
ALTER TABLE `lojas`
  MODIFY `id_loja` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id_usuario` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `agendamentos`
--
ALTER TABLE `agendamentos`
  ADD CONSTRAINT `fk_agendamentos_usuarios` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `avisos`
--
ALTER TABLE `avisos`
  ADD CONSTRAINT `fk_avisos_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `dizimos`
--
ALTER TABLE `dizimos`
  ADD CONSTRAINT `fk_dizimos_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `eventos`
--
ALTER TABLE `eventos`
  ADD CONSTRAINT `fk_eventos_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);

--
-- Limitadores para a tabela `lojas`
--
ALTER TABLE `lojas`
  ADD CONSTRAINT `fk_lojas_usuarios1` FOREIGN KEY (`id_usuario`) REFERENCES `usuarios` (`id_usuario`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
