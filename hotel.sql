-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.27-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             12.8.0.6908
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Volcando estructura de base de datos para hotel
CREATE DATABASE IF NOT EXISTS `hotel` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `hotel`;

-- Volcando estructura para tabla hotel.clientes
CREATE TABLE IF NOT EXISTS `clientes` (
  `id_cliente` int(11) NOT NULL AUTO_INCREMENT,
  `rfc` varchar(13) DEFAULT NULL,
  `telefono` char(10) NOT NULL,
  `nombre` varchar(25) NOT NULL,
  `apellido1` varchar(15) NOT NULL,
  `apellido2` varchar(15) DEFAULT NULL,
  `correo` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`id_cliente`),
  UNIQUE KEY `rfc` (`rfc`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla hotel.clientes: ~8 rows (aproximadamente)
INSERT INTO `clientes` (`id_cliente`, `rfc`, `telefono`, `nombre`, `apellido1`, `apellido2`, `correo`) VALUES
	(1, 'LACJ070726J4', '6341055965', 'Juan Pedro de Jesus', 'Laborin', 'Chavez', 'juanpedrolc2007@gmail.com'),
	(2, 'MOBV070405V5', '6341053010', 'Victor Manuel', 'Monge', 'Bujanda', NULL),
	(3, 'MOUA070905A5', '6341054381', 'Aylin', 'Montaño', 'Urias', NULL),
	(4, 'ABC123456DFA', '5551234567', 'Juan', 'Pérez', 'Gómez', 'juan.perez@example.com'),
	(5, 'DEF789012HGA', '5559876543', 'María', 'López', 'Hernández', 'maria.lopez@example.com'),
	(6, 'GHI345678JKL', '5555678910', 'Carlos', 'Rodríguez', NULL, 'carlos.rodriguez@example.com'),
	(7, 'JKL901234MNO', '5551112233', 'Ana', 'Martínez', 'Sánchez', 'ana.martinez@example.com'),
	(8, 'MNO567890PQR', '5553344556', 'Luis', 'Hernández', 'Ortiz', NULL);

-- Volcando estructura para tabla hotel.facturas
CREATE TABLE IF NOT EXISTS `facturas` (
  `id_factura` int(11) NOT NULL AUTO_INCREMENT,
  `id_reserva` int(11) NOT NULL,
  `estatus_pago` tinyint(1) NOT NULL,
  `descripcion` varchar(130) NOT NULL,
  `fecha_factura` date NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_reserva` (`id_reserva`),
  CONSTRAINT `facturas_ibfk_1` FOREIGN KEY (`id_reserva`) REFERENCES `reservas` (`id_reserva`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla hotel.facturas: ~5 rows (aproximadamente)
INSERT INTO `facturas` (`id_factura`, `id_reserva`, `estatus_pago`, `descripcion`, `fecha_factura`) VALUES
	(2, 1, 1, 'Pago completo por estancia de 4 noches', '2024-12-01'),
	(3, 2, 0, 'Pago parcial por estancia de 4 noches', '2024-12-03'),
	(4, 3, 1, 'Reserva cancelada sin pago', '2024-11-28'),
	(5, 4, 1, 'Pago completo por estancia de 5 noches', '2024-12-10'),
	(6, 5, 1, 'Pago parcial por estancia de 5 noches', '2024-12-05');

-- Volcando estructura para tabla hotel.habitaciones
CREATE TABLE IF NOT EXISTS `habitaciones` (
  `num_habitacion` tinyint(4) NOT NULL,
  `tipo` enum('Sencillo','Doble','Doble grande') NOT NULL,
  `precio` enum('500.00','600.00','1000.00') NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  PRIMARY KEY (`num_habitacion`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla hotel.habitaciones: ~21 rows (aproximadamente)
INSERT INTO `habitaciones` (`num_habitacion`, `tipo`, `precio`, `disponibilidad`) VALUES
	(1, 'Doble', '500.00', 1),
	(2, 'Doble', '500.00', 1),
	(3, 'Sencillo', '500.00', 1),
	(4, 'Sencillo', '500.00', 1),
	(5, 'Sencillo', '500.00', 1),
	(6, 'Sencillo', '500.00', 1),
	(7, 'Doble', '600.00', 1),
	(8, 'Doble', '600.00', 1),
	(9, 'Doble', '600.00', 1),
	(10, 'Doble', '600.00', 1),
	(11, 'Sencillo', '600.00', 1),
	(12, 'Sencillo', '600.00', 1),
	(13, 'Sencillo', '600.00', 1),
	(14, 'Doble grande', '1000.00', 1),
	(15, 'Doble grande', '1000.00', 1),
	(16, 'Doble grande', '1000.00', 1),
	(17, 'Doble grande', '1000.00', 1),
	(18, 'Doble grande', '1000.00', 1),
	(19, 'Doble grande', '1000.00', 1),
	(20, 'Doble grande', '1000.00', 1),
	(21, 'Doble grande', '1000.00', 1);

-- Volcando estructura para tabla hotel.reservas
CREATE TABLE IF NOT EXISTS `reservas` (
  `id_reserva` int(11) NOT NULL AUTO_INCREMENT,
  `id_cliente` int(11) NOT NULL,
  `num_habitacion` tinyint(4) NOT NULL,
  `fecha_entrada` date NOT NULL,
  `fecha_salida` date NOT NULL,
  `estado` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_reserva`),
  KEY `id_cliente` (`id_cliente`),
  KEY `num_habitacion` (`num_habitacion`),
  CONSTRAINT `reservas_ibfk_1` FOREIGN KEY (`id_cliente`) REFERENCES `clientes` (`id_cliente`),
  CONSTRAINT `reservas_ibfk_2` FOREIGN KEY (`num_habitacion`) REFERENCES `habitaciones` (`num_habitacion`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Volcando datos para la tabla hotel.reservas: ~5 rows (aproximadamente)
INSERT INTO `reservas` (`id_reserva`, `id_cliente`, `num_habitacion`, `fecha_entrada`, `fecha_salida`, `estado`) VALUES
	(1, 1, 1, '2024-12-01', '2024-12-05', 1),
	(2, 2, 14, '2024-12-03', '2024-12-07', 0),
	(3, 3, 20, '2024-11-28', '2024-12-02', 0),
	(4, 4, 5, '2024-12-10', '2024-12-15', 0),
	(5, 5, 7, '2024-12-05', '2024-12-10', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
