-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 26-Jun-2022 às 17:05
-- Versão do servidor: 8.0.17
-- versão do PHP: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `ebfinance`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimento`
--

CREATE TABLE `movimento` (
  `id_movimento` int(11) NOT NULL,
  `descricao` varchar(100) NOT NULL,
  `data` date NOT NULL,
  `tipo` char(7) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `valor` decimal(10,2) NOT NULL,
  `forma_pagamento` varchar(100) NOT NULL,
  `categoria` varchar(100) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `id_usuario_movimento` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL,
  `usuario` varchar(150) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `nome` varchar(255) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `formas_pagamento` varchar(4000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '[{"pagamento":"Boleto"},{"pagamento":"Cartão de Crédito"},{"pagamento":"Cartão de Débito"},{"pagamento":"Dinheiro"},{"pagamento":"Pix"},{"pagamento":"Saldo"},{"pagamento":"Transferência"}]',
  `categorias` varchar(4000) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT '[{"tipo":"receita","categoria":"Aluguel"},{"tipo":"receita","categoria":"Investimentos/Juros"},{"tipo":"receita","categoria":"Investimentos/Rendimentos"},{"tipo":"receita","categoria":"Lucros"},{"tipo":"receita","categoria":"Outras Receitas"},{"tipo":"receita","categoria":"Pró-labore"},{"tipo":"receita","categoria":"Salário"},{"tipo":"despesa","categoria":"Automóvel"},{"tipo":"despesa","categoria":"Bem Estar"},{"tipo":"despesa","categoria":"Educação"},{"tipo":"despesa","categoria":"Empréstimo"},{"tipo":"despesa","categoria":"Impostos e Tarifas"},{"tipo":"despesa","categoria":"Investimentos"},{"tipo":"despesa","categoria":"Lazer"},{"tipo":"despesa","categoria":"Moradia"},{"tipo":"despesa","categoria":"Outras Despesas"},{"tipo":"despesa","categoria":"Pessoais"},{"tipo":"despesa","categoria":"Previdência"},{"tipo":"despesa","categoria":"Saúde"},{"tipo":"despesa","categoria":"Seguros"},{"tipo":"despesa","categoria":"Telefonia"}]'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `usuario`, `nome`, `senha`, `formas_pagamento`, `categorias`) VALUES
(1, 'Admin', 'Administrador', '21232f297a57a5a743894a0e4a801fc3', '[{\"pagamento\":\"Boleto\"},{\"pagamento\":\"Cartão de Crédito\"},{\"pagamento\":\"Cartão de Débito\"},{\"pagamento\":\"Dinheiro\"},{\"pagamento\":\"Pix\"},{\"pagamento\":\"Transferência\"}]', '[{\"tipo\":\"receita\",\"categoria\":\"Investimentos\\/Juros\"},{\"tipo\":\"receita\",\"categoria\":\"Investimentos\\/Rendimentos\"},{\"tipo\":\"receita\",\"categoria\":\"Lucros\"},{\"tipo\":\"receita\",\"categoria\":\"Outras Receitas\"},{\"tipo\":\"receita\",\"categoria\":\"Pró-labore\"},{\"tipo\":\"receita\",\"categoria\":\"Salário\"},{\"tipo\":\"despesa\",\"categoria\":\"Automóvel\"},{\"tipo\":\"despesa\",\"categoria\":\"Educação\"},{\"tipo\":\"despesa\",\"categoria\":\"Empréstimo\"},{\"tipo\":\"despesa\",\"categoria\":\"Impostos e Tarifas\"},{\"tipo\":\"despesa\",\"categoria\":\"Investimentos\"},{\"tipo\":\"despesa\",\"categoria\":\"Lazer\"},{\"tipo\":\"despesa\",\"categoria\":\"Moradia\"},{\"tipo\":\"despesa\",\"categoria\":\"Outras Despesas\"},{\"tipo\":\"despesa\",\"categoria\":\"Pessoais\"},{\"tipo\":\"despesa\",\"categoria\":\"Previdência\"},{\"tipo\":\"despesa\",\"categoria\":\"Saúde\"},{\"tipo\":\"despesa\",\"categoria\":\"Seguros\"},{\"tipo\":\"despesa\",\"categoria\":\"Telefonia\"}]');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `movimento`
--
ALTER TABLE `movimento`
  ADD PRIMARY KEY (`id_movimento`),
  ADD KEY `id_usuario_movimento` (`id_usuario_movimento`);

--
-- Índices para tabela `usuario`
--
ALTER TABLE `usuario`
  ADD PRIMARY KEY (`id_usuario`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `movimento`
--
ALTER TABLE `movimento`
  MODIFY `id_movimento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `usuario`
--
ALTER TABLE `usuario`
  MODIFY `id_usuario` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `movimento`
--
ALTER TABLE `movimento`
  ADD CONSTRAINT `movimento_ibfk_3` FOREIGN KEY (`id_usuario_movimento`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
