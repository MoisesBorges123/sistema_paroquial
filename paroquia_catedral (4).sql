-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 31-Jul-2019 às 23:06
-- Versão do servidor: 10.3.16-MariaDB
-- versão do PHP: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `paroquia_catedral`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `batizado`
--

CREATE TABLE `batizado` (
  `id_batizado` int(11) NOT NULL,
  `batizando` int(11) NOT NULL,
  `data_batismo` date NOT NULL,
  `celebrante` int(11) NOT NULL,
  `local` int(11) NOT NULL,
  `folha` int(11) NOT NULL,
  `num_registro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `batizando`
--

CREATE TABLE `batizando` (
  `id_batizando` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `pai` varchar(255) NOT NULL,
  `mae` varchar(255) NOT NULL,
  `data_nasc` date NOT NULL,
  `padrinho` varchar(255) DEFAULT NULL,
  `madrinha` varchar(255) DEFAULT NULL,
  `sexo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `batizando_telefone`
--

CREATE TABLE `batizando_telefone` (
  `batizando` int(11) NOT NULL,
  `telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `casamentos`
--

CREATE TABLE `casamentos` (
  `id_casamento` int(11) NOT NULL,
  `noivo` int(11) NOT NULL,
  `noiva` int(11) NOT NULL,
  `data_casamento` date NOT NULL,
  `testemunha1` varchar(255) DEFAULT NULL,
  `testemunha2` varchar(255) DEFAULT NULL,
  `celebrante` int(11) NOT NULL,
  `local` int(11) NOT NULL,
  `num_registro` int(11) DEFAULT NULL,
  `folha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `catequese_inscricoes`
--

CREATE TABLE `catequese_inscricoes` (
  `id_inscricao` int(11) NOT NULL,
  `matricula_catequisando` int(11) NOT NULL,
  `catequista` int(11) NOT NULL,
  `dat_inicio` date NOT NULL,
  `dat_fim` date NOT NULL,
  `etapa` int(11) NOT NULL,
  `situacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `catequisando`
--

CREATE TABLE `catequisando` (
  `matricula_catequisado` int(11) NOT NULL,
  `catequisando` int(11) NOT NULL,
  `observacao` int(11) DEFAULT NULL,
  `pai` int(11) NOT NULL,
  `mae` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `catequista`
--

CREATE TABLE `catequista` (
  `id_catequista` int(11) NOT NULL,
  `formacao` text NOT NULL,
  `observacoes` varchar(300) NOT NULL,
  `etapa_favorita` int(11) NOT NULL,
  `componente_pastor` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clero`
--

CREATE TABLE `clero` (
  `id_clero` int(11) NOT NULL,
  `pessoa` int(11) NOT NULL,
  `carro` int(11) DEFAULT NULL,
  `titulo` int(11) NOT NULL,
  `observacao` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clero_igreja`
--

CREATE TABLE `clero_igreja` (
  `clero` int(11) NOT NULL,
  `igreja` int(11) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `componentes_pastorais`
--

CREATE TABLE `componentes_pastorais` (
  `id_componente` int(11) NOT NULL,
  `pessoa` int(11) NOT NULL,
  `pastoral` int(11) NOT NULL,
  `situacao` int(11) NOT NULL,
  `dat_entrada` date NOT NULL,
  `dat_saida` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comunidade`
--

CREATE TABLE `comunidade` (
  `id_comunidade` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` int(11) NOT NULL,
  `conselho` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conselho`
--

CREATE TABLE `conselho` (
  `id_conselho` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `d_inicio` date NOT NULL,
  `d_fim` date NOT NULL,
  `situacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `conselho_pessoa`
--

CREATE TABLE `conselho_pessoa` (
  `conselho` int(11) NOT NULL,
  `pessoa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `crisma`
--

CREATE TABLE `crisma` (
  `id_crisma` int(11) NOT NULL,
  `crismando` varchar(255) NOT NULL,
  `pai` varchar(255) NOT NULL,
  `mae` varchar(255) NOT NULL,
  `parinho` varchar(255) NOT NULL,
  `sexo_padrinho` int(11) NOT NULL,
  `catequista` int(11) NOT NULL,
  `data_crisma` datetime NOT NULL,
  `celebrante` int(11) NOT NULL,
  `folha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos`
--

CREATE TABLE `cursos` (
  `id_curso` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `objetivo` text DEFAULT NULL,
  `descricao` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cursos_ofertados`
--

CREATE TABLE `cursos_ofertados` (
  `id_curso_ofeta` int(11) NOT NULL,
  `cuso` int(11) NOT NULL,
  `ministrado_por` int(11) NOT NULL,
  `dat_inicio` datetime NOT NULL,
  `dat_fim` datetime NOT NULL,
  `certificado` tinyint(1) NOT NULL,
  `situacao` int(11) NOT NULL,
  `endereco` int(11) NOT NULL,
  `sala` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `devolucoes`
--

CREATE TABLE `devolucoes` (
  `id_devolucao` int(11) NOT NULL,
  `dizimista` int(11) NOT NULL,
  `data_dev` int(11) NOT NULL,
  `valor` int(11) NOT NULL,
  `ano_ref` int(11) NOT NULL,
  `mes_ref` int(11) NOT NULL,
  `local_dev` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `dizimistas`
--

CREATE TABLE `dizimistas` (
  `id_dizimista` int(11) NOT NULL,
  `pessoa` int(11) NOT NULL,
  `d_cadastro` int(11) NOT NULL,
  `situacao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `enderecos`
--

CREATE TABLE `enderecos` (
  `id_endereco` int(11) NOT NULL,
  `logradouro` int(11) NOT NULL,
  `num_casa` varchar(10) NOT NULL,
  `apartamento` varchar(10) DEFAULT NULL,
  `complemento` text DEFAULT NULL,
  `observacoes` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `enderecos`
--

INSERT INTO `enderecos` (`id_endereco`, `logradouro`, `num_casa`, `apartamento`, `complemento`, `observacoes`) VALUES
(1, 1, '-', '-', 'Próximo a praça tiradentes', '-');

-- --------------------------------------------------------

--
-- Estrutura da tabela `estado`
--

CREATE TABLE `estado` (
  `id_estado` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `sigla` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `estado`
--

INSERT INTO `estado` (`id_estado`, `nome`, `sigla`) VALUES
(7, 'Minas Gerais', 'MG'),
(8, 'São Paulo', 'SP'),
(9, 'Rio de Janeiro', 'RJ'),
(10, 'Espirito Santo', 'ES'),
(11, 'Bahia', 'BA'),
(12, 'Piauí', 'PI');

-- --------------------------------------------------------

--
-- Estrutura da tabela `etapas_catequese`
--

CREATE TABLE `etapas_catequese` (
  `id_etapa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(500) DEFAULT NULL,
  `idade_ini` date DEFAULT NULL,
  `idade_fim` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `folhas`
--

CREATE TABLE `folhas` (
  `id_folha` int(11) NOT NULL,
  `num_pagina` int(11) NOT NULL,
  `livro` int(11) NOT NULL,
  `observacao` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `folhas`
--

INSERT INTO `folhas` (`id_folha`, `num_pagina`, `livro`, `observacao`) VALUES
(4, -1, 12, NULL),
(6, 2, 12, NULL),
(7, 3, 12, NULL),
(8, 5, 12, NULL),
(9, 7, 12, NULL),
(10, 9, 12, NULL),
(11, 11, 12, NULL),
(12, 13, 12, NULL),
(13, 15, 12, NULL),
(14, 16, 12, NULL),
(15, 17, 12, NULL),
(16, 18, 12, NULL),
(17, 19, 12, NULL),
(18, 20, 12, NULL),
(19, 21, 12, NULL),
(20, 22, 12, NULL),
(21, 23, 12, NULL),
(22, 24, 12, NULL),
(23, 25, 12, NULL),
(24, 26, 12, NULL),
(25, 27, 12, NULL),
(26, 28, 12, NULL),
(27, 29, 12, NULL),
(28, 30, 12, NULL),
(29, 31, 12, NULL),
(30, 32, 12, NULL),
(31, 33, 12, NULL),
(32, 34, 12, NULL),
(33, 35, 12, NULL),
(34, 36, 12, NULL),
(35, 37, 12, NULL),
(36, 38, 12, NULL),
(37, 39, 12, NULL),
(38, 40, 12, NULL),
(39, 41, 12, NULL),
(40, 42, 12, NULL),
(41, 43, 12, NULL),
(42, 44, 12, NULL),
(43, 45, 12, NULL),
(44, 46, 12, NULL),
(45, 47, 12, NULL),
(46, 48, 12, NULL),
(47, 49, 12, NULL),
(48, 50, 12, NULL),
(49, 51, 12, NULL),
(50, 52, 12, NULL),
(51, 53, 12, NULL),
(52, 54, 12, NULL),
(53, 55, 12, NULL),
(54, 56, 12, NULL),
(55, 57, 12, NULL),
(56, 58, 12, NULL),
(57, 59, 12, NULL),
(58, 60, 12, NULL),
(59, 61, 12, NULL),
(60, 62, 12, NULL),
(61, 63, 12, NULL),
(62, 64, 12, NULL),
(63, 65, 12, NULL),
(64, 66, 12, NULL),
(65, 67, 12, NULL),
(66, 68, 12, NULL),
(67, 69, 12, NULL),
(68, 70, 12, NULL),
(69, 71, 12, NULL),
(70, 72, 12, NULL),
(71, 73, 12, NULL),
(72, 74, 12, NULL),
(73, 75, 12, NULL),
(74, 76, 12, NULL),
(75, 77, 12, NULL),
(76, 78, 12, NULL),
(77, 79, 12, NULL),
(78, 80, 12, NULL),
(79, 81, 12, NULL),
(80, 82, 12, NULL),
(81, 83, 12, NULL),
(82, 84, 12, NULL),
(83, 85, 12, NULL),
(84, 86, 12, NULL),
(85, 87, 12, NULL),
(86, 88, 12, NULL),
(87, 89, 12, NULL),
(88, 90, 12, NULL),
(89, 91, 12, NULL),
(90, 92, 12, NULL),
(91, 93, 12, NULL),
(92, 94, 12, NULL),
(93, 95, 12, NULL),
(94, 96, 12, NULL),
(95, 97, 12, NULL),
(96, 98, 12, NULL),
(97, 99, 12, NULL),
(98, 100, 12, NULL),
(99, 101, 12, NULL),
(100, 102, 12, NULL),
(101, 103, 12, NULL),
(102, 104, 12, NULL),
(103, 105, 12, NULL),
(104, 106, 12, NULL),
(105, 107, 12, NULL),
(106, 108, 12, NULL),
(107, 109, 12, NULL),
(108, 110, 12, NULL),
(109, 111, 12, NULL),
(110, 112, 12, NULL),
(111, 113, 12, NULL),
(112, 114, 12, NULL),
(113, 115, 12, NULL),
(114, 116, 12, NULL),
(115, 117, 12, NULL),
(116, 118, 12, NULL),
(117, 119, 12, NULL),
(118, 120, 12, NULL),
(119, 121, 12, NULL),
(120, 122, 12, NULL),
(121, 123, 12, NULL),
(122, 124, 12, NULL),
(123, 125, 12, NULL),
(124, 126, 12, NULL),
(125, 127, 12, NULL),
(126, 128, 12, NULL),
(127, 129, 12, NULL),
(128, 130, 12, NULL),
(129, 131, 12, NULL),
(130, 132, 12, NULL),
(131, 133, 12, NULL),
(132, 134, 12, NULL),
(133, 135, 12, NULL),
(134, 136, 12, NULL),
(135, 137, 12, NULL),
(136, 138, 12, NULL),
(137, 139, 12, NULL),
(138, 140, 12, NULL),
(139, 141, 12, NULL),
(140, 142, 12, NULL),
(141, 143, 12, NULL),
(142, 144, 12, NULL),
(143, 145, 12, NULL),
(144, 146, 12, NULL),
(145, 147, 12, NULL),
(146, 148, 12, NULL),
(147, 149, 12, NULL),
(148, 150, 12, NULL),
(149, 151, 12, NULL),
(150, 152, 12, NULL),
(151, 153, 12, NULL),
(152, 154, 12, NULL),
(153, 155, 12, NULL),
(154, 156, 12, NULL),
(155, 157, 12, NULL),
(156, 158, 12, NULL),
(157, 159, 12, NULL),
(158, 160, 12, NULL),
(159, 161, 12, NULL),
(160, 162, 12, NULL),
(161, 163, 12, NULL),
(162, 164, 12, NULL),
(163, 165, 12, NULL),
(164, 166, 12, NULL),
(165, 167, 12, NULL),
(166, 168, 12, NULL),
(167, 169, 12, NULL),
(168, 170, 12, NULL),
(169, 171, 12, NULL),
(170, 172, 12, NULL),
(171, 173, 12, NULL),
(172, 174, 12, NULL),
(173, 175, 12, NULL),
(174, 176, 12, NULL),
(175, 177, 12, NULL),
(176, 178, 12, NULL),
(177, 179, 12, NULL),
(178, 180, 12, NULL),
(179, 181, 12, NULL),
(180, 182, 12, NULL),
(181, 183, 12, NULL),
(182, 184, 12, NULL),
(183, 185, 12, NULL),
(184, 186, 12, NULL),
(185, 187, 12, NULL),
(186, 188, 12, NULL),
(187, 189, 12, NULL),
(188, 190, 12, NULL),
(189, 191, 12, NULL),
(190, 191, 12, NULL),
(191, 192, 12, NULL),
(192, 193, 12, NULL),
(193, 194, 12, NULL),
(194, 195, 12, NULL),
(195, 196, 12, NULL),
(196, 197, 12, NULL),
(197, 198, 12, NULL),
(198, 199, 12, NULL),
(199, 200, 12, NULL),
(200, 201, 12, NULL),
(201, 202, 12, NULL),
(202, 203, 12, NULL),
(203, 204, 12, NULL),
(204, 205, 12, NULL),
(205, 206, 12, NULL),
(206, 207, 12, NULL),
(207, 208, 12, NULL),
(208, 209, 12, NULL),
(209, 210, 12, NULL),
(210, 212, 12, NULL),
(211, 213, 12, NULL),
(212, 214, 12, NULL),
(213, 215, 12, NULL),
(214, 216, 12, NULL),
(215, 217, 12, NULL),
(216, 218, 12, NULL),
(217, 219, 12, NULL),
(218, 220, 12, NULL),
(219, 221, 12, NULL),
(220, 222, 12, NULL),
(221, 223, 12, NULL),
(222, 224, 12, NULL),
(223, 225, 12, NULL),
(224, 226, 12, NULL),
(225, 227, 12, NULL),
(226, 228, 12, NULL),
(227, 229, 12, NULL),
(228, 230, 12, NULL),
(229, 231, 12, NULL),
(230, 232, 12, NULL),
(231, 233, 12, NULL),
(232, 234, 12, NULL),
(233, 235, 12, NULL),
(234, 236, 12, NULL),
(235, 237, 12, NULL),
(236, 238, 12, NULL),
(237, 239, 12, NULL),
(238, 240, 12, NULL),
(239, 241, 12, NULL),
(240, 242, 12, NULL),
(241, 243, 12, NULL),
(242, 244, 12, NULL),
(243, 245, 12, NULL),
(244, 246, 12, NULL),
(245, 247, 12, NULL),
(246, 248, 12, NULL),
(247, 249, 12, NULL),
(248, 250, 12, NULL),
(249, 251, 12, NULL),
(250, 252, 12, NULL),
(251, 253, 12, NULL),
(252, 254, 12, NULL),
(253, 255, 12, NULL),
(254, 256, 12, NULL),
(255, 257, 12, NULL),
(256, 258, 12, NULL),
(257, 259, 12, NULL),
(258, 260, 12, NULL),
(259, 261, 12, NULL),
(260, 263, 12, NULL),
(261, 264, 12, NULL),
(262, 265, 12, NULL),
(263, 266, 12, NULL),
(264, 267, 12, NULL),
(265, 268, 12, NULL),
(266, 269, 12, NULL),
(267, 270, 12, NULL),
(268, 271, 12, NULL),
(269, 272, 12, NULL),
(270, 273, 12, NULL),
(271, 274, 12, NULL),
(272, 275, 12, NULL),
(273, 276, 12, NULL),
(274, 277, 12, NULL),
(275, 278, 12, NULL),
(276, 279, 12, NULL),
(277, 280, 12, NULL),
(278, 281, 12, NULL),
(279, 282, 12, NULL),
(280, 283, 12, NULL),
(281, 284, 12, NULL),
(282, 284, 12, NULL),
(283, 285, 12, NULL),
(284, 286, 12, NULL),
(285, 287, 12, NULL),
(286, 288, 12, NULL),
(287, 289, 12, NULL),
(288, 290, 12, NULL),
(289, 291, 12, NULL),
(290, 292, 12, NULL),
(291, 293, 12, NULL),
(292, 294, 12, NULL),
(293, 295, 12, NULL),
(294, 296, 12, NULL),
(295, 297, 12, NULL),
(296, 298, 12, NULL),
(297, 299, 12, NULL),
(298, 300, 12, NULL),
(299, 301, 12, NULL),
(300, 302, 12, NULL),
(301, 303, 12, NULL),
(302, 304, 12, NULL),
(303, 305, 12, NULL),
(304, 306, 12, NULL),
(305, 307, 12, NULL),
(306, 308, 12, NULL),
(307, 309, 12, NULL),
(308, 310, 12, NULL),
(309, 311, 12, NULL),
(310, 312, 12, NULL),
(311, 313, 12, NULL),
(312, 314, 12, NULL),
(313, 315, 12, NULL),
(314, 316, 12, NULL),
(315, 316, 12, NULL),
(316, 317, 12, NULL),
(317, 318, 12, NULL),
(318, 319, 12, NULL),
(319, 320, 12, NULL),
(320, 321, 12, NULL),
(321, 322, 12, NULL),
(322, 323, 12, NULL),
(323, 324, 12, NULL),
(324, 325, 12, NULL),
(325, 326, 12, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fotos_folhas`
--

CREATE TABLE `fotos_folhas` (
  `id_foto` int(11) NOT NULL,
  `observacao` varchar(500) DEFAULT NULL,
  `foto` varchar(255) NOT NULL,
  `tamanho` int(25) NOT NULL,
  `caminho` varchar(255) NOT NULL,
  `folha` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fotos_folhas`
--

INSERT INTO `fotos_folhas` (`id_foto`, `observacao`, `foto`, `tamanho`, `caminho`, `folha`) VALUES
(4, NULL, '15640789805d39f3843b515.jpeg', 4993848, 'Imagens/Livro_12/Folhas/', 4),
(6, NULL, '15640799195d39f72f9690f.jpeg', 5826748, 'Imagens/Livro_12/Folhas/', 6),
(7, NULL, '15640799645d39f75c89fa0.jpeg', 6286336, 'Imagens/Livro_12/Folhas/', 7),
(8, NULL, '15640801175d39f7f50efd2.jpeg', 6213956, 'Imagens/Livro_12/Folhas/', 8),
(9, NULL, '15640827515d3a023f6970c.jpeg', 6433440, 'Imagens/Livro_12/Folhas/', 9),
(10, NULL, '15640828045d3a02747ca8e.jpeg', 6453380, 'Imagens/Livro_12/Folhas/', 10),
(11, NULL, '15640828505d3a02a205cc8.jpeg', 6314588, 'Imagens/Livro_12/Folhas/', 11),
(12, NULL, '15640828955d3a02cf615a0.jpeg', 6454488, 'Imagens/Livro_12/Folhas/', 12),
(13, NULL, '15640830205d3a034c81c2f.jpeg', 6305180, 'Imagens/Livro_12/Folhas/', 13),
(14, NULL, '15640830995d3a039b9e2c1.jpeg', 6081788, 'Imagens/Livro_12/Folhas/', 14),
(15, NULL, '15640831495d3a03cd7bd5e.jpeg', 6093228, 'Imagens/Livro_12/Folhas/', 15),
(16, NULL, '15645718275d4178b34a5cb.jpeg', 6082644, 'Imagens/Livro_12/Folhas/', 16),
(17, NULL, '15645718825d4178eac48de.jpeg', 6338160, 'Imagens/Livro_12/Folhas/', 17),
(18, NULL, '15645722965d417a8821e5b.jpeg', 6281556, 'Imagens/Livro_12/Folhas/', 18),
(19, NULL, '15645723265d417aa668a9a.jpeg', 5952952, 'Imagens/Livro_12/Folhas/', 19),
(20, NULL, '15645723595d417ac765ced.jpeg', 6071792, 'Imagens/Livro_12/Folhas/', 20),
(21, NULL, '15645724045d417af4a7e56.jpeg', 5929044, 'Imagens/Livro_12/Folhas/', 21),
(22, NULL, '15645724385d417b166de91.jpeg', 6032004, 'Imagens/Livro_12/Folhas/', 22),
(23, NULL, '15645724785d417b3e51796.jpeg', 5975240, 'Imagens/Livro_12/Folhas/', 23),
(24, NULL, '15645725085d417b5c11fc3.jpeg', 5812704, 'Imagens/Livro_12/Folhas/', 24),
(25, NULL, '15645725395d417b7bee351.jpeg', 5861504, 'Imagens/Livro_12/Folhas/', 25),
(26, NULL, '15645725835d417ba765de0.jpeg', 5965752, 'Imagens/Livro_12/Folhas/', 26),
(27, NULL, '15645726145d417bc6eb06b.jpeg', 5993680, 'Imagens/Livro_12/Folhas/', 27),
(28, NULL, '15645726515d417beb42b15.jpeg', 6001380, 'Imagens/Livro_12/Folhas/', 28),
(29, NULL, '15645726865d417c0ed0e93.jpeg', 6197480, 'Imagens/Livro_12/Folhas/', 29),
(30, NULL, '15645727285d417c3856021.jpeg', 6172192, 'Imagens/Livro_12/Folhas/', 30),
(31, NULL, '15645727935d417c7902c2e.jpeg', 6222456, 'Imagens/Livro_12/Folhas/', 31),
(32, NULL, '15645728365d417ca47d261.jpeg', 6195512, 'Imagens/Livro_12/Folhas/', 32),
(33, NULL, '15645731895d417e0564fbb.jpeg', 5921484, 'Imagens/Livro_12/Folhas/', 33),
(34, NULL, '15645732735d417e59a4a72.jpeg', 6233408, 'Imagens/Livro_12/Folhas/', 34),
(35, NULL, '15645733065d417e7a482fd.jpeg', 5383276, 'Imagens/Livro_12/Folhas/', 35),
(36, NULL, '15645733545d417eaa96d96.jpeg', 6176928, 'Imagens/Livro_12/Folhas/', 36),
(37, NULL, '15645733845d417ec8d4b9d.jpeg', 5403772, 'Imagens/Livro_12/Folhas/', 37),
(38, NULL, '15645734145d417ee6f1557.jpeg', 6119876, 'Imagens/Livro_12/Folhas/', 38),
(39, NULL, '15645734415d417f01f01ff.jpeg', 5351532, 'Imagens/Livro_12/Folhas/', 39),
(40, NULL, '15645736205d417fb4e7f0c.jpeg', 5739620, 'Imagens/Livro_12/Folhas/', 40),
(41, NULL, '15645736635d417fdfcf884.jpeg', 5768600, 'Imagens/Livro_12/Folhas/', 41),
(42, NULL, '15645797095d41977d0afb0.jpeg', 6106736, 'Imagens/Livro_12/Folhas/', 42),
(43, NULL, '15645797585d4197aef2884.jpeg', 5304436, 'Imagens/Livro_12/Folhas/', 43),
(44, NULL, '15645801525d4199384ff39.jpeg', 5717524, 'Imagens/Livro_12/Folhas/', 44),
(45, NULL, '15645813705d419dfa3121c.jpeg', 5476464, 'Imagens/Livro_12/Folhas/', 45),
(46, NULL, '15645814015d419e19b2165.jpeg', 5782284, 'Imagens/Livro_12/Folhas/', 46),
(47, NULL, '15645814845d419e6cbfbb0.jpeg', 5480040, 'Imagens/Livro_12/Folhas/', 47),
(48, NULL, '15645815105d419e86a2338.jpeg', 5667400, 'Imagens/Livro_12/Folhas/', 48),
(49, NULL, '15645815375d419ea1a76e6.jpeg', 5648204, 'Imagens/Livro_12/Folhas/', 49),
(50, NULL, '15645827605d41a36817558.jpeg', 5976380, 'Imagens/Livro_12/Folhas/', 50),
(51, NULL, '15645827915d41a38745fe7.jpeg', 5540012, 'Imagens/Livro_12/Folhas/', 51),
(52, NULL, '15645828215d41a3a577c02.jpeg', 5754480, 'Imagens/Livro_12/Folhas/', 52),
(53, NULL, '15645828425d41a3ba1873c.jpeg', 5478352, 'Imagens/Livro_12/Folhas/', 53),
(54, NULL, '15645828895d41a3e9344e1.jpeg', 5751436, 'Imagens/Livro_12/Folhas/', 54),
(55, NULL, '15645829215d41a4091d909.jpeg', 5469896, 'Imagens/Livro_12/Folhas/', 55),
(56, NULL, '15645829525d41a4284d112.jpeg', 5802492, 'Imagens/Livro_12/Folhas/', 56),
(57, NULL, '15645829825d41a4468a031.jpeg', 5398156, 'Imagens/Livro_12/Folhas/', 57),
(58, NULL, '15645830065d41a45eb928d.jpeg', 6055304, 'Imagens/Livro_12/Folhas/', 58),
(59, NULL, '15645830305d41a47662a32.jpeg', 5324176, 'Imagens/Livro_12/Folhas/', 59),
(60, NULL, '15645830935d41a4b55967c.jpeg', 5959356, 'Imagens/Livro_12/Folhas/', 60),
(61, NULL, '15645831225d41a4d24c989.jpeg', 5494424, 'Imagens/Livro_12/Folhas/', 61),
(62, NULL, '15645831985d41a51e23fb3.jpeg', 5752408, 'Imagens/Livro_12/Folhas/', 62),
(63, NULL, '15645832905d41a57adda66.jpeg', 5248568, 'Imagens/Livro_12/Folhas/', 63),
(64, NULL, '15645833145d41a592832ca.jpeg', 6011608, 'Imagens/Livro_12/Folhas/', 64),
(65, NULL, '15645834135d41a5f5e0983.jpeg', 6236216, 'Imagens/Livro_12/Folhas/', 65),
(66, NULL, '15645834355d41a60b74dd3.jpeg', 6064280, 'Imagens/Livro_12/Folhas/', 66),
(67, NULL, '15645834915d41a643801f6.jpeg', 5529868, 'Imagens/Livro_12/Folhas/', 67),
(68, NULL, '15645835145d41a65a89b7a.jpeg', 6090728, 'Imagens/Livro_12/Folhas/', 68),
(69, NULL, '15645835505d41a67e63722.jpeg', 4537288, 'Imagens/Livro_12/Folhas/', 69),
(70, NULL, '15645836045d41a6b4104ab.jpeg', 5880128, 'Imagens/Livro_12/Folhas/', 70),
(71, NULL, '15645836375d41a6d5b0a17.jpeg', 5839412, 'Imagens/Livro_12/Folhas/', 71),
(72, NULL, '15645836585d41a6ea99475.jpeg', 5795352, 'Imagens/Livro_12/Folhas/', 72),
(73, NULL, '15645837025d41a7163bd44.jpeg', 5966488, 'Imagens/Livro_12/Folhas/', 73),
(74, NULL, '15645837305d41a73289ccb.jpeg', 5875108, 'Imagens/Livro_12/Folhas/', 74),
(75, NULL, '15645837515d41a7477c25f.jpeg', 5848792, 'Imagens/Livro_12/Folhas/', 75),
(76, NULL, '15645837785d41a7622d90a.jpeg', 5739708, 'Imagens/Livro_12/Folhas/', 76),
(77, NULL, '15645838165d41a78827174.jpeg', 5988356, 'Imagens/Livro_12/Folhas/', 77),
(78, NULL, '15645838425d41a7a2acc7d.jpeg', 6058112, 'Imagens/Livro_12/Folhas/', 78),
(79, NULL, '15645838675d41a7bbf161a.jpeg', 5912896, 'Imagens/Livro_12/Folhas/', 79),
(80, NULL, '15645839105d41a7e6a346e.jpeg', 5441480, 'Imagens/Livro_12/Folhas/', 80),
(81, NULL, '15645839405d41a8048f995.jpeg', 6139780, 'Imagens/Livro_12/Folhas/', 81),
(82, NULL, '15645839635d41a81b72c0c.jpeg', 5234844, 'Imagens/Livro_12/Folhas/', 82),
(83, NULL, '15645840045d41a844d9c68.jpeg', 6059192, 'Imagens/Livro_12/Folhas/', 83),
(84, NULL, '15645840425d41a86ac279c.jpeg', 5838392, 'Imagens/Livro_12/Folhas/', 84),
(85, NULL, '15645840665d41a882e80d9.jpeg', 6299336, 'Imagens/Livro_12/Folhas/', 85),
(86, NULL, '15645841065d41a8aacabe8.jpeg', 5613332, 'Imagens/Livro_12/Folhas/', 86),
(87, NULL, '15645841345d41a8c61465b.jpeg', 6151536, 'Imagens/Livro_12/Folhas/', 87),
(88, NULL, '15645846445d41aac45b8a5.jpeg', 4828152, 'Imagens/Livro_12/Folhas/', 88),
(89, NULL, '15645850895d41ac81472dd.jpeg', 6189900, 'Imagens/Livro_12/Folhas/', 89),
(90, NULL, '15645851125d41ac98990a2.jpeg', 5267228, 'Imagens/Livro_12/Folhas/', 90),
(91, NULL, '15645851325d41acac94b1b.jpeg', 6273616, 'Imagens/Livro_12/Folhas/', 91),
(92, NULL, '15645851575d41acc5a4426.jpeg', 5495100, 'Imagens/Livro_12/Folhas/', 92),
(93, NULL, '15645851785d41acdaef745.jpeg', 6007132, 'Imagens/Livro_12/Folhas/', 93),
(94, NULL, '15645921945d41c84264156.jpeg', 5230468, 'Imagens/Livro_12/Folhas/', 94),
(95, NULL, '15645922405d41c87089238.jpeg', 6336000, 'Imagens/Livro_12/Folhas/', 95),
(96, NULL, '15645922735d41c89165677.jpeg', 5339872, 'Imagens/Livro_12/Folhas/', 96),
(97, NULL, '15645922955d41c8a7c1817.jpeg', 6163860, 'Imagens/Livro_12/Folhas/', 97),
(98, NULL, '15645923335d41c8cddf141.jpeg', 6227532, 'Imagens/Livro_12/Folhas/', 98),
(99, NULL, '15645923715d41c8f33c76f.jpeg', 6227532, 'Imagens/Livro_12/Folhas/', 99),
(100, NULL, '15645924025d41c912b3866.jpeg', 5843216, 'Imagens/Livro_12/Folhas/', 100),
(101, NULL, '15645924445d41c93c9e371.jpeg', 6419584, 'Imagens/Livro_12/Folhas/', 101),
(102, NULL, '15645924645d41c950e5474.jpeg', 5914120, 'Imagens/Livro_12/Folhas/', 102),
(103, NULL, '15645924875d41c96713af5.jpeg', 6194632, 'Imagens/Livro_12/Folhas/', 103),
(104, NULL, '15645925095d41c97d17dd2.jpeg', 5828932, 'Imagens/Livro_12/Folhas/', 104),
(105, NULL, '15645925305d41c99222204.jpeg', 6206184, 'Imagens/Livro_12/Folhas/', 105),
(106, NULL, '15645925755d41c9bf951c3.jpeg', 5235912, 'Imagens/Livro_12/Folhas/', 106),
(107, NULL, '15645926045d41c9dc598fb.jpeg', 6342728, 'Imagens/Livro_12/Folhas/', 107),
(108, NULL, '15645926285d41c9f413597.jpeg', 6091716, 'Imagens/Livro_12/Folhas/', 108),
(109, NULL, '15645926445d41ca042d56f.jpeg', 6072732, 'Imagens/Livro_12/Folhas/', 109),
(110, NULL, '15645926635d41ca1730f9b.jpeg', 5965476, 'Imagens/Livro_12/Folhas/', 110),
(111, NULL, '15645926795d41ca2792580.jpeg', 6404560, 'Imagens/Livro_12/Folhas/', 111),
(112, NULL, '15645926995d41ca3bf1b67.jpeg', 6125432, 'Imagens/Livro_12/Folhas/', 112),
(113, NULL, '15645927195d41ca4fd2712.jpeg', 5900504, 'Imagens/Livro_12/Folhas/', 113),
(114, NULL, '15645927485d41ca6c3366c.jpeg', 5538060, 'Imagens/Livro_12/Folhas/', 114),
(115, NULL, '15645927685d41ca8099c98.jpeg', 6364916, 'Imagens/Livro_12/Folhas/', 115),
(116, NULL, '15645927985d41ca9e8de02.jpeg', 6293564, 'Imagens/Livro_12/Folhas/', 116),
(117, NULL, '15645930715d41cbafeaa31.jpeg', 6177952, 'Imagens/Livro_12/Folhas/', 117),
(118, NULL, '15645930925d41cbc4ebd3d.jpeg', 5852436, 'Imagens/Livro_12/Folhas/', 118),
(119, NULL, '15645931195d41cbdf57f8f.jpeg', 6225348, 'Imagens/Livro_12/Folhas/', 119),
(120, NULL, '15645931585d41cc065d701.jpeg', 5805960, 'Imagens/Livro_12/Folhas/', 120),
(121, NULL, '15645931795d41cc1bbda98.jpeg', 6497504, 'Imagens/Livro_12/Folhas/', 121),
(122, NULL, '15645932065d41cc365580b.jpeg', 5517172, 'Imagens/Livro_12/Folhas/', 122),
(123, NULL, '15645932285d41cc4ca8e4f.jpeg', 6258888, 'Imagens/Livro_12/Folhas/', 123),
(124, NULL, '15645932615d41cc6da0727.jpeg', 5632272, 'Imagens/Livro_12/Folhas/', 124),
(125, NULL, '15645932855d41cc85b86bb.jpeg', 6126860, 'Imagens/Livro_12/Folhas/', 125),
(126, NULL, '15645933095d41cc9d5102b.jpeg', 6055896, 'Imagens/Livro_12/Folhas/', 126),
(127, NULL, '15645933315d41ccb3192f8.jpeg', 6162784, 'Imagens/Livro_12/Folhas/', 127),
(128, NULL, '15645933515d41ccc7d981c.jpeg', 5765200, 'Imagens/Livro_12/Folhas/', 128),
(129, NULL, '15645933785d41cce2cab0a.jpeg', 6177192, 'Imagens/Livro_12/Folhas/', 129),
(130, NULL, '15645934095d41cd014bf5a.jpeg', 6260236, 'Imagens/Livro_12/Folhas/', 130),
(131, NULL, '15645934315d41cd17dfb2c.jpeg', 6528700, 'Imagens/Livro_12/Folhas/', 131),
(132, NULL, '15645934535d41cd2de929d.jpeg', 6097088, 'Imagens/Livro_12/Folhas/', 132),
(133, NULL, '15645934845d41cd4c2a10c.jpeg', 6215372, 'Imagens/Livro_12/Folhas/', 133),
(134, NULL, '15645935095d41cd65032f4.jpeg', 5871196, 'Imagens/Livro_12/Folhas/', 134),
(135, NULL, '15645935285d41cd78e4c2e.jpeg', 6410452, 'Imagens/Livro_12/Folhas/', 135),
(136, NULL, '15645935495d41cd8d0af36.jpeg', 6205344, 'Imagens/Livro_12/Folhas/', 136),
(137, NULL, '15645935675d41cd9fd5c56.jpeg', 6429596, 'Imagens/Livro_12/Folhas/', 137),
(138, NULL, '15645935895d41cdb58d56a.jpeg', 6038816, 'Imagens/Livro_12/Folhas/', 138),
(139, NULL, '15645936205d41cdd4e7508.jpeg', 6014256, 'Imagens/Livro_12/Folhas/', 139),
(140, NULL, '15645936485d41cdf091293.jpeg', 5811676, 'Imagens/Livro_12/Folhas/', 140),
(141, NULL, '15645938995d41ceeb86cf5.jpeg', 6121244, 'Imagens/Livro_12/Folhas/', 141),
(142, NULL, '15645939165d41cefc61200.jpeg', 6067724, 'Imagens/Livro_12/Folhas/', 142),
(143, NULL, '15645939425d41cf1688c89.jpeg', 6239320, 'Imagens/Livro_12/Folhas/', 143),
(144, NULL, '15645939695d41cf310b41a.jpeg', 6046576, 'Imagens/Livro_12/Folhas/', 144),
(145, NULL, '15645939915d41cf47f1fe9.jpeg', 5875260, 'Imagens/Livro_12/Folhas/', 145),
(146, NULL, '15645940125d41cf5c0ec46.jpeg', 5616712, 'Imagens/Livro_12/Folhas/', 146),
(147, NULL, '15645940445d41cf7ca7de4.jpeg', 6199108, 'Imagens/Livro_12/Folhas/', 147),
(148, NULL, '15645941415d41cfdd1631c.jpeg', 6168788, 'Imagens/Livro_12/Folhas/', 148),
(149, NULL, '15645941645d41cff44cd56.jpeg', 6168788, 'Imagens/Livro_12/Folhas/', 149),
(150, NULL, '15645941885d41d00c85634.jpeg', 6441784, 'Imagens/Livro_12/Folhas/', 150),
(151, NULL, '15645942215d41d02d72714.jpeg', 6594512, 'Imagens/Livro_12/Folhas/', 151),
(152, NULL, '15645942405d41d04095f08.jpeg', 6242996, 'Imagens/Livro_12/Folhas/', 152),
(153, NULL, '15645942605d41d054f2fad.jpeg', 6441184, 'Imagens/Livro_12/Folhas/', 153),
(154, NULL, '15645942955d41d0778931b.jpeg', 6393340, 'Imagens/Livro_12/Folhas/', 154),
(155, NULL, '15645943155d41d08b55536.jpeg', 6449004, 'Imagens/Livro_12/Folhas/', 155),
(156, NULL, '15645943355d41d09fdbc2e.jpeg', 6095056, 'Imagens/Livro_12/Folhas/', 156),
(157, NULL, '15645943515d41d0af63b4c.jpeg', 6231896, 'Imagens/Livro_12/Folhas/', 157),
(158, NULL, '15645943995d41d0df53b2b.jpeg', 4993848, 'Imagens/Livro_12/Folhas/', 158),
(159, NULL, '15645944165d41d0f0921dd.jpeg', 6201484, 'Imagens/Livro_12/Folhas/', 159),
(160, NULL, '15645944345d41d10239633.jpeg', 6151296, 'Imagens/Livro_12/Folhas/', 160),
(161, NULL, '15645944625d41d11e92ef2.jpeg', 6224052, 'Imagens/Livro_12/Folhas/', 161),
(162, NULL, '15645944815d41d131a82da.jpeg', 6459788, 'Imagens/Livro_12/Folhas/', 162),
(163, NULL, '15645945005d41d14408c03.jpeg', 6527492, 'Imagens/Livro_12/Folhas/', 163),
(164, NULL, '15645945225d41d15a1a915.jpeg', 6289812, 'Imagens/Livro_12/Folhas/', 164),
(165, NULL, '15645953715d41d4abec168.jpeg', 6381212, 'Imagens/Livro_12/Folhas/', 165),
(166, NULL, '15645953965d41d4c450b72.jpeg', 6480928, 'Imagens/Livro_12/Folhas/', 166),
(167, NULL, '15645954265d41d4e292dd0.jpeg', 6403028, 'Imagens/Livro_12/Folhas/', 167),
(168, NULL, '15645955685d41d5706f4d1.jpeg', 6554036, 'Imagens/Livro_12/Folhas/', 168),
(169, NULL, '15645955885d41d584633d6.jpeg', 5830904, 'Imagens/Livro_12/Folhas/', 169),
(170, NULL, '15645956075d41d59730d8a.jpeg', 5830904, 'Imagens/Livro_12/Folhas/', 170),
(171, NULL, '15645956275d41d5ab85853.jpeg', 6078072, 'Imagens/Livro_12/Folhas/', 171),
(172, NULL, '15645956435d41d5bb41604.jpeg', 6062348, 'Imagens/Livro_12/Folhas/', 172),
(173, NULL, '15645956695d41d5d56fd3e.jpeg', 6488984, 'Imagens/Livro_12/Folhas/', 173),
(174, NULL, '15645957725d41d63c916c9.jpeg', 6407824, 'Imagens/Livro_12/Folhas/', 174),
(175, NULL, '15645958005d41d658b0c3b.jpeg', 6213944, 'Imagens/Livro_12/Folhas/', 175),
(176, NULL, '15645958175d41d6699791c.jpeg', 6114432, 'Imagens/Livro_12/Folhas/', 176),
(177, NULL, '15645958315d41d677b284c.jpeg', 6602768, 'Imagens/Livro_12/Folhas/', 177),
(178, NULL, '15645958515d41d68b53a0b.jpeg', 6417296, 'Imagens/Livro_12/Folhas/', 178),
(179, NULL, '15645958755d41d6a349709.jpeg', 6355684, 'Imagens/Livro_12/Folhas/', 179),
(180, NULL, '15645959145d41d6ca9784e.jpeg', 6084964, 'Imagens/Livro_12/Folhas/', 180),
(181, NULL, '15645959325d41d6dc93bdd.jpeg', 6205856, 'Imagens/Livro_12/Folhas/', 181),
(182, NULL, '15645959505d41d6eedb5b4.jpeg', 5936704, 'Imagens/Livro_12/Folhas/', 182),
(183, NULL, '15645959695d41d70112cee.jpeg', 5938452, 'Imagens/Livro_12/Folhas/', 183),
(184, NULL, '15645959855d41d7110f0df.jpeg', 6306084, 'Imagens/Livro_12/Folhas/', 184),
(185, NULL, '15645960015d41d72127440.jpeg', 6158304, 'Imagens/Livro_12/Folhas/', 185),
(186, NULL, '15645960175d41d7313b7f6.jpeg', 6282108, 'Imagens/Livro_12/Folhas/', 186),
(187, NULL, '15645960475d41d74fd52f2.jpeg', 5847972, 'Imagens/Livro_12/Folhas/', 187),
(188, NULL, '15645960685d41d7640c1da.jpeg', 6345972, 'Imagens/Livro_12/Folhas/', 188),
(189, NULL, '15645960825d41d772bfc77.jpeg', 1668184, 'Imagens/Livro_12/Folhas/', 188),
(190, NULL, '15645961075d41d78b63ee9.jpeg', 5775220, 'Imagens/Livro_12/Folhas/', 189),
(191, NULL, '15645961085d41d78c4c2c5.jpeg', 5775220, 'Imagens/Livro_12/Folhas/', 190),
(192, NULL, '15645964595d41d8eb682df.jpeg', 6366968, 'Imagens/Livro_12/Folhas/', 191),
(193, NULL, '15645964745d41d8fa52816.jpeg', 5747948, 'Imagens/Livro_12/Folhas/', 192),
(194, NULL, '15645964885d41d908c24fe.jpeg', 6221068, 'Imagens/Livro_12/Folhas/', 193),
(195, NULL, '15645965075d41d91b6f75a.jpeg', 5600208, 'Imagens/Livro_12/Folhas/', 194),
(196, NULL, '15645965235d41d92b76727.jpeg', 6190016, 'Imagens/Livro_12/Folhas/', 195),
(197, NULL, '15645965905d41d96eb4647.jpeg', 5573880, 'Imagens/Livro_12/Folhas/', 196),
(198, NULL, '15645966065d41d97e43e80.jpeg', 3000400, 'Imagens/Livro_12/Folhas/', 197),
(199, NULL, '15645966205d41d98c3e9bd.jpeg', 3267376, 'Imagens/Livro_12/Folhas/', 197),
(200, NULL, '15645966385d41d99ecffbe.jpeg', 5329468, 'Imagens/Livro_12/Folhas/', 198),
(201, NULL, '15645966545d41d9ae52230.jpeg', 5961396, 'Imagens/Livro_12/Folhas/', 199),
(202, NULL, '15645966695d41d9bd801c2.jpeg', 5745020, 'Imagens/Livro_12/Folhas/', 200),
(203, NULL, '15645966945d41d9d6d645a.jpeg', 6482640, 'Imagens/Livro_12/Folhas/', 201),
(204, NULL, '15645967145d41d9ea95013.jpeg', 6096748, 'Imagens/Livro_12/Folhas/', 202),
(205, NULL, '15645967365d41da00064ba.jpeg', 6400016, 'Imagens/Livro_12/Folhas/', 203),
(206, NULL, '15645967475d41da0bb5e59.jpeg', 1709232, 'Imagens/Livro_12/Folhas/', 203),
(207, NULL, '15645967775d41da29395b3.jpeg', 5675952, 'Imagens/Livro_12/Folhas/', 204),
(208, NULL, '15645967935d41da39ad8d1.jpeg', 6434564, 'Imagens/Livro_12/Folhas/', 205),
(209, NULL, '15645968125d41da4ce3230.jpeg', 5493160, 'Imagens/Livro_12/Folhas/', 206),
(210, NULL, '15645968295d41da5d87958.jpeg', 6679840, 'Imagens/Livro_12/Folhas/', 207),
(211, NULL, '15645968665d41da8218ec3.jpeg', 5887396, 'Imagens/Livro_12/Folhas/', 208),
(212, NULL, '15645968815d41da91f03ac.jpeg', 6860324, 'Imagens/Livro_12/Folhas/', 209),
(213, NULL, '15645969025d41daa6ed65e.jpeg', 5567872, 'Imagens/Livro_12/Folhas/', 210),
(214, NULL, '15645969385d41daca250fd.jpeg', 5396368, 'Imagens/Livro_12/Folhas/', 211),
(215, NULL, '15645969595d41dadf414f6.jpeg', 6475788, 'Imagens/Livro_12/Folhas/', 212),
(216, NULL, '15645969735d41daed149c0.jpeg', 5657256, 'Imagens/Livro_12/Folhas/', 213),
(217, NULL, '15645993115d41e40feb855.jpeg', 6394400, 'Imagens/Livro_12/Folhas/', 214),
(218, NULL, '15645993445d41e4301f4c2.jpeg', 5640748, 'Imagens/Livro_12/Folhas/', 215),
(219, NULL, '15645993615d41e4414ef17.jpeg', 6534996, 'Imagens/Livro_12/Folhas/', 216),
(220, NULL, '15645993995d41e46774ce2.jpeg', 5789872, 'Imagens/Livro_12/Folhas/', 217),
(221, NULL, '15645994195d41e47b068be.jpeg', 6593544, 'Imagens/Livro_12/Folhas/', 218),
(222, NULL, '15645994335d41e489ba6ab.jpeg', 5662424, 'Imagens/Livro_12/Folhas/', 219),
(223, NULL, '15645994925d41e4c4cf1e5.jpeg', 6392000, 'Imagens/Livro_12/Folhas/', 220),
(224, NULL, '15645997245d41e5acda390.jpeg', 5404592, 'Imagens/Livro_12/Folhas/', 221),
(225, NULL, '15645997805d41e5e470c7c.jpeg', 6509084, 'Imagens/Livro_12/Folhas/', 222),
(226, NULL, '15645997965d41e5f427e96.jpeg', 5613976, 'Imagens/Livro_12/Folhas/', 223),
(227, NULL, '15645998125d41e60405f05.jpeg', 6287960, 'Imagens/Livro_12/Folhas/', 224),
(228, NULL, '15645998325d41e618a2dbb.jpeg', 5384876, 'Imagens/Livro_12/Folhas/', 225),
(229, NULL, '15645998515d41e62b38b52.jpeg', 6362032, 'Imagens/Livro_12/Folhas/', 226),
(230, NULL, '15645998675d41e63b96cb5.jpeg', 5784112, 'Imagens/Livro_12/Folhas/', 227),
(231, NULL, '15645998885d41e65051e2c.jpeg', 6365920, 'Imagens/Livro_12/Folhas/', 228),
(232, NULL, '15645999185d41e66e3f9dd.jpeg', 6537928, 'Imagens/Livro_12/Folhas/', 229),
(233, NULL, '15645999505d41e68e580a3.jpeg', 6537928, 'Imagens/Livro_12/Folhas/', 230),
(234, NULL, '15645999705d41e6a269a77.jpeg', 5178792, 'Imagens/Livro_12/Folhas/', 231),
(235, NULL, '15645999895d41e6b53e7f0.jpeg', 6613412, 'Imagens/Livro_12/Folhas/', 232),
(236, NULL, '15646000065d41e6c679bc4.jpeg', 1888044, 'Imagens/Livro_12/Folhas/', 232),
(237, NULL, '15646000225d41e6d655a5c.jpeg', 5793672, 'Imagens/Livro_12/Folhas/', 233),
(238, NULL, '15646000475d41e6ef7e57d.jpeg', 6318472, 'Imagens/Livro_12/Folhas/', 234),
(239, NULL, '15646000835d41e7132cc74.jpeg', 4622584, 'Imagens/Livro_12/Folhas/', 235),
(240, NULL, '15646001175d41e7356a582.jpeg', 6490236, 'Imagens/Livro_12/Folhas/', 236),
(241, NULL, '15646001315d41e7437c331.jpeg', 4846248, 'Imagens/Livro_12/Folhas/', 237),
(242, NULL, '15646001535d41e7593a271.jpeg', 6427808, 'Imagens/Livro_12/Folhas/', 238),
(243, NULL, '15646001745d41e76e3a9bd.jpeg', 4690288, 'Imagens/Livro_12/Folhas/', 239),
(244, NULL, '15646001915d41e77f6a846.jpeg', 6349256, 'Imagens/Livro_12/Folhas/', 240),
(245, NULL, '15646002065d41e78e5a947.jpeg', 4712424, 'Imagens/Livro_12/Folhas/', 241),
(246, NULL, '15646002275d41e7a3473ea.jpeg', 6275504, 'Imagens/Livro_12/Folhas/', 242),
(247, NULL, '15646002465d41e7b6ae01d.jpeg', 4886732, 'Imagens/Livro_12/Folhas/', 243),
(248, NULL, '15646002605d41e7c4e94af.jpeg', 5990212, 'Imagens/Livro_12/Folhas/', 244),
(249, NULL, '15646002765d41e7d4711e1.jpeg', 4653032, 'Imagens/Livro_12/Folhas/', 245),
(250, NULL, '15646002905d41e7e257275.jpeg', 6172208, 'Imagens/Livro_12/Folhas/', 246),
(251, NULL, '15646003065d41e7f27b396.jpeg', 5306304, 'Imagens/Livro_12/Folhas/', 247),
(252, NULL, '15646003245d41e80476254.jpeg', 6135716, 'Imagens/Livro_12/Folhas/', 248),
(253, NULL, '15646003345d41e80eb0f77.jpeg', 1682400, 'Imagens/Livro_12/Folhas/', 248),
(254, NULL, '15646003635d41e82b9bfac.jpeg', 5127544, 'Imagens/Livro_12/Folhas/', 249),
(255, NULL, '15646003785d41e83ac2bb3.jpeg', 6278676, 'Imagens/Livro_12/Folhas/', 250),
(256, NULL, '15646003955d41e84ba0d56.jpeg', 4944016, 'Imagens/Livro_12/Folhas/', 251),
(257, NULL, '15646004085d41e8580a7b3.jpeg', 1299448, 'Imagens/Livro_12/Folhas/', 251),
(258, NULL, '15646004265d41e86a82d0e.jpeg', 6482708, 'Imagens/Livro_12/Folhas/', 252),
(259, NULL, '15646004395d41e87792432.jpeg', 4804320, 'Imagens/Livro_12/Folhas/', 253),
(260, NULL, '15646004555d41e88788c79.jpeg', 4900716, 'Imagens/Livro_12/Folhas/', 254),
(261, NULL, '15646004795d41e89f23580.jpeg', 5426496, 'Imagens/Livro_12/Folhas/', 255),
(262, NULL, '15646012415d41eb99a7ca7.jpeg', 6525812, 'Imagens/Livro_12/Folhas/', 256),
(263, NULL, '15646012805d41ebc0b302d.jpeg', 4935972, 'Imagens/Livro_12/Folhas/', 257),
(264, NULL, '15646012985d41ebd292bfe.jpeg', 6292156, 'Imagens/Livro_12/Folhas/', 258),
(265, NULL, '15646013185d41ebe682eca.jpeg', 6505028, 'Imagens/Livro_12/Folhas/', 259),
(266, NULL, '15646014435d41ec6395336.jpeg', 4432536, 'Imagens/Livro_12/Folhas/', 260),
(267, NULL, '15646014585d41ec72ce1e4.jpeg', 6714916, 'Imagens/Livro_12/Folhas/', 261),
(268, NULL, '15646014745d41ec821bdb0.jpeg', 6321656, 'Imagens/Livro_12/Folhas/', 262),
(269, NULL, '15646014925d41ec9491a0b.jpeg', 6321656, 'Imagens/Livro_12/Folhas/', 263),
(270, NULL, '15646015175d41ecad136dc.jpeg', 3626240, 'Imagens/Livro_12/Folhas/', 264),
(271, NULL, '15646015445d41ecc844687.jpeg', 3626240, 'Imagens/Livro_12/Folhas/', 265),
(272, NULL, '15646015625d41ecdab20ac.jpeg', 3953636, 'Imagens/Livro_12/Folhas/', 266),
(273, NULL, '15646015785d41eceabb767.jpeg', 6478084, 'Imagens/Livro_12/Folhas/', 267),
(274, NULL, '15646016255d41ed19cec0a.jpeg', 5775324, 'Imagens/Livro_12/Folhas/', 268),
(275, NULL, '15646016705d41ed46041ea.jpeg', 6191272, 'Imagens/Livro_12/Folhas/', 269),
(276, NULL, '15646016935d41ed5de199e.jpeg', 5700332, 'Imagens/Livro_12/Folhas/', 270),
(277, NULL, '15646017095d41ed6dd61b2.jpeg', 5963664, 'Imagens/Livro_12/Folhas/', 271),
(278, NULL, '15646017645d41eda44551e.jpeg', 5811748, 'Imagens/Livro_12/Folhas/', 272),
(279, NULL, '15646017825d41edb651ecb.jpeg', 6156044, 'Imagens/Livro_12/Folhas/', 273),
(280, NULL, '15646017995d41edc7d9c04.jpeg', 5155824, 'Imagens/Livro_12/Folhas/', 274),
(281, NULL, '15646018165d41edd8e9b26.jpeg', 6160348, 'Imagens/Livro_12/Folhas/', 275),
(282, NULL, '15646018345d41edeaa5ffd.jpeg', 4284560, 'Imagens/Livro_12/Folhas/', 276),
(283, NULL, '15646018555d41edff3734d.jpeg', 6114832, 'Imagens/Livro_12/Folhas/', 277),
(284, NULL, '15646018715d41ee0f58a9a.jpeg', 4989216, 'Imagens/Livro_12/Folhas/', 278),
(285, NULL, '15646018855d41ee1df128a.jpeg', 6220668, 'Imagens/Livro_12/Folhas/', 279),
(286, NULL, '15646018995d41ee2b92562.jpeg', 5091828, 'Imagens/Livro_12/Folhas/', 280),
(287, NULL, '15646019165d41ee3c93255.jpeg', 6294116, 'Imagens/Livro_12/Folhas/', 281),
(288, NULL, '15646019325d41ee4cf1693.jpeg', 6294116, 'Imagens/Livro_12/Folhas/', 281),
(289, NULL, '15646044295d41f80da967a.jpeg', 6294116, 'Imagens/Livro_12/Folhas/', 282),
(290, NULL, '15646044415d41f819928f9.jpeg', 1833660, 'Imagens/Livro_12/Folhas/', 282),
(291, NULL, '15646044585d41f82a0e65f.jpeg', 4356940, 'Imagens/Livro_12/Folhas/', 283),
(292, NULL, '15646044735d41f839a56b2.jpeg', 6111256, 'Imagens/Livro_12/Folhas/', 284),
(293, NULL, '15646044855d41f8456a59a.jpeg', 3982404, 'Imagens/Livro_12/Folhas/', 285),
(294, NULL, '15646045025d41f85665b9b.jpeg', 6198624, 'Imagens/Livro_12/Folhas/', 286),
(295, NULL, '15646045205d41f868e3b5b.jpeg', 3904072, 'Imagens/Livro_12/Folhas/', 287),
(296, NULL, '15646045415d41f87d1c071.jpeg', 6043292, 'Imagens/Livro_12/Folhas/', 288),
(297, NULL, '15646045595d41f88f34600.jpeg', 3017924, 'Imagens/Livro_12/Folhas/', 289),
(298, NULL, '15646045785d41f8a296fa4.jpeg', 5882280, 'Imagens/Livro_12/Folhas/', 290),
(299, NULL, '15646045945d41f8b2a481b.jpeg', 4104028, 'Imagens/Livro_12/Folhas/', 291),
(300, NULL, '15646046085d41f8c077833.jpeg', 5983572, 'Imagens/Livro_12/Folhas/', 292),
(301, NULL, '15646046215d41f8cdf2dca.jpeg', 2140188, 'Imagens/Livro_12/Folhas/', 293),
(302, NULL, '15646046375d41f8ddc31a8.jpeg', 6005252, 'Imagens/Livro_12/Folhas/', 294),
(303, NULL, '15646046565d41f8f019ff0.jpeg', 4053732, 'Imagens/Livro_12/Folhas/', 295),
(304, NULL, '15646046805d41f908ce886.jpeg', 4115708, 'Imagens/Livro_12/Folhas/', 296),
(305, NULL, '15646046975d41f919014e0.jpeg', 3882192, 'Imagens/Livro_12/Folhas/', 297),
(306, NULL, '15646047135d41f929bec9e.jpeg', 6403136, 'Imagens/Livro_12/Folhas/', 298),
(307, NULL, '15646047425d41f946b29c1.jpeg', 4993848, 'Imagens/Livro_12/Folhas/', 299),
(308, NULL, '15646048685d41f9c4bbd03.jpeg', 4993848, 'Imagens/Livro_12/Folhas/', 300),
(309, NULL, '15646048945d41f9dedba1e.jpeg', 4345472, 'Imagens/Livro_12/Folhas/', 301),
(310, NULL, '15646049185d41f9f6a77af.jpeg', 6052752, 'Imagens/Livro_12/Folhas/', 302),
(311, NULL, '15646049335d41fa05a87c4.jpeg', 4159660, 'Imagens/Livro_12/Folhas/', 303),
(312, NULL, '15646049485d41fa14cc214.jpeg', 5828496, 'Imagens/Livro_12/Folhas/', 304),
(313, NULL, '15646049705d41fa2a88c90.jpeg', 4215636, 'Imagens/Livro_12/Folhas/', 305),
(314, NULL, '15646049895d41fa3dde9b7.jpeg', 5912316, 'Imagens/Livro_12/Folhas/', 306),
(315, NULL, '15646050055d41fa4d9b98e.jpeg', 5723872, 'Imagens/Livro_12/Folhas/', 307),
(316, NULL, '15646050265d41fa6276318.jpeg', 5723872, 'Imagens/Livro_12/Folhas/', 308),
(317, NULL, '15646050415d41fa719dc88.jpeg', 5385104, 'Imagens/Livro_12/Folhas/', 309),
(318, NULL, '15646050565d41fa807305f.jpeg', 6066428, 'Imagens/Livro_12/Folhas/', 310),
(319, NULL, '15646050675d41fa8b7e227.jpeg', 1602004, 'Imagens/Livro_12/Folhas/', 310),
(320, NULL, '15646050815d41fa99cc74a.jpeg', 5180408, 'Imagens/Livro_12/Folhas/', 311),
(321, NULL, '15646050975d41faa9d7cf7.jpeg', 5931152, 'Imagens/Livro_12/Folhas/', 312),
(322, NULL, '15646051325d41facc49cee.jpeg', 4856828, 'Imagens/Livro_12/Folhas/', 313),
(323, NULL, '15646051495d41faddb31b9.jpeg', 6103536, 'Imagens/Livro_12/Folhas/', 314),
(324, NULL, '15646051905d41fb0632abe.jpeg', 6103536, 'Imagens/Livro_12/Folhas/', 315),
(325, NULL, '15646052095d41fb19a09e8.jpeg', 3869408, 'Imagens/Livro_12/Folhas/', 316),
(326, NULL, '15646052315d41fb2fd28e6.jpeg', 4993848, 'Imagens/Livro_12/Folhas/', 316),
(327, NULL, '15646052465d41fb3e91d01.jpeg', 4317292, 'Imagens/Livro_12/Folhas/', 317),
(328, NULL, '15646052615d41fb4d3a3c4.jpeg', 1847192, 'Imagens/Livro_12/Folhas/', 317),
(329, NULL, '15646053065d41fb7a48300.jpeg', 4608204, 'Imagens/Livro_12/Folhas/', 318),
(330, NULL, '15646053585d41fbae669f7.jpeg', 5877284, 'Imagens/Livro_12/Folhas/', 319),
(331, NULL, '15646054055d41fbdde626d.jpeg', 5877284, 'Imagens/Livro_12/Folhas/', 320),
(332, NULL, '15646056615d41fcdd32f01.jpeg', 4993848, 'Imagens/Livro_12/Folhas/', 321),
(333, NULL, '15646057035d41fd0759c2e.jpeg', 4164196, 'Imagens/Livro_12/Folhas/', 322),
(334, NULL, '15646057355d41fd27a533f.jpeg', 6195940, 'Imagens/Livro_12/Folhas/', 323),
(335, NULL, '15646062345d41ff1a43020.jpeg', 4155192, 'Imagens/Livro_12/Folhas/', 324),
(336, NULL, '15646063205d41ff70b635f.jpeg', 6066300, 'Imagens/Livro_12/Folhas/', 325);

-- --------------------------------------------------------

--
-- Estrutura da tabela `igrejas`
--

CREATE TABLE `igrejas` (
  `id_igreja` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `igrejas`
--

INSERT INTO `igrejas` (`id_igreja`, `nome`, `endereco`) VALUES
(1, 'Paróquia Catedral Imaculada Conceição', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `igreja_telefone`
--

CREATE TABLE `igreja_telefone` (
  `igreja` int(11) NOT NULL,
  `telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `inscricoes_cursos`
--

CREATE TABLE `inscricoes_cursos` (
  `id_inscricao` int(11) NOT NULL,
  `pessoa` int(11) NOT NULL,
  `curso_oferta` int(11) NOT NULL,
  `situacao` int(11) NOT NULL,
  `observacoes` varchar(5000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `intecoes`
--

CREATE TABLE `intecoes` (
  `id_intencao` int(11) NOT NULL,
  `nome_falecido` varchar(255) NOT NULL,
  `solicitante` int(11) NOT NULL,
  `marcado_por` int(11) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` int(11) NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `intencao`
--

CREATE TABLE `intencao` (
  `id_intencao` int(11) NOT NULL,
  `falecido` varchar(300) NOT NULL,
  `solicitante` varchar(300) NOT NULL,
  `marcado_por` int(11) NOT NULL,
  `telefone` varchar(50) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_presenca_catequese`
--

CREATE TABLE `lista_presenca_catequese` (
  `id_presenca` int(11) NOT NULL,
  `inscricao` int(11) NOT NULL,
  `situacao` int(11) NOT NULL,
  `obsercacoes` text DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `lista_presenca_cursos`
--

CREATE TABLE `lista_presenca_cursos` (
  `id_presenca` int(11) NOT NULL,
  `inscricao` int(11) NOT NULL,
  `situacao` int(11) NOT NULL,
  `observacao` int(11) DEFAULT NULL,
  `data` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `livros`
--

CREATE TABLE `livros` (
  `id_livro` int(11) NOT NULL,
  `numeracao` varchar(10) NOT NULL,
  `data_inicio` date NOT NULL,
  `data_fim` date NOT NULL,
  `descricao` varchar(500) NOT NULL,
  `quant_paginas` int(11) DEFAULT NULL,
  `sacramento` int(11) NOT NULL,
  `igreja` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `livros`
--

INSERT INTO `livros` (`id_livro`, `numeracao`, `data_inicio`, `data_fim`, `descricao`, `quant_paginas`, `sacramento`, `igreja`) VALUES
(12, '70', '1951-09-23', '1952-08-26', 'Livro de batismo 70B, está com o estado de conservação relativamente bom, sendo que a letra da secretária que fez os registros não é muito legível.', 400, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logradouros`
--

CREATE TABLE `logradouros` (
  `id_logradouro` int(11) NOT NULL,
  `rua` varchar(500) NOT NULL,
  `bairro` varchar(500) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `cidade` varchar(500) NOT NULL,
  `estado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logradouros`
--

INSERT INTO `logradouros` (`id_logradouro`, `rua`, `bairro`, `cep`, `cidade`, `estado`) VALUES
(1, 'Rua Antônio Alves Benjamim', 'Centro', '39800-021', 'Teófilo Otoni', 7);

-- --------------------------------------------------------

--
-- Estrutura da tabela `noivos`
--

CREATE TABLE `noivos` (
  `id_noivos` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `data_nac` date NOT NULL,
  `endereco` int(11) NOT NULL,
  `batizado` int(11) DEFAULT NULL,
  `crisma` int(11) DEFAULT NULL,
  `situacao` int(11) NOT NULL,
  `pai` varchar(255) NOT NULL,
  `mae` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `noivos_telefone`
--

CREATE TABLE `noivos_telefone` (
  `noivo` int(11) NOT NULL,
  `telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pastorais_movimentos_grupos`
--

CREATE TABLE `pastorais_movimentos_grupos` (
  `id_pastoral` int(11) NOT NULL,
  `nome` int(11) NOT NULL,
  `descricao` int(11) DEFAULT NULL,
  `objetivo` int(11) DEFAULT NULL,
  `estado` int(11) NOT NULL,
  `tipo` int(11) NOT NULL COMMENT '1-pastoral / 2-movimento / 3-grupo'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id_pessoa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` int(11) NOT NULL,
  `d_nasc` date NOT NULL,
  `email` varchar(300) NOT NULL,
  `sexo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoa_telefone`
--

CREATE TABLE `pessoa_telefone` (
  `pessoa` int(11) NOT NULL,
  `telefone` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `sacramentos`
--

CREATE TABLE `sacramentos` (
  `id_sacramento` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(400) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sacramentos`
--

INSERT INTO `sacramentos` (`id_sacramento`, `nome`, `descricao`) VALUES
(1, 'Batismo', '-'),
(2, 'Crisma', '-'),
(3, 'Casamento', '-');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sexos`
--

CREATE TABLE `sexos` (
  `id_sexo` int(11) NOT NULL,
  `sexo` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `situacoes`
--

CREATE TABLE `situacoes` (
  `id_situacao` int(11) NOT NULL,
  `descricao` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `telefones`
--

CREATE TABLE `telefones` (
  `id_telefone` int(11) NOT NULL,
  `dd` varchar(5) NOT NULL,
  `numero` varchar(50) NOT NULL,
  `obs` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipos_intencao`
--

CREATE TABLE `tipos_intencao` (
  `id_tipo` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_intencoes`
--

CREATE TABLE `tipo_intencoes` (
  `id_intencao` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Estrutura da tabela `titulos_clero`
--

CREATE TABLE `titulos_clero` (
  `id_titulo` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `descricao` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `batizado`
--
ALTER TABLE `batizado`
  ADD PRIMARY KEY (`id_batizado`);

--
-- Índices para tabela `batizando`
--
ALTER TABLE `batizando`
  ADD PRIMARY KEY (`id_batizando`);

--
-- Índices para tabela `casamentos`
--
ALTER TABLE `casamentos`
  ADD PRIMARY KEY (`id_casamento`);

--
-- Índices para tabela `catequese_inscricoes`
--
ALTER TABLE `catequese_inscricoes`
  ADD PRIMARY KEY (`id_inscricao`);

--
-- Índices para tabela `catequisando`
--
ALTER TABLE `catequisando`
  ADD PRIMARY KEY (`matricula_catequisado`);

--
-- Índices para tabela `catequista`
--
ALTER TABLE `catequista`
  ADD PRIMARY KEY (`id_catequista`);

--
-- Índices para tabela `clero`
--
ALTER TABLE `clero`
  ADD PRIMARY KEY (`id_clero`),
  ADD KEY `fk_titulo__titulos_clero` (`titulo`),
  ADD KEY `fk_pessoa__pessoas` (`pessoa`);

--
-- Índices para tabela `clero_igreja`
--
ALTER TABLE `clero_igreja`
  ADD KEY `clero` (`clero`,`igreja`,`data_inicio`,`cargo`),
  ADD KEY `fk_igreja__clero_igreja` (`igreja`);

--
-- Índices para tabela `componentes_pastorais`
--
ALTER TABLE `componentes_pastorais`
  ADD PRIMARY KEY (`id_componente`);

--
-- Índices para tabela `comunidade`
--
ALTER TABLE `comunidade`
  ADD PRIMARY KEY (`id_comunidade`);

--
-- Índices para tabela `conselho`
--
ALTER TABLE `conselho`
  ADD PRIMARY KEY (`id_conselho`);

--
-- Índices para tabela `crisma`
--
ALTER TABLE `crisma`
  ADD PRIMARY KEY (`id_crisma`);

--
-- Índices para tabela `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Índices para tabela `cursos_ofertados`
--
ALTER TABLE `cursos_ofertados`
  ADD PRIMARY KEY (`id_curso_ofeta`);

--
-- Índices para tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id_endereco`),
  ADD KEY `fk_logradouros_enderecos` (`logradouro`);

--
-- Índices para tabela `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Índices para tabela `etapas_catequese`
--
ALTER TABLE `etapas_catequese`
  ADD PRIMARY KEY (`id_etapa`);

--
-- Índices para tabela `folhas`
--
ALTER TABLE `folhas`
  ADD PRIMARY KEY (`id_folha`),
  ADD KEY `fk_livros_folhas` (`livro`);

--
-- Índices para tabela `fotos_folhas`
--
ALTER TABLE `fotos_folhas`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `fk_folhas_fotosFolhas` (`folha`);

--
-- Índices para tabela `igrejas`
--
ALTER TABLE `igrejas`
  ADD PRIMARY KEY (`id_igreja`),
  ADD KEY `fk_endereco_igreja` (`endereco`);

--
-- Índices para tabela `igreja_telefone`
--
ALTER TABLE `igreja_telefone`
  ADD PRIMARY KEY (`igreja`,`telefone`),
  ADD KEY `fk_telefone_igreja` (`telefone`),
  ADD KEY `fk_igreja_telefone` (`igreja`) USING BTREE;

--
-- Índices para tabela `intencao`
--
ALTER TABLE `intencao`
  ADD PRIMARY KEY (`id_intencao`);

--
-- Índices para tabela `lista_presenca_catequese`
--
ALTER TABLE `lista_presenca_catequese`
  ADD PRIMARY KEY (`id_presenca`);

--
-- Índices para tabela `lista_presenca_cursos`
--
ALTER TABLE `lista_presenca_cursos`
  ADD PRIMARY KEY (`id_presenca`);

--
-- Índices para tabela `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id_livro`),
  ADD KEY `fk_sacramento_livros` (`sacramento`),
  ADD KEY `fk_igrejas_livros` (`igreja`);

--
-- Índices para tabela `logradouros`
--
ALTER TABLE `logradouros`
  ADD PRIMARY KEY (`id_logradouro`),
  ADD KEY `fk_estado__estados` (`estado`);

--
-- Índices para tabela `noivos`
--
ALTER TABLE `noivos`
  ADD PRIMARY KEY (`id_noivos`);

--
-- Índices para tabela `pastorais_movimentos_grupos`
--
ALTER TABLE `pastorais_movimentos_grupos`
  ADD PRIMARY KEY (`id_pastoral`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Índices para tabela `pessoa_telefone`
--
ALTER TABLE `pessoa_telefone`
  ADD KEY `fk_pessoa_telefone__telefones` (`telefone`),
  ADD KEY `fk_pessoa_telefone__pessoas` (`pessoa`);

--
-- Índices para tabela `sacramentos`
--
ALTER TABLE `sacramentos`
  ADD PRIMARY KEY (`id_sacramento`);

--
-- Índices para tabela `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`id_sexo`);

--
-- Índices para tabela `situacoes`
--
ALTER TABLE `situacoes`
  ADD PRIMARY KEY (`id_situacao`);

--
-- Índices para tabela `telefones`
--
ALTER TABLE `telefones`
  ADD PRIMARY KEY (`id_telefone`);

--
-- Índices para tabela `tipos_intencao`
--
ALTER TABLE `tipos_intencao`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Índices para tabela `tipo_intencoes`
--
ALTER TABLE `tipo_intencoes`
  ADD PRIMARY KEY (`id_intencao`);

--
-- Índices para tabela `titulos_clero`
--
ALTER TABLE `titulos_clero`
  ADD PRIMARY KEY (`id_titulo`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `batizado`
--
ALTER TABLE `batizado`
  MODIFY `id_batizado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `batizando`
--
ALTER TABLE `batizando`
  MODIFY `id_batizando` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `casamentos`
--
ALTER TABLE `casamentos`
  MODIFY `id_casamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `catequese_inscricoes`
--
ALTER TABLE `catequese_inscricoes`
  MODIFY `id_inscricao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `catequisando`
--
ALTER TABLE `catequisando`
  MODIFY `matricula_catequisado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `componentes_pastorais`
--
ALTER TABLE `componentes_pastorais`
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `comunidade`
--
ALTER TABLE `comunidade`
  MODIFY `id_comunidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `conselho`
--
ALTER TABLE `conselho`
  MODIFY `id_conselho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `crisma`
--
ALTER TABLE `crisma`
  MODIFY `id_crisma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `cursos_ofertados`
--
ALTER TABLE `cursos_ofertados`
  MODIFY `id_curso_ofeta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `etapas_catequese`
--
ALTER TABLE `etapas_catequese`
  MODIFY `id_etapa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `folhas`
--
ALTER TABLE `folhas`
  MODIFY `id_folha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=326;

--
-- AUTO_INCREMENT de tabela `fotos_folhas`
--
ALTER TABLE `fotos_folhas`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=337;

--
-- AUTO_INCREMENT de tabela `igrejas`
--
ALTER TABLE `igrejas`
  MODIFY `id_igreja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `intencao`
--
ALTER TABLE `intencao`
  MODIFY `id_intencao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lista_presenca_catequese`
--
ALTER TABLE `lista_presenca_catequese`
  MODIFY `id_presenca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `lista_presenca_cursos`
--
ALTER TABLE `lista_presenca_cursos`
  MODIFY `id_presenca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `livros`
--
ALTER TABLE `livros`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `logradouros`
--
ALTER TABLE `logradouros`
  MODIFY `id_logradouro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `noivos`
--
ALTER TABLE `noivos`
  MODIFY `id_noivos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pastorais_movimentos_grupos`
--
ALTER TABLE `pastorais_movimentos_grupos`
  MODIFY `id_pastoral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `sacramentos`
--
ALTER TABLE `sacramentos`
  MODIFY `id_sacramento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `sexos`
--
ALTER TABLE `sexos`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `situacoes`
--
ALTER TABLE `situacoes`
  MODIFY `id_situacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `telefones`
--
ALTER TABLE `telefones`
  MODIFY `id_telefone` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipos_intencao`
--
ALTER TABLE `tipos_intencao`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `tipo_intencoes`
--
ALTER TABLE `tipo_intencoes`
  MODIFY `id_intencao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `titulos_clero`
--
ALTER TABLE `titulos_clero`
  MODIFY `id_titulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `clero`
--
ALTER TABLE `clero`
  ADD CONSTRAINT `fk_pessoa__pessoas` FOREIGN KEY (`pessoa`) REFERENCES `pessoas` (`id_pessoa`),
  ADD CONSTRAINT `fk_titulo__titulos_clero` FOREIGN KEY (`titulo`) REFERENCES `titulos_clero` (`id_titulo`);

--
-- Limitadores para a tabela `clero_igreja`
--
ALTER TABLE `clero_igreja`
  ADD CONSTRAINT `fk_clero__clero_igreja` FOREIGN KEY (`clero`) REFERENCES `clero` (`id_clero`),
  ADD CONSTRAINT `fk_igreja__clero_igreja` FOREIGN KEY (`igreja`) REFERENCES `igrejas` (`id_igreja`);

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `fk_logradouros_enderecos` FOREIGN KEY (`logradouro`) REFERENCES `logradouros` (`id_logradouro`);

--
-- Limitadores para a tabela `folhas`
--
ALTER TABLE `folhas`
  ADD CONSTRAINT `fk_livros_folhas` FOREIGN KEY (`livro`) REFERENCES `livros` (`id_livro`);

--
-- Limitadores para a tabela `fotos_folhas`
--
ALTER TABLE `fotos_folhas`
  ADD CONSTRAINT `fk_folhas_fotosFolhas` FOREIGN KEY (`folha`) REFERENCES `folhas` (`id_folha`);

--
-- Limitadores para a tabela `igrejas`
--
ALTER TABLE `igrejas`
  ADD CONSTRAINT `fk_endereco_igreja` FOREIGN KEY (`endereco`) REFERENCES `enderecos` (`id_endereco`);

--
-- Limitadores para a tabela `igreja_telefone`
--
ALTER TABLE `igreja_telefone`
  ADD CONSTRAINT `fk_igreja_telefone` FOREIGN KEY (`igreja`) REFERENCES `igrejas` (`id_igreja`),
  ADD CONSTRAINT `fk_telefone_igreja` FOREIGN KEY (`telefone`) REFERENCES `telefones` (`id_telefone`);

--
-- Limitadores para a tabela `livros`
--
ALTER TABLE `livros`
  ADD CONSTRAINT `fk_igrejas_livros` FOREIGN KEY (`igreja`) REFERENCES `igrejas` (`id_igreja`),
  ADD CONSTRAINT `fk_sacramento_livros` FOREIGN KEY (`sacramento`) REFERENCES `sacramentos` (`id_sacramento`);

--
-- Limitadores para a tabela `logradouros`
--
ALTER TABLE `logradouros`
  ADD CONSTRAINT `fk_estado__estados` FOREIGN KEY (`estado`) REFERENCES `estado` (`id_estado`);

--
-- Limitadores para a tabela `pessoa_telefone`
--
ALTER TABLE `pessoa_telefone`
  ADD CONSTRAINT `fk_pessoa_telefone__pessoas` FOREIGN KEY (`pessoa`) REFERENCES `pessoas` (`id_pessoa`),
  ADD CONSTRAINT `fk_pessoa_telefone__telefones` FOREIGN KEY (`telefone`) REFERENCES `telefones` (`id_telefone`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
