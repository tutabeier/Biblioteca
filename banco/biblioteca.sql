-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: Set 19, 2011 as 05:10 
-- Versão do Servidor: 5.5.8
-- Versão do PHP: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `biblioteca`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE IF NOT EXISTS `livros` (
  `idlivros` int(11) NOT NULL AUTO_INCREMENT,
  `titulo` varchar(50) NOT NULL,
  `autor` varchar(50) NOT NULL,
  `ano` int(4) NOT NULL,
  `editora` varchar(30) NOT NULL,
  `suarios_idusuarios` int(11) NOT NULL,
  PRIMARY KEY (`idlivros`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`idlivros`, `titulo`, `autor`, `ano`, `editora`, `suarios_idusuarios`) VALUES
(14, 'Dom Casmurro', 'Machado de Assis', 0, '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

CREATE TABLE IF NOT EXISTS `usuarios` (
  `idusuarios` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `login` varchar(20) NOT NULL,
  `privilegio` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(50) NOT NULL,
  PRIMARY KEY (`idusuarios`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `usuarios`
--

