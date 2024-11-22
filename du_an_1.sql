-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Máy chủ: 127.0.0.1
-- Thời gian đã tạo: Th10 21, 2024 lúc 06:21 PM
-- Phiên bản máy phục vụ: 10.4.32-MariaDB
-- Phiên bản PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Cơ sở dữ liệu: `du_an_1`
--

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `binh_luan`
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
-- Đang đổ dữ liệu cho bảng `binh_luan`
--

INSERT INTO `binh_luan` (`binh_luan_id`, `noi_dung`, `tai_khoan_id`, `san_pham_id`, `ngay_binh_luan`, `trang_thai`) VALUES
(2, 'cuoừng kend đã bình luận', 3, 43, '2024-11-18 23:16:22', 1),
(3, 'bình boong xin chào', 5, 44, '2024-11-19 23:17:18', 1),
(6, 'đẹp', 1, 50, '2024-11-21 14:30:56', 1),
(7, 'hiii', 1, 50, '2024-11-21 14:58:59', 1),
(8, 'đẹp lắm nha', 1, 50, '2024-11-21 15:01:12', 1),
(9, 'oke lắm nha', 1, 50, '2024-11-21 15:23:40', 1),
(10, 'sản phẩm này oke nha', 6, 44, '2024-11-21 15:47:37', 1),
(11, 'hay lắm nhaaaa', 1, 45, '2024-11-21 17:16:19', 1),
(12, 'oke nhaaa\r\n', 1, 45, '2024-11-21 20:07:39', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `chi_tiet_don_hang`
--

CREATE TABLE `chi_tiet_don_hang` (
  `chi_tiet_don_hang_id` int(11) NOT NULL,
  `don_hang_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL,
  `gia` int(11) NOT NULL,
  `tong_tien` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`chi_tiet_don_hang_id`, `don_hang_id`, `san_pham_id`, `so_luong`, `gia`, `tong_tien`) VALUES
(1, 1, 43, 2, 4250, 9000),
(2, 1, 44, 1, 4300, 4750),
(3, 1, 45, 3, 3000, 7650),
(7, 2, 50, 1, 504550, NULL),
(9, 5, 44, 3, 4300, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `danh_muc`
--

CREATE TABLE `danh_muc` (
  `danh_muc_id` int(11) NOT NULL,
  `ten_danh_muc` varchar(50) NOT NULL,
  `hinh` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `danh_muc`
--

INSERT INTO `danh_muc` (`danh_muc_id`, `ten_danh_muc`, `hinh`, `mo_ta`, `trang_thai`) VALUES
(1, 'Iphone 12 pro', '../Upload/Category/1732121049_1731597011_a2.jpg', '123', 1),
(2, 'Iphone 11', '../Upload/Category/1731946184_1731603710_1731596665_a3.png', 'Iphone của mọi nhà hãy đến đây cùng với chúng tôi', 1),
(3, 'Iphone 13', '../Upload/Category/1731946242_1731597110_a1.jpg', 'hãy đến đẩy để cùng nhau thăng hoa', 1),
(4, 'Iphone 14 series', '../Upload/Category/1732172027_2022_11_30_638054217303176240_ip-14-pro-max-bac-1.jpg', 'Iphone đẹp kenggg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `don_hang`
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
-- Đang đổ dữ liệu cho bảng `don_hang`
--

INSERT INTO `don_hang` (`don_hang_id`, `tai_khoan_id`, `ho_va_ten`, `dia_chi`, `so_dien_thoai`, `email`, `ngay_dat`, `tong_tien`, `phuong_thuc_thanh_toan`, `trang_thai`, `ngay_xu_ly`) VALUES
(1, 1, 'Nguyễn Văn A', '123 Đường ABC, Quận 1, TP.HCM', '0901234567', 'nguyenvana@gmail.com', '2024-03-20', 6359000, 1, 2, '2024-11-18'),
(2, 2, 'Trần Thị B', '456 Đường XYZ, Quận 2, TP.HCM', '0909876543', 'tranthib@gmail.com', '2024-03-19', 50000000, 2, 2, '2024-11-21'),
(5, 3, '', NULL, '', '', '2024-11-18', 15660000, 0, 3, '2024-11-21');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `gio_hang`
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
-- Cấu trúc bảng cho bảng `hinh_anh_san_pham`
--

CREATE TABLE `hinh_anh_san_pham` (
  `hinh_anh_id` int(11) NOT NULL,
  `hinh_sp` varchar(255) NOT NULL,
  `san_pham_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `hinh_anh_san_pham`
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
(20, '../Upload/Product/1731872319_a37.png', 50),
(22, '../Upload/Product/1732194436_2022_11_30_638054220350691584_ip-14-pro-max-tim-1.jpg', 52);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `khuyen_mai`
--

CREATE TABLE `khuyen_mai` (
  `khuyen_mai_id` int(11) NOT NULL,
  `ten_khuyen_mai` varchar(255) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `phan_tram_giam` int(11) NOT NULL,
  `giam_gia` decimal(10,2) DEFAULT NULL,
  `ngay_bat_dau` date NOT NULL,
  `ngay_ket_thuc` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`khuyen_mai_id`, `ten_khuyen_mai`, `mo_ta`, `phan_tram_giam`, `giam_gia`, `ngay_bat_dau`, `ngay_ket_thuc`) VALUES
(4, 'Saleee', 'nhân ngày 20-11 sale lớn hãy mua', 10, NULL, '2024-11-20', '2024-11-22'),
(5, 'Dai', 'hahahaa', 20, NULL, '2024-11-16', '2024-11-20'),
(7, 'khuyến mãi', 'hhhhhhhhhhhh', 35, 0.00, '2024-11-20', '2024-11-21'),
(8, 'sale cho bình boong', 'nhân ngày bình có vợ 2', 12, 0.00, '2024-11-18', '2024-11-19'),
(9, 'Sale sập sàn', '20-11 ngày hôm nay', 50, NULL, '2024-11-21', '2024-11-22');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `ram`
--

CREATE TABLE `ram` (
  `ram_id` int(11) NOT NULL,
  `dung_luong` varchar(20) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `ram`
--

INSERT INTO `ram` (`ram_id`, `dung_luong`, `mo_ta`, `trang_thai`) VALUES
(1, '8GB', 'Vẫn ổn', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham`
--

CREATE TABLE `san_pham` (
  `san_pham_id` int(11) NOT NULL,
  `ten_san_pham` varchar(50) NOT NULL,
  `gia` int(11) NOT NULL,
  `ngay_nhap` date DEFAULT NULL,
  `mo_ta` text DEFAULT NULL,
  `so_luot_xem` int(11) DEFAULT 0,
  `trang_thai` tinyint(1) DEFAULT 1,
  `danh_muc_id` int(11) NOT NULL,
  `khuyen_mai_id` int(11) DEFAULT NULL,
  `gia_khuyen_mai` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham`
--

INSERT INTO `san_pham` (`san_pham_id`, `ten_san_pham`, `gia`, `ngay_nhap`, `mo_ta`, `so_luot_xem`, `trang_thai`, `danh_muc_id`, `khuyen_mai_id`, `gia_khuyen_mai`) VALUES
(43, 'Iphone12', 565000, '2024-11-15', '123', 2, 1, 1, 4, NULL),
(44, 'Iphone', 5800000, '2024-11-16', '123', 34, 1, 1, NULL, NULL),
(45, 'Iphone14 Promax5555', 3000, '2024-11-16', '123', 45, 1, 1, NULL, NULL),
(50, 'Iphone 8', 100000000, '2024-11-18', '123', 47, 1, 1, 5, NULL),
(52, 'Iphone 14 Pro Max', 24390000, '2024-10-29', 'Iphone đẹp kenggg', 22, 1, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham_khuyen_mai`
--

CREATE TABLE `san_pham_khuyen_mai` (
  `san_pham_id` int(11) NOT NULL,
  `khuyen_mai_id` int(11) NOT NULL,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham_khuyen_mai`
--

INSERT INTO `san_pham_khuyen_mai` (`san_pham_id`, `khuyen_mai_id`, `ngay_them`) VALUES
(43, 7, '2024-11-20 18:36:48'),
(44, 4, '2024-11-21 15:26:05'),
(45, 5, '2024-11-20 18:36:09'),
(50, 9, '2024-11-21 15:51:06'),
(52, 8, '2024-11-21 15:43:13');

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `san_pham_ram`
--

CREATE TABLE `san_pham_ram` (
  `san_pham_id` int(11) NOT NULL,
  `ram_id` int(11) NOT NULL,
  `gia_them` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Đang đổ dữ liệu cho bảng `san_pham_ram`
--

INSERT INTO `san_pham_ram` (`san_pham_id`, `ram_id`, `gia_them`) VALUES
(43, 1, 0.00);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `slides`
--

CREATE TABLE `slides` (
  `slide_id` int(11) NOT NULL,
  `img` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Đang đổ dữ liệu cho bảng `slides`
--

INSERT INTO `slides` (`slide_id`, `img`, `trang_thai`) VALUES
(1, '../Upload/Slides/1731906492_1731589962_banner3.jpg', 1),
(2, '../Upload/Slides/1731906501_1731762517_banner2.jpg', 1),
(3, '../Upload/Slides/1731906511_1731865258_banner1.jpg', 1),
(4, '../Upload/Slides/1731906520_1731761200_banner4.jpg', 1);

-- --------------------------------------------------------

--
-- Cấu trúc bảng cho bảng `tai_khoan`
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
-- Đang đổ dữ liệu cho bảng `tai_khoan`
--

INSERT INTO `tai_khoan` (`tai_khoan_id`, `ho_va_ten`, `email`, `mat_khau`, `dia_chi`, `so_dien_thoai`, `gioi_tinh`, `hinh`, `vai_tro`, `ngay_dang_ky`, `trang_thai`) VALUES
(1, 'vandai zzzz', 'admin@gmail.com', '123123', 'haaaaa', '098765432', 0, '../Upload/User/1731751753_avatar.png', 1, '2024-11-18', 1),
(2, 'Nguyễn Văn Cường ken', 'cuongkend123@gmail.com', '123456', 'hà nam', '0901234567', 0, '../Upload/User/1731758123_icon-account-info.png', 0, '2024-11-18', 1),
(3, 'Trần Thị B', 'tranthib@gmail.com', '123456', '456 Đường XYZ, Quận 2, TP.HCM', '0909876543', 0, '../Upload/User/1731758134_add-to-cart.png', 0, '2024-11-16', 1),
(4, 'Lê Văn C', 'levanc@gmail.com', '123456', '789 Đường DEF, Quận 3, TP.HCM', '0908765432', 0, '../Upload/User/1731758149_icon-account-home.png', 0, '2024-11-16', 1),
(5, 'Bình boong', 'binhbong123@gmail.com', '123123', 'hiệp hòa', '098765432', 0, '../Upload/User/1731872512_1731097720nam.jpg', 0, '2024-11-18', 1),
(6, 'Ngọc Bảo Anh Nguyễn', 'banhday@gmail.com', 'banhday', 'Phú Thọ', '0368706552', 0, '../Upload/User/nam.jpg', 0, NULL, 1);

--
-- Chỉ mục cho các bảng đã đổ
--

--
-- Chỉ mục cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD PRIMARY KEY (`binh_luan_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Chỉ mục cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD PRIMARY KEY (`chi_tiet_don_hang_id`),
  ADD KEY `don_hang_id` (`don_hang_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Chỉ mục cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  ADD PRIMARY KEY (`danh_muc_id`);

--
-- Chỉ mục cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD PRIMARY KEY (`don_hang_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`);

--
-- Chỉ mục cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD PRIMARY KEY (`gio_hang_id`),
  ADD KEY `tai_khoan_id` (`tai_khoan_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Chỉ mục cho bảng `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  ADD PRIMARY KEY (`hinh_anh_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Chỉ mục cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`khuyen_mai_id`);

--
-- Chỉ mục cho bảng `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`ram_id`);

--
-- Chỉ mục cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`san_pham_id`),
  ADD KEY `danh_muc_id` (`danh_muc_id`),
  ADD KEY `san_pham_khuyen_mai_fk` (`khuyen_mai_id`);

--
-- Chỉ mục cho bảng `san_pham_khuyen_mai`
--
ALTER TABLE `san_pham_khuyen_mai`
  ADD PRIMARY KEY (`san_pham_id`,`khuyen_mai_id`),
  ADD KEY `khuyen_mai_id` (`khuyen_mai_id`);

--
-- Chỉ mục cho bảng `san_pham_ram`
--
ALTER TABLE `san_pham_ram`
  ADD PRIMARY KEY (`san_pham_id`,`ram_id`),
  ADD KEY `ram_id` (`ram_id`);

--
-- Chỉ mục cho bảng `slides`
--
ALTER TABLE `slides`
  ADD PRIMARY KEY (`slide_id`);

--
-- Chỉ mục cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  ADD PRIMARY KEY (`tai_khoan_id`);

--
-- AUTO_INCREMENT cho các bảng đã đổ
--

--
-- AUTO_INCREMENT cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  MODIFY `binh_luan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `chi_tiet_don_hang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `danh_muc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `don_hang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `gio_hang_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT cho bảng `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  MODIFY `hinh_anh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT cho bảng `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `khuyen_mai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT cho bảng `ram`
--
ALTER TABLE `ram`
  MODIFY `ram_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `san_pham_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT cho bảng `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT cho bảng `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `tai_khoan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Các ràng buộc cho các bảng đã đổ
--

--
-- Các ràng buộc cho bảng `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`),
  ADD CONSTRAINT `binh_luan_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

--
-- Các ràng buộc cho bảng `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hang` (`don_hang_id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

--
-- Các ràng buộc cho bảng `don_hang`
--
ALTER TABLE `don_hang`
  ADD CONSTRAINT `don_hang_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`);

--
-- Các ràng buộc cho bảng `gio_hang`
--
ALTER TABLE `gio_hang`
  ADD CONSTRAINT `gio_hang_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`),
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

--
-- Các ràng buộc cho bảng `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  ADD CONSTRAINT `hinh_anh_san_pham_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`);

--
-- Các ràng buộc cho bảng `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_muc` (`danh_muc_id`),
  ADD CONSTRAINT `san_pham_khuyen_mai_fk` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `khuyen_mai` (`khuyen_mai_id`);

--
-- Các ràng buộc cho bảng `san_pham_khuyen_mai`
--
ALTER TABLE `san_pham_khuyen_mai`
  ADD CONSTRAINT `san_pham_khuyen_mai_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `san_pham_khuyen_mai_ibfk_2` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `khuyen_mai` (`khuyen_mai_id`) ON DELETE CASCADE;

--
-- Các ràng buộc cho bảng `san_pham_ram`
--
ALTER TABLE `san_pham_ram`
  ADD CONSTRAINT `san_pham_ram_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `san_pham_ram_ibfk_2` FOREIGN KEY (`ram_id`) REFERENCES `ram` (`ram_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
