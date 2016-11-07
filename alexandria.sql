-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: 08-Nov-2016 às 00:46
-- Versão do servidor: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `alexandria`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `editora`
--

CREATE TABLE IF NOT EXISTS `editora` (
`ID` int(11) NOT NULL,
  `nome` varchar(50) NOT NULL,
  `cnpj` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(255) NOT NULL,
  `logo` varchar(50) NOT NULL,
  `biografia` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `editora`
--

INSERT INTO `editora` (`ID`, `nome`, `cnpj`, `email`, `senha`, `logo`, `biografia`) VALUES
(1, 'Teste', 0, 'editora01@gmail.com', '$2y$10$j2eSNXiEFG2i.sm4UamjPu2cgRDG4UYKDzIib4kQLX51iavgOQwFK', '2016.10.26-09.44.11.png', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam convallis augue quam, et tincidunt ex pretium ac. Curabitur placerat risus enim, vel condimentum orci pretium quis. Duis bibendum sapien eu erat ultrices, non fringilla diam porttitor. Cras ut sapien sed tellus interdum tempor. Donec mi orci, egestas ac condimentum non, imperdiet quis justo. Mauris ut ligula dolor. Aliquam erat volutpat. Vestibulum non lacus accumsan, scelerisque massa et, sagittis lorem. Quisque iaculis, risus ac tincidunt finibus, magna risus varius lorem, eu congue neque tortor sit amet risus. Sed euismod lobortis dictum.');

-- --------------------------------------------------------

--
-- Estrutura da tabela `escritor`
--

CREATE TABLE IF NOT EXISTS `escritor` (
`ID` int(11) NOT NULL,
  `nome` varchar(40) NOT NULL,
  `cpf` double NOT NULL,
  `email` varchar(40) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `fotoPerfil` varchar(100) NOT NULL,
  `biografia` text
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `escritor`
--

INSERT INTO `escritor` (`ID`, `nome`, `cpf`, `email`, `senha`, `fotoPerfil`, `biografia`) VALUES
(10, 'AndrÃ© LuÃ­s', 44152146818, 'andreluisflor@live.com', '$2y$10$jk4hzoRWkULrWDYL/R4.xeTMdEBE6/6PvpoZii26IyJdZLv5DuHze', 'Doctorwho_50th-anniversary-thumbnail_01.jpg', 'lorem ipsum'),
(45, 'Nicolas Cage', 12345678901, 'nicolascage@gmail.com', '$2y$10$j2eSNXiEFG2i.sm4UamjPu2cgRDG4UYKDzIib4kQLX51iavgOQwFK', '2016.10.25-11.26.51.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed euismod sed elit eget aliquam. Cras ac pretium odio, vitae laoreet mi. Mauris eleifend facilisis est vel mollis. Suspendisse pretium dui non nibh auctor tempus. Pellentesque id placerat ligula, a hendrerit turpis. Ut eget leo odio. Sed pulvinar tortor libero, eu viverra velit commodo sit amet.  Maecenas pellentesque, neque vitae fermentum vestibulum, risus magna fringilla magna, sit amet interdum tellus enim at augue. Phasellus at egestas risus. Ut elementum varius eros non pretium. Aenean molestie pretium ornare. Aenean eget justo quis turpis facilisis mollis. Praesent porta, sem nec vestibulum vestibulum, augue urna dignissim nibh, sed bibendum purus lectus varius orci. Sed placerat enim nec diam sagittis suscipit. Maecenas accumsan lectus pretium, hendrerit augue eu, tincidunt lectus. Sed eget lectus sodales, venenatis massa ac, lacinia felis. Vivamus consequat odio ac ligula imperdiet, dignissim pretium tellus tincidunt. Suspendisse dictum risus tellus, vel pretium arcu placerat sit amet. Quisque mi augue, fringilla non lacinia non, cursus sit amet sem.'),
(57, 'abcde', 12345678903, 'abcde@gmail.com', '$2y$10$w0SJW/On2Dbxkgq7Lo0slOvzREQVaq3hnsOttDzJEBPA7Tg2Li8/u', 'tumblr_m3fc1bghyt1rq84v4o1_1280.png', NULL),
(58, 'Nicolas Cage 2', 53336160359, 'nicolascage2@gmail.com', '$2y$10$1qPww3vnX5uuta57/azCH.aRI3Wgjz/gcxrUxOMLVSDyf2km01tfW', 'nicolas-cage.jpg', NULL),
(59, 'Nicolas Cage 3', 81503920682, 'nicolascage3@gmail.com', '$2y$10$Hcq3/.TGZz14VgpP.wJsUO2u.iOYyXutSk6f5jDSn1Fpk4Q5f9i.a', 'nicolas-cage.jpg', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `obraescritor`
--

CREATE TABLE IF NOT EXISTS `obraescritor` (
`id` int(11) NOT NULL,
  `idObra` int(11) NOT NULL,
  `idEscritor` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `obraescritor`
--

INSERT INTO `obraescritor` (`id`, `idObra`, `idEscritor`) VALUES
(1, 49, 10),
(2, 49, 45),
(3, 109, 57),
(4, 110, 45),
(5, 110, 45),
(6, 119, 45);

-- --------------------------------------------------------

--
-- Estrutura da tabela `obras`
--

CREATE TABLE IF NOT EXISTS `obras` (
`id` int(11) NOT NULL,
  `titulo` text NOT NULL,
  `caminho` text NOT NULL,
  `idTag` int(11) NOT NULL,
  `descricao` text NOT NULL,
  `pgDisp` int(11) NOT NULL,
  `pgTotal` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=120 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `obras`
--

INSERT INTO `obras` (`id`, `titulo`, `caminho`, `idTag`, `descricao`, `pgDisp`, `pgTotal`) VALUES
(49, 'NICOLAS MOTHERFUCKING CAGE', '20000 Leguas Submarinas - Julio Verne.pdf', 4, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Morbi sed felis non turpis pellentesque lobortis. Morbi id massa sit amet lorem bibendum facilisis. Cras arcu dolor, tempor id bibendum nec, feugiat id purus. Duis nec sem quis ante ullamcorper tempor. Donec aliquet dictum nibh, quis fringilla diam feugiat in. Phasellus vulputate, massa non volutpat varius, sem turpis dignissim ipsum, at cursus metus purus vel odio. Nunc varius neque eget ultricies fringilla. Maecenas cursus odio vestibulum, eleifend magna quis, tempor nisi. Nulla neque quam, pulvinar quis lacus at, maximus porta quam. In hac habitasse platea dictumst.', 244, 500),
(109, '123', '4520000 Leguas Submarinas - Julio Verne.pdf', 1, '123', 122, 123),
(110, '1234', '4520000 Leguas Submarinas - Julio Verne.pdf', 1, '1234', 1234, 1234),
(111, 'asdasdsad', '2016.10.10-14.44.19.odp', 1, '0', 134, 456),
(112, 'asdasd', '2016.10.10-14.44.59.odp', 1, '0', 123, 456),
(113, 'asdasds', '2016.10.10-14.47.20.odp', 1, '0', 1234, 4567),
(114, 'asdsads', '2016.10.10-14.49.27.odp', 1, '0', 1234, 456),
(115, 'asdasd', '2016.10.10-14.52.00', 3, '0', 123, 456),
(116, '3132134', '2016.10.10-14.55.04.odp', 1, '0', 123, 456),
(117, '1234', '2016.10.10-14.58.44.odp', 1, '0', 123, 456),
(118, '1234', '2016.10.10-15.09.29.odp', 1, '0', 1234, 5678),
(119, 'asdasdasddasd', '2016.10.10-15.13.04.odp', 1, '0', 1234, 5679);

-- --------------------------------------------------------

--
-- Estrutura da tabela `obrasaprovadas`
--

CREATE TABLE IF NOT EXISTS `obrasaprovadas` (
`id` int(11) NOT NULL,
  `idObra` int(11) NOT NULL,
  `idEditora` int(11) NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `obrasaprovadas`
--

INSERT INTO `obrasaprovadas` (`id`, `idObra`, `idEditora`) VALUES
(3, 48, 1),
(4, 109, 1),
(5, 109, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
`id` int(11) NOT NULL,
  `tag` text NOT NULL
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `tags`
--

INSERT INTO `tags` (`id`, `tag`) VALUES
(1, 'Romance'),
(3, 'Ficção'),
(4, 'Ficção Científica'),
(5, 'Não-Ficção'),
(6, 'Humor'),
(7, 'Terror'),
(8, 'Mistério'),
(9, 'Religioso');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `editora`
--
ALTER TABLE `editora`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `escritor`
--
ALTER TABLE `escritor`
 ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `obraescritor`
--
ALTER TABLE `obraescritor`
 ADD PRIMARY KEY (`id`), ADD KEY `idObra` (`idObra`,`idEscritor`), ADD KEY `idEscritor` (`idEscritor`), ADD KEY `idObra_2` (`idObra`), ADD KEY `idEscritor_2` (`idEscritor`), ADD KEY `idObra_3` (`idObra`), ADD KEY `idEscritor_3` (`idEscritor`);

--
-- Indexes for table `obras`
--
ALTER TABLE `obras`
 ADD PRIMARY KEY (`id`), ADD KEY `idTag` (`idTag`);

--
-- Indexes for table `obrasaprovadas`
--
ALTER TABLE `obrasaprovadas`
 ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tags`
--
ALTER TABLE `tags`
 ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `editora`
--
ALTER TABLE `editora`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `escritor`
--
ALTER TABLE `escritor`
MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=60;
--
-- AUTO_INCREMENT for table `obraescritor`
--
ALTER TABLE `obraescritor`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT for table `obras`
--
ALTER TABLE `obras`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=120;
--
-- AUTO_INCREMENT for table `obrasaprovadas`
--
ALTER TABLE `obrasaprovadas`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `tags`
--
ALTER TABLE `tags`
MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=10;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
