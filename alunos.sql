-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 30-Mar-2021 às 01:10
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `alunos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `aluno`
--

CREATE TABLE `aluno` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `data_nascimento` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `curso_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `aluno`
--

INSERT INTO `aluno` (`id`, `name`, `data_nascimento`, `email`, `curso_id`) VALUES
(1, 'Daniel Lima Fortes', '12/02/2001', 'daniel@email.com.br', 12),
(2, 'Catharina2', '12/12/1212', 'cath@cath.com', 12),
(3, 'Esquisito1', '05/01/1500', 'esquisitinho@gmail.com', 13),
(4, 'garoto de programa(ção)', '04/12/2000', 'uiuiui@uol.com', 14),
(5, 'Vini Cadu', '00/00/0000', 'gabrielOpensador@pensa.com', 12),
(6, 'Vini Garcia', '22/12/2222', 'maromba@omaromba.com', 15),
(8, 'Nome22', '12/02/2022', 'seila2@seila.com', 14);

-- --------------------------------------------------------

--
-- Estrutura da tabela `curso`
--

CREATE TABLE `curso` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `duracao` double NOT NULL,
  `sigla` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `curso`
--

INSERT INTO `curso` (`id`, `nome`, `description`, `duracao`, `sigla`) VALUES
(12, 'Sistemas para Internet', 'Sistemas para internet, desenvolvimento web, devops e php', 2, '1TINR'),
(13, 'Engenharia Mecatrônica', 'Matematica e afins', 4, 'EMM2'),
(14, 'Marketing Digital', 'Photoshop, Illustrator e tecnicas.', 2, 'MDG1'),
(15, 'Curso de ser lindo', 'Só os docinhoss', 2, 'LINDOS');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `aluno`
--
ALTER TABLE `aluno`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_aluno_cursos` (`curso_id`);

--
-- Índices para tabela `curso`
--
ALTER TABLE `curso`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `aluno`
--
ALTER TABLE `aluno`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT de tabela `curso`
--
ALTER TABLE `curso`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `aluno`
--
ALTER TABLE `aluno`
  ADD CONSTRAINT `fk_aluno_cursos` FOREIGN KEY (`curso_id`) REFERENCES `curso` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
