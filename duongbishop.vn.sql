/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : dothonhanthuysd.com

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2021-08-10 19:11:50
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for categories
-- ----------------------------
DROP TABLE IF EXISTS `categories`;
CREATE TABLE `categories` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `status` tinyblob DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of categories
-- ----------------------------
INSERT INTO `categories` VALUES ('1', 'dsadsa', null, 'dsadsads', null, '2021-04-12 11:47:16', null);
INSERT INTO `categories` VALUES ('2', 'danh mucj 2', null, '<p>dsadsa</p>', null, '2021-04-12 14:40:11', '2021-04-12 14:40:11');
INSERT INTO `categories` VALUES ('3', 'danh muc 3', null, '<p>mo ta 3</p>', null, '2021-04-12 14:40:23', '2021-04-12 14:40:23');

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT 0,
  `name` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `avatar` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `summary` text CHARACTER SET utf8 DEFAULT NULL,
  `content` text CHARACTER SET utf8 DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `seo_title` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `seo_description` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `seo_keywords` varchar(255) CHARACTER SET utf8 DEFAULT '',
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of news
-- ----------------------------
INSERT INTO `news` VALUES ('2', '0', 'Tin tức 1', '1618744397-sp1.jpg', null, '<p>Tin tức 1</p>', '0', 'Tin tức 1', 'Tin tức 1', '', '2021-04-18 18:13:17', '2021-04-18 18:13:17');
INSERT INTO `news` VALUES ('3', '0', 'Tin tức 2', '1618744409-sp2.jpg', null, '<p>Tin tức 2</p>', '0', 'Tin tức 2', 'Tin tức 2', '', '2021-04-18 18:13:29', '2021-04-18 18:13:29');
INSERT INTO `news` VALUES ('4', '0', 'Tin tức 3', '1618744426-sp3.jpg', null, '<p>Tin tức 3</p>', '0', 'Tin tức 3', 'Tin tức 3', '', '2021-04-18 18:13:46', '2021-04-18 18:13:46');

-- ----------------------------
-- Table structure for pages
-- ----------------------------
DROP TABLE IF EXISTS `pages`;
CREATE TABLE `pages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `key` varchar(255) DEFAULT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

-- ----------------------------
-- Records of pages
-- ----------------------------
INSERT INTO `pages` VALUES ('2', 'Nội dung top trang chủ', '1618739501-anh-gioi-thieu.jpg', 'top_page', '<div class=\"hover-show-edit\">\r\n<h1 class=\"banner-heading intro-title\">Tầm nh&igrave;n</h1>\r\n\r\n<div class=\"intro-des\">\r\n<p><strong>SỨ MỆNH : </strong>Tiếp tục ho&agrave;n thiện v&agrave; ph&aacute;t triển th&agrave;nh cơ sơ sản xuất đồ thờ uy tin v&agrave; chất lượng, l&agrave; l&aacute; cờ đầu trong sứ mệnh gi&uacute;p L&agrave;ng nghề truyền thống Sơn Đồng vươn xa hơn nữa</p>\r\n\r\n<p><strong>TẦM NH&Igrave;N : </strong>Mở rộng thị trường, trở th&agrave;nh đối t&aacute;c uy t&iacute;n, l&acirc;u d&agrave;i với c&aacute;c Kh&aacute;ch h&agrave;ng trong v&agrave; ngo&agrave;i nước.</p>\r\n\r\n<p><strong>KHẨU HIỆU : &quot;</strong>Bạn cần sản phẩm đồ thờ tượng phật chất lượng &ndash; Đ&atilde; c&oacute; ch&uacute;ng t&ocirc;i&quot;.</p>\r\n</div>\r\n</div>', '2021-04-18 10:48:17', '2021-04-18 16:51:41');
INSERT INTO `pages` VALUES ('4', 'Giới thiệu', '1618742858-anh-gioi-thieu.jpg', 'intro', '<div class=\"\">\r\n<div class=\"\">\r\n<h2>Cơ sở sản xuất đồ thờ Nhân Thúy xin gửi lời cám ơn chân thành tới sự ủng hộ của Quý khách hàng cũng như sự quan tâm của Quý khách hàng trong suốt những năm qua.</h2>\r\n\r\n<p>Là một cơ sở sản xuất Đồ Thờ trong Hiệp hội làng nghề Sơn Đồng chúng tôi luôn cam kết đưa đến những sản phẩm tốt nhất, đẹp nhất, phù hợp nhất với Quý Khách hàng, giữ vững được bản sắc dân tộc, góp phần xây dựng thêm và phát triển thêm cho thương hiệu Làng Nghề Đồ Thờ Truyền Thống Sơn Đồng.</p>\r\n\r\n<p>Nhằm đáp ứng tối đa nhất cho các nhu cầu của Khách Hàng. Chúng tôi đã mở rộng và sản xuất tất cả các sản phẩm liên quan đến đồ thờ như:</p>\r\n\r\n<p>+ Các Đồ Thờ: Hoành Phi, Câu Đối, Án Gian, Bàn Ô Sa, Cửa Võng, Cuốn Thư, Ngai, Bát Bửu, Kiệu…</p>\r\n\r\n<p>+ Các Tượng Thờ: Tượng Phật, tượng Quan, Tượng Đức Thánh, Tượng Mẫu, Phù Điêu, Truyền Thần…</p>\r\n\r\n<p>+ Các Linh Vật Thờ: Ông Voi, Ông Hạc, Ông Ngựa…..</p>\r\n\r\n<p>Chúng tôi sẽ tư vấn tận nơi nếu Quý Khách đang có nhu cầu:</p>\r\n\r\n<p>– Làm mới Đình Chùa, Đền, Điện, Nhà Thờ</p>\r\n\r\n<p>– Tu sửa Đình Chùa, Đền Điện , Nhà Thờ… và các sản phẩm liên quan đến đồ thờ.</p>\r\n\r\n<p>Trong thời gian hoạt động, chúng tôi cũng đã rất vinh dự được xây mới một số Đình, Chùa lớn, làm mới rất nhiều các đồ thờ cho các Đinh Chùa, các Nhà Thờ Tổ Tiên lớn, các Điện cũng như các gian thờ Gia Tiên của các hộ Gia Đình trên khắp đất nước từ Bắc vào Nam.</p>\r\n\r\n<p>Hãy liên hệ với chúng tôi bất cứ lúc nào bạn cần. Xin chân thành cảm ơn</p>\r\n\r\n<p>Trân Trọng !</p>\r\n\r\n<p>CƠ SỞ SẢN XUẤT ĐỒ THỜ TRƯỜNG YẾN</p>\r\n\r\n<p>Địa chỉ: Thôn Rô – Xã Sơn Đồng – Huyện Hoài Đức – TP Hà Nội</p>\r\n\r\n<p>Hotline: <a href=\"tel:0936257985\">0936 257 985</a></p>\r\n\r\n<p>+ Website:&nbsp;Dothonhanthuysd.com</p>\r\n\r\n<p>+ Email: Dothonhanthuysd@gmail.com</p>\r\n\r\n<p>Chân thành cảm ơn và rất hân hạnh được phục vụ quý khách</p>\r\n\r\n<div class=\"aiosrs-rating-wrap\" data-schema-id=\"1505\">\r\n<div class=\"aiosrs-star-rating-wrap \">&nbsp;</div>\r\n</div>\r\n</div>\r\n</div>', '2021-04-18 17:42:43', '2021-04-18 17:47:38');

-- ----------------------------
-- Table structure for products
-- ----------------------------
DROP TABLE IF EXISTS `products`;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `category_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` int(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `summary` text DEFAULT NULL,
  `content` text DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT 0,
  `seo_title` varchar(255) DEFAULT NULL,
  `seo_description` varchar(255) DEFAULT NULL,
  `seo_keywords` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of products
-- ----------------------------
INSERT INTO `products` VALUES ('5', '3', 'Sản phẩm 1', '15000', '1618709120-sp1.jpg', null, '<p>111111111111111111111111</p>', null, '0', 'Sản phẩm 1', 'Sản phẩm 1', null, '2021-04-12 14:21:13', '2021-05-01 17:31:41');
INSERT INTO `products` VALUES ('7', '1', 'Sản phẩm 4', '12121', '1618709177-sp4.jpg', null, '<p>dsadsa</p>', null, '0', 'Sản phẩm 4', 'Sản phẩm 4', null, '2021-04-12 14:29:11', '2021-04-18 08:26:17');
INSERT INTO `products` VALUES ('8', '1', 'Sản phẩm 3', '12121', '1618709160-sp3.jpg', null, '<p>dsadsabbbbbbbbbbbbbbb</p>', null, '0', 'Sản phẩm 3', 'Sản phẩm 3', null, '2021-04-12 14:29:25', '2021-04-18 08:26:00');
INSERT INTO `products` VALUES ('9', '1', 'Sản phẩm 2', '12121', '1618709130-sp2.jpg', null, '<p>dsadsacccccccccc</p>', null, '0', 'Sản phẩm 2', 'Sản phẩm 2', null, '2021-04-12 14:29:48', '2021-04-18 08:25:45');
INSERT INTO `products` VALUES ('11', '1', 'Sản phẩm 5', '121', '1618709199-sp5.jpg', null, null, null, '0', 'Sản phẩm 5', 'Sản phẩm 5', null, '2021-04-18 08:26:39', '2021-04-18 08:26:39');
INSERT INTO `products` VALUES ('12', '1', 'Sản phẩm  6', '121212', '1618709218-sp6.jpg', null, null, null, '0', 'Sản phẩm  6', 'Sản phẩm  6', null, '2021-04-18 08:26:58', '2021-04-18 08:26:58');

-- ----------------------------
-- Table structure for reports
-- ----------------------------
DROP TABLE IF EXISTS `reports`;
CREATE TABLE `reports` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `report_slug` varchar(255) DEFAULT '' COMMENT 'Link báo cáo',
  `name` varchar(255) DEFAULT '' COMMENT 'tên báo cáo',
  `client` varchar(255) DEFAULT NULL COMMENT 'tên client',
  `time_start` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp() COMMENT 'thời gian triển khai',
  `description` text DEFAULT NULL COMMENT 'Mô tả nhỏ',
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of reports
-- ----------------------------
INSERT INTO `reports` VALUES ('6', 'bao-cao-lan-thu-nhat', 'Báo cáo lần thư nhất', 'dsadsa', null, null, '2021-03-28 23:55:22', '2021-03-28 23:55:22');
INSERT INTO `reports` VALUES ('7', 'bao-cao-tran-van-manh', 'bao cao trần văn mạnh', 'dsadsa', null, null, '2021-03-30 07:23:15', '2021-03-30 07:23:15');
INSERT INTO `reports` VALUES ('8', 'dsa', 'Nguyễn Viết Mạnh dsdsa', null, '1970-01-06 00:00:00', null, '2021-03-30 07:48:06', '2021-03-30 07:48:06');

-- ----------------------------
-- Table structure for roles
-- ----------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL COMMENT 'Tên role',
  `key` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL COMMENT 'Mô tả quyền',
  `created_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of roles
-- ----------------------------
INSERT INTO `roles` VALUES ('1', 'Admin', 'admin', 'Quyền admin', '2021-02-11 13:20:57', '2021-02-11 13:20:57');
INSERT INTO `roles` VALUES ('2', 'User', 'user', 'Quyền user', '2021-02-11 13:21:00', '2021-02-11 13:21:00');

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL COMMENT 'Số lượng báo cáo',
  `fullname` varchar(255) DEFAULT NULL COMMENT 'Họ tên',
  `info` text DEFAULT NULL COMMENT 'Thông tin liên hệ',
  `report_id` varchar(255) DEFAULT '' COMMENT 'user có quyền xem báo cáo nào',
  `role_id` int(11) DEFAULT 0 COMMENT 'Quyền',
  `status` tinyint(3) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Records of users
-- ----------------------------
INSERT INTO `users` VALUES ('40', 'admin', '$2y$10$j9XR6mfO65Sr0bmCam9R7OC07lywsOFfKYrTgxBKM4gKegBWEoz4e', 'nguyenvietmanhit@gmail.com', '+10987599921', null, 'Mạnh Viết', null, null, '1', '0', '2021-02-11 14:19:54', '2021-02-15 17:22:38');
INSERT INTO `users` VALUES ('41', 'user', '$2y$10$xOgXdMNuEir4LnKVQIN0O.BuJJ1u6gai6kpEIdUvBxdrDmh4xi9Nm', 'nguyenvietmanhit@gmail.com', '+10987599921', null, 'Mạnh Viết', null, null, '2', '0', '2021-02-11 17:24:20', '2021-03-15 23:17:19');
INSERT INTO `users` VALUES ('42', 'tran', '$2y$10$B/davoukeI2IJ4bsWNXJHejoSZKqHGTLcD1NWG7R3Ma0xqVfzhgpC', null, null, null, null, null, '1,3', '2', '0', '2021-02-27 22:40:56', '2021-03-28 22:32:15');
INSERT INTO `users` VALUES ('43', 'user1', '$2y$10$S.JygnACtxEQluEql5XgSeHv6SL1WPVJqneK82LHwWFpMt65XWJb6', null, null, null, null, null, '1', '2', '0', '2021-03-28 22:40:19', '2021-03-28 22:41:01');
INSERT INTO `users` VALUES ('44', 'user2', '$2y$10$j4QZ/ihoHt4kx3.6nD/tjezHvQQI4f7lA.IAHzRta30u32/9rfNvm', 'nguyenvietmanhit@gmail.com', '+10987599921', null, 'Mạnh Viết', '<p>dsadas</p>', '2', '2', '0', '2021-03-28 22:40:35', '2021-03-28 22:44:54');
INSERT INTO `users` VALUES ('45', 'user3', '$2y$10$LrT9T.NnxpATCQxIoeePt.PHwu3btBEFedoKaVZH9IK.hAcJcyeO2', 'nguyenvietmanhit@gmail.comdsadsa', null, null, null, null, '1,2,3,6', '2', '0', '2021-03-28 22:40:52', '2021-03-28 23:56:41');
