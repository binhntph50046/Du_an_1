-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 22, 2024 at 03:52 AM
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
-- Table structure for table `chi_tiet_don_hang`
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
-- Dumping data for table `chi_tiet_don_hang`
--

INSERT INTO `chi_tiet_don_hang` (`chi_tiet_don_hang_id`, `don_hang_id`, `san_pham_id`, `so_luong`, `gia`, `tong_tien`) VALUES
(1, 1, 43, 2, 4250, 9000),
(2, 1, 44, 1, 4300, 4750),
(3, 1, 45, 3, 3000, 7650),
(7, 2, 50, 1, 504550, NULL),
(9, 5, 44, 3, 4300, NULL);

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
(1, 'Iphone 12 series', '../Upload/Category/1732217631_2020_10_14_637382695935086033_ip-12-pro-dd.jpeg', 'Iphone 12, Iphone 12 Pro, Iphone 12 Pro Max', 1),
(2, 'Iphone 13 series', '../Upload/Category/1732217745_2023_1_31_638107846050436352_iphone-13-pro-dd.jpg', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 1),
(3, 'Iphone 14 series', '../Upload/Category/1732217792_2022_10_7_638007285202545738_iphone-14-pro-max-dd-bh.jpg', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 1),
(5, 'Iphone 15 series', '../Upload/Category/1732217838_iphone_15_pro_thumb_0900bfe015.png', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 1);

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
(1, 1, 'Nguyễn Văn A', '123 Đường ABC, Quận 1, TP.HCM', '0901234567', 'nguyenvana@gmail.com', '2024-03-20', 127200000, 1, 2, '2024-11-18'),
(2, 2, 'Trần Thị B', '456 Đường XYZ, Quận 2, TP.HCM', '0909876543', 'tranthib@gmail.com', '2024-03-19', 29500000, 2, 2, '2024-11-21'),
(5, 3, '', NULL, '', '', '2024-11-18', 42000000, 0, 3, '2024-11-21');

-- --------------------------------------------------------

--
-- Table structure for table `gio_hang`
--

CREATE TABLE `gio_hang` (
  `gio_hang_id` int(11) NOT NULL,
  `tai_khoan_id` int(11) NOT NULL,
  `san_pham_id` int(11) NOT NULL,
  `ram_id` int(11) NOT NULL,
  `so_luong` int(11) NOT NULL DEFAULT 1,
  `ngay_them_vao` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gio_hang`
--

INSERT INTO `gio_hang` (`gio_hang_id`, `tai_khoan_id`, `san_pham_id`, `ram_id`, `so_luong`, `ngay_them_vao`) VALUES
(1, 1, 43, 5, 2, '2024-11-18 23:16:22'),
(2, 1, 44, 6, 1, '2024-11-19 23:17:18'),
(3, 1, 45, 7, 3, '2024-11-21 17:16:19'),
(7, 2, 50, 5, 1, '2024-11-21 20:07:39'),
(9, 5, 44, 5, 3, '2024-11-21 20:07:39');

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
(1, '../Upload/Product/1732218837_2020_10_14_637382632990998957_ip-12-xanhduong-1.jpeg', 43),
(5, '../Upload/Product/1732218025_2021_9_15_637673230231791121_iphone-13-mini-den-1.jpg', 44),
(7, '../Upload/Product/1732218062_2022_11_30_638054086797665958_ip-14-den-1.jpg', 45),
(20, '../Upload/Product/1732218642_2023_9_15_638303935769505085_iphone-15-xanh-1.jpg', 50),
(25, '../Upload/Product/1732218675_2020_10_14_637382632990998957_ip-12-xanhla-1.jpeg', 55),
(27, '../Upload/Product/1732218886_2021_9_15_637673230232103636_iphone-13-mini-do-1.jpg', 57),
(28, '../Upload/Product/1732218925_2022_11_30_638054088819837718_ip-14-do-1.jpg', 58),
(29, '../Upload/Product/1732219085_2023_9_20_638307980220145280_iphone-15-promax-den-1.jpg', 59),
(32, '../Upload/Product/1732219195_2023_9_20_638307982103040290_iphone-15-promax-trang-1.jpg', 62),
(33, '../Upload/Product/1732219327_2023_9_20_638307989548944936_iphone-15-promax-xanh-1.jpg', 63),
(34, '../Upload/Product/1732219341_2023_9_20_638307992305419305_iphone-15-promax-xanh-vang-1.jpg', 64),
(35, '../Upload/Product/1732219521_2023_9_16_638304560571374532_iphone-15-pro-den-1.jpg', 65),
(36, '../Upload/Product/1732219537_2023_9_16_638304565863318698_iphone-15-pro-trang-1.jpg', 66),
(37, '../Upload/Product/1732219573_2023_9_16_638304612779650501_iphone-15-pro-xanh-1.jpg', 67),
(38, '../Upload/Product/1732219593_2023_9_16_638304626032590721_iphone-15-pro-vang-1.jpg', 68),
(39, '../Upload/Product/1732219643_2023_9_15_638303942321093007_iphone-15-hong-1.jpg', 69),
(40, '../Upload/Product/1732219671_2023_9_15_638303944832321476_iphone-15-vang-1.jpg', 70),
(41, '../Upload/Product/1732219694_2023_9_15_638303947975273507_iphone-15-den-1.jpg', 71),
(42, '../Upload/Product/1732219709_2023_9_15_638303950417112947_iphone-15-xanh-la-1.jpg', 72),
(43, '../Upload/Product/1732241909_2022_11_30_638054090260153672_ip-14-tim-1.jpg', 73),
(44, '../Upload/Product/1732241929_2022_11_30_638054091427671235_ip-14-trang-1.jpg', 74),
(45, '../Upload/Product/1732241950_2022_11_30_638054092490170033_ip-14-xanh-1.jpg', 75),
(46, '../Upload/Product/1732241977_2023_3_7_638138235534641283_iphone-14-vang-1.jpg', 76),
(47, '../Upload/Product/1732242081_2022_11_30_638054205618721510_ip-14-pro-bac-1.jpg', 77),
(48, '../Upload/Product/1732242102_2022_11_30_638054212873983148_ip-14-pro-den-1.jpg', 78),
(49, '../Upload/Product/1732242122_2022_11_30_638054213959247730_ip-14-pro-tim-1.jpg', 79),
(50, '../Upload/Product/1732242142_2022_11_30_638054215482172772_ip-14-pro-vang-1.jpg', 80),
(51, '../Upload/Product/1732242272_2022_11_30_638054217303176240_ip-14-pro-max-bac-1.jpg', 81),
(52, '../Upload/Product/1732242404_2022_11_30_638054220350691584_ip-14-pro-max-tim-1.jpg', 82),
(53, '../Upload/Product/1732242449_2022_11_30_638054218956629637_ip-14-pro-max-den-1.jpg', 83),
(54, '../Upload/Product/1732242479_2022_11_30_638054222139728415_ip-14-pro-max-vang-1.jpg', 84),
(55, '../Upload/Product/1732242662_2021_9_15_637673230236166189_iphone-13-mini-hong-1.jpg', 85),
(56, '../Upload/Product/1732242682_2021_9_15_637673230236322511_iphone-13-mini-trang-1.jpg', 86),
(57, '../Upload/Product/1732242715_2021_9_15_637673230237572519_iphone-13-mini-xanh-1.jpg', 87),
(58, '../Upload/Product/1732242742_2022_3_9_637824166253829277_iphone-13-xanhreu-1.jpg', 88),
(59, '../Upload/Product/1732242795_2022_4_21_637861335143797501_iphone-13-pro-max-xanh-1.jpg', 89),
(60, '../Upload/Product/1732242822_2022_4_21_637861377064603878_iphone-13-pro-xanhla-1.jpg', 90),
(61, '../Upload/Product/1732242843_2022_4_22_637862349455987973_iphone-13-pro-max-vang-1.jpg', 91),
(62, '../Upload/Product/1732242868_2022_4_22_637862360771182933_iphone-13-pro-max-xam-1.jpg', 92),
(63, '../Upload/Product/1732242893_2022_4_22_637862362161472689_iphone-13-pro-max-bac-1.jpg', 93),
(64, '../Upload/Product/1732242953_2021_9_15_637673230236166189_iphone-13-mini-hong-1.jpg', 94),
(65, '../Upload/Product/1732242983_2021_9_15_637673230236322511_iphone-13-mini-trang-1.jpg', 95),
(66, '../Upload/Product/1732243008_2021_9_15_637673230237572519_iphone-13-mini-xanh-1.jpg', 96),
(67, '../Upload/Product/1732243031_2022_3_9_637824166253829277_iphone-13-xanhreu-1.jpg', 97),
(68, '../Upload/Product/1732243731_2022_12_6_638059219869727250_iphone-12-den-1.jpg', 98),
(69, '../Upload/Product/1732243750_2022_12_6_638059230891032843_iphone-12-do-1.jpg', 99),
(70, '../Upload/Product/1732243768_2022_12_6_638059232363845825_iphone-12-tim-1.jpg', 100),
(71, '../Upload/Product/1732243878_2022_12_6_638059234481574752_iphone-12-trang-1.jpg', 101),
(72, '../Upload/Product/1732243903_2022_12_6_638059236214534473_iphone-12-xanh-1.jpg', 102);

-- --------------------------------------------------------

--
-- Table structure for table `khuyen_mai`
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
-- Dumping data for table `khuyen_mai`
--

INSERT INTO `khuyen_mai` (`khuyen_mai_id`, `ten_khuyen_mai`, `mo_ta`, `phan_tram_giam`, `giam_gia`, `ngay_bat_dau`, `ngay_ket_thuc`) VALUES
(4, 'Saleee', 'nhân ngày 20-11 sale lớn hãy mua', 0, 800000.00, '2024-11-20', '2024-11-22'),
(7, 'khuyến mãi', 'hhhhhhhhhhhh', 35, 0.00, '2024-11-20', '2024-11-21'),
(8, 'sale cho bình boong', 'nhân ngày bình có vợ 2', 12, 0.00, '2024-11-20', '2024-11-27'),
(9, 'Sale sập sàn', '20-11 ngày hôm nay', 0, 500000.00, '2024-11-21', '2024-11-22');

-- --------------------------------------------------------

--
-- Table structure for table `ram`
--

CREATE TABLE `ram` (
  `ram_id` int(11) NOT NULL,
  `dung_luong` varchar(20) NOT NULL,
  `mo_ta` text DEFAULT NULL,
  `trang_thai` tinyint(1) DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `ram`
--

INSERT INTO `ram` (`ram_id`, `dung_luong`, `mo_ta`, `trang_thai`) VALUES
(5, '128Gb', 'Dung lượng hợp vừa', 1),
(6, '256Gb', 'Dung lượng hợp đủ với chụp ảnh', 1),
(7, '512Gb', 'Dung lượng hợp hợp với quay phim, chụp ảnh, chơi game', 1);

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
  `danh_muc_id` int(11) NOT NULL,
  `khuyen_mai_id` int(11) DEFAULT NULL,
  `gia_khuyen_mai` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `san_pham`
--

INSERT INTO `san_pham` (`san_pham_id`, `ten_san_pham`, `gia`, `ngay_nhap`, `mo_ta`, `so_luot_xem`, `trang_thai`, `danh_muc_id`, `khuyen_mai_id`, `gia_khuyen_mai`) VALUES
(43, 'Iphone 12', 5600000, '2024-11-15', 'iPhone 12: Là phiên bản tiêu chuẩn, sở hữu màn hình 6.1 inch, kích thước lớn hơn Mini nhưng vẫn nhỏ gọn và dễ dùng. Camera kép 12MP chụp ảnh rõ nét, hỗ trợ quay video Dolby Vision HDR, mang đến trải nghiệm hình ảnh chuyên nghiệp. Đặc biệt, iPhone 12 tích hợp MagSafe – hệ thống nam châm hỗ trợ sạc không dây và phụ kiện thông minh, làm nổi bật tính tiện dụng và hiện đại.', 12, 1, 1, 4, NULL),
(44, 'Iphone 13', 14800000, '2024-11-16', 'iPhone 13: Phiên bản tiêu chuẩn với màn hình 6.1 inch, đáp ứng nhu cầu sử dụng hàng ngày. Camera kép 12MP được nâng cấp với cảm biến lớn hơn và tính năng chống rung quang học (Sensor-Shift OIS) giúp quay chụp ổn định. Thời lượng pin tăng 2.5 giờ so với iPhone 12.', 45, 1, 2, NULL, NULL),
(45, 'Iphone 14', 34000000, '2024-11-16', 'iPhone 14: Màn hình 6.1 inch, chip A15 Bionic (GPU 5 nhân), camera kép 12MP cải tiến, cho khả năng chụp ảnh thiếu sáng tốt hơn 49% nhờ Photonic Engine. Đây là lựa chọn ổn định cho người dùng phổ thông.', 52, 1, 3, NULL, NULL),
(50, 'Iphone 15', 30000000, '2024-11-18', 'iPhone 15: Với màn hình 6.1 inch và Dynamic Island (lần đầu có trên bản thường), iPhone 15 nâng tầm trải nghiệm người dùng. Camera chính 48MP mang lại khả năng chụp ảnh sắc nét và linh hoạt hơn, cùng chip A16 Bionic mạnh mẽ, giúp máy hoạt động mượt mà trong mọi tác vụ.', 54, 1, 5, NULL, NULL),
(55, 'Iphone 12', 24390000, '2024-10-30', 'Iphone 12, Iphone 12 Pro, Iphone 12 Pro Max', 4, 1, 1, NULL, NULL),
(57, 'Iphone 13', 24390000, '2024-11-06', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 2, 1, 2, NULL, NULL),
(58, 'Iphone 14 ', 24390000, '2024-11-12', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 2, 1, 3, NULL, NULL),
(59, 'Iphone 15 Pro Max', 24390000, '2024-11-06', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 1, 1, 5, NULL, NULL),
(62, 'Iphone 15 Pro Max', 24390000, '2024-10-30', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 1, 1, 5, NULL, NULL),
(63, 'Iphone 15 Pro Max', 24390000, '2024-11-06', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 1, 1, 5, NULL, NULL),
(64, 'Iphone 15 Pro Max', 24390000, '2024-11-13', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 9, 1, 5, NULL, NULL),
(65, 'Iphone 15 Pro', 19390000, '2024-11-07', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 4, 1, 5, NULL, NULL),
(66, 'Iphone 15 Pro', 19390000, '2024-10-31', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 2, 1, 5, NULL, NULL),
(67, 'Iphone 15 Pro', 19390000, '2024-11-13', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 0, 1, 5, NULL, NULL),
(68, 'Iphone 15 Pro', 19390000, '2024-11-07', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 1, 1, 5, NULL, NULL),
(69, 'Iphone 15 ', 13390000, '2024-11-06', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 3, 1, 5, NULL, NULL),
(70, 'Iphone 15 ', 13390000, '2024-10-29', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 0, 1, 5, NULL, NULL),
(71, 'Iphone 15 ', 13390000, '2024-10-30', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 0, 1, 5, NULL, NULL),
(72, 'Iphone 15 ', 13390000, '2024-10-30', 'Iphone 15, Iphone 15 Plus, Iphone 15 Pro, Iphone 15 Pro Max', 5, 1, 5, NULL, NULL),
(73, 'Iphone 14 ', 13390000, '2024-11-06', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(74, 'Iphone 14 ', 13390000, '2024-10-30', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 1, 1, 3, NULL, NULL),
(75, 'Iphone 14 ', 13390000, '2024-10-28', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(76, 'Iphone 14 ', 13390000, '2024-11-06', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 1, 1, 3, NULL, NULL),
(77, 'Iphone 14 Pro', 13390000, '2024-11-14', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(78, 'Iphone 14 Pro', 13390000, '2024-11-06', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(79, 'Iphone 14 Pro', 13390000, '2024-10-31', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(80, 'Iphone 14 Pro', 13390000, '2024-11-14', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(81, 'Iphone 14 Pro Max', 23390000, '2024-11-19', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 3, 1, 3, NULL, NULL),
(82, 'Iphone 14 Pro Max', 23390000, '2024-11-05', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(83, 'Iphone 14 Pro Max', 24390000, '2024-11-06', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(84, 'Iphone 14 Pro Max', 24390000, '2024-11-13', 'Iphone 14, Iphone 14 Pro, Iphone 14 Pro Max', 0, 1, 3, NULL, NULL),
(85, 'Iphone 13 ', 13390000, '2024-11-05', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(86, 'Iphone 13', 13390000, '2024-11-13', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 1, 1, 2, NULL, NULL),
(87, 'Iphone 13', 13390000, '2024-10-31', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(88, 'Iphone 13', 13390000, '2024-11-07', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(89, 'Iphone 13 Pro', 15390000, '2024-11-13', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(90, 'Iphone 13 Pro', 15390000, '2024-11-14', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(91, 'Iphone 13 Pro', 15390000, '2024-10-31', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(92, 'Iphone 13 Pro', 15390000, '2024-11-13', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(93, 'Iphone 13 Pro', 15390000, '2024-11-20', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 1, 1, 2, NULL, NULL),
(94, 'Iphone 13', 11390000, '2024-11-20', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 3, 1, 2, NULL, NULL),
(95, 'Iphone 13', 11390000, '2024-11-13', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(96, 'Iphone 13', 11390000, '2024-11-07', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(97, 'Iphone 13', 11390000, '2024-11-06', 'Iphone 13, Iphone 13 Pro, Iphone 13 Pro Max', 0, 1, 2, NULL, NULL),
(98, 'Iphone 12', 11390000, '2024-11-21', 'Iphone 12, Iphone 12 Pro, Iphone 12 Pro Max', 0, 1, 1, NULL, NULL),
(99, 'Iphone 12', 11390000, '2024-11-20', 'Iphone 12, Iphone 12 Pro, Iphone 12 Pro Max', 0, 1, 1, NULL, NULL),
(100, 'Iphone 12', 11390000, '2024-11-07', 'Iphone 12, Iphone 12 Pro, Iphone 12 Pro Max', 0, 1, 1, NULL, NULL),
(101, 'Iphone 12', 11390000, '2024-11-07', 'Iphone 12, Iphone 12 Pro, Iphone 12 Pro Max', 0, 1, 1, NULL, NULL),
(102, 'Iphone 12', 11390000, '2024-11-06', 'Iphone 12, Iphone 12 Pro, Iphone 12 Pro Max', 0, 1, 1, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `san_pham_khuyen_mai`
--

CREATE TABLE `san_pham_khuyen_mai` (
  `san_pham_id` int(11) NOT NULL,
  `khuyen_mai_id` int(11) NOT NULL,
  `ngay_them` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `san_pham_khuyen_mai`
--

INSERT INTO `san_pham_khuyen_mai` (`san_pham_id`, `khuyen_mai_id`, `ngay_them`) VALUES
(43, 7, '2024-11-20 18:36:48'),
(44, 4, '2024-11-20 19:28:58'),
(50, 9, '2024-11-20 19:36:05');

-- --------------------------------------------------------

--
-- Table structure for table `san_pham_ram`
--

CREATE TABLE `san_pham_ram` (
  `san_pham_id` int(11) NOT NULL,
  `ram_id` int(11) NOT NULL,
  `gia_them` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `san_pham_ram`
--

INSERT INTO `san_pham_ram` (`san_pham_id`, `ram_id`, `gia_them`) VALUES
(43, 5, 0.00),
(43, 6, 0.00),
(43, 7, 0.00),
(44, 5, 0.00),
(44, 6, 0.00),
(44, 7, 0.00),
(45, 5, 0.00),
(45, 6, 0.00),
(45, 7, 0.00),
(50, 5, 0.00),
(50, 6, 0.00),
(50, 7, 0.00),
(55, 5, 0.00),
(55, 6, 0.00),
(55, 7, 0.00),
(57, 5, 0.00),
(57, 6, 0.00),
(57, 7, 0.00),
(58, 5, 0.00),
(58, 6, 0.00),
(58, 7, 0.00),
(59, 5, 0.00),
(59, 6, 0.00),
(59, 7, 0.00),
(62, 5, 0.00),
(62, 6, 0.00),
(62, 7, 0.00),
(63, 5, 0.00),
(63, 6, 0.00),
(63, 7, 0.00),
(64, 5, 0.00),
(64, 6, 0.00),
(64, 7, 0.00),
(65, 5, 0.00),
(65, 6, 0.00),
(65, 7, 0.00),
(66, 5, 0.00),
(66, 6, 0.00),
(66, 7, 0.00),
(67, 5, 0.00),
(67, 6, 0.00),
(67, 7, 0.00),
(68, 5, 0.00),
(68, 6, 0.00),
(68, 7, 0.00),
(69, 5, 0.00),
(69, 6, 0.00),
(69, 7, 0.00),
(70, 5, 0.00),
(70, 6, 0.00),
(70, 7, 0.00),
(71, 5, 0.00),
(71, 6, 0.00),
(71, 7, 0.00),
(72, 5, 0.00),
(72, 6, 0.00),
(72, 7, 0.00),
(73, 5, 0.00),
(73, 6, 0.00),
(73, 7, 0.00),
(74, 5, 0.00),
(74, 6, 0.00),
(74, 7, 0.00),
(75, 5, 0.00),
(75, 6, 0.00),
(76, 5, 0.00),
(76, 6, 0.00),
(77, 6, 0.00),
(77, 7, 0.00),
(78, 6, 0.00),
(78, 7, 0.00),
(79, 6, 0.00),
(79, 7, 0.00),
(80, 5, 0.00),
(80, 6, 0.00),
(80, 7, 0.00),
(81, 5, 0.00),
(81, 6, 0.00),
(81, 7, 0.00),
(82, 5, 0.00),
(82, 6, 0.00),
(82, 7, 0.00),
(83, 5, 0.00),
(83, 6, 0.00),
(83, 7, 0.00),
(84, 5, 0.00),
(84, 6, 0.00),
(84, 7, 0.00),
(85, 5, 0.00),
(85, 6, 0.00),
(85, 7, 0.00),
(86, 5, 0.00),
(86, 6, 0.00),
(86, 7, 0.00),
(87, 5, 0.00),
(87, 6, 0.00),
(87, 7, 0.00),
(88, 5, 0.00),
(88, 6, 0.00),
(88, 7, 0.00),
(89, 5, 0.00),
(89, 6, 0.00),
(89, 7, 0.00),
(90, 5, 0.00),
(90, 6, 0.00),
(90, 7, 0.00),
(91, 5, 0.00),
(91, 6, 0.00),
(91, 7, 0.00),
(92, 6, 0.00),
(92, 7, 0.00),
(93, 5, 0.00),
(93, 6, 0.00),
(93, 7, 0.00),
(94, 5, 0.00),
(94, 6, 0.00),
(94, 7, 0.00),
(95, 5, 0.00),
(95, 6, 0.00),
(95, 7, 0.00),
(96, 5, 0.00),
(96, 6, 0.00),
(96, 7, 0.00),
(97, 5, 0.00),
(97, 6, 0.00),
(97, 7, 0.00),
(98, 5, 0.00),
(98, 6, 0.00),
(98, 7, 0.00),
(99, 5, 0.00),
(99, 6, 0.00),
(99, 7, 0.00),
(100, 5, 0.00),
(100, 6, 0.00),
(100, 7, 0.00),
(101, 5, 0.00),
(101, 6, 0.00),
(101, 7, 0.00),
(102, 5, 0.00),
(102, 6, 0.00),
(102, 7, 0.00);

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
(5, 'Bình boong', 'binhbong123@gmail.com', '123123', 'hiệp hòa', '098765432', 0, '../Upload/User/1731872512_1731097720nam.jpg', 0, '2024-11-18', 1),
(6, 'Ngọc Bảo Anh Nguyễn', 'banhday@gmail.com', 'banhday', 'Phú Thọ', '0368706552', 0, '../Upload/User/nam.jpg', 0, NULL, 1);

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
  ADD UNIQUE KEY `unique_cart_item` (`tai_khoan_id`, `san_pham_id`, `ram_id`);

--
-- Indexes for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  ADD PRIMARY KEY (`hinh_anh_id`),
  ADD KEY `san_pham_id` (`san_pham_id`);

--
-- Indexes for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  ADD PRIMARY KEY (`khuyen_mai_id`);

--
-- Indexes for table `ram`
--
ALTER TABLE `ram`
  ADD PRIMARY KEY (`ram_id`);

--
-- Indexes for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD PRIMARY KEY (`san_pham_id`),
  ADD KEY `danh_muc_id` (`danh_muc_id`),
  ADD KEY `san_pham_khuyen_mai_fk` (`khuyen_mai_id`);

--
-- Indexes for table `san_pham_khuyen_mai`
--
ALTER TABLE `san_pham_khuyen_mai`
  ADD PRIMARY KEY (`san_pham_id`,`khuyen_mai_id`),
  ADD KEY `khuyen_mai_id` (`khuyen_mai_id`);

--
-- Indexes for table `san_pham_ram`
--
ALTER TABLE `san_pham_ram`
  ADD PRIMARY KEY (`san_pham_id`,`ram_id`),
  ADD KEY `ram_id` (`ram_id`);

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
  MODIFY `binh_luan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  MODIFY `chi_tiet_don_hang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `danh_muc`
--
ALTER TABLE `danh_muc`
  MODIFY `danh_muc_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `don_hang`
--
ALTER TABLE `don_hang`
  MODIFY `don_hang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gio_hang`
--
ALTER TABLE `gio_hang`
  MODIFY `gio_hang_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  MODIFY `hinh_anh_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `khuyen_mai`
--
ALTER TABLE `khuyen_mai`
  MODIFY `khuyen_mai_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `ram`
--
ALTER TABLE `ram`
  MODIFY `ram_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `san_pham`
--
ALTER TABLE `san_pham`
  MODIFY `san_pham_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `slides`
--
ALTER TABLE `slides`
  MODIFY `slide_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tai_khoan`
--
ALTER TABLE `tai_khoan`
  MODIFY `tai_khoan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `binh_luan`
--
ALTER TABLE `binh_luan`
  ADD CONSTRAINT `binh_luan_ibfk_1` FOREIGN KEY (`tai_khoan_id`) REFERENCES `tai_khoan` (`tai_khoan_id`),
  ADD CONSTRAINT `binh_luan_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`) ON DELETE CASCADE;

--
-- Constraints for table `chi_tiet_don_hang`
--
ALTER TABLE `chi_tiet_don_hang`
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_1` FOREIGN KEY (`don_hang_id`) REFERENCES `don_hang` (`don_hang_id`),
  ADD CONSTRAINT `chi_tiet_don_hang_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`) ON DELETE CASCADE;

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
  ADD CONSTRAINT `gio_hang_ibfk_2` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `gio_hang_ibfk_3` FOREIGN KEY (`ram_id`) REFERENCES `ram` (`ram_id`) ON DELETE CASCADE;

--
-- Constraints for table `hinh_anh_san_pham`
--
ALTER TABLE `hinh_anh_san_pham`
  ADD CONSTRAINT `hinh_anh_san_pham_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`) ON DELETE CASCADE;

--
-- Constraints for table `san_pham`
--
ALTER TABLE `san_pham`
  ADD CONSTRAINT `san_pham_ibfk_1` FOREIGN KEY (`danh_muc_id`) REFERENCES `danh_muc` (`danh_muc_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `san_pham_khuyen_mai_fk` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `khuyen_mai` (`khuyen_mai_id`) ON DELETE CASCADE;

--
-- Constraints for table `san_pham_khuyen_mai`
--
ALTER TABLE `san_pham_khuyen_mai`
  ADD CONSTRAINT `san_pham_khuyen_mai_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `san_pham_khuyen_mai_ibfk_2` FOREIGN KEY (`khuyen_mai_id`) REFERENCES `khuyen_mai` (`khuyen_mai_id`) ON DELETE CASCADE;

--
-- Constraints for table `san_pham_ram`
--
ALTER TABLE `san_pham_ram`
  ADD CONSTRAINT `san_pham_ram_ibfk_1` FOREIGN KEY (`san_pham_id`) REFERENCES `san_pham` (`san_pham_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `san_pham_ram_ibfk_2` FOREIGN KEY (`ram_id`) REFERENCES `ram` (`ram_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
