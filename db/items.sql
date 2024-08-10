-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Aug 10, 2024 at 11:32 AM
-- Server version: 9.0.1
-- PHP Version: 8.2.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_docker`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `title` varchar(64) NOT NULL,
  `description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `title_description` text NOT NULL,
  `photo` varchar(256) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `title`, `description`, `title_description`, `photo`) VALUES
(1, 'Apple iPhone 15 Pro Max', 'Смартфон Apple iPhone 15 Pro Max 256GB Natural Titanium имеет процессор A17 Pro и шестиядерный графический ускоритель. За счет этого достигаются мгновенный отклик устройства на заданные команды, быстрый запуск приложений и игр. Экран с матрицей OLED Super Retina XDR поддерживает технологию ProMotion. Благодаря этому модель автоматически настраивает оптимальные параметры передачи изображения. Технология HDR обеспечивает высокий уровень детализации темных и светлых эпизодов сцены.', 'Смартфон Apple iPhone 15 Pro Max 256GB Natural Titanium', 'https://static.eldorado.ru/img1/b/bb/90596300.jpg/resize/3840x2160/'),
(2, 'Apple MacBook Pro 16', 'Ноутбук Apple MacBook Pro 16 M3 Pro/18/512GB Space Black (MRW13) оборудован дисплеем диагональю 16,2 дюйма с разрешением 3456х2234 пикселя. Благодаря этому на экран выводится детализированное изображение с оптимальным балансом яркости и контраста. За счет частоты обновления до 120 Гц обеспечена плавность при трансляции динамичных сцен. Аудиосистема из шести динамиков с поддержкой Dolby Atmos транслирует объемный звук без искажений, что создает эффект полного погружения.', 'Ноутбук Apple MacBook Pro 16 M3 Pro/18/512GB Space Black (MRW13)', 'https://static.eldorado.ru/img1/b/bb/868154002.jpg/resize/3840x2160/'),
(3, 'Apple iPad Pro 11', 'Планшет Apple iPad Pro 11 Wi-Fi 256GB Space Black (MVV83) - мобильное устройство с дисплеем, созданным на основе матрицы Tandem OLED. Диагональ сенсорного экрана - 11 дюймов, разрешение - 2420х1668 пикселей. Девятиядерный процессор M4 работает при поддержке оперативной памяти 8 Гб. Для установки приложений и хранения файлов предусмотрена встроенная память 256 ГБ.', 'Планшет Apple iPad Pro 11 2024 Wi-Fi 256GB Space Black (MVV83)', 'https://static.eldorado.ru/img1/b/bb/74127300.jpg/resize/3840x2160/');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
