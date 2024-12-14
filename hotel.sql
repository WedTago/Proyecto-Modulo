-- Volcando estructura de base de datos para hotel
CREATE DATABASE IF NOT EXISTS `hotel`;
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
  PRIMARY KEY (`id_cliente`)
);

-- Insercion de datos en tabla clientes

INSERT INTO `clientes` (`id_cliente`, `rfc`, `telefono`, `nombre`, `apellido1`, `apellido2`, `correo`) VALUES
(1, 'ABC123456DFA', '5551234567', 'Juan', 'Pérez', 'Gómez', 'juan.perez@example.com'),
(2, 'DEF789012HGA', '5559876543', 'María', 'López', 'Hernández', 'maria.lopez@example.com'),
(3, 'GHI345678JKL', '5555678910', 'Carlos', 'Rodríguez', NULL, 'carlos.rodriguez@example.com'),
(4, 'JKL901234MNO', '5551112233', 'Ana', 'Martínez', 'Sánchez', 'ana.martinez@example.com'),
(5, 'MNO567890PQR', '5553344556', 'Luis', 'Hernández', 'Ortiz', NULL),
(6, 'NOP345678STU', '5554445566', 'Sofía', 'García', 'Pérez', 'sofia.garcia@example.com'),
(7, 'PQR678901VWX', '5552223344', 'Miguel', 'Ramírez', NULL, 'miguel.ramirez@example.com'),
(8, 'STU901234YZA', '5556677889', 'Paola', 'Cruz', 'Jiménez', NULL),
(9, 'VWX345678BCD', '5559988776', 'Raúl', 'Torres', 'Domínguez', 'raul.torres@example.com'),
(10, 'YZA789012EFG', '5551237890', 'Isabel', 'Vargas', 'Molina', 'isabel.vargas@example.com'),
(11, 'BCD456789HIJ', '5554561230', 'Andrea', 'Navarro', 'Reyes', NULL),
(12, 'EFG123456KLM', '5557890123', 'Fernando', 'Mendoza', 'López', 'fernando.mendoza@example.com'),
(13, 'HIJ789012NOP', '5553456781', 'Lucía', 'Ortiz', NULL, 'lucia.ortiz@example.com'),
(14, 'KLM456789QRS', '5552345678', 'David', 'Flores', 'Castro', 'david.flores@example.com'),
(15, 'NOP678901TUV', '5556789012', 'Valeria', 'Hernández', 'Lara', NULL),
(16, 'QRS123456WXY', '5555678901', 'Ricardo', 'Morales', 'Esquivel', 'ricardo.morales@example.com'),
(17, 'TUV345678ZAB', '5554321098', 'Natalia', 'Peña', NULL, 'natalia.pena@example.com'),
(18, 'WXY901234CDE', '5558901234', 'Javier', 'Velázquez', 'Rosales', NULL),
(19, 'ZAB123456FGH', '5555674321', 'Laura', 'Delgado', 'Aguilar', 'laura.delgado@example.com'),
(20, 'CDE456789IJK', '5553456789', 'Emilio', 'Carvajal', NULL, 'emilio.carvajal@example.com'),
(21, 'FGH789012LMN', '5556781234', 'Teresa', 'Alvarado', 'Campos', 'teresa.alvarado@example.com');

-- Volcando estructura para tabla hotel.habitaciones
CREATE TABLE IF NOT EXISTS `habitaciones` (
  `num_habitacion` tinyint(4) NOT NULL,
  `tipo` enum('Sencillo','Doble','Doble grande') NOT NULL,
  `precio` decimal(6,2) NOT NULL,
  `disponibilidad` tinyint(1) NOT NULL,
  PRIMARY KEY (`num_habitacion`)
);

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
);

-- Insercion de datos en tabla reservas
INSERT INTO `reservas` (`id_reserva`, `id_cliente`, `num_habitacion`, `fecha_entrada`, `fecha_salida`, `estado`) VALUES
(1, 1, 1, '2024-12-01', '2024-12-05', '1'),
(2, 2, 2, '2024-12-03', '2024-12-07', '0'),
(3, 3, 3, '2024-11-28', '2024-12-02', '1'),
(4, 4, 4, '2024-12-10', '2024-12-15', '1'),
(5, 5, 5, '2024-12-05', '2024-12-10', '0'),
(6, 6, 6, '2024-12-06', '2024-12-10', '0'),
(7, 7, 7, '2024-12-08', '2024-12-12', '1'),
(8, 8, 8, '2024-12-09', '2024-12-14', '1'),
(9, 9, 9, '2024-12-11', '2024-12-16', '0'),
(10, 10, 10, '2024-12-12', '2024-12-15', '1'),
(11, 11, 11, '2024-12-13', '2024-12-18', '0'),
(12, 12, 12, '2024-12-14', '2024-12-19', '0'),
(13, 13, 13, '2024-12-15', '2024-12-20', '1'),
(14, 14, 14, '2024-12-16', '2024-12-21', '0'),
(15, 15, 15, '2024-12-17', '2024-12-22', '1'),
(16, 16, 16, '2024-12-18', '2024-12-23', '1'),
(17, 17, 17, '2024-12-19', '2024-12-24', '1'),
(18, 18, 18, '2024-12-20', '2024-12-25', '1'),
(19, 19, 19, '2024-12-21', '2024-12-26', '0'),
(20, 20, 20, '2024-12-22', '2024-12-27', '1'),
(21, 21, 21, '2024-12-23', '2024-12-28', '0');

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
);

-- Insercion de datos en tabla reservas
INSERT INTO `facturas` (`id_factura`, `id_reserva`, `estatus_pago`, `descripcion`, `fecha_factura`) VALUES
(1, 1, 1, 'Pago completo por estancia de 4 noches', '2024-12-01'),
(2, 2, 1, 'Pago parcial por estancia de 4 noches', '2024-12-03'),
(3, 3, 0, 'Reserva cancelada sin pago', '2024-11-28'),
(4, 4, 1, 'Pago completo por estancia de 5 noches', '2024-12-10'),
(5, 5, 1, 'Pago parcial por estancia de 5 noches', '2024-12-05'),
(6, 6, 1, 'Pago completo por estancia de 4 noches', '2024-12-06'),
(7, 7, 0, 'Reserva cancelada sin pago', '2024-12-08'),
(8, 8, 1, 'Pago completo por estancia de 5 noches', '2024-12-09'),
(9, 9, 0, 'Reserva cancelada sin pago', '2024-12-11'),
(10, 10, 1, 'Pago parcial por estancia de 3 noches', '2024-12-12'),
(11, 11, 0, 'Reserva cancelada sin pago', '2024-12-13'),
(12, 12, 1, 'Pago completo por estancia de 5 noches', '2024-12-14'),
(13, 13, 0, 'Reserva cancelada sin pago', '2024-12-15'),
(14, 14, 1, 'Pago completo por estancia de 5 noches', '2024-12-16'),
(15, 15, 0, 'Reserva cancelada sin pago', '2024-12-17'),
(16, 16, 1, 'Pago completo por estancia de 5 noches', '2024-12-18'),
(17, 17, 0, 'Reserva cancelada sin pago', '2024-12-19'),
(18, 18, 1, 'Pago completo por estancia de 5 noches', '2024-12-20'),
(19, 19, 0, 'Reserva cancelada sin pago', '2024-12-21'),
(20, 20, 1, 'Pago completo por estancia de 5 noches', '2024-12-22'),
(21, 21, 0, 'Reserva cancelada sin pago', '2024-12-23');