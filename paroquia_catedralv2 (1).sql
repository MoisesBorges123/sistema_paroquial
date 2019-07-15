-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 15-Jul-2019 às 03:51
-- Versão do servidor: 10.1.40-MariaDB
-- versão do PHP: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `paroquia_catedralv2`
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
  `nome` varchar(255) NOT NULL,
  `carro` int(11) DEFAULT NULL,
  `titulo` int(11) NOT NULL,
  `cargo` int(11) NOT NULL COMMENT 'P -padre / B - bispo / PP -papa',
  `observacao` varchar(500) DEFAULT NULL
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
  `objetivo` text,
  `descricao` text
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
  `complemento` text,
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
(1, 4, 8, NULL),
(2, 3, 8, NULL);

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
(1, NULL, '15631195555d2b4fc333e28.png', 640237, 'Imagens/Livro_8/Folhas/', 1),
(2, NULL, '15631203285d2b52c819439.png', 640237, 'Imagens/Livro_8/Folhas/', 2);

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
  `obsercacoes` text,
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
(1, '1B', '1868-01-01', '1869-12-30', '-', 400, 1, 1),
(3, '2B', '1900-01-01', '1900-12-01', '-', 400, 1, 1),
(4, '3b', '2019-07-02', '2019-07-31', '-', NULL, 1, 1),
(5, '3b', '2019-07-02', '2019-07-31', '-', NULL, 1, 1),
(6, '4B', '2019-07-15', '2019-07-31', '-', NULL, 3, 1),
(7, '9B', '2019-07-01', '2019-07-31', '-', 100, 2, 1),
(8, '10B', '2019-07-29', '2019-11-30', '-', NULL, 1, 1),
(9, '11B', '2019-07-07', '2019-07-08', '-', NULL, 3, 1),
(10, '11T', '2019-07-01', '2019-07-22', '-', NULL, 3, 1),
(11, '3G', '2019-07-09', '2019-12-01', '-', NULL, 3, 1),
(12, '3E', '2019-07-22', '2019-07-31', '-', NULL, 3, 1),
(13, '1RT', '2019-07-01', '2019-07-02', '-', NULL, 3, 1),
(14, '1RT', '2019-07-01', '2019-07-02', '-', NULL, 3, 1),
(15, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(16, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(17, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(18, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(19, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(20, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(21, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(22, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(23, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(24, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(25, 'ASDF', '2019-07-02', '2019-07-17', '-', NULL, 3, 1),
(26, '2R', '2019-07-01', '2019-07-02', 'testando a descrição', NULL, 1, 1),
(27, '2', '2019-07-14', '2019-07-22', '-', 2, 2, 1),
(28, '2', '2019-07-08', '2019-07-12', '-', 5, 2, 1),
(29, '2', '2019-07-01', '2019-07-16', '-', 6, 3, 1),
(30, '4', '2021-05-06', '2030-05-04', '-', 3, 1, 1),
(31, '5', '2022-04-03', '2024-02-02', '-', 5, 1, 1),
(32, '5', '2019-03-03', '2020-04-03', '-', 5, 2, 1),
(33, '2', '2019-07-10', '2019-07-15', '-', 3, 1, 1),
(34, '2', '2019-07-02', '2019-07-25', '-', 4, 1, 1),
(35, '4', '2019-07-10', '2019-07-30', '-', 4, 1, 1),
(36, '4', '2019-07-15', '2019-07-30', '-', 4, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `logradouros`
--

CREATE TABLE `logradouros` (
  `id_endereco` int(11) NOT NULL,
  `rua` varchar(500) NOT NULL,
  `bairro` varchar(500) NOT NULL,
  `cep` varchar(50) NOT NULL,
  `cidade` varchar(500) NOT NULL,
  `estado` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `logradouros`
--

INSERT INTO `logradouros` (`id_endereco`, `rua`, `bairro`, `cep`, `cidade`, `estado`) VALUES
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
-- Indexes for dumped tables
--

--
-- Indexes for table `batizado`
--
ALTER TABLE `batizado`
  ADD PRIMARY KEY (`id_batizado`);

--
-- Indexes for table `batizando`
--
ALTER TABLE `batizando`
  ADD PRIMARY KEY (`id_batizando`);

--
-- Indexes for table `casamentos`
--
ALTER TABLE `casamentos`
  ADD PRIMARY KEY (`id_casamento`);

--
-- Indexes for table `catequese_inscricoes`
--
ALTER TABLE `catequese_inscricoes`
  ADD PRIMARY KEY (`id_inscricao`);

--
-- Indexes for table `catequisando`
--
ALTER TABLE `catequisando`
  ADD PRIMARY KEY (`matricula_catequisado`);

--
-- Indexes for table `catequista`
--
ALTER TABLE `catequista`
  ADD PRIMARY KEY (`id_catequista`);

--
-- Indexes for table `clero`
--
ALTER TABLE `clero`
  ADD PRIMARY KEY (`id_clero`);

--
-- Indexes for table `componentes_pastorais`
--
ALTER TABLE `componentes_pastorais`
  ADD PRIMARY KEY (`id_componente`);

--
-- Indexes for table `comunidade`
--
ALTER TABLE `comunidade`
  ADD PRIMARY KEY (`id_comunidade`);

--
-- Indexes for table `conselho`
--
ALTER TABLE `conselho`
  ADD PRIMARY KEY (`id_conselho`);

--
-- Indexes for table `crisma`
--
ALTER TABLE `crisma`
  ADD PRIMARY KEY (`id_crisma`);

--
-- Indexes for table `cursos`
--
ALTER TABLE `cursos`
  ADD PRIMARY KEY (`id_curso`);

--
-- Indexes for table `cursos_ofertados`
--
ALTER TABLE `cursos_ofertados`
  ADD PRIMARY KEY (`id_curso_ofeta`);

--
-- Indexes for table `enderecos`
--
ALTER TABLE `enderecos`
  ADD PRIMARY KEY (`id_endereco`),
  ADD KEY `fk_logradouros_enderecos` (`logradouro`);

--
-- Indexes for table `estado`
--
ALTER TABLE `estado`
  ADD PRIMARY KEY (`id_estado`);

--
-- Indexes for table `etapas_catequese`
--
ALTER TABLE `etapas_catequese`
  ADD PRIMARY KEY (`id_etapa`);

--
-- Indexes for table `folhas`
--
ALTER TABLE `folhas`
  ADD PRIMARY KEY (`id_folha`),
  ADD KEY `fk_livros_folhas` (`livro`);

--
-- Indexes for table `fotos_folhas`
--
ALTER TABLE `fotos_folhas`
  ADD PRIMARY KEY (`id_foto`),
  ADD KEY `fk_folhas_fotosFolhas` (`folha`);

--
-- Indexes for table `igrejas`
--
ALTER TABLE `igrejas`
  ADD PRIMARY KEY (`id_igreja`),
  ADD KEY `fk_endereco_igreja` (`endereco`);

--
-- Indexes for table `igreja_telefone`
--
ALTER TABLE `igreja_telefone`
  ADD PRIMARY KEY (`igreja`,`telefone`),
  ADD KEY `fk_telefone_igreja` (`telefone`),
  ADD KEY `fk_igreja_telefone` (`igreja`) USING BTREE;

--
-- Indexes for table `intencao`
--
ALTER TABLE `intencao`
  ADD PRIMARY KEY (`id_intencao`);

--
-- Indexes for table `lista_presenca_catequese`
--
ALTER TABLE `lista_presenca_catequese`
  ADD PRIMARY KEY (`id_presenca`);

--
-- Indexes for table `lista_presenca_cursos`
--
ALTER TABLE `lista_presenca_cursos`
  ADD PRIMARY KEY (`id_presenca`);

--
-- Indexes for table `livros`
--
ALTER TABLE `livros`
  ADD PRIMARY KEY (`id_livro`),
  ADD KEY `fk_sacramento_livros` (`sacramento`),
  ADD KEY `fk_igrejas_livros` (`igreja`);

--
-- Indexes for table `logradouros`
--
ALTER TABLE `logradouros`
  ADD PRIMARY KEY (`id_endereco`);

--
-- Indexes for table `noivos`
--
ALTER TABLE `noivos`
  ADD PRIMARY KEY (`id_noivos`);

--
-- Indexes for table `pastorais_movimentos_grupos`
--
ALTER TABLE `pastorais_movimentos_grupos`
  ADD PRIMARY KEY (`id_pastoral`);

--
-- Indexes for table `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id_pessoa`);

--
-- Indexes for table `sacramentos`
--
ALTER TABLE `sacramentos`
  ADD PRIMARY KEY (`id_sacramento`);

--
-- Indexes for table `sexos`
--
ALTER TABLE `sexos`
  ADD PRIMARY KEY (`id_sexo`);

--
-- Indexes for table `situacoes`
--
ALTER TABLE `situacoes`
  ADD PRIMARY KEY (`id_situacao`);

--
-- Indexes for table `telefones`
--
ALTER TABLE `telefones`
  ADD PRIMARY KEY (`id_telefone`);

--
-- Indexes for table `tipos_intencao`
--
ALTER TABLE `tipos_intencao`
  ADD PRIMARY KEY (`id_tipo`);

--
-- Indexes for table `tipo_intencoes`
--
ALTER TABLE `tipo_intencoes`
  ADD PRIMARY KEY (`id_intencao`);

--
-- Indexes for table `titulos_clero`
--
ALTER TABLE `titulos_clero`
  ADD PRIMARY KEY (`id_titulo`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `batizado`
--
ALTER TABLE `batizado`
  MODIFY `id_batizado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `batizando`
--
ALTER TABLE `batizando`
  MODIFY `id_batizando` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `casamentos`
--
ALTER TABLE `casamentos`
  MODIFY `id_casamento` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catequese_inscricoes`
--
ALTER TABLE `catequese_inscricoes`
  MODIFY `id_inscricao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `catequisando`
--
ALTER TABLE `catequisando`
  MODIFY `matricula_catequisado` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `componentes_pastorais`
--
ALTER TABLE `componentes_pastorais`
  MODIFY `id_componente` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comunidade`
--
ALTER TABLE `comunidade`
  MODIFY `id_comunidade` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `conselho`
--
ALTER TABLE `conselho`
  MODIFY `id_conselho` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `crisma`
--
ALTER TABLE `crisma`
  MODIFY `id_crisma` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cursos`
--
ALTER TABLE `cursos`
  MODIFY `id_curso` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `cursos_ofertados`
--
ALTER TABLE `cursos_ofertados`
  MODIFY `id_curso_ofeta` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `enderecos`
--
ALTER TABLE `enderecos`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `estado`
--
ALTER TABLE `estado`
  MODIFY `id_estado` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `etapas_catequese`
--
ALTER TABLE `etapas_catequese`
  MODIFY `id_etapa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `folhas`
--
ALTER TABLE `folhas`
  MODIFY `id_folha` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `fotos_folhas`
--
ALTER TABLE `fotos_folhas`
  MODIFY `id_foto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `igrejas`
--
ALTER TABLE `igrejas`
  MODIFY `id_igreja` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `intencao`
--
ALTER TABLE `intencao`
  MODIFY `id_intencao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lista_presenca_catequese`
--
ALTER TABLE `lista_presenca_catequese`
  MODIFY `id_presenca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `lista_presenca_cursos`
--
ALTER TABLE `lista_presenca_cursos`
  MODIFY `id_presenca` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `livros`
--
ALTER TABLE `livros`
  MODIFY `id_livro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `logradouros`
--
ALTER TABLE `logradouros`
  MODIFY `id_endereco` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `noivos`
--
ALTER TABLE `noivos`
  MODIFY `id_noivos` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pastorais_movimentos_grupos`
--
ALTER TABLE `pastorais_movimentos_grupos`
  MODIFY `id_pastoral` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id_pessoa` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sacramentos`
--
ALTER TABLE `sacramentos`
  MODIFY `id_sacramento` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `sexos`
--
ALTER TABLE `sexos`
  MODIFY `id_sexo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `situacoes`
--
ALTER TABLE `situacoes`
  MODIFY `id_situacao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `telefones`
--
ALTER TABLE `telefones`
  MODIFY `id_telefone` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipos_intencao`
--
ALTER TABLE `tipos_intencao`
  MODIFY `id_tipo` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tipo_intencoes`
--
ALTER TABLE `tipo_intencoes`
  MODIFY `id_intencao` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `titulos_clero`
--
ALTER TABLE `titulos_clero`
  MODIFY `id_titulo` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `enderecos`
--
ALTER TABLE `enderecos`
  ADD CONSTRAINT `fk_logradouros_enderecos` FOREIGN KEY (`logradouro`) REFERENCES `enderecos` (`id_endereco`);

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
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
