-- --------------------------------------------------------
-- Servidor:                     127.0.0.1
-- Versão do servidor:           8.0.29 - MySQL Community Server - GPL
-- OS do Servidor:               Win64
-- HeidiSQL Versão:              11.2.0.6213
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

-- Copiando dados para a tabela oss.cliente: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
INSERT INTO `cliente` (`id`, `nome`, `ativo`) VALUES
	(1, 'Anderson Ferguson Nunes', 1),
	(2, 'Jolemir Beting', 1),
	(3, 'Erval Rosa da Dores', 1),
	(4, 'Miguel Arcanjo', 1),
	(5, 'João Pedro da Silva', 1),
	(6, 'Maria Leopoldina da Cunha', 1),
	(7, 'Marisol da Lua', 1),
	(8, 'Anderson Roberto', 1),
	(9, 'André Amado Batista', 1),
	(10, 'Jamaica Roberto Angular', 1),
	(11, 'Michael Jackson', 1),
	(12, 'Ozzy Osbourne', 1),
	(13, 'Aviação Leopoldinense', 1),
	(14, 'Angus Young', 1),
	(15, 'Chico Xavier', 1),
	(16, 'Pedro Henrique Sampaio', 1),
	(17, 'Miguel Arcanjo', 1),
	(18, 'Anderson Roberto', 1);
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;

-- Copiando dados para a tabela oss.os: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `os` DISABLE KEYS */;
INSERT INTO `os` (`id`, `cliente`, `tecnico`, `servico`, `cancelada`) VALUES
	(1, 1, 2, 6, 0),
	(2, 9, 2, 1, 0),
	(3, 7, 2, 6, 0),
	(4, 1, 2, 8, 0),
	(5, 3, 1, 1, 0),
	(6, 10, 1, 3, 0),
	(7, 15, 1, 5, 1),
	(8, 18, 1, 6, 0);
/*!40000 ALTER TABLE `os` ENABLE KEYS */;

-- Copiando dados para a tabela oss.os_peca: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `os_peca` DISABLE KEYS */;
INSERT INTO `os_peca` (`id`, `peca`) VALUES
	(5, 4),
	(7, 4),
	(2, 5),
	(5, 5),
	(7, 5),
	(3, 6),
	(4, 6),
	(5, 6),
	(8, 6),
	(4, 7),
	(7, 7),
	(3, 8),
	(6, 8),
	(7, 8),
	(1, 9);
/*!40000 ALTER TABLE `os_peca` ENABLE KEYS */;

-- Copiando dados para a tabela oss.peca: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `peca` DISABLE KEYS */;
INSERT INTO `peca` (`id`, `nome`, `referencia`, `ativo`) VALUES
	(1, 'Pneu Aro 15', 'Pneu', 1),
	(2, 'Pneu Aro 20', 'Pneu', 1),
	(3, 'Parafuso do filtro de óleo', 'Óleo', 1),
	(4, 'Amortecedor Rockson', 'Amortecedor', 1),
	(5, 'Amortecedor Crusoé', 'Amortecedor', 1),
	(6, 'Bandeja da polia', 'Bandeja', 0),
	(7, 'Farol dianteiro do GOL', 'Faróis', 1),
	(8, 'Bucha do canhão traseiro', 'Bucha', 1),
	(9, 'Porta lateral direita', 'Funilaria', 1);
/*!40000 ALTER TABLE `peca` ENABLE KEYS */;

-- Copiando dados para a tabela oss.servico: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `servico` DISABLE KEYS */;
INSERT INTO `servico` (`id`, `nome`, `referencia`, `ativo`) VALUES
	(1, 'Troca dos amortecedores dianteiros', 'Amortecedores', 1),
	(2, 'Troca da correia dentada', 'Correias', 1),
	(3, 'Troca de óleo', 'Óleo', 1),
	(4, 'Regulagem dos freios', 'Freios', 1),
	(5, 'Troca de pneus', 'Pneus', 1),
	(6, 'Funilaria', 'Funilaria', 1),
	(7, 'Pintura', 'Pintura', 1),
	(8, 'Regulagem dos faróis', 'Faróis', 1),
	(9, 'Troca dos amortecedores traseiros', 'Amortecedores', 1);
/*!40000 ALTER TABLE `servico` ENABLE KEYS */;

-- Copiando dados para a tabela oss.tecnico: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `tecnico` DISABLE KEYS */;
INSERT INTO `tecnico` (`id`, `login`, `senha`, `nome`) VALUES
	(1, 'tecnico1', '81dc9bdb52d04dc20036dbd8313ed055', 'Técnico 1'),
	(2, 'tecnico2', '81dc9bdb52d04dc20036dbd8313ed055', 'Técnico 2');
/*!40000 ALTER TABLE `tecnico` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
