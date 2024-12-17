CREATE TABLE `products` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `picture` varchar(255) DEFAULT NULL,
  `description` text,
  `type` varchar(100) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `quantity` int DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
);

INSERT INTO `products` (`id`, `name`, `picture`, `description`, `type`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(1, 'Product 1', 'uploads/image/a1.jpg', 'Description of Product 1', 'Type A', 25.50, 100, '2024-12-17 20:27:01', '2024-12-17 20:56:37');
INSERT INTO `products` (`id`, `name`, `picture`, `description`, `type`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(2, 'Product 2', 'uploads/image/a2.jpg', 'Description of Product 2', 'Type B', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37');
INSERT INTO `products` (`id`, `name`, `picture`, `description`, `type`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(3, 'Product 3', 'uploads/image/a3.png', 'Description of Product 3', 'Type A', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37');
INSERT INTO `products` (`id`, `name`, `picture`, `description`, `type`, `price`, `quantity`, `created_at`, `updated_at`) VALUES
(4, 'Product 4', 'uploads/image/a4.png', 'Description of Product 4', 'Type A', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37'),
(5, 'Product 5', 'uploads/image/a5.png', 'Description of Product 5', 'Type A', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37'),
(6, 'Product 6', 'uploads/image/a6.png', 'Description of Product 6', 'Type B', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37'),
(7, 'Product 7', 'uploads/image/a7.png', 'Description of Product 7', 'Type B', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37'),
(8, 'Product 8', 'uploads/image/a8.png', 'Description of Product 8', 'Type A', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37'),
(9, 'Product 9', 'uploads/image/a9png', 'Description of Product 9', 'Type A', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37'),
(10, 'Product 10', 'uploads/image/a10.png', 'Description of Product 10', 'Type B', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37'),
(11, 'Product 11', 'uploads/image/a11.png', 'Description of Product 11', 'Type A', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37'),
(12, 'Product 12', 'uploads/image/a12.png', 'Description of Product 12', 'Type B', 40.00, 50, '2024-12-17 20:27:01', '2024-12-17 20:56:37');