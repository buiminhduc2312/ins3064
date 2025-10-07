-- SQL file for PHP Computer Management System
-- Database: ComputerDB
-- Table: computer_parts

-- Create database
CREATE DATABASE IF NOT EXISTS `ComputerDB` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci;
USE `ComputerDB`;

-- Create table for computer parts
CREATE TABLE IF NOT EXISTS `computer_parts` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `component_name` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Insert sample data (optional)
INSERT INTO `computer_parts` (`component_name`, `description`, `price`) VALUES
('CPU', 'Central Processing Unit - Bộ xử lý trung tâm của máy tính', 250.00),
('RAM', 'Random Access Memory - Bộ nhớ tạm thời cho hệ thống', 120.00),
('Hard Disk', 'Ổ cứng HDD 1TB dùng để lưu trữ dữ liệu', 80.00),
('SSD', 'Ổ cứng thể rắn SSD 512GB tốc độ cao', 150.00),
('GPU', 'Card đồ họa rời NVIDIA GTX 1660 Super', 320.00);
