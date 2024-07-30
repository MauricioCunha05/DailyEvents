-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           10.4.25-MariaDB - mariadb.org binary distribution
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              12.0.0.6468
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Copiando estrutura do banco de dados para dailyevent
DROP DATABASE IF EXISTS `dailyevent`;
CREATE DATABASE IF NOT EXISTS `dailyevent` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `dailyevent`;

-- Copiando estrutura para tabela dailyevent.calendario
DROP TABLE IF EXISTS `calendario`;
CREATE TABLE IF NOT EXISTS `calendario` (
  `id_calendario` int(11) NOT NULL AUTO_INCREMENT,
  `ano_letivo` year(4) DEFAULT NULL,
  `id_ue` int(11) DEFAULT NULL,
  `dt_pub` date DEFAULT NULL,
  `versao_cal` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_calendario`),
  KEY `FK_calendario_ue` (`id_ue`),
  CONSTRAINT `FK_calendario_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.calendario: ~9 rows (aproximadamente)
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(0, '2022', 0, '2022-11-22', 1);
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(1, '2023', 0, '2022-11-30', 1);
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(2, '2022', 12, '2022-12-01', 2);
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(3, '2022', 2, NULL, 1);
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(9, '2022', 2, '2022-11-23', 0);
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(10, '2022', 2, '2022-11-24', 0);
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(15, '2023', 12, '2022-11-30', 0);
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(16, '2022', 12, '2022-11-26', 0);
REPLACE INTO `calendario` (`id_calendario`, `ano_letivo`, `id_ue`, `dt_pub`, `versao_cal`) VALUES
	(17, '2022', 21, '2022-12-02', 2);

-- Copiando estrutura para tabela dailyevent.eventos
DROP TABLE IF EXISTS `eventos`;
CREATE TABLE IF NOT EXISTS `eventos` (
  `id_evento` int(11) NOT NULL AUTO_INCREMENT,
  `dt_ini_ev` date DEFAULT NULL,
  `dt_fim_ev` date DEFAULT NULL,
  `id_calendario` int(11) DEFAULT NULL,
  `id_leg` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_evento`) USING BTREE,
  KEY `FK_eventos_calendario` (`id_calendario`),
  KEY `FK_eventos_legenda` (`id_leg`),
  CONSTRAINT `FK_eventos_calendario` FOREIGN KEY (`id_calendario`) REFERENCES `calendario` (`id_calendario`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_eventos_legenda` FOREIGN KEY (`id_leg`) REFERENCES `legenda` (`id_leg`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dailyevent.eventos: ~51 rows (aproximadamente)
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(3, '2022-04-28', '2022-04-28', 2, 3);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(4, '2022-08-05', '2022-08-05', 2, 4);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(7, '2022-10-26', '2022-10-28', 2, 7);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(8, '2022-07-18', '2022-07-30', 2, 8);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(9, '2022-03-01', '2022-03-01', 2, 9);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(10, '2022-02-14', '2022-02-14', 2, 10);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(11, '2022-10-16', '2022-10-16', 2, 11);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(12, '2022-02-02', '2022-02-02', 2, 12);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(13, '2022-01-01', '2022-02-01', 2, 13);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(14, '2022-02-15', '2022-02-19', 2, 14);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(16, '2022-12-21', '2022-12-21', 2, 16);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(18, '2022-05-28', '2022-05-28', 2, 18);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(19, '2022-09-03', '2022-09-03', 2, 19);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(20, '2022-11-26', '2022-11-26', 2, 20);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(21, '2022-12-19', '2022-12-20', 2, 21);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(22, '2022-11-28', '2022-12-17', 2, 22);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(23, '2022-08-16', '2022-08-20', 2, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(24, '2022-11-16', '2022-11-19', 2, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(25, '2022-11-14', '2022-11-14', 2, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(26, '2022-04-15', '2022-04-15', 2, 9);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(27, '2022-11-02', '2022-11-02', 2, 9);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(28, '2022-09-07', '2022-09-07', 2, 9);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(29, '2022-10-12', '2022-10-12', 2, 9);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(30, '2022-11-15', '2022-11-15', 2, 9);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(31, '2022-06-16', '2022-06-16', 2, 9);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(32, '2022-04-21', '2022-04-21', 2, 9);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(33, '2022-08-08', '2022-08-13', 2, 1);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(34, '2022-11-07', '2022-11-12', 2, 1);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(35, '2022-08-26', '2022-08-26', 2, 15);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(36, '2022-11-21', '2022-11-21', 2, 15);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(37, '2022-11-23', '2022-11-24', 2, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(38, '2022-08-01', '2022-08-02', 2, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(39, '2022-06-11', '2022-06-11', 2, 6);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(40, '2022-09-17', '2022-09-17', 2, 6);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(41, '2022-02-03', '2022-02-12', 2, 23);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(63, '2022-09-08', '2022-09-27', 3, 3);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(64, '2022-01-01', '2022-01-29', 3, 11);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(66, '2022-11-04', '2022-11-22', 2, 7);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(68, '2022-11-05', '2022-11-24', 0, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(71, '2022-02-06', '2022-02-27', 0, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(74, '2022-11-05', '2022-11-24', 2, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(76, '2022-02-06', '2022-02-27', 2, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(77, '2022-02-06', '2022-02-27', 2, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(78, '2022-02-06', '2022-02-27', 2, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(79, '2022-11-05', '2022-11-24', 2, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(84, '2023-05-05', '2023-05-20', 1, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(91, '2022-11-05', '2022-11-05', 2, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(92, '2022-02-06', '2022-02-06', 2, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(93, '2022-02-06', '2022-02-07', 2, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(94, '2022-11-05', '2022-11-05', 2, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(100, '2022-01-01', '2022-01-31', 17, 35);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(101, '2022-01-01', '2022-01-31', 17, 13);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(102, '2022-02-07', '2022-02-10', 17, 2);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(103, '2022-11-10', '2022-11-20', 17, 5);
REPLACE INTO `eventos` (`id_evento`, `dt_ini_ev`, `dt_fim_ev`, `id_calendario`, `id_leg`) VALUES
	(104, '2022-12-13', '2022-12-22', 17, 8);

-- Copiando estrutura para tabela dailyevent.funcionario
DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `id_func` int(11) NOT NULL AUTO_INCREMENT,
  `mat_func` int(11) DEFAULT NULL,
  `funcao_func` varchar(10) DEFAULT NULL,
  `nome_func` varchar(20) DEFAULT NULL,
  `nasc_func` date DEFAULT NULL,
  `sexo_func` char(1) DEFAULT NULL,
  `tel_func` char(11) DEFAULT NULL,
  `cpf_func` char(11) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  `id_ue` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_func`) USING BTREE,
  KEY `FK_funcionario_localidade` (`cep`),
  KEY `FK_funcionario_ue` (`id_ue`),
  CONSTRAINT `FK_funcionario_localidade` FOREIGN KEY (`cep`) REFERENCES `localidade` (`cep`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `FK_funcionario_ue` FOREIGN KEY (`id_ue`) REFERENCES `ue` (`id_ue`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=42 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.funcionario: ~30 rows (aproximadamente)
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(1, 1, 'Supervisor', 'Kael', '2000-07-15', 'f', '23573859234', '34234234344', 2147483647, 1);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(2, 2, 'Supervisor', 'Dangelo', '2000-07-05', 'm', '23573859234', '34234234344', 26600000, 2);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(3, 3, 'Supervisor', 'Sawyer', '2022-11-01', 'm', '23573859234', '34234234344', 20271202, 3);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(4, 4, 'Supervisor', 'Drew', '2000-07-02', 'm', '23573859234', '34234234344', 21073460, 4);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(5, 5, 'Supervisor', 'Eugene', '2000-07-10', 'm', '23573859234', '34234234344', 28016812, 5);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(6, 6, 'Supervisor', 'Jase', '2000-07-10', 'f', '23573859234', '34234234344', 57085, 6);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(7, 7, 'Supervisor', 'Reece', '2000-07-10', 'm', '23573859234', '34234234344', 21311281, 7);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(8, 8, 'Supervisor', 'Claire', '2000-07-10', 'f', '23573859234', '34234234344', 26221080, 8);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(9, 9, 'Supervisor', 'Rayna', '2000-07-10', 'f', '23573859234', '34234234344', 25266006, 9);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(10, 10, 'Supervisor', 'Zavier', '2000-07-10', 'm', '23573859234', '34234234344', 26221080, 10);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(11, 11, 'Supervisor', 'Clarissa', '2000-07-10', 'f', '23573859234', '34234234344', 24110305, 11);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(12, 12, 'Supervisor', 'Jamarcus', '2000-07-10', 'm', '23573859234', '34234234344', 57085, 12);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(13, 13, 'Supervisor', 'Lola', '2000-07-10', 'f', '23573859234', '34234234344', 28993000, 13);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(14, 14, 'Supervisor', 'Jade', '2000-07-10', 'f', '23573859234', '34234234344', 9991060, 14);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(15, 15, 'Supervisor', 'Emilia', '2000-07-10', 'f', '23573859234', '34234234344', 26221080, 15);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(16, 16, 'Supervisor', 'Jacqueline', '2000-07-10', 'f', '23573859234', '34234234344', 57085, 16);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(17, 17, 'Supervisor', 'Claudia', '2000-07-10', 'f', '23573859234', '34234234344', NULL, 17);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(18, 18, 'Supervisor', 'Selma', '2000-07-10', 'f', '23573859234', '34234234344', NULL, 18);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(19, 19, 'Supervisor', 'Marcelo', '2000-07-10', 'm', '23573859234', '34234234344', NULL, 19);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(20, 20, 'Supervisor', 'João', '2000-07-10', 'm', '23573859234', '34234234344', NULL, 20);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(21, 21, 'Administra', 'Emanuel', '2000-07-10', NULL, '23573859234', '34234234344', NULL, 21);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(22, 1123, 'ASD', 'Renan', '2000-07-10', 'm', '23573859234', '112.341.241', 12412412, 1);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(23, 124, 'aasdawdaw', 'Clarissa', '2000-07-10', 'f', '23573859234', '(12) 412412', 32523523, 1);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(24, 12312, 'aasdawdaw', 'Jéssica', '2000-07-10', 'f', '23573859234', '12534564634', 76900970, 1);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(25, 2352, 'awdawd', 'Guilherme', '2000-07-10', 'm', '23573859234', '3456346346_', 34634634, 6);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(26, 2342, 'aasdawdaw', 'Thiago', '2000-07-10', 'm', '23573859234', '34636346___', 49035200, 4);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(32, 345235, 'ASD', 'Steve', '2022-11-10', 'm', '23523525352', '43643636236', 87202340, 19);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(37, 5345235, 'aasdawdaw', '12312', '2022-11-09', 'f', '23523523523', '52352352353', 57085, 5);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(39, 5345235, 'aasdawdaw', '12312', '2022-11-03', 'm', '42342342342', '23523523523', 57085813, 4);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(40, 35235, 'aasdawdaw', 'sgseg', '2022-11-03', 'm', '23523523523', '12523523523', 57050090, 4);
REPLACE INTO `funcionario` (`id_func`, `mat_func`, `funcao_func`, `nome_func`, `nasc_func`, `sexo_func`, `tel_func`, `cpf_func`, `cep`, `id_ue`) VALUES
	(41, 21234421, 'ASD', 'fdsfsef', '2022-11-01', 'f', '23523523523', '55235235345', 57050090, 4);

-- Copiando estrutura para tabela dailyevent.legenda
DROP TABLE IF EXISTS `legenda`;
CREATE TABLE IF NOT EXISTS `legenda` (
  `id_leg` int(11) NOT NULL AUTO_INCREMENT,
  `tipo_evento` varchar(50) DEFAULT NULL,
  `desc_leg` varchar(60) DEFAULT NULL,
  `simbolo_leg` varchar(100) DEFAULT NULL,
  `sigla_leg` varchar(4) DEFAULT NULL,
  `cor_leg` varchar(9) DEFAULT NULL,
  PRIMARY KEY (`id_leg`)
) ENGINE=InnoDB AUTO_INCREMENT=36 DEFAULT CHARSET=utf8;

-- Copiando dados para a tabela dailyevent.legenda: ~24 rows (aproximadamente)
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(1, 'Avaliação', 'Teste de aceitabilidade do que foi aprendido.', '/admin/static/img/simbolos/paste-solid.png', 'AV', '#46adfb');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(2, 'Conselho de Classe', 'Colegiado escolar.', '/admin/static/img/simbolos/people-group-solid.png', 'CoC', '#fc03c6');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(3, 'FLOT', 'Projeto literário elaborado pelo GEOT e docentes.', '/admin/static/img/simbolos/book-fill.png', 'FLOT', '#ee3f3f');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(4, 'Feira de Ciência', 'Evento que costuma durar um dia.', '/admin/static/img/simbolos/florin-sign-solid.png', 'FC', '#650372');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(5, 'Recuperação', 'Programa de aulas extras para recuperação de notas.', '/admin/static/img/simbolos/graph-down.png', 'R', '#f3721b');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(6, 'Reunião com Responsáveis', 'Reunião que aborda pautas coletivas sobre as turmas.', '/admin/static/img/simbolos/people-fill.png', 'RR', '#bf1d1f');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(7, 'Feira Técnica', 'Projeto anual organizado pela escola.', '/admin/static/img/simbolos/award-solid.png', 'FT', '#0228c0');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(8, 'Recesso Escolar', 'Pausa de reorganização para as atividades letivas.', '/admin/static/img/simbolos/sun.png', 'RE', '#ece4e4');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(9, 'Feriados', 'Dias não úteis determinados pelas autoridades.', '/admin/static/img/simbolos/sunglasses.png', 'F', '#0da054');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(10, 'início do ano letivo', 'Período em que as aulas começam oficialmente.', '/admin/static/img/simbolos/circle-solid.png', 'IAL', '#1e7a8a');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(11, 'Dia do professor', 'Data comemorativa que homenageia esses profissionais.', '/admin/static/img/simbolos/suit-heart-fill.png', '', '#f9aeae');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(12, 'Retorno do professor', 'Retorno dos professores às unidades escolares.', '/admin/static/img/simbolos/hand-index-thumb-fill.png', '', '#f278d1');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(13, 'Férias', 'Período de descanso para estudantes e funcionários.', '/admin/static/img/simbolos/sunrise.png', '', '#e1ff00');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(14, 'Acolhimento dos discentes', 'Acolhimento dos alunos que estão iniciando o ano.', '/admin/static/img/simbolos/people-roof-solid.png', '', '#eccb55');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(15, 'Lançamento de notas', 'Registro dos resultados das avaliações. ', '/admin/static/img/simbolos/pen-to-square-solid.png', '', '#02f72b');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(16, 'Resultado final', 'Documento que registra o resultado final de todos os alunos.', '/admin/static/img/simbolos/r-solid.png', '', '#ee4983');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(18, 'Término da 1º etapa', 'Encerramento da primeira etapa.', '/admin/static/img/simbolos/1-solid.png', '', '#fc0303');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(19, 'Término da 2º etapa', 'Encerramento da segunda etapa.', '/admin/static/img/simbolos/2-solid.png', '', '#fc0303');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(20, 'Término da 3º etapa', 'Encerramento da terceira etapa.', '/admin/static/img/simbolos/3-solid.png', '', '#fc0303');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(21, 'Conselho de Classe Final', 'Avaliações de fim de ano.', '/admin/static/img/simbolos/people-group-solid.png', 'CoC', '#d92083');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(22, 'Recuperação Final', 'Última avaliação para os alunos com notas baixas.', '/admin/static/img/simbolos/people-group-solid.png', '', '#a59797');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(23, 'Planejamento', 'planejamento da semana de acolhimento', '/admin/static/img/simbolos/gear-fill.png', 'P', '#d27474');
REPLACE INTO `legenda` (`id_leg`, `tipo_evento`, `desc_leg`, `simbolo_leg`, `sigla_leg`, `cor_leg`) VALUES
	(35, 'TESTE', 'TESTE', '/admin/static/img/simbolos/hypnotize.png.', 'T', '#c33232');

-- Copiando estrutura para tabela dailyevent.localidade
DROP TABLE IF EXISTS `localidade`;
CREATE TABLE IF NOT EXISTS `localidade` (
  `cep` int(11) NOT NULL,
  `uf` char(2) DEFAULT NULL,
  `cidade` varchar(30) DEFAULT NULL,
  `bairro` varchar(30) DEFAULT NULL,
  `logradouro` varchar(30) DEFAULT NULL,
  `numero` varchar(6) DEFAULT NULL,
  `complemento` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`cep`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.localidade: ~36 rows (aproximadamente)
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(1223, '', '', '', '', '12', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(57085, 'RJ', 'Rio de Janeiro', 'Santa Cruz', 'Largo do Bodegão', '46', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(9991060, 'SP', 'Diadema', 'Conceição', 'Rua Guarani', '735', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(12412412, '', '', '', '', '123', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(13512352, '', '', '', '', '25', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(20271202, 'RJ', 'Rio de Janeiro', 'Maracanã', 'Rua General Canabarro', '291', 'até 345 - lado ímpar');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(20941160, 'RJ', 'Rio de Janeiro', 'Maracanã', 'Bartolomeu de Gusmão', '846', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(21073460, 'RJ', 'Rio de Janeiro', 'Olaria', 'Paranhos', NULL, NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(21240535, 'RJ', 'Rio de Janeiro', 'Jardim América', 'Jornalista Antônio de Freitas', '75', '(NULL)');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(21311281, 'RJ', 'Rio de Janeiro', 'Centro', '20 de Abril', '14', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(21610210, 'RJ', 'Rio de Janeiro', 'Marechal Hermes', 'João Vicente', '1775', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(21610211, 'RJ', 'Rio de janeiro', 'Deodoro', 'São Vicente', '2151', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(21610330, 'RJ', 'Rio de Janeiro', 'Marechal Hermes', 'Xavier Curado', 's/n', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(21625001, 'RJ', 'Rio de Janeiro', 'Ricardo de Albuquerque', 'Estrada Marechal Alencastro', '5', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(23523523, '', '', '', '', '100', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(23552352, '', '', '', '', '34', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(24110305, 'RJ', 'Niterói', 'Barreto', 'Guimarães Junior', '182', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(25266006, 'RJ', 'Duque de Caxias', 'Santa Lucia', 'Avenida Vitória', '841', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(26221080, 'RJ', 'Nova Iguaçu', 'Centro', 'Luiz de Lima', '272', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(26600000, 'RJ', 'Paracambi', 'Fábrica', 'Dom Pedro II', 's/n', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(27210240, 'RJ', 'Volta Redonda', 'Santo Agostinho', 'Mil e Quinze', 's/n', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(27330052, 'RJ', 'Barra Mansa', 'Barbará', 'Rodovia Sérgio Braga', 's/n', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(28016812, 'RJ', 'Campos dos Goytacazes', 'Parque California', 'Avenida Alberto Lamego', '712', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(28993000, 'RJ', 'Saquarema', 'Bacaxa', 'Capitão Nunes', 's/n', NULL);
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(32523523, '', '', '', '', '35', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(34634634, '', '', '', '', '262623', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(49035200, 'SE', 'Aracaju', 'Coroa do Meio', 'Rua Doutor Álvaro Santana', '12', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(57050090, 'AL', 'Maceió', 'Farol', 'Rua Oldemburgo da Silva Paranh', '23', 'até 179 - lado ímpar');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(57075585, 'AL', 'Maceió', 'Santos Dumont', 'Rua Supervisor Ivaldo Ferino', '34', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(57085813, '', '', '', '', '34', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(60346218, 'CE', 'Fortaleza', 'Jardim Guanabara', 'Rua Professora Maria Clara', '100', 'de 780/781 a 1648/16');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(68909501, 'AP', 'Macapá', 'Boné Azul', 'Avenida Rio Amazonas', '43', '(Lot. A. Ville)');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(69021370, 'AM', 'Manaus', 'Tarumã', 'Rua Marques Rabelo', '22', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(69903545, '', '', '', '', '23', '');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(76900970, 'RO', 'Ji-Paraná', 'Centro', 'Avenida Marechal Rondon', '12', '721');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(87202340, 'PR', 'Cianorte', 'Residencial Ilha do Mel', 'Rua Cabo Frio', '223', 'de 437 a 489 - lado ');
REPLACE INTO `localidade` (`cep`, `uf`, `cidade`, `bairro`, `logradouro`, `numero`, `complemento`) VALUES
	(2147483647, '', '', '', '', '847', '');

-- Copiando estrutura para tabela dailyevent.tmp_eve
DROP TABLE IF EXISTS `tmp_eve`;
CREATE TABLE IF NOT EXISTS `tmp_eve` (
  `id_evento` int(11) DEFAULT NULL,
  `dt_ini_tmp` date DEFAULT NULL,
  `dt_fim_tmp` date DEFAULT NULL,
  `id_calendario` int(11) DEFAULT NULL,
  `id_leg` int(11) DEFAULT NULL,
  `act_tmp` varchar(50) DEFAULT NULL,
  `id_tmp` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id_tmp`),
  KEY `FK_tmp_eve_eventos` (`id_evento`)
) ENGINE=InnoDB AUTO_INCREMENT=304 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.tmp_eve: ~1 rows (aproximadamente)
REPLACE INTO `tmp_eve` (`id_evento`, `dt_ini_tmp`, `dt_fim_tmp`, `id_calendario`, `id_leg`, `act_tmp`, `id_tmp`) VALUES
	(0, '2022-12-01', '2022-12-21', 0, 5, 'add', 290);

-- Copiando estrutura para tabela dailyevent.ue
DROP TABLE IF EXISTS `ue`;
CREATE TABLE IF NOT EXISTS `ue` (
  `id_ue` int(11) NOT NULL AUTO_INCREMENT,
  `tel_ue` char(10) DEFAULT NULL,
  `nome_ue` varchar(100) DEFAULT NULL,
  `sigla_ue` varchar(7) DEFAULT NULL,
  `email_ue` varchar(50) DEFAULT NULL,
  `logo_ue` varchar(100) DEFAULT NULL,
  `cep` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_ue`),
  KEY `FK_ue_localidade` (`cep`),
  CONSTRAINT `FK_ue_localidade` FOREIGN KEY (`cep`) REFERENCES `localidade` (`cep`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8mb4;

-- Copiando dados para a tabela dailyevent.ue: ~22 rows (aproximadamente)
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(0, NULL, 'DDE', 'DDE', NULL, NULL, NULL);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(1, '2123324085', 'Escola Técnica Estadual República', 'ETER', 'caq@faetec.rj.gov.br', NULL, 2147483647);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(2, '2123341741', 'Escola Técnica Estadual Ferreira Viana', 'ETEFV', 'etefv@faetec.rj.gov.br', 'C:/xampp/htdocs/admin/static/img/logo_ue/ETEFV.png', 20271202);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(3, '2123341738', 'Escola Técnica Estadual Adolpho Bloch', 'ETEAB', 'eteab@faetec.rj.gov.br', NULL, 20941160);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(4, '2123338337', 'Escola Técnica Estadual Juscelino Kubitschek', 'ETEJK', 'juscelinokubitscheck@sectec.rio.gov.br', NULL, 21240535);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(5, '2123329721', 'Escola Técnica Estadual de Teatro Martins Pena', 'ETETMP', 'direcaomartinspena@yahoo.com.br', NULL, 21311281);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(6, '2123321063', 'Escola Tecnica Estadual Visconde de Mauá', 'ETEVM', 'etevm@faetec.rj.gov.br', NULL, 21610210);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(7, '2123321056', 'Escola Tecnica Estadual Oscar Tenório', 'ETEOT', 'secretaria.eteot@oi.com.br', NULL, 21610330);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(8, '2123337225', 'Escola Técnica Estadual Santa Cruz', 'ETESC', 'etesc@faetec.rj.gov.br', NULL, 57085);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(9, '2127259148', 'Escola Técnica Estadual Henrique Lage', 'ETEHL', 'secretaria.etehl@faetec.rio.gov.br', NULL, 24110305);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(10, '2127871011', 'Escola Tecnica Estadual Imbariê', 'ETEIMB', ' eteimbarie@gmail.com', NULL, 25266006);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(11, '2123339545', 'Escola Técnica de Transporte Engenheiro Silva Freire', 'ETTESF', 'engsilvafreire@gmail.com', NULL, 21610211);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(12, '1140561362', 'Escola Técnica Estadual Juscelino Kubitschek de Oliveira', 'ETEJKO', 'e166dir@cps.sp.gov.br', NULL, 9991060);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(13, '2433244889', 'Escola Técnica Estadual Barra Mansa', 'ETEBM', 'cvtbarramansa@gmail.com', NULL, 27330052);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(14, '2226513014', 'Escola Técnica Estadual Helber Vignoli Muniz', 'ETEHVM', 'equipegestora2015@hotmail.com', NULL, 28993000);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(15, '2227386595', 'Escola Técnia Estadual João Barcelos Martins ', 'ETEJBM', 'secretariajbm@yahoo.com.br', NULL, 28016812);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(16, '2126694808', 'Escola Técnica Estadual João Luiz do Nascimento', 'ETEJLN', 'etejln@faetec.rj.gov.br', NULL, 26221080);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(17, '2133571807', 'ETE Mercedes Mendes Teixeira ', 'ETEMMT', 'etmmmt@faetec.rj.gov.br', NULL, 21625001);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(18, '2136933224', 'Escola Técnica Estadual Paracambi', 'ETEP', 'secretaria@eteprc.faetec.rj.gov.br', NULL, 26600000);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(19, '2433456781', 'ETP Amaury Cesar Vieira', 'ETEACV', 'eteacv@faetec.rj.gov.br', NULL, 27210240);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(20, '2123347497', 'FAETEC Alemão Unidade Paranhos Olaria', 'ALEMAO', 'aupo@faetec.rio.gov.br', NULL, 21073460);
REPLACE INTO `ue` (`id_ue`, `tel_ue`, `nome_ue`, `sigla_ue`, `email_ue`, `logo_ue`, `cep`) VALUES
	(21, NULL, 'Escola Técnica Estadual UE', 'ETEUE', NULL, NULL, NULL);

-- Copiando estrutura para tabela dailyevent.usuarios
DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id_func` int(11) NOT NULL,
  `usuario` varchar(25) CHARACTER SET utf8mb4 DEFAULT NULL,
  `senha` varchar(40) CHARACTER SET utf8mb4 DEFAULT NULL,
  `nivel` int(1) unsigned DEFAULT 1,
  `foto_perfil` varchar(100) DEFAULT NULL,
  `ativo` int(11) DEFAULT NULL,
  PRIMARY KEY (`id_func`) USING BTREE,
  UNIQUE KEY `usuario` (`usuario`) USING BTREE,
  KEY `nivel` (`nivel`) USING BTREE,
  CONSTRAINT `FK_usuarios_funcionario` FOREIGN KEY (`id_func`) REFERENCES `funcionario` (`id_func`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Copiando dados para a tabela dailyevent.usuarios: ~21 rows (aproximadamente)
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(1, 'SUPETER', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(2, 'SUPETEFV', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(3, 'SUPETEAB', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(4, 'SUPETEJK', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(5, 'SUPETETMP', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(6, 'SUPETEVM', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(7, 'SUPETEOT', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(8, 'SUPETESC', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(9, 'SUPETEHL', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(10, 'SUPETEIMB', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(11, 'SUPETTESF', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(12, 'SUPETEJKO', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(13, 'SUPETEBM', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(14, 'SUPETEHVM', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(15, 'SUPETEJBM', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(16, 'SUPETEJLN', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(17, 'SUPETEMMT', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(18, 'SUPETEP', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(19, 'SUPETEACV', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(20, 'SUPALEMAO', '123', 1, NULL, 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(21, 'ADMIN', '123', 2, '', 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(22, 'fgw3', 'w3gw3', 1, '1', 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(23, 'efgw4', 'g34g', 2, '', 1);
REPLACE INTO `usuarios` (`id_func`, `usuario`, `senha`, `nivel`, `foto_perfil`, `ativo`) VALUES
	(32, 'SUPETEUE', '123', 1, '', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
