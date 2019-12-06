-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 06-Dez-2019 às 21:04
-- Versão do servidor: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_arquivo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_autorizados`
--

CREATE TABLE IF NOT EXISTS `tb_autorizados` (
  `cod_autorizado` varchar(4) COLLATE latin1_bin NOT NULL COMMENT 'Identificador do Autorizado',
  `nom_autorizado` varchar(50) COLLATE latin1_bin NOT NULL COMMENT 'Nome do Autorizado',
  `emp_autorizado` varchar(50) COLLATE latin1_bin NOT NULL COMMENT 'Empresa do Autorizado',
  `cel_autorizado` varchar(15) COLLATE latin1_bin NOT NULL,
  `tel_autorizado` varchar(15) COLLATE latin1_bin DEFAULT NULL,
  `set_autorizado` varchar(40) COLLATE latin1_bin NOT NULL,
  `fun_autorizado` varchar(40) COLLATE latin1_bin NOT NULL,
  `log_autorizado` varchar(25) COLLATE latin1_bin DEFAULT NULL,
  `email_autorizado` varchar(60) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin COMMENT='Informações do pessoas autorizadas a ter acesso as informacoes dos documentos';

--
-- Extraindo dados da tabela `tb_autorizados`
--

INSERT INTO `tb_autorizados` (`cod_autorizado`, `nom_autorizado`, `emp_autorizado`, `cel_autorizado`, `tel_autorizado`, `set_autorizado`, `fun_autorizado`, `log_autorizado`, `email_autorizado`) VALUES
('0002', 'Bruno Barros', 'CEMEC', '85987234013', '86987234013', 'TI', 'COORDENADOR', 'CelioBarros', 'bruno@gmail.com'),
('0003', 'Camila Barros', 'ITARGETt', '11', '121', 'TI', 'Consultora', 'camila', 'camila@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresas`
--

CREATE TABLE IF NOT EXISTS `tb_empresas` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `des_empresa` varchar(255) COLLATE latin1_bin NOT NULL,
  `ati_empresa` char(1) COLLATE latin1_bin NOT NULL DEFAULT 'S',
  `pad_empresa` char(1) COLLATE latin1_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin COMMENT='Informações das empresas';

--
-- Extraindo dados da tabela `tb_empresas`
--

INSERT INTO `tb_empresas` (`cod_empresa`, `des_empresa`, `ati_empresa`, `pad_empresa`) VALUES
('006', 'Empresa 006', 'S', 'N'),
('007', 'Empresa 007', 'S', 'N'),
('011', 'Empresa xx', 'S', 'N'),
('021', 'Empresa xx', 'S', 'N'),
('022', 'Empresa ULTIMA', 'S', 'N'),
('023', 'teste', 'S', 'N'),
('024', 'qwuqiwu', 'S', 'N'),
('025', 'EMPRESA 25', 'S', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_usuarios` (
`id_usu` int(11) NOT NULL COMMENT 'Identificado do Usuario',
  `log_usuario` varchar(35) COLLATE latin1_bin NOT NULL COMMENT 'Login do Usuario',
  `sen_usuario` varchar(10) COLLATE latin1_bin NOT NULL COMMENT 'Senha do Usuario',
  `sta_usuario` varchar(30) COLLATE latin1_bin NOT NULL DEFAULT '""' COMMENT 'Status de Usuario Logado-Guarda MAC da Maquina',
  `per_usuario` char(1) COLLATE latin1_bin NOT NULL DEFAULT '0' COMMENT 'Perfil do usuario  0-Padrao 1-Administrador'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=1 ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_autorizados`
--
ALTER TABLE `tb_autorizados`
 ADD PRIMARY KEY (`cod_autorizado`);

--
-- Indexes for table `tb_empresas`
--
ALTER TABLE `tb_empresas`
 ADD PRIMARY KEY (`cod_empresa`), ADD KEY `des_empresa` (`des_empresa`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
 ADD PRIMARY KEY (`id_usu`), ADD UNIQUE KEY `log_usuario` (`log_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificado do Usuario';
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
