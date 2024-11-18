-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 05:20 PM
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
-- Database: `du_an_1`
--

-- --------------------------------------------------------

--
-- Table structure for table `binh_luan`
--

CREATE TABLE `binh_luan` (
  `binh_luan_id` int(11) NOT NULL,
  `noi_dung` varchar(255) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `ngay_binh_luan` datetime DEFAULT current_timestamp(),
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `binh_luan`
--

INSERT INTO `binh_luan` (`binh_luan_id`, `noi_dung`, `tai_khoan_id`, `san_pham_id`, `ngay_binh_luan`, `trang_thai`) VALUES
(1, 'haaaaaaaaaa', 1, 50, '2024-11-11 23:13:20', 1),
(2, 'cuoừng kend đã bình luận', 3, 43, '2024-11-18 23:16:22', 1),
(3, 'bình boong xin chào', 5, 44, '2024-11-19 23:17:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `chi_tiet_don_hang_id` int(11) NOT NULL,
  `don_hang_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `gia` int(11) NOT NULL,
  `tong_tien` int(11) DEFAULT NULL,
  `khuyen_mai` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`chi_tiet_don_hang_id`, `don_hang_id`, `san_pham_id`, `so_luong`, `gia`, `tong_tien`, `khuyen_mai`) VALUES
(1, 1, 43, 2, 5000, 9000, 10),
(2, 1, 44, 1, 5000, 4750, 5),
(3, 1, 45, 3, 3000, 7650, 15),
(7, 2, 50, 1, 504550, NULL, 15),
(9, 5, 44, 3, 900500, NULL, 12);

-- --------------------------------------------------------

--
-- Table structure for table `danh_muc`
--

CREATE TABLE `danh_muc` (
  `danh_muc_id` int(11) NOT NULL,
  `ten_danh_muc` varchar(50) NOT NULL,
  `hinh` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `danh_muc`
--

INSERT INTO `danh_muc` (`danh_muc_id`, `ten_danh_muc`, `hinh`, `mo_ta`, `trang_thai`) VALUES
(1, 'Iphone 12 pro', '../Upload/Category/1731728097_iphone.webp', '123', 1),
(2, 'Iphone 11', '../Upload/Category/1731946184_1731603710_1731596665_a3.png', 'Iphone của mọi nhà hãy đến đây cùng với chúng tôi', 1),
(3, 'Iphone 13', '../Upload/Category/1731946242_1731597110_a1.jpg', 'hãy đến đẩy để cùng nhau thăng hoa', 1);

-- --------------------------------------------------------

--
-- Table structure for table `don_hang`
--

CREATE TABLE `don_hang` (
  `don_hang_id` int(11) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  `ho_va_ten` varchar(50) NOT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `email` varchar(255) NOT NULL,
  `ngay_dat` date DEFAULT NULL,
  `tong_tien` int(11) DEFAULT NULL,
  `phuong_thuc_thanh_toan` tinyint(1) DEFAULT 1,
  `trang_thai` tinyint(1) DEFAULT 1,
  `ngay_xu_ly` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `don_hang`
--

INSERT INTO `don_hang` (`don_hang_id`, `tai_khoan_id`, `ho_va_ten`, `dia_chi`, `so_dien_thoai`, `email`, `ngay_dat`, `tong_tien`, `phuong_thuc_thanh_toan`, `trang_thai`, `ngay_xu_ly`) VALUES
(1, 1, 'Nguyễn Văn A', '123 Đường ABC, Quận 1, TP.HCM', '0901234567', 'nguyenvana@gmail.com', '2024-03-20', 21400, 1, 2, '2024-11-18'),
(2, 2, 'Trần Thị B', '456 Đường XYZ, Quận 2, TP.HCM', '0909876543', 'tranthib@gmail.com', '2024-03-19', 428868, 2, 3, '2024-11-18'),
(5, 3, '', NULL, '', '', '2024-11-18', 2377320, 0, 1, '2024-11-18');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `gio_hang_id` int(11) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `ngay_them_vao` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hinh_anh_san_pham`
--

CREATE TABLE `hinh_anh_san_pham` (
  `hinh_anh_id` int(11) NOT NULL,
  `hinh_sp` varchar(255) NOT NULL,
  `san_pham_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hinh_anh_san_pham`
--

INSERT INTO `hinh_anh_san_pham` (`hinh_anh_id`, `hinh_sp`, `san_pham_id`) VALUES
(1, '../Upload/Product/1731603710_1731596665_a3.png', 43),
(2, '../Upload/Product/1731603710_1731596961_a2.jpg', 43),
(3, '../Upload/Product/1731603710_1731597011_a2.jpg', 43),
(4, '../Upload/Product/1731603710_1731597110_a1.jpg', 43),
(5, '../Upload/Product/1731603732_a27.webp', 44),
(6, '../Upload/Product/1731603732_a28.png', 44),
(7, '../Upload/Product/1731606588_a23.webp', 45),
(8, '../Upload/Product/1731606588_a24.webp', 45),
(9, '../Upload/Product/1731606588_a25.webp', 45),
(10, '../Upload/Product/1731606975_1731596665_a3.png', 46),
(11, '../Upload/Product/1731606975_1731596961_a2.jpg', 46),
(12, '../Upload/Product/1731606975_1731597011_a2.jpg', 46),
(13, '../Upload/Product/1731606975_1731597110_a1.jpg', 46),
(14, '../Upload/Product/1731609599_1731596665_a3.png', 47),
(15, '../Upload/Product/1731609599_1731596961_a2.jpg', 47),
(16, '../Upload/Product/1731610492_a7.jpg', 48),
(17, '../Upload/Product/1731610492_a8.jpeg', 48),
(20, '../Upload/Product/1731872319_a37.png', 50),
(21, '../Upload/Product/1731946292_1731583828_a10.jpg', 51);

-- --------------------------------------------------------

--
-- Table structure for table `san_pham`
--

CREATE TABLE `san_pham` (
  `san_pham_id` int(11) NOT NULL,
  `ten_san_pham` varchar(50) NOT NULL,
  `gia` int(11) NOT NULL,
  `ngay_nhap` date DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `so_luot_xem` int(11) DEFAULT 0,
  `trang_thai` tinyint(1) DEFAULT 1,
  `danh_muc_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`san_pham_id`, `ten_san_pham`, `gia`, `ngay_nhap`, `mo_ta`, `so_luot_xem`, `trang_thai`, `danh_muc_id`) VALUES
(43, 'Iphone12', 5000, '2024-11-15', '123', 0, 1, 1),
(44, 'Iphone', 5000, '2024-11-16', 'gfd', 0, 1, 1),
(45, 'Iphone14 Promax5555', 3000, '2024-11-16', '123', 0, 1, 1),
(46, 'Iphone14 Promax3333', 3000, '2024-11-15', '124', 0, 1, 1),
(47, 'Iphone1211111', 3000, '2024-11-16', '1', 0, 1, 1),
(48, 'Iphone14 Promax333333', 3000, '2024-11-15', '123', 0, 1, 1),
(50, 'Iphone 8', 12300, '2024-11-18', 'haaaaaaaaa', 0, 2, 1),
(51, 'iphone 11', 12000000, '2024-11-18', 'haaaaaaaaaaaaaaaa', 0, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `slides`
--

INSERT INTO `slides` (`slide_id`, `img`, `trang_thai`) VALUES
(1, '../Upload/Slides/1731906492_1731589962_banner3.jpg', 1),
(2, '../Upload/Slides/1731906501_1731762517_banner2.jpg', 1),
(3, '../Upload/Slides/1731906511_1731865258_banner1.jpg', 1),
(4, '../Upload/Slides/1731906520_1731761200_banner4.jpg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tai_khoan`
--

CREATE TABLE `tai_khoan` (
  `tai_khoan_id` int(11) NOT NULL,
  `ho_va_ten` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mat_khau` varchar(50) NOT NULL,
  `dia_chi` varchar(255) DEFAULT NULL,
  `so_dien_thoai` varchar(20) NOT NULL,
  `gioi_tinh` tinyint(1) NOT NULL,
  `hinh` varchar(255) DEFAULT NULL,
  `vai_tro` tinyint(1) DEFAULT 0,
  `ngay_dang_ky` date DEFAULT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tai_khoan`
--

INSERT INTO `tai_khoan` (`tai_khoan_id`, `ho_va_ten`, `email`, `mat_khau`, `dia_chi`, `so_dien_thoai`, `gioi_tinh`, `hinh`, `vai_tro`, `ngay_dang_ky`, `trang_thai`) VALUES
(1, 'vandai zzzz', 'admin@gmail.com', '123123', 'haaaaa', '098765432', 0, '../Upload/User/1731751753_avatar.png', 1, '2024-11-18', 1),
(2, 'Nguyễn Văn Cường ken', 'cuongkend123@gmail.com', '123456', 'hà nam', '0901234567', 0, '../Upload/User/1731758123_icon-account-info.png', 0, '2024-11-18', 1),
(3, 'Trần Thị B', 'tranthib@gmail.com', '123456', '456 Đường XYZ, Quận 2, TP.HCM', '0909876543', 0, '../Upload/User/1731758134_add-to-cart.png', 0, '2024-11-16', 1),
(4, 'Lê Văn C', 'levanc@gmail.com', '123456', '789 Đường DEF, Quận 3, TP.HCM', '0908765432', 0, '../Upload/User/1731758149_icon-account-home.png', 0, '2024-11-16', 1),
(5, 'Bình boong', 'binhbong123@gmail.com', '123123', 'hiệp hòa', '098765432', 0, '../Upload/User/1731872512_1731097720nam.jpg', 0, '2024-11-18', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`binh_luan_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`chi_tiet_don_hang_id`),
  ADD KEY `don_hang_id` (`don_hang_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`danh_muc_id`);

--
-- Indexes for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`don_hang_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`);

--
-- Indexes for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`gio_hang_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  ADD PRIMARY KEY (`hinh_anh_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`san_pham_id`),
  ADD KEY `danh_muc_id` (`danh_muc_id`);

--
-- Indexes for table `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Indexes for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`tai_khoan_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `binh_luan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `chi_tiet_don_hang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `danh_muc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `don_hang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `gio_hang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  MODIFY `hinh_anh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `san_pham_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `tai_khoan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`),
  ADD CONSTRAINT `binh_luan_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hang` (`don_hang_id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

--
-- Constraints for table `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`);

--
-- Constraints for table `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`),
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

--
-- Constraints for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  ADD CONSTRAINT `hinh_anh_san_pham_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_muc` (`danh_muc_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
