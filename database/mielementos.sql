-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 17, 2025 at 11:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mielementos`
--

-- --------------------------------------------------------

--
-- Table structure for table `compra`
--

CREATE TABLE `compra` (
  `id_compra` int(11) NOT NULL,
  `id_proveedor` int(11) NOT NULL,
  `fecha_compra` date NOT NULL,
  `valor_total` decimal(15,2) NOT NULL DEFAULT 0.00,
  `referencia` varchar(150) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compra`
--

INSERT INTO `compra` (`id_compra`, `id_proveedor`, `fecha_compra`, `valor_total`, `referencia`, `created_at`) VALUES
(1, 6, '2025-09-17', 1250.00, '1106789', '2025-09-17 21:07:02'),
(2, 6, '2025-09-15', 5000.00, NULL, '2025-09-17 21:32:12'),
(3, 7, '2025-09-16', 400.00, NULL, '2025-09-17 21:32:13'),
(4, 8, '2025-09-16', 1200.00, NULL, '2025-09-17 21:32:13'),
(5, 6, '2025-09-17', 2700.00, NULL, '2025-09-17 21:32:13'),
(6, 8, '2025-09-17', 750.00, NULL, '2025-09-17 21:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `compra_item`
--

CREATE TABLE `compra_item` (
  `id_item` int(11) NOT NULL,
  `id_compra` int(11) NOT NULL,
  `id_producto` int(11) NOT NULL,
  `cantidad` decimal(12,3) NOT NULL,
  `valor_unitario` decimal(15,2) NOT NULL,
  `valor_total_item` decimal(15,2) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compra_item`
--

INSERT INTO `compra_item` (`id_item`, `id_compra`, `id_producto`, `cantidad`, `valor_unitario`, `valor_total_item`, `created_at`) VALUES
(1, 1, 7, 5.000, 250.00, 1250.00, '2025-09-17 21:07:02'),
(2, 2, 5, 2.000, 2500.00, 5000.00, '2025-09-17 21:32:12'),
(3, 3, 6, 5.000, 80.00, 400.00, '2025-09-17 21:32:13'),
(4, 4, 7, 1.000, 1200.00, 1200.00, '2025-09-17 21:32:13'),
(5, 5, 8, 3.000, 900.00, 2700.00, '2025-09-17 21:32:13'),
(6, 6, 6, 10.000, 75.00, 750.00, '2025-09-17 21:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(11) NOT NULL,
  `codigo` varchar(100) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `marca` varchar(150) DEFAULT NULL,
  `unidad_medida` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `producto`
--

INSERT INTO `producto` (`id_producto`, `codigo`, `nombre`, `marca`, `unidad_medida`, `created_at`) VALUES
(5, 'PR001', 'Laptop Dell', 'Dell', 'Unidad', '2025-09-17 21:03:25'),
(6, 'PR002', 'Mouse Inalambrico Logitech ', 'Logitech', 'Unidad', '2025-09-17 21:03:25'),
(7, 'PR003', 'Impresora EPSON  L3110', 'EPSON', 'Unidad', '2025-09-17 21:03:25'),
(8, 'PR004', 'Monitor Samsung 24\" LED Full HD', 'Samsung', 'Unidad', '2025-09-17 21:03:25');

-- --------------------------------------------------------

--
-- Table structure for table `proveedor`
--

CREATE TABLE `proveedor` (
  `id_proveedor` int(11) NOT NULL,
  `documento` varchar(50) NOT NULL,
  `nombre` varchar(200) NOT NULL,
  `email` varchar(150) DEFAULT NULL,
  `telefono` varchar(50) DEFAULT NULL,
  `direccion` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `proveedor`
--

INSERT INTO `proveedor` (`id_proveedor`, `documento`, `nombre`, `email`, `telefono`, `direccion`, `created_at`) VALUES
(6, '900123456', 'Distribuciones Andina S.A.S', 'contacto@andina.com', '3004567890', 'Calle 45 #23-10, Bogot?', '2025-09-17 20:56:24'),
(7, '901234567', 'TecnoGlobal Ltda.', 'ventas@tecnoglobal.com', '3109876543', 'Carrera 12 #34-56, Medell?n', '2025-09-17 20:56:24'),
(8, '902345678', 'ElectroHogar Colombia', 'info@electrohogar.com', '3112233445', 'Av. Las Palmas 120, Cali', '2025-09-17 20:56:24'),
(9, '1001234567', 'Laura Gómez', '3156789012', 'laura.gomez@gmail.com', 'Calle 45 #12-34', '2025-09-17 21:05:11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `compra`
--
ALTER TABLE `compra`
  ADD PRIMARY KEY (`id_compra`),
  ADD KEY `id_proveedor` (`id_proveedor`),
  ADD KEY `idx_compra_fecha` (`fecha_compra`);

--
-- Indexes for table `compra_item`
--
ALTER TABLE `compra_item`
  ADD PRIMARY KEY (`id_item`),
  ADD KEY `id_compra` (`id_compra`),
  ADD KEY `id_producto` (`id_producto`);

--
-- Indexes for table `producto`
--
ALTER TABLE `producto`
  ADD PRIMARY KEY (`id_producto`),
  ADD UNIQUE KEY `codigo` (`codigo`),
  ADD KEY `idx_producto_codigo` (`codigo`);

--
-- Indexes for table `proveedor`
--
ALTER TABLE `proveedor`
  ADD PRIMARY KEY (`id_proveedor`),
  ADD UNIQUE KEY `documento` (`documento`),
  ADD KEY `idx_proveedor_documento` (`documento`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `compra`
--
ALTER TABLE `compra`
  MODIFY `id_compra` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `compra_item`
--
ALTER TABLE `compra_item`
  MODIFY `id_item` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `producto`
--
ALTER TABLE `producto`
  MODIFY `id_producto` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `proveedor`
--
ALTER TABLE `proveedor`
  MODIFY `id_proveedor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `compra`
--
ALTER TABLE `compra`
  ADD CONSTRAINT `compra_ibfk_1` FOREIGN KEY (`id_proveedor`) REFERENCES `proveedor` (`id_proveedor`) ON UPDATE CASCADE;

--
-- Constraints for table `compra_item`
--
ALTER TABLE `compra_item`
  ADD CONSTRAINT `compra_item_ibfk_1` FOREIGN KEY (`id_compra`) REFERENCES `compra` (`id_compra`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `compra_item_ibfk_2` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
