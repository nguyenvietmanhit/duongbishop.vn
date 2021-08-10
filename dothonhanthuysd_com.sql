-- phpMyAdmin SQL Dump
-- version 4.6.6deb5ubuntu0.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 11, 2021 at 08:51 AM
-- Server version: 5.7.34-0ubuntu0.18.04.1
-- PHP Version: 7.4.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dothonhanthuysd.com`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` text,
  `status` tinyblob,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `avatar`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Tượng Phật', NULL, NULL, NULL, '2021-04-12 11:47:16', '2021-04-29 14:19:39'),
(2, 'Cửa Võng', NULL, NULL, NULL, '2021-04-12 14:40:11', '2021-04-29 14:19:54'),
(3, 'Bàn Án Giang- Ô Xa', NULL, NULL, NULL, '2021-04-12 14:40:23', '2021-04-29 14:20:18'),
(4, 'Cuốn THư-  Hoành Phi - Quạt', NULL, NULL, NULL, '2021-05-02 15:39:15', '2021-05-02 15:39:15');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT '0',
  `name` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `summary` text CHARACTER SET utf8,
  `content` text CHARACTER SET utf8,
  `status` tinyint(1) DEFAULT '0',
  `seo_title` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `seo_description` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `seo_keywords` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`id`, `category_id`, `name`, `avatar`, `summary`, `content`, `status`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
(2, 0, 'Tin tức 1', '1618744397-sp1.jpg', NULL, '<p>Tin tức 1</p>', 0, 'Tin tức 1', 'Tin tức 1', '', '2021-04-18 18:13:17', '2021-04-18 18:13:17'),
(3, 0, 'Tin tức 2', '1618744409-sp2.jpg', NULL, '<p>Tin tức 2</p>', 0, 'Tin tức 2', 'Tin tức 2', '', '2021-04-18 18:13:29', '2021-04-18 18:13:29'),
(4, 0, 'Tin tức 3', '1618744426-sp3.jpg', NULL, '<p>Tin tức 3</p>', 0, 'Tin tức 3', 'Tin tức 3', '', '2021-04-18 18:13:46', '2021-04-18 18:13:46');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `content` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `avatar`, `key`, `content`, `created_at`, `updated_at`) VALUES
(2, 'Nội dung top trang chủ', '1618739501-anh-gioi-thieu.jpg', 'top_page', '<h1 class=\"banner-heading intro-title\">Tầm nh&igrave;n</h1>\r\n\r\n<div class=\"intro-des\">\r\n<p><strong>SỨ MỆNH : </strong>Tiếp tục ho&agrave;n thiện v&agrave; ph&aacute;t triển th&agrave;nh cơ sơ sản xuất đồ thờ uy tin v&agrave; chất lượng, l&agrave; l&aacute; cờ đầu trong sứ mệnh gi&uacute;p L&agrave;ng nghề truyền thống Sơn Đồng vươn xa hơn nữa</p>\r\n\r\n<p><strong>TẦM NH&Igrave;N : </strong>Mở rộng thị trường, trở th&agrave;nh đối t&aacute;c uy t&iacute;n, l&acirc;u d&agrave;i với c&aacute;c Kh&aacute;ch h&agrave;ng trong v&agrave; ngo&agrave;i nước.</p>\r\n\r\n<p><strong>KHẨU HIỆU : &quot;</strong>Bạn cần sản phẩm đồ thờ tượng phật chất lượng &ndash; Đ&atilde; c&oacute; ch&uacute;ng t&ocirc;i&quot;.</p>\r\n</div>', '2021-04-18 10:48:17', '2021-04-23 17:07:58'),
(4, 'Giới thiệu', '1618742858-anh-gioi-thieu.jpg', 'intro', '<h2>Cơ sở sản xuất đồ thờ Nh&acirc;n Th&uacute;y xin gửi lời c&aacute;m ơn ch&acirc;n th&agrave;nh tới sự ủng hộ của Qu&yacute; kh&aacute;ch h&agrave;ng cũng như sự quan t&acirc;m của Qu&yacute; kh&aacute;ch h&agrave;ng trong suốt những năm qua.</h2>\r\n\r\n<p>L&agrave; một cơ sở sản xuất Đồ Thờ trong Hiệp hội l&agrave;ng nghề Sơn Đồng ch&uacute;ng t&ocirc;i lu&ocirc;n cam kết đưa đến những sản phẩm tốt nhất, đẹp nhất, ph&ugrave; hợp nhất với Qu&yacute; Kh&aacute;ch h&agrave;ng, giữ vững được bản sắc d&acirc;n tộc, g&oacute;p phần x&acirc;y dựng th&ecirc;m v&agrave; ph&aacute;t triển th&ecirc;m cho thương hiệu L&agrave;ng Nghề Đồ Thờ Truyền Thống Sơn Đồng.</p>\r\n\r\n<p>Nhằm đ&aacute;p ứng tối đa nhất cho c&aacute;c nhu cầu của Kh&aacute;ch H&agrave;ng. Ch&uacute;ng t&ocirc;i đ&atilde; mở rộng v&agrave; sản xuất tất cả c&aacute;c sản phẩm li&ecirc;n quan đến đồ thờ như:</p>\r\n\r\n<p>+ C&aacute;c Đồ Thờ: Ho&agrave;nh Phi, C&acirc;u Đối, &Aacute;n Gian, B&agrave;n &Ocirc; Sa, Cửa V&otilde;ng, Cuốn Thư, Ngai, B&aacute;t Bửu, Kiệu&hellip;</p>\r\n\r\n<p>+ C&aacute;c Tượng Thờ: Tượng Phật, tượng Quan, Tượng Đức Th&aacute;nh, Tượng Mẫu, Ph&ugrave; Đi&ecirc;u, Truyền Thần&hellip;</p>\r\n\r\n<p>+ C&aacute;c Linh Vật Thờ: &Ocirc;ng Voi, &Ocirc;ng Hạc, &Ocirc;ng Ngựa&hellip;..</p>\r\n\r\n<p>Ch&uacute;ng t&ocirc;i sẽ tư vấn tận nơi nếu Qu&yacute; Kh&aacute;ch đang c&oacute; nhu cầu:</p>\r\n\r\n<p>&ndash; L&agrave;m mới Đ&igrave;nh Ch&ugrave;a, Đền, Điện, Nh&agrave; Thờ</p>\r\n\r\n<p>&ndash; Tu sửa Đ&igrave;nh Ch&ugrave;a, Đền Điện , Nh&agrave; Thờ&hellip; v&agrave; c&aacute;c sản phẩm li&ecirc;n quan đến đồ thờ.</p>\r\n\r\n<p>Trong thời gian hoạt động, ch&uacute;ng t&ocirc;i cũng đ&atilde; rất vinh dự được x&acirc;y mới một số Đ&igrave;nh, Ch&ugrave;a lớn, l&agrave;m mới rất nhiều c&aacute;c đồ thờ cho c&aacute;c Đinh Ch&ugrave;a, c&aacute;c Nh&agrave; Thờ Tổ Ti&ecirc;n lớn, c&aacute;c Điện cũng như c&aacute;c gian thờ Gia Ti&ecirc;n của c&aacute;c hộ Gia Đ&igrave;nh tr&ecirc;n khắp đất nước từ Bắc v&agrave;o Nam.</p>\r\n\r\n<p>H&atilde;y li&ecirc;n hệ với ch&uacute;ng t&ocirc;i bất cứ l&uacute;c n&agrave;o bạn cần. Xin ch&acirc;n th&agrave;nh cảm ơn</p>\r\n\r\n<p>Tr&acirc;n Trọng !</p>\r\n\r\n<p>CƠ SỞ SẢN XUẤT ĐỒ THỜ NH&Acirc;N TH&Uacute;Y</p>\r\n\r\n<p>+ Địa chỉ:Cửa H&agrave;ng&nbsp;Số 62 đường Sơn Đồng C&aacute;t Quế&nbsp; - Th&ocirc;n R&ocirc; - Sơn Đồng - Ho&agrave;i Đức - H&agrave; Nội</p>\r\n\r\n<p>&nbsp; &nbsp;Xưởng Sản Xuất Số 6 Ng&otilde; 62&nbsp;đường Sơn Đồng C&aacute;t Quế&nbsp; - Th&ocirc;n R&ocirc; - Sơn Đồng - Ho&agrave;i Đức - H&agrave; Nội</p>\r\n\r\n<p>+ Hotline:<a href=\"tel:0858658858\" style=\"background-color: rgb(255, 255, 255);\" title=\"Click trên điện thoại để gọi trực tiếp\">0858 658 858&nbsp;</a>-&nbsp;<a href=\"tel:0987266088\" style=\"background-color: rgb(255, 255, 255);\" title=\"Click trên điện thoại để gọi trực tiếp\">&nbsp;0987 266 088</a></p>\r\n\r\n<p>+ Website:&nbsp;Dothonhanthuysd.com</p>\r\n\r\n<p>+ Email: Dothonhanthuysd@gmail.com</p>\r\n\r\n<p>Ch&acirc;n th&agrave;nh cảm ơn v&agrave; rất h&acirc;n hạnh được phục vụ qu&yacute; kh&aacute;ch</p>\r\n\r\n<div class=\"aiosrs-rating-wrap\" data-schema-id=\"1505\">\r\n<div class=\"aiosrs-star-rating-wrap \">&nbsp;</div>\r\n</div>', '2021-04-18 17:42:43', '2021-04-30 15:28:53');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `summary` text,
  `content` text,
  `amount` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT '0',
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `category_id`, `name`, `price`, `avatar`, `summary`, `content`, `amount`, `status`, `seo_title`, `seo_description`, `seo_keywords`, `created_at`, `updated_at`) VALUES
(7, 1, 'tượng Hộ Pháp', NULL, '1619944410-z2459496951495_363968acf5940065c806c87471bd01bf.jpg', NULL, '<p>Li&ecirc;n h&ecirc; 0987260688. 0858658858</p>', NULL, 0, 'tượng Hộ Pháp', 'tượng Hộ Pháp', NULL, '2021-04-12 14:29:11', '2021-05-02 15:34:09'),
(8, 1, 'Tượng Hoàng', 0, '1619944571-z2459493698127_4b915659a6bedc0920fd6a1b6e807ee2.jpg', NULL, '<p>Lh : 0987260688. 0858658858</p>', NULL, 0, 'Tượng Hoàng', 'Tượng Hoàng', NULL, '2021-04-12 14:29:25', '2021-05-02 15:36:11'),
(9, 1, 'Chúa', 0, '1619944627-z2459497001649_5b7575c086c621584c4d7c6f40fa6c8a.jpg', NULL, '<p>LH: 0987260688. 0858658858</p>', NULL, 0, 'Chúa', 'Chúa', NULL, '2021-04-12 14:29:48', '2021-05-02 15:37:07'),
(11, 1, 'tượng Hộ Pháp', 0, '1619944513-z2459496931180_23622446b8b494b5ef7a77911183432d.jpg', NULL, '<p>Lh 0987260688 . 0858658858</p>', NULL, 0, 'tượng Hộ Pháp', 'tượng Hộ Pháp', NULL, '2021-04-18 08:26:39', '2021-05-02 15:35:13'),
(13, 1, 'Tượng Phật', 1, '1619679867-z2459493531718_09d669d115e81955b41c7464da7ce14b.jpg', NULL, NULL, NULL, 0, 'Tượng Phật', 'Tượng Phật', NULL, '2021-04-29 11:31:44', '2021-04-29 14:04:27'),
(14, 4, 'Quạt', 0, '1619944838-z2459493522903_6a4d68d76029f779eb030ce83e870736.jpg', NULL, '<p>LH: 0987260688. 0858658858</p>', NULL, 0, 'Quạt', 'Quạt', NULL, '2021-05-02 15:40:38', '2021-05-02 15:40:38'),
(15, 1, 'Tượng Cậu', NULL, '1621068468-z2459493590384_26083bbac1e3e0eef582f04d801dcf1d.jpg', NULL, NULL, NULL, 0, 'Tượng Cậu', 'Tượng Cậu', NULL, '2021-05-15 15:47:48', '2021-05-15 15:47:48'),
(16, 1, 'Tượng Câu', NULL, '1621068494-z2459493659477_72c8057494752c70971d032ee9f1011c.jpg', NULL, NULL, NULL, 0, 'Tượng Câu', 'Tượng Câu', NULL, '2021-05-15 15:48:14', '2021-05-15 15:48:14'),
(18, 1, 'Tượng Chúa', NULL, '1621068554-z2459493712813_087f1d1c134d8afaad22e37f5e950c8e.jpg', NULL, NULL, NULL, 0, 'Tượng Chúa', 'Tượng Chúa', NULL, '2021-05-15 15:49:14', '2021-05-15 15:49:14'),
(19, 1, 'Thập Điện', NULL, '1621068576-z2459496962624_1139d4226484b45692856b6f2195d75f.jpg', NULL, NULL, NULL, 0, 'Thập Điện', 'Thập Điện', NULL, '2021-05-15 15:49:36', '2021-05-15 15:49:36'),
(20, 1, 'Thập Điện', NULL, '1621068597-z2459496973833_00e199d9ddb2923ab583360cd9abdeb9.jpg', NULL, NULL, NULL, 0, 'Thập Điện', 'Thập Điện', NULL, '2021-05-15 15:49:57', '2021-05-15 15:49:57'),
(21, 1, 'Tượng Thiên Thủ Thiên Nhãn', NULL, '1621068636-z2459497096527_c2c53264b9c391c36ecf94c11d071276.jpg', NULL, NULL, NULL, 0, 'Tượng Thiên Thủ Thiên Nhãn', 'Tượng Thiên Thủ Thiên Nhãn', NULL, '2021-05-15 15:50:36', '2021-05-15 15:50:36'),
(22, 1, 'Tượng Di Đà', NULL, '1621068897-z2459500449361_60fb46bf1a844b558bfbc5aaccad1f6d.jpg', NULL, NULL, NULL, 0, 'Tượng Di Đà', 'Tượng Di Đà', NULL, '2021-05-15 15:54:57', '2021-05-15 15:54:57'),
(23, 1, 'Phật Thế Tôn', NULL, '1621068915-z2459500456120_d20d347300374632d15e1d607647288c.jpg', NULL, NULL, NULL, 0, 'Phật Thế Tôn', 'Phật Thế Tôn', NULL, '2021-05-15 15:55:15', '2021-05-15 15:55:15'),
(24, 1, 'Tượng Ngũ Vị Tôn Ông', NULL, '1621068947-z2459506385045_46b621236e49829f627ff7c1a34581e9.jpg', NULL, NULL, NULL, 0, 'Tượng Ngũ Vị Tôn Ông', 'Tượng Ngũ Vị Tôn Ông', NULL, '2021-05-15 15:55:47', '2021-05-15 15:55:47'),
(25, 1, 'Phật Tam Thánh', NULL, '1621068982-z2459506373735_a6f900817870b9c57d2ffcaead653bb0.jpg', NULL, NULL, NULL, 0, 'Phật Tam Thánh', 'Phật Tam Thánh', NULL, '2021-05-15 15:56:22', '2021-05-15 15:56:22'),
(26, 1, 'Tượng Dực Sư', NULL, '1621069026-z2459507907293_fb5e8aa677aad083550b323aaec75189.jpg', NULL, NULL, NULL, 0, 'Tượng Dực Sư', 'Tượng Dực Sư', NULL, '2021-05-15 15:57:06', '2021-05-15 15:57:06'),
(27, 1, 'Tượng và Động Sơn Trang', NULL, '1621069062-z2459518985770_8e9986342a8b05ede6f6202e83127a78.jpg', NULL, NULL, NULL, 0, 'Tượng và Động Sơn Trang', 'Tượng và Động Sơn Trang', NULL, '2021-05-15 15:57:42', '2021-05-15 15:57:42'),
(28, 1, 'Tượng Chấn Cổng', NULL, '1621069087-z2459518798577_16c32d1aa675ba7c78adb089c4cc18d6.jpg', NULL, NULL, NULL, 0, 'Tượng Chấn Cổng', 'Tượng Chấn Cổng', NULL, '2021-05-15 15:58:07', '2021-05-15 15:58:07'),
(29, 1, 'Tượng Chấn Cổng', NULL, '1621069104-z2459516370315_dd631ab309d5b71bfb17c3c640da8fa2.jpg', NULL, NULL, NULL, 0, 'Tượng Chấn Cổng', 'Tượng Chấn Cổng', NULL, '2021-05-15 15:58:24', '2021-05-15 15:58:24'),
(30, 1, 'Tòa Cửu Long', NULL, '1621069136-z2459526433229_0e5bf7b8ed7ca2e95df547b529bb39b8.jpg', NULL, NULL, NULL, 0, 'Tòa Cửu Long', 'Tòa Cửu Long', NULL, '2021-05-15 15:58:56', '2021-05-15 15:58:56'),
(31, 1, 'Tượng Phật', NULL, '1621069190-z2459546760838_bc7fb47e395a61f1d2947b139d9ff5bf.jpg', NULL, NULL, NULL, 0, 'Tượng Phật', 'Tượng Phật', NULL, '2021-05-15 15:59:50', '2021-05-15 15:59:50'),
(32, 1, 'Tượng Thích Ca', NULL, '1621069226-z2459532915668_ab71963cf96cd9637855ae77efddaecb.jpg', NULL, NULL, NULL, 0, 'Tượng Thích Ca', 'Tượng Thích Ca', NULL, '2021-05-15 16:00:26', '2021-05-15 16:00:26'),
(33, 1, 'Tượng Chấn Cổng', NULL, '1621069252-z2459518827243_0fd00387cfec518cda0abb3bb49c9d1f.jpg', NULL, NULL, NULL, 0, 'Tượng Chấn Cổng', 'Tượng Chấn Cổng', NULL, '2021-05-15 16:00:52', '2021-05-15 16:00:52'),
(34, 1, 'Tượng Chấn Cổng', NULL, '1621069262-z2459518843132_748d12e542579f8e3a49b2ff28d4be6b.jpg', NULL, NULL, NULL, 0, 'Tượng Chấn Cổng', 'Tượng Chấn Cổng', NULL, '2021-05-15 16:01:02', '2021-05-15 16:01:02'),
(35, 1, 'tượng Hộ Pháp', NULL, '1621069282-z2459526287066_fc12ecc3317f8deed4dbba71536150a7.jpg', NULL, NULL, NULL, 0, 'tượng Hộ Pháp', 'tượng Hộ Pháp', NULL, '2021-05-15 16:01:22', '2021-05-15 16:01:22'),
(36, 1, 'tượng Hộ Pháp', NULL, '1621069297-z2459526294960_3b9b8e21f5c722ac02647bfe74be089a.jpg', NULL, NULL, NULL, 0, 'tượng Hộ Pháp', 'tượng Hộ Pháp', NULL, '2021-05-15 16:01:37', '2021-05-15 16:01:37'),
(37, 1, 'Tượng Phật', NULL, '1621069325-z2459526496637_d1bcfdf3d5bf5f97e00154d1d298c922.jpg', NULL, NULL, NULL, 0, 'Tượng Phật', 'Tượng Phật', NULL, '2021-05-15 16:02:05', '2021-05-15 16:02:05'),
(38, 1, 'tượng Hộ Pháp', NULL, '1621069339-z2459529034203_84ed38e4c64acfec8406f656acc6dd91.jpg', NULL, NULL, NULL, 0, 'tượng Hộ Pháp', 'tượng Hộ Pháp', NULL, '2021-05-15 16:02:19', '2021-05-15 16:02:19'),
(39, 1, 'Tượng Phật', NULL, '1621069382-z2459532811746_c1166e9274036e678fca4b617a3c7488.jpg', NULL, NULL, NULL, 0, 'Tượng Phật', 'Tượng Phật', NULL, '2021-05-15 16:03:02', '2021-05-15 16:03:02'),
(40, 1, 'Tượng Phật', NULL, '1621069399-z2459532815026_d62d6c460207e20e47d423f260a46bab.jpg', NULL, NULL, NULL, 0, 'Tượng Phật', 'Tượng Phật', NULL, '2021-05-15 16:03:19', '2021-05-15 16:03:19'),
(41, 1, 'vua Cha NGọc HOàng', NULL, '1621069448-z2459537559572_05daee21b540d7edfb77515aa1dd0f34.jpg', NULL, NULL, NULL, 0, 'vua Cha NGọc HOàng', 'vua Cha NGọc HOàng', NULL, '2021-05-15 16:04:08', '2021-05-15 16:04:08');

-- --------------------------------------------------------

--
-- Table structure for table `reports`
--

CREATE TABLE `reports` (
  `id` int(11) NOT NULL,
  `report_slug` varchar(255) DEFAULT '' COMMENT 'Link báo cáo',
  `name` varchar(255) DEFAULT '' COMMENT 'tên báo cáo',
  `client` varchar(255) DEFAULT NULL COMMENT 'tên client',
  `time_start` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP COMMENT 'thời gian triển khai',
  `description` text COMMENT 'Mô tả nhỏ',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `reports`
--

INSERT INTO `reports` (`id`, `report_slug`, `name`, `client`, `time_start`, `description`, `created_at`, `updated_at`) VALUES
(6, 'bao-cao-lan-thu-nhat', 'Báo cáo lần thư nhất', 'dsadsa', NULL, NULL, '2021-03-28 23:55:22', '2021-03-28 23:55:22'),
(7, 'bao-cao-tran-van-manh', 'bao cao trần văn mạnh', 'dsadsa', NULL, NULL, '2021-03-30 07:23:15', '2021-03-30 07:23:15'),
(8, 'dsa', 'Nguyễn Viết Mạnh dsdsa', NULL, '1970-01-06 00:00:00', NULL, '2021-03-30 07:48:06', '2021-03-30 07:48:06');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL COMMENT 'Tên role',
  `key` varchar(255) DEFAULT NULL,
  `description` text COMMENT 'Mô tả quyền',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `key`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin', 'Quyền admin', '2021-02-11 13:20:57', '2021-02-11 13:20:57'),
(2, 'User', 'user', 'Quyền user', '2021-02-11 13:21:00', '2021-02-11 13:21:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL COMMENT 'Số lượng báo cáo',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'Họ tên',
  `info` text COMMENT 'Thông tin liên hệ',
  `report_id` varchar(255) DEFAULT '' COMMENT 'user có quyền xem báo cáo nào',
  `role_id` int(11) DEFAULT '0' COMMENT 'Quyền',
  `status` tinyint(3) DEFAULT '0',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `email`, `phone`, `amount`, `fullname`, `info`, `report_id`, `role_id`, `status`, `created_at`, `updated_at`) VALUES
(40, 'admin', '$2y$10$xOgXdMNuEir4LnKVQIN0O.BuJJ1u6gai6kpEIdUvBxdrDmh4xi9Nm', 'nguyenvietmanhit@gmail.com', '+10987599921', NULL, 'Mạnh Viết', NULL, NULL, 1, 0, '2021-02-11 14:19:54', '2021-04-29 02:43:29'),
(41, 'user', '$2y$10$xOgXdMNuEir4LnKVQIN0O.BuJJ1u6gai6kpEIdUvBxdrDmh4xi9Nm', 'nguyenvietmanhit@gmail.com', '+10987599921', NULL, 'Mạnh Viết', NULL, NULL, 1, 0, '2021-02-11 17:24:20', '2021-04-29 02:42:41'),
(42, 'tran', '$2y$10$B/davoukeI2IJ4bsWNXJHejoSZKqHGTLcD1NWG7R3Ma0xqVfzhgpC', NULL, NULL, NULL, NULL, NULL, '1,3', 2, 0, '2021-02-27 22:40:56', '2021-03-28 22:32:15'),
(43, 'user1', '$2y$10$S.JygnACtxEQluEql5XgSeHv6SL1WPVJqneK82LHwWFpMt65XWJb6', NULL, NULL, NULL, NULL, NULL, '1', 2, 0, '2021-03-28 22:40:19', '2021-03-28 22:41:01'),
(44, 'user2', '$2y$10$j4QZ/ihoHt4kx3.6nD/tjezHvQQI4f7lA.IAHzRta30u32/9rfNvm', 'nguyenvietmanhit@gmail.com', '+10987599921', NULL, 'Mạnh Viết', '<p>dsadas</p>', '2', 2, 0, '2021-03-28 22:40:35', '2021-03-28 22:44:54'),
(45, 'user3', '$2y$10$LrT9T.NnxpATCQxIoeePt.PHwu3btBEFedoKaVZH9IK.hAcJcyeO2', 'nguyenvietmanhit@gmail.comdsadsa', NULL, NULL, NULL, NULL, '1,2,3,6', 2, 0, '2021-03-28 22:40:52', '2021-03-28 23:56:41');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `reports`
--
ALTER TABLE `reports`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;
--
-- AUTO_INCREMENT for table `reports`
--
ALTER TABLE `reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
