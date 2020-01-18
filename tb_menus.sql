-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Jan-2020 às 22:52
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
-- Estrutura da tabela `tb_menus`
--

CREATE TABLE IF NOT EXISTS `tb_menus` (
`id_menu` int(11) NOT NULL,
  `seq_menu` varchar(10) COLLATE latin1_bin NOT NULL,
  `nome_menu` varchar(255) COLLATE latin1_bin NOT NULL,
  `icone_menu` varchar(255) COLLATE latin1_bin NOT NULL,
  `href_menu` varchar(255) COLLATE latin1_bin NOT NULL,
  `tipo_menu` char(1) COLLATE latin1_bin NOT NULL COMMENT 'Tipo 0-Submenu 1-Acao'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=34 ;

--
-- Extraindo dados da tabela `tb_menus`
--

INSERT INTO `tb_menus` (`id_menu`, `seq_menu`, `nome_menu`, `icone_menu`, `href_menu`, `tipo_menu`) VALUES
(1, '01', 'Empresas', 'fa fa-building', 'empresas', '1'),
(2, '02', 'Autorizados', '', '', '0'),
(4, '02.1', 'Cadastro', 'fa fa-users', 'autorizado', '1'),
(5, '02.2', 'Acesso Empresa', '', 'setorautorizado&filtroAut=', '1'),
(6, '02.3', 'Acesso ao Sistema', '', '', '1'),
(7, '03', 'Localização', '', '', '0'),
(8, '03.1', 'Arquivo', '', 'arquivo', '1'),
(9, '03.2', 'Corredor', '', 'corredor&filtroEmp=', '1'),
(10, '03.3', 'Estante', '', 'estante&filtroEmp=', '1'),
(11, '03.4', 'Prateleira', '', 'prateleira&filtroEmp=', '1'),
(13, '03.5', 'Caixa', '', 'caixa&filtroEmp=', '1'),
(14, '04', 'Setor', '', 'setor', '1'),
(15, '05', 'Tipo Documento', '', 'tipodocumento', '1'),
(16, '06', 'Documento', '', '', '0'),
(17, '06.1', 'Cadastro', '', 'documento&filCodAut=&status=f', '1'),
(18, '06.2', 'Solicitaçao', '', '', '1'),
(19, '06.3', 'Destruir', '', '', '1'),
(20, '06.4', 'Historico', '', '', '1'),
(27, '07', 'Ferramenta', '', '', '0'),
(28, '07.1', 'Cadastro Usuario', 'fa fa-users', 'usuario', '1'),
(29, '07.2', 'Liberar Login', 'fa fa-unlock-alt', 'liberausuario', '1'),
(30, '07.3', 'SQL', 'fa fa-database', 'comandosql&status=f', '1'),
(31, '08', 'Historico Versões', '', '', '1'),
(32, '09', 'Contato', '', '', '1'),
(33, '10', 'Sobre', '', '', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_menus`
--
ALTER TABLE `tb_menus`
 ADD PRIMARY KEY (`id_menu`), ADD UNIQUE KEY `seq_menu` (`seq_menu`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_menus`
--
ALTER TABLE `tb_menus`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=34;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
