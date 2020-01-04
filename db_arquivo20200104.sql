-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 04-Jan-2020 às 19:18
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
-- Estrutura da tabela `tb_arquivos`
--

CREATE TABLE IF NOT EXISTS `tb_arquivos` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `des_arquivo` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `tb_arquivos`
--

INSERT INTO `tb_arquivos` (`cod_empresa`, `cod_arquivo`, `des_arquivo`) VALUES
('011', '01', 'ARQUIVO 001'),
('011', '02', 'ARQUIVO 002'),
('011', '03', 'ARQUIVO 003'),
('021', '01', 'arquivo 002');

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
  `log_autorizado` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `email_autorizado` varchar(60) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin COMMENT='Informações do pessoas autorizadas a ter acesso as informacoes dos documentos';

--
-- Extraindo dados da tabela `tb_autorizados`
--

INSERT INTO `tb_autorizados` (`cod_autorizado`, `nom_autorizado`, `emp_autorizado`, `cel_autorizado`, `tel_autorizado`, `set_autorizado`, `fun_autorizado`, `log_autorizado`, `email_autorizado`) VALUES
('0001', 'CELIO BARROS', 'infosys ltda', '85987234013', '85987234013', 'TI', 'COORDENADOR', 'celio', 'celio@gmail.com'),
('0002', 'roberta', 'MARK ENGENHARIA', '1211', '121', 'ARQUITETURA', 'COORDENARDORO', 'roberta', 'ROBERT@EMILA.COM'),
('0003', 'CAMILA', 'ESCRITO DE ADVOGADOS', '212', '12', 'EMPRESA', 'COORDENARDOC', 'roberta', 'camila@gmail.com1'),
('0013', 'CESA', 'ASDJA', 'JJKJ', 'KJL', 'ASDJK', 'KJLK', 'roberta', 'JKL'),
('0014', 'Bruno', 'J MACEDO - CAP', '1212', '12', 'MARKETING DIGITAL', 'COORDENADOR', 'bruno', 'bruno@gmail.com');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_caixas`
--

CREATE TABLE IF NOT EXISTS `tb_caixas` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_setor` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_caixa` varchar(5) COLLATE latin1_bin NOT NULL,
  `des_caixa` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `tb_caixas`
--

INSERT INTO `tb_caixas` (`cod_empresa`, `cod_setor`, `cod_caixa`, `des_caixa`) VALUES
('011', '001', '00001', 'CAIXA 0002');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_corredores`
--

CREATE TABLE IF NOT EXISTS `tb_corredores` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `cod_corredor` varchar(3) COLLATE latin1_bin NOT NULL,
  `des_corredor` varchar(50) COLLATE latin1_bin NOT NULL,
  `sig_corredor` varchar(15) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `tb_corredores`
--

INSERT INTO `tb_corredores` (`cod_empresa`, `cod_arquivo`, `cod_corredor`, `des_corredor`, `sig_corredor`) VALUES
('011', '01', '001', 'CORREDOR 001', 'CONTAB'),
('011', '01', '002', 'CORREDOR 002', '002'),
('011', '01', '003', 'corredor 003 ', '003'),
('011', '01', '004', 'CORREDOR 004 ', '004'),
('011', '02', '001', 'CORREDOR 01 ARQUIVO 002', 'CORREDOR 02'),
('011', '02', '002', 'CORREDOR INFORMATICA', 'INFO'),
('021', '01', '001', 'CORREDOR 002', 'CORR');

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
('011', 'CEMEC Construcoes Eletromecanicas SA', 'S', 'N'),
('021', 'Sigma Processamento de Dados', 'S', 'N');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estantes`
--

CREATE TABLE IF NOT EXISTS `tb_estantes` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `cod_corredor` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_estante` varchar(3) COLLATE latin1_bin NOT NULL,
  `des_estante` varchar(50) COLLATE latin1_bin NOT NULL,
  `sig_estante` varchar(15) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `tb_estantes`
--

INSERT INTO `tb_estantes` (`cod_empresa`, `cod_arquivo`, `cod_corredor`, `cod_estante`, `des_estante`, `sig_estante`) VALUES
('011', '01', '001', '001', 'estante 001', 'esta001'),
('011', '01', '002', '001', 'ESTANTE', 'ESTA 001'),
('021', '01', '001', '001', 'ESTANTE 001', 'EST001');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_prateleiras`
--

CREATE TABLE IF NOT EXISTS `tb_prateleiras` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `cod_corredor` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_estante` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_prateleira` varchar(2) COLLATE latin1_bin NOT NULL,
  `des_prateleira` varchar(50) COLLATE latin1_bin NOT NULL,
  `sig_prateleira` varchar(15) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `tb_prateleiras`
--

INSERT INTO `tb_prateleiras` (`cod_empresa`, `cod_arquivo`, `cod_corredor`, `cod_estante`, `cod_prateleira`, `des_prateleira`, `sig_prateleira`) VALUES
('011', '01', '001', '001', '01', 'PRATELEIRA111', '123456');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_setores`
--

CREATE TABLE IF NOT EXISTS `tb_setores` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_setor` varchar(3) COLLATE latin1_bin NOT NULL,
  `des_setor` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `tb_setores`
--

INSERT INTO `tb_setores` (`cod_empresa`, `cod_setor`, `des_setor`) VALUES
('011', '001', 'INFORMATICA');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_setores_autorizados`
--

CREATE TABLE IF NOT EXISTS `tb_setores_autorizados` (
`id_setaut` int(11) NOT NULL,
  `cod_autorizado` varchar(4) COLLATE latin1_bin NOT NULL,
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_setor` varchar(3) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `tb_setores_autorizados`
--

INSERT INTO `tb_setores_autorizados` (`id_setaut`, `cod_autorizado`, `cod_empresa`, `cod_setor`) VALUES
(2, '0001', '011', '001'),
(3, '0001', '011', '001'),
(4, '0001', '011', '001');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_documentos`
--

CREATE TABLE IF NOT EXISTS `tb_tipo_documentos` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_documento` varchar(4) COLLATE latin1_bin NOT NULL,
  `des_documento` varchar(50) COLLATE latin1_bin NOT NULL,
  `sig_documento` varchar(20) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `tb_tipo_documentos`
--

INSERT INTO `tb_tipo_documentos` (`cod_empresa`, `cod_documento`, `des_documento`, `sig_documento`) VALUES
('011', '0001', 'DECLARACAO DE IMPOSTO RETIDO NA FONTE', 'DIRF'),
('021', '0001', 'NOTA FISCAL ELETRONICA', 'nfe'),
('021', '002', 'NOTA FISCAL ELETRONICA', 'NFE');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_usuarios` (
`id_usu` int(11) NOT NULL COMMENT 'Identificado do Usuario',
  `log_usuario` varchar(35) COLLATE latin1_bin NOT NULL COMMENT 'Login do Usuario',
  `sen_usuario` varchar(50) COLLATE latin1_bin NOT NULL COMMENT 'Senha do Usuario',
  `sta_usuario` varchar(30) COLLATE latin1_bin NOT NULL DEFAULT '""' COMMENT 'Status de Usuario Logado-Guarda MAC da Maquina',
  `per_usuario` char(1) COLLATE latin1_bin NOT NULL DEFAULT '0' COMMENT 'Perfil do usuario  0-Padrao 1-Administrador'
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usu`, `log_usuario`, `sen_usuario`, `sta_usuario`, `per_usuario`) VALUES
(1, 'roberta', 'MTIzNA==', 'MTIzNA==', '1'),
(2, 'bruno', 'MTIzNA==', '', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_arquivos`
--
ALTER TABLE `tb_arquivos`
 ADD PRIMARY KEY (`cod_empresa`,`cod_arquivo`);

--
-- Indexes for table `tb_autorizados`
--
ALTER TABLE `tb_autorizados`
 ADD PRIMARY KEY (`cod_autorizado`);

--
-- Indexes for table `tb_caixas`
--
ALTER TABLE `tb_caixas`
 ADD PRIMARY KEY (`cod_empresa`,`cod_setor`,`cod_caixa`);

--
-- Indexes for table `tb_corredores`
--
ALTER TABLE `tb_corredores`
 ADD PRIMARY KEY (`cod_empresa`,`cod_arquivo`,`cod_corredor`);

--
-- Indexes for table `tb_empresas`
--
ALTER TABLE `tb_empresas`
 ADD PRIMARY KEY (`cod_empresa`), ADD KEY `des_empresa` (`des_empresa`);

--
-- Indexes for table `tb_estantes`
--
ALTER TABLE `tb_estantes`
 ADD PRIMARY KEY (`cod_empresa`,`cod_arquivo`,`cod_corredor`,`cod_estante`);

--
-- Indexes for table `tb_prateleiras`
--
ALTER TABLE `tb_prateleiras`
 ADD PRIMARY KEY (`cod_empresa`,`cod_arquivo`,`cod_corredor`,`cod_estante`,`cod_prateleira`);

--
-- Indexes for table `tb_setores`
--
ALTER TABLE `tb_setores`
 ADD PRIMARY KEY (`cod_empresa`,`cod_setor`);

--
-- Indexes for table `tb_setores_autorizados`
--
ALTER TABLE `tb_setores_autorizados`
 ADD PRIMARY KEY (`id_setaut`), ADD KEY `fk_setor_setaut` (`cod_empresa`,`cod_setor`), ADD KEY `fk_autorizado_setaut` (`cod_autorizado`);

--
-- Indexes for table `tb_tipo_documentos`
--
ALTER TABLE `tb_tipo_documentos`
 ADD PRIMARY KEY (`cod_empresa`,`cod_documento`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
 ADD PRIMARY KEY (`id_usu`), ADD UNIQUE KEY `log_usuario` (`log_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_setores_autorizados`
--
ALTER TABLE `tb_setores_autorizados`
MODIFY `id_setaut` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificado do Usuario',AUTO_INCREMENT=3;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_arquivos`
--
ALTER TABLE `tb_arquivos`
ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`cod_empresa`) REFERENCES `tb_empresas` (`cod_empresa`);

--
-- Limitadores para a tabela `tb_caixas`
--
ALTER TABLE `tb_caixas`
ADD CONSTRAINT `fk_empresa_setor` FOREIGN KEY (`cod_empresa`, `cod_setor`) REFERENCES `tb_setores` (`cod_empresa`, `cod_setor`);

--
-- Limitadores para a tabela `tb_corredores`
--
ALTER TABLE `tb_corredores`
ADD CONSTRAINT `fk_empresa_arquivo` FOREIGN KEY (`cod_empresa`, `cod_arquivo`) REFERENCES `tb_arquivos` (`cod_empresa`, `cod_arquivo`);

--
-- Limitadores para a tabela `tb_estantes`
--
ALTER TABLE `tb_estantes`
ADD CONSTRAINT `fk_empresa_arquivo_corredor` FOREIGN KEY (`cod_empresa`, `cod_arquivo`, `cod_corredor`) REFERENCES `tb_corredores` (`cod_empresa`, `cod_arquivo`, `cod_corredor`);

--
-- Limitadores para a tabela `tb_prateleiras`
--
ALTER TABLE `tb_prateleiras`
ADD CONSTRAINT `fk_empresa_arquivo_corredor_estante` FOREIGN KEY (`cod_empresa`, `cod_arquivo`, `cod_corredor`, `cod_estante`) REFERENCES `tb_estantes` (`cod_empresa`, `cod_arquivo`, `cod_corredor`, `cod_estante`);

--
-- Limitadores para a tabela `tb_setores`
--
ALTER TABLE `tb_setores`
ADD CONSTRAINT `fk_empresa_set` FOREIGN KEY (`cod_empresa`) REFERENCES `tb_empresas` (`cod_empresa`);

--
-- Limitadores para a tabela `tb_setores_autorizados`
--
ALTER TABLE `tb_setores_autorizados`
ADD CONSTRAINT `fk_autorizado_setaut` FOREIGN KEY (`cod_autorizado`) REFERENCES `tb_autorizados` (`cod_autorizado`),
ADD CONSTRAINT `fk_empresa_setaut` FOREIGN KEY (`cod_empresa`) REFERENCES `tb_empresas` (`cod_empresa`),
ADD CONSTRAINT `fk_setor_setaut` FOREIGN KEY (`cod_empresa`, `cod_setor`) REFERENCES `tb_setores` (`cod_empresa`, `cod_setor`);

--
-- Limitadores para a tabela `tb_tipo_documentos`
--
ALTER TABLE `tb_tipo_documentos`
ADD CONSTRAINT `fk_empresa_tip` FOREIGN KEY (`cod_empresa`) REFERENCES `tb_empresas` (`cod_empresa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
