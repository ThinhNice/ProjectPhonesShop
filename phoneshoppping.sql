-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 01, 2024 lúc 10:47 AM
-- Phiên bản máy phục vụ: 8.0.32
-- Phiên bản PHP: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `phoneshoppping`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `admin`
--

CREATE TABLE `admin` (
  `id` int UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `email`) VALUES
(1, 'admin', '123456', 'admin@gmail.com');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `categories`
--

CREATE TABLE `categories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `categories`
--

INSERT INTO `categories` (`id`, `name`) VALUES
(2, 'Samsung'),
(3, 'Oppo'),
(4, 'Xiaomi');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `orders`
--

CREATE TABLE `orders` (
  `id` int UNSIGNED NOT NULL,
  `fullname` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `received_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `phone` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `order_code` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_amount` decimal(20,2) DEFAULT NULL,
  `status` int DEFAULT NULL,
  `payment_method` enum('0') COLLATE utf8mb4_general_ci DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `orders`
--

INSERT INTO `orders` (`id`, `fullname`, `email`, `received_address`, `phone`, `order_code`, `total_amount`, `status`, `payment_method`, `created_at`) VALUES
(7, 'Thịnh Nguyễn ', 'thinhnguyen32002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '08696151', 'ORDER-1FD8C433', 61470000.00, 0, '0', '2024-09-28 03:02:32'),
(8, 'Thịnh Nice', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm.', '0869615193', 'ORDER-BBF43765', 176910000.00, 0, '0', '2024-09-28 03:11:40'),
(9, 'Thịnh Nice', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm.', '0869615193', 'ORDER-E8EF569F', 176910000.00, 0, '0', '2024-09-28 03:14:07'),
(10, 'Thịnh Nice', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm.', '0869615193', 'ORDER-BBF35F53', 176910000.00, 0, '0', '2024-09-28 03:14:32'),
(11, 'Thịnh Đẹp Trai', 'thinh2@gmail.com', 'Hưng Yên 89 aaaa', '086961323523', 'ORDER-4631303F', 176910000.00, 0, '0', '2024-09-28 03:44:20'),
(12, 'Thịnh Đẹp Trai', 'thinh2@gmail.com', 'Hưng Yên 89 aaaa', '086961323523', 'ORDER-BFC137B3', 176910000.00, 0, '0', '2024-09-28 03:48:42'),
(13, 'Thịnh Đẹp Trai', 'thinh2@gmail.com', 'Hưng Yên 89 aaaa', '086961323523', 'ORDER-BC8555AF', 176910000.00, 0, '0', '2024-09-28 03:48:52'),
(14, 'Thịnh Đẹp Trai', 'thinh2@gmail.com', 'Hưng Yên 89 aaaa', '086961323523', 'ORDER-D1F4B6A6', 176910000.00, 0, '0', '2024-09-28 03:48:56'),
(15, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-F3D5D290', 176910000.00, 0, '0', '2024-09-28 03:49:41'),
(16, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-001E17BE', 176910000.00, 0, '0', '2024-09-28 03:50:30'),
(17, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-3B338AC1', 176910000.00, 0, '0', '2024-09-28 04:17:02'),
(18, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-5ECD0228', 176910000.00, 0, '0', '2024-09-28 04:19:35'),
(19, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-5B4D2137', 176910000.00, 0, '0', '2024-09-28 04:21:00'),
(20, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-D370D605', 176910000.00, 0, '0', '2024-09-28 04:22:54'),
(21, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-5A91CDA6', 162950000.00, 0, '0', '2024-09-28 04:25:46'),
(22, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-9BFFE841', 197940000.00, 0, '0', '2024-09-28 04:30:40'),
(23, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-9CD4C817', 197940000.00, 0, '0', '2024-09-28 04:32:56'),
(24, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-4355665E', 197940000.00, 0, '0', '2024-09-28 04:35:01'),
(25, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-B970E5B7', 197940000.00, 0, '0', '2024-09-28 04:41:03'),
(26, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-CDC5A368', 197940000.00, 0, '0', '2024-09-28 04:41:41'),
(27, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-552F4583', 197940000.00, 0, '0', '2024-09-28 04:43:14'),
(28, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-754D8C66', 197940000.00, 0, '0', '2024-09-28 04:48:06'),
(29, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-663F6BE2', 197940000.00, 0, '0', '2024-09-28 04:49:50'),
(30, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-5BD0533E', 174950000.00, 0, '0', '2024-09-28 04:51:46'),
(31, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-396C8AE2', 174950000.00, 0, '0', '2024-09-28 04:54:30'),
(32, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-5EF0899C', 174950000.00, 0, '0', '2024-09-28 04:56:24'),
(33, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-5BEF5421', 174950000.00, 0, '0', '2024-09-28 04:58:07'),
(34, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-85B07670', 139960000.00, 0, '0', '2024-09-28 04:59:32'),
(35, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-F50242DF', 174950000.00, 0, '0', '2024-09-28 05:01:44'),
(36, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-277E9CE1', 174950000.00, 0, '0', '2024-09-28 05:02:36'),
(39, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-0EF7245A', 34990000.00, 2, '0', '2024-09-29 02:55:04'),
(40, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-FC116D8D', 22990000.00, 0, '0', '2024-09-29 21:26:16'),
(41, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-E1B51FFC', 72970000.00, 2, '0', '2024-09-29 21:31:59'),
(43, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-FC497F57', 209940000.00, 2, '0', '2024-09-29 23:44:21'),
(44, 'Thịnh Nguyễn Hữu', 'thinhnguyen3012002@gmail.com', 'Quận Nam Từ Liêm - phường Trung Văn - ngõ 31 chợ Phùng Khoang - số nhà 15B4.', '0869615193', 'ORDER-6DE02318', 8490000.00, 0, '0', '2024-09-30 01:05:06');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `order_details`
--

CREATE TABLE `order_details` (
  `id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED DEFAULT NULL,
  `product_img` varchar(50) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cur_pr_name` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `quantity` int NOT NULL,
  `cur_pr_price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_img`, `cur_pr_name`, `quantity`, `cur_pr_price`) VALUES
(3, 15, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(4, 15, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 4, 34990000.00),
(5, 15, './assets/img/oppo-a3x.jpg', 'OPPO A3x ', 4, 3490000.00),
(6, 16, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(7, 16, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 4, 34990000.00),
(8, 16, './assets/img/oppo-a3x.jpg', 'OPPO A3x ', 4, 3490000.00),
(9, 17, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(10, 17, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 4, 34990000.00),
(11, 17, './assets/img/oppo-a3x.jpg', 'OPPO A3x ', 4, 3490000.00),
(12, 18, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(13, 18, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 4, 34990000.00),
(14, 18, './assets/img/oppo-a3x.jpg', 'OPPO A3x ', 4, 3490000.00),
(15, 19, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(16, 19, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 4, 34990000.00),
(17, 19, './assets/img/oppo-a3x.jpg', 'OPPO A3x ', 4, 3490000.00),
(18, 20, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(19, 20, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 4, 34990000.00),
(20, 20, './assets/img/oppo-a3x.jpg', 'OPPO A3x ', 4, 3490000.00),
(21, 21, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(22, 21, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 4, 34990000.00),
(23, 22, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(24, 22, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(25, 23, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(26, 23, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(27, 24, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(28, 24, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(29, 25, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(30, 25, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(31, 26, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(32, 26, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(33, 27, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(34, 27, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(35, 28, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(36, 28, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(37, 29, './assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(38, 29, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(39, 30, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(40, 31, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(41, 32, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(42, 33, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(43, 34, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 4, 34990000.00),
(44, 35, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(45, 36, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 5, 34990000.00),
(46, 39, './assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 1, 34990000.00),
(47, 40, '../assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 1, 22990000.00),
(48, 41, '../assets/img/iphone-16-xanh-luu-ly.webp', 'Iphone 16 - 128GB', 2, 22990000.00),
(49, 41, '../assets/img/iphone_16.png', 'Iphone 16 - 512GB', 1, 26990000.00),
(50, 43, '../assets/img/iphone-16-max.webp', 'Iphone 16 Pro Max', 6, 34990000.00),
(51, 44, '../assets/img/xiaomi-x6.webp', 'Xiaomi POCO X6 Pro', 1, 8490000.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `products`
--

CREATE TABLE `products` (
  `id` int UNSIGNED NOT NULL,
  `category_id` int UNSIGNED DEFAULT NULL COMMENT '1:iphone, 2:samsung, 3:oppo, 4:xiaomi',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `description` text COLLATE utf8mb4_general_ci,
  `price` decimal(10,2) NOT NULL,
  `stock` int DEFAULT '0',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `is_hot` tinyint(1) DEFAULT '0',
  `is_new` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `description`, `price`, `stock`, `created_at`, `is_hot`, `is_new`) VALUES
(2, 3, 'OPPO A3x ', 'Chip Snapdragon 6s Gen 1 8 nhân, RAM: 4 GB Dung lượng: 64 GB xịn sò con bò.', 3490000.00, 100, '2024-09-24 02:37:07', 0, 0),
(3, 2, 'Samsung Galaxy M55', 'Bảo hành chính hãng điện thoại 1 năm tại các trung tâm bảo hành hãng', 8240000.00, 100, '2024-09-24 03:20:49', 0, 0),
(4, 4, 'Xiaomi POCO X6 Pro', 'GPU Mali-G615 cùng RAM 8GB, bộ nhớ trong 256GB. Máy sở hữu 3 camera sau với camera chính 64MP và 1 camera selfie 16MP.', 8490000.00, 100, '2024-09-24 03:26:43', 0, 0);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images`
--

CREATE TABLE `product_images` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image_url`) VALUES
(1, 3, '../assets/img/samsung-m55.jpg'),
(2, 2, '../assets/img/oppo-a3x.jpg'),
(4, 4, '../assets/img/xiaomi-x6.webp');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `product_images_order_details`
--

CREATE TABLE `product_images_order_details` (
  `id` int UNSIGNED NOT NULL,
  `product_images_id` int UNSIGNED NOT NULL,
  `order_details_id` int UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `statistics`
--

CREATE TABLE `statistics` (
  `id` int UNSIGNED NOT NULL,
  `product_id` int UNSIGNED NOT NULL,
  `order_id` int UNSIGNED NOT NULL,
  `order_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `total_order` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Chỉ mục cho bảng `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `order_code` (`order_code`);

--
-- Chỉ mục cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`);

--
-- Chỉ mục cho bảng `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `category_id` (`category_id`);

--
-- Chỉ mục cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`);

--
-- Chỉ mục cho bảng `product_images_order_details`
--
ALTER TABLE `product_images_order_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_details_id` (`order_details_id`),
  ADD KEY `product_images_id` (`product_images_id`);

--
-- Chỉ mục cho bảng `statistics`
--
ALTER TABLE `statistics`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_id` (`product_id`),
  ADD KEY `order_id` (`order_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT cho bảng `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT cho bảng `products`
--
ALTER TABLE `products`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT cho bảng `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT cho bảng `product_images_order_details`
--
ALTER TABLE `product_images_order_details`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `statistics`
--
ALTER TABLE `statistics`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);

--
-- Các ràng buộc cho bảng `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `fk_categories` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`);

--
-- Các ràng buộc cho bảng `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `fk_product` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_images_ibfk_1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Các ràng buộc cho bảng `product_images_order_details`
--
ALTER TABLE `product_images_order_details`
  ADD CONSTRAINT `product_images_order_details_ibfk_1` FOREIGN KEY (`order_details_id`) REFERENCES `order_details` (`id`),
  ADD CONSTRAINT `product_images_order_details_ibfk_2` FOREIGN KEY (`product_images_id`) REFERENCES `product_images` (`id`);

--
-- Các ràng buộc cho bảng `statistics`
--
ALTER TABLE `statistics`
  ADD CONSTRAINT `statistics_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
